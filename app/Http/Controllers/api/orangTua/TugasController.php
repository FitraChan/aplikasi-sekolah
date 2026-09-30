<?php

namespace App\Http\Controllers\api\orangTua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\TransAjar;
use App\Models\DetTransAjar;
use App\Models\MasterJadwal;
use App\Models\PenjadwalanHari;


use Illuminate\Support\Facades\Log;
use App\Models\Konfig;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Throwable;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;





class TugasController extends Controller
{

    var $tahun, $smt;

    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_tahun;
        $this->smt = $konfig->smt;
    }

    private function siswa(): Siswa
    {
        return Siswa::where('id_user', auth()->id())->firstOrFail();
    }

    public function index(Quiz $quiz, TransAjar $transAjar, Nilai $nilai)
    {
        // $siswa = Siswa::where('id_user', auth()->id())->first();

        $siswa = $this->siswa();


        $mnilai = $nilai->where(['nipd' =>  $siswa->nipd])->where(DB::raw('idjadwal in (select id from tb_master_jadwal where id_tahun=' . $this->tahun . ' and semester=' . $this->smt . ')'), true)->get();
        $idjadwal = [];

        foreach ($mnilai as $row) {
            $idjadwal[] = $row->idjadwal;
        }

        $quiz = $quiz->whereIn('master_kelas_id', $idjadwal)->get();

        $jadwal = MasterJadwal::query()
            ->whereIn('id', $idjadwal)
            ->with([
                'mapel:id,nama_mapel',
                'transAjar' => function ($query) {
                    $query
                        ->whereNotNull('judul_tugas')
                        ->where('judul_tugas', '!=', '')
                        ->where('tgl_batas_submit', '>', now())
                        ->orderBy('tgl_batas_submit');
                },
            ])
            ->get();
        return response()->json([
            'success' => true,
            'quiz' => $quiz,
            'tugas' => $jadwal
        ]);
    }

    public function transkelas($id, TransAjar $transAjar, DetTransAjar $detTransAjar)
    {
        // $siswa = Siswa::where('id_user', auth()->id())->first();

        $isi = $transAjar->where('id', $id)->first();
        $menumateri = $transAjar->where('idjadwal', $isi->idjadwal)->select(['id', 'idjadwal', 'idpertemuan'])->get();
        $detTransAjar = $detTransAjar->where(['idtransajar' => $id, 'nipd' =>  $this->siswa()->nipd])->first();

        return response()->json([
            'success' => true,
            'menumateri' => $menumateri,
            'isi' => $isi,
            'detTransAjar' => $detTransAjar

        ]);
    }

    public function simpantugas(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'idtransajar'  => ['required', 'integer'],
            'jawaban_tugas' => ['nullable', 'string'],
            'file_jawaban' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:10240',
            ],
        ]);

        // $detail = DetTransAjar::where([
        //     'nipd'        => $this->siswa->nipd,
        //     'idtransajar' => $request->idtransajar,
        // ])->first();


        $jawaban = [
            'nipd' =>  $this->siswa()->nipd,
            'tgl_submit' => now(),
            'idtransajar' => $request->idtransajar,
            'jawaban_tugas' => $request->jawaban_tugas,
        ];

        //profile
        $filetugas = $request->file('file_jawaban');


        if ($filetugas != null) {

            $namaFile = time() . '_jawaban.' .
                $filetugas->getClientOriginalExtension();

            $filetugas->storeAs(
                'uploads/tugas',
                $namaFile,
                'public'
            );

            $jawaban['url_jawaban_1'] =  'storage/app/public/uploads/tugas/' . $namaFile;
        }

        $hasil = DetTransAjar::updateOrCreate(
            [
                'nipd'        => $this->siswa()->nipd,
                'idtransajar' => $request->idtransajar,
            ],
            $jawaban
        );

        return response()->json([
            'success' => true,
            'message' => 'Jawaban tugas berhasil disubmit.',
            'data'    => [
                'id'             => $hasil->id,
                'idtransajar'    => $hasil->idtransajar,
                'jawaban_tugas'  => $hasil->jawaban_tugas,
                'tgl_submit'     => $hasil->tgl_submit,
                'url_jawaban_1'  => $hasil->url_jawaban_1
                    ? asset('storage/' . $hasil->url_jawaban_1)
                    : null,
            ],
        ], 200);
    }

    public function jadwal()
    {
        try {
            $siswa = Siswa::query()
                ->where('id_user', auth()->id())
                ->first();

            if (!$siswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data siswa tidak ditemukan.',
                    'data' => [],
                ], 404);
            }

            if (!$siswa->id_kelas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Siswa belum memiliki kelas.',
                    'data' => [],
                ], 422);
            }

            $tahun = $this->tahun ?? null;
            $semester = $this->smt ?? null;

            if (!$tahun || !$semester) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tahun ajaran atau semester aktif belum dikonfigurasi.',
                    'data' => [],
                ], 422);
            }

            $idTahun = $this->tahun;
            $semester = $this->smt;

            $jadwal = PenjadwalanHari::query()
                ->join(
                    'tb_hari as hari',
                    'hari.id',
                    '=',
                    'tb_penjadwalan_hari.id_hari'
                )
                ->join(
                    'tb_jam_pelajaran as jam',
                    'jam.id',
                    '=',
                    'tb_penjadwalan_hari.id_jam'
                )
                ->leftJoin(
                    'v_master_jadwal as jadwal',
                    'tb_penjadwalan_hari.idpenjadwalan',
                    '=',
                    'jadwal.id'
                )
                ->leftJoin('tb_trans_ajar', 'tb_trans_ajar.idjadwal', '=', 'jadwal.id')
                ->where('jadwal.id_tahun', $idTahun)
                ->where('jadwal.id_kelas', $siswa->id_kelas)
                ->where('jadwal.angkatan', $siswa->id_thn_ajaran)
                ->where('jadwal.semester', $semester)
                ->selectRaw('
                        MAX(tb_penjadwalan_hari.id) AS id_penjadwalan_hari,
                        MAX(tb_penjadwalan_hari.idpenjadwalan) AS idpenjadwalan,
                        MAX(tb_penjadwalan_hari.id_hari) AS id_hari,
                        MAX(tb_penjadwalan_hari.id_jam) AS id_jam,

                        MAX(tb_trans_ajar.id) AS id_trans_ajar,

                        MAX(hari.nama_hari) AS nama_hari,
                        MAX(hari.urutan) AS urutan_hari,

                        MAX(jam.jam_awal) AS jam_awal,
                        MAX(jam.jam_akhir) AS jam_akhir,

                        MAX(jadwal.id) AS id_jadwal,
                        MAX(jadwal.id_tahun) AS id_tahun,
                        MAX(jadwal.id_kelas) AS id_kelas,
                        MAX(jadwal.angkatan) AS angkatan,
                        MAX(jadwal.semester) AS semester,
                        MAX(jadwal.id_mapel) AS id_mapel,
                        MAX(jadwal.nama_mapel) AS nama_mapel,
                        MAX(jadwal.id_gtk) AS id_gtk,
                        MAX(jadwal.nama_gtk) AS nama_gtk,
                        MAX(jadwal.nama_kelas) AS nama_kelas
                    ')
                ->orderBy('hari.urutan')
                ->orderBy('jam.jam_awal')
                ->groupBy('jadwal.id_mapel')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal siswa berhasil diambil.',
                'data' => $jadwal,
            ]);
        } catch (Throwable $e) {
            Log::error('Gagal mengambil jadwal siswa', [
                'user_id' => auth()->id(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' =>  $e->getMessage(),
                'data' => [],
            ], 500);
        }
    }
}
