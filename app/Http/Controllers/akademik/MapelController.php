<?php

namespace App\Http\Controllers\Akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Jurusan;
use App\Models\KategoriMapel;
use App\Models\LogModel;

class MapelController extends Controller
{
    public function index()
    { 
        return view('akademik.mapel.index', [
            'side' => 'mapel',
            'kurikulum' =>  Mapel::select('kurikulum')->distinct()->orderBy('kurikulum')->get(),
            'jurusan' => Jurusan::orderBy('nama_jurusan')->get(),
            'kategori' => KategoriMapel::orderBy('no_kat')->get(),
        ]);
    }

    public function data(Request $request)
    {
        $query = Mapel::with([
            'jurusan',
            'kategoriMapel'
        ]);

        if ($request->filled('id_jurusan')) {

            $query->where(
                'id_jurusan',
                $request->id_jurusan
            );
        }

        if ($request->filled('kurikulum')) {

            $query->where(
                'kurikulum',
                $request->kurikulum
            );
        }

        if ($request->filled('keyword')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama_mapel',
                    'like',
                    '%' . $request->keyword . '%'
                );
            });
        }

        $data = $query
            ->orderBy('nama_mapel')
            ->get()
            ->map(function ($item) {

                return [

                    'id' => $item->id,

                    'nama_mapel' => $item->nama_mapel,

                    'id_jurusan' => $item->id_jurusan,

                    'jurusan' => $item->jurusan?->nama_jurusan,

                    'id_kategori_mapel' => $item->id_kategori_mapel,

                    'kategori' => $item->kategoriMapel?->nama_kategori_mapel,

                    'kurikulum' => $item->kurikulum,

                    'smt1' => $item->smt1,
                    'smt2' => $item->smt2,
                    'smt3' => $item->smt3,
                    'smt4' => $item->smt4,
                    'smt5' => $item->smt5,
                    'smt6' => $item->smt6,

                    'ket' => $item->ket,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $mapel = Mapel::create([

            'nama_mapel' => $request->nama_mapel,
            'id_jurusan' => $request->id_jurusan,
            'id_kategori_mapel' => $request->id_kategori_mapel,
            'kurikulum' => $request->kurikulum,

            'smt1' => $request->smt1,
            'smt2' => $request->smt2,
            'smt3' => $request->smt3,
            'smt4' => $request->smt4,
            'smt5' => $request->smt5,
            'smt6' => $request->smt6,

            'ket' => $request->ket,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_mapel',
            'aksi' => 'create',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($mapel),
            'serial' => url('mapel/store')
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $mapel->update([

            'nama_mapel' => $request->nama_mapel,
            'id_jurusan' => $request->id_jurusan,
            'id_kategori_mapel' => $request->id_kategori_mapel,
            'kurikulum' => $request->kurikulum,

            'smt1' => $request->smt1,
            'smt2' => $request->smt2,
            'smt3' => $request->smt3,
            'smt4' => $request->smt4,
            'smt5' => $request->smt5,
            'smt6' => $request->smt6,

            'ket' => $request->ket,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_mapel',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($mapel),
            'serial' => url('mapel/update/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);

        $mapel->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_mapel',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($mapel),
            'serial' => url('mapel/delete/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}