<form action="{{ route('siswa.update-akademik', $rows->id ?? '') }}"
    method="POST">

    @csrf

    <div class="max-w-7xl mx-auto">

        <div class="bg-white shadow-sm border border-slate-200 rounded-2xl overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
                <div class="flex items-center">

                    <div class="w-10 h-10 rounded-xl bg-teal-50
                        flex items-center justify-center mr-3">

                        <i data-lucide="user"
                            class="w-5 h-5 text-teal-600"></i>

                    </div>

                    <div>
                        <h2 class="text-xl font-semibold text-slate-800">
                            Data Siswa
                        </h2>

                        <p class="text-slate-500 text-sm mt-1">
                            Perbarui data akademik dan biodata siswa
                        </p>
                    </div>

                </div>
            </div>


            {{-- BODY --}}
            <div class="p-6">

                {{-- ERROR GLOBAL --}}
                @if ($errors->any())

                    <div class="mb-6 rounded-xl border border-red-200
                        bg-red-50 px-4 py-4">

                        <div class="flex items-start gap-3">

                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-lg bg-red-100
                                    flex items-center justify-center">

                                    <i data-lucide="alert-circle"
                                        class="w-4 h-4 text-red-600"></i>

                                </div>
                            </div>

                            <div>
                                <div class="font-semibold text-red-800 mb-2">
                                    Data belum dapat disimpan
                                </div>

                                <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>

                    </div>

                @endif


                {{-- ========================================= --}}
                {{-- DATA AKADEMIK --}}
                {{-- ========================================= --}}

                <div class="rounded-2xl border border-slate-200 overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <div class="flex items-center">

                            <div class="w-10 h-10 rounded-xl bg-teal-50
                                flex items-center justify-center mr-3">

                                <i data-lucide="graduation-cap"
                                    class="w-5 h-5 text-teal-600"></i>

                            </div>

                            <div>
                                <h3 class="font-semibold text-lg text-slate-800">
                                    Data Akademik
                                </h3>

                                <p class="text-slate-500 text-sm mt-1">
                                    Informasi akademik siswa
                                </p>
                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NIPD --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    NIPD
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nipd"
                                    value="{{ old('nipd', $rows->nipd ?? '') }}"
                                    placeholder="Masukkan NIPD siswa"
                                    required
                                    class="w-full rounded-xl border
                                        @error('nipd')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nipd')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- TAHUN AJARAN --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Tahun Ajaran
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    name="id_thn_ajaran"
                                    required
                                    class="w-full rounded-xl border
                                        @error('id_thn_ajaran')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Tahun Ajaran --
                                    </option>

                                    @foreach ($tahunAjaran as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old(
                                                'id_thn_ajaran',
                                                $rows->id_thn_ajaran ?? ''
                                            ) == $item->id ? 'selected' : '' }}>

                                            {{ $item->thn_ajaran }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_thn_ajaran')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- JURUSAN --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Jurusan
                                </label>

                                <select
                                    name="id_jurusan"
                                    class="w-full rounded-xl border
                                        @error('id_jurusan')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Jurusan --
                                    </option>

                                    @foreach ($jurusan as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old(
                                                'id_jurusan',
                                                $rows->id_jurusan ?? ''
                                            ) == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_jurusan }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_jurusan')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- KELAS --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Kelas
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    name="id_kelas"
                                    required
                                    class="w-full rounded-xl border
                                        @error('id_kelas')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Kelas --
                                    </option>

                                    @foreach ($kelas as $item)

                                        <option value="{{ $item->idx }}"
                                            {{ old(
                                                'id_kelas',
                                                $rows->id_kelas ?? ''
                                            ) == $item->idx ? 'selected' : '' }}>

                                            {{ $item->nama_kelas }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_kelas')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- STATUS --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Status
                                    <span class="text-red-500">*</span>
                                </label>

                                <select
                                    name="sts_siswa"
                                    class="w-full rounded-xl border border-slate-200
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    @foreach($status_siswa as $baris)

                                        <option value="{{ $baris->id }}"
                                            {{ ($rows->status_siswa == $baris->id)
                                                ? 'selected'
                                                : '' }}>

                                            {{ $baris->status_siswa }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('status')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================= --}}
                {{-- BIODATA SISWA --}}
                {{-- ========================================= --}}

                <div class="mt-6 rounded-2xl border border-slate-200 overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <div class="flex items-center">

                            <div class="w-10 h-10 rounded-xl bg-amber-50
                                flex items-center justify-center mr-3">

                                <i data-lucide="user"
                                    class="w-5 h-5 text-amber-600"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-lg text-slate-800">
                                    Biodata Siswa
                                </h3>

                                <p class="text-slate-500 text-sm mt-1">
                                    Informasi identitas dan alamat siswa
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-6 gap-5">


                            {{-- NAMA LENGKAP --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Lengkap
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    value="{{ old(
                                        'nama_lengkap',
                                        $rows->nama_lengkap ?? ''
                                    ) }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                    class="w-full rounded-xl border
                                        @error('nama_lengkap')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nama_lengkap')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- NISN --}}
                            <div class="md:col-span-1.5">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    NISN
                                </label>

                                <input
                                    type="text"
                                    name="nisn"
                                    value="{{ old('nisn', $rows->nisn ?? '') }}"
                                    placeholder="Masukkan NISN"
                                    class="w-full rounded-xl border
                                        @error('nisn')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nisn')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- NIK --}}
                            <div class="md:col-span-1.5">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    NIK
                                </label>

                                <input
                                    type="text"
                                    name="nik"
                                    value="{{ old('nik', $rows->nik ?? '') }}"
                                    placeholder="Masukkan NIK"
                                    class="w-full rounded-xl border
                                        @error('nik')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nik')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- JENIS KELAMIN --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Jenis Kelamin
                                </label>

                                <div class="flex flex-wrap gap-6">

                                    <label class="inline-flex items-center gap-2 cursor-pointer">

                                        <input
                                            type="radio"
                                            name="jk"
                                            value="L"
                                            {{ old(
                                                'jk',
                                                $rows->jk ?? ''
                                            ) == 'L' ? 'checked' : '' }}
                                            class="w-4 h-4 text-teal-600
                                                border-slate-300
                                                focus:ring-teal-500">

                                        <span class="text-sm text-slate-700">
                                            Laki-Laki
                                        </span>

                                    </label>


                                    <label class="inline-flex items-center gap-2 cursor-pointer">

                                        <input
                                            type="radio"
                                            name="jk"
                                            value="P"
                                            {{ old(
                                                'jk',
                                                $rows->jk ?? ''
                                            ) == 'P' ? 'checked' : '' }}
                                            class="w-4 h-4 text-teal-600
                                                border-slate-300
                                                focus:ring-teal-500">

                                        <span class="text-sm text-slate-700">
                                            Perempuan
                                        </span>

                                    </label>

                                </div>

                                @error('jk')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- AGAMA --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Agama
                                </label>

                                <select
                                    name="id_agama"
                                    class="w-full rounded-xl border
                                        @error('id_agama')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Agama --
                                    </option>

                                    @foreach ($agama as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old(
                                                'id_agama',
                                                $rows->id_agama ?? ''
                                            ) == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_agama }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_agama')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- TEMPAT LAHIR --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Tempat Lahir
                                </label>

                                <input
                                    type="text"
                                    name="tmp_lahir"
                                    value="{{ old(
                                        'tmp_lahir',
                                        $rows->tmp_lahir ?? ''
                                    ) }}"
                                    placeholder="Masukkan tempat lahir"
                                    class="w-full rounded-xl border
                                        @error('tmp_lahir')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('tmp_lahir')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- TANGGAL LAHIR --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Tanggal Lahir
                                </label>

                                <input
                                    type="date"
                                    name="tgl_lahir"
                                    value="{{ old(
                                        'tgl_lahir',
                                        $rows->tgl_lahir ?? now()->format('Y-m-d')
                                    ) }}"
                                    class="w-full rounded-xl border border-slate-200
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('tgl_lahir')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $rows->email ?? '') }}"
                                    placeholder="Masukkan email siswa"
                                    class="w-full rounded-xl border
                                        @error('email')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('email')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- NO HP --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    No. HP
                                </label>

                                <input
                                    type="text"
                                    name="no_hp"
                                    value="{{ old('no_hp', $rows->no_hp ?? '') }}"
                                    placeholder="Contoh: 081234567890"
                                    class="w-full rounded-xl border
                                        @error('no_hp')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('no_hp')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- ALAMAT --}}
                            <div class="col-span-full">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Alamat
                                </label>

                                <textarea
                                    name="alamat"
                                    rows="3"
                                    placeholder="Masukkan alamat lengkap"
                                    class="w-full rounded-xl border
                                        @error('alamat')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        px-4 py-2.5 text-sm resize-none
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">{{ old('alamat', $rows->alamat ?? '') }}</textarea>

                                @error('alamat')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- DUSUN --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Dusun
                                </label>

                                <input
                                    type="text"
                                    name="dusun"
                                    value="{{ old('dusun', $rows->dusun ?? '') }}"
                                    class="w-full rounded-xl border border-slate-200
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                            </div>


                            {{-- DESA --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Desa
                                </label>

                                <input
                                    type="text"
                                    name="desa"
                                    value="{{ old('desa', $rows->desa ?? '') }}"
                                    class="w-full rounded-xl border border-slate-200
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                            </div>


                            {{-- KECAMATAN --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Kecamatan
                                </label>

                                <input
                                    type="text"
                                    name="kecamatan"
                                    value="{{ old(
                                        'kecamatan',
                                        $rows->kecamatan ?? ''
                                    ) }}"
                                    class="w-full rounded-xl border border-slate-200
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                            </div>


                            {{-- KOTA --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Kota/Kabupaten
                                </label>

                                <input
                                    type="text"
                                    name="kota"
                                    value="{{ old('kota', $rows->kota ?? '') }}"
                                    class="w-full rounded-xl border border-slate-200
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                            </div>


                            {{-- PROVINSI --}}
                            <div class="md:col-span-3">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Provinsi
                                </label>

                                <input
                                    type="text"
                                    name="provinsi"
                                    value="{{ old(
                                        'provinsi',
                                        $rows->provinsi ?? ''
                                    ) }}"
                                    class="w-full rounded-xl border border-slate-200
                                        px-4 py-2.5 text-sm
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="px-6 py-5 border-t border-slate-200 bg-slate-50
                flex flex-col sm:flex-row justify-end gap-3">

                <a href="{{ route('siswa.index') }}"
                    class="inline-flex items-center justify-center gap-2
                    px-5 py-2.5 rounded-xl border border-slate-200
                    bg-white text-sm font-semibold text-slate-600
                    hover:bg-slate-100 transition">

                    <i data-lucide="arrow-left"
                        class="w-4 h-4"></i>

                    Kembali

                </a>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                    px-6 py-2.5 rounded-xl bg-teal-600
                    text-sm font-semibold text-white
                    hover:bg-teal-700
                    focus:outline-none focus:ring-2
                    focus:ring-teal-500/30
                    transition">

                    <i data-lucide="save"
                        class="w-4 h-4"></i>

                    Simpan Data Siswa

                </button>

            </div>

        </div>

    </div>

</form>