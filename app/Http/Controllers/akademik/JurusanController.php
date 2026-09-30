<?php

namespace App\Http\Controllers\akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\LogModel;

use App\Models\Konfig;
use App\Models\TahunAjaran;



class JurusanController extends Controller
{
    var $tahun, $smt;

    public function __construct()
    {
        $konfig = Konfig::first();
        $this->tahun = $konfig->id_tahun;
        $this->smt = $konfig->smt;
    }

    public function index()
    {

        $thn = TahunAjaran::where('id', $this->tahun)->first();
        return view('akademik.jurusan.index', [
            'tahun' =>  $thn->thn_ajaran,
            'side' => 'jurusan'
        ]);
    }

    // public function data()
    // {

    //     $tahun = $this->tahun;
    //     $data =  $data = Jurusan::withCount([
    //         'siswa as pendaftar_count' => function ($query) use ($tahun) {
    //             $query->where('id_thn_ajaran', $tahun);
    //         }
    //     ])
    //         ->orderBy('nama_jurusan')
    //         ->get()
    //         ->map(function ($item) {

    //             $target = (int) $item->jumlah_siswa;
    //             $pendaftar = (int) $item->calon_siswas_count;

    //             $persentase = $target > 0
    //                 ? round(($pendaftar / $target) * 100)
    //                 : 0;

    //             // Maksimal progress 100%
    //             $progress = min($persentase, 100);

    //             return [
    //                 'id' => $item->id,
    //                 'nama_jurusan' => $item->nama_jurusan,
    //                 'singkatan' => $item->singkatan,

    //                 // Target / kuota
    //                 'jumlah_siswa' => $target,

    //                 // Jumlah calon siswa
    //                 'pendaftar' => $pendaftar,

    //                 // Persentase
    //                 'persentase' => $persentase,
    //                 'progress' => $progress,
    //             ];
    //         });

    //     return response()->json($data);
    // }

    public function data()
    {
        $tahun = $this->tahun;

        $data = Jurusan::query()
            ->leftJoin('tb_siswa as siswa', function ($join) use ($tahun) {

                $join->on('siswa.id_jurusan', '=', 'tb_jurusan.id')
                    ->where('siswa.id_thn_ajaran', $tahun);

            })
        ->selectRaw('(tb_jurusan.id) as id')
        ->selectRaw('MAX(tb_jurusan.nama_jurusan) as nama_jurusan')
        ->selectRaw('MAX(tb_jurusan.singkatan) as singkatan')
        ->selectRaw('MAX(tb_jurusan.jumlah_siswa) as jumlah_siswa')
            ->selectRaw('COUNT(siswa.id) as pendaftar')
            ->selectRaw('
                ROUND(
                    COUNT(siswa.id) * 100.0 / tb_jurusan.jumlah_siswa
                ) as persentase
            ')
            ->selectRaw('
                    LEAST(
                        ROUND(
                            COUNT(siswa.id) * 100.0 / tb_jurusan.jumlah_siswa
                        ),
                        100
                    ) as progress
                ')
            ->groupBy(
                'tb_jurusan.id',
                
                'tb_jurusan.jumlah_siswa'
            )
            ->orderBy('tb_jurusan.nama_jurusan')
            ->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $jurusan = Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'jumlah_siswa' => $request->jumlah_siswa,
            'singkatan'    => $request->singkatan,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_jurusan',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($jurusan),
            'serial' => url('jurusan/store')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
            'jumlah_siswa' => $request->jumlah_siswa,
            'singkatan'    => $request->singkatan,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_jurusan',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($jurusan),
            'serial' => url('jurusan/update/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $jurusan->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_jurusan',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($jurusan),
            'serial' => url('jurusan/delete/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
