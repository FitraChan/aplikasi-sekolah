@extends('layout.app')

@section('title', 'Verifikasi Pembayaran')
@section('page_title', 'Verifikasi Pembayaran')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2 text-sm font-medium text-[#02BC9C] hover:text-[#02a387] transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 19l-7-7 7-7"/>

                    </svg>

                    Kembali

                </a>

            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Verifikasi Pembayaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola dan verifikasi bukti pembayaran pendaftaran siswa baru.
            </p>

        </div>


        {{-- Tombol --}}
        <div class="flex items-center gap-3">

            <button type="button"
                    class="inline-flex items-center gap-2
                           px-4 py-2.5
                           border border-slate-300
                           bg-white
                           hover:bg-slate-50
                           text-slate-700
                           text-sm font-semibold
                           rounded-lg
                           shadow-sm
                           transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>

                </svg>

                Filter

            </button>


            <button type="button"
                    class="inline-flex items-center gap-2
                           px-4 py-2.5
                           bg-[#02BC9C]
                           hover:bg-[#02a387]
                           text-white
                           text-sm font-semibold
                           rounded-lg
                           shadow-sm
                           transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>

                </svg>

                Ekspor Laporan

            </button>

        </div>

    </div>


    {{-- =========================================================
        CARD CONTAINER
    ========================================================== --}}
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">


        {{-- Card Header --}}
        <div class="flex items-center justify-between
                    p-5
                    border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-teal-50
                            border border-teal-100
                            flex items-center justify-center
                            text-teal-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                    </svg>

                </div>


                <div>

                    <h2 class="text-base font-semibold text-slate-800">
                        Bukti Pembayaran
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Daftar bukti pembayaran pendaftaran calon siswa
                    </p>

                </div>

            </div>


            {{-- Jumlah Data --}}
            <div class="text-right">

                <div class="text-lg font-bold text-slate-800">
                    {{ $data->count() }}
                </div>

                <div class="text-xs text-slate-400">
                    Bukti
                </div>

            </div>

        </div>


        {{-- =====================================================
            CARD GRID
        ====================================================== --}}
        <div class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($data as $item)

                    @php

                        $nama = $item->calonSiswa->nama_lengkap
                            ?? 'Nama tidak tersedia';

                        $noDaftar = $item->calonSiswa->no_daftar
                            ?? '-';

                        /*
                         * Inisial
                         */
                        $inisial = collect(
                            preg_split('/\s+/', trim($nama))
                        )
                        ->filter()
                        ->take(2)
                        ->map(function ($kata) {

                            return strtoupper(
                                substr($kata, 0, 1)
                            );

                        })
                        ->implode('');


                        /*
                         * Warna avatar
                         */
                        $warnaAvatar = [

                            'bg-blue-100 text-blue-600',

                            'bg-purple-100 text-purple-600',

                            'bg-teal-100 text-[#02BC9C]',

                            'bg-amber-100 text-amber-600',

                            'bg-rose-100 text-rose-600',

                        ];

                        $avatar =
                            $warnaAvatar[
                                $loop->index %
                                count($warnaAvatar)
                            ];


                        /*
                         * Gambar
                         */
                        $gambar = $item->bukti_transfer;

                        if (
                            $gambar &&
                            !str_starts_with($gambar, 'http')
                        ) {

                            $gambar = asset(
                                'storage/app/public/' . $gambar
                            );

                        }

                    @endphp


                    {{-- =================================================
                        CARD
                    ================================================== --}}
                    <div
                        class="bg-white
                               rounded-2xl
                               border border-slate-200/80
                               p-5
                               shadow-sm
                               hover:shadow-md
                               transition
                               flex flex-col">


                        {{-- HEADER --}}
                        <div class="flex items-start justify-between mb-4">

                            <div class="flex items-center gap-3">

                                {{-- Avatar --}}
                                <div
                                    class="w-10 h-10
                                           rounded-full
                                           {{ $avatar }}
                                           font-bold
                                           text-xs
                                           flex items-center
                                           justify-center">

                                    {{ $inisial ?: '?' }}

                                </div>


                                {{-- Nama --}}
                                <div class="min-w-0">

                                    <h4
                                        class="text-sm font-bold
                                               text-slate-900
                                               leading-tight
                                               truncate">

                                        {{ $nama }}

                                    </h4>

                                    <span class="text-xs text-slate-400">

                                        Reg:
                                        #{{ $noDaftar }}

                                    </span>

                                </div>

                            </div>


                            {{-- STATUS --}}
                            <span
                                class="shrink-0
                                       px-3 py-1
                                       rounded-full
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       bg-[#FEF3D6]
                                       text-[#B54708]
                                       tracking-wider">

                                PENDING

                            </span>

                        </div>


                        {{-- INFORMASI --}}
                        <div class="space-y-2 text-xs py-1">


                            <div class="flex justify-between items-center gap-3">

                                <span class="text-slate-500">
                                    No. Pendaftaran
                                </span>

                                <span class="font-semibold text-slate-700">
                                    {{ $noDaftar }}
                                </span>

                                <input type="hidden" id="noDaftar" value="{{ $noDaftar }}">

                            </div>


                            <div class="flex justify-between items-center gap-3">

                                <span class="text-slate-500">
                                    Upload
                                </span>

                                <span class="font-medium text-slate-700">

                                    {{ $item->created_at
                                        ? $item->created_at->format('d M Y H:i')
                                        : '-' }}

                                </span>

                            </div>

                        </div>


                        {{-- =================================================
                            GAMBAR
                        ================================================== --}}
                        <a
                            href="{{ $gambar ?: '#' }}"
                            target="_blank"
                            class="block
                                   mt-4
                                   rounded-xl
                                   overflow-hidden
                                   border border-slate-200/80
                                   bg-slate-50
                                   h-44
                                   relative
                                   group
                                   cursor-pointer">

                            @if ($gambar)

                                <img
                                    src="{{ url($gambar) }}"
                                    alt="Bukti Transfer {{ $nama }}"
                                    class="w-full h-full
                                           object-cover
                                           object-center
                                           group-hover:scale-105
                                           transition-transform
                                           duration-300">

                            @else

                                <div
                                    class="w-full h-full
                                           flex flex-col
                                           items-center
                                           justify-center
                                           text-slate-400">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-8 h-8 mb-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.5"
                                            d="M3 7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                            stroke-width="1.5"/>

                                    </svg>

                                    <span class="text-xs">
                                        Bukti tidak tersedia
                                    </span>

                                </div>

                            @endif


                            {{-- Overlay --}}
                            @if ($gambar)

                                <div
                                    class="absolute inset-0
                                           bg-slate-900/0
                                           group-hover:bg-slate-900/20
                                           transition
                                           flex items-center
                                           justify-center">

                                    <span
                                        class="opacity-0
                                               group-hover:opacity-100
                                               bg-white/95
                                               text-slate-800
                                               text-[11px]
                                               font-bold
                                               px-3 py-1.5
                                               rounded-lg
                                               shadow-sm
                                               transition">

                                        Lihat Bukti

                                    </span>

                                </div>

                            @endif

                        </a>


                        {{-- =================================================
                            FOOTER CARD
                        ================================================== --}}
                        <div
                            class="flex items-center
                                   justify-between
                                   mt-4
                                   pt-4
                                   border-t border-slate-100">


                            <span class="text-xs text-slate-400">

                                ID #{{ $item->id }}

                            </span>


                            <button
    type="button"
    class="inline-flex items-center gap-1.5
           text-xs font-semibold
           text-[#02BC9C]
           hover:text-[#02a387]
           transition"
    data-tw-toggle="modal"
    data-tw-target="#modal-cicilan-form"
    onclick="openCicilan(
    {{ $item->id ?? 0 }},
    '{{ $item->calonSiswa->no_daftar ?? '' }}'
)"
>
    Bayar

    <svg
        xmlns="http://www.w3.org/2000/svg"
        class="w-3.5 h-3.5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M9 5l7 7-7 7"
        />
    </svg>
</button>

                        </div>

                    </div>


                @empty

                    {{-- EMPTY STATE --}}
                    <div class="col-span-full">

                        <div
                            class="py-16
                                   flex flex-col
                                   items-center
                                   justify-center
                                   text-center">

                            <div
                                class="w-14 h-14
                                       rounded-full
                                       bg-slate-100
                                       flex items-center
                                       justify-center
                                       mb-4">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-7 h-7 text-slate-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293 0V19a2 2 0 01-2 2z"/>

                                </svg>

                            </div>


                            <h3
                                class="text-sm
                                       font-semibold
                                       text-slate-700">

                                Belum ada bukti pembayaran

                            </h3>


                            <p class="text-xs text-slate-400 mt-1">

                                Bukti pembayaran calon siswa akan
                                muncul di sini.

                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </section>



</main>

@include('keuangan.bayar_calon_siswa.modal_history.modal_cicilan2')

<script>
function openCicilan(id, noDaftar) {

    document.getElementById('id_bukti').value = id;

    document.getElementById('id_calon_siswa_cicilan').value = noDaftar;

    console.log('id:', id);
    console.log('noDaftar:', noDaftar);

    const modal = document.getElementById('modal-cicilan-form');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeCicilan() {

    const modal = document.getElementById('modal-cicilan-form');

    modal.classList.remove('flex');
    modal.classList.add('hidden');
}
  </script>  



@endsection

