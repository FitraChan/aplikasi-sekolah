
<!-- BEGIN: Card Informasi Orang Tua -->
<section class="bg-white rounded-xl border border-slate-200/90 shadow-sm p-6"
    data-purpose="card-orangtua">

    <!-- Header -->
    <div class="flex items-center gap-3.5 mb-6">

        <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center">
            <svg class="w-5 h-5 text-[#00B686]"
                fill="currentColor"
                viewBox="0 0 24 24">

                <path
                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                </path>

            </svg>
        </div>

        <div>
            <h3 class="text-base font-semibold text-slate-800">
                Detail Informasi Orang Tua
            </h3>

            <p class="text-xs text-slate-400">
                Data identitas orang tua atau wali calon siswa
            </p>
        </div>

    </div>


    <!-- Form -->
    <form action="{{ route('calon-siswa.update.orangtua', $rows->id ?? 0) }}"
        method="POST">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <!-- Nama Lengkap Ortu -->
            <div>

                <label
                    class="block text-xs font-semibold text-slate-700 mb-1.5"
                    for="nama-ayah">

                    Nama Lengkap Ortu

                </label>

                <input
                    type="text"
                    id="nama-ayah"
                    name="nama_ayah"
                    value="{{ old('nama_ayah', $rows->nama_ayah) }}"
                    placeholder="Masukkan nama lengkap ortu"
                    class="w-full border border-slate-200 rounded-lg
                           text-sm text-slate-800
                           px-3.5 py-2.5
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]">

            </div>


            <!-- Pekerjaan -->
            <div>

                <label
                    class="block text-xs font-semibold text-slate-700 mb-1.5"
                    for="pekerjaan-ayah">

                    Pekerjaan

                </label>

                <select
                    id="pekerjaan-ayah"
                    name="pekerjaan_ayah"
                    class="w-full border border-slate-200 rounded-lg
                           text-sm text-slate-800
                           px-3.5 py-2.5
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]">

                    <option value="">
                        -- Pilih Pekerjaan --
                    </option>

                    @if(count($jobs))

                        @foreach($jobs as $list)

                            <option
                                value="{{ $list['id'] }}"
                                {{ (string) $list['id'] === (string) $rows->id_kerja_ayah ? 'selected' : '' }}>

                                {{ $list['nama_pekerjaan'] }}

                            </option>

                        @endforeach

                    @endif

                </select>

            </div>


            <!-- Alamat Orang Tua -->
            <div>

                <label
                    class="block text-xs font-semibold text-slate-700 mb-1.5"
                    for="alamat-ayah">

                    Alamat Orang Tua / Wali

                </label>

                <input
                    type="text"
                    id="alamat-ayah"
                    name="alamat_ayah"
                    value="{{ old('alamat_ayah', $rows->alamat_ayah) }}"
                    placeholder="Masukkan alamat ortu"
                    class="w-full border border-slate-200 rounded-lg
                           text-sm text-slate-800
                           px-3.5 py-2.5
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]">

            </div>


            <!-- No HP Ortu -->
            <div>

                <label
                    class="block text-xs font-semibold text-slate-700 mb-1.5"
                    for="hp-ayah">

                    No. HP Ortu

                </label>

                <input
                    type="text"
                    id="hp-ayah"
                    name="hp_ayah"
                    value="{{ old('hp_ayah', $rows->hp_ayah) }}"
                    placeholder="No. HP Ortu"
                    class="w-full border border-slate-200 rounded-lg
                           text-sm text-slate-800
                           px-3.5 py-2.5
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]">

            </div>


            <!-- Dari Mana Tahu SMK -->
            <div class="md:col-span-2">

                <label
                    class="block text-xs font-semibold text-slate-700 mb-1.5"
                    for="tahu-smk-dari-mana">

                    Dari Mana Tahu SMK TI

                </label>

                <select
                    id="tahu-smk-dari-mana"
                    name="tahu_smk_dari_mana"
                    class="w-full border border-slate-200 rounded-lg
                           text-sm text-slate-800
                           px-3.5 py-2.5
                           focus:ring-1 focus:ring-[#00B686]
                           focus:border-[#00B686]">

                    <option value="">
                        -- Pilih Sumber Informasi --
                    </option>

                    <option value="Media Sosial"
                        {{ old('tahu_smk_dari_mana', $rows->tahu_smk_dari_mana) == 'Media Sosial' ? 'selected' : '' }}>
                        Media Sosial
                    </option>

                    <option value="Media Elektornik"
                        {{ old('tahu_smk_dari_mana', $rows->tahu_smk_dari_mana) == 'Media Elektornik' ? 'selected' : '' }}>
                        Media Elektronik
                    </option>

                    <option value="Website"
                        {{ old('tahu_smk_dari_mana', $rows->tahu_smk_dari_mana) == 'Website' ? 'selected' : '' }}>
                        Website
                    </option>

                    <option value="Teman/Saudara"
                        {{ old('tahu_smk_dari_mana', $rows->tahu_smk_dari_mana) == 'Teman/Saudara' ? 'selected' : '' }}>
                        Teman/Saudara
                    </option>

                    <option value="Sosialisasi"
                        {{ old('tahu_smk_dari_mana', $rows->tahu_smk_dari_mana) == 'Sosialisasi' ? 'selected' : '' }}>
                        Sosialisasi
                    </option>

                </select>

            </div>

        </div>


        <!-- Divider & Action -->
        <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-slate-100">

            <!-- Reset -->
            <button
                type="reset"
                class="px-5 py-2 text-sm font-medium
                       text-slate-600
                       hover:text-slate-800
                       transition-colors">

                Reset

            </button>


            <!-- Submit -->
            <button
                type="submit"
                class="inline-flex items-center gap-2
                       px-5 py-2.5
                       bg-[#00B686]
                       hover:bg-[#009e74]
                       text-white
                       text-sm font-semibold
                       rounded-lg
                       shadow-sm
                       transition-colors">

                <svg
                    class="w-4 h-4"
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

</section>
<!-- END: Card Informasi Orang Tua -->

