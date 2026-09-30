
@extends('layout.app')

@section('title', 'Hasil Ujian Calon Siswa')
@section('page_title', 'Hasil Ujian Calon Siswa')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl
                        bg-violet-50
                        flex items-center justify-center
                        text-violet-600">

                <i data-lucide="chart-no-axes-combined"
                   class="w-6 h-6"></i>

            </div>

            <div>

                <h1 class="text-2xl sm:text-3xl font-extrabold
                           text-slate-900 tracking-tight">

                    Hasil Ujian Calon Siswa

                </h1>

                <p class="text-sm text-slate-500 mt-1">

                    {{ $ujian->nama_ujian }}

                </p>

            </div>

        </div>


        <a href="{{ route('ujianCalonAdmin.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  border border-slate-200
                  bg-white text-slate-600
                  text-sm font-semibold
                  hover:bg-slate-50 transition">

            <i data-lucide="arrow-left"
               class="w-4 h-4"></i>

            Kembali

        </a>

    </div>


    {{-- SUCCESS ALERT --}}
    @if (session('success'))

        <div class="flex items-start gap-3
                    rounded-xl
                    border border-emerald-200
                    bg-emerald-50
                    px-4 py-3
                    text-sm text-emerald-700">

            <i data-lucide="circle-check"
               class="w-5 h-5 shrink-0 mt-0.5"></i>

            <div>

                <div class="font-semibold">
                    Berhasil
                </div>

                <div class="mt-0.5">
                    {{ session('success') }}
                </div>

            </div>

        </div>

    @endif


    {{-- INFORMASI UJIAN --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        <div class="flex items-center gap-3
                    px-5 sm:px-6 py-4
                    border-b border-slate-200
                    bg-slate-50/70">

            <div class="w-10 h-10 rounded-xl
                        bg-teal-50
                        flex items-center justify-center
                        text-teal-600">

                <i data-lucide="clipboard-list"
                   class="w-5 h-5"></i>

            </div>

            <div>

                <h2 class="text-base font-bold text-slate-800">
                    Informasi Ujian
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Detail pelaksanaan ujian
                </p>

            </div>

        </div>


        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4
                    gap-4 p-5 sm:p-6">

            {{-- NAMA UJIAN --}}
            <div class="rounded-xl
                        border border-slate-200
                        bg-slate-50/50
                        p-4">

                <div class="flex items-center gap-2
                            text-xs font-medium
                            text-slate-500">

                    <i data-lucide="file-text"
                       class="w-4 h-4"></i>

                    Nama Ujian

                </div>

                <div class="font-semibold
                            text-slate-800
                            text-sm mt-2">

                    {{ $ujian->nama_ujian }}

                </div>

            </div>


            {{-- TANGGAL --}}
            <div class="rounded-xl
                        border border-slate-200
                        bg-slate-50/50
                        p-4">

                <div class="flex items-center gap-2
                            text-xs font-medium
                            text-slate-500">

                    <i data-lucide="calendar-days"
                       class="w-4 h-4"></i>

                    Tanggal Ujian

                </div>

                <div class="font-semibold
                            text-slate-800
                            text-sm mt-2">

                    {{ $ujian->tanggal_mulai?->locale('id')->translatedFormat('d F Y') ?? '-' }}

                </div>

            </div>


            {{-- DURASI --}}
            <div class="rounded-xl
                        border border-slate-200
                        bg-slate-50/50
                        p-4">

                <div class="flex items-center gap-2
                            text-xs font-medium
                            text-slate-500">

                    <i data-lucide="clock-3"
                       class="w-4 h-4"></i>

                    Durasi

                </div>

                <div class="font-semibold
                            text-slate-800
                            text-sm mt-2">

                    {{ $ujian->durasi }} menit

                </div>

            </div>


            {{-- NILAI MINIMAL --}}
            <div class="rounded-xl
                        border border-slate-200
                        bg-slate-50/50
                        p-4">

                <div class="flex items-center gap-2
                            text-xs font-medium
                            text-slate-500">

                    <i data-lucide="target"
                       class="w-4 h-4"></i>

                    Nilai Minimal

                </div>

                <div class="font-semibold
                            text-slate-800
                            text-sm mt-2">

                    {{ number_format((float) $ujian->nilai_minimal, 0) }}

                </div>

            </div>

        </div>

    </div>


    {{-- HASIL PESERTA --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="flex flex-col sm:flex-row
                    sm:items-center
                    justify-between gap-3
                    px-5 sm:px-6 py-4
                    border-b border-slate-200
                    bg-slate-50/70">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-violet-50
                            flex items-center justify-center
                            text-violet-600">

                    <i data-lucide="users"
                       class="w-5 h-5"></i>

                </div>

                <div>

                    <h2 class="text-base font-bold text-slate-800">
                        Hasil Peserta
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Daftar hasil ujian calon siswa
                    </p>

                </div>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="min-w-[1200px] w-full text-sm">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr class="text-left">

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   whitespace-nowrap">
                            No
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   whitespace-nowrap">
                            No. Daftar
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   whitespace-nowrap">
                            Nama Peserta
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   whitespace-nowrap">
                            Waktu Mulai
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   whitespace-nowrap">
                            Waktu Selesai
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   text-center">
                            Benar
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   text-center">
                            Salah
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   text-center">
                            Kosong
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   text-center">
                            Nilai
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   text-center">
                            Hasil
                        </th>

                        <th class="px-4 py-3
                                   text-xs font-bold
                                   text-slate-600
                                   text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse ($data as $item)

                        @php

                            $hasil = strtolower(
                                trim($item->hasil ?? '')
                            );

                            $lulus =
                                $hasil === 'lulus'
                                || (float) $item->nilai >=
                                   (float) $ujian->nilai_minimal;

                        @endphp


                        <tr class="hover:bg-slate-50/70
                                   transition-colors">

                            {{-- NO --}}
                            <td class="px-4 py-4
                                       text-slate-500
                                       whitespace-nowrap">

                                {{ $data->firstItem() + $loop->index }}

                            </td>


                            {{-- NO DAFTAR --}}
                            <td class="px-4 py-4
                                       whitespace-nowrap">

                                <span class="inline-flex
                                             items-center
                                             px-2.5 py-1
                                             rounded-lg
                                             bg-slate-100
                                             text-slate-700
                                             text-xs
                                             font-semibold">

                                    {{ $item->calonSiswa?->no_daftar ?? '-' }}

                                </span>

                            </td>


                            {{-- NAMA --}}
                            <td class="px-4 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg
                                                bg-teal-50
                                                text-teal-600
                                                flex items-center
                                                justify-center
                                                shrink-0">

                                        <i data-lucide="user"
                                           class="w-4 h-4"></i>

                                    </div>

                                    <div class="font-semibold
                                                text-slate-800
                                                whitespace-nowrap">

                                        {{ $item->calonSiswa?->nama_lengkap ?? '-' }}

                                    </div>

                                </div>

                            </td>


                            {{-- WAKTU MULAI --}}
                            <td class="px-4 py-4
                                       text-slate-600
                                       whitespace-nowrap">

                                {{ $item->waktu_mulai?->format('d-m-Y H:i') ?? '-' }}

                            </td>


                            {{-- WAKTU SELESAI --}}
                            <td class="px-4 py-4
                                       text-slate-600
                                       whitespace-nowrap">

                                {{ $item->waktu_selesai?->format('d-m-Y H:i') ?? '-' }}

                            </td>


                            {{-- BENAR --}}
                            <td class="px-4 py-4 text-center">

                                <span class="inline-flex
                                             items-center
                                             justify-center
                                             min-w-8 px-2 py-1
                                             rounded-lg
                                             bg-emerald-50
                                             text-emerald-700
                                             text-xs
                                             font-bold">

                                    {{ $item->jumlah_benar ?? 0 }}

                                </span>

                            </td>


                            {{-- SALAH --}}
                            <td class="px-4 py-4 text-center">

                                <span class="inline-flex
                                             items-center
                                             justify-center
                                             min-w-8 px-2 py-1
                                             rounded-lg
                                             bg-red-50
                                             text-red-700
                                             text-xs
                                             font-bold">

                                    {{ $item->jumlah_salah ?? 0 }}

                                </span>

                            </td>


                            {{-- KOSONG --}}
                            <td class="px-4 py-4 text-center">

                                <span class="inline-flex
                                             items-center
                                             justify-center
                                             min-w-8 px-2 py-1
                                             rounded-lg
                                             bg-slate-100
                                             text-slate-600
                                             text-xs
                                             font-bold">

                                    {{ $item->tidak_dijawab ?? 0 }}

                                </span>

                            </td>


                            {{-- NILAI --}}
                            <td class="px-4 py-4 text-center">

                                <span class="font-bold
                                             text-slate-800">

                                    {{ number_format(
                                        (float) ($item->nilai ?? 0),
                                        2
                                    ) }}

                                </span>

                            </td>


                            {{-- HASIL --}}
                            <td class="px-4 py-4 text-center">

                                @if ($item->status !== 'selesai')

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-amber-50
                                                 text-amber-700
                                                 text-xs
                                                 font-semibold
                                                 whitespace-nowrap">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-amber-500">
                                        </span>

                                        Belum Selesai

                                    </span>

                                @elseif ($lulus)

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-emerald-50
                                                 text-emerald-700
                                                 text-xs
                                                 font-semibold">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-emerald-500">
                                        </span>

                                        Lulus

                                    </span>

                                @else

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-red-50
                                                 text-red-700
                                                 text-xs
                                                 font-semibold
                                                 whitespace-nowrap">

                                        <span class="w-1.5 h-1.5
                                                     rounded-full
                                                     bg-red-500">
                                        </span>

                                        Tidak Lulus

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td class="px-4 py-4 text-center">

                                <a
                                    href="{{ route(
                                        'ujianCalonAdmin.jawaban-peserta',
                                        [
                                            'ujianCalonAdmin' => $ujian->id,
                                            'peserta' => $item->id,
                                        ]
                                    ) }}"
                                    class="inline-flex
                                           items-center
                                           justify-center
                                           gap-2
                                           px-3.5 py-2
                                           rounded-xl
                                           bg-teal-600
                                           hover:bg-teal-700
                                           text-white
                                           text-xs
                                           font-semibold
                                           shadow-sm
                                           transition
                                           whitespace-nowrap"
                                >

                                    <i data-lucide="eye"
                                       class="w-4 h-4"></i>

                                    Lihat Jawaban

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="11"
                                class="px-6 py-12 text-center">

                                <div class="flex flex-col
                                            items-center
                                            justify-center">

                                    <div class="w-14 h-14 rounded-2xl
                                                bg-slate-100
                                                flex items-center
                                                justify-center
                                                text-slate-400">

                                        <i data-lucide="clipboard-x"
                                           class="w-7 h-7"></i>

                                    </div>

                                    <h3 class="mt-4
                                               text-sm font-bold
                                               text-slate-700">

                                        Belum Ada Peserta

                                    </h3>

                                    <p class="mt-1
                                              text-sm text-slate-500">

                                        Belum ada calon siswa yang
                                        mengikuti ujian ini.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($data->hasPages())

            <div class="px-5 sm:px-6 py-4
                        border-t border-slate-200">

                {{ $data->links() }}

            </div>

        @endif

    </div>

</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });
</script>

@endsection

