<?php

namespace App\Http\Controllers\api\orangTua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Http\JsonResponse;

class PengumumanController extends Controller
{
     public function index(Request $request): JsonResponse
        {
            $query = Pengumuman::query()
                ->with([
                    'target:id,pengumuman_id,target_type,target_id'
                ])
                ->where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('publish_at')
                        ->orWhere('publish_at', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('expired_at')
                        ->orWhere('expired_at', '>=', now());
                });

            if ($request->filled('kategori_id')) {
                $query->where(
                    'kategori_id',
                    $request->kategori_id
                );
            }

            if ($request->filled('prioritas')) {
                $query->where(
                    'prioritas',
                    $request->prioritas
                );
            }

            if ($request->filled('target_type')) {
                $query->whereHas('targets', function ($targetQuery) use ($request) {
                    $targetQuery->where(
                        'target_type',
                        $request->target_type
                    );
                });
            }

            $pengumuman = $query
                ->orderByDesc('is_pinned')
                ->orderByDesc('publish_at')
                ->orderByDesc('id')
                ->paginate(10);

            return response()->json([
                'success' => true,
                'message' => 'Data pengumuman berhasil diambil.',
                'data' => $pengumuman,
            ]);
        }

        public function show(int $id): JsonResponse
        {
            $pengumuman = Pengumuman::query()
                ->with([
                    'target:id,pengumuman_id,target_type,target_id'
                ])
                ->where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('publish_at')
                        ->orWhere('publish_at', '<=', now());
                })
                ->where(function ($query) {
                    $query->whereNull('expired_at')
                        ->orWhere('expired_at', '>=', now());
                })
                ->find($id);

            if (!$pengumuman) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengumuman tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail pengumuman berhasil diambil.',
                'data' => $pengumuman,
            ]);
        }
}

