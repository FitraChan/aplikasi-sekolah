@extends('layout.app')

@section('title', 'Tambah Jadwal Wawancara')
@section('page_title', 'Tambah Jadwal Wawancara')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0 overflow-y-auto">

    <div class="w-full space-y-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center text-xs font-medium text-slate-500 gap-1.5 mb-2.5">

            <a href="{{ url('/') }}" class="hover:text-slate-700">
                Dashboard
            </a>

            <svg class="w-3.5 h-3.5 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M9 5l7 7-7 7"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2">
                </path>
            </svg>

            <a href="{{ route('jadwal-wawancara.index') }}"
                class="hover:text-slate-700">
                Jadwal Wawancara
            </a>

            <svg class="w-3.5 h-3.5 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M9 5l7 7-7 7"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2">
                </path>
            </svg>

            <span class="text-[#02BC9C] font-semibold">
                Tambah Wawancara
            </span>

        </nav>


        {{-- Page Header --}}
        <div class="mb-7">

            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">
                Tambah Jadwal Wawancara
            </h2>

            <p class="text-slate-500 text-sm mt-1.5 leading-relaxed">
                Lengkapi formulir di bawah ini untuk menambahkan jadwal wawancara calon siswa.
            </p>

        </div>


        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">


            {{-- =========================
                 FORM
            ========================== --}}
            <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/80 p-8 shadow-sm">

                <form id="formJadwalWawancara"
                    action="{{ route('jadwal-wawancara.store') }}"
                    method="POST"
                    class="space-y-8">

                    @csrf


                    {{-- =========================
                         STEP 1
                    ========================== --}}
                    <section class="space-y-3">

                        <div class="flex items-center gap-3">

                            <span class="w-6 h-6 rounded-full bg-[#02BC9C] text-white flex items-center justify-center text-xs font-semibold">
                                1
                            </span>

                            <h3 class="text-base font-semibold text-slate-800">
                                Pilih Calon Siswa
                            </h3>

                        </div>


                        <div class="pl-9 space-y-1.5">

                            <label
                                class="block text-sm font-medium text-slate-700"
                                for="id_calon_siswa">

                                Nama atau ID Pendaftaran

                            </label>


                            <div class="relative">

                                <select
                                    name="id_calon_siswa"
                                    id="id_calon_siswa"
                                    required
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-600 appearance-none focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C] pr-10">

                                    <option value="">
                                        Pilih calon siswa...
                                    </option>

                                    @foreach ($calonSiswa as $siswa)

                                    <option
                                        value="{{ $siswa->id }}"
                                        data-nama="{{ $siswa->nama_lengkap }}"
                                        data-no-daftar="{{ $siswa->no_daftar }}"
                                        data-jurusan="{{ $siswa->jurusan->nama_jurusan ?? '-' }}"
                                        data-sekolah="{{ $siswa->nama_sekolah_asal ?? '-' }}"
                                        data-jk="{{ $siswa->jk ?? '-' }}">

                                        {{ $siswa->nama_lengkap }}
                                        @if ($siswa->no_daftar)
                                        ({{ $siswa->no_daftar }})
                                        @endif

                                    </option>

                                    @endforeach

                                </select>


                                <div class="absolute inset-y-0 right-0 flex items-center px-3.5 pointer-events-none text-slate-400">

                                    <svg
                                        class="w-4 h-4 stroke-[2]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            d="M19 9l-7 7-7-7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                    </svg>

                                </div>

                            </div>

                            <p
                                id="error-id_calon_siswa"
                                class="text-xs text-red-500 hidden">
                            </p>

                        </div>

                    </section>



                    {{-- =========================
                         STEP 2
                    ========================== --}}
                    <section class="space-y-3">

                        <div class="flex items-center gap-3">

                            <span class="w-6 h-6 rounded-full bg-[#02BC9C] text-white flex items-center justify-center text-xs font-semibold">
                                2
                            </span>

                            <h3 class="text-base font-semibold text-slate-800">
                                Waktu Pelaksanaan
                            </h3>

                        </div>


                        <div class="pl-9 grid grid-cols-1 sm:grid-cols-2 gap-4">

                            {{-- Tanggal --}}
                            <div class="space-y-1.5">

                                <label
                                    class="block text-sm font-medium text-slate-700"
                                    for="tanggal">

                                    Tanggal Wawancara

                                </label>

                                <input
                                    type="date"
                                    name="tanggal"
                                    id="tanggal"
                                    required
                                    value="{{ old('tanggal') }}"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C]">

                                <p
                                    id="error-tanggal"
                                    class="text-xs text-red-500 hidden">
                                </p>

                            </div>


                            {{-- Jam Mulai --}}
                            <div class="space-y-1.5">

                                <label
                                    class="block text-sm font-medium text-slate-700"
                                    for="jam_mulai">

                                    Jam Mulai

                                </label>

                                <input
                                    type="time"
                                    name="jam_mulai"
                                    id="jam_mulai"
                                    required
                                    value="{{ old('jam_mulai') }}"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C]">

                                <p
                                    id="error-jam_mulai"
                                    class="text-xs text-red-500 hidden">
                                </p>

                            </div>


                            {{-- Jam Selesai --}}
                            <div class="space-y-1.5">

                                <label
                                    class="block text-sm font-medium text-slate-700"
                                    for="jam_selesai">

                                    Jam Selesai

                                    <span class="text-slate-400 font-normal">
                                        (Opsional)
                                    </span>

                                </label>

                                <input
                                    type="time"
                                    name="jam_selesai"
                                    id="jam_selesai"
                                    value="{{ old('jam_selesai') }}"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C]">

                                <p class="text-xs text-slate-400">
                                    Jika kosong, sistem menganggap durasi 1 jam.
                                </p>

                            </div>

                        </div>

                    </section>



                    {{-- =========================
                         STEP 3
                    ========================== --}}
                    <section class="space-y-3">

                        <div class="flex items-center gap-3">

                            <span class="w-6 h-6 rounded-full bg-[#02BC9C] text-white flex items-center justify-center text-xs font-semibold">
                                3
                            </span>

                            <h3 class="text-base font-semibold text-slate-800">
                                Lokasi Wawancara
                            </h3>

                        </div>


                        <div class="pl-9 space-y-4">

                            <div class="space-y-1.5">

                                <label
                                    class="block text-sm font-medium text-slate-700"
                                    for="tempat">

                                    Tempat / Link Wawancara

                                </label>

                                <input
                                    type="text"
                                    name="tempat"
                                    id="tempat"
                                    value="{{ old('tempat') }}"
                                    placeholder="Contoh: Ruang Rapat 1 / Link Google Meet"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C]">

                                <p class="text-xs text-slate-400">
                                    Isi nama ruangan jika luring atau link meeting jika daring.
                                </p>

                            </div>

                        </div>

                    </section>



                    {{-- =========================
                         STEP 4
                    ========================== --}}
                    <section class="space-y-3">

                        <div class="flex items-center gap-3">

                            <span class="w-6 h-6 rounded-full bg-[#02BC9C] text-white flex items-center justify-center text-xs font-semibold">
                                4
                            </span>

                            <h3 class="text-base font-semibold text-slate-800">
                                Pewawancara
                            </h3>

                        </div>


                        <div class="pl-9 space-y-1.5">

                            <label
                                class="block text-sm font-medium text-slate-700"
                                for="id_gtk">

                                Pilih Guru / Staff

                            </label>


                            <div class="relative">

                                <select name="id_gtk" id="id_gtk" required class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-600">
                                    <option value=""> Pilih pewawancara... </option> @foreach ($gtk as $guru) <option value="{{ $guru->id }}"> {{ $guru->nama_gtk }} </option> @endforeach
                                </select>


                                <div class="absolute inset-y-0 right-0 flex items-center px-3.5 pointer-events-none text-slate-400">

                                    <svg
                                        class="w-4 h-4 stroke-[2]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            d="M19 9l-7 7-7-7"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>

                                    </svg>

                                </div>

                            </div>

                            <p
                                id="error-id_gtk"
                                class="text-xs text-red-500 hidden">
                            </p>

                        </div>

                    </section>



                    {{-- =========================
                         STEP 5 STATUS
                    ========================== --}}
                    <section class="space-y-3">

                        <div class="flex items-center gap-3">

                            <span class="w-6 h-6 rounded-full bg-[#02BC9C] text-white flex items-center justify-center text-xs font-semibold">
                                5
                            </span>

                            <h3 class="text-base font-semibold text-slate-800">
                                Status & Catatan
                            </h3>

                        </div>


                        <div class="pl-9 grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div class="space-y-1.5">

                                <label
                                    class="block text-sm font-medium text-slate-700"
                                    for="status">

                                    Status

                                </label>

                                <select
                                    name="status"
                                    id="status"
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-600 focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C]">

                                    <option value="terjadwal" selected>
                                        Terjadwal
                                    </option>

                                    <option value="selesai">
                                        Selesai
                                    </option>

                                    <option value="batal">
                                        Batal
                                    </option>

                                    <option value="tidak_hadir">
                                        Tidak Hadir
                                    </option>

                                </select>

                            </div>


                            <div class="space-y-1.5">

                                <label
                                    class="block text-sm font-medium text-slate-700"
                                    for="catatan">

                                    Catatan
                                </label>

                                <textarea
                                    name="catatan"
                                    id="catatan"
                                    rows="2"
                                    placeholder="Catatan tambahan..."
                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20 focus:border-[#02BC9C]">{{ old('catatan') }}</textarea>

                            </div>

                        </div>

                    </section>



                    {{-- ACTION --}}
                    <div class="pt-4 border-t border-slate-100 flex items-center gap-5 pl-9">

                        <button
                            type="submit"
                            id="btnSimpan"
                            class="px-6 py-2.5 bg-[#02BC9C] hover:bg-[#02a387] text-white font-medium text-sm rounded-xl transition shadow-sm">

                            <span id="textSimpan">
                                Simpan Jadwal
                            </span>

                            <span
                                id="loadingSimpan"
                                class="hidden">

                                Menyimpan...

                            </span>

                        </button>


                        <a
                            href="{{ route('jadwal-wawancara.index') }}"
                            class="text-sm font-medium text-slate-700 hover:text-slate-900 transition">

                            Batalkan

                        </a>

                    </div>

                </form>

            </div>



            {{-- =========================
                 SIDEBAR
            ========================== --}}
            <div class="lg:col-span-4 space-y-6">


                {{-- Applicant Briefing --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm">

                    <div class="bg-[#02BC9C] text-white text-center py-6 px-4">

                        <h4 class="font-semibold text-base">
                            Applicant Briefing
                        </h4>

                        <p class="text-xs text-white/90 mt-1">
                            Rangkuman data calon siswa
                        </p>

                    </div>


                    {{-- Empty --}}
                    <div
                        id="briefing-empty"
                        class="p-8 flex flex-col items-center justify-center text-center">

                        <div class="w-20 h-20 rounded-full bg-slate-100/90 flex items-center justify-center text-slate-400 mb-4">

                            <svg
                                class="w-10 h-10 stroke-[1.5]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <circle cx="12" cy="12" r="9"></circle>

                                <path
                                    d="M16 17a4 4 0 00-8 0"
                                    stroke-linecap="round">
                                </path>

                                <circle cx="12" cy="10" r="2.5"></circle>

                            </svg>

                        </div>

                        <p class="text-sm text-slate-500 max-w-[210px] leading-relaxed">
                            Silakan pilih calon siswa untuk melihat detail ringkasan di sini.
                        </p>

                    </div>


                    {{-- Dynamic Briefing --}}
                    <div
                        id="briefing-content"
                        class="hidden p-6">

                        <div class="flex items-center gap-4 mb-5">

                            <div
                                id="briefing-avatar"
                                class="w-14 h-14 rounded-full bg-[#e6f9f5] text-[#02BC9C] flex items-center justify-center font-bold text-lg">

                                -

                            </div>

                            <div class="min-w-0">

                                <h4
                                    id="briefing-nama"
                                    class="font-semibold text-slate-800 truncate">
                                    -
                                </h4>

                                <p
                                    id="briefing-no-daftar"
                                    class="text-xs text-slate-500 mt-0.5">
                                    -
                                </p>

                            </div>

                        </div>


                        <div class="space-y-3 text-sm">

                            <div class="flex justify-between gap-4">

                                <span class="text-slate-500">
                                    Jurusan
                                </span>

                                <span
                                    id="briefing-jurusan"
                                    class="font-medium text-slate-700 text-right">
                                    -
                                </span>

                            </div>


                            <div class="flex justify-between gap-4">

                                <span class="text-slate-500">
                                    Jenis Kelamin
                                </span>

                                <span
                                    id="briefing-jk"
                                    class="font-medium text-slate-700 text-right">
                                    -
                                </span>

                            </div>


                            <div class="flex justify-between gap-4">

                                <span class="text-slate-500">
                                    Sekolah Asal
                                </span>

                                <span
                                    id="briefing-sekolah"
                                    class="font-medium text-slate-700 text-right max-w-[180px]">
                                    -
                                </span>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- Tips --}}
                <div class="bg-[#02BC9C] text-white rounded-2xl p-5 shadow-sm flex items-start gap-3.5">

                    <div class="mt-0.5 shrink-0 text-white/90">

                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 24 24">

                            <path d="M12 2C8.13 2 5 5.13 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.87-3.13-7-7-7zm-2 18c0 .55.45 1 1 1h2c.55 0 1-.45 1-1v-1h-4v1z">
                            </path>

                        </svg>

                    </div>

                    <div>

                        <h5 class="text-sm font-semibold leading-snug">
                            Tips Penjadwalan
                        </h5>

                        <p class="text-xs text-white/90 mt-1 leading-relaxed">

                            Satu sesi wawancara biasanya memakan waktu
                            30–45 menit. Pastikan memberi jeda istirahat
                            bagi pewawancara.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<link
    href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css"
    rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new TomSelect('#id_gtk', {
            placeholder: 'Pilih pewawancara...',
            allowEmptyOption: true,
            create: false,
            maxOptions: 1000,
            sortField: {
                field: 'text',
                direction: 'asc'
            },
            searchField: ['text'],
            dropdownInput: true
        });
    });


    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('formJadwalWawancara');

        const calonSiswa = document.getElementById('id_calon_siswa');

        const briefingEmpty = document.getElementById('briefing-empty');
        const briefingContent = document.getElementById('briefing-content');


        /*
        |--------------------------------------------------------------------------
        | Pilih Calon Siswa
        |--------------------------------------------------------------------------
        */

        calonSiswa.addEventListener('change', function() {

            const option = this.options[this.selectedIndex];

            if (!this.value) {

                briefingEmpty.classList.remove('hidden');
                briefingContent.classList.add('hidden');

                return;
            }


            const nama =
                option.dataset.nama || '-';

            const noDaftar =
                option.dataset.noDaftar || '-';

            const jurusan =
                option.dataset.jurusan || '-';

            const sekolah =
                option.dataset.sekolah || '-';

            const jk =
                option.dataset.jk || '-';


            document.getElementById('briefing-nama').innerText =
                nama;

            document.getElementById('briefing-no-daftar').innerText =
                noDaftar;

            document.getElementById('briefing-jurusan').innerText =
                jurusan;

            document.getElementById('briefing-sekolah').innerText =
                sekolah;


            let jenisKelamin = jk;

            if (jk === 'L') {
                jenisKelamin = 'Laki-laki';
            }

            if (jk === 'P') {
                jenisKelamin = 'Perempuan';
            }

            document.getElementById('briefing-jk').innerText =
                jenisKelamin;


            document.getElementById('briefing-avatar').innerText =
                nama.charAt(0).toUpperCase();


            briefingEmpty.classList.add('hidden');
            briefingContent.classList.remove('hidden');

        });



        /*
        |--------------------------------------------------------------------------
        | Submit Form
        |--------------------------------------------------------------------------
        */

        form.addEventListener('submit', async function(event) {

            event.preventDefault();


            const btnSimpan =
                document.getElementById('btnSimpan');

            const textSimpan =
                document.getElementById('textSimpan');

            const loadingSimpan =
                document.getElementById('loadingSimpan');


            btnSimpan.disabled = true;

            btnSimpan.classList.add('opacity-70', 'cursor-not-allowed');

            textSimpan.classList.add('hidden');

            loadingSimpan.classList.remove('hidden');


            /*
            |--------------------------------------------------------------------------
            | Bersihkan Error
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('[id^="error-"]').forEach(function(element) {

                element.innerText = '';

                element.classList.add('hidden');

            });


            try {

                const response = await fetch(
                    form.action, {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]'
                                )?.getAttribute('content') ??
                                '{{ csrf_token() }}',

                            'Accept': 'application/json'
                        },

                        body: new FormData(form)
                    }
                );


                const result = await response.json();


                /*
                |--------------------------------------------------------------------------
                | Validation Error
                |--------------------------------------------------------------------------
                */

                if (response.status === 422) {

                    if (result.errors) {

                        Object.keys(result.errors).forEach(function(field) {

                            const errorElement =
                                document.getElementById(
                                    'error-' + field
                                );

                            if (errorElement) {

                                errorElement.innerText =
                                    result.errors[field][0];

                                errorElement.classList.remove('hidden');

                            }

                        });

                    }


                    alert(
                        result.message ??
                        'Data belum lengkap atau tidak valid.'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Error lainnya
                |--------------------------------------------------------------------------
                */

                if (!response.ok) {

                    alert(
                        result.message ??
                        'Terjadi kesalahan saat menyimpan jadwal.'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Berhasil
                |--------------------------------------------------------------------------
                */

                alert(
                    result.message ??
                    'Jadwal wawancara berhasil disimpan.'
                );


                window.location.href =
                    "{{ route('jadwal-wawancara.index') }}";


            } catch (error) {

                console.error(error);

                alert(
                    'Terjadi kesalahan koneksi ke server.'
                );

            } finally {

                btnSimpan.disabled = false;

                btnSimpan.classList.remove(
                    'opacity-70',
                    'cursor-not-allowed'
                );

                textSimpan.classList.remove('hidden');

                loadingSimpan.classList.add('hidden');

            }

        });

    });
</script>

@endsection