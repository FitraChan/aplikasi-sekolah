@extends('layout.app')

@section('title', 'Target Pendaftaran')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full space-y-6">


{{-- HEADER --}}
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Jadwal & Menu Ujian
        </h1>

        <p class="text-slate-500 text-sm mt-1">
            Selamat datang di portal seleksi.
            Pastikan koneksi internet Anda stabil sebelum memulai pengerjaan ujian.
        </p>
    </div>

    {{-- TANGGAL --}}
    <div class="flex items-center gap-3.5 bg-white border border-slate-200/80 rounded-2xl px-4 py-3 shadow-sm flex-shrink-0">

        <div class="w-10 h-10 rounded-xl bg-[#00b589] flex items-center justify-center text-white shadow-sm">

            <svg class="w-5 h-5 stroke-current fill-none stroke-2"
                 viewBox="0 0 24 24">

                <rect height="18" rx="2" ry="2"
                      width="18" x="3" y="4"></rect>

                <line x1="16" x2="16" y1="2" y2="6"></line>
                <line x1="8" x2="8" y1="2" y2="6"></line>

                <line x1="3" x2="21" y1="10" y2="10"></line>

                <path d="M9 16l2 2 4-4"></path>

            </svg>

        </div>

        <div>

            <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">
                Hari Ini
            </p>

            <p class="text-sm font-bold text-slate-800">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>

        </div>

    </div>

</div>


{{-- PESAN ERROR --}}
@if (session('error'))

    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

        <div class="font-semibold">
            Upload gagal
        </div>

        <div class="mt-1">
            {{ session('error') }}
        </div>

    </div>

@endif


{{-- CEK PEMBAYARAN --}}
@if (($nominal ?? 0) <= 0)

    <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center shadow-sm">

        <div class="w-14 h-14 mx-auto rounded-xl bg-red-50 flex items-center justify-center">

            <svg class="w-8 h-8 text-red-500"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                <line x1="2" y1="10" x2="22" y2="10"></line>

            </svg>

        </div>

        <div class="text-lg font-bold text-slate-800 mt-4">
            Pembayaran Pendaftaran Belum Dilakukan
        </div>

        <div class="text-slate-500 mt-2">
            Harap lakukan pembayaran pendaftaran terlebih dahulu
            sebelum mengikuti ujian calon siswa.
        </div>

    </div>

