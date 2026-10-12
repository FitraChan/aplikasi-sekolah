<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\JadwalWawancara;
use App\Models\CalonSiswa;
use App\Models\Gtk;
use App\Models\Konfig;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JadwalWawancaraController extends Controller
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
        return view('pendaftaran.jadwal-wawancara.index', [
            'side' => 'jadwal-wawancara'
        ]);
    }

    public function data(Request $request)
    {
        $query = JadwalWawancara::with([
            'calonSiswa:id,nama_lengkap,no_daftar,id_jurusan',
            'calonSiswa.jurusan:id,nama_jurusan',
            'gtk:id,nama_gtk',
        ]);

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter GTK
        if ($request->filled('id_gtk')) {
            $query->where('id_gtk', $request->id_gtk);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $gtk = Gtk::query()
            ->orderBy('nama_gtk')
            ->get([
                'id',
                'nama_gtk'
            ]);

        $calonSiswa = CalonSiswa::query()
            ->with('jurusan:id,nama_jurusan')
            ->where('id_thn_ajaran', $this->tahun)
            ->orderBy('nama_lengkap')
            ->get([
                'id',
                'no_daftar',
                'nama_lengkap',
                'id_jurusan'
            ]);

        return view('pendaftaran.jadwal-wawancara.tambah', [
            'gtk' => $gtk,
            'calonSiswa' => $calonSiswa,
            'side' => 'jadwal-wawancara'
        ]);
    }

    /**
     * Simpan jadwal
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_calon_siswa' => [
                    'required',
                    'integer',
                    'exists:tb_tmp_siswa,id',
                ],

                'id_gtk' => [
                    'required',
                    'integer',
                    'exists:tb_gtk,id',
                ],

                'tanggal' => [
                    'required',
                    'date',
                ],

                'jam_mulai' => [
                    'required',
                    'date_format:H:i',
                ],

                'jam_selesai' => [
                    'nullable',
                    'date_format:H:i',
                    'after:jam_mulai',
                ],

                'tempat' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'status' => [
                    'required',
                    Rule::in([
                        'terjadwal',
                        'selesai',
                        'batal',
                        'tidak_hadir',
                    ]),
                ],

                'catatan' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'id_calon_siswa.required' => 'Calon siswa wajib dipilih.',
                'id_calon_siswa.exists' => 'Calon siswa tidak ditemukan.',

                'id_gtk.required' => 'Pewawancara wajib dipilih.',
                'id_gtk.exists' => 'Pewawancara tidak ditemukan.',

                'tanggal.required' => 'Tanggal wawancara wajib diisi.',

                'jam_mulai.required' => 'Jam mulai wajib diisi.',
                'jam_selesai.after' => 'Jam selesai harus lebih besar dari jam mulai.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Cek apakah calon siswa sudah memiliki jadwal
        |--------------------------------------------------------------------------
        */

        $sudahAda = JadwalWawancara::where(
            'id_calon_siswa',
            $request->id_calon_siswa
        )
            ->where('status', '!=', 'batal')
            ->exists();

        if ($sudahAda) {
            return response()->json([
                'status' => false,
                'message' => 'Calon siswa tersebut sudah memiliki jadwal wawancara.'
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Cek bentrok jadwal pewawancara
        |--------------------------------------------------------------------------
        */

        $bentrok = $this->cekBentrok(
            $request
        );

        if ($bentrok) {
            return response()->json([
                'status' => false,
                'message' => 'Pewawancara sudah memiliki jadwal pada waktu tersebut.'
            ], 422);
        }

        $jadwal = JadwalWawancara::create([
            'id_calon_siswa' => $request->id_calon_siswa,
            'id_gtk' => $request->id_gtk,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tempat' => $request->tempat,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Jadwal wawancara berhasil disimpan.',
            'data' => $jadwal
        ]);
    }

    /**
     * Detail jadwal
     */
    public function show($id)
    {
        $jadwal = JadwalWawancara::with([
            'calonSiswa.jurusan',
            'gtk'
        ])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $jadwal
        ]);
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $jadwal = JadwalWawancara::findOrFail($id);

        $gtk = Gtk::query()
            ->orderBy('nama_gtk')

            ->get([
                'id',
                'nama_gtk'
            ]);

        $calonSiswa = CalonSiswa::query()
            ->with('jurusan:id,nama_jurusan')
            ->where('id_thn_ajaran', $this->tahun)
            ->orderBy('nama_lengkap')
            ->get([
                'id',
                'no_daftar',
                'nama_lengkap',
                'id_jurusan'
            ]);

        return view('pendaftaran.jadwal-wawancara.edit', [
            'jadwal' => $jadwal,
            'gtk' => $gtk,
            'calonSiswa' => $calonSiswa,
            'side' => 'jadwal-wawancara'
        ]);
    }

    /**
     * Update jadwal
     */
    public function update(Request $request, $id)
    {
        $jadwal = JadwalWawancara::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'id_calon_siswa' => [
                    'required',
                    'integer',
                    'exists:tb_tmp_siswa,id',
                ],

                'id_gtk' => [
                    'required',
                    'integer',
                    'exists:tb_gtk,id',
                ],

                'tanggal' => [
                    'required',
                    'date',
                ],

                'jam_mulai' => [
                    'required',
                    'date_format:H:i',
                ],

                'jam_selesai' => [
                    'nullable',
                    'date_format:H:i',
                    'after:jam_mulai',
                ],

                'tempat' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'status' => [
                    'required',
                    Rule::in([
                        'terjadwal',
                        'selesai',
                        'batal',
                        'tidak_hadir',
                    ]),
                ],

                'catatan' => [
                    'nullable',
                    'string',
                ],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Cek calon siswa
        |--------------------------------------------------------------------------
        */

        $sudahAda = JadwalWawancara::where(
            'id_calon_siswa',
            $request->id_calon_siswa
        )
            ->where('id', '!=', $jadwal->id)
            ->where('status', '!=', 'batal')
            ->exists();

        if ($sudahAda) {
            return response()->json([
                'status' => false,
                'message' => 'Calon siswa tersebut sudah memiliki jadwal wawancara.'
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Cek bentrok pewawancara
        |--------------------------------------------------------------------------
        */

        $bentrok = $this->cekBentrok(
            $request,
            $jadwal->id
        );

        if ($bentrok) {
            return response()->json([
                'status' => false,
                'message' => 'Pewawancara sudah memiliki jadwal pada waktu tersebut.'
            ], 422);
        }

        $jadwal->update([
            'id_calon_siswa' => $request->id_calon_siswa,
            'id_gtk' => $request->id_gtk,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tempat' => $request->tempat,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Jadwal wawancara berhasil diperbarui.',
            'data' => $jadwal
        ]);
    }

    /**
     * Hapus jadwal
     */
    public function destroy($id)
    {
        $jadwal = JadwalWawancara::findOrFail($id);

        $jadwal->delete();

        return response()->json([
            'status' => true,
            'message' => 'Jadwal wawancara berhasil dihapus.'
        ]);
    }

    /**
     * Cek bentrok jadwal GTK
     */
    private function cekBentrok(Request $request, $exceptId = null)
    {
        $jamMulai = $request->jam_mulai;
        $jamSelesai = $request->jam_selesai;


        if (!$jamSelesai) {
            $jamSelesai = date(
                'H:i',
                strtotime($jamMulai . ' + 1 hour')
            );
        }

        $query = JadwalWawancara::where(
            'id_gtk',
            $request->id_gtk
        )
            ->whereDate(
                'tanggal',
                $request->tanggal
            )
            ->where('status', '!=', 'batal');

        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }

        $query->where(function ($q) use ($jamMulai, $jamSelesai) {

            $q->where(function ($q) use ($jamMulai, $jamSelesai) {

                $q->where('jam_mulai', '<', $jamSelesai)
                    ->where(function ($q) use ($jamMulai) {

                        $q->whereNull('jam_selesai')
                            ->orWhere('jam_selesai', '>', $jamMulai);
                    });
            });
        });

        return $query->exists();
    }


    /** * Jadwal wawancara guru yang sedang login */ 
    public function jadwalGuru(Request $request)
    {
        $idGtk = auth()->user()->id;
        $guru = Gtk::where('user_id', $idGtk)->first();
        $query = JadwalWawancara::with(['calonSiswa:id,nama_lengkap,no_daftar,id_jurusan', 'calonSiswa.jurusan:id,nama_jurusan', 'gtk:id,nama_gtk',])->where('id_gtk', $idGtk)->where('status', '!=', 'batal');
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $data = $query->orderBy('tanggal')->orderBy('jam_mulai')->get();
        return view('guru.jadwal-wawancara.index', ['guru' => $guru, 'data' => $data, 'side' => 'jadwal-wawancara-guru',]);
    }

    public function dataJadwalGuru(Request $request)
    {
        $idUser = auth()->user()->id;

        $guru = Gtk::where('user_id', $idUser)->firstOrFail();

        $query = JadwalWawancara::with([
            'calonSiswa:id,nama_lengkap,no_daftar,id_jurusan',
            'calonSiswa.jurusan:id,nama_jurusan',
            'gtk:id,nama_gtk',
        ])
            ->where('id_gtk', $guru->id)
            ->where('status', '!=', 'batal');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return response()->json($data);
    }   


    public function testWawancara(Request $request)
    {


    }


    
}
