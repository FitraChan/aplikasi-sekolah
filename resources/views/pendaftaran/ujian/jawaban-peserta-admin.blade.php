@extends('layout.app')
@section('title', 'Jawaban Peserta Ujian')
@section('page_title', 'Jawaban Peserta Ujian')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row
                sm:items-center justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl
                        bg-blue-50
                        flex items-center justify-center
                        text-blue-600">

                <i data-lucide="file-check-2"
                   class="w-6 h-6"></i>

            </div>

            <div>

                <h1 class="text-2xl sm:text-3xl
                           font-extrabold text-slate-900
                           tracking-tight">

                    Jawaban Peserta Ujian

                </h1>

                <p class="text-sm text-slate-500 mt-1">

                    {{ $ujian->nama_ujian }}

                </p>

            </div>

        </div>


        <a href="{{ route('ujianCalonAdmin.peserta', $ujian->id) }}"
           class="inline-flex items-center
                  justify-center gap-2
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


    {{-- INFORMASI PESERTA --}}
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

                <i data-lucide="user-round-check"
                   class="w-5 h-5"></i>

            </div>

            <div>

                <h2 class="text-base font-bold
                           text-slate-800">

                    Informasi Peserta

                </h2>

                <p class="text-xs text-slate-500 mt-0.5">

                    Detail hasil ujian peserta

                </p>

            </div>

        </div>


        <div class="p-5 sm:p-6">

            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-3
                        gap-4">

                {{-- NAMA --}}
                <div class="rounded-xl
                            border border-slate-200
                            bg-slate-50/50
                            p-4">

                    <div class="flex items-center gap-2
                                text-xs font-medium
                                text-slate-500">

                        <i data-lucide="user"
                           class="w-4 h-4"></i>

                        Nama Peserta

                    </div>

                    <div class="mt-2
                                text-sm font-semibold
                                text-slate-800">

                        {{ $peserta->calonSiswa?->nama_lengkap ?? '-' }}

                    </div>

                </div>


                {{-- NO DAFTAR --}}
                <div class="rounded-xl
                            border border-slate-200
                            bg-slate-50/50
                            p-4">

                    <div class="flex items-center gap-2
                                text-xs font-medium
                                text-slate-500">

                        <i data-lucide="hash"
                           class="w-4 h-4"></i>

                        No. Daftar

                    </div>

                    <div class="mt-2
                                text-sm font-semibold
                                text-slate-800">

                        {{ $peserta->calonSiswa?->no_daftar ?? '-' }}

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="rounded-xl
                            border border-slate-200
                            bg-slate-50/50
                            p-4">

                    <div class="flex items-center gap-2
                                text-xs font-medium
                                text-slate-500">

                        <i data-lucide="activity"
                           class="w-4 h-4"></i>

                        Status

                    </div>

                    <div class="mt-2">

                        <span class="inline-flex
                                     items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-blue-50
                                     text-blue-700
                                     text-xs font-semibold">

                            <span class="w-1.5 h-1.5
                                         rounded-full
                                         bg-blue-500"></span>

                            {{ ucfirst($peserta->status ?? '-') }}

                        </span>

                    </div>

                </div>


                {{-- WAKTU MULAI --}}
                <div class="rounded-xl
                            border border-slate-200
                            bg-slate-50/50
                            p-4">

                    <div class="flex items-center gap-2
                                text-xs font-medium
                                text-slate-500">

                        <i data-lucide="play-circle"
                           class="w-4 h-4"></i>

                        Waktu Mulai

                    </div>

                    <div class="mt-2
                                text-sm font-semibold
                                text-slate-800">

                        {{ $peserta->waktu_mulai?->format('d-m-Y H:i') ?? '-' }}

                    </div>

                </div>


                {{-- WAKTU SELESAI --}}
                <div class="rounded-xl
                            border border-slate-200
                            bg-slate-50/50
                            p-4">

                    <div class="flex items-center gap-2
                                text-xs font-medium
                                text-slate-500">

                        <i data-lucide="circle-stop"
                           class="w-4 h-4"></i>

                        Waktu Selesai

                    </div>

                    <div class="mt-2
                                text-sm font-semibold
                                text-slate-800">

                        {{ $peserta->waktu_selesai?->format('d-m-Y H:i') ?? '-' }}

                    </div>

                </div>


                {{-- NILAI --}}
                <div class="rounded-xl
                            border border-teal-200
                            bg-teal-50/40
                            p-4">

                    <div class="flex items-center gap-2
                                text-xs font-medium
                                text-teal-700">

                        <i data-lucide="badge-check"
                           class="w-4 h-4"></i>

                        Nilai

                    </div>

                    <div class="mt-2
                                text-xl font-extrabold
                                text-teal-700">

                        {{ number_format((float) $peserta->nilai, 2) }}

                    </div>

                </div>

            </div>


            {{-- RINGKASAN --}}
            <div class="grid grid-cols-1
                        sm:grid-cols-3 gap-4 mt-5">

                {{-- BENAR --}}
                <div class="flex items-center gap-3
                            rounded-xl
                            border border-emerald-200
                            bg-emerald-50/50
                            p-4">

                    <div class="w-10 h-10 rounded-xl
                                bg-emerald-100
                                text-emerald-600
                                flex items-center justify-center">

                        <i data-lucide="check"
                           class="w-5 h-5"></i>

                    </div>

                    <div>

                        <div class="text-xs
                                    text-emerald-700">

                            Jumlah Benar

                        </div>

                        <div class="text-xl
                                    font-extrabold
                                    text-emerald-700">

                            {{ $peserta->jumlah_benar ?? 0 }}

                        </div>

                    </div>

                </div>


                {{-- SALAH --}}
                <div class="flex items-center gap-3
                            rounded-xl
                            border border-red-200
                            bg-red-50/50
                            p-4">

                    <div class="w-10 h-10 rounded-xl
                                bg-red-100
                                text-red-600
                                flex items-center justify-center">

                        <i data-lucide="x"
                           class="w-5 h-5"></i>

                    </div>

                    <div>

                        <div class="text-xs
                                    text-red-700">

                            Jumlah Salah

                        </div>

                        <div class="text-xl
                                    font-extrabold
                                    text-red-700">

                            {{ $peserta->jumlah_salah ?? 0 }}

                        </div>

                    </div>

                </div>


                {{-- KOSONG --}}
                <div class="flex items-center gap-3
                            rounded-xl
                            border border-slate-200
                            bg-slate-50
                            p-4">

                    <div class="w-10 h-10 rounded-xl
                                bg-slate-200
                                text-slate-600
                                flex items-center justify-center">

                        <i data-lucide="minus"
                           class="w-5 h-5"></i>

                    </div>

                    <div>

                        <div class="text-xs
                                    text-slate-600">

                            Tidak Dijawab

                        </div>

                        <div class="text-xl
                                    font-extrabold
                                    text-slate-700">

                            {{ $peserta->tidak_dijawab ?? 0 }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- HASIL --}}
            <div class="mt-5 pt-5
                        border-t border-slate-200">

                <div class="text-xs font-medium
                            text-slate-500 mb-2">

                    Hasil Ujian

                </div>

                @if (strtolower($peserta->hasil ?? '') === 'lulus')

                    <span class="inline-flex
                                 items-center gap-2
                                 px-3 py-1.5
                                 rounded-full
                                 bg-emerald-50
                                 text-emerald-700
                                 text-sm font-bold">

                        <i data-lucide="circle-check"
                           class="w-4 h-4"></i>

                        Lulus

                    </span>

                @elseif (strtolower($peserta->hasil ?? '') === 'tidak lulus')

                    <span class="inline-flex
                                 items-center gap-2
                                 px-3 py-1.5
                                 rounded-full
                                 bg-red-50
                                 text-red-700
                                 text-sm font-bold">

                        <i data-lucide="circle-x"
                           class="w-4 h-4"></i>

                        Tidak Lulus

                    </span>

                @else

                    <span class="inline-flex
                                 items-center gap-2
                                 px-3 py-1.5
                                 rounded-full
                                 bg-slate-100
                                 text-slate-600
                                 text-sm font-semibold">

                        <i data-lucide="circle-help"
                           class="w-4 h-4"></i>

                        {{ ucfirst($peserta->hasil ?? '-') }}

                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- DAFTAR JAWABAN --}}
    <div>

        <div class="flex items-center gap-3 mb-4">

            <div class="w-10 h-10 rounded-xl
                        bg-violet-50
                        flex items-center justify-center
                        text-violet-600">

                <i data-lucide="list-checks"
                   class="w-5 h-5"></i>

            </div>

            <div>

                <h2 class="text-lg font-bold
                           text-slate-800">

                    Daftar Jawaban

                </h2>

                <p class="text-sm text-slate-500">
                    Detail jawaban peserta untuk setiap soal.
                </p>

            </div>

        </div>


        @forelse ($jawaban as $index => $item)

            @php

                $soal = $item->soal;

                $jawabanDipilih = $item->jawaban
                    ? strtoupper($item->jawaban)
                    : null;

                $jawabanBenar = $soal?->jawaban_benar
                    ? strtoupper($soal->jawaban_benar)
                    : null;

                $benar = (bool) $item->is_benar;

            @endphp


            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm overflow-hidden
                        mb-5">


                {{-- SOAL HEADER --}}
                <div class="flex flex-col sm:flex-row
                            sm:items-center
                            justify-between gap-3
                            px-5 sm:px-6 py-4
                            border-b border-slate-200
                            bg-slate-50/70">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-lg
                                    bg-slate-200
                                    text-slate-700
                                    flex items-center justify-center
                                    text-sm font-bold">

                            {{ $index + 1 }}

                        </div>

                        <div>

                            <div class="text-sm font-bold
                                        text-slate-800">

                                Soal {{ $index + 1 }}

                            </div>

                            <div class="text-xs
                                        text-slate-500">

                                Bobot:
                                {{ $item->bobot ?? $soal?->bobot ?? 0 }}

                            </div>

                        </div>

                    </div>


                    {{-- STATUS SOAL --}}
                    @if (!$jawabanDipilih)

                        <span class="inline-flex
                                     items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-slate-100
                                     text-slate-600
                                     text-xs font-semibold">

                            <i data-lucide="minus-circle"
                               class="w-3.5 h-3.5"></i>

                            Tidak Dijawab

                        </span>

                    @elseif ($benar)

                        <span class="inline-flex
                                     items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-emerald-50
                                     text-emerald-700
                                     text-xs font-semibold">

                            <i data-lucide="circle-check"
                               class="w-3.5 h-3.5"></i>

                            Benar

                        </span>

                    @else

                        <span class="inline-flex
                                     items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-red-50
                                     text-red-700
                                     text-xs font-semibold">

                            <i data-lucide="circle-x"
                               class="w-3.5 h-3.5"></i>

                            Salah

                        </span>

                    @endif

                </div>


                <div class="p-5 sm:p-6">

                    @if ($soal)

                        {{-- PERTANYAAN --}}
                        <div class="mb-6">

                            <div class="text-xs font-semibold
                                        uppercase tracking-wide
                                        text-slate-400 mb-2">

                                Pertanyaan

                            </div>

                            <div class="text-base sm:text-[17px]
                                        leading-7 font-medium
                                        text-slate-800">

                                {!! nl2br(e($soal->pertanyaan)) !!}

                            </div>

                        </div>


                        {{-- PILIHAN --}}
                        <div class="space-y-3">

                            @foreach (['A', 'B', 'C', 'D', 'E'] as $pilihan)

                                @php

                                    $field =
                                        'pilihan_' .
                                        strtolower($pilihan);

                                    $isiPilihan =
                                        $soal->{$field};

                                @endphp


                                @if (!empty($isiPilihan))

                                    @php

                                        $isPeserta =
                                            $jawabanDipilih === $pilihan;

                                        $isBenar =
                                            $jawabanBenar === $pilihan;

                                        $isSalah =
                                            $isPeserta &&
                                            $jawabanBenar !== $pilihan;

                                    @endphp


                                    <div
                                        class="
                                            flex items-start gap-3
                                            p-4 rounded-xl border
                                            transition
                                            {{ $isBenar
                                                ? 'border-emerald-300 bg-emerald-50'
                                                : ($isSalah
                                                    ? 'border-red-300 bg-red-50'
                                                    : 'border-slate-200 bg-white')
                                            }}
                                        "
                                    >

                                        {{-- HURUF --}}
                                        <div class="
                                            w-9 h-9 rounded-lg
                                            flex items-center
                                            justify-center
                                            shrink-0
                                            text-sm font-bold
                                            {{ $isBenar
                                                ? 'bg-emerald-100 text-emerald-700'
                                                : ($isSalah
                                                    ? 'bg-red-100 text-red-700'
                                                    : 'bg-slate-100 text-slate-600')
                                            }}
                                        ">

                                            {{ $pilihan }}

                                        </div>


                                        {{-- ISI --}}
                                        <div class="flex-1 min-w-0">

                                            <div class="text-sm
                                                        leading-6
                                                        text-slate-700">

                                                {{ $isiPilihan }}

                                            </div>


                                            {{-- LABEL --}}
                                            @if ($isPeserta || $isBenar)

                                                <div class="flex flex-wrap
                                                            items-center
                                                            gap-2 mt-2">

                                                    @if ($isPeserta)

                                                        <span class="inline-flex
                                                                     items-center
                                                                     gap-1.5
                                                                     px-2 py-1
                                                                     rounded-lg
                                                                     bg-blue-50
                                                                     text-blue-700
                                                                     text-xs
                                                                     font-semibold">

                                                            <i data-lucide="user-check"
                                                               class="w-3.5 h-3.5"></i>

                                                            Jawaban Peserta

                                                        </span>

                                                    @endif


                                                    @if ($isBenar)

                                                        <span class="inline-flex
                                                                     items-center
                                                                     gap-1.5
                                                                     px-2 py-1
                                                                     rounded-lg
                                                                     bg-emerald-100
                                                                     text-emerald-700
                                                                     text-xs
                                                                     font-semibold">

                                                            <i data-lucide="badge-check"
                                                               class="w-3.5 h-3.5"></i>

                                                            Jawaban Benar

                                                        </span>

                                                    @endif

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                @endif

                            @endforeach

                        </div>


                        {{-- RINGKASAN JAWABAN --}}
                        <div class="grid grid-cols-1
                                    sm:grid-cols-2
                                    lg:grid-cols-4
                                    gap-3 mt-6 pt-5
                                    border-t border-slate-200">

                            {{-- JAWABAN PESERTA --}}
                            <div class="rounded-xl
                                        border border-blue-200
                                        bg-blue-50/40
                                        p-4">

                                <div class="text-xs
                                            text-blue-700
                                            font-medium">

                                    Jawaban Peserta

                                </div>

                                <div class="mt-1 text-lg
                                            font-extrabold
                                            text-blue-700">

                                    {{ $jawabanDipilih ?? 'Tidak dijawab' }}

                                </div>

                            </div>


                            {{-- JAWABAN BENAR --}}
                            <div class="rounded-xl
                                        border border-emerald-200
                                        bg-emerald-50/40
                                        p-4">

                                <div class="text-xs
                                            text-emerald-700
                                            font-medium">

                                    Jawaban Benar

                                </div>

                                <div class="mt-1 text-lg
                                            font-extrabold
                                            text-emerald-700">

                                    {{ $jawabanBenar ?? '-' }}

                                </div>

                            </div>


                            {{-- BOBOT --}}
                            <div class="rounded-xl
                                        border border-slate-200
                                        bg-slate-50
                                        p-4">

                                <div class="text-xs
                                            text-slate-500
                                            font-medium">

                                    Bobot

                                </div>

                                <div class="mt-1 text-lg
                                            font-extrabold
                                            text-slate-700">

                                    {{ $item->bobot ?? $soal->bobot ?? 0 }}

                                </div>

                            </div>


                            {{-- HASIL --}}
                            <div class="
                                rounded-xl border p-4
                                {{ !$jawabanDipilih
                                    ? 'border-slate-200 bg-slate-50'
                                    : ($benar
                                        ? 'border-emerald-200 bg-emerald-50/40'
                                        : 'border-red-200 bg-red-50/40')
                                }}
                            ">

                                <div class="
                                    text-xs font-medium
                                    {{ !$jawabanDipilih
                                        ? 'text-slate-500'
                                        : ($benar
                                            ? 'text-emerald-700'
                                            : 'text-red-700')
                                    }}
                                ">

                                    Hasil Jawaban

                                </div>


                                <div class="mt-2">

                                    @if (!$jawabanDipilih)

                                        <span class="inline-flex
                                                     items-center gap-1.5
                                                     text-sm font-bold
                                                     text-slate-600">

                                            <i data-lucide="minus-circle"
                                               class="w-4 h-4"></i>

                                            Tidak Dijawab

                                        </span>

                                    @elseif ($benar)

                                        <span class="inline-flex
                                                     items-center gap-1.5
                                                     text-sm font-bold
                                                     text-emerald-700">

                                            <i data-lucide="circle-check"
                                               class="w-4 h-4"></i>

                                            Benar

                                        </span>

                                    @else

                                        <span class="inline-flex
                                                     items-center gap-1.5
                                                     text-sm font-bold
                                                     text-red-700">

                                            <i data-lucide="circle-x"
                                               class="w-4 h-4"></i>

                                            Salah

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @else

                        {{-- SOAL TIDAK DITEMUKAN --}}
                        <div class="flex items-center gap-3
                                    rounded-xl
                                    border border-amber-200
                                    bg-amber-50
                                    px-4 py-4
                                    text-sm text-amber-700">

                            <i data-lucide="triangle-alert"
                               class="w-5 h-5 shrink-0"></i>

                            <div>

                                <div class="font-semibold">
                                    Data soal tidak ditemukan
                                </div>

                                <div class="mt-0.5">
                                    Data soal sudah tidak ditemukan.
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="bg-white rounded-2xl
                        border border-slate-200
                        shadow-sm">

                <div class="flex flex-col
                            items-center justify-center
                            px-6 py-14 text-center">

                    <div class="w-16 h-16 rounded-2xl
                                bg-slate-100
                                flex items-center justify-center
                                text-slate-400">

                        <i data-lucide="clipboard-x"
                           class="w-8 h-8"></i>

                    </div>

                    <h3 class="mt-4
                               text-base font-bold
                               text-slate-700">

                        Jawaban Belum Tersedia

                    </h3>

                    <p class="mt-1
                              text-sm text-slate-500">

                        Jawaban peserta belum tersedia.

                    </p>

                </div>

            </div>

        @endforelse

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

