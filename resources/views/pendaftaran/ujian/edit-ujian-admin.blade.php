
@extends('layout.app')

@section('title', 'Edit Ujian')
@section('page_title', 'Edit Ujian')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl
                        bg-amber-50
                        flex items-center justify-center
                        text-amber-600">
                <i data-lucide="file-pen-line" class="w-6 h-6"></i>
            </div>

            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold
                           text-slate-900 tracking-tight">
                    Edit Ujian
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Perbarui informasi dan pengaturan ujian calon siswa.
                </p>
            </div>

        </div>

        <a href="{{ route('ujianCalonAdmin.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  border border-slate-200 bg-white
                  text-slate-600 text-sm font-semibold
                  hover:bg-slate-50 transition">

            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>

    </div>


    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="flex items-center gap-3
                    px-5 sm:px-6 py-4
                    border-b border-slate-200
                    bg-slate-50/70">

            <div class="w-10 h-10 rounded-xl
                        bg-teal-50
                        flex items-center justify-center
                        text-teal-600">

                <i data-lucide="clipboard-pen-line" class="w-5 h-5"></i>

            </div>

            <div>
                <h2 class="text-base font-bold text-slate-800">
                    Informasi Ujian
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Silakan perbarui data ujian di bawah ini.
                </p>
            </div>

        </div>


        <form
            action="{{ route('ujianCalonAdmin.update', [
                'ujianCalonAdmin' => $ujian
            ]) }}"
            method="POST"
            class="p-5 sm:p-6"
        >

            @csrf
            @method('PUT')


            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mb-6 rounded-xl
                            border border-red-200
                            bg-red-50 px-4 py-3
                            text-sm text-red-700">

                    <div class="flex items-center gap-2 font-semibold">
                        <i data-lucide="circle-alert" class="w-5 h-5"></i>
                        Terdapat kesalahan
                    </div>

                    <ul class="mt-2 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif


            {{-- NAMA UJIAN --}}
            <div class="mb-5">

                <label for="nama_ujian"
                       class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Nama Ujian
                    <span class="text-red-500">*</span>

                </label>

                <input
                    id="nama_ujian"
                    type="text"
                    name="nama_ujian"
                    value="{{ old('nama_ujian', $ujian->nama_ujian) }}"
                    required
                    placeholder="Contoh: Ujian Seleksi Calon Siswa"
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-white px-4 py-3
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           focus:border-teal-500
                           focus:ring-4 focus:ring-teal-500/10
                           transition
                           @error('nama_ujian')
                               border-red-300
                               focus:border-red-500
                               focus:ring-red-500/10
                           @enderror"
                >

                @error('nama_ujian')
                    <p class="flex items-center gap-1.5 mt-1.5
                              text-xs font-medium text-red-600">

                        <i data-lucide="circle-alert"
                           class="w-3.5 h-3.5"></i>

                        {{ $message }}

                    </p>
                @enderror

            </div>


            {{-- GELOMBANG --}}
            <div class="mb-5">

                <label for="id_gelombang"
                       class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Gelombang
                    <span class="text-red-500">*</span>

                </label>

                <div class="relative">

                    <select
                        id="id_gelombang"
                        name="id_gelombang"
                        required
                        class="w-full appearance-none
                               rounded-xl border border-slate-200
                               bg-white px-4 py-3 pr-10
                               text-sm text-slate-700
                               outline-none
                               focus:border-teal-500
                               focus:ring-4 focus:ring-teal-500/10
                               transition
                               @error('id_gelombang')
                                   border-red-300
                                   focus:border-red-500
                               @enderror"
                    >

                        <option value="">
                            -- Pilih Gelombang --
                        </option>

                        @foreach ($gelombang as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected(
                                    old(
                                        'id_gelombang',
                                        $ujian->id_gelombang
                                    ) == $item->id
                                )
                            >
                                {{ $item->nama_gelombang }}
                            </option>

                        @endforeach

                    </select>

                    <i data-lucide="chevron-down"
                       class="absolute right-3 top-1/2
                              -translate-y-1/2
                              w-4 h-4 text-slate-400
                              pointer-events-none">
                    </i>

                </div>

                @error('id_gelombang')
                    <p class="flex items-center gap-1.5 mt-1.5
                              text-xs font-medium text-red-600">

                        <i data-lucide="circle-alert"
                           class="w-3.5 h-3.5"></i>

                        {{ $message }}

                    </p>
                @enderror

            </div>


            {{-- DESKRIPSI --}}
            <div class="mb-6">

                <label for="deskripsi"
                       class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Deskripsi

                </label>

                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="4"
                    placeholder="Tuliskan deskripsi atau petunjuk ujian..."
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-white px-4 py-3
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           resize-y
                           focus:border-teal-500
                           focus:ring-4 focus:ring-teal-500/10
                           transition
                           @error('deskripsi')
                               border-red-300
                               focus:border-red-500
                           @enderror"
                >{{ old('deskripsi', $ujian->deskripsi) }}</textarea>

                @error('deskripsi')
                    <p class="flex items-center gap-1.5 mt-1.5
                              text-xs font-medium text-red-600">

                        <i data-lucide="circle-alert"
                           class="w-3.5 h-3.5"></i>

                        {{ $message }}

                    </p>
                @enderror

            </div>


            {{-- JADWAL & NILAI --}}
            <div class="flex items-center gap-2 mb-4">

                <div class="w-8 h-8 rounded-lg
                            bg-blue-50
                            flex items-center justify-center
                            text-blue-600">

                    <i data-lucide="calendar-clock"
                       class="w-4 h-4"></i>

                </div>

                <div>
                    <h3 class="text-sm font-bold text-slate-800">
                        Jadwal & Penilaian
                    </h3>

                    <p class="text-xs text-slate-500">
                        Atur waktu pelaksanaan dan nilai ujian.
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- TANGGAL MULAI --}}
                <div>

                    <label for="tanggal_mulai"
                           class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Tanggal Mulai

                    </label>

                    <input
                        id="tanggal_mulai"
                        type="datetime-local"
                        name="tanggal_mulai"
                        value="{{ old(
                            'tanggal_mulai',
                            optional($ujian->tanggal_mulai)
                                ->format('Y-m-d\TH:i')
                        ) }}"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white px-4 py-3
                               text-sm text-slate-700
                               outline-none
                               focus:border-teal-500
                               focus:ring-4 focus:ring-teal-500/10
                               transition
                               @error('tanggal_mulai')
                                   border-red-300
                               @enderror"
                    >

                    @error('tanggal_mulai')
                        <p class="flex items-center gap-1.5 mt-1.5
                                  text-xs font-medium text-red-600">

                            <i data-lucide="circle-alert"
                               class="w-3.5 h-3.5"></i>

                            {{ $message }}

                        </p>
                    @enderror

                </div>


                {{-- TANGGAL SELESAI --}}
                <div>

                    <label for="tanggal_selesai"
                           class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Tanggal Selesai

                    </label>

                    <input
                        id="tanggal_selesai"
                        type="datetime-local"
                        name="tanggal_selesai"
                        value="{{ old(
                            'tanggal_selesai',
                            optional($ujian->tanggal_selesai)
                                ->format('Y-m-d\TH:i')
                        ) }}"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white px-4 py-3
                               text-sm text-slate-700
                               outline-none
                               focus:border-teal-500
                               focus:ring-4 focus:ring-teal-500/10
                               transition
                               @error('tanggal_selesai')
                                   border-red-300
                               @enderror"
                    >

                    @error('tanggal_selesai')
                        <p class="flex items-center gap-1.5 mt-1.5
                                  text-xs font-medium text-red-600">

                            <i data-lucide="circle-alert"
                               class="w-3.5 h-3.5"></i>

                            {{ $message }}

                        </p>
                    @enderror

                </div>


                {{-- DURASI --}}
                <div>

                    <label for="durasi"
                           class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Durasi
                        <span class="text-red-500">*</span>

                    </label>

                    <div class="flex">

                        <input
                            id="durasi"
                            type="number"
                            name="durasi"
                            value="{{ old('durasi', $ujian->durasi) }}"
                            min="1"
                            required
                            placeholder="60"
                            class="w-full rounded-l-xl
                                   border border-r-0
                                   border-slate-200
                                   bg-white px-4 py-3
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-4 focus:ring-teal-500/10
                                   transition
                                   @error('durasi')
                                       border-red-300
                                   @enderror"
                        >

                        <span class="inline-flex items-center
                                     px-4 rounded-r-xl
                                     border border-slate-200
                                     bg-slate-50
                                     text-sm font-medium
                                     text-slate-500">

                            Menit

                        </span>

                    </div>

                    @error('durasi')
                        <p class="flex items-center gap-1.5 mt-1.5
                                  text-xs font-medium text-red-600">

                            <i data-lucide="circle-alert"
                               class="w-3.5 h-3.5"></i>

                            {{ $message }}

                        </p>
                    @enderror

                </div>


                {{-- NILAI MINIMAL --}}
                <div>

                    <label for="nilai_minimal"
                           class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Nilai Minimal
                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        id="nilai_minimal"
                        type="number"
                        name="nilai_minimal"
                        value="{{ old(
                            'nilai_minimal',
                            $ujian->nilai_minimal
                        ) }}"
                        min="0"
                        max="100"
                        required
                        placeholder="70"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white px-4 py-3
                               text-sm text-slate-700
                               outline-none
                               focus:border-teal-500
                               focus:ring-4 focus:ring-teal-500/10
                               transition
                               @error('nilai_minimal')
                                   border-red-300
                               @enderror"
                    >

                    @error('nilai_minimal')
                        <p class="flex items-center gap-1.5 mt-1.5
                                  text-xs font-medium text-red-600">

                            <i data-lucide="circle-alert"
                               class="w-3.5 h-3.5"></i>

                            {{ $message }}

                        </p>
                    @enderror

                </div>

            </div>


            {{-- PENGATURAN --}}
            <div class="mt-7 pt-6 border-t border-slate-200">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg
                                bg-violet-50
                                flex items-center justify-center
                                text-violet-600">

                        <i data-lucide="settings-2"
                           class="w-4 h-4"></i>

                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">
                            Pengaturan Ujian
                        </h3>

                        <p class="text-xs text-slate-500">
                            Atur perilaku dan status ujian.
                        </p>
                    </div>

                </div>


                <div class="space-y-3">

                    {{-- ACAK SOAL --}}
                    <label class="flex items-center gap-3
                                  p-4 rounded-xl
                                  border border-slate-200
                                  bg-slate-50/50
                                  hover:bg-slate-50
                                  cursor-pointer transition">

                        <input
                            type="checkbox"
                            name="acak_soal"
                            value="1"
                            @checked(
                                old(
                                    'acak_soal',
                                    $ujian->acak_soal
                                )
                            )
                            class="w-5 h-5 rounded
                                   border-slate-300
                                   text-teal-600
                                   focus:ring-teal-500"
                        >

                        <div class="flex-1">

                            <div class="flex items-center gap-2">

                                <i data-lucide="shuffle"
                                   class="w-4 h-4 text-slate-500"></i>

                                <span class="text-sm font-semibold
                                             text-slate-700">

                                    Acak urutan soal

                                </span>

                            </div>

                            <p class="text-xs text-slate-500 mt-1">
                                Soal akan ditampilkan dengan urutan berbeda
                                kepada peserta.
                            </p>

                        </div>

                    </label>


                    {{-- TAMPIL HASIL --}}
                    <label class="flex items-center gap-3
                                  p-4 rounded-xl
                                  border border-slate-200
                                  bg-slate-50/50
                                  hover:bg-slate-50
                                  cursor-pointer transition">

                        <input
                            type="checkbox"
                            name="tampil_hasil"
                            value="1"
                            @checked(
                                old(
                                    'tampil_hasil',
                                    $ujian->tampil_hasil
                                )
                            )
                            class="w-5 h-5 rounded
                                   border-slate-300
                                   text-teal-600
                                   focus:ring-teal-500"
                        >

                        <div class="flex-1">

                            <div class="flex items-center gap-2">

                                <i data-lucide="bar-chart-3"
                                   class="w-4 h-4 text-slate-500"></i>

                                <span class="text-sm font-semibold
                                             text-slate-700">

                                    Tampilkan hasil kepada peserta

                                </span>

                            </div>

                            <p class="text-xs text-slate-500 mt-1">
                                Peserta dapat melihat hasil ujian setelah
                                menyelesaikan ujian.
                            </p>

                        </div>

                    </label>


                    {{-- STATUS --}}
                    <label class="flex items-center gap-3
                                  p-4 rounded-xl
                                  border border-emerald-200
                                  bg-emerald-50/40
                                  hover:bg-emerald-50
                                  cursor-pointer transition">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            @checked(
                                old(
                                    'status',
                                    $ujian->status
                                )
                            )
                            class="w-5 h-5 rounded
                                   border-slate-300
                                   text-teal-600
                                   focus:ring-teal-500"
                        >

                        <div class="flex-1">

                            <div class="flex items-center gap-2">

                                <span class="w-2 h-2 rounded-full
                                             bg-emerald-500"></span>

                                <span class="text-sm font-semibold
                                             text-slate-700">

                                    Aktifkan ujian

                                </span>

                            </div>

                            <p class="text-xs text-slate-500 mt-1">
                                Ujian dapat digunakan oleh peserta ketika
                                status ini aktif.
                            </p>

                        </div>

                    </label>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="flex flex-col-reverse sm:flex-row
                        sm:items-center justify-end gap-3
                        mt-8 pt-5 border-t border-slate-200">

                <a href="{{ route('ujianCalonAdmin.index') }}"
                   class="inline-flex items-center justify-center
                          gap-2 px-5 py-2.5 rounded-xl
                          border border-slate-200
                          bg-white text-slate-600
                          text-sm font-semibold
                          hover:bg-slate-50 transition">

                    <i data-lucide="arrow-left"
                       class="w-4 h-4"></i>

                    Kembali

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           gap-2 px-5 py-2.5 rounded-xl
                           bg-teal-600 hover:bg-teal-700
                           text-white text-sm font-semibold
                           shadow-sm transition">

                    <i data-lucide="save"
                       class="w-4 h-4"></i>

                    Update Ujian

                </button>

            </div>

        </form>

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

