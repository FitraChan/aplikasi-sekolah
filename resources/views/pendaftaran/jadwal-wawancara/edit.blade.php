@extends('layout.app')

@section('title', 'Edit Jadwal Wawancara')
@section('page_title', 'Edit Jadwal Wawancara')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- Breadcrumb --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="flex items-center flex-wrap gap-2 text-sm font-medium">

            <a href="{{ url('/') }}"
               class="text-slate-600 hover:text-slate-900 transition-colors">
                Dashboard
            </a>

            <span class="text-slate-400">›</span>

            <a href="{{ route('jadwal-wawancara.index') }}"
               class="text-slate-600 hover:text-slate-900 transition-colors">
                Jadwal Wawancara
            </a>

            <span class="text-slate-400">›</span>

            <span class="text-[#02BC9C] font-semibold">
                Edit Wawancara
            </span>

        </div>

        {{-- Cetak Kartu --}}
        <button
            type="button"
            onclick="cetakKartu()"
            class="inline-flex items-center justify-center gap-2
                   bg-[#02BC9C] hover:bg-[#02a387]
                   text-white px-5 py-2.5 rounded-xl
                   font-semibold text-sm shadow-sm
                   transition duration-150">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <polyline points="6 9 6 2 18 2 18 9"></polyline>

                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5h-2"></path>

                <rect height="8"
                      width="12"
                      x="6"
                      y="14">
                </rect>

            </svg>

            <span>Cetak Kartu Wawancara</span>

        </button>

    </div>


    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        {{-- ========================================================= --}}
        {{-- LEFT COLUMN --}}
        {{-- ========================================================= --}}

        <div class="lg:col-span-4 space-y-6">


            {{-- Candidate Card --}}
            <div class="bg-white rounded-2xl border border-slate-200/80
                        p-6 shadow-sm"
                 data-purpose="candidate-profile-card">

                <div class="flex flex-col items-center">

                    {{-- Foto --}}
                    <div class="w-24 h-24 rounded-2xl overflow-hidden
                                mb-4 bg-slate-100 ring-4 ring-slate-50">

                        @if(!empty($jadwal->calonSiswa?->foto_siswa))

                            <img
                                alt="{{ $jadwal->calonSiswa->nama_lengkap }}"
                                class="w-full h-full object-cover"
                                src="{{ asset('storage/' . $jadwal->calonSiswa->foto_siswa) }}">

                        @else

                            <div class="w-full h-full flex items-center justify-center
                                        bg-[#e6f9f5] text-[#02BC9C]">

                                <svg class="w-10 h-10"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.5"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 11-7.5 0
                                             3.75 3.75 0 017.5 0z"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M4.5 20.25a8.25 8.25 0
                                             0115 0"/>

                                </svg>

                            </div>

                        @endif

                    </div>


                    {{-- Nama --}}
                    <h3 class="text-lg font-bold text-slate-800 text-center mb-1">

                        {{ $jadwal->calonSiswa?->nama_lengkap ?? '-' }}

                    </h3>


                    {{-- No Daftar --}}
                    <span class="inline-block bg-[#e6f9f5]
                                 text-[#02BC9C]
                                 text-xs font-semibold
                                 px-3 py-1 rounded-full mb-6">

                        {{ $jadwal->calonSiswa?->no_daftar ?? '-' }}

                    </span>

                </div>


                {{-- Detail --}}
                <div class="w-full border-t border-slate-100
                            pt-5 space-y-3.5 text-sm">


                    {{-- Jurusan --}}
                    <div class="flex justify-between items-start gap-4">

                        <span class="text-slate-500">
                            Pilihan Jurusan
                        </span>

                        <span class="font-bold text-slate-800 text-right">
                            {{ $jadwal->calonSiswa?->jurusan?->nama_jurusan ?? '-' }}
                        </span>

                    </div>


                    {{-- Asal Sekolah --}}
                    <div class="flex justify-between items-start gap-4">

                        <span class="text-slate-500">
                            Asal Sekolah
                        </span>

                        <span class="font-bold text-slate-800 text-right">
                            {{ $jadwal->calonSiswa?->nama_sekolah_asal ?? '-' }}
                        </span>

                    </div>


                    {{-- Jenis Kelamin --}}
                    <div class="flex justify-between items-center">

                        <span class="text-slate-500">
                            Jenis Kelamin
                        </span>

                        <span class="font-bold text-slate-800">

                            @if($jadwal->calonSiswa?->jk == 'L')
                                Laki-laki
                            @elseif($jadwal->calonSiswa?->jk == 'P')
                                Perempuan
                            @else
                                -
                            @endif

                        </span>

                    </div>


                    {{-- Gelombang --}}
                    <div class="flex justify-between items-center">

                        <span class="text-slate-500">
                            Gelombang
                        </span>

                        <span class="font-bold text-slate-800">

                            {{ $jadwal->calonSiswa?->gelombang?->nama_gelombang ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- Bantuan --}}
            <div
                class="bg-gradient-to-br from-[#02BC9C] to-[#015345]
                       rounded-2xl p-6 text-white relative overflow-hidden shadow-sm">

                <div class="absolute -right-4 -bottom-6
                            text-white/10 pointer-events-none">

                    <svg class="w-36 h-36"
                         fill="none"
                         stroke="currentColor"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="1.8"
                         viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="10"></circle>

                        <path d="M9.09 9a3 3 0 0 1 5.83 1
                                 c0 2-3 3-3 3"></path>

                        <line x1="12"
                              x2="12.01"
                              y1="17"
                              y2="17"></line>

                    </svg>

                </div>


                <div class="relative z-10 space-y-2">

                    <h4 class="text-base font-bold">
                        Bantuan Administrasi
                    </h4>

                    <p class="text-xs leading-relaxed
                              text-emerald-50/90">

                        Pastikan tanggal, waktu, pewawancara,
                        dan tempat wawancara sudah sesuai sebelum
                        menyimpan perubahan.

                    </p>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- RIGHT COLUMN --}}
        {{-- ========================================================= --}}

        <div class="lg:col-span-8">

            <div class="bg-white rounded-2xl
                        border border-slate-200/80
                        p-6 sm:p-8 shadow-sm">

                {{-- Form --}}
                <form id="form-edit-wawancara">

                    @csrf

                    @method('PUT')


                    {{-- Title --}}
                    <div class="pb-6 mb-6 border-b border-slate-100">

                        <h2 class="text-xl font-bold text-[#02BC9C]">
                            Detail Jadwal
                        </h2>

                        <p class="text-xs text-slate-500 mt-1">
                            Ubah informasi jadwal wawancara calon siswa.
                        </p>

                    </div>


                    {{-- Calon Siswa --}}
                    <div class="mb-6">

                        <label class="block text-xs font-bold
                                      text-slate-700 mb-2">

                            Calon Siswa

                        </label>

                        <select
                            name="id_calon_siswa"
                            id="id_calon_siswa"
                            class="w-full text-sm font-medium
                                   text-slate-800 bg-white
                                   border border-slate-300
                                   rounded-xl px-4 py-2.5
                                   focus:ring-2
                                   focus:ring-[#02BC9C]/20
                                   focus:border-[#02BC9C]">

                            @foreach($calonSiswa as $calon)

                                <option
                                    value="{{ $calon->id }}"
                                    @selected($jadwal->id_calon_siswa == $calon->id)>

                                    {{ $calon->no_daftar }}
                                    -
                                    {{ $calon->nama_lengkap }}

                                    @if($calon->jurusan)
                                        ({{ $calon->jurusan->nama_jurusan }})
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Tanggal + Waktu --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">


                        {{-- Tanggal --}}
                        <div class="sm:col-span-1">

                            <label class="block text-xs font-bold
                                          text-slate-700 mb-2">

                                Tanggal Wawancara

                            </label>

                            <div class="relative">

                                <input
                                    type="date"
                                    name="tanggal"
                                    id="tanggal"
                                    value="{{ $jadwal->tanggal?->format('Y-m-d') }}"
                                    required
                                    class="w-full text-sm font-medium
                                           text-slate-800 bg-white
                                           border border-slate-300
                                           rounded-xl px-4 py-2.5
                                           focus:ring-2
                                           focus:ring-[#02BC9C]/20
                                           focus:border-[#02BC9C]">

                            </div>

                        </div>


                        {{-- Jam Mulai --}}
                        <div>

                            <label class="block text-xs font-bold
                                          text-slate-700 mb-2">

                                Jam Mulai

                            </label>

                            <input
                                type="time"
                                name="jam_mulai"
                                id="jam_mulai"
                                value="{{ $jadwal->jam_mulai ? substr($jadwal->jam_mulai, 0, 5) : '' }}"
                                required
                                class="w-full text-sm font-medium
                                       text-slate-800 bg-white
                                       border border-slate-300
                                       rounded-xl px-4 py-2.5
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       focus:border-[#02BC9C]">

                        </div>


                        {{-- Jam Selesai --}}
                        <div>

                            <label class="block text-xs font-bold
                                          text-slate-700 mb-2">

                                Jam Selesai

                            </label>

                            <input
                                type="time"
                                name="jam_selesai"
                                id="jam_selesai"
                                value="{{ $jadwal->jam_selesai ? substr($jadwal->jam_selesai, 0, 5) : '' }}"
                                class="w-full text-sm font-medium
                                       text-slate-800 bg-white
                                       border border-slate-300
                                       rounded-xl px-4 py-2.5
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       focus:border-[#02BC9C]">

                        </div>

                    </div>


                    {{-- Pewawancara --}}
                    <div class="mb-6">

                        <label class="block text-xs font-bold
                                      text-slate-700 mb-2">

                            Pewawancara

                        </label>

                        <select
                            name="id_gtk"
                            id="id_gtk"
                            required
                            class="w-full appearance-none
                                   text-sm font-medium
                                   text-slate-800 bg-white
                                   border border-slate-300
                                   rounded-xl px-4 py-2.5
                                   focus:ring-2
                                   focus:ring-[#02BC9C]/20
                                   focus:border-[#02BC9C]">

                            <option value="">
                                -- Pilih Pewawancara --
                            </option>

                            @foreach($gtk as $item)

                                <option
                                    value="{{ $item->id }}"
                                    @selected($jadwal->id_gtk == $item->id)>

                                    {{ $item->nama_gtk }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Tempat --}}
                    <div class="mb-6">

                        <label class="block text-xs font-bold
                                      text-slate-700 mb-2">

                            Tempat / Link Wawancara

                        </label>

                        <div class="relative">

                            <span
                                class="absolute inset-y-0 left-0
                                       pl-3.5 flex items-center
                                       pointer-events-none
                                       text-slate-400">

                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     stroke-width="2"
                                     viewBox="0 0 24 24">

                                    <path d="M21 10c0 7-9 12-9 12
                                             S3 17 3 10a9 9 0 1 1 18 0Z"/>

                                    <circle cx="12"
                                            cy="10"
                                            r="3"/>

                                </svg>

                            </span>

                            <input
                                type="text"
                                name="tempat"
                                id="tempat"
                                value="{{ $jadwal->tempat }}"
                                placeholder="Contoh: Ruang Wawancara 1 / Google Meet"
                                class="w-full text-sm font-medium
                                       text-slate-800 bg-white
                                       border border-slate-300
                                       rounded-xl pl-10 pr-4 py-2.5
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       focus:border-[#02BC9C]">

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="mb-6">

                        <label class="block text-xs font-bold
                                      text-slate-700 mb-2">

                            Status Penjadwalan

                        </label>

                        <select
                            name="status"
                            id="status"
                            required
                            class="w-full appearance-none
                                   text-sm font-medium
                                   text-slate-800 bg-white
                                   border border-slate-300
                                   rounded-xl px-4 py-2.5
                                   focus:ring-2
                                   focus:ring-[#02BC9C]/20
                                   focus:border-[#02BC9C]">

                            <option value="terjadwal"
                                @selected($jadwal->status === 'terjadwal')>
                                Terjadwal
                            </option>

                            <option value="selesai"
                                @selected($jadwal->status === 'selesai')>
                                Selesai
                            </option>

                            <option value="batal"
                                @selected($jadwal->status === 'batal')>
                                Dibatalkan
                            </option>

                            <option value="tidak_hadir"
                                @selected($jadwal->status === 'tidak_hadir')>
                                Tidak Hadir
                            </option>

                        </select>

                    </div>


                    {{-- Catatan --}}
                    <div>

                        <label class="block text-xs font-bold
                                      text-slate-700 mb-2">

                            Catatan

                        </label>

                        <textarea
                            name="catatan"
                            id="catatan"
                            rows="4"
                            placeholder="Tambahkan catatan jika diperlukan..."
                            class="w-full text-sm font-medium
                                   text-slate-800 bg-white
                                   border border-slate-300
                                   rounded-xl px-4 py-2.5
                                   focus:ring-2
                                   focus:ring-[#02BC9C]/20
                                   focus:border-[#02BC9C]">{{ $jadwal->catatan }}</textarea>

                    </div>


                    {{-- Action --}}
                    <div class="pt-8 mt-8 border-t border-slate-100
                                flex flex-col-reverse sm:flex-row
                                items-stretch sm:items-center
                                justify-end gap-3">

                        <a href="{{ route('jadwal-wawancara.index') }}"
                           class="px-6 py-2.5
                                  border border-slate-200
                                  hover:bg-slate-50
                                  text-slate-700
                                  font-semibold text-sm
                                  rounded-xl transition
                                  text-center">

                            Kembali

                        </a>


                        <button
                            type="submit"
                            id="btn-simpan"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   px-6 py-2.5
                                   bg-[#02BC9C]
                                   hover:bg-[#02a387]
                                   text-white
                                   font-semibold text-sm
                                   rounded-xl
                                   shadow-sm
                                   shadow-[#02BC9C]/30
                                   transition">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <path d="M19 21H5a2 2 0 0 1-2-2V5
                                         a2 2 0 0 1 2-2h11l5 5v11
                                         a2 2 0 0 1-2 2z"/>

                                <polyline points="17 21 17 13 7 13 7 21"/>

                                <polyline points="7 3 7 8 15 8"/>

                            </svg>

                            <span>Simpan Perubahan</span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- Danger Zone --}}
    <div
        class="bg-[#fef2f2]/80
               border border-red-200/80
               rounded-2xl p-5
               flex flex-col md:flex-row
               items-center justify-between
               gap-4 shadow-sm">

        <div class="flex items-center gap-4">

            <div class="w-10 h-10 rounded-xl
                        bg-red-100/90
                        text-red-600
                        flex items-center justify-center
                        flex-shrink-0">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2.2"
                     viewBox="0 0 24 24">

                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14
                             A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>

                    <line x1="12"
                          x2="12"
                          y1="9"
                          y2="13"/>

                    <line x1="12"
                          x2="12.01"
                          y1="17"
                          y2="17"/>

                </svg>

            </div>


            <div>

                <h5 class="text-sm font-bold text-slate-800">
                    Perhatian
                </h5>

                <p class="text-xs text-red-700/80 mt-0.5 font-medium">
                    Pembatalan wawancara akan mengubah status jadwal
                    menjadi batal.
                </p>

            </div>

        </div>


        <button
            type="button"
            onclick="batalkanWawancara()"
            class="w-full md:w-auto
                   px-6 py-2.5
                   bg-[#b91c1c]
                   hover:bg-[#991b1b]
                   text-white
                   text-sm font-bold
                   rounded-xl
                   transition
                   shadow-sm
                   whitespace-nowrap">

            Batalkan Wawancara

        </button>

    </div>

</main>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('form-edit-wawancara');
    const btn = document.getElementById('btn-simpan');

    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        btn.disabled = true;

        btn.innerHTML = `
            <svg class="w-4 h-4 animate-spin"
                 fill="none"
                 viewBox="0 0 24 24">

                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4">
                </circle>

                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0
                       00-4 4H4z">
                </path>

            </svg>

            <span>Menyimpan...</span>
        `;


        const formData = new FormData(form);

        try {

            const response = await fetch(
                "{{ route('jadwal-wawancara.update', $jadwal->id) }}",
                {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN':
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            )?.getAttribute('content')
                            ?? '{{ csrf_token() }}',

                        'Accept': 'application/json'
                    },

                    body: formData
                }
            );


            const result = await response.json();


            if (!response.ok) {

                let message = result.message
                    ?? 'Data tidak dapat disimpan.';

                if (result.errors) {

                    const errors = Object.values(result.errors)
                        .flat();

                    if (errors.length) {
                        message = errors.join('\n');
                    }

                }

                alert(message);

                return;
            }


            alert(
                result.message ??
                'Jadwal wawancara berhasil diperbarui.'
            );


            window.location.href =
                "{{ route('jadwal-wawancara.index') }}";


        } catch (error) {

            console.error(error);

            alert(
                'Terjadi kesalahan saat menghubungi server.'
            );

        } finally {

            btn.disabled = false;

            btn.innerHTML = `
                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M19 21H5a2 2 0 0 1-2-2V5
                             a2 2 0 0 1 2-2h11l5 5v11
                             a2 2 0 0 1-2 2z"/>

                    <polyline points="17 21 7 21 7 13 17 13 17 21"/>

                    <polyline points="7 3 7 8 15 8"/>

                </svg>

                <span>Simpan Perubahan</span>
            `;
        }

    });

});


/*
|--------------------------------------------------------------------------
| Batalkan Wawancara
|--------------------------------------------------------------------------
*/

async function batalkanWawancara() {

    const yakin = confirm(
        'Apakah Anda yakin ingin membatalkan wawancara ini?'
    );

    if (!yakin) {
        return;
    }


    const formData = new FormData();

    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PUT');

    formData.append(
        'id_calon_siswa',
        '{{ $jadwal->id_calon_siswa }}'
    );

    formData.append(
        'id_gtk',
        '{{ $jadwal->id_gtk }}'
    );

    formData.append(
        'tanggal',
        '{{ $jadwal->tanggal?->format("Y-m-d") }}'
    );

    formData.append(
        'jam_mulai',
        '{{ substr($jadwal->jam_mulai, 0, 5) }}'
    );

    if ('{{ $jadwal->jam_selesai }}') {

        formData.append(
            'jam_selesai',
            '{{ substr($jadwal->jam_selesai, 0, 5) }}'
        );

    }

    formData.append(
        'tempat',
        '{{ $jadwal->tempat }}'
    );

    formData.append(
        'status',
        'batal'
    );


    try {

        const response = await fetch(
            "{{ route('jadwal-wawancara.update', $jadwal->id) }}",
            {
                method: 'PUT',

                headers: {
                    'X-CSRF-TOKEN':
                        '{{ csrf_token() }}',

                    'Accept': 'application/json'
                },

                body: formData
            }
        );


        const result = await response.json();


        if (!response.ok) {

            alert(
                result.message ??
                'Gagal membatalkan wawancara.'
            );

            return;
        }


        alert(
            'Wawancara berhasil dibatalkan.'
        );


        window.location.href =
            "{{ route('jadwal-wawancara.index') }}";


    } catch (error) {

        console.error(error);

        alert(
            'Terjadi kesalahan saat membatalkan wawancara.'
        );

    }

}


/*
|--------------------------------------------------------------------------
| Cetak Kartu
|--------------------------------------------------------------------------
*/

function cetakKartu() {

    alert(
        'Fitur cetak kartu wawancara belum tersedia.'
    );

}

</script>

@endsection