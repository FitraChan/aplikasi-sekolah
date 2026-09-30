<?php

namespace App\Http\Controllers\akademik;

use App\Http\Controllers\Controller;

use App\Models\TahunAjaran;
use App\Models\Konfig;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TahunAjaranController extends Controller
{
    public function index(): View
    {
        return view('akademik.tahun-ajaran.index', [
            'side' => 'tahun-ajaran',
        ]);
    }

    public function data(): JsonResponse
    {
        $data = TahunAjaran::query()
            ->select([
                'id',
                'thn_ajaran',
                'isaktiv',
            ])
            ->orderByDesc('id')
            ->get()
            ->map(function (TahunAjaran $item) {
                return [
                    'id'         => $item->id,
                    'thn_ajaran' => $item->thn_ajaran,
                    'isaktiv'    => (int) $item->isaktiv,
                ];
            });

        return response()->json($data);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'thn_ajaran' => [
                'required',
                'string',
                'max:20',
                'unique:tb_thn_ajaran,thn_ajaran',
            ],
            'isaktiv' => [
                'required',
                'boolean',
            ],
        ], [
            'thn_ajaran.required' => 'Tahun ajaran wajib diisi.',
            'thn_ajaran.unique'   => 'Tahun ajaran sudah tersedia.',
            'isaktiv.required'    => 'Status tahun ajaran wajib dipilih.',
        ]);

        /*
         * Apabila tahun ajaran yang disimpan aktif,
         * nonaktifkan tahun ajaran lainnya.
         */
        if ((int) $validated['isaktiv'] === 1) {
            TahunAjaran::query()->update([
                'isaktiv' => 0,
            ]);
        }

        $tahunAjaran = TahunAjaran::create([
            'thn_ajaran' => $validated['thn_ajaran'],
            'isaktiv'    => $validated['isaktiv'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tahun ajaran berhasil ditambahkan.',
            'data'    => $tahunAjaran,
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
{
    $tahunAjaran = TahunAjaran::findOrFail($id);

    $validated = $request->validate([
        'thn_ajaran' => [
            'required',
            'string',
            'max:20',
            'unique:tb_thn_ajaran,thn_ajaran,' . $tahunAjaran->id,
        ],
        'isaktiv' => [
            'required',
            'boolean',
        ],
        'smt' => [
            'nullable',
            'in:1,2',
        ],
    ], [
        'thn_ajaran.required' => 'Tahun ajaran wajib diisi.',
        'thn_ajaran.unique'   => 'Tahun ajaran sudah tersedia.',
        'isaktiv.required'    => 'Status tahun ajaran wajib dipilih.',
        'smt.in'              => 'Semester harus Ganjil atau Genap.',
    ]);

    DB::transaction(function () use ($validated, $tahunAjaran) {
        $isAktif = (int) $validated['isaktiv'];

        if ($isAktif === 1) {
            // Nonaktifkan semua tahun ajaran lainnya
            TahunAjaran::query()
                ->where('id', '!=', $tahunAjaran->id)
                ->update([
                    'isaktiv' => 0,
                ]);
        }

        // Update tahun ajaran yang dipilih
        $tahunAjaran->update([
            'thn_ajaran' => $validated['thn_ajaran'],
            'isaktiv'    => $isAktif,
        ]);

        // Jika tahun ajaran dijadikan aktif,
        // update konfigurasi tahun aktif
        if ($isAktif === 1) {
            $konfig = Konfig::query()->firstOrFail();

            $konfig->update([
                'id_tahun' => $tahunAjaran->id,
                'smt'      => $validated['smt'] ?? $konfig->smt,

                // Jika PPDB mengikuti tahun ajaran aktif:
                // 'id_thn_ppdb' => $tahunAjaran->id,
            ]);
        }
    });

    // Jika helper konfig() memakai Cache::rememberForever('konfig')

    return response()->json([
        'success' => true,
        'message' => 'Tahun ajaran berhasil diperbarui.',
        'data'    => $tahunAjaran->fresh(),
    ]);
}

    public function destroy(int $id): JsonResponse
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);

        /*
         * Cegah penghapusan jika sudah digunakan.
         */
        if (
            $tahunAjaran->calonSiswas()->exists() ||
            $tahunAjaran->gelombangs()->exists()
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Tahun ajaran tidak dapat dihapus karena sudah digunakan.',
            ], 422);
        }

        $tahunAjaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tahun ajaran berhasil dihapus.',
        ]);
    }
}