<?php

namespace App\Http\Controllers\akademik;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\MasterJadwal;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Gtk;
use App\Models\JamPelajaran;
use App\Models\Jurusan;
use App\Models\TransAjar;

use Illuminate\Support\Facades\DB;
use App\Models\LogModel;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('akademik.absensi.index', [
            'side'  => 'absensi',
            'jam' => JamPelajaran::orderBy('id', 'desc')->get(),
            'jurusan' => Jurusan::orderBy('id', 'desc')->get(),
            'tahun' => TahunAjaran::orderBy('id', 'desc')->get(),
            'kelas' => Kelas::orderBy('nama_kelas')->get(),
            'mapel' => Mapel::orderBy('nama_mapel')->get(),
            'guru'  => Gtk::orderBy('nama_gtk')->get(),
        ]);
    }

    public function data(Request $request)
    {
        $query = MasterJadwal::with([
            'tahun',
            'kelas',
            'mapel',
            'guru'
        ]);

        if ($request->id_tahun) {
            $query->where('id_tahun', $request->id_tahun);
        }

        if ($request->id_kelas) {
            $query->where('id_kelas', $request->id_kelas);
        }

        if ($request->id_jurusan) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where('id_jurusan', $request->id_jurusan);
            });
        }

        $data = $query
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {

                return [
                    'id'            => $item->id,
                    'id_tahun'      => $item->id_tahun,
                    'semester'      => $item->semester,
                    'id_kelas'      => $item->id_kelas,
                    'id_mapel'      => $item->id_mapel,
                    'id_gtk'        => $item->id_gtk,
                    'jml_jam'       => $item->jml_jam,
                    'angkatan'      => $item->angkatan,

                    'tahun_ajaran'  => $item->tahun->thn_ajaran ?? '',
                    'nama_kelas'    => $item->kelas->nama_kelas ?? '',
                    'nama_mapel'    => $item->mapel->nama_mapel ?? '',
                    'nama_gtk'      => $item->guru->nama_gtk ?? '',
                ];
            });

        return response()->json($data);
    }

    public function dataDetailAbsensi($id)
    {

        $data = Absensi::with('siswa')
            ->where('idtransajar', $id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id'         => $item->id,
                    'nipd'       => $item->nipd,
                    'nama'       => $item->siswa->nama_lengkap ?? '-',
                    'jk'         => $item->siswa->jk ?? '-',
                    'sts_hadir'  => $item->sts_hadir,
                    'ket_hadir'  => $item->ket_hadir,
                ];
            });

        return response()->json($data);
    }

    public function dataAbsensi($id)
    {
        $transAjar = TransAjar::withCount([
            'hadir as H',
            'sakit as S',
            'izin as I',
            'alfa as A',
        ])->where('idjadwal', $id)
        ->orderBy('created_at','desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'hadir' => $item->H ?? 0,
                    'sakit' => $item->S ?? 0,
                    'izin' => $item->I ?? 0,
                    'alfa' => $item->A ?? 0,
                    'pertemuan_ke' => $item->idpertemuan ?? 0,
                    'tanggal' => $item->tgl ?? '-',
                ];
            });

                return response()->json($transAjar);

       
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $transAjar = TransAjar::create([
                'idjadwal'        => $request->idjadwal,
                'idpertemuan'     => $request->idpertemuan,
                'materi'          => $request->materi,
                'keterangan'      => $request->keterangan,
                'guru_pengganti'  => $request->guru_pengganti,
                'tgl'             => date('Y-m-d', strtotime($request->tgl_pbm)),
                'jml_h'           => $request->jml_h ?? 0,
                'jml_i'           => $request->jml_i ?? 0,
                'jml_s'           => $request->jml_s ?? 0,
                'jml_a'           => $request->jml_a ?? 0,
            ]);

            $idt = $transAjar->id;

            DB::insert("
            INSERT INTO tb_hadir_siswa (idtransajar, nipd)
            SELECT ?, tb_nilai.nipd
            FROM tb_nilai
            WHERE tb_nilai.idjadwal = ?
            ORDER BY tb_nilai.nipd
        ", [
                $idt,
                $request->idjadwal
            ]);

              LogModel::create([
                    'tanggal'    => now(),
                    'tabel'      => 'tb_mapel',
                    'aksi'       => 'create',
                    'user'       => auth()->id(),
                    'ip'         => $request->ip(),
                    'keterangan' => json_encode($transAjar),
                    'serial'     => $request->header('User-Agent')
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'title'   => 'Sukses',
                'msg'     => 'Data telah tersimpan'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'title'   => 'Peringatan',
                'msg'     => $e->getMessage()
            ], 500);
        }
    }

    public function simpanDetailAbsensi(Request $request)
    {
        try {

            $data = $request->input('data');

            if (!$data || !is_array($data)) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data tidak valid'
                ]);
            }

            DB::beginTransaction();

            foreach ($data as $row) {

                DB::table('tb_hadir_siswa')
                    ->where('id', $row['id'])
                    ->update([
                        'sts_hadir' => $row['sts_hadir'],
                        'ket_hadir' => $row['ket_hadir'] ?? null,
                        'updated_at' => now()
                    ]);



                    LogModel::create([
                        'tanggal'    => now(),
                        'tabel'      => 'tb_hadir_siswa',
                        'aksi'       => 'update',
                        'user'       => auth()->id(),
                        'ip'         => $request->ip(),
                        'keterangan' => json_encode($row),
                        'serial'     => $request->fullUrl()
                    ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'msg' => 'Absensi berhasil disimpan'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
