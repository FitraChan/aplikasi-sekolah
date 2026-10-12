<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\TahunAjaran;
use App\Models\Agama;
use App\Models\ItemBayar;
use App\Models\Pekerjaan;
use App\Models\StatusDaftar;
use App\Models\IpaymuBayar;
use App\Models\User;
use App\Models\BuktiBayarCalon;
use App\Models\Siswa;
use App\Models\Bayar;
use App\Models\DetBayar;

use App\Models\Konfig;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\BayarCalonSiswa;
use App\Models\DetBayarCalonSiswa;




class CalonSiswaController extends Controller
{

     var $tahun, $smt;
  
    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_thn_ppdb;
        $this->smt = $konfig->smt;
      
    }

    public function index()
    {
        $side = 'calon-siswa';
        $tahunSekarang = $this->tahun;

        $gelombang = Gelombang::where('id_tahun', $tahunSekarang)
            ->orderBy('id', 'asc')
            ->get();

       $tahunAjaran = TahunAjaran::whereBetween('id', [
                        $tahunSekarang - 3,
                        $tahunSekarang
                    ])
                    ->orderBy('id', 'desc')
                    ->get();


        $jurusan = Jurusan::all();

        return view('pendaftaran.calon_siswa.index', compact(
            'side',
            'gelombang',
            'jurusan',
            'tahunAjaran'
        ), ['side'  => 'calon-siswa']);
    }


    public function daftarCalonSiswa()
    {
        $side = 'daftar-ulang';

        $tahunSekarang = $this->tahun;

        $gelombang = Gelombang::where('id_tahun', $tahunSekarang)
            ->orderBy('id', 'asc')
            ->get();
        $tahunAjaran = TahunAjaran::whereBetween('id', [
                        $tahunSekarang - 3,
                        $tahunSekarang
                    ])
                    ->orderBy('id', 'desc')
                    ->get();

        $jurusan = Jurusan::all();

        return view('pendaftaran.calon_siswa.index', compact(
            'side',
            'gelombang',
            'tahunAjaran',
            'jurusan'
        ), ['side'  => 'daftar-ulang']);
    }



    public function create()
    {
        $side = 'calon-siswa';

        $rows = new CalonSiswa();

        // $rows = CalonSiswa::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */

        $gel = Gelombang::orderBy('idx', 'asc')->get();

        $itemBayar = ItemBayar::where('id_kategori', 2)
            ->get();

        $thn = TahunAjaran::orderBy('id', 'desc')->get();

        $lists = Jurusan::orderBy('nama_jurusan', 'asc')->get();

        $jobs = Pekerjaan::orderBy('nama_pekerjaan', 'asc')->get();
        $agama = Agama::orderBy('nama_agama', 'asc')->get();

        $sts_daftar = StatusDaftar::orderBy('keterangan', 'asc')->get();

        $bukti = CalonSiswa::with('buktiPembayaran')
            ->where('id_user', Auth::id())
            ->get();

        // $petugas = User::orderBy('name', 'asc')->get();

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */
        $dataIpaymu = '';

        $stsdaftar =
            'Belum Ada';

        return view(
            'pendaftaran.calon_siswa.edit_calon_siswa',
            compact(
                'side',
                'rows',
                'dataIpaymu',
                'gel',
                'thn',
                'lists',
                'jobs',
                'agama',
                'sts_daftar',
                // 'petugas',
                'stsdaftar',
                'bukti',
                'itemBayar'
            )
        );
    }

    public function edit($id)
    {
        $side = 'calon-siswa';

        $rows = CalonSiswa::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | MASTER DATA
        |--------------------------------------------------------------------------
        */
        $gel = Gelombang::orderBy('idx', 'asc')->get();
        $thn = TahunAjaran::orderBy('id', 'desc')->get();
        $lists = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        $jobs = Pekerjaan::orderBy('nama_pekerjaan', 'asc')->get();
        $agama = Agama::orderBy('nama_agama', 'asc')->get();
        $sts_daftar = StatusDaftar::orderBy('keterangan', 'asc')->get();

        $dataIpaymu = IpaymuBayar::with([
            'detailBayar',
            'calonSiswa'
        ])->where('id_calon_siswa', $id)->first();



        $bukti = CalonSiswa::with('buktiPembayaran')
            ->where('id', $id)
            ->get();

        $itemBayar = ItemBayar::where('id_kategori', 2)
            ->get();
        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */
        $stsdaftar =
            $rows->statusDaftar->keterangan
            ?? 'Belum Ada';
        return view(
            'pendaftaran.calon_siswa.edit_calon_siswa',
            compact(
                'side',
                'rows',
                'gel',
                'thn',
                'lists',
                'jobs',
                'agama',
                'sts_daftar',
                'stsdaftar',
                'bukti',
                'itemBayar',
                'dataIpaymu'
            )
        );
    }

    public function editCalonSiswa()
    {
        $side = 'calon-siswa';
        $rows = CalonSiswa::where('id_user', Auth::id())
            ->firstOrFail();
        $itemBayar = ItemBayar::where('id_kategori', 2)
            ->get();
        $gel = Gelombang::orderBy('idx', 'asc')->get();
        $thn = TahunAjaran::orderBy('id', 'desc')->get();
        $lists = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        $jobs = Pekerjaan::orderBy('nama_pekerjaan', 'asc')->get();
        $agama = Agama::orderBy('nama_agama', 'asc')->get();
        $sts_daftar = StatusDaftar::orderBy('keterangan', 'asc')->get();
        $bukti = CalonSiswa::with('buktiPembayaran')
            ->where('id_user', Auth::id())
            ->get();
        $stsdaftar = $rows->statusDaftar->keterangan ?? 'Belum Ada';
        return view(
            'pendaftaran.calon_siswa.edit_calon_siswa',
            compact(
                'side',
                'rows',
                'gel',
                'thn',
                'lists',
                'jobs',
                'agama',
                'sts_daftar',
                'stsdaftar',
                'itemBayar',
                'bukti'
            )
        );
    }

    public function daftarSiswa()
    {

        $data = CalonSiswa::with([
            'tahunAjaran',
            'jurusan',
            'kelas'
        ])

            ->whereHas('tahunAjaran', function ($query) {

                $query->where('isaktiv', 1);
            })

            ->get();

        return view('pendaftaran.calon_siswa.daftar_siswa', compact(
            'data'
        ), [
            'side' => 'daftar-siswa'
        ]);
    }

    public function data(Request $request)
    {
        $query = CalonSiswa::query()
            ->with([
                'gelombang',
                'jurusan',
                'tahunAjaran',
                'statusDaftar',
            ]);
        // ->whereHas('tahunAjaran', function ($q) {
        //     $q->where('isaktiv', 1);
        // });

        /*
        * Filter nama atau nomor daftar.
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('no_daftar', 'like', "%{$search}%");
            });
        }

        /*
        * Filter tahun ajaran.
        */
        if ($request->filled('id_thn_ajaran')) {
            $query->where(
                'id_thn_ajaran',
                $request->id_thn_ajaran
            );
        }

        /*
        * Filter jurusan.
        */
        if ($request->filled('id_jurusan')) {
            $query->where(
                'id_jurusan',
                $request->id_jurusan
            );
        }

        /*
        * Filter gelombang.
        */
        if ($request->filled('id_gelombang')) {
            $query->where(
                'id_gelombang',
                $request->id_gelombang
            );
        }

        $data = $query
            ->latest('id')
            ->get()
            ->map(function ($item) {
                return [
                    'id'              => $item->id,
                    'nama_lengkap'    => $item->nama_lengkap,
                    'jk'              => $item->jk,
                    'nisn'            => $item->nisn,
                    'no_hp'           => $item->no_hp,
                    'no_daftar'       => $item->no_daftar,
                    'status_daftar_id' => $item->status_daftar,

                    'status_daftar'   => $item->statusDaftar?->keterangan ?? '-',

                    'nama_jurusan'    => $item->jurusan?->nama_jurusan ?? '-',
                    'nama_gelombang'  => $item->gelombang?->nama_gelombang ?? '-',
                    'tahun_ajaran'    => $item->tahunAjaran?->thn_ajaran ?? '-',

                    'id_thn_ajaran'   => $item->id_thn_ajaran,
                    'id_jurusan'      => $item->id_jurusan,
                    'id_gelombang'    => $item->id_gelombang,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $siswa = CalonSiswa::create($request->all());

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_calon_siswa',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($request->all()),
            'serial' => url('simpan')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function updateRegistrasiSiswa(Request $request, $id = null)
    {


        try {
            $request->validate([


                /*

                
            |--------------------------------------------------------------------------
            | INFORMASI PENDAFTARAN
            |--------------------------------------------------------------------------
            */
                'id_gelombang'      => 'nullable',
                'id_thn_ajaran'     => 'nullable',
                'id_jurusan'        => 'nullable',
                'no_daftar'         => 'nullable|string|max:100',
                'tgl_daftar'        => 'nullable|date',
                'tmp_daftar'        => 'nullable|string|max:255',
                'status_daftar'     => 'nullable',

                /*
            |--------------------------------------------------------------------------
            | BIODATA SISWA
            |--------------------------------------------------------------------------
            */
                'nama_lengkap'      => 'nullable|string|max:255',
                'jk'                => 'nullable|string|max:1',
                'id_agama'          => 'nullable',
                'tmp_lahir'         => 'nullable|string|max:255',
                'tgl_lahir'         => 'nullable|date',
                'alamat'            => 'nullable|string',
                'dusun'             => 'nullable|string|max:255',
                'desa'              => 'nullable|string|max:255',
                'kecamatan'         => 'nullable|string|max:255',
                'kota'              => 'nullable|string|max:255',
                'provinsi'          => 'nullable|string|max:255',
                'no_hp'             => 'nullable|string|max:20',
                'no_telp'           => 'nullable|string|max:20',
                'email'             => 'nullable|email|max:255',
            ]);

            /*
        |--------------------------------------------------------------------------
        | CEK EDIT / TAMBAH
        |--------------------------------------------------------------------------
        */

            if (!empty($id)) {
                // UPDATE
                $siswa = CalonSiswa::findOrFail($id);
                // status sudah ujian dan melakukan daftar ulang
                if ($siswa->status_daftar == 3) {

                    $siswa->update([
                        'status_daftar' => 4,
                    ]);
                }
            } else {

                // TAMBAH
                $siswa = new CalonSiswa();
            }



            /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA
        |--------------------------------------------------------------------------
        */

            if (auth()->user()->hasAnyRole(['admin', 'Akademik'])) {
                $siswa->id_gelombang  = $request->id_gelombang;
                $siswa->id_thn_ajaran = $request->id_thn_ajaran;
                $siswa->id_jurusan    = $request->id_jurusan;
                $siswa->status_daftar     = $request->status_daftar;
            }
            $siswa->no_daftar         = $request->no_daftar;
            $siswa->tgl_daftar        = $request->tgl_daftar;
            $siswa->tmp_daftar        = $request->tmp_daftar;


            $siswa->nama_lengkap      = $request->nama_lengkap;
            $siswa->jk                = $request->jk;
            $siswa->id_agama          = $request->id_agama;
            $siswa->tmp_lahir         = $request->tmp_lahir;
            $siswa->tgl_lahir         = $request->tgl_lahir;
            $siswa->alamat            = $request->alamat;
            $siswa->dusun             = $request->dusun;
            $siswa->desa              = $request->desa;
            $siswa->kecamatan         = $request->kecamatan;
            $siswa->kota              = $request->kota;
            $siswa->provinsi          = $request->provinsi;
            $siswa->no_hp             = $request->no_hp;
            $siswa->no_telp           = $request->no_telp;
            $siswa->email             = $request->email;
            $siswa->save();

            /*
        |--------------------------------------------------------------------------
        | RESPONSE
        |--------------------------------------------------------------------------
        */

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_calon_siswa',
                'aksi' => !empty($id) ? 'update' : 'create',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($siswa),
                'serial' => !empty($id) ? url('ubah/' . $id) : url('simpan')
            ]);

            if ($id != null) {

                $message = 'Data registrasi & biodata siswa berhasil diperbarui';
            } else {

                $message = 'Data registrasi & biodata siswa berhasil ditambahkan';
            }



            if (auth()->user()->hasRole('calon')) {
                return redirect()
                    ->route('calon-siswa.profil')
                    ->with('success', $message);
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {

            print_r($e->getMessage());
            // return redirect()
            //     ->back()
            //     ->withInput()
            //     ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }


    public function updateUpload(Request $request, $id)
    {
        try {

            $request->validate([

                'foto_siswa'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

                'kk'               => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

                'akta_kelahiran'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

                'ijazah'           => 'nullable|mimes:pdf|max:4096',

                //sudo  'raport'           => 'nullable|mimes:pdf|max:4096',

                // 'ktp_ayah'         => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

                // 'ktp_ibu'          => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',

            ]);

            $rows = CalonSiswa::where('id', $id)->first();
            // jika sudah ikut ujian
            if ($rows->status_daftar == 3) {

                $rows->update([
                    'status_daftar' => 4,
                ]);
            }

            if (!$rows) {

                return redirect()
                    ->back()
                    ->with('error', 'Data tidak ditemukan');
            }

            $data = [];

            /*
        |--------------------------------------------------------------------------
        | FOTO SISWA
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('foto_siswa')) {

                $file = $request->file('foto_siswa');

                $namaFile = time() . '_foto.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/foto_siswa',
                    $namaFile,
                    'public'
                );

                $data['foto_siswa'] =
                    'uploads/foto_siswa/' . $namaFile;
            }

            /*
        |--------------------------------------------------------------------------
        | KK
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('kk')) {

                $file = $request->file('kk');

                $namaFile = time() . '_kk.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/kk',
                    $namaFile,
                    'public'
                );

                $data['kk'] =
                    'uploads/kk/' . $namaFile;
            }

            /*
        |--------------------------------------------------------------------------
        | AKTA
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('akta_kelahiran')) {

                $file = $request->file('akta_kelahiran');

                $namaFile = time() . '_akta.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/akta',
                    $namaFile,
                    'public'
                );

                $data['akta_kelahiran'] =
                    'uploads/akta/' . $namaFile;
            }

            /*
        |--------------------------------------------------------------------------
        | IJAZAH
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('ijazah')) {

                $file = $request->file('ijazah');

                $namaFile = time() . '_ijazah.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/ijazah',
                    $namaFile,
                    'public'
                );

                $data['ijazah'] =
                    'uploads/ijazah/' . $namaFile;
            }

            /*
        |--------------------------------------------------------------------------
        | RAPORT
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('raport')) {

                $file = $request->file('raport');

                $namaFile = time() . '_raport.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/raport',
                    $namaFile,
                    'public'
                );

                $data['raport'] =
                    'uploads/raport/' . $namaFile;
            }

            /*
        |--------------------------------------------------------------------------
        | KTP AYAH
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('ktp_ayah')) {

                $file = $request->file('ktp_ayah');

                $namaFile = time() . '_ktp_ayah.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/ktp_ayah',
                    $namaFile,
                    'public'
                );

                $data['ktp_ayah'] =
                    'uploads/ktp_ayah/' . $namaFile;
            }

            /*
        |--------------------------------------------------------------------------
        | KTP IBU
        |--------------------------------------------------------------------------
        */

            if ($request->hasFile('ktp_ibu')) {

                $file = $request->file('ktp_ibu');

                $namaFile = time() . '_ktp_ibu.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/ktp_ibu',
                    $namaFile,
                    'public'
                );

                $data['ktp_ibu'] =
                    'uploads/ktp_ibu/' . $namaFile;
            }

            $data['updated_at'] = now();

            CalonSiswa::where('id', $id)
                ->update($data);


            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_calon_siswa',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($data),
                'serial' => url('ubah-upload/' . $id)
            ]);

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Upload dokumen berhasil'
                );
        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function pembayaran(Request $request, $id)
    {

        try {

            DB::beginTransaction();

            $data = [];

            if ($request->hasFile('bukti_transfer')) {

                $file = $request->file('bukti_transfer');

                $namaFile = time() . '_bukti_transfer.' .
                    $file->getClientOriginalExtension();

                $file->storeAs(
                    'uploads/pembayaran',
                    $namaFile,
                    'public'
                );

                $data['bukti_transfer'] = 'uploads/pembayaran/' . $namaFile;
            }

            $data['updated_at'] = now();

            DB::table('tb_bukti_bayar_calon')->insert([
                'id_calon_siswa' => $id,
                'bukti_transfer' => $data['bukti_transfer'] ?? null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_bukti_bayar_calon',
                'aksi' => 'insert',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($data),
                'serial' => url('pembayaran/' . $id),
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Upload dokumen berhasil');
        } catch (\Exception $e) {

            DB::rollBack();
            
            // Simpan log error
            Log::error('Upload bukti transfer gagal', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Upload dokumen gagal. ' . $e->getMessage());
        }
    }


    public function updateOrangTua(Request $request, $id)
    {
        try {

            $request->validate([
                'nama_ayah'             => 'nullable|string|max:255',
                'pekerjaan_ayah'        => 'nullable',
                'alamat_ayah'           => 'nullable|string',
                'hp_ayah'               => 'nullable|string|max:20',
                //'tahu_smk_dari_mana'    => 'nullable|string|max:255',
            ]);

            $siswa = CalonSiswa::findOrFail($id);



            // jika sudah ikut ujian
            if ($siswa->status_daftar == 3) {

                $siswa->update([
                    'status_daftar' => 4,
                ]);
            }


            $siswa->update([
                'nama_ayah'             => $request->nama_ayah,
                'id_kerja_ayah'         => $request->pekerjaan_ayah,
                'alamat_ayah'           => $request->alamat_ayah,
                'hp_ayah'               => $request->hp_ayah,
                //'tahu_smk_dari_mana'    => $request->tahu_smk_dari_mana,
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_calon_siswa',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($siswa),
                'serial' => url('ubah-orangtua/' . $id)
            ]);

            return back()->with('success', 'Data orang tua berhasil diupdate');
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    public function updateRegistrasi(Request $request, $id)
    {
        try {

            $request->validate([
                'sekolah_asal'              => 'nullable|string|max:255',
                'alamat_sekolah_asal'       => 'nullable|string',
                'kabupaten_sekolah_asal'    => 'nullable|string|max:255',
                'provinsi_sekolah_asal'     => 'nullable|string|max:255',
            ]);

            $siswa = CalonSiswa::findOrFail($id);

            // jika sudah ikut ujian
            if ($siswa->status_daftar == 3) {

                $siswa->update([
                    'status_daftar' => 4,
                ]);
            }


            $siswa->update([
                'nama_sekolah_asal'     => $request->sekolah_asal,
                'alamat_sekolah_asal'   => $request->alamat_sekolah_asal,
                'kab_sekolah'           => $request->kabupaten_sekolah_asal,
                'prov_sekolah'          => $request->provinsi_sekolah_asal,
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_calon_siswa',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($siswa),
                'serial' => url('ubah-registrasi/' . $id)
            ]);

            return back()->with('success', 'Data sekolah berhasil diupdate');
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $request->validate([
                'status_daftar' => 'required',
            ]);

            $siswa = CalonSiswa::findOrFail($id);

            $siswa->update([
                'status_daftar' => $request->status_daftar,
            ]);

            LogModel::create([
                'tanggal' => now(),
                'tabel' => 'tb_calon_siswa',
                'aksi' => 'update',
                'user' => auth()->user()->id,
                'ip' => $request->ip(),
                'keterangan' => json_encode($siswa),
                'serial' => url('ubah-status/' . $id)
            ]);

            return redirect()
                ->back()
                ->with('success', 'Status siswa berhasil diperbarui');
        } catch (\Exception $e) {


            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat update status');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $calonSiswa = CalonSiswa::findOrFail($id);

            $user = User::find($calonSiswa->id_user);

            if ($user) {

                // Hapus semua role user
                $user->syncRoles([]);

                // Hapus user
                $user->delete();
            }

            $calonSiswa->delete();

            LogModel::create([
                'tanggal'     => now(),
                'tabel'       => 'tb_calon_siswa',
                'aksi'        => 'delete',
                'user'        => auth()->id(),
                'ip'          => request()->ip(),
                'keterangan'  => json_encode($calonSiswa),
                'serial'      => url('hapus/' . $id)
            ]);

            DB::commit();

            return response()->json([
                'success' => true
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function saveDaftarSiswa(Request $request)
    {
        $validated = $request->validate([
            'id_cawa'       => ['required', 'integer', 'exists:tb_tmp_siswa,id'],
            'status_daftar' => ['nullable', 'integer'],
        ]);

        try {
            DB::transaction(function () use ($validated, $request) {

                /*
                * 1. Ambil calon siswa.
                */
                $calonSiswa = CalonSiswa::query()
                    ->whereKey($validated['id_cawa'])
                    ->lockForUpdate()
                    ->firstOrFail();

                /*
                * 2. Cegah pemindahan siswa dua kali.
                */
                $siswaSudahAda = Siswa::query()
                    ->where('id_cawa', $calonSiswa->id)
                    ->exists();

                if ($siswaSudahAda) {
                    throw new \Exception(
                        'Data calon siswa sudah pernah dipindahkan ke data siswa.'
                    );
                }

                /*
                * 3. Salin tb_tmp_siswa ke tb_siswa.
                */
                $siswa = Siswa::create([
                    'id_cawa'             => $calonSiswa->id,
                    'no_daftar'           => $calonSiswa->no_daftar,
                    'nipd'                => $request->nipd,
                    'no_registrasi_ulang' => $calonSiswa->no_registrasi_ulang,
                    'no_kwitansi'         => $calonSiswa->no_kwitansi,
                    'tmp_daftar'          => $calonSiswa->tmp_daftar,
                    'id_petugas'          => $calonSiswa->id_petugas,

                    'nama_lengkap'        => $calonSiswa->nama_lengkap,
                    'nama_panggilan'      => $calonSiswa->nama_panggilan,
                    'jk'                  => $calonSiswa->jk,
                    'nisn'                => $calonSiswa->nisn,
                    'nik'                 => $calonSiswa->nik,
                    'tmp_lahir'           => $calonSiswa->tmp_lahir,
                    'tgl_lahir'           => $calonSiswa->tgl_lahir,
                    'id_agama'            => $calonSiswa->id_agama,

                    'alamat'              => $calonSiswa->alamat,
                    'desa'                => $calonSiswa->desa,
                    'kecamatan'           => $calonSiswa->kecamatan,
                    'kota'                => $calonSiswa->kota,
                    'provinsi'            => $calonSiswa->provinsi,

                    'no_hp'               => $calonSiswa->no_hp,
                    'email'               => $calonSiswa->email,

                    'nama_ayah'           => $calonSiswa->nama_ayah,
                    'id_kerja_ayah'       => $calonSiswa->id_kerja_ayah,
                    'alamat_ayah'         => $calonSiswa->alamat_ayah,
                    'hp_ayah'             => $calonSiswa->hp_ayah,

                    'nama_ibu'            => $calonSiswa->nama_ibu,
                    'id_kerja_ibu'        => $calonSiswa->id_kerja_ibu,
                    'hp_ibu'              => $calonSiswa->hp_ibu,

                    'nama_wali'           => $calonSiswa->nama_wali,
                    'id_kerja_wali'       => $calonSiswa->id_kerja_wali,
                    'hp_wali'             => $calonSiswa->hp_wali,

                    'tgl_masuk'           => $calonSiswa->tgl_masuk,
                    'id_jurusan'          => $calonSiswa->id_jurusan,
                    'nama_sekolah_asal'   => $calonSiswa->nama_sekolah_asal,
                    'tgl_registrasi'      => $calonSiswa->tgl_registrasi,

                    'id_template_bayar'   => $calonSiswa->id_template_bayar,
                    'id_kelas'            => $calonSiswa->id_kelas,
                    'kelas_id'            => $calonSiswa->kelas_id,
                    'id_gelombang'        => $calonSiswa->id_gelombang,
                    'jns_kelas'           => $calonSiswa->jns_kelas,
                    'id_thn_ajaran'       => $calonSiswa->id_thn_ajaran,

                    'password'            => $calonSiswa->password,
                    'id_user'             => $calonSiswa->id_user,

                    'sts_siswa'           => 1,
                    'is_aktif'            => 1,

                    'foto_siswa'          => $calonSiswa->foto_siswa,
                    'image'               => $calonSiswa->foto_siswa,
                    'kk'                  => $calonSiswa->kk,
                    'akta_kelahiran'      => $calonSiswa->akta_kelahiran,
                    'ijazah'              => $calonSiswa->ijazah,
                    'raport'              => $calonSiswa->raport,
                    'ktp_ayah'            => $calonSiswa->ktp_ayah,
                    'ktp_ibu'             => $calonSiswa->ktp_ibu,
                ]);

                /*
                * 4. Ambil seluruh pembayaran calon siswa.
                */
                $pembayaranRegis = BayarCalonSiswa::query()
                    ->where('id_calon_siswa', $calonSiswa->no_daftar)
                    ->orderBy('id')
                    ->get();

                /*
                * 5. Salin setiap tb_bayar_regis ke tb_bayar.
                */
                foreach ($pembayaranRegis as $bayarRegis) {

                    /*
                    * Sesuaikan foreign key siswa pada model Bayar.
                    * Contoh ini menggunakan id_siswa.
                    */
                    $bayar = Bayar::create([
                        'id_siswa'     => $request->nipd,
                        'id_tahun'     => $bayarRegis->id_tahun,
                        'id_bulan'     => $bayarRegis->id_bulan,
                        'tgl_bayar'    => $bayarRegis->tgl_bayar,
                        'jam_bayar'    => $bayarRegis->jam_bayar,
                        'id_kasir'     => $bayarRegis->id_kasir,
                        'no_kwitansi'  => $bayarRegis->no_kwitansi,
                        'keterangan'   => $bayarRegis->keterangan,
                        'tot_bayar'    => $bayarRegis->tot_bayar,
                        'tot_kwajiban' => $bayarRegis->total_kwajiban
                    ]);

                    /*
                    * 6. Ambil detail pembayaran registrasi.
                    */
                    $detailRegis = DetBayarCalonSiswa::query()
                        ->where('id_bayar', $bayarRegis->id)
                        ->get();

                    /*
                    * 7. Salin tb_det_bayar_regis ke tb_det_bayar.
                    */
                    foreach ($detailRegis as $detail) {
                        DetBayar::create([
                            'id_bayar'   => $bayar->id,
                            'id_item'    => $detail->id_item,
                            'jml_bayar'  => $detail->jml_bayar,
                            'id_cicilan' => $detail->id_cicilan ?? null,
                            'sisa_bayar' => $detail->sisa_bayar,
                            'kwajiban_bayar' =>  $detail->kwajiban_bayar,
                            'potongan' => $detail->potongan,
                        ]);
                    }
                }

                /*
                * 8. Ubah status calon siswa.
                */
                $calonSiswa->update([
                    'status_daftar' => $validated['status_daftar'] ?? 1,
                ]);
            });

            return response()->json([
                'success' => true,
                'title'   => 'Berhasil',
                'message' => 'Data calon siswa dan pembayaran berhasil dipindahkan.',
            ]);
        } catch (\Throwable $e) {

            Log::error('Gagal memindahkan calon siswa', [
                'id_cawa' => $request->id_cawa,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'title'   => 'Gagal',
                'message' => $e->getMessage(),
            ], 422);
        }
    }



    public function generateNipd()
    {
        $nipdSiswa = Siswa::query()
            ->whereNotNull('nipd')
            ->whereRaw("nipd REGEXP '^[0-9]+$'")
            ->orderByDesc('id')
            ->value('nipd');

        $nipdCalon = CalonSiswa::query()
            ->whereNotNull('nipd')
            ->whereRaw("nipd REGEXP '^[0-9]+$'")
            ->orderByDesc('id')
            ->value('nipd');

        $nomorTerakhir = max(
            (int) $nipdSiswa,
            (int) $nipdCalon
        );

        $nomorBaru = $nomorTerakhir + 1;

        if ($nomorBaru > 9999) {
            return response()->json([
                'success' => false,
                'nipd'    => str_pad($nomorTerakhir, 4, '0', STR_PAD_LEFT),
                'message' => 'NIPD 4 digit sudah mencapai batas maksimum.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'nipd'    => str_pad(
                $nomorBaru,
                4,
                '0',
                STR_PAD_LEFT
            ),
        ]);
    }

    public function pembayaranCalonSiswa()
    {

        $side = 'pembayaranCalonSiswa';

        $itemBayar = ItemBayar::where('id_kategori', 2)
            ->get();

        $cs = CalonSiswa::where('id_user', Auth::id())->first();
        $hasil = DB::table('tb_bayar_regis')
            ->join('tb_det_bayar_regis', 'tb_bayar_regis.id', '=', 'tb_det_bayar_regis.id_bayar')
            ->join('tb_itembayar', 'tb_det_bayar_regis.id_item', '=', 'tb_itembayar.id')
            ->select(
                'tb_bayar_regis.id_calon_siswa',
                'tb_det_bayar_regis.id_item',
                'tb_itembayar.nama_item',
                DB::raw('SUM(tb_bayar_regis.tot_bayar) as SUMT1'),
                DB::raw('SUM(tb_bayar_regis.total_kwajiban) as SUMK1'),
                DB::raw('SUM(tb_det_bayar_regis.jml_bayar) as SUMB'),
                DB::raw('SUM(tb_det_bayar_regis.kwajiban_bayar) as SUMK2'),
                DB::raw('SUM(tb_det_bayar_regis.potongan) as SUMP')
            )
            ->where('tb_bayar_regis.id_calon_siswa', $cs->no_daftar)
            ->groupBy(
                'tb_bayar_regis.id_calon_siswa',
                'tb_det_bayar_regis.id_item',
                'tb_itembayar.nama_item'
            )
            ->orderBy('tb_det_bayar_regis.id_item')
            ->get();

        $nama = $cs->nama_lengkap;
        $id = $cs->id;

        $profile = DB::table('tb_profile')->first();

        //$data = compact('hasil', 'atas', 'profile');

        return view('pendaftaran.calon_siswa.pembayaran', compact(
            'side',
            'hasil',
            'nama',
            'itemBayar',
            'id',
           
            'profile'
        ), ['side'  => 'pembayaranCalonSiswa']);
    }

    public function listBuktiPembayaran()
    {
        $data = BuktiBayarCalon::with([
            'calonSiswa',
        ])->where('status', 1)
        ->latest('id')
        ->get();

           return view('keuangan.bayar_calon_siswa.listBuktiBayar', compact(
            'data',           
        ), ['side'  => 'bukti']);

        //return view('keuangan.bayar_calon_siswa.listBuktiBayar', compact('data'));
    }
}
