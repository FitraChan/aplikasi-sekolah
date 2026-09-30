<?php

namespace App\Http\Controllers\akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\LogModel;
use App\Models\Jurusan;


class KelasController extends Controller
{
     public function index()
    {
        return view('akademik.kelas.index', [
            'side' => 'kelas',
            'jurusan' => Jurusan::orderBy('nama_jurusan')->get()
        ]);
    }

    public function data()
    {
        $data = Kelas::with('jurusan')
            ->orderBy('idx')
            ->get()
            ->map(function ($item) {

                return [
                    'id'          => $item->id,
                    'nama_kelas'  => $item->nama_kelas,
                    'id_jurusan'  => $item->id_jurusan,
                    'jurusan'     => $item->jurusan?->nama_jurusan,
                    'kelas'       => $item->kelas,
                    'alias'       => $item->alias,
                    'idx'         => $item->idx,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_jurusan' => $request->id_jurusan,
            'kelas'      => $request->kelas,
            'alias'      => $request->alias,
            'idx'        => $request->idx,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_kelas',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($kelas),
            'serial' => url('kelas/store')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'id_jurusan' => $request->id_jurusan,
            'kelas'      => $request->kelas,
            'alias'      => $request->alias,
            'idx'        => $request->idx,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_kelas',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($kelas),
            'serial' => url('kelas/update/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_kelas',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($kelas),
            'serial' => url('kelas/delete/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
