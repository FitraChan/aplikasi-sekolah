<form action="{{ route('siswa.update.orangtua', $rows->id ?? '') }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="max-w-7xl mx-auto">

        <div class="bg-white shadow-sm border border-slate-200 rounded-2xl overflow-hidden">

            {{-- ========================================= --}}
            {{-- HEADER --}}
            {{-- ========================================= --}}
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                <div class="flex items-center">

                    <div class="w-10 h-10 rounded-xl bg-teal-50
                        flex items-center justify-center mr-3">

                        <i data-lucide="users"
                            class="w-5 h-5 text-teal-600"></i>

                    </div>

                    <div>

                        <h2 class="text-xl font-semibold text-slate-800">
                            Data Orang Tua dan Wali
                        </h2>

                        <p class="text-slate-500 text-sm mt-1">
                            Lengkapi data ayah, ibu, dan wali siswa
                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- BODY --}}
            {{-- ========================================= --}}
            <div class="p-6">

                {{-- ERROR --}}
                @if ($errors->any())

                    <div class="mb-6 rounded-xl border border-red-200
                        bg-red-50 px-4 py-4">

                        <div class="flex items-start gap-3">

                            <div class="w-8 h-8 rounded-lg bg-red-100
                                flex items-center justify-center flex-shrink-0">

                                <i data-lucide="alert-circle"
                                    class="w-4 h-4 text-red-600"></i>

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
                {{-- DATA AYAH --}}
                {{-- ========================================= --}}
                <section class="rounded-2xl border border-slate-200 overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-xl bg-blue-50
                                flex items-center justify-center">

                                <i data-lucide="user"
                                    class="w-4 h-4 text-blue-600"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-lg text-slate-800">
                                    Data Ayah
                                </h3>

                                <p class="text-slate-500 text-sm mt-1">
                                    Informasi identitas dan kontak ayah
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NAMA AYAH --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Ayah
                                </label>

                                <input
                                    type="text"
                                    name="nama_ayah"
                                    value="{{ old('nama_ayah', $rows->nama_ayah ?? '') }}"
                                    placeholder="Masukkan nama ayah"
                                    class="w-full rounded-xl border
                                        @error('nama_ayah')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nama_ayah')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PEKERJAAN AYAH --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Pekerjaan Ayah
                                </label>

                                <select
                                    name="id_kerja_ayah"
                                    class="w-full rounded-xl border
                                        @error('id_kerja_ayah')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Pekerjaan Ayah --
                                    </option>

                                    @foreach ($jobs as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old(
                                                'id_kerja_ayah',
                                                $rows->id_kerja_ayah ?? ''
                                            ) == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_pekerjaan }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_kerja_ayah')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- ALAMAT AYAH --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Alamat Ayah
                                </label>

                                <textarea
                                    name="alamat_ayah"
                                    rows="3"
                                    placeholder="Masukkan alamat ayah"
                                    class="w-full rounded-xl border
                                        @error('alamat_ayah')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        resize-none
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">{{ old('alamat_ayah', $rows->alamat_ayah ?? '') }}</textarea>

                                @error('alamat_ayah')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- HP AYAH --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    No. HP Ayah
                                </label>

                                <input
                                    type="text"
                                    name="hp_ayah"
                                    value="{{ old('hp_ayah', $rows->hp_ayah ?? '') }}"
                                    placeholder="Contoh: 081234567890"
                                    class="w-full rounded-xl border
                                        @error('hp_ayah')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('hp_ayah')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ========================================= --}}
                {{-- DATA IBU --}}
                {{-- ========================================= --}}
                <section class="mt-6 rounded-2xl border border-slate-200 overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-xl bg-pink-50
                                flex items-center justify-center">

                                <i data-lucide="user-round"
                                    class="w-4 h-4 text-pink-600"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-lg text-slate-800">
                                    Data Ibu
                                </h3>

                                <p class="text-slate-500 text-sm mt-1">
                                    Informasi identitas dan kontak ibu
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NAMA IBU --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Ibu
                                </label>

                                <input
                                    type="text"
                                    name="nama_ibu"
                                    value="{{ old('nama_ibu', $rows->nama_ibu ?? '') }}"
                                    placeholder="Masukkan nama ibu"
                                    class="w-full rounded-xl border
                                        @error('nama_ibu')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nama_ibu')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PEKERJAAN IBU --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Pekerjaan Ibu
                                </label>

                                <select
                                    name="id_kerja_ibu"
                                    class="w-full rounded-xl border
                                        @error('id_kerja_ibu')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Pekerjaan Ibu --
                                    </option>

                                    @foreach ($jobs as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old(
                                                'id_kerja_ibu',
                                                $rows->id_kerja_ibu ?? ''
                                            ) == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_pekerjaan }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_kerja_ibu')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- ALAMAT IBU --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Alamat Ibu
                                </label>

                                <textarea
                                    name="alamat_ibu"
                                    rows="3"
                                    placeholder="Masukkan alamat ibu"
                                    class="w-full rounded-xl border
                                        @error('alamat_ibu')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        resize-none
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">{{ old('alamat_ibu', $rows->alamat_ibu ?? '') }}</textarea>

                                @error('alamat_ibu')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- HP IBU --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    No. HP Ibu
                                </label>

                                <input
                                    type="text"
                                    name="hp_ibu"
                                    value="{{ old('hp_ibu', $rows->hp_ibu ?? '') }}"
                                    placeholder="Contoh: 081234567890"
                                    class="w-full rounded-xl border
                                        @error('hp_ibu')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('hp_ibu')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ========================================= --}}
                {{-- DATA WALI --}}
                {{-- ========================================= --}}
                <section class="mt-6 rounded-2xl border border-slate-200 overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-xl bg-amber-50
                                flex items-center justify-center">

                                <i data-lucide="contact"
                                    class="w-4 h-4 text-amber-600"></i>

                            </div>

                            <div>

                                <h3 class="font-semibold text-lg text-slate-800">
                                    Data Wali
                                </h3>

                                <p class="text-slate-500 text-sm mt-1">
                                    Bagian ini dapat dikosongkan jika siswa tidak memiliki wali.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NAMA WALI --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Wali
                                </label>

                                <input
                                    type="text"
                                    name="nama_wali"
                                    value="{{ old('nama_wali', $rows->nama_wali ?? '') }}"
                                    placeholder="Masukkan nama wali"
                                    class="w-full rounded-xl border
                                        @error('nama_wali')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('nama_wali')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PEKERJAAN WALI --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Pekerjaan Wali
                                </label>

                                <select
                                    name="id_kerja_wali"
                                    class="w-full rounded-xl border
                                        @error('id_kerja_wali')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                    <option value="">
                                        -- Pilih Pekerjaan Wali --
                                    </option>

                                    @foreach ($jobs as $item)

                                        <option value="{{ $item->id }}"
                                            {{ old(
                                                'id_kerja_wali',
                                                $rows->id_kerja_wali ?? ''
                                            ) == $item->id ? 'selected' : '' }}>

                                            {{ $item->nama_pekerjaan }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('id_kerja_wali')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- ALAMAT WALI --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Alamat Wali
                                </label>

                                <textarea
                                    name="alamat_wali"
                                    rows="3"
                                    placeholder="Masukkan alamat wali"
                                    class="w-full rounded-xl border
                                        @error('alamat_wali')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        resize-none
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">{{ old('alamat_wali', $rows->alamat_wali ?? '') }}</textarea>

                                @error('alamat_wali')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- HP WALI --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    No. HP Wali
                                </label>

                                <input
                                    type="text"
                                    name="hp_wali"
                                    value="{{ old('hp_wali', $rows->hp_wali ?? '') }}"
                                    placeholder="Contoh: 081234567890"
                                    class="w-full rounded-xl border
                                        @error('hp_wali')
                                            border-red-400
                                        @else
                                            border-slate-200
                                        @enderror
                                        bg-white px-4 py-2.5 text-sm text-slate-700
                                        placeholder:text-slate-400
                                        focus:border-teal-500 focus:ring-2
                                        focus:ring-teal-500/20 outline-none
                                        transition">

                                @error('hp_wali')
                                    <div class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </section>

            </div>


            {{-- ========================================= --}}
            {{-- FOOTER --}}
            {{-- ========================================= --}}
            <div class="px-6 py-5 border-t border-slate-200 bg-slate-50
                flex flex-col sm:flex-row justify-end gap-3">

                <a href="{{ route('siswa.index') }}"
                    class="inline-flex items-center justify-center gap-2
                    px-5 py-2.5 rounded-xl
                    border border-slate-200 bg-white
                    text-sm font-semibold text-slate-600
                    hover:bg-slate-100
                    transition">

                    <i data-lucide="arrow-left"
                        class="w-4 h-4"></i>

                    Kembali

                </a>


                <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                    px-6 py-2.5 rounded-xl
                    bg-teal-600 text-white
                    text-sm font-semibold
                    hover:bg-teal-700
                    focus:outline-none focus:ring-2
                    focus:ring-teal-500/30
                    transition">

                    <i data-lucide="save"
                        class="w-4 h-4"></i>

                    Simpan Data Orang Tua

                </button>

            </div>

        </div>

    </div>

</form>