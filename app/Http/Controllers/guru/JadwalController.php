<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\DetailQuiz;
use App\Models\MasterJadwal;
use App\Models\Gtk;
use App\Models\TransAjar;
use App\Models\Quiz;
use App\Models\LogModel;
use App\Models\JenisSoal;
use App\Models\Soal;
use App\Models\Nilai;
use App\Models\PenjadwalanHari;


class JadwalController extends Controller
{

    public function index()
    {
        $konfig = konfig();
        $smt = $konfig['smt'];

        $id_tahun = $konfig['id_tahun'];

        $idGtk = Gtk::where('user_id',auth()->user()->id)->first();

        $query = PenjadwalanHari::with(['jadwal','jam'])
                ->whereHas('jadwal', function ($q) use ($id_tahun, $smt,$idGtk) {
                $q->where('id_tahun', $id_tahun)
                ->where('semester', $smt)
                ->where('id_gtk',$idGtk->id);
            }) 
            ->orderBy('id_hari')
            ->orderBy('id_jam')
            ->get();


    $hari = [
        ['id' => 1, 'nama_hari' => 'Senin'],
        ['id' => 2, 'nama_hari' => 'Selasa'],
        ['id' => 3, 'nama_hari' => 'Rabu'],
        ['id' => 4, 'nama_hari' => 'Kamis'],
        ['id' => 5, 'nama_hari' => 'Jumat'],
        ['id' => 6, 'nama_hari' => 'Sabtu'],
        ['id' => 7, 'nama_hari' => 'Minggu'],
    ];


        return view('guru.jadwal.index', [
            'side'  => 'jadwalGuru',
            'thn'      => $id_tahun,
            'smt'      => $smt,
            'nama_gtk' => $idGtk->nama_gtk,
            'hari'     => $hari,
            'isi'      => $query,           
        ]);
    }

}
