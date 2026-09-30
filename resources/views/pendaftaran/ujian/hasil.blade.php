@extends('layout.app')

@section('title', 'Hasil Ujian')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full max-w-7xl mx-auto space-y-6 sm:space-y-8">

    {{-- HEADER --}}
    <section class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-1.5 font-medium">
                <a
                    href="{{ route('ujianCalon.index') }}"
                    class="hover:text-[#00B686] transition-colors"
                >
                    Ujian
                </a>

                <span>›</span>

                <span class="text-[#00B686] font-semibold">
                    Hasil Ujian
                </span>
            </nav>

            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Hasil Ujian
            </h2>

            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Rekapitulasi hasil ujian calon siswa.
            </p>
        </div>

        <div class="flex items-center gap-3 no-print">

            <a
                href="{{ route('ujianCalon.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold
                       text-slate-700 bg-white border border-slate-300 rounded-xl
                       hover:bg-slate-50 transition shadow-sm"
            >
                <svg
                    class="w-4 h-4 text-slate-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                    />
                </svg>

                <span>Kembali</span>
            </a>

            @if ($peserta->ujian->tampil_hasil)
                <button
                    onclick="window.print()"
                    type="button"
                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold
                           text-white bg-[#00B686] hover:bg-[#009e75]
                           rounded-xl shadow-sm transition active:scale-95"
                >
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.72 13.829c-.24.03-.48.062-.72.096
                               m.72-.096a42.415 42.415 0 0110.56 0
                               m-10.56 0L6.34 18
                               m10.94-4.171c.24.03.48.062.72.096
                               m-.72-.096L17.66 18
                               m0 0l.229 2.523
                               a1.125 1.125 0 01-1.12 1.227
                               H7.231
                               c-.662 0-1.18-.568-1.12-1.227
                               L6.34 18
                               m11.318 0h1.091
                               A2.25 2.25 0 0021 15.75V9.456
                               c0-1.081-.768-2.015-1.837-2.175
                               a48.055 48.055 0 00-1.913-.247
                               m-10.91 0
                               a48.041 48.041 0 011.913.247
                               m10.5 0
                               a48.536 48.536 0 00-10.5 0
                               m10.5 0V3.375
                               c0-.621-.504-1.125-1.125-1.125
                               h-8.25
                               c-.621 0-1.125.504-1.125 1.125
                               v3.659"
                        />
                    </svg>

                    <span>Cetak Hasil</span>
                </button>
            @endif

        </div>
    </section>


    {{-- CARD HASIL --}}
    <section
        class="bg-white border border-slate-200/90 rounded-2xl
               p-5 sm:p-7 shadow-sm relative overflow-hidden"
    >

        {{-- IDENTITAS UJIAN --}}
        <div class="flex flex-col lg:flex-row lg:items-center
                    lg:justify-between gap-6">

            <div class="flex items-center gap-4 sm:gap-5">

                {{-- ICON --}}
                <div
                    class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl
                           bg-teal-50 border border-teal-100
                           flex items-center justify-center
                           flex-shrink-0"
                >
                    <svg
                        class="w-8 h-8 sm:w-10 sm:h-10 text-[#00B686]"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75
                               M21 12c0 4.97-4.03 9-9 9
                               s-9-4.03-9-9
                               4.03-9 9-9
                               9 4.03 9 9z"
                        />
                    </svg>
                </div>

                <div>

                    <div class="flex flex-wrap items-center gap-2 mb-1">

                        <h3 class="text-lg sm:text-xl font-bold text-slate-900">
                            {{ $peserta->ujian->nama_ujian }}
                        </h3>

                        <span
                            class="px-2.5 py-0.5 text-xs font-semibold
                                   bg-teal-50 text-[#00B686]
                                   border border-teal-200/80 rounded-full"
                        >
                            Hasil Ujian
                        </span>

                    </div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Hasil ujian calon siswa
                    </p>

                </div>
            </div>


            {{-- NILAI --}}
            @if ($peserta->ujian->tampil_hasil)

                <div
                    class="text-left lg:text-right
                           border-t lg:border-t-0
                           pt-4 lg:pt-0"
                >

                    <span
                        class="block text-[11px] font-bold
                               text-slate-400 uppercase tracking-wider"
                    >
                        Nilai Ujian
                    </span>

                    <span
                        class="text-3xl sm:text-4xl font-extrabold
                               mt-0.5 block leading-tight
                               {{ $peserta->hasil === 'lulus'
                                    ? 'text-[#00B686]'
                                    : 'text-red-500' }}"
                    >
                        {{ number_format($peserta->nilai, 2) }}

                        <span
                            class="text-xs text-slate-400 font-normal"
                        >
                            / 100
                        </span>
                    </span>

                </div>

            @endif

        </div>


        {{-- HASIL STATUS --}}
        @if ($peserta->ujian->tampil_hasil)

            <div
                class="mt-6 p-5 rounded-2xl
                       {{ $peserta->hasil === 'lulus'
                            ? 'bg-emerald-50 border border-emerald-200'
                            : 'bg-red-50 border border-red-200' }}"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="w-9 h-9 rounded-xl flex items-center justify-center
                               flex-shrink-0
                               {{ $peserta->hasil === 'lulus'
                                    ? 'bg-emerald-100 text-emerald-600'
                                    : 'bg-red-100 text-red-600' }}"
                    >

                        @if ($peserta->hasil === 'lulus')

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        @else

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.5"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>

                        @endif

                    </div>

                    <div>

                        <div
                            class="font-bold text-sm
                                   {{ $peserta->hasil === 'lulus'
                                        ? 'text-emerald-800'
                                        : 'text-red-800' }}"
                        >
                            {{ $peserta->hasil === 'lulus'
                                ? 'Ujian Berhasil Diselesaikan'
                                : 'Ujian Telah Selesai' }}
                        </div>

                        <div
                            class="text-xs mt-1
                                   {{ $peserta->hasil === 'lulus'
                                        ? 'text-emerald-700'
                                        : 'text-red-700' }}"
                        >
                            Hasil ujian akan menjadi bagian dari proses
                            seleksi calon siswa.
                        </div>

                    </div>

                </div>

            </div>


            {{-- STATISTIK --}}
            <div
                class="grid grid-cols-1 sm:grid-cols-3
                       gap-3 sm:gap-4 mt-6
                       pt-6 border-t border-slate-100"
            >

                {{-- BENAR --}}
                <div
                    class="bg-[#F8FAFC] rounded-xl p-4
                           border border-slate-200/70"
                >

                    <span
                        class="text-[11px] font-semibold
                               text-slate-400 block"
                    >
                        Jawaban Benar
                    </span>

                    <div class="flex items-baseline gap-1 mt-1">

                        <span
                            class="text-2xl font-extrabold
                                   text-emerald-600"
                        >
                            {{ $peserta->jumlah_benar }}
                        </span>

                        <span class="text-[11px] text-slate-400">
                            soal
                        </span>

                    </div>

                </div>


                {{-- SALAH --}}
                <div
                    class="bg-[#F8FAFC] rounded-xl p-4
                           border border-slate-200/70"
                >

                    <span
                        class="text-[11px] font-semibold
                               text-slate-400 block"
                    >
                        Jawaban Salah
                    </span>

                    <div class="flex items-baseline gap-1 mt-1">

                        <span
                            class="text-2xl font-extrabold
                                   text-red-500"
                        >
                            {{ $peserta->jumlah_salah }}
                        </span>

                        <span class="text-[11px] text-slate-400">
                            soal
                        </span>

                    </div>

                </div>


                {{-- TIDAK DIJAWAB --}}
                <div
                    class="bg-[#F8FAFC] rounded-xl p-4
                           border border-slate-200/70"
                >

                    <span
                        class="text-[11px] font-semibold
                               text-slate-400 block"
                    >
                        Tidak Dijawab
                    </span>

                    <div class="flex items-baseline gap-1 mt-1">

                        <span
                            class="text-2xl font-extrabold
                                   text-amber-500"
                        >
                            {{ $peserta->tidak_dijawab }}
                        </span>

                        <span class="text-[11px] text-slate-400">
                            soal
                        </span>

                    </div>

                </div>

            </div>

        @else

            {{-- HASIL BELUM DITAMPILKAN --}}
            <div
                class="mt-6 p-6 rounded-2xl
                       bg-slate-50 border border-slate-200"
            >

                <div class="flex items-start gap-4">

                    <div
                        class="w-10 h-10 rounded-xl
                               bg-amber-100 text-amber-600
                               flex items-center justify-center
                               flex-shrink-0"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.008v.008H12v-.008z
                                   M10.29 3.86L1.82 18
                                   a2 2 0 001.71 3h16.94
                                   a2 2 0 001.71-3L13.71 3.86
                                   a2 2 0 00-3.42 0z"
                            />
                        </svg>
                    </div>

                    <div>

                        <h3 class="font-bold text-slate-800">
                            Ujian Telah Selesai
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Hasil ujian akan diumumkan oleh pihak sekolah.
                        </p>

                    </div>

                </div>

            </div>

        @endif

    </section>


    {{-- TOMBOL KEMBALI --}}
    <section class="flex justify-end no-print">

        <a
            href="{{ route('ujianCalon.index') }}"
            class="inline-flex items-center gap-2
                   px-5 py-2.5
                   bg-[#00B686] hover:bg-[#009e75]
                   text-white text-sm font-semibold
                   rounded-xl shadow-sm transition"
        >

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                />
            </svg>

            Kembali ke Daftar Ujian

        </a>

    </section>

</main>

@endsection


@push('scripts')

<style>
    @media print {

        .no-print {
            display: none !important;
        }

        body {
            background: white !important;
        }

        main {
            max-width: 100% !important;
            padding: 20px !important;
        }
    }
</style>

@endpush