@extends('layout.app')

@section('title', 'Template Pembayaran')
@section('page_title', 'Template Pembayaran')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0 overflow-y-auto">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div>

            <div class="flex items-center gap-1.5 text-xs text-slate-400 font-semibold mb-1">

                <span>PPDB</span>

                <span>&gt;</span>

                <span>Keuangan</span>

                <span>&gt;</span>

                <span class="text-[#02BC9C]">
                    Template Pembayaran
                </span>

            </div>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                Kelola Struktur Biaya
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Kelola template dan struktur biaya pembayaran.
            </p>

        </div>


        {{-- =====================================================
            TAMBAH TEMPLATE
        ====================================================== --}}
        <a href=""
           class="inline-flex items-center justify-center gap-2
                  px-5 py-2.5
                  bg-[#02BC9C]
                  hover:bg-[#02a387]
                  text-white
                  font-semibold
                  text-sm
                  rounded-xl
                  transition
                  shadow-sm
                  shadow-emerald-500/20">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path d="M12 4v16M4 12h16"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>

            </svg>

            <span>
                Tambah Template
            </span>

        </a>

    </div>


    {{-- =========================================================
        TEMPLATE CARDS
    ========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        {{-- =====================================================
            LEVEL 1
            GELOMBANG
        ====================================================== --}}
        @forelse ($data ?? [] as $idGelombang => $itemsByItem)

            @php

                /*
                |--------------------------------------------------------------------------
                | Ambil detail pertama
                |--------------------------------------------------------------------------
                */

                $firstItemGroup = $itemsByItem->first();

                $first = $firstItemGroup
                    ? $firstItemGroup->first()
                    : null;


                /*
                |--------------------------------------------------------------------------
                | DATA GELOMBANG
                |--------------------------------------------------------------------------
                */

                $namaGelombang =
                    $first['nama_gelombang'] ?? '-';

                $idTahun =
                    $first['id_tahun'] ?? '-';


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                $aktif = true;


                /*
                |--------------------------------------------------------------------------
                | JUMLAH JENIS ITEM
                |--------------------------------------------------------------------------
                */

                $jumlahItem =
                    $itemsByItem->count();


                /*
                |--------------------------------------------------------------------------
                | TOTAL SEMUA PEMBAYARAN
                |--------------------------------------------------------------------------
                */

       $total = $itemsByItem->sum(function ($itemDetails) {

                $itemFirst = $itemDetails->first();

                return (float) (
                    $itemFirst['jml_bayar'] ?? 0
                );
            });

            @endphp


            {{-- =================================================
                CARD GELOMBANG
            ================================================== --}}
            <div class="bg-white
                        rounded-xl
                        border border-slate-200
                        shadow-sm
                        p-5 sm:p-6
                        flex flex-col
                        min-w-0">


                {{-- =================================================
                    CARD HEADER
                ================================================== --}}
                <div>

                    <div class="flex items-start justify-between gap-4">

                        <div class="min-w-0">

                            <h3 class="text-xl font-bold
                                       text-slate-800
                                       leading-snug">

                                Biaya Pendidikan Tahun Ajaran

                            </h3>

                            <h3 class="text-xl font-bold
                                       text-slate-800
                                       leading-snug">

                                {{ $tahunAjaran->thn_ajaran ?? '-' }}

                            </h3>

                        </div>


                        {{-- =================================================
                            STATUS
                        ================================================== --}}
                        @if ($aktif)

                            <span class="inline-flex items-center
                                         px-3 py-1
                                         rounded-full
                                         text-xs
                                         font-bold
                                         bg-[#02BC9C]
                                         text-white
                                         shrink-0">

                                AKTIF

                            </span>

                        @else

                            <span class="inline-flex items-center
                                         px-3 py-1
                                         rounded-full
                                         text-xs
                                         font-bold
                                         bg-slate-400
                                         text-white
                                         shrink-0">

                                TIDAK AKTIF

                            </span>

                        @endif

                    </div>


                    {{-- =================================================
                        GELOMBANG
                    ================================================== --}}
                    <div class="mt-5 mb-4">

                        <div class="flex items-center justify-between gap-3">

                            <div>

                                <span class="block
                                             text-[10px]
                                             font-bold
                                             text-slate-400
                                             uppercase
                                             tracking-wider
                                             mb-1">

                                    GELOMBANG

                                </span>

                                <span class="inline-flex items-center
                                             px-3 py-1.5
                                             rounded-lg
                                             bg-teal-50
                                             border border-teal-100
                                             text-[#02BC9C]
                                             text-sm
                                             font-bold">

                                    {{ $namaGelombang }}

                                </span>

                            </div>


                            {{-- =================================================
                                JUMLAH ITEM
                            ================================================== --}}
                            <div class="text-right">

                                <span class="block
                                             text-[10px]
                                             font-bold
                                             text-slate-400
                                             uppercase
                                             tracking-wider
                                             mb-1">

                                    ITEM

                                </span>

                                <span class="text-sm
                                             font-bold
                                             text-slate-600">

                                    {{ $jumlahItem }} item

                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        LEVEL 2
                        ITEM PEMBAYARAN
                    ================================================== --}}
                    <div class="space-y-3">

                        @foreach ($itemsByItem as $idItem => $itemDetails)

                            @php

                                /*
                                |--------------------------------------------------------------------------
                                | DETAIL PERTAMA ITEM
                                |--------------------------------------------------------------------------
                                */

                                $itemFirst =
                                    $itemDetails->first();


                                /*
                                |--------------------------------------------------------------------------
                                | DATA ITEM
                                |--------------------------------------------------------------------------
                                */

                                $namaItem =
                                    $itemFirst['nama_item'] ?? '-';

                                $kategori =
                                    $itemFirst['kategori'] ?? '-';

                                $periode =
                                    $itemFirst['periode'] ?? '-';


                                /*
                                |--------------------------------------------------------------------------
                                | KETERANGAN
                                |--------------------------------------------------------------------------
                                */

                                $keterangan =
                                    $itemDetails
                                        ->pluck('ket_bayar')
                                        ->filter()
                                        ->unique()
                                        ->implode(', ');


                                /*
                                |--------------------------------------------------------------------------
                                | TOTAL ITEM
                                |--------------------------------------------------------------------------
                                */

                                $jumlahItemBayar =
                                    $itemDetails->sum(function ($item) {

                                        return (float) (
                                            $item['jml_bayar'] ?? 0
                                        );

                                    });

                            @endphp


                            {{-- =================================================
                                ITEM PEMBAYARAN
                            ================================================== --}}
                            <div class="grid grid-cols-12
                                        items-center
                                        bg-slate-50
                                        border border-slate-100
                                        rounded-xl
                                        px-4 py-4
                                        gap-3">


                                {{-- =================================================
                                    ICON + NAMA ITEM
                                ================================================== --}}
                                <div class="col-span-12
                                            sm:col-span-5
                                            flex items-center
                                            gap-3
                                            min-w-0">

                                    <div class="w-10 h-10
                                                rounded-lg
                                                bg-teal-50
                                                border border-teal-100
                                                text-[#02BC9C]
                                                flex items-center
                                                justify-center
                                                shrink-0">

                                        <svg class="w-5 h-5"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="2"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1-2-1-2 1z"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M8 7h8M8 11h8M8 15h5"/>

                                        </svg>

                                    </div>


                                    <div class="min-w-0">

                                        <span class="block
                                                     text-sm
                                                     font-bold
                                                     text-slate-800
                                                     truncate">

                                            {{ $namaItem }}

                                        </span>


                                        <span class="block
                                                     text-xs
                                                     text-slate-500
                                                     mt-0.5
                                                     truncate">

                                            {{ $kategori }}

                                        </span>


                                        @if ($keterangan)

                                            <span class="block
                                                         text-xs
                                                         text-slate-400
                                                         mt-0.5
                                                         truncate">

                                                {{ $keterangan }}

                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- =================================================
                                    JUMLAH
                                ================================================== --}}
                                <div class="col-span-6 sm:col-span-4">

                                    <span class="block
                                                 text-[10px]
                                                 font-bold
                                                 text-slate-400
                                                 uppercase
                                                 tracking-wider
                                                 mb-0.5">

                                        JUMLAH

                                    </span>

                                    <span class="text-sm
                                                 font-bold
                                                 text-slate-800">

                                        Rp {{ number_format(
                                            $itemFirst['jml_bayar'],
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </div>


                                {{-- =================================================
                                    PERIODE
                                ================================================== --}}
                                <div class="col-span-6 sm:col-span-3">

                                    <span class="block
                                                 text-[10px]
                                                 font-bold
                                                 text-slate-400
                                                 uppercase
                                                 tracking-wider
                                                 mb-0.5">

                                        PERIODE

                                    </span>

                                    <span class="text-xs
                                                 font-semibold
                                                 text-slate-600">

                                        {{ $periode ?: '-' }}

                                    </span>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- =================================================
                    CARD FOOTER
                ================================================== --}}
                <div class="border-t
                            border-dashed
                            border-slate-300
                            pt-5
                            mt-6
                            flex flex-col
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-4">


                    {{-- =================================================
                        TOTAL
                    ================================================== --}}
                    <div>

                        <span class="text-[10px]
                                     sm:text-[11px]
                                     text-slate-400
                                     block
                                     uppercase
                                     font-bold
                                     tracking-wider
                                     mb-0.5">

                            TOTAL BIAYA

                        </span>

                        <span class="text-2xl
                                     font-extrabold
                                     text-[#02BC9C]">

                            Rp {{ number_format(
                                $total,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>


                    {{-- =================================================
                        ACTION
                    ================================================== --}}
                    <div class="flex items-center gap-2">


                        {{-- EDIT --}}
                        <a href=""
                           class="inline-flex
                                  items-center
                                  justify-center
                                  gap-1.5
                                  px-4
                                  py-2.5
                                  bg-[#02BC9C]
                                  hover:bg-[#02a387]
                                  text-white
                                  font-semibold
                                  text-xs
                                  sm:text-sm
                                  rounded-lg
                                  transition
                                  shadow-sm">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M11 5h2M5 19l1.5-6L16 3.5a2.12 2.12 0 013 3L9.5 17.5 5 19z"/>

                            </svg>

                            <span>
                                Edit
                            </span>

                        </a>


                        {{-- HAPUS --}}
                        <button type="button"
                                onclick=""
                                class="inline-flex
                                       items-center
                                       justify-center
                                       gap-1.5
                                       px-4
                                       py-2.5
                                       bg-red-600
                                       hover:bg-red-700
                                       text-white
                                       font-semibold
                                       text-xs
                                       sm:text-sm
                                       rounded-lg
                                       transition
                                       shadow-sm
                                       cursor-pointer">

                            <svg class="w-4 h-4 shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 6l12 12M18 6L6 18"/>

                            </svg>

                            <span>
                                Hapus
                            </span>

                        </button>

                    </div>

                </div>

            </div>


        @empty


            {{-- =================================================
                EMPTY STATE
            ================================================== --}}
            <div class="lg:col-span-2">

                <div class="bg-white
                            rounded-xl
                            border border-slate-200
                            shadow-sm
                            p-10
                            text-center">

                    <div class="w-12 h-12
                                mx-auto
                                rounded-xl
                                bg-teal-50
                                border border-teal-100
                                text-[#02BC9C]
                                flex items-center
                                justify-center">

                        <svg class="w-6 h-6"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 12h6M9 16h6M5 20V5a2 2 0 012-2h7l5 5v12a2 2 0 01-2 2H7a2 2 0 01-2-2z"/>

                        </svg>

                    </div>


                    <h3 class="mt-4
                               text-sm
                               font-bold
                               text-slate-800">

                        Belum Ada Data

                    </h3>


                    <p class="mt-1
                              text-sm
                              text-slate-500">

                        Belum terdapat struktur biaya pembayaran.

                    </p>


                    <div class="mt-5">

                        <a href=""
                           class="inline-flex
                                  items-center
                                  gap-2
                                  px-4
                                  py-2.5
                                  bg-[#02BC9C]
                                  hover:bg-[#02a387]
                                  text-white
                                  text-sm
                                  font-semibold
                                  rounded-lg
                                  transition">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <path d="M12 4v16M4 12h16"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>

                            </svg>

                            Tambah Template

                        </a>

                    </div>

                </div>

            </div>

        @endforelse

    </div>

</main>


{{-- =============================================================
    DELETE SCRIPT
============================================================= --}}
@push('scripts')

<script>

    async function hapusTemplate(id) {

        if (!confirm(
            'Apakah Anda yakin ingin menghapus template ini?'
        )) {
            return;
        }


        try {

            const response = await fetch(
                `/template-pembayaran/${id}`,
                {
                    method: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN':
                            document
                                .querySelector(
                                    'meta[name="csrf-token"]'
                                )
                                .getAttribute('content'),

                        'Accept': 'application/json'

                    }
                }
            );


            const result = await response.json();


            if (!response.ok) {

                throw new Error(
                    result.message ??
                    'Gagal menghapus template.'
                );

            }


            alert(
                result.message ??
                'Template berhasil dihapus.'
            );


            window.location.reload();


        } catch (error) {

            console.error(error);

            alert(
                error.message ??
                'Terjadi kesalahan saat menghapus template.'
            );

        }

    }

</script>

@endpush

@endsection