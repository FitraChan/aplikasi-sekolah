<?php

namespace App\Http\Controllers\api\orangTua;

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

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
          $auth = auth()->id();

        $isi = Absensi::query()
        ->from('tb_hadir_siswa as hs')
        ->join('tb_siswa as s', 's.nipd', '=', 'hs.nipd')
        ->join('tb_trans_ajar as ta', 'ta.id', '=', 'hs.idtransajar')
        ->join('tb_master_jadwal as mj', 'mj.id', '=', 'ta.idjadwal')
        ->leftJoin('tb_mapel as m', 'm.id', '=', 'mj.id_mapel')
        ->selectRaw("
            MIN(hs.id) AS id,
            hs.nipd AS nipd,
            s.nama_lengkap AS nama_siswa,
            mj.id_mapel AS id_mapel,
            m.nama_mapel AS mapel,

            COALESCE(MAX(CASE WHEN ta.idpertemuan = 1 THEN hs.sts_hadir END), '-') AS p1,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 2 THEN hs.sts_hadir END), '-') AS p2,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 3 THEN hs.sts_hadir END), '-') AS p3,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 4 THEN hs.sts_hadir END), '-') AS p4,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 5 THEN hs.sts_hadir END), '-') AS p5,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 6 THEN hs.sts_hadir END), '-') AS p6,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 7 THEN hs.sts_hadir END), '-') AS p7,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 8 THEN hs.sts_hadir END), '-') AS p8,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 9 THEN hs.sts_hadir END), '-') AS p9,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 10 THEN hs.sts_hadir END), '-') AS p10,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 11 THEN hs.sts_hadir END), '-') AS p11,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 12 THEN hs.sts_hadir END), '-') AS p12,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 13 THEN hs.sts_hadir END), '-') AS p13,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 14 THEN hs.sts_hadir END), '-') AS p14,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 15 THEN hs.sts_hadir END), '-') AS p15,
            COALESCE(MAX(CASE WHEN ta.idpertemuan = 16 THEN hs.sts_hadir END), '-') AS p16
        ")
        ->where('s.id_user', $auth)
        ->groupBy(
            'hs.nipd',
            's.nama_lengkap',
            'mj.id_mapel',
            'm.nama_mapel'
        )
        ->orderBy('m.nama_mapel', 'ASC')
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'nipd' => $item->nipd,
                'nama_siswa' => $item->nama_siswa,
                'id_mapel' => $item->id_mapel,
                'mapel' => $item->mapel,
                'pertemuan' => [
                    'p1' => $item->p1,
                    'p2' => $item->p2,
                    'p3' => $item->p3,
                    'p4' => $item->p4,
                    'p5' => $item->p5,
                    'p6' => $item->p6,
                    'p7' => $item->p7,
                    'p8' => $item->p8,
                    'p9' => $item->p9,
                    'p10' => $item->p10,
                    'p11' => $item->p11,
                    'p12' => $item->p12,
                    'p13' => $item->p13,
                    'p14' => $item->p14,
                    'p15' => $item->p15,
                    'p16' => $item->p16,
                ],
            ];
        });

    return response()->json([
        'success' => true,
        'data' => $isi,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
