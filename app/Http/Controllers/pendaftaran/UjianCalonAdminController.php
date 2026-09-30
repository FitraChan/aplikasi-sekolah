<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\UjianCalon;
use App\Models\UjianPesertaCalon;

use App\Models\Gelombang;
use App\Models\TahunAjaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UjianCalonAdminController extends Controller
{
    public function index(): View
    {           
        $side = 'ujian-calon-siswa';
        $data = UjianCalon::query()
            ->withCount(['soal', 'peserta'])
            ->latest()
            ->paginate(10);            
        return view('pendaftaran.ujian.index', compact('data','side'), ['side'  => 'ujian-calon-siswa']);
    }

    public function create(): View
    {
        return view('pendaftaran.ujian.create-ujian-admin');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_ujian' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal_mulai' => ['nullable', 'date'],
           // 'id_gelombang' => ['nullable', 'integer'],

            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
            'durasi' => ['required', 'integer', 'min:1'],
            'nilai_minimal' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $gel = Gelombang::where('is_current',1)->first();

        $validated['acak_soal'] = $request->boolean('acak_soal');
        $validated['tampil_hasil'] = $request->boolean('tampil_hasil');
        $validated['status'] = $request->boolean('status');
        $validated['id_gelombang'] = $gel->id;



        UjianCalon::create($validated);

        return redirect()
            ->route('ujianCalonAdmin.index')
            ->with('success', 'Ujian berhasil dibuat.');
    }

    public function edit(UjianCalon $ujianCalonAdmin): View
    {

    $gelombang = Gelombang::select('id', 'nama_gelombang')
        ->orderByDesc('id')
        ->get();        return view('pendaftaran.ujian.edit-ujian-admin', [
            'ujian' => $ujianCalonAdmin,
            'gelombang' => $gelombang
        ]);
    }

    public function update(
        Request $request,
        UjianCalon $ujianCalonAdmin
    ): RedirectResponse {
        $validated = $request->validate([
            'nama_ujian' => ['required', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
            'id_gelombang' => ['nullable', 'integer'],
            'tanggal_mulai' => ['nullable', 'date'],
            'tanggal_selesai' => [
                'nullable',
                'date',
                'after_or_equal:tanggal_mulai',
            ],
            'durasi' => ['required', 'integer', 'min:1'],
            'nilai_minimal' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $validated['acak_soal'] = $request->boolean('acak_soal');
        $validated['tampil_hasil'] = $request->boolean('tampil_hasil');
        $validated['status'] = $request->boolean('status');

        $ujianCalonAdmin->update($validated);

        return redirect()
            ->route('ujianCalonAdmin.index')
            ->with('success', 'Ujian berhasil diperbarui.');
    }

    public function hapus($id): RedirectResponse
{
    $ujian = UjianCalon::findOrFail($id);

    $ujian->delete();

    return redirect()
        ->route('ujianCalonAdmin.index')
        ->with('success', 'Ujian berhasil dihapus.');
}

    public function jawabanPeserta(
    UjianCalon $ujianCalonAdmin,
    UjianPesertaCalon $peserta
    ): View {
        abort_if(
            (int) $peserta->id_ujian !== (int) $ujianCalonAdmin->id,
            404
        );

        $peserta->load([
            'calonSiswa',
            'jawaban.soal',
        ]);

        return view('pendaftaran.ujian.jawaban-peserta-admin', [
            'ujian'   => $ujianCalonAdmin,
            'peserta' => $peserta,
            'jawaban' => $peserta->jawaban,
            'side'    => 'ujian-calon-siswa',
        ]);
    }

     public function peserta(UjianCalon $ujianCalonAdmin): View
    {
        $data = UjianPesertaCalon::query()
            ->where('id_ujian', $ujianCalonAdmin->id)
            ->with('calonSiswa')
            ->withCount('jawaban')
            ->latest('id')
            ->paginate(20);

        return view('pendaftaran.ujian.peserta-ujian-admin', [
            'ujian' => $ujianCalonAdmin,
            'data'  => $data,
            'side'  => 'ujian-calon-siswa',
        ]);
    }
}