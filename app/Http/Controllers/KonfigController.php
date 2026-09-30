<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konfig;
use App\Models\LogModel;

class KonfigController extends Controller
{
    public function index()
    {
        return view('konfig.index', [
            'side' => 'konfig'
        ]);
    }

    public function data()
    {
        return response()->json(
            Konfig::orderBy('id', 'desc')->get()
        );
    }
   
    public function update(Request $request, $id)
    {
        $konfig = Konfig::findOrFail($id);

        $konfig->update([
            'id_tahun'     => $request->id_tahun,
           // 'id_gelombang' => $request->id_gelombang,
            'smt'          => $request->smt,
            'id_thn_ppdb'  => $request->id_thn_ppdb,
        ]);

        LogModel::create([
            'tanggal'    => now(),
            'tabel'      => 'tb_konfig',
            'aksi'       => 'update',
            'user'       => auth()->user()->id,
            'ip'         => $request->ip(),
            'keterangan' => json_encode($konfig),
            'serial'     => url('konfig/update/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    
}