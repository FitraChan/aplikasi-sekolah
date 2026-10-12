<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;

use App\Models\HasilWawancara;
use App\Models\JadwalWawancara;
use App\Models\Gtk;
use App\Models\Jurusan;
use App\Models\Konfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilWawancaraController extends Controller
{
     protected $tahun;
    protected $smt;

    public function __construct()
    {
        $konfig = Konfig::first();

        $this->tahun = $konfig->id_thn_ppdb;
        $this->smt = $konfig->smt;
    }

    /**
     * Halaman form wawancara
     */
    public function create($idJadwal)
    {
        $jadwal = JadwalWawancara::with([
            'calonSiswa',
            'calonSiswa.jurusan',
            'gtk',
        ])->findOrFail($idJadwal);

        /*
        |--------------------------------------------------------------------------
        | Pastikan hanya GTK yang menjadi pewawancara
        |--------------------------------------------------------------------------
        */

        $idUser = auth()->user()->id;

        $guru = Gtk::where('user_id', $idUser)->firstOrFail();

        if ($jadwal->id_gtk != $guru->id) {
            abort(403, 'Anda tidak memiliki akses ke wawancara ini.');
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil hasil wawancara jika sudah pernah disimpan
        |--------------------------------------------------------------------------
        */

        $hasil = HasilWawancara::where(
            'id_jadwal_wawancara',
            $jadwal->id
        )->first();

        $jurusan = Jurusan::orderBy('nama_jurusan')->get();

        return view('guru.jadwal-wawancara.test', [
            'jadwal' => $jadwal,
            'guru' => $guru,
            'hasil' => $hasil,
            'jurusan' => $jurusan,
            'side' => 'jadwal-wawancara',
        ]);
    }

    /**
     * Simpan hasil wawancara
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal_wawancara' => 'required|exists:jadwal_wawancara,id',

            'nilai_organisasi' => 'required|numeric|min:0|max:100',
            'nilai_prestasi' => 'required|numeric|min:0|max:100',

            'penyakit_kronis' => 'required|in:ya,tidak',
            'nilai_penyakit' => 'required|numeric|min:0|max:100',
            'riwayat_penyakit' => 'nullable|string',

            'buta_warna' => 'required|in:ya,tidak',
            'nilai_buta_warna' => 'required|numeric|min:0|max:100',

            'pekerjaan_ayah' => 'nullable|string|max:150',
            'pekerjaan_ibu' => 'nullable|string|max:150',

            'nilai_attitude' => 'required|numeric|min:0|max:100',
            'nilai_wawasan' => 'required|numeric|min:0|max:100',
            'nilai_kemampuan' => 'required|numeric|min:0|max:100',

            'hobi' => 'nullable|string|max:255',
            'pengalaman_kerja' => 'nullable|string',

            'status_lulus' => 'required|in:Lulus,Tidak Lulus,Cadangan',

            'id_jurusan_rekomendasi' => 'nullable|exists:tb_jurusan,id',

            'catatan' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Ambil jadwal
            |--------------------------------------------------------------------------
            */

            $jadwal = JadwalWawancara::findOrFail(
                $request->id_jadwal_wawancara
            );

            /*
            |--------------------------------------------------------------------------
            | Ambil GTK yang sedang login
            |--------------------------------------------------------------------------
            */

            $guru = Gtk::where(
                'user_id',
                auth()->user()->id
            )->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Pastikan guru memang pewawancara
            |--------------------------------------------------------------------------
            */

            if ($jadwal->id_gtk != $guru->id) {
                abort(403, 'Anda bukan pewawancara pada jadwal ini.');
            }

            /*
            |--------------------------------------------------------------------------
            | Hitung nilai akhir
            |--------------------------------------------------------------------------
            |
            | Untuk sementara menggunakan rata-rata semua komponen nilai.
            | Rumus dapat kita ubah sesuai bobot penilaian sekolah.
            |
            */

            $nilai = [
                $request->nilai_organisasi,
                $request->nilai_prestasi,
                $request->nilai_penyakit,
                $request->nilai_buta_warna,
                $request->nilai_attitude,
                $request->nilai_wawasan,
                $request->nilai_kemampuan,
            ];

            $nilaiAkhir = round(
                array_sum($nilai) / count($nilai),
                2
            );

            /*
            |--------------------------------------------------------------------------
            | Simpan / Update
            |--------------------------------------------------------------------------
            */

            $hasil = HasilWawancara::updateOrCreate(
                [
                    'id_jadwal_wawancara' => $jadwal->id,
                ],
                [
                    'id_calon_siswa' => $jadwal->id_calon_siswa,
                    'id_gtk' => $guru->id,

                    'nilai_organisasi' => $request->nilai_organisasi,
                    'nilai_prestasi' => $request->nilai_prestasi,

                    'penyakit_kronis' => $request->penyakit_kronis,
                    'nilai_penyakit' => $request->nilai_penyakit,
                    'riwayat_penyakit' => $request->riwayat_penyakit,

                    'buta_warna' => $request->buta_warna,
                    'nilai_buta_warna' => $request->nilai_buta_warna,

                    'pekerjaan_ayah' => $request->pekerjaan_ayah,
                    'pekerjaan_ibu' => $request->pekerjaan_ibu,

                    'nilai_attitude' => $request->nilai_attitude,
                    'nilai_wawasan' => $request->nilai_wawasan,
                    'nilai_kemampuan' => $request->nilai_kemampuan,

                    'hobi' => $request->hobi,
                    'pengalaman_kerja' => $request->pengalaman_kerja,

                    'nilai_akhir' => $nilaiAkhir,

                    'status_lulus' => $request->status_lulus,
                    'id_jurusan_rekomendasi' =>
                        $request->id_jurusan_rekomendasi,

                    'catatan' => $request->catatan,

                    'tanggal_wawancara' => $jadwal->tanggal,
                    'jam_wawancara' => $jadwal->jam_mulai,

                    'status' => 'selesai',
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | Update status jadwal
            |--------------------------------------------------------------------------
            */

            $jadwal->update([
                'status' => 'selesai',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Hasil wawancara berhasil disimpan.',
                'data' => $hasil,
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan hasil wawancara.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Detail hasil wawancara
     */
    public function show($id)
    {
        $hasil = HasilWawancara::with([
            'calonSiswa',
            'calonSiswa.jurusan',
            'gtk',
            'jadwalWawancara',
            'jurusan',
        ])->findOrFail($id);

        return view('guru.jadwal-wawancara.hasil-wawancara', [
            'hasil' => $hasil,
            'side' => 'jadwal-wawancara',
        ]);
    }

    /**
     * Hapus hasil wawancara
     */
    public function destroy($id)
    {
        $hasil = HasilWawancara::findOrFail($id);

        $hasil->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hasil wawancara berhasil dihapus.',
        ]);
    }
}
