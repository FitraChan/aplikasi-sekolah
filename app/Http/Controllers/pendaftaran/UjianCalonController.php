<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\Bayar;
use App\Models\UjianCalon;
use App\Models\CalonSiswa;
use App\Models\BayarCalonSiswa;
use App\Models\UjianJawabanCalon;
use App\Models\UjianPesertaCalon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UjianCalonController extends Controller
{
    private function calonSiswaId(): int
    {
        /*
         * Sesuaikan dengan sistem login Anda.
         *
         * Contoh jika ID calon siswa berada langsung pada user:
         * return auth()->user()->id_calon_siswa;
         *
         * Contoh jika user memiliki relasi calonSiswa:
         * return auth()->user()->calonSiswa->id;auth()->user()->id
         */

        $id = CalonSiswa::where('id_user',auth()->user()->id)->first();

        return auth()->user()->id;
    }

    public function index(): View
    {   
        $calonSiswaId = $this->calonSiswaId();
        $calonSiswa = CalonSiswa::query()
        ->select('id', 'id_gelombang','no_daftar')
        ->where('id_user',$calonSiswaId)->first();

        $bayar = BayarCalonSiswa::query()
        ->where('id_calon_siswa', $calonSiswa->no_daftar)
                ->whereRaw('tot_bayar != 0')

        ->whereHas('detail', function ($query) {
            $query->where('id_item', 1);
        })->first();

        $nominal = $bayar?->detail->first()?->jml_bayar ?? 0;

        $data = UjianCalon::query()
            ->where('status', 1)
             ->where('id_gelombang', $calonSiswa->id_gelombang)

              ->whereDate('tanggal_mulai', '<=', now()->toDateString())
        ->whereDate('tanggal_selesai', '>=', now()->toDateString())

            ->withCount([
                'soal' => fn ($query) => $query->where('status', true),
            ])
            ->with([
                'peserta' => fn ($query) =>
                    $query->where('id_calon_siswa', $calonSiswaId),
            ])
             ->with([
                'gelombang',
                'peserta' => fn ($query) =>
                    $query->where('id_calon_siswa', $calonSiswaId),
            ])
            ->latest()
            ->paginate(10);

        return view('pendaftaran.ujian.daftar-ujian', compact('data','nominal'), ['side'  => 'ujian']);
    }

    public function mulai(UjianCalon $ujian): RedirectResponse
    {
//dd(auth()->user()->toArray());
        abort_unless($ujian->status, 404);

        $sekarang = now();

        if ($ujian->tanggal_mulai &&
            $sekarang->lt($ujian->tanggal_mulai)) {
            return back()->with(
                'error',
                'UjianCalon belum dapat dimulai.'
            );
        }

        if ($ujian->tanggal_selesai &&
            $sekarang->gt($ujian->tanggal_selesai)) {
            return back()->with(
                'error',
                'Waktu pelaksanaan ujian telah berakhir.'
            );
        }

        if (!$ujian->soal()->where('status', true)->exists()) {
            return back()->with(
                'error',
                'Soal ujian belum tersedia.'
            );
        }

        $peserta = UjianPesertaCalon::firstOrCreate(
            [
                'id_ujian' => $ujian->id,
                'id_calon_siswa' => $this->calonSiswaId(),
            ],
            [
                'status' => 'belum',
                'hasil' => 'belum_dinilai',
            ]
        );

        if ($peserta->status === 'selesai') {
            return redirect()->route(
                'calon-siswa.ujian.hasil',
                $peserta
            );
        }

        if ($peserta->status === 'belum') {
            $peserta->update([
                'waktu_mulai' => now(),
                'status' => 'sedang',
            ]);
        }

        return redirect()->route(
            'ujianCalon.kerjakan',
            $peserta
        );
    }

    public function kerjakan(UjianPesertaCalon $peserta): View|RedirectResponse
    {
  
        abort_if(
            (int) $peserta->id_calon_siswa !== (int) $this->calonSiswaId(),
            403
        );

        if ($peserta->status === 'selesai') {
            return redirect()->route(
                'ujianCalon.hasil',
                $peserta
            );
        }

        $peserta->load('ujian');

        $batasWaktu = $peserta->waktu_mulai
        ->copy()
        ->addMinutes((int) $peserta->ujian->durasi);

        if (now()->greaterThanOrEqualTo($batasWaktu)) {
            return $this->prosesPenilaian($peserta, []);
        }

        $query = $peserta->ujian
            ->soal()
            ->where('status', true);

        $soal = $peserta->ujian->acak_soal
            ? $query->inRandomOrder()->get()
            : $query->orderBy('id')->get();

$questions = $soal->values()->map(function ($item) {
    return [
        'id' => $item->id,
        'text' => $item->pertanyaan,

        'options' => collect([
            'A' => $item->pilihan_a,
            'B' => $item->pilihan_b,
            'C' => $item->pilihan_c,
            'D' => $item->pilihan_d,
            'E' => $item->pilihan_e,
        ])
        ->filter(function ($value) {
            return !empty($value);
        })
        ->map(function ($value, $key) {
            return [
                'key' => $key,
                'text' => $value,
            ];
        })
        ->values()
        ->toArray(),
    ];
});

        return view(
            'pendaftaran.ujian.pengerjaan-ujian',
            compact('peserta', 'soal', 'batasWaktu','questions')
        );
    }

    public function submit(
        Request $request,
        UjianPesertaCalon $peserta
    ): RedirectResponse {
         abort_if(
            (int) $peserta->id_calon_siswa !== (int) $this->calonSiswaId(),
            403
        );

        if ($peserta->status === 'selesai') {
            return redirect()->route(
                'calon-siswa.ujian.hasil',
                $peserta
            );
        }

        $jawaban = $request->input('jawaban', []);

        CalonSiswa::where('id_user',$peserta->id_calon_siswa)->update(['status_daftar' => 3]);

        return $this->prosesPenilaian($peserta, $jawaban);
    }

    private function prosesPenilaian(
        UjianPesertaCalon $peserta,
        array $jawaban
    ): RedirectResponse {
        $peserta->load('ujian');

        $soal = $peserta->ujian
            ->soal()
            ->where('status', true)
            ->get();

        DB::transaction(function () use ($peserta, $soal, $jawaban) {
            $jumlahBenar = 0;
            $jumlahSalah = 0;
            $tidakDijawab = 0;
            $nilaiDiperoleh = 0;
            $totalBobot = (float) $soal->sum('bobot');

            foreach ($soal as $item) {
                $jawabanPeserta = isset($jawaban[$item->id])
                    ? strtoupper($jawaban[$item->id])
                    : null;

                $benar = $jawabanPeserta === $item->jawaban_benar;

                if ($jawabanPeserta === null) {
                    $tidakDijawab++;
                } elseif ($benar) {
                    $jumlahBenar++;
                    $nilaiDiperoleh += (float) $item->bobot;
                } else {
                    $jumlahSalah++;
                }

                UjianJawabanCalon::updateOrCreate(
                    [
                        'id_peserta' => $peserta->id,
                        'id_soal' => $item->id,
                    ],
                    [
                        'jawaban' => $jawabanPeserta,
                        'benar' => $benar,
                        'nilai' => $benar ? $item->bobot : 0,
                    ]
                );
            }

            $nilaiAkhir = $totalBobot > 0
                ? round(($nilaiDiperoleh / $totalBobot) * 100, 2)
                : 0;

            $hasil = $nilaiAkhir >= $peserta->ujian->nilai_minimal
                ? 'lulus'
                : 'tidak_lulus';

            $peserta->update([
                'waktu_selesai' => now(),
                'nilai' => $nilaiAkhir,
                'jumlah_benar' => $jumlahBenar,
                'jumlah_salah' => $jumlahSalah,
                'tidak_dijawab' => $tidakDijawab,
                'status' => 'selesai',
                'hasil' => $hasil,
            ]);
        });

        return redirect()->route(
            'ujianCalon.hasil',
            $peserta
        );
    }

    public function hasil(UjianPesertaCalon $peserta): View
    {
         abort_if(
            (int) $peserta->id_calon_siswa !== (int) $this->calonSiswaId(),
            403
        );

        abort_unless($peserta->status === 'selesai', 404);

        $peserta->load('ujian');

        return view(
            'pendaftaran.ujian.hasil',
            compact('peserta')
        );
    }

   
}