<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use App\Models\Konfig;

use Illuminate\Http\Request;
use App\Models\LogModel;



class GelombangController extends Controller
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
        return view('pendaftaran.gelombang.index', ['side'  => 'gelombang']);
    }

    public function data()
    {
        $data = Gelombang::withCount([
            // Semua pendaftar
            'calonSiswas',
            // Pendaftar yang sudah terverifikasi
            'calonSiswas as terverifikasi_count' => function ($query) {
                $query->where('status_daftar', 0);
            },
        ])
            ->where('id_tahun', $this->tahun)
            ->orderBy('id_tahun', 'desc')
            ->get()
            ->map(function ($item) {

                return [

                    'id' => $item->id,

                    'nama_gelombang' => $item->nama_gelombang,

                    'id_tahun' => $item->id_tahun,

                    'awal' => $item->awal,

                    'akhir' => $item->akhir,

                    'is_current' => $item->is_current,

                    'idx' => $item->idx,
                    'kuota' => $item->kuota,
                    // Semua pendaftar
                    'pendaftar' => $item->calon_siswas_count,

                    // status_daftar = 0
                    'terverifikasi' => $item->terverifikasi_count,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        Gelombang::create([
            'id_tahun' => $request->id_tahun,
            'nama_gelombang' => $request->nama_gelombang,
            'awal' => $request->awal,
            'akhir' => $request->akhir,
            'is_current' => $request->is_current,
            'idx' => $request->idx,
            'kuota' => $request->kuota,
        ]);
        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_gelombang',
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

    public function update(Request $request, $id)
    {
        $gelombang = Gelombang::findOrFail($id);

        $gelombang->update([
            'id_tahun' => $request->id_tahun,
            'nama_gelombang' => $request->nama_gelombang,
            'awal' => $request->awal,
            'akhir' => $request->akhir,
            'is_current' => $request->is_current,
            'idx' => $request->idx,
            'kuota' => $request->kuota,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_gelombang',
            'aksi' => 'update',
            'user' => auth()->user()->id,
            'ip' => $request->ip(),
            'keterangan' => json_encode($gelombang),
            'serial' => url('ubah/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();

        LogModel::create([
            'tanggal' => now(),
            'tabel' => 'tb_gelombang',
            'aksi' => 'delete',
            'user' => auth()->user()->id,
            'ip' => request()->ip(),
            'keterangan' => json_encode($gelombang),
            'serial' => url('hapus/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
