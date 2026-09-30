<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\UjianCalon;
use App\Models\UjianSoalCalon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UjianSoalCalonController extends Controller
{
    public function index($id): View
    {
        $ujian = UjianCalon::findOrFail($id);

        $soal = UjianSoalCalon::where('id_ujian', $ujian->id)
            ->latest('id')
            ->paginate(20);

        return view(
            'pendaftaran.ujian.soal',
            compact('ujian', 'soal')
        );
    }

    public function create(UjianCalon $ujian): View
    {
        return view('pendaftaran.ujian.tambah-soal', compact('ujian'));
    }

    public function store(
    Request $request,
    UjianCalon $ujian
): RedirectResponse {

$idUjian = $request->query('ujian');


    $validated = $request->validate([
        'pertanyaan' => ['required', 'string'],
        'pilihan_a' => ['required', 'string'],
        'pilihan_b' => ['required', 'string'],
        'pilihan_c' => ['required', 'string'],
        'pilihan_d' => ['required', 'string'],
        'pilihan_e' => ['nullable', 'string'],
        'jawaban_benar' => ['required', 'in:A,B,C,D,E'],
        'bobot' => ['required', 'numeric', 'min:0.01'],
    ]);



    $validated['id_ujian'] = $idUjian;
    $validated['status'] = $request->boolean('status');

    UjianSoalCalon::create($validated);

   return redirect()
    ->route('soalCalon.index', ['id' => $idUjian])
    ->with('success', 'Soal berhasil ditambahkan.');
}

 public function update(
    Request $request,
    UjianSoalCalon $soal
): RedirectResponse {
    $validated = $request->validate([
        'pertanyaan' => ['required', 'string'],
        'pilihan_a' => ['required', 'string'],
        'pilihan_b' => ['required', 'string'],
        'pilihan_c' => ['required', 'string'],
        'pilihan_d' => ['required', 'string'],
        'pilihan_e' => ['nullable', 'string'],
        'jawaban_benar' => ['required', 'in:A,B,C,D,E'],
        'bobot' => ['required', 'numeric', 'min:0.01'],
    ]);

    $validated['status'] = $request->boolean('status');

    $soal->update($validated);

    return redirect()
        ->route('soalCalon.index', [
            'id' => $soal->id_ujian,
        ])
        ->with('success', 'Soal berhasil diperbarui.');
}

    // public function edit(
    //     UjianCalon $ujian,
    //     UjianSoalCalon $soal
    // ): View {
    //     abort_if($soal->id_ujian !== $ujian->id, 404);

    //     return view(
    //         'admin.ujian-soal.edit',
    //         compact('ujian', 'soal')
    //     );
    // }

    public function edit(UjianSoalCalon $soal): View
    {
        $ujian = $soal->ujian;

        return view(
            'pendaftaran.ujian.edit-soal',
            compact('soal', 'ujian')
        );
    }

   

 public function destroy(
    UjianSoalCalon $soal
): RedirectResponse {
    $idUjian = $soal->id_ujian;

    $soal->delete();

    return redirect()
        ->route('soalCalon.index', [
            'id' => $idUjian,
        ])
        ->with('success', 'Soal berhasil dihapus.');
}
}