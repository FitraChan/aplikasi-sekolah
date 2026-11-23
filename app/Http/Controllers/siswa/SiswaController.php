<?php

namespace App\Http\Controllers\siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\CalonSiswa;
use App\Models\User;
use App\Models\Agama;
use App\Models\Pekerjaan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Gelombang;
use App\Models\Bayar;
use App\Models\DetBayar;
use App\Models\TemplateBayar;

use App\Models\DetTempBayar;

use App\Models\Konfig;
use App\Models\TahunAjaran;
use App\Models\LogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    /**
     * Halaman daftar siswa.
     */


    var $tahun, $smt;

    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_tahun;
        $this->smt = $konfig->smt;
    }
    public function index()
    {

        $tahunSekarang = $this->tahun;
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $tahunAjaran = TahunAjaran::whereBetween('id', [
            $tahunSekarang - 3,
            $tahunSekarang
        ])
            ->orderBy('id', 'desc')
            ->get();

        $status_siswa = DB::table('tb_sts_siswa')->orderBy('id', 'asc')->get();


        return view('siswa.index', compact(
            'jurusan',
            'kelas',
            'tahunAjaran',
            'status_siswa'
        ), [
            'side' => 'siswa',
        ]);
    }

    public function siswaBaru()
    {
        $side = 'siswa-baru';

        $gelombang = Gelombang::all();

        $jurusan = Jurusan::all();

        return view('siswa.siswa-baru', compact(
            'side',
            'gelombang',
            'jurusan'
        ), ['side'  => 'calon-siswa']);
    }

    public function dataSiswaBaru()
    {
        $data = CalonSiswa::with([
            'gelombang',
            'jurusan',
            'tahunAjaran'
        ])
            ->whereHas('tahunAjaran', function ($q) {
                $q->where('isaktiv', 1);
            })
            ->where('status_daftar', 1)
            ->latest('id')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_lengkap' => $item->nama_lengkap,
                    'jk' => $item->jk,
                    'tahun' => $item->id_thn_ajaran,
                    'nisn' => $item->nisn,
                    'no_hp' => $item->no_hp,
                    'no_daftar' => $item->no_daftar,
                    'nama_jurusan' => $item->jurusan->nama_jurusan ?? '-',
                    'nama_gelombang' =>
                    $item->gelombang->nama_gelombang ?? '-',
                    'id_jurusan' => $item->id_jurusan,
                    'id_gelombang' => $item->id_gelombang,
                ];
            });

        return response()->json($data);
    }

    public function setNipd(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nipd' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tb_siswa', 'nipd')->ignore($siswa->id),
            ],
        ]);

        $siswa->update([
            'nipd' => $validated['nipd'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'NIPD berhasil disimpan.',
            'data' => $siswa,
        ]);
    }

    /**
     * Data siswa untuk AJAX/Tabulator.
     */
    public function data(Request $request)
    {

        $tahun = $this->tahun;
        $query = Siswa::query()
            ->with([
                'kelas',
                'jurusan',
                'tahunAjaran',
                'agama',
            ])
            ->latest('id');

        if ($request->filled('tahun')) {
            $query->where('id_thn_ajaran', $request->tahun);
        }

        if ($request->filled('jurusan')) {
            $query->where('id_jurusan', $request->jurusan);
        }

        if ($request->filled('kelas')) {
            $query->where('id_kelas', $request->kelas);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nipd', 'like', "%{$search}%")
                    ->orWhere('nama_lengkap', 'like', "%{$search}%");
            });
        }

        $data = $query->get()->map(function ($item) use ($tahun) {

            $kelas;
            $selisih = $tahun - $item->id_thn_ajaran;

            if ($selisih == 0) {
                $kelas = 'X';
            } elseif ($selisih == 1) {
                $kelas = 'XI';
            } else {
                $kelas = 'XII';
            }


            return [
                'id'             => $item->id,
                'nipd'           => $item->nipd,
                'nisn'           => $item->nisn,
                'nama_lengkap'   => $item->nama_lengkap,
                'jk'             => $item->jk,
                'no_hp'          => $item->no_hp,
                'email'          => $item->email,

                'nama_jurusan'   => $item->jurusan->nama_jurusan ?? '-',
                'tahun_ajaran'   => $item->tahunAjaran->thn_ajaran ?? '-',
                'agama'          => $item->agama->nama_agama ?? '-',

                'id_kelas'       => $item->id_kelas,
                'id_jurusan'     => $item->id_jurusan,
                'id_thn_ajaran'  => $item->id_thn_ajaran,
                'status'         => $item->status,
                'kelas' => trim($kelas . ' ' . ($item->kelas?->nama_kelas ?? '')),
            ];
        });

        return response()->json($data);
    }

    /**
     * Form tambah siswa.
     */
    public function create()
    {
        $rows = new Siswa();

        $nipd = $this->getNipdBaru();

        //dd($nipd);

        $masterData = $this->masterData();

        return view('siswa.siswa', array_merge(
            $masterData,
            compact('rows', 'nipd'),
            [
                'side' => 'siswa',
                'mode' => 'create',
            ]
        ));
    }


    /**
     * Menghasilkan NIPD baru
     */
    private function getNipdBaru()
    {
         $nipdTerpakai = DB::table('tb_siswa')        
        ->whereNotNull('nipd')
        ->whereRaw("nipd REGEXP '^[0-9]+$'")
        ->pluck('nipd')
        ->map(fn($nipd) => (int) $nipd)
        ->unique()
        ->flip();

    // Ambil batas bawah dan atas berdasarkan data
    $nomorAwal = $nipdTerpakai->keys()->min() ?? 1000;
    $nomorAkhir = 9999;

    // Cari nomor kosong terkecil
    for ($i = $nomorAwal; $i <= $nomorAkhir; $i++) {

        if (!$nipdTerpakai->has($i)) {
            return str_pad($i, 4, '0', STR_PAD_LEFT);
        }
    }

    throw new \RuntimeException(
        'Seluruh nomor NIPD sudah digunakan.'
    );
    }


    /**
     * Endpoint AJAX jika diperlukan
     */
    

    /**
     * Form edit siswa.
     */
    public function edit($id)
    {
        $rows = Siswa::findOrFail($id);

        $tahunAjaran = TahunAjaran::orderByDesc('id')->get();

        $jurusan = Jurusan::orderBy(
            'nama_jurusan',
            'asc'
        )->get();

        $kelas = Kelas::orderBy(
            'nama_kelas',
            'asc'
        )->get();

        $agama = Agama::orderBy(
            'nama_agama',
            'asc'
        )->get();


        $status_siswa = DB::table('tb_sts_siswa')->orderBy('id', 'asc')->get();
        $jobs = Pekerjaan::orderBy('nama_pekerjaan', 'asc')->get();

        return view('siswa.siswa', compact(
            'rows',
            'tahunAjaran',
            'jurusan',
            'kelas',
            'agama',
            'status_siswa',
            'jobs'
        ), [
            'side' => 'siswa',
        ]);
    }

    /**
     * Simpan siswa baru.
     */
    public function store(Request $request)
    {
        $validated = $this->validateSiswa($request);

        DB::beginTransaction();

        try {

            $validated['sts_siswa'] = 1;
            $siswa = Siswa::create($validated);

            $this->simpanLog(
                request: $request,
                aksi: 'create',
                siswa: $siswa
            );

            DB::commit();

            return redirect()
                ->route('siswa.index')
                ->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Data siswa gagal ditambahkan: ' . $e->getMessage());
        }
    }

    /**
     * Update data siswa.
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $this->validateSiswa($request, $siswa->id);

        DB::beginTransaction();

        try {
            $siswa->update($validated);

            $this->simpanLog(
                request: $request,
                aksi: 'update',
                siswa: $siswa
            );

            DB::commit();

            return redirect()
                ->route('siswa.index')
                ->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Data siswa gagal diperbarui: ' . $e->getMessage());
        }
    }

    /**
     * Update biodata siswa saja.
     */
    public function updateBiodata(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn'         => 'nullable|string|max:30',
            'nik'          => 'nullable|string|max:30',
            'jk'           => 'nullable|in:L,P',
            'id_agama'     => 'nullable|integer',
            'tmp_lahir'    => 'nullable|string|max:100',
            'tgl_lahir'    => 'nullable|date',
            'alamat'       => 'nullable|string',
            'dusun'        => 'nullable|string|max:100',
            'desa'         => 'nullable|string|max:100',
            'kecamatan'    => 'nullable|string|max:100',
            'kota'         => 'nullable|string|max:100',
            'provinsi'     => 'nullable|string|max:100',
            'no_hp'        => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:255',
        ]);

        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->update($validated);

            $this->simpanLog(
                request: $request,
                aksi: 'update-biodata',
                siswa: $siswa
            );

            return back()->with(
                'success',
                'Biodata siswa berhasil diperbarui.'
            );
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update data akademik siswa.
     */
   public function updateAkademik(Request $request, $id = null)
{
    $validated = $request->validate([

        /*
        |--------------------------------------------------------------------------
        | INFORMASI AKADEMIK
        |--------------------------------------------------------------------------
        */
        'nipd'          => 'required|string|max:50',
        'id_thn_ajaran' => 'required|integer',
        'id_jurusan'    => $id ? 'nullable|integer' : 'required|integer',
        'id_kelas'      => 'required|integer',

        /*
        |--------------------------------------------------------------------------
        | IDENTITAS SISWA
        |--------------------------------------------------------------------------
        */
        'sts_siswa'     => 'nullable|integer',
        'nama_lengkap'  => 'required|string|max:255',
        'nisn'          => 'nullable|string|max:30',
        'nik'           => 'nullable|string|max:30',
        'jk'            => 'nullable|in:L,P',
        'id_agama'      => 'nullable|integer',
        'tmp_lahir'     => 'nullable|string|max:100',
        'tgl_lahir'     => 'nullable|date',

        /*
        |--------------------------------------------------------------------------
        | ALAMAT
        |--------------------------------------------------------------------------
        */
        'alamat'        => 'nullable|string',
        'dusun'         => 'nullable|string|max:100',
        'desa'          => 'nullable|string|max:100',
        'kecamatan'     => 'nullable|string|max:100',
        'kota'          => 'nullable|string|max:100',
        'provinsi'      => 'nullable|string|max:100',

        /*
        |--------------------------------------------------------------------------
        | KONTAK
        |--------------------------------------------------------------------------
        */
        'no_hp'         => 'nullable|string|max:20',
        'email'         => [
            'required',
            'email',
            'max:255',
            ...(!$id ? [Rule::unique('users', 'email')] : []),
        ],
    ]);

    try {

        DB::transaction(function () use ($validated, $request, $id, &$siswa, &$aksi, &$pesan) {

            if (!empty($id)) {

                /*
                |--------------------------------------------------------------------------
                | UPDATE DATA SISWA
                |--------------------------------------------------------------------------
                */

                $siswa = Siswa::findOrFail($id);

                $siswa->update($validated);

                $aksi  = 'update-akademik';
                $pesan = 'Data akademik siswa berhasil diperbarui.';

            } else {

                /*
                |--------------------------------------------------------------------------
                | TAMBAH DATA SISWA
                |--------------------------------------------------------------------------
                */

                $validated['sts_siswa'] = $validated['sts_siswa'] ?? 1;

                /*
                |--------------------------------------------------------------------------
                | CEK TEMPLATE PEMBAYARAN
                |--------------------------------------------------------------------------
                */

                $template = TemplateBayar::query()
                    ->where('id_jurusan', $validated['id_jurusan'])
                    ->where('id_tahun', $this->tahun)
                    ->first();

                if (!$template) {
                    throw new \RuntimeException(
                        'Detail template pembayaran belum tersedia.'
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | BUAT USER
                |--------------------------------------------------------------------------
                */

                $userId = DB::table('users')->insertGetId([
                    'name'              => $validated['nama_lengkap'],
                    'email'             => $validated['email'],
                    'password'          => Hash::make('password'),
                    'email_verified_at' => null,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                /*
                |--------------------------------------------------------------------------
                | ASSIGN ROLE
                |--------------------------------------------------------------------------
                */

                $user = User::findOrFail($userId);

                $user->assignRole('siswa');

                /*
                |--------------------------------------------------------------------------
                | BUAT DATA SISWA
                |--------------------------------------------------------------------------
                */
                $siswa = Siswa::create($validated);
                /*
                |--------------------------------------------------------------------------
                | HUBUNGKAN USER DAN TEMPLATE BAYAR
                |--------------------------------------------------------------------------
                */
                $siswa->id_user = $userId;
                $siswa->id_template_bayar = $template->id;

                $siswa->save();

                $aksi  = 'tambah-akademik';
                $pesan = 'Data akademik siswa berhasil ditambahkan.';
            }


                if (empty($id)) {

                 

                    $result = $this->generateTagihanCalonSiswa(
                        siswa: $siswa,
                        idTahun: (int) $request->id_thn_ajaran,
                        idUser: $userId,
                        ip: $request->ip(),
                    );

                   
                }

            /*
            |--------------------------------------------------------------------------
            | SIMPAN LOG
            |--------------------------------------------------------------------------
            */

            $this->simpanLog(
                request: $request,
                aksi: $aksi,
                siswa: $siswa
            );

        });

        return back()->with('success', $pesan);

    } catch (\Throwable $e) {

        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}


 private function generateTagihanCalonSiswa(
        Siswa $siswa,
        int $idTahun,
        ?int $idUser = null,
        ?string $ip = null
    ): array {
        $berhasil = 0;
        $gagal = 0;

        // Hindari tagihan ganda
        $sudahAda = Bayar::where('id_tahun', $idTahun)
            ->where('id_siswa', $siswa->nipd)
            ->exists();

        if ($sudahAda) {
            return [
                'success'   => true,
                'generated' => false,
                'berhasil'  => 0,
                'gagal'     => 0,
                'message'   => 'Tagihan calon siswa sudah tersedia.',
            ];
        }

        $bulan = (int) now()->format('m');

        $bayar = Bayar::create([
            'id_tahun'        => $idTahun,
            'id_bulan'        => $bulan,
            'id_siswa'        => $siswa->nipd,
        ]);

        $detailTemplate = DetTempBayar::query()
            ->where('id_template', $siswa->id_template_bayar)
            ->whereHas('itemBayar', function ($query) {
                $query->whereIn('id_kategori', [1,2,5]);
            })
            ->get();

        if ($detailTemplate->isEmpty()) {
            throw new \Exception(
                'Detail template pembayaran belum tersedia.'
            );
        }

        foreach ($detailTemplate as $item) {
            DetBayar::create([
                'id_bayar'        => $bayar->id,
                'id_item'         => $item->id_item,
                'kwajiban_bayar'  => $item->jml_bayar,
                'potongan'        => 0,
                'jml_bayar'       => 0,
            ]);

            $berhasil++;
        }

        $this->updateTotalBayar($bayar->id);

        LogModel::create([
            'tanggal'   => now(),
            'tabel'     => 'tb_bayar_regis',
            'aksi'      => 'create',
            'user'      => $idUser,
            'ip'        => $ip,
            'keterangan' => json_encode([
                'id_bayar'       => $bayar->id,
                'nipd'      => $siswa->nipd,
                'jumlah_detail'  => $berhasil,
            ]),
            'serial'    => url('pendaftaran/online'),
        ]);

        return [
            'success'   => true,
            'generated' => true,
            'berhasil'  => $berhasil,
            'gagal'     => $gagal,
            'id_bayar'  => $bayar->id,
            'message'   => 'Tagihan berhasil dibuat.',
        ];
    }

     public function updateTotalBayar($id)
    {
        $total = DetBayar::where('id_bayar', $id)
            ->sum('kwajiban_bayar')
            - DetBayar::where('id_bayar', $id)
            ->sum('potongan');

        Bayar::where('id', $id)
            ->update([
                'tot_kwajiban' => $total
            ]);
    }


    /**
     * Update data orang tua.
     */
    public function updateOrangTua(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_ayah'      => 'nullable|string|max:255',
            'id_kerja_ayah'  => 'nullable|integer',
            'alamat_ayah'    => 'nullable|string',
            'hp_ayah'        => 'nullable|string|max:20',

            'nama_ibu'       => 'nullable|string|max:255',
            'id_kerja_ibu'   => 'nullable|integer',
            'alamat_ibu'     => 'nullable|string',
            'hp_ibu'         => 'nullable|string|max:20',

            'nama_wali'      => 'nullable|string|max:255',
            'id_kerja_wali'  => 'nullable|integer',
            'alamat_wali'    => 'nullable|string',
            'hp_wali'        => 'nullable|string|max:20',
        ]);

        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->update($validated);

            $this->simpanLog(
                request: $request,
                aksi: 'update-orang-tua',
                siswa: $siswa
            );

            return back()->with(
                'success',
                'Data orang tua berhasil diperbarui.'
            );
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Upload foto dan dokumen siswa.
     */
    public function updateUpload(Request $request, $id)
    {
        $validated = $request->validate([
            'foto_siswa'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kk'              => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'akta_kelahiran'  => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'ijazah'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'raport'          => 'nullable|mimes:pdf|max:4096',
            'ktp_ayah'        => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp_ibu'         => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $siswa = Siswa::findOrFail($id);

            $fields = [
                'foto_siswa',
                'kk',
                'akta_kelahiran',
                'ijazah',
                'raport',
                'ktp_ayah',
                'ktp_ibu',
            ];

            $data = [];

            foreach ($fields as $field) {
                if (!$request->hasFile($field)) {
                    continue;
                }

                /*
                 * Hapus file lama jika tersedia.
                 */
                if (
                    !empty($siswa->{$field}) &&
                    Storage::disk('public')->exists($siswa->{$field})
                ) {
                    Storage::disk('public')->delete($siswa->{$field});
                }

                $file = $request->file($field);

                $namaFile = $field . '_' .
                    $siswa->id . '_' .
                    time() . '.' .
                    $file->getClientOriginalExtension();

                $path = $file->storeAs(
                    'uploads/siswa/' . $field,
                    $namaFile,
                    'public'
                );

                $data[$field] = $path;
            }

            if (empty($data)) {
                return back()->with(
                    'error',
                    'Tidak ada dokumen yang dipilih.'
                );
            }

            $siswa->update($data);

            $this->simpanLog(
                request: $request,
                aksi: 'update-upload',
                siswa: $siswa,
                keterangan: $data
            );

            DB::commit();

            return back()->with(
                'success',
                'Dokumen siswa berhasil diunggah.'
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Upload gagal: ' . $e->getMessage());
        }
    }

    /**
     * Update status aktif siswa.
     */


    /**
     * Hapus siswa dan akun user terkait.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $siswa = Siswa::findOrFail($id);

            /*
            * Simpan data lama untuk log.
            */

            $dataLama = $siswa->toArray();

            /*
            * Hapus detail pembayaran dan pembayaran siswa.
            *
            * Sesuaikan kolom id_siswa jika pada tabel pembayaran
            * menggunakan nipd atau nama kolom lainnya.
            */
            $pembayaran = Bayar::query()
                ->where('id_siswa', $siswa->nipd)
                ->get();

            foreach ($pembayaran as $bayar) {
                DetBayar::query()
                    ->where('id_bayar', $bayar->id)
                    ->delete();

                $bayar->delete();
            }

            /*
            * Hapus akun pengguna.
            */
            if (!empty($siswa->id_user)) {
                $user = User::find($siswa->id_user);

                if ($user) {
                    $user->syncRoles([]);
                    $user->delete();
                }
            }

            /*
            * Daftar dokumen siswa.
            */
            $fieldsDokumen = [
                'foto_siswa',
                'kk',
                'akta_kelahiran',
                'ijazah',
                'raport',
                'ktp_ayah',
                'ktp_ibu',
            ];

            /*
            * Simpan path file yang akan dihapus setelah transaksi berhasil.
            */
            $fileYangDihapus = [];

            foreach ($fieldsDokumen as $field) {
                if (!empty($siswa->{$field})) {
                    $fileYangDihapus[] = $siswa->{$field};
                }
            }

            /*
            * Hapus siswa.
            */
            $siswa->delete();

            /*
            * Simpan log.
            */
            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_siswa',
                'aksi'       => 'delete',
                'user'       => Auth::id(),
                'ip'         => request()->ip(),
                'keterangan' => json_encode($dataLama),
                'serial'     => url('siswa/' . $id),
            ]);

            DB::commit();

            /*
            * File dihapus setelah commit karena penghapusan file
            * tidak dapat dibatalkan oleh database transaction.
            */
            foreach ($fileYangDihapus as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data siswa dan pembayaran berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            report($e);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Validasi data utama siswa.
     */
    private function validateSiswa(
        Request $request,
        ?int $id = null
    ): array {
        return $request->validate([
            'id_user' => [
                'nullable',
                'integer',
                Rule::unique('tb_siswa', 'id_user')->ignore($id),
            ],

            'nipd' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tb_siswa', 'nipd')->ignore($id),
            ],

            'nisn' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('tb_siswa', 'nisn')->ignore($id),
            ],

            'nama_lengkap'   => 'required|string|max:255',
            'jk'             => 'nullable|in:L,P',
            'id_agama'       => 'nullable|integer',
            'tmp_lahir'      => 'nullable|string|max:100',
            'tgl_lahir'      => 'nullable|date',
            'alamat'         => 'nullable|string',
            'no_hp'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',

            'id_thn_ajaran'  => 'required|integer',
            'id_jurusan'     => 'nullable|integer',
            'id_kelas'       => 'required|integer',
            'angkatan'       => 'nullable|string|max:20',
            'semester'       => 'nullable|integer|min:1|max:6',
            'status'         => 'required|boolean',
        ]);
    }

    /**
     * Ambil master data untuk form siswa.
     */
    private function masterData(): array
    {
        return [
            'agama' => Agama::orderBy('nama_agama')->get(),

            'pekerjaan' => Pekerjaan::orderBy(
                'nama_pekerjaan'
            )->get(),

            'jurusan' => Jurusan::orderBy(
                'nama_jurusan'
            )->get(),

            'kelas' => Kelas::orderBy(
                'nama_kelas'
            )->get(),

            'tahunAjaran' => TahunAjaran::orderByDesc(
                'id'
            )->get(),
            'status_siswa' => DB::table('tb_sts_siswa')->orderBy('id', 'asc')->get(),
            'jobs' => Pekerjaan::orderBy('nama_pekerjaan', 'asc')->get()

        ];
    }

    /**
     * Simpan aktivitas ke tabel log.
     */
    private function simpanLog(
        Request $request,
        string $aksi,
        Siswa $siswa,
        ?array $keterangan = null
    ): void {
        LogModel::create([
            'tanggal'    => now(),
            'tabel'      => 'tb_siswa',
            'aksi'       => $aksi,
            'user'       => Auth::id(),
            'ip'         => $request->ip(),
            'keterangan' => json_encode(
                $keterangan ?? $siswa->toArray()
            ),
            'serial'     => url('siswa/' . $siswa->id),
        ]);
    }
}