@else

    {{-- GRID UTAMA --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- ========================= --}}
        {{-- KOLOM UJIAN --}}
        {{-- ========================= --}}

        <div class="lg:col-span-8 space-y-5">

            @forelse ($data as $item)

                @php
                    $peserta = $item->peserta->first();
                @endphp


                {{-- CARD UJIAN --}}
                <article
                    class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow transition-shadow"
                    data-purpose="exam-card">

                    <div class="flex flex-col sm:flex-row gap-5">

                        {{-- THUMBNAIL --}}
                        <div class="w-full sm:w-44 h-48 sm:h-auto rounded-xl overflow-hidden flex-shrink-0 bg-slate-100">

                            @if (!empty($item->gambar))
                                <img
                                    src="{{ asset($item->gambar) }}"
                                    alt="{{ $item->nama_ujian }}"
                                    class="w-full h-full object-cover">
                            @else

                                <div class="w-full h-full flex items-center justify-center">

                                    <svg class="w-16 h-16 text-slate-300"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.5"
                                         viewBox="0 0 24 24">

                                        <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                        <path d="M8 9h8"></path>
                                        <path d="M8 13h5"></path>

                                    </svg>

                                </div>

                            @endif

                        </div>


                        {{-- CONTENT --}}
                        <div class="flex-1 flex flex-col justify-between py-1">

                            <div>

                                {{-- JUDUL + STATUS --}}
                                <div class="flex items-start justify-between gap-2">

                                    <h3 class="font-bold text-lg text-slate-900 leading-snug">

                                        {{ $item->nama_ujian }}

                                    </h3>


                                    {{-- STATUS --}}
                                    @if ($peserta?->status === 'selesai')

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200 flex-shrink-0">

                                            <svg class="w-3.5 h-3.5 stroke-current fill-none stroke-[2.5]"
                                                 viewBox="0 0 24 24">

                                                <polyline points="20 6 9 17 4 12"></polyline>

                                            </svg>

                                            Selesai

                                        </span>

                                    @elseif ($peserta?->status === 'sedang')

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100 flex-shrink-0">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <circle cx="12" cy="12" r="9"></circle>
                                                <path d="M12 7v5l3 2"></path>

                                            </svg>

                                            Sedang dikerjakan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-sky-50 text-sky-600 border border-sky-100 flex-shrink-0">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <circle cx="12" cy="12" r="10"></circle>

                                            </svg>

                                            Tersedia

                                        </span>

                                    @endif

                                </div>


                                {{-- DESKRIPSI --}}
                                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">

                                    {{ $item->deskripsi }}

                                </p>

                            </div>


                            {{-- FOOTER --}}
                            <div class="pt-4 mt-2 border-t border-slate-100">

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">


                                    {{-- DETAIL --}}
                                    <div class="flex flex-wrap items-center gap-5 text-xs font-semibold text-slate-600">


                                        {{-- JUMLAH SOAL --}}
                                        <div class="flex items-center gap-1.5">

                                            <svg class="w-4 h-4 text-teal-600 stroke-current fill-none stroke-2"
                                                 viewBox="0 0 24 24">

                                                <path d="M8 6h13"></path>
                                                <path d="M8 12h13"></path>
                                                <path d="M8 18h13"></path>

                                                <path d="M3 6h.01"></path>
                                                <path d="M3 12h.01"></path>
                                                <path d="M3 18h.01"></path>

                                            </svg>

                                            <span class="text-slate-700">
                                                {{ $item->soal_count }} Soal
                                            </span>

                                        </div>


                                        {{-- DURASI --}}
                                        <div class="flex items-center gap-1.5">

                                            <svg class="w-4 h-4 text-teal-600 stroke-current fill-none stroke-2"
                                                 viewBox="0 0 24 24">

                                                <circle cx="12" cy="12" r="10"></circle>

                                                <polyline points="12 6 12 12 16 14"></polyline>

                                            </svg>

                                            <span class="text-slate-700">
                                                {{ $item->durasi }} Menit
                                            </span>

                                        </div>


                                        {{-- NILAI MINIMAL --}}
                                        <div class="flex items-center gap-1.5">

                                           
                                            <span class="text-slate-700">
                                                Minimal {{ $item->nilai_minimal }}
                                            </span>

                                        </div>

                                    </div>


                                    {{-- ACTION --}}
                                    @if ($peserta?->status === 'selesai')

                                        <a
                                            href="{{ route('ujianCalon.hasil', $peserta) }}"
                                            class="inline-flex items-center justify-center gap-2 bg-white border border-teal-500 text-teal-600 hover:bg-teal-50 px-5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm transition-colors">

                                            Lihat Hasil

                                            <svg class="w-4 h-4 stroke-current fill-none stroke-2"
                                                 viewBox="0 0 24 24">

                                                <line x1="5" x2="19" y1="12" y2="12"></line>

                                                <polyline points="12 5 19 12 12 19"></polyline>

                                            </svg>

                                        </a>

                                    @else

                                        <form
                                            action="{{ route('ujianCalon.mulai', ['ujian' => $item->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Mulai ujian sekarang? Waktu akan langsung berjalan.')">

                                            @csrf

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center gap-2 bg-[#00b589] hover:bg-[#00a37b] text-white px-5 py-2.5 rounded-xl font-semibold text-xs sm:text-sm transition-colors shadow-sm">

                                                {{ $peserta?->status === 'sedang'
                                                    ? 'Lanjutkan Ujian'
                                                    : 'Mulai Ujian' }}

                                                <svg class="w-4 h-4 stroke-current fill-none stroke-2"
                                                     viewBox="0 0 24 24">

                                                    <line x1="5" x2="19" y1="12" y2="12"></line>

                                                    <polyline points="12 5 19 12 12 19"></polyline>

                                                </svg>

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </article>

            @empty

                <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">

                    <div class="text-slate-500">
                        Belum ada ujian yang tersedia.
                    </div>

                </div>

            @endforelse


            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $data->links() }}
            </div>

        </div>


        {{-- ========================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================= --}}

        <div class="lg:col-span-4 space-y-6">


            {{-- INSTRUKSI --}}
            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#00c99b] to-[#00aa81] text-white p-6 shadow-sm">

                <div class="absolute -right-6 -bottom-6 text-white/10 pointer-events-none">

                    <svg class="w-44 h-44 fill-current"
                         viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4"></path>
                        <path d="M12 8h.01"></path>

                    </svg>

                </div>


                <h3 class="font-bold text-lg mb-5 relative z-10">
                    Instruksi Penting
                </h3>


                <ul class="space-y-4 text-xs sm:text-sm font-medium relative z-10 leading-relaxed text-emerald-50">

                    <li class="flex items-start gap-3">

                        <div class="w-5 h-5 rounded-full border border-white/60 flex items-center justify-center flex-shrink-0">

                            ✓

                        </div>

                        <span>
                            Pastikan koneksi internet stabil sebelum memulai ujian.
                        </span>

                    </li>


                    <li class="flex items-start gap-3">

                        <div class="w-5 h-5 rounded-full border border-white/60 flex items-center justify-center flex-shrink-0">

                            ✓

                        </div>

                        <span>
                            Kerjakan ujian dengan jujur dan teliti.
                        </span>

                    </li>


                    <li class="flex items-start gap-3">

                        <div class="w-5 h-5 rounded-full border border-white/60 flex items-center justify-center flex-shrink-0">

                            ✓

                        </div>

                        <span>
                            Pastikan perangkat yang digunakan dalam kondisi baik.
                        </span>

                    </li>

                </ul>

            </div>


            {{-- PROGRES --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm">

                <h4 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-4">
                    Progres Ujian Seleksi
                </h4>


                @php

                    $totalUjian = $data->count();

                    $totalSelesai = $data->filter(function ($item) {

                        return $item->peserta->first()?->status === 'selesai';

                    })->count();

                    $persentase = $totalUjian > 0
                        ? round(($totalSelesai / $totalUjian) * 100)
                        : 0;

                @endphp


                <div class="space-y-3.5 mb-5 text-xs font-semibold">

                    @foreach ($data as $item)

                        @php
                            $statusPeserta = $item->peserta->first()?->status;
                        @endphp

                        <div class="flex items-center justify-between gap-3">

                            <span class="text-slate-600">
                                {{ $item->nama_ujian }}
                            </span>


                            @if ($statusPeserta === 'selesai')

                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">

                                    ✓ Selesai

                                </span>

                            @elseif ($statusPeserta === 'sedang')

                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-700">

                                    Sedang

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-sky-50 text-sky-600 border border-sky-100">

                                    Menunggu

                                </span>

                            @endif

                        </div>

                    @endforeach

                </div>


                {{-- PERSENTASE --}}
                <div class="border-t border-slate-100 pt-4">

                    <div class="flex items-center justify-between text-xs font-bold mb-2">

                        <span class="text-slate-700">
                            Total Selesai
                        </span>

                        <span class="text-teal-600 font-bold">
                            {{ $persentase }}%
                        </span>

                    </div>


                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">

                        <div
                            class="bg-gradient-to-r from-[#00b589] to-[#00c495] h-2.5 rounded-full"
                            style="width: {{ $persentase }}%;">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endif


</main>

@endsection
