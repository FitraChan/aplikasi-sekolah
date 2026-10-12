@extends('layout.app')

@section('title', 'Hasil Wawancara')
@section('page_title', 'Hasil Wawancara')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    <div class="max-w-[1400px] mx-auto space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Hasil Wawancara
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Detail hasil wawancara calon siswa
                </p>
            </div>

            <div class="flex items-center gap-2">

                <a href="{{ url()->previous() }}"
                   class="inline-flex items-center justify-center gap-2
                          px-4 py-2.5 rounded-lg
                          border border-slate-300
                          bg-white text-slate-600
                          text-sm font-medium
                          hover:bg-slate-50 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7" />

                    </svg>

                    Kembali
                </a>

                <button type="button"
                        onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2
                               px-4 py-2.5 rounded-lg
                               bg-brand-teal text-white
                               text-sm font-medium
                               hover:opacity-90 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-12 0h12v4H6v-4z" />

                    </svg>

                    Cetak
                </button>

            </div>
        </div>


        {{-- ========================================================= --}}
        {{-- BIODATA + INFORMASI WAWANCARA --}}
        {{-- ========================================================= --}}

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- BIODATA --}}
            <section class="lg:col-span-5 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

                <div class="bg-brand-teal px-5 py-3 text-white">

                    <h3 class="text-sm font-bold tracking-wider uppercase">
                        Biodata Calon Siswa
                    </h3>

                </div>

                <div class="p-5">

                    <div class="space-y-3 text-sm">

                        {{-- Kode --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Kode Calon Siswa
                            </div>

                            <div class="col-span-7 font-semibold text-slate-800">
                                {{ $hasil->calonSiswa->kode_calon_siswa ?? '-' }}
                            </div>

                        </div>

                        {{-- No Daftar --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                No. Pendaftaran
                            </div>

                            <div class="col-span-7 font-semibold text-slate-800">
                                {{ $hasil->calonSiswa->no_daftar ?? '-' }}
                            </div>

                        </div>

                        {{-- Nama --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Nama
                            </div>

                            <div class="col-span-7 font-semibold text-slate-800">
                                {{ $hasil->calonSiswa->nama_lengkap ?? '-' }}
                            </div>

                        </div>

                        {{-- Alamat --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Alamat
                            </div>

                            <div class="col-span-7 text-slate-700">
                                {{ $hasil->calonSiswa->alamat ?? '-' }}
                            </div>

                        </div>

                        {{-- Tempat tanggal lahir --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Tempat / Tgl Lahir
                            </div>

                            <div class="col-span-7 text-slate-700">

                                {{ $hasil->calonSiswa->tmp_lahir ?? '-' }}

                                @if($hasil->calonSiswa->tgl_lahir)
                                    /
                                    {{ \Carbon\Carbon::parse($hasil->calonSiswa->tgl_lahir)->translatedFormat('d F Y') }}
                                @endif

                            </div>

                        </div>

                        {{-- Asal sekolah --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Asal Sekolah
                            </div>

                            <div class="col-span-7 text-slate-700">
                                {{ $hasil->calonSiswa->asal_sekolah ?? '-' }}
                            </div>

                        </div>

                        {{-- Ranking --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Ranking
                            </div>

                            <div class="col-span-7 text-slate-700">
                                {{ $hasil->calonSiswa->ranking ?? '-' }}
                            </div>

                        </div>

                        {{-- Jurusan --}}
                        <div class="grid grid-cols-12 gap-3">

                            <div class="col-span-5 text-slate-500">
                                Jurusan Pilihan
                            </div>

                            <div class="col-span-7 font-semibold text-slate-800">
                                {{ $hasil->calonSiswa->jurusan->nama_jurusan ?? '-' }}
                            </div>

                        </div>

                    </div>

                </div>

                {{-- INFO WAWANCARA --}}
                <div class="border-t border-slate-200 bg-slate-50 p-5">

                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-4">
                        Informasi Wawancara
                    </div>

                    <div class="space-y-3 text-sm">

                        <div class="flex justify-between gap-4">

                            <span class="text-slate-500">
                                Tanggal
                            </span>

                            <span class="font-medium text-slate-800">
                                @if($hasil->tanggal_wawancara)
                                    {{ \Carbon\Carbon::parse($hasil->tanggal_wawancara)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </span>

                        </div>

                        <div class="flex justify-between gap-4">

                            <span class="text-slate-500">
                                Jam
                            </span>

                            <span class="font-medium text-slate-800">

                                @if($hasil->jam_wawancara)
                                    {{ \Carbon\Carbon::parse($hasil->jam_wawancara)->format('H:i') }}
                                @else
                                    -
                                @endif

                            </span>

                        </div>

                        <div class="flex justify-between gap-4">

                            <span class="text-slate-500">
                                Tempat
                            </span>

                            <span class="font-medium text-slate-800 text-right">
                                {{ $hasil->jadwalWawancara->tempat ?? '-' }}
                            </span>

                        </div>

                        <div class="flex justify-between gap-4">

                            <span class="text-slate-500">
                                Pewawancara
                            </span>

                            <span class="font-medium text-slate-800 text-right">
                                {{ $hasil->gtk->nama_gtk ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            {{-- ===================================================== --}}
            {{-- NILAI WAWANCARA --}}
            {{-- ===================================================== --}}

            <section class="lg:col-span-7 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

                <div class="bg-brand-teal px-5 py-3 text-white">

                    <h3 class="text-sm font-bold tracking-wider uppercase">
                        Penilaian Wawancara
                    </h3>

                </div>

                <div class="p-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- ORGANISASI --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Organisasi
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_organisasi, 2) }}
                                </span>

                            </div>

                        </div>

                        {{-- PRESTASI --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Prestasi
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_prestasi, 2) }}
                                </span>

                            </div>

                        </div>

                        {{-- PENYAKIT --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Penyakit Kronis
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_penyakit, 2) }}
                                </span>

                            </div>

                            <div class="mt-2 text-xs text-slate-500">

                                Status:
                                <span class="font-semibold
                                    {{ $hasil->penyakit_kronis === 'ya'
                                        ? 'text-red-500'
                                        : 'text-green-600' }}">

                                    {{ ucfirst($hasil->penyakit_kronis) }}

                                </span>

                            </div>

                        </div>

                        {{-- BUTA WARNA --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Buta Warna
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_buta_warna, 2) }}
                                </span>

                            </div>

                            <div class="mt-2 text-xs text-slate-500">

                                Status:
                                <span class="font-semibold
                                    {{ $hasil->buta_warna === 'ya'
                                        ? 'text-red-500'
                                        : 'text-green-600' }}">

                                    {{ ucfirst($hasil->buta_warna) }}

                                </span>

                            </div>

                        </div>

                        {{-- ATTITUDE --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Attitude
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_attitude, 2) }}
                                </span>

                            </div>

                        </div>

                        {{-- WAWASAN --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Wawasan
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_wawasan, 2) }}
                                </span>

                            </div>

                        </div>

                        {{-- KEMAMPUAN --}}
                        <div class="border border-slate-200 rounded-lg p-4">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-slate-600">
                                    Kemampuan
                                </span>

                                <span class="text-lg font-bold text-brand-teal">
                                    {{ number_format($hasil->nilai_kemampuan, 2) }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- NILAI AKHIR --}}
                    <div class="mt-5 rounded-xl border border-brand-teal/20 bg-brand-teal/5 p-5">

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <div>

                                <div class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Nilai Akhir Wawancara
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    Rata-rata 7 komponen penilaian
                                </div>

                            </div>

                            <div class="text-3xl font-bold text-brand-teal">

                                {{ number_format($hasil->nilai_akhir, 2) }}

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>


        {{-- ========================================================= --}}
        {{-- INFORMASI TAMBAHAN --}}
        {{-- ========================================================= --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- KONDISI KESEHATAN --}}
            <section class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

                <div class="px-5 py-3 border-b border-slate-200">

                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">
                        Informasi Kesehatan
                    </h3>

                </div>

                <div class="p-5 space-y-5">

                    <div>

                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                            Riwayat Penyakit
                        </div>

                        <div class="text-sm text-slate-700 bg-slate-50 rounded-lg p-4">

                            {{ $hasil->riwayat_penyakit ?: 'Tidak ada keterangan.' }}

                        </div>

                    </div>

                    <div>

                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                            Pengalaman Kerja
                        </div>

                        <div class="text-sm text-slate-700 bg-slate-50 rounded-lg p-4">

                            {{ $hasil->pengalaman_kerja ?: 'Tidak ada keterangan.' }}

                        </div>

                    </div>

                </div>

            </section>


            {{-- KONDISI KELUARGA --}}
            <section class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

                <div class="px-5 py-3 border-b border-slate-200">

                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">
                        Informasi Keluarga & Minat
                    </h3>

                </div>

                <div class="p-5 space-y-4">

                    <div class="grid grid-cols-2 gap-4">

                        <div class="bg-slate-50 rounded-lg p-4">

                            <div class="text-xs text-slate-500 mb-1">
                                Pekerjaan Ayah
                            </div>

                            <div class="text-sm font-semibold text-slate-800">
                                {{ $hasil->pekerjaan_ayah ?: '-' }}
                            </div>

                        </div>

                        <div class="bg-slate-50 rounded-lg p-4">

                            <div class="text-xs text-slate-500 mb-1">
                                Pekerjaan Ibu
                            </div>

                            <div class="text-sm font-semibold text-slate-800">
                                {{ $hasil->pekerjaan_ibu ?: '-' }}
                            </div>

                        </div>

                    </div>

                    <div>

                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                            Hobi
                        </div>

                        <div class="text-sm text-slate-700 bg-slate-50 rounded-lg p-4">

                            {{ $hasil->hobi ?: '-' }}

                        </div>

                    </div>

                </div>

            </section>

        </div>


        {{-- ========================================================= --}}
        {{-- KESIMPULAN --}}
        {{-- ========================================================= --}}

        <section class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

            <div class="bg-brand-teal px-5 py-3 text-white">

                <h3 class="text-sm font-bold tracking-wider uppercase">
                    Kesimpulan Wawancara
                </h3>

            </div>

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- STATUS --}}
                    <div class="border border-slate-200 rounded-xl p-5">

                        <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                            Status Kelulusan
                        </div>

                        @php
                            $statusClass = match ($hasil->status_lulus) {
                                'Lulus' => 'bg-green-100 text-green-700 border-green-200',
                                'Tidak Lulus' => 'bg-red-100 text-red-700 border-red-200',
                                'Cadangan' => 'bg-amber-100 text-amber-700 border-amber-200',
                                default => 'bg-slate-100 text-slate-600 border-slate-200',
                            };
                        @endphp

                        <span class="inline-flex items-center px-4 py-2 rounded-lg border text-sm font-bold {{ $statusClass }}">

                            {{ $hasil->status_lulus }}

                        </span>

                    </div>


                    {{-- JURUSAN REKOMENDASI --}}
                    <div class="border border-slate-200 rounded-xl p-5">

                        <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                            Jurusan Rekomendasi
                        </div>

                        <div class="text-base font-bold text-slate-800">

                            {{ $hasil->jurusan->nama_jurusan ?? 'Tidak ada rekomendasi' }}

                        </div>

                    </div>


                    {{-- NILAI --}}
                    <div class="border border-slate-200 rounded-xl p-5">

                        <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                            Nilai Akhir
                        </div>

                        <div class="text-3xl font-bold text-brand-teal">

                            {{ number_format($hasil->nilai_akhir, 2) }}

                        </div>

                    </div>

                </div>


                {{-- CATATAN --}}
                <div class="mt-5">

                    <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Catatan Pewawancara
                    </div>

                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-sm text-slate-700 leading-relaxed">

                        {{ $hasil->catatan ?: 'Tidak ada catatan.' }}

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================================================= --}}
        {{-- FOOTER --}}
        {{-- ========================================================= --}}

        <div class="text-xs text-slate-400 text-center pb-4">

            Hasil wawancara diinput oleh
            <span class="font-semibold text-slate-600">
                {{ $hasil->gtk->nama_gtk ?? '-' }}
            </span>

            @if($hasil->created_at)
                pada
                {{ $hasil->created_at->translatedFormat('d F Y H:i') }}
            @endif

        </div>

    </div>

</main>


{{-- ============================================================= --}}
{{-- PRINT STYLE --}}
{{-- ============================================================= --}}

<style>

@media print {

    body {
        background: white !important;
    }

    nav,
    aside,
    header,
    button,
    .no-print {
        display: none !important;
    }

    main {
        padding: 0 !important;
        margin: 0 !important;
    }

    .shadow-xs {
        box-shadow: none !important;
    }

    section {
        break-inside: avoid;
    }

}

</style>

@endsection