<form action="{{ route('siswa.update.upload', $rows->id ?? '') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mt-5">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-teal-50
                    flex items-center justify-center">

                    <i data-lucide="upload-cloud"
                        class="w-5 h-5 text-teal-600"></i>

                </div>

                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Upload Dokumen Siswa
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Unggah foto dan dokumen kelengkapan siswa
                    </p>
                </div>

            </div>

        </div>


        {{-- BODY --}}
        <div class="p-6">

            {{-- ERROR GLOBAL --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 px-4 py-3 text-sm text-red-700">

                    <div class="flex items-start gap-3">

                        <i data-lucide="circle-alert"
                            class="w-5 h-5 mt-0.5 shrink-0"></i>

                        <div>

                            <div class="font-semibold mb-2">
                                Dokumen belum dapat diunggah:
                            </div>

                            <ul class="list-disc pl-5 space-y-1">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- INFO --}}
            <div class="mb-6 rounded-xl border border-teal-100
                bg-teal-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i data-lucide="info"
                        class="w-5 h-5 text-teal-600 mt-0.5 shrink-0"></i>

                    <div class="text-sm text-teal-800">

                        <p class="font-semibold">
                            Informasi Upload
                        </p>

                        <p class="mt-1 text-teal-700">
                            Pastikan dokumen yang diunggah jelas dan dapat
                            dibaca. Ukuran file mengikuti batas maksimal
                            masing-masing dokumen.
                        </p>

                    </div>

                </div>

            </div>


            {{-- DOKUMEN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- FOTO SISWA --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Foto Siswa
                    </label>

                    <input
                        type="file"
                        name="foto_siswa"
                        accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                    </p>

                    @error('foto_siswa')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->foto_siswa))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <img
                                src="{{ asset('storage/app/public/' . $rows->foto_siswa) }}"
                                alt="Foto siswa"
                                class="w-40 h-40 object-cover rounded-xl
                                    border border-slate-200 shadow-sm">

                        </div>

                    @endif

                </div>


                {{-- KARTU KELUARGA --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kartu Keluarga
                    </label>

                    <input
                        type="file"
                        name="kk"
                        accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format gambar atau PDF. Maksimal 2 MB.
                    </p>

                    @error('kk')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->kk))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <a
                                href="{{ asset('storage/app/public/' . $rows->kk) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                    px-4 py-2 rounded-xl
                                    border border-teal-200
                                    bg-teal-50 text-teal-700
                                    text-sm font-semibold
                                    hover:bg-teal-100 transition">

                                <i data-lucide="file-text"
                                    class="w-4 h-4"></i>

                                Lihat Kartu Keluarga

                            </a>

                        </div>

                    @endif

                </div>


                {{-- AKTA KELAHIRAN --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Akta Kelahiran
                    </label>

                    <input
                        type="file"
                        name="akta_kelahiran"
                        accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format gambar atau PDF. Maksimal 2 MB.
                    </p>

                    @error('akta_kelahiran')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->akta_kelahiran))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <a
                                href="{{ asset('storage/app/public/' . $rows->akta_kelahiran) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                    px-4 py-2 rounded-xl
                                    border border-teal-200
                                    bg-teal-50 text-teal-700
                                    text-sm font-semibold
                                    hover:bg-teal-100 transition">

                                <i data-lucide="file-text"
                                    class="w-4 h-4"></i>

                                Lihat Akta Kelahiran

                            </a>

                        </div>

                    @endif

                </div>


                {{-- IJAZAH --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Ijazah
                    </label>

                    <input
                        type="file"
                        name="ijazah"
                        accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format gambar atau PDF. Maksimal 4 MB.
                    </p>

                    @error('ijazah')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->ijazah))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <a
                                href="{{ asset('storage/app/public/' . $rows->ijazah) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                    px-4 py-2 rounded-xl
                                    border border-teal-200
                                    bg-teal-50 text-teal-700
                                    text-sm font-semibold
                                    hover:bg-teal-100 transition">

                                <i data-lucide="file-text"
                                    class="w-4 h-4"></i>

                                Lihat Ijazah

                            </a>

                        </div>

                    @endif

                </div>


                {{-- RAPORT --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Raport
                    </label>

                    <input
                        type="file"
                        name="raport"
                        accept=".pdf,application/pdf"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format PDF. Maksimal 4 MB.
                    </p>

                    @error('raport')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->raport))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <a
                                href="{{ asset('storage/app/public/' . $rows->raport) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                    px-4 py-2 rounded-xl
                                    border border-teal-200
                                    bg-teal-50 text-teal-700
                                    text-sm font-semibold
                                    hover:bg-teal-100 transition">

                                <i data-lucide="file-text"
                                    class="w-4 h-4"></i>

                                Lihat Raport

                            </a>

                        </div>

                    @endif

                </div>


                {{-- KTP AYAH --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        KTP Ayah
                    </label>

                    <input
                        type="file"
                        name="ktp_ayah"
                        accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format gambar atau PDF. Maksimal 2 MB.
                    </p>

                    @error('ktp_ayah')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->ktp_ayah))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <a
                                href="{{ asset('storage/app/public/' . $rows->ktp_ayah) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                    px-4 py-2 rounded-xl
                                    border border-teal-200
                                    bg-teal-50 text-teal-700
                                    text-sm font-semibold
                                    hover:bg-teal-100 transition">

                                <i data-lucide="file-text"
                                    class="w-4 h-4"></i>

                                Lihat KTP Ayah

                            </a>

                        </div>

                    @endif

                </div>


                {{-- KTP IBU --}}
                <div class="rounded-2xl border border-slate-200
                    p-5 hover:border-teal-200 transition">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        KTP Ibu
                    </label>

                    <input
                        type="file"
                        name="ktp_ibu"
                        accept=".jpg,.jpeg,.png,.pdf,image/jpeg,image/png,application/pdf"
                        class="block w-full text-sm text-slate-600
                        file:mr-4 file:rounded-lg file:border-0
                        file:bg-teal-50 file:px-4 file:py-2
                        file:text-sm file:font-semibold
                        file:text-teal-700
                        hover:file:bg-teal-100
                        cursor-pointer
                        border border-slate-200 rounded-xl">

                    <p class="text-xs text-slate-500 mt-2">
                        Format gambar atau PDF. Maksimal 2 MB.
                    </p>

                    @error('ktp_ibu')
                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                    @if (!empty($rows->ktp_ibu))

                        <div class="mt-4">

                            <p class="text-xs font-medium text-slate-500 mb-2">
                                File saat ini
                            </p>

                            <a
                                href="{{ asset('storage/app/public/' . $rows->ktp_ibu) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2
                                    px-4 py-2 rounded-xl
                                    border border-teal-200
                                    bg-teal-50 text-teal-700
                                    text-sm font-semibold
                                    hover:bg-teal-100 transition">

                                <i data-lucide="file-text"
                                    class="w-4 h-4"></i>

                                Lihat KTP Ibu

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="px-6 py-5 border-t border-slate-200 bg-slate-50
            flex flex-col sm:flex-row justify-end gap-3">

            <a
                href="{{ route('siswa.index') }}"
                class="inline-flex items-center justify-center gap-2
                    px-5 py-2.5 rounded-xl
                    border border-slate-300
                    bg-white text-slate-700
                    text-sm font-semibold
                    hover:bg-slate-50
                    transition">

                <i data-lucide="arrow-left"
                    class="w-4 h-4"></i>

                Kembali

            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                    px-6 py-2.5 rounded-xl
                    bg-teal-600 text-white
                    text-sm font-semibold
                    hover:bg-teal-700
                    focus:outline-none
                    focus:ring-2 focus:ring-teal-500/30
                    transition">

                <i data-lucide="upload"
                    class="w-4 h-4"></i>

                Upload Dokumen

            </button>

        </div>

    </div>

</form>