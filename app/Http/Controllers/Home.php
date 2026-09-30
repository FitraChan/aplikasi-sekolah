<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetTahun;
use App\Models\Konfig;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    var $tahun_ppdb, $smt;
  
    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun_ppdb = $konfig->id_thn_ppdb;
        $this->smt = $konfig->smt;

      
    }
  public function index()
  {
    //SELECT  id_thn_ajaran,id_jurusan,nama_jurusan, target, thn_ajaran,
   $data = DetTahun::query()
    ->with([
        'tahunAjaran:id,thn_ajaran',
        'jurusan:id,nama_jurusan',
    ])
    ->withCount([

        // Belum bayar pendaftaran
        'calonSiswa as jml_daftar' => function ($query) {
            $query
                ->whereColumn(
                    'tb_tmp_siswa.id_jurusan',
                    'tb_det_tahun.id_jurusan'
                )
                ->whereColumn(
                    'tb_tmp_siswa.id_thn_ajaran',
                    'tb_det_tahun.id_thn_ajaran'
                )
                ->where('tb_tmp_siswa.status_daftar', -1);
        },

        // Sudah bayar pendaftaran
        'calonSiswa as jml_bayar' => function ($query) {
            $query
                ->whereColumn(
                    'tb_tmp_siswa.id_jurusan',
                    'tb_det_tahun.id_jurusan'
                )
                ->whereColumn(
                    'tb_tmp_siswa.id_thn_ajaran',
                    'tb_det_tahun.id_thn_ajaran'
                )
                ->where('tb_tmp_siswa.status_daftar', 0);
        },

        // Daftar ulang
        'calonSiswa as jml_regis' => function ($query) {
            $query
                ->whereColumn(
                    'tb_tmp_siswa.id_jurusan',
                    'tb_det_tahun.id_jurusan'
                )
                ->whereColumn(
                    'tb_tmp_siswa.id_thn_ajaran',
                    'tb_det_tahun.id_thn_ajaran'
                )
                ->whereIn('tb_tmp_siswa.status_daftar', [4]);
        },

        // Batal
        'calonSiswa as jml_batal' => function ($query) {
            $query
                ->whereColumn(
                    'tb_tmp_siswa.id_jurusan',
                    'tb_det_tahun.id_jurusan'
                )
                ->whereColumn(
                    'tb_tmp_siswa.id_thn_ajaran',
                    'tb_det_tahun.id_thn_ajaran'
                )
                ->where('tb_tmp_siswa.status_daftar', 2);
        },

        // Siswa
        'calonSiswa as jml_siswa' => function ($query) {
            $query
                ->whereColumn(
                    'tb_tmp_siswa.id_jurusan',
                    'tb_det_tahun.id_jurusan'
                )
                ->whereColumn(
                    'tb_tmp_siswa.id_thn_ajaran',
                    'tb_det_tahun.id_thn_ajaran'
                )
                ->where('tb_tmp_siswa.status_daftar', 1);
        },

    ])
    ->where(
        'id_thn_ajaran',
        konfig()['id_thn_ppdb']
    )
    ->get()
    ->groupBy('id_jurusan')
    ->map(function ($items) {

        $first = $items->first();

        return [
            'id_thn_ajaran' => $first->id_thn_ajaran,
            'id_jurusan'    => $first->id_jurusan,
            'thn_ajaran'    => $first->tahunAjaran?->thn_ajaran,
            'nama_jurusan'  => $first->jurusan?->nama_jurusan,

            'target' => $items->sum('target'),

            'jml_daftar' => $items->sum('jml_daftar'),

            'jml_bayar' => $items->sum('jml_bayar'),

            'jml_regis' => $items->sum('jml_regis'),

            'jml_batal' => $items->sum('jml_batal'),

            'jml_siswa' => $items->sum('jml_siswa'),
        ];
    })
    ->values();



    $bayarSiswa = DB::table('tb_bayar')
      ->join(
        'tb_det_bayar',
        'tb_bayar.id',
        '=',
        'tb_det_bayar.id_bayar'
      )
      ->leftJoin(
        'tb_itembayar',
        'tb_det_bayar.id_item',
        '=',
        'tb_itembayar.id'
      )
      ->leftJoin(
        'tb_thn_ajaran',
        'tb_thn_ajaran.id',
        '=',
        'tb_bayar.id_tahun'
      )
      ->selectRaw('
        tb_bayar.id_tahun AS id_tahun,
        MAX(tb_thn_ajaran.thn_ajaran) AS thn_ajaran,
        MAX(tb_itembayar.nama_item) AS nama_item,
        SUM(tb_bayar.tot_bayar) AS SUMT1,
        SUM(tb_bayar.tot_kwajiban) AS SUMK1,
        SUM(tb_det_bayar.jml_bayar) AS SUMB,
        SUM(tb_det_bayar.kwajiban_bayar) AS SUMK2,
        SUM(tb_det_bayar.potongan) AS SUMP,
         COUNT(DISTINCT CASE
            WHEN tb_bayar.tot_bayar = 0
            THEN tb_bayar.id_siswa
        END) AS jml_belum_bayar
       
    ')
      ->groupBy('tb_bayar.id_tahun');


    $bayarRegistrasi = DB::table('tb_bayar_regis')
      ->leftJoin(
        'tb_det_bayar_regis',
        'tb_bayar_regis.id',
        '=',
        'tb_det_bayar_regis.id_bayar'
      )
      ->leftJoin(
        'tb_itembayar',
        'tb_det_bayar_regis.id_item',
        '=',
        'tb_itembayar.id'
      )
      ->leftJoin(
        'tb_thn_ajaran',
        'tb_thn_ajaran.id',
        '=',
        'tb_bayar_regis.id_tahun'
      )
      ->selectRaw('
        tb_bayar_regis.id_tahun AS id_tahun,
        MAX(tb_thn_ajaran.thn_ajaran) AS thn_ajaran,
        MAX(tb_itembayar.nama_item) AS nama_item,
        SUM(tb_bayar_regis.tot_bayar) AS SUMT1,
        SUM(tb_bayar_regis.total_kwajiban) AS SUMK1,
        SUM(tb_det_bayar_regis.jml_bayar) AS SUMB,
        SUM(tb_det_bayar_regis.kwajiban_bayar) AS SUMK2,
        SUM(tb_det_bayar_regis.potongan) AS SUMP,
         COUNT(DISTINCT CASE
            WHEN tb_bayar_regis.tot_bayar = 0
            THEN tb_bayar_regis.id_calon_siswa
        END) AS jml_belum_bayar
    ')
      ->groupBy('tb_bayar_regis.id_tahun');
    $union = $bayarSiswa->unionAll($bayarRegistrasi);

    $hasil = DB::query()
      ->fromSub($union, 'pembayaran')
      ->selectRaw('
        id_tahun,
        MAX(thn_ajaran) AS thn_ajaran,
        MAX(nama_item) AS nama_item,
        SUM(SUMT1) AS SUMT1,
        SUM(SUMK1) AS SUMK1,
        SUM(SUMB) AS SUMB,
        SUM(SUMK2) AS SUMK2,
        SUM(SUMP) AS SUMP,
        SUM(jml_belum_bayar) as jml_belum_bayar
    ')
      ->groupBy('id_tahun')
      ->orderByDesc('id_tahun')
      ->get();

      $thn = $this->tahun_ppdb;

// Detail daftar


//  Belum Bayar Pendaftaran
$jdaftar = DB::table('tb_tmp_siswa')
    ->selectRaw('COUNT(id) AS jumlah')
    ->where('id_thn_ajaran', $thn)  
    ->where('status_daftar', -1)
    ->first();



// sudah bayar pendaftaran
$daftar = DB::table('tb_tmp_siswa')
    ->selectRaw('COUNT(id) AS jumlah')
    ->where('id_thn_ajaran', $thn)   
    ->where('status_daftar', 0)
    ->first();

// Jumlah  Daftar Ulang
$jregis = DB::table('tb_tmp_siswa')
    ->selectRaw('COUNT(id) AS jumlah')
    ->where('id_thn_ajaran', $thn)
    ->whereIn('status_daftar', [4])
    ->first();

    $jsis = DB::table('tb_tmp_siswa')
    ->selectRaw('COUNT(id) AS jumlah')
    ->where('id_thn_ajaran', $thn)
    ->where('status_daftar', 1)
    ->first();

    $thn = TahunAjaran::where('id',$this->tahun_ppdb)->first();


    return view('dashboard', [
      'data' => $data,
      'hasil' => $hasil,
      'jdaftar' => $jdaftar,
      'daftar' => $daftar,
      'siswa' => $jsis,
      'jregis' => $jregis,
      'thn_ajaran' => $thn->thn_ajaran,
    ])->with(['drop_down' => null, 'side' => 'admin']);;

    // return response()->json($data);

  }
}
