<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetTahun;
use App\Models\LogModel;
use App\Models\Jurusan;
use App\Models\TahunAjaran;

class TargetController extends Controller
{
    public function index()
    {
        return view('pendaftaran.target.index', [
            'side' => 'target',
            'jurusan' => Jurusan::orderBy('nama_jurusan')->get(),
            'tahunAjaran' => TahunAjaran::orderBy('thn_ajaran', 'desc')->get(),
        ]);
    }

    public function data()
    {
        $data = DetTahun::with([
                'tahunAjaran',
                'jurusan',
            ])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'id_thn_ajaran' => $item->id_thn_ajaran,
                    'id_jurusan'    => $item->id_jurusan,
                    'target'        => $item->target,
                    'pencapaian'    => $item->pencapaian,
                    'thn_ajaran'    => $item->tahunAjaran?->thn_ajaran,
                    'nama_jurusan'  => $item->jurusan?->nama_jurusan,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_thn_ajaran' => 'required|exists:tb_thn_ajaran,id',
            'id_jurusan'    => 'required|exists:tb_jurusan,id',
            'target'         => 'required|numeric|min:0',
            'pencapaian'     => 'nullable|numeric|min:0',
        ]);

        $target = DetTahun::create([
            'id_thn_ajaran' => $request->id_thn_ajaran,
            'id_jurusan'    => $request->id_jurusan,
            'target'         => $request->target,
            'pencapaian'     => $request->pencapaian ?? 0,
        ]);

        LogModel::create([
            'tanggal'    => now(),
            'tabel'      => 'tb_det_tahun',
            'aksi'       => 'create',
            'user'       => auth()->id(),
            'ip'         => $request->ip(),
            'keterangan' => json_encode($target),
            'serial'     => url('target/store'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data target berhasil ditambahkan.',
            'data'    => $target,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_thn_ajaran' => 'required|exists:tb_thn_ajaran,id',
            'id_jurusan'    => 'required|exists:tb_jurusan,id',
            'target'         => 'required|numeric|min:0',
            'pencapaian'     => 'nullable|numeric|min:0',
        ]);

        $target = DetTahun::findOrFail($id);

        $dataLama = $target->toArray();

        $target->update([
            'id_thn_ajaran' => $request->id_thn_ajaran,
            'id_jurusan'    => $request->id_jurusan,
            'target'         => $request->target,
            'pencapaian'     => $request->pencapaian ?? 0,
        ]);

        LogModel::create([
            'tanggal' => now(),
            'tabel'   => 'tb_det_tahun',
            'aksi'    => 'update',
            'user'    => auth()->id(),
            'ip'      => $request->ip(),
            'keterangan' => json_encode([
                'data_lama' => $dataLama,
                'data_baru' => $target->fresh()->toArray(),
            ]),
            'serial' => url('target/update/' . $id),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data target berhasil diperbarui.',
        ]);
    }

    public function destroy($id)
    {
        $target = DetTahun::findOrFail($id);

        $dataTarget = $target->toArray();

        $target->delete();

        LogModel::create([
            'tanggal'    => now(),
            'tabel'      => 'tb_det_tahun',
            'aksi'       => 'delete',
            'user'       => auth()->id(),
            'ip'         => request()->ip(),
            'keterangan' => json_encode($dataTarget),
            'serial'     => url('target/delete/' . $id),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data target berhasil dihapus.',
        ]);
    }
}