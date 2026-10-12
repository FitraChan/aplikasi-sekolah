@extends('layout.app')

@section('title', 'Wawancara PPDB')
@section('page_title', 'Form Wawancara')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-8 min-w-0">

    <div class="max-w-[1400px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-7 items-start">

        {{-- =========================================================
            BIODATA CALON SISWA
        ========================================================== --}}
        <section class="lg:col-span-3 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

            <div class="bg-brand-teal px-4 py-3 text-white">
                <h3 class="text-sm font-bold tracking-wider uppercase">
                    BIODATA CALON MAHASISWA
                </h3>
            </div>

            <div class="p-4 space-y-2 text-sm">

                <div class="flex justify-between items-start py-2 border-b border-slate-100 gap-3">
                    <span class="font-bold text-slate-700">
                        Kode Calon Siswa
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        : {{ $jadwal->calonSiswa->kode_calon_siswa ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-start py-2 border-b border-slate-100 gap-3">
                    <span class="font-bold text-slate-700">
                        No Testing
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        : {{ $jadwal->calonSiswa->no_daftar ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-start py-2 border-b border-slate-100 gap-3">
                    <span class="font-bold text-slate-700">
                        Nama
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        : {{ $jadwal->calonSiswa->nama_lengkap ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-start py-2 border-b border-slate-100 gap-3">
                    <span class="font-bold text-slate-700">
                        Alamat
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        : {{ $jadwal->calonSiswa->alamat ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-start py-2 border-b border-slate-100 gap-3">
                    <span class="font-bold text-slate-700">
                        Tempat/Tgl Lahir
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        :
                        {{ $jadwal->calonSiswa->tmp_lahir ?? '-' }},
                        @if(!empty($jadwal->calonSiswa->tgl_lahir))
                            {{ \Carbon\Carbon::parse($jadwal->calonSiswa->tgl_lahir)->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </span>
                </div>

                <div class="flex justify-between items-start py-2 border-b border-slate-100 gap-3">
                    <span class="font-bold text-slate-700">
                        Asal Sekolah
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        : {{ $jadwal->calonSiswa->asal_sekolah ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between items-start py-2 gap-3">
                    <span class="font-bold text-slate-700">
                        Ranking
                    </span>

                    <span class="text-slate-600 font-medium text-right">
                        : {{ $jadwal->calonSiswa->ranking ?? '-' }}
                    </span>
                </div>

            </div>


            {{-- =====================================================
                INFORMASI JADWAL
            ====================================================== --}}
            <div class="border-t border-slate-200 bg-slate-50 p-4">

                <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                    INFORMASI WAWANCARA
                </div>

                <div class="space-y-2 text-sm">

                    <div class="flex justify-between gap-3">
                        <span class="text-slate-500">
                            Tanggal
                        </span>

                        <span class="font-semibold text-slate-700 text-right">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d-m-Y') }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-3">
                        <span class="text-slate-500">
                            Jam
                        </span>

                        <span class="font-semibold text-slate-700 text-right">
                            {{ substr($jadwal->jam_mulai, 0, 5) }}
                            -
                            {{ substr($jadwal->jam_selesai, 0, 5) }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-3">
                        <span class="text-slate-500">
                            Tempat
                        </span>

                        <span class="font-semibold text-slate-700 text-right">
                            {{ $jadwal->tempat ?? '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-3">
                        <span class="text-slate-500">
                            Pewawancara
                        </span>

                        <span class="font-semibold text-slate-700 text-right">
                            {{ $guru->nama_gtk ?? '-' }}
                        </span>
                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            FORM WAWANCARA
        ========================================================== --}}
        <section class="lg:col-span-9 bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs">

            <div class="bg-brand-teal px-6 py-3 text-white">
                <h3 class="text-sm font-bold tracking-wider uppercase">
                    FORM WAWANCARA
                </h3>
            </div>


            <form
                id="form-wawancara"
                action="{{ route('hasilWawancara.store') }}"
                method="POST"
                class="p-6 space-y-7 text-sm"
            >

                @csrf

                <input
                    type="hidden"
                    name="id_jadwal_wawancara"
                    value="{{ $jadwal->id }}"
                >


                {{-- =================================================
                    I. ORGANISASI
                ================================================== --}}
                <div class="space-y-2.5">

                    <label
                        class="block font-bold text-slate-800 uppercase tracking-tight text-sm"
                        for="nilai-organisasi"
                    >
                        I. PENGALAMAN ORGANISASI :
                        (DI SEKOLAH SEBELUMNYA)
                    </label>

                    <select
                        name="nilai_organisasi"
                        id="nilai-organisasi"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 focus:border-brand-teal focus:ring-brand-teal"
                    >

                        <option
                            value="60"
                            @selected(($hasil->nilai_organisasi ?? 60) == 60)
                        >
                            60 - Tidak Ada
                        </option>

                        <option
                            value="70"
                            @selected(($hasil->nilai_organisasi ?? null) == 70)
                        >
                            70 - Anggota OSIS/Ekskul
                        </option>

                        <option
                            value="80"
                            @selected(($hasil->nilai_organisasi ?? null) == 80)
                        >
                            80 - Pengurus Inti OSIS/Ekskul
                        </option>

                        <option
                            value="90"
                            @selected(($hasil->nilai_organisasi ?? null) == 90)
                        >
                            90 - Ketua OSIS/Organisasi
                        </option>

                    </select>

                </div>


                {{-- =================================================
                    II. PRESTASI
                ================================================== --}}
                <div class="space-y-2.5">

                    <label
                        class="block font-bold text-slate-800 uppercase tracking-tight text-sm"
                        for="nilai-prestasi"
                    >
                        II. PRESTASI YANG PERNAH DIRAIH :
                        (DI SEKOLAH SEBELUMNYA)
                    </label>

                    <select
                        name="nilai_prestasi"
                        id="nilai-prestasi"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 focus:border-brand-teal focus:ring-brand-teal"
                    >

                        <option
                            value="60"
                            @selected(($hasil->nilai_prestasi ?? 60) == 60)
                        >
                            60 - Tidak Ada
                        </option>

                        <option
                            value="70"
                            @selected(($hasil->nilai_prestasi ?? null) == 70)
                        >
                            70 - Tingkat Kecamatan
                        </option>

                        <option
                            value="80"
                            @selected(($hasil->nilai_prestasi ?? null) == 80)
                        >
                            80 - Tingkat Kota/Kabupaten
                        </option>

                        <option
                            value="90"
                            @selected(($hasil->nilai_prestasi ?? null) == 90)
                        >
                            90 - Tingkat Provinsi
                        </option>

                        <option
                            value="100"
                            @selected(($hasil->nilai_prestasi ?? null) == 100)
                        >
                            100 - Tingkat Nasional / Internasional
                        </option>

                    </select>

                </div>


                {{-- =================================================
                    III. PENYAKIT KRONIS
                ================================================== --}}
                <div class="space-y-3">

                    <label class="block font-bold text-slate-800 uppercase tracking-tight text-sm">
                        III. PENYAKIT KRONIS YANG PERNAH DIDERITA
                        (PERNAH OPNAME)
                    </label>

                    <div class="flex items-center gap-7 text-slate-700">

                        <label class="flex items-center gap-2 cursor-pointer font-medium">

                            <input
                                class="w-4 h-4 rounded border-slate-300 text-[#02BC9C] focus:ring-[#02BC9C]"
                                name="penyakit_kronis"
                                type="radio"
                                value="ya"
                                @checked(($hasil->penyakit_kronis ?? 'tidak') == 'ya')
                            >

                            <span>
                                Ya - (Max: 60)
                            </span>

                        </label>


                        <label class="flex items-center gap-2 cursor-pointer font-medium">

                            <input
                                class="w-4 h-4 rounded border-slate-300 text-[#02BC9C] focus:ring-[#02BC9C]"
                                name="penyakit_kronis"
                                type="radio"
                                value="tidak"
                                @checked(($hasil->penyakit_kronis ?? 'tidak') == 'tidak')
                            >

                            <span>
                                Tidak - (Max: 100)
                            </span>

                        </label>

                    </div>


                    <input
                        name="nilai_penyakit"
                        id="nilai-penyakit"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                        placeholder="Tulis Nilai (0 - 100)"
                        type="number"
                        min="0"
                        max="100"
                        value="{{ $hasil->nilai_penyakit ?? 100 }}"
                    >


                    <textarea
                        name="riwayat_penyakit"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C] resize-none"
                        placeholder="Tulis Riwayat Penyakit Calon Mahasiswa"
                        rows="3"
                    >{{ $hasil->riwayat_penyakit ?? '' }}</textarea>

                </div>


                {{-- =================================================
                    IV. BUTA WARNA
                ================================================== --}}
                <div class="space-y-3">

                    <label class="block font-bold text-slate-800 uppercase tracking-tight text-sm">
                        IV. BUTA WARNA
                    </label>

                    <div class="flex items-center gap-7 text-slate-700">

                        <label class="flex items-center gap-2 cursor-pointer font-medium">

                            <input
                                class="w-4 h-4 rounded border-slate-300 text-[#02BC9C] focus:ring-[#02BC9C]"
                                name="buta_warna"
                                type="radio"
                                value="ya"
                                @checked(($hasil->buta_warna ?? 'tidak') == 'ya')
                            >

                            <span>
                                Ya - (Max: 60)
                            </span>

                        </label>


                        <label class="flex items-center gap-2 cursor-pointer font-medium">

                            <input
                                class="w-4 h-4 rounded border-slate-300 text-[#02BC9C] focus:ring-[#02BC9C]"
                                name="buta_warna"
                                type="radio"
                                value="tidak"
                                @checked(($hasil->buta_warna ?? 'tidak') == 'tidak')
                            >

                            <span>
                                Tidak - (Max: 100)
                            </span>

                        </label>

                    </div>


                    <input
                        name="nilai_buta_warna"
                        id="nilai-buta-warna"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                        placeholder="Tulis Nilai (0 - 100)"
                        type="number"
                        min="0"
                        max="100"
                        value="{{ $hasil->nilai_buta_warna ?? 100 }}"
                    >

                </div>


                {{-- =================================================
                    V. EKONOMI
                ================================================== --}}
                <div class="space-y-3">

                    <label class="block font-bold text-slate-800 uppercase tracking-tight text-sm">
                        V. KEMAMPUAN EKONOMI
                    </label>

                    <div class="space-y-3">

                        <div class="flex items-center gap-4">

                            <span class="w-40 font-semibold text-slate-700 shrink-0">
                                A. PEKERJAAN AYAH
                            </span>

                            <input
                                name="pekerjaan_ayah"
                                class="flex-1 rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                                placeholder="Tulis Pekerjaan Ayah Calon Siswa"
                                type="text"
                                value="{{ $hasil->pekerjaan_ayah ?? '' }}"
                            >

                        </div>


                        <div class="flex items-center gap-4">

                            <span class="w-40 font-semibold text-slate-700 shrink-0">
                                B. PEKERJAAN IBU
                            </span>

                            <input
                                name="pekerjaan_ibu"
                                class="flex-1 rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                                placeholder="Tulis Pekerjaan Ibu Calon Siswa"
                                type="text"
                                value="{{ $hasil->pekerjaan_ibu ?? '' }}"
                            >

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    VI. KEMAMPUAN
                ================================================== --}}
                <div class="space-y-3">

                    <label class="block font-bold text-slate-800 uppercase tracking-tight text-sm">
                        VI. KEMAMPUAN CALON MAHASISWA
                    </label>


                    <div class="space-y-3 font-medium">

                        {{-- Attitude --}}
                        <div class="flex items-center gap-4">

                            <span class="w-32 text-slate-700 font-medium">
                                A. Attitude
                            </span>

                            <div class="flex items-center gap-7">

                                @foreach([50,70,90,100] as $nilai)

                                    <label class="flex items-center gap-2 cursor-pointer">

                                        <input
                                            class="w-4 h-4 text-[#02BC9C] focus:ring-[#02BC9C]"
                                            name="nilai_attitude"
                                            type="radio"
                                            value="{{ $nilai }}"
                                            @checked(($hasil->nilai_attitude ?? 90) == $nilai)
                                        >

                                        <span class="text-slate-700 text-sm">
                                            {{ $nilai }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        {{-- Wawasan --}}
                        <div class="flex items-center gap-4">

                            <span class="w-32 text-slate-700 font-medium">
                                B. Wawasan
                            </span>

                            <div class="flex items-center gap-7">

                                @foreach([50,70,90,100] as $nilai)

                                    <label class="flex items-center gap-2 cursor-pointer">

                                        <input
                                            class="w-4 h-4 text-[#02BC9C] focus:ring-[#02BC9C]"
                                            name="nilai_wawasan"
                                            type="radio"
                                            value="{{ $nilai }}"
                                            @checked(($hasil->nilai_wawasan ?? 70) == $nilai)
                                        >

                                        <span class="text-slate-700 text-sm">
                                            {{ $nilai }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        {{-- Kemampuan --}}
                        <div class="flex items-center gap-4">

                            <span class="w-32 text-slate-700 font-medium">
                                C. Kemampuan
                            </span>

                            <div class="flex items-center gap-7">

                                @foreach([50,70,90,100] as $nilai)

                                    <label class="flex items-center gap-2 cursor-pointer">

                                        <input
                                            class="w-4 h-4 text-[#02BC9C] focus:ring-[#02BC9C]"
                                            name="nilai_kemampuan"
                                            type="radio"
                                            value="{{ $nilai }}"
                                            @checked(($hasil->nilai_kemampuan ?? 90) == $nilai)
                                        >

                                        <span class="text-slate-700 text-sm">
                                            {{ $nilai }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    VII. HOBI
                ================================================== --}}
                <div class="space-y-2.5">

                    <label
                        class="block font-bold text-slate-800 uppercase tracking-tight text-sm"
                        for="hobi"
                    >
                        VII. HOBI
                    </label>

                    <input
                        name="hobi"
                        id="hobi"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                        placeholder="Tulis Hobi Calon Siswa"
                        type="text"
                        value="{{ $hasil->hobi ?? '' }}"
                    >

                </div>


                {{-- =================================================
                    VIII. PENGALAMAN KERJA
                ================================================== --}}
                <div class="space-y-2.5">

                    <label
                        class="block font-bold text-slate-800 uppercase tracking-tight text-sm"
                        for="pengalaman-kerja"
                    >
                        VIII. PENGALAMAN KERJA
                    </label>

                    <input
                        name="pengalaman_kerja"
                        id="pengalaman-kerja"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                        placeholder="Tulis Pengalaman Kerja Calon Siswa"
                        type="text"
                        value="{{ $hasil->pengalaman_kerja ?? '' }}"
                    >

                </div>


                {{-- =================================================
                    IX. NILAI AKHIR
                ================================================== --}}
                <div class="space-y-3">

                    <label class="block font-bold text-slate-800 uppercase tracking-tight text-sm">
                        IX. AKHIR NILAI WAWANCARA
                    </label>

                    <div class="flex items-center gap-3">

                        <input
                            name="nilai_akhir"
                            id="nilai-akhir-wawancara"
                            class="w-52 rounded-lg border-slate-300 bg-blue-50/40 text-base py-2.5 px-3 font-bold text-slate-800 focus:ring-2 focus:ring-[#02BC9C] focus:border-[#02BC9C] transition-all"
                            readonly
                            type="text"
                            value="{{ $hasil->nilai_akhir ?? 0 }}"
                        >

                        <button
                            id="btn-proses-nilai"
                            onclick="hitungNilaiAkhir()"
                            class="px-6 py-2.5 bg-brand-accent hover:bg-brand-accent-hover active:scale-95 text-white font-semibold rounded-lg text-sm shadow-xs transition-all cursor-pointer"
                            type="button"
                        >
                            Proses
                        </button>

                    </div>

                    <div
                        id="info-perhitungan"
                        class="text-xs text-slate-500 font-medium mt-1"
                    ></div>

                </div>


                <hr class="border-t border-slate-200">


                {{-- =================================================
                    X. KESIMPULAN
                ================================================== --}}
                <div class="space-y-4">

                    <label class="block font-bold text-slate-800 uppercase tracking-tight text-sm">
                        X. KESIMPULAN
                    </label>

                    <div class="space-y-3">

                        {{-- Status --}}
                        <div class="flex items-center gap-4">

                            <span class="w-32 font-semibold text-slate-700 shrink-0">
                                Status Lulus
                            </span>

                            <select
                                name="status_lulus"
                                id="status-lulus"
                                class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                            >

                                <option
                                    value="Lulus"
                                    @selected(($hasil->status_lulus ?? 'Lulus') == 'Lulus')
                                >
                                    Lulus
                                </option>

                                <option
                                    value="Tidak Lulus"
                                    @selected(($hasil->status_lulus ?? '') == 'Tidak Lulus')
                                >
                                    Tidak Lulus
                                </option>

                                <option
                                    value="Cadangan"
                                    @selected(($hasil->status_lulus ?? '') == 'Cadangan')
                                >
                                    Cadangan
                                </option>

                            </select>

                        </div>


                        {{-- Jurusan --}}
                        <div class="flex items-center gap-4">

                            <span class="w-32 font-semibold text-slate-700 shrink-0">
                                Jurusan
                            </span>

                            <select
                                name="id_jurusan_rekomendasi"
                                id="jurusan-rekomendasi"
                                class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 focus:border-[#02BC9C] focus:ring-[#02BC9C]"
                            >

                                <option value="">
                                    -- Pilih Jurusan --
                                </option>

                                @foreach($jurusan as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        @selected(($hasil->id_jurusan_rekomendasi ?? null) == $item->id)
                                    >
                                        {{ $item->nama_jurusan }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    CATATAN
                ================================================== --}}
                <div class="space-y-2.5 pt-2">

                    <label
                        class="block font-bold text-slate-800 uppercase tracking-tight text-sm"
                        for="catatan"
                    >
                        KETERANGAN CATATAN PEWAWANCARA
                    </label>

                    <textarea
                        name="catatan"
                        class="w-full rounded-lg border-slate-300 text-sm py-2.5 px-3 text-slate-700 placeholder-slate-400 focus:border-[#02BC9C] focus:ring-[#02BC9C] resize-none"
                        id="catatan"
                        placeholder="Catatan untuk Calon Siswa"
                        rows="4"
                    >{{ $hasil->catatan ?? '' }}</textarea>

                </div>


                {{-- =================================================
                    BUTTON
                ================================================== --}}
                <div class="flex items-center justify-center gap-4 pt-5">

                    <button
                        type="submit"
                        class="w-36 py-2.5 bg-[#02BC9C] hover:bg-[#02a387] text-white font-semibold rounded-lg text-sm shadow-xs transition-colors"
                    >
                        Simpan
                    </button>

                    <a
                        href="{{ route('jadwalWawancaraGuru') }}"
                        class="w-36 py-2.5 bg-brand-accent hover:bg-brand-accent-hover text-white font-semibold rounded-lg text-sm shadow-xs transition-colors text-center"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </section>

    </div>

</main>


<script>

function hitungNilaiAkhir()
{
    const organisasi =
        parseFloat(
            document.getElementById('nilai-organisasi').value
        ) || 0;


    const prestasi =
        parseFloat(
            document.getElementById('nilai-prestasi').value
        ) || 0;


    const penyakit =
        parseFloat(
            document.getElementById('nilai-penyakit').value
        ) || 0;


    const butaWarna =
        parseFloat(
            document.getElementById('nilai-buta-warna').value
        ) || 0;


    const attitude =
        parseFloat(
            document.querySelector(
                'input[name="nilai_attitude"]:checked'
            )?.value
        ) || 0;


    const wawasan =
        parseFloat(
            document.querySelector(
                'input[name="nilai_wawasan"]:checked'
            )?.value
        ) || 0;


    const kemampuan =
        parseFloat(
            document.querySelector(
                'input[name="nilai_kemampuan"]:checked'
            )?.value
        ) || 0;


    const total =
        organisasi +
        prestasi +
        penyakit +
        butaWarna +
        attitude +
        wawasan +
        kemampuan;


    const nilaiAkhir = total / 7;


    document.getElementById(
        'nilai-akhir-wawancara'
    ).value = nilaiAkhir.toFixed(2);


    document.getElementById(
        'info-perhitungan'
    ).innerHTML = `
        Total nilai:
        <strong>${total}</strong>
        /
        7 komponen
        =
        <strong>${nilaiAkhir.toFixed(2)}</strong>
    `;
}

</script>

@endsection