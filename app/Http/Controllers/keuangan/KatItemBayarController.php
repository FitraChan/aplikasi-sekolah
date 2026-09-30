<?php

namespace App\Http\Controllers\keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KatItemBayar;
use Illuminate\Support\Facades\Auth;
use App\Models\LogModel;



class KatItemBayarController extends Controller
{
    public function index()
    {
        $side = 'kat-item-bayar';

        return view(
            'keuangan.kat_item_bayar.index',
            compact('side')
        );
    }

    public function data()
    {
        return response()->json(
            KatItemBayar::orderBy('id', 'asc')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        KatItemBayar::create([
            'nama_kategori' => $request->nama_kategori
        ]);
        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_kat_itembayar',
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

    public function edit($id)
    {
        return response()->json(
            KatItemBayar::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $row = KatItemBayar::findOrFail($id);

        $row->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_kat_itembayar',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($row),
            'serial' => url('ubah/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $katItemBayar = KatItemBayar::findOrFail($id);
        $katItemBayar->delete();
        
        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_kat_itembayar',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($katItemBayar),
            'serial' => url('hapus/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
