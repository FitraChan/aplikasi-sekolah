<form action="{{ route('siswa.update.registrasi', $rows->id ?? 0) }}"
    method="POST">

    @csrf

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-teal-50
                    flex items-center justify-center">

                    <i data-lucide="school"
                        class="w-5 h-5 text-teal-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        Asal Sekolah
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Informasi sekolah asal siswa
                    </p>

                </div>

            </div>

        </div>


        {{-- BODY --}}
        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- NAMA SEKOLAH --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Sekolah
                        <span class="font-normal text-slate-400">
                            (SMP/MTs)
                        </span>
                    </label>

                    <input
                        type="text"
                        name="sekolah_asal"
                        value="{{ old('sekolah_asal', $rows->nama_sekolah_asal ?? '') }}"
                        placeholder="Nama Sekolah"
                        class="w-full rounded-xl border border-slate-200
                            bg-white px-4 py-2.5 text-sm text-slate-700
                            placeholder:text-slate-400
                            focus:border-teal-500
                            focus:ring-2 focus:ring-teal-500/20
                            outline-none transition">

                </div>


                {{-- ALAMAT SEKOLAH --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Alamat Asal Sekolah
                    </label>

                    <input
                        type="text"
                        name="alamat_sekolah_asal"
                        value="{{ old('alamat_sekolah_asal', $rows->alamat_sekolah_asal ?? '') }}"
                        placeholder="Alamat Asal Sekolah"
                        class="w-full rounded-xl border border-slate-200
                            bg-white px-4 py-2.5 text-sm text-slate-700
                            placeholder:text-slate-400
                            focus:border-teal-500
                            focus:ring-2 focus:ring-teal-500/20
                            outline-none transition">

                </div>


                {{-- KABUPATEN --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Kabupaten Sekolah Asal
                    </label>

                    <input
                        type="text"
                        name="kabupaten_sekolah_asal"
                        value="{{ old('kabupaten_sekolah_asal', $rows->kab_sekolah ?? '') }}"
                        placeholder="Kabupaten Asal Sekolah"
                        class="w-full rounded-xl border border-slate-200
                            bg-white px-4 py-2.5 text-sm text-slate-700
                            placeholder:text-slate-400
                            focus:border-teal-500
                            focus:ring-2 focus:ring-teal-500/20
                            outline-none transition">

                </div>


                {{-- PROVINSI --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Provinsi Sekolah Asal
                    </label>

                    <input
                        type="text"
                        name="provinsi_sekolah_asal"
                        value="{{ old('provinsi_sekolah_asal', $rows->prov_sekolah ?? '') }}"
                        placeholder="Provinsi Asal Sekolah"
                        class="w-full rounded-xl border border-slate-200
                            bg-white px-4 py-2.5 text-sm text-slate-700
                            placeholder:text-slate-400
                            focus:border-teal-500
                            focus:ring-2 focus:ring-teal-500/20
                            outline-none transition">

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="px-6 py-5 border-t border-slate-200 bg-slate-50
            flex justify-end">

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

                <i data-lucide="save"
                    class="w-4 h-4"></i>

                Simpan

            </button>

        </div>

    </div>

</form>