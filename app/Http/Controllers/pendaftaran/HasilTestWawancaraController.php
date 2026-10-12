<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\HasilWawancara;
use App\Models\Konfig;
use Illuminate\Http\Request;

class HasilTestWawancaraController extends Controller
{
    protected $tahun;
    protected $smt;

    public function __construct()
    {
        $konfig = Konfig::first();

        $this->tahun = $konfig->id_thn_ppdb;
        $this->smt = $konfig->smt;
    }

    /**
     * Halaman daftar hasil wawancara
     */
    public function index()
    {
        return view('pendaftaran.hasil-wawancara.index', [
            'tahun' => $this->tahun,
            'smt' => $this->smt,
            'side' => 'hasil-wawancara',
        ]);
    }

    /**
     * Data hasil wawancara untuk Tabulator
     */
    public function data(Request $request)
{
    $query = HasilWawancara::with([
        'calonSiswa:id,nama_lengkap,no_daftar,id_jurusan',
        'calonSiswa.jurusan:id,nama_jurusan',
        'gtk:id,nama_gtk',
        'jurusan:id,nama_jurusan',
    ]);

    if ($request->filled('search')) {

        $search = $request->search;

        $query->whereHas('calonSiswa', function ($q) use ($search) {

            $q->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('no_daftar', 'like', "%{$search}%");

        });
    }

    if ($request->filled('status')) {

        $query->where(
            'status_lulus',
            $request->status
        );
    }

    if ($request->filled('id_jurusan')) {

        $query->where(
            'id_jurusan_rekomendasi',
            $request->id_jurusan
        );
    }

    $data = $query
        ->orderByDesc('id')
        ->get();

    return response()->json([
        'data' => $data,

        'statistik' => [
            'total' => $data->count(),

            'lulus' => $data
                ->where('status_lulus', 'Lulus')
                ->count(),

            'tidak_lulus' => $data
                ->where('status_lulus', 'Tidak Lulus')
                ->count(),

            'cadangan' => $data
                ->where('status_lulus', 'Cadangan')
                ->count(),

            'rata_rata' => round(
                $data->avg('nilai_akhir') ?? 0,
                2
            ),
        ],
    ]);
}

    /**
     * Detail hasil wawancara
     */
    public function show($id)
    {
        $hasil = HasilWawancara::with([
            'calonSiswa',
            'calonSiswa.jurusan',
            'gtk',
            'jadwalWawancara',
            'jurusan',
        ])->findOrFail($id);

        return view('pendaftaran.hasil-wawancara.show-hasil-wawancara', [
            'hasil' => $hasil,
            'tahun' => $this->tahun,
            'smt' => $this->smt,
            'side' => 'hasil-wawancara',
        ]);
    }
}