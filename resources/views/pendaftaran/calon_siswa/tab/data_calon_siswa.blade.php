<form action="{{ route('calon-siswa.update.updateRegistrasiSiswa', $rows->id ?? '') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <!-- INFORMASI PENDAFTARAN -->
    <section class="bg-white rounded-xl border border-slate-200/90 shadow-sm p-6">

        <div class="flex items-center gap-3.5 mb-6">

            <div class="w-10 h-10 rounded-lg bg-teal-50
                        flex items-center justify-center">

                <svg class="w-5 h-5 text-[#00B686]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a2 2 0 011.414.586L19.414 7A2 2 0 0120 8.414V19a2 2 0 01-2 2z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2">
                    </path>

                </svg>

            </div>

            <div>
                <h3 class="text-base font-semibold text-slate-800">
                    Informasi Pendaftaran
                </h3>

                <p class="text-xs text-slate-400">
                    Data administrasi pendaftaran siswa
                </p>
            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <!-- GELOMBANG -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Gelombang
                </label>

                <select
                    name="id_gelombang"
                    class="w-full bg-white border border-slate-200 rounded-lg
                           text-sm text-slate-700 px-3.5 py-2.5
                           focus:outline-none focus:ring-1
                           focus:ring-[#00B686] focus:border-[#00B686]"
                    {{ !Auth::user()->hasAnyRole(['admin', 'Akademik']) ? 'disabled' : '' }}>

                    <option value="">
                        -- Pilih Gelombang --
                    </option>

                    @foreach($gel as $list)
                        <option value="{{ $list->id }}"
                            {{ old('id_gelombang', $rows->id_gelombang ?? '') == $list->id ? 'selected' : '' }}>
                            {{ $list->nama_gelombang }}
                        </option>
                    @endforeach

                </select>
            </div>


            <!-- TAHUN AJARAN -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Tahun Ajaran
                </label>

                <select
                    name="id_thn_ajaran"
                    class="w-full bg-white border border-slate-200 rounded-lg
                           text-sm text-slate-700 px-3.5 py-2.5
                           focus:outline-none focus:ring-1
                           focus:ring-[#00B686] focus:border-[#00B686]"
                    {{ !Auth::user()->hasAnyRole(['admin', 'Akademik']) ? 'disabled' : '' }}>

                    <option value="">
                        -- Pilih Tahun Ajaran --
                    </option>

                    @foreach($thn as $list)
                        <option value="{{ $list->id }}"
                            {{ old('id_thn_ajaran', $rows->id_thn_ajaran ?? '') == $list->id ? 'selected' : '' }}>
                            {{ $list->thn_ajaran }}
                        </option>
                    @endforeach

                </select>
            </div>


            <!-- NO DAFTAR -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    No. Daftar
                </label>

                <input
                    type="text"
                    name="no_daftar"
                    value="{{ old('no_daftar', $rows->no_daftar ?? '') }}"
                    readonly
                    class="w-full bg-[#f8fafc] border border-slate-200
                           rounded-lg text-sm text-slate-700
                           px-3.5 py-2.5 focus:outline-none cursor-default">
            </div>


            <!-- TANGGAL DAFTAR -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Tanggal Daftar
                </label>

                <input
                    type="date"
                    name="tgl_daftar"
                    value="{{ old('tgl_daftar', $rows->tgl_daftar ?? '') }}"
                    {{ !Auth::user()->hasAnyRole(['admin', 'Akademik']) ? 'readonly' : '' }}
                    class="w-full bg-white border border-slate-200
                           rounded-lg text-sm text-slate-700
                           px-3.5 py-2.5 focus:outline-none
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]">
            </div>


            @if(Auth::user()->hasRole('admin'))

                <!-- STATUS -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                        Status Siswa
                    </label>

                    <select
                        name="status_daftar"
                        class="w-full bg-white border border-slate-200
                               rounded-lg text-sm text-slate-700
                               px-3.5 py-2.5 focus:outline-none
                               focus:ring-1 focus:ring-[#00B686]
                               focus:border-[#00B686]">

                        <option value="1"
                            {{ old('status_daftar', $rows->status_daftar ?? '') == 1 ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0"
                            {{ old('status_daftar', $rows->status_daftar ?? '') == 0 ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>
                </div>

            @endif


            <!-- JURUSAN -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Jurusan Yang Dipilih
                </label>

                <select
                    name="id_jurusan"
                    class="w-full bg-white border border-slate-200
                           rounded-lg text-sm text-slate-700
                           px-3.5 py-2.5 focus:outline-none
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]"
                    {{ !Auth::user()->hasAnyRole(['admin', 'Akademik']) ? 'disabled' : '' }}>

                    <option value="">
                        -- Pilih Jurusan --
                    </option>

                    @foreach($lists as $list)
                        <option value="{{ $list->id }}"
                            {{ old('id_jurusan', $rows->id_jurusan ?? '') == $list->id ? 'selected' : '' }}>
                            {{ $list->nama_jurusan }}
                        </option>
                    @endforeach

                </select>
            </div>


            <!-- TEMPAT DAFTAR -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                    Tempat Daftar
                </label>

                <input
                    type="text"
                    name="tmp_daftar"
                    value="{{ old('tmp_daftar', $rows->tmp_daftar ?? '') }}"
                    readonly
                    class="w-full bg-[#f8fafc] border border-slate-200
                           rounded-lg text-sm text-slate-700
                           px-3.5 py-2.5 focus:outline-none cursor-default">
            </div>

        </div>

    </section>


    <!-- BIODATA SISWA -->
    <section class="bg-white rounded-xl border border-slate-200/90 shadow-sm p-6 mt-6">

        <div class="flex items-center gap-3.5 mb-6">

            <div class="w-10 h-10 rounded-lg bg-teal-50
                        flex items-center justify-center">

                <svg class="w-5 h-5 text-[#00B686]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2">
                    </path>

                </svg>

            </div>

            <div>
                <h3 class="text-base font-semibold text-slate-800">
                    Biodata Siswa
                </h3>

                <p class="text-xs text-slate-400">
                    Informasi identitas siswa
                </p>
            </div>

        </div>


        <div class="space-y-5">

            <!-- NAMA & JENIS KELAMIN -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- NAMA -->
                <div>
                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="nama_lengkap">

                        Nama Lengkap

                    </label>

                    <input
                        type="text"
                        name="nama_lengkap"
                        id="nama_lengkap"
                        value="{{ old('nama_lengkap', $rows->nama_lengkap ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>


                <!-- JENIS KELAMIN -->
                <div>

                    <label class="block text-xs font-semibold text-slate-700 mb-2.5">
                        Jenis Kelamin
                    </label>

                    <div class="flex items-center gap-3">

                        <label class="flex items-center gap-2
                                      border border-slate-200 rounded-lg
                                      px-4 py-2.5 cursor-pointer
                                      text-sm font-medium text-slate-700">

                            <input
                                type="radio"
                                name="jk"
                                value="L"
                                {{ old('jk', $rows->jk ?? '') == 'L' ? 'checked' : '' }}
                                class="w-4 h-4 text-[#00B686]
                                       focus:ring-[#00B686]
                                       border-slate-300">

                            <span>Laki-Laki</span>

                        </label>


                        <label class="flex items-center gap-2
                                      border border-slate-200 rounded-lg
                                      px-4 py-2.5 cursor-pointer
                                      text-sm font-medium text-slate-700">

                            <input
                                type="radio"
                                name="jk"
                                value="P"
                                {{ old('jk', $rows->jk ?? '') == 'P' ? 'checked' : '' }}
                                class="w-4 h-4 text-[#00B686]
                                       focus:ring-[#00B686]
                                       border-slate-300">

                            <span>Perempuan</span>

                        </label>

                    </div>

                </div>

            </div>


            <!-- AGAMA / TEMPAT LAHIR / TANGGAL LAHIR -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- AGAMA -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="id_agama">

                        Agama

                    </label>

                    <select
                        name="id_agama"
                        id="id_agama"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]
                               bg-white">

                        <option value="">
                            -- Pilih Agama --
                        </option>

                        @foreach($agama as $list)

                            <option value="{{ $list->id }}"
                                {{ old('id_agama', $rows->id_agama ?? '') == $list->id ? 'selected' : '' }}>

                                {{ $list->nama_agama }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- TEMPAT LAHIR -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="tmp_lahir">

                        Tempat Lahir

                    </label>

                    <input
                        type="text"
                        name="tmp_lahir"
                        id="tmp_lahir"
                        value="{{ old('tmp_lahir', $rows->tmp_lahir ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>


                <!-- TANGGAL LAHIR -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="tgl_lahir">

                        Tanggal Lahir

                    </label>

                    <input
                        type="date"
                        name="tgl_lahir"
                        id="tgl_lahir"
                        value="{{ old('tgl_lahir', $rows->tgl_lahir ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>

            </div>


            <!-- EMAIL & NO HP -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- EMAIL -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="email">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $rows->email ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>


                <!-- NO HP -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="no_hp">

                        No. HP / WhatsApp

                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        id="no_hp"
                        value="{{ old('no_hp', $rows->no_hp ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>

            </div>


            <!-- ALAMAT -->
            <div>

                <label
                    class="block text-xs font-semibold text-slate-700 mb-1.5"
                    for="alamat">

                    Alamat Lengkap

                </label>

                <textarea
                    name="alamat"
                    id="alamat"
                    rows="3"
                    class="w-full border border-slate-200 rounded-lg
                           text-sm text-slate-800 px-3.5 py-2.5
                           focus:outline-none focus:ring-1
                           focus:ring-[#00B686]
                           focus:border-[#00B686]
                           resize-none">{{ old('alamat', $rows->alamat ?? '') }}</textarea>

            </div>


            <!-- DUSUN & DESA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- DUSUN -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="dusun">

                        Dusun

                    </label>

                    <input
                        type="text"
                        name="dusun"
                        id="dusun"
                        value="{{ old('dusun', $rows->dusun ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>


                <!-- DESA -->
                <div>

                    <label
                        class="block text-xs font-semibold text-slate-700 mb-1.5"
                        for="desa">

                        Desa

                    </label>

                    <input
                        type="text"
                        name="desa"
                        id="desa"
                        value="{{ old('desa', $rows->desa ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg
                               text-sm text-slate-800 px-3.5 py-2.5
                               focus:outline-none focus:ring-1
                               focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>

            </div>

        </div>

    </section>


    <!-- INFORMASI PENTING -->
    <section
        class="bg-[#eff6ff] rounded-xl border border-blue-100 mt-6 p-5
               flex items-start gap-4">

        <div class="w-6 h-6 rounded-full flex items-center
                    justify-center text-[#0284c7] flex-shrink-0 mt-0.5">

            <svg class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>

                <line
                    stroke-linecap="round"
                    stroke-width="2"
                    x1="12"
                    x2="12"
                    y1="16"
                    y2="12">
                </line>

                <circle
                    cx="12"
                    cy="8"
                    fill="currentColor"
                    r="0.75">
                </circle>

            </svg>

        </div>

        <div class="space-y-1 text-xs leading-relaxed text-slate-600">

            <h4 class="font-bold text-[#0284c7] text-sm">
                Penting!
            </h4>

            <p>
                Pastikan data yang Anda masukkan sudah benar dan sesuai
                dengan dokumen resmi (Kartu Keluarga/Akte Kelahiran).
                Perubahan data mungkin dibatasi setelah status pendaftaran
                diverifikasi.
            </p>

        </div>

    </section>


    <!-- ACTION -->
    <div class="flex items-center justify-end gap-3 mt-6">

        <a href="{{ route('calon-siswa.index') }}"
            class="px-5 py-2.5 text-sm font-medium
                   text-slate-600 bg-white
                   border border-slate-200 rounded-lg
                   hover:bg-slate-50 transition-colors">

            Kembali

        </a>

        <button
            type="submit"
            class="inline-flex items-center gap-2
                   px-5 py-2.5
                   bg-[#00B686] hover:bg-[#009e74]
                   text-white text-sm font-semibold
                   rounded-lg shadow-sm
                   transition-colors">

            <svg class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path
                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2">
                </path>

            </svg>

            <span>
                Simpan Perubahan
            </span>

        </button>

    </div>

</form>