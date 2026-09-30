<?php

namespace App\Http\Controllers\akademik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\KategoriPengumuman;
use App\Models\TargetPengumuman;
use Illuminate\Support\Facades\DB;

use App\Models\LogModel;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('akademik.pengumuman.index', [
            'side' => 'pengumuman',
            'kategori' => KategoriPengumuman::where('is_active', 1)
                ->orderBy('nama')
                ->get()
        ]);
    }

    public function data()
    {
         $data = Pengumuman::with([
        'kategori',
        'target'
    ])
    ->orderByDesc('is_pinned')
    ->orderByDesc('publish_at')
    ->get()
    ->map(function ($item) {

        return [
            'id'           => $item->id,
            'kategori_id'  => $item->kategori_id,
            'kategori'     => $item->kategori?->nama,
            'judul'        => $item->judul,
            'isi'          => $item->isi,
            'prioritas'    => $item->prioritas,
            'status'       => $item->status,
            'publish_at'   => $item->publish_at,
            'expired_at'   => $item->expired_at,
            'is_pinned'    => $item->is_pinned,
            'lampiran'     => $item->lampiran,

            'target_type'  => $item->target?->target_type,
            'target_id'    => $item->target?->target_id,
        ];
    });

    return response()->json($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $lampiran = null;

            if ($request->hasFile('lampiran')) {
                $lampiran = $request->file('lampiran')
                    ->store('pengumuman', 'public');
            }

            $pengumuman = Pengumuman::create([
                'kategori_id' => $request->kategori_id,
                'judul'       => $request->judul,
                'isi'         => $request->isi,
                'prioritas'   => $request->prioritas,
                'status'      => $request->status,
                'publish_at'  => $request->publish_at ?: null,
                'expired_at'  => $request->expired_at ?: null,
                'is_pinned'   => $request->is_pinned ?? 0,
                'lampiran'    => $lampiran,
                'created_by'  => auth()->id(),
            ]);

            TargetPengumuman::create([
                'pengumuman_id' => $pengumuman->id,
                'target_type'   => $request->target_type,
                'target_id'     => $request->target_id ?: null,
            ]);

            LogModel::create([
                'tanggal'    => now(),
                'tabel'      => 'tb_pengumuman',
                'aksi'       => 'create',
                'user'       => auth()->id(),
                'ip'         => $request->ip(),
                'keterangan' => json_encode($pengumuman),
                'serial'     => url('pengumuman/store')
            ]);

            DB::commit();

            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $data = [
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'prioritas'   => $request->prioritas,
            'status'      => $request->status,
            'publish_at'  => $request->publish_at,
            'expired_at'  => $request->expired_at,
            'is_pinned'   => $request->is_pinned ?? 0,
        ];

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')
                ->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        LogModel::create([
            'tanggal'    => now(),
            'tabel'      => 'tb_pengumuman',
            'aksi'       => 'update',
            'user'       => auth()->id(),
            'ip'         => $request->ip(),
            'keterangan' => json_encode($pengumuman),
            'serial'     => url('pengumuman/update/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->delete();

        LogModel::create([
            'tanggal'    => now(),
            'tabel'      => 'tb_pengumuman',
            'aksi'       => 'delete',
            'user'       => auth()->id(),
            'ip'         => request()->ip(),
            'keterangan' => json_encode($pengumuman),
            'serial'     => url('pengumuman/delete/' . $id)
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}