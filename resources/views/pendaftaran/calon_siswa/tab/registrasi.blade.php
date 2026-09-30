<form action="{{ route('calon-siswa.update.registrasi', $rows->id ?? 0) }}"
      method="POST">

    @csrf

    <!-- INFORMASI ASAL SEKOLAH -->
    <section class="bg-white rounded-xl border border-slate-200/90 shadow-sm p-6"
             data-purpose="card-asal-sekolah">

        <!-- Card Header -->
        <div class="flex items-center gap-3.5 mb-6">

            <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                <svg class="w-5 h-5 text-[#00B686]"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M12 14l9-5-9-5-9 5 9 5z"
                          stroke-linecap="round"
                          stroke-linejoin="round"></path>

                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                          stroke-linecap="round"
                          stroke-linejoin="round"></path>

                    <path d="M12 14v6.5"
                          stroke-linecap="round"
                          stroke-linejoin="round"></path>
                </svg>
            </div>

            <div>
                <h3 class="text-base font-semibold text-slate-800">
                    Informasi Asal Sekolah
                </h3>

                <p class="text-xs text-slate-400">
                    Data riwayat pendidikan jenjang sebelumnya
                </p>
            </div>

        </div>


        <!-- Form Fields -->
        <div class="space-y-5">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Nama Sekolah -->
                <div class="md:col-span-2">

                    <label for="sekolah_asal"
                           class="block text-xs font-semibold text-slate-700 mb-1.5">

                        Nama Sekolah Sebelumnya

                    </label>

                    <input
                        type="text"
                        id="sekolah_asal"
                        name="sekolah_asal"
                        placeholder="Contoh: SMP Negeri 01 Kota"
                        value="{{ old('sekolah_asal', $rows->nama_sekolah_asal ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg text-sm text-slate-800 px-3.5 py-2.5
                               focus:ring-1 focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>


                <!-- Alamat Sekolah -->
                <div class="md:col-span-2">

                    <label for="alamat_sekolah_asal"
                           class="block text-xs font-semibold text-slate-700 mb-1.5">

                        Alamat Lengkap Asal Sekolah

                    </label>

                    <textarea
                        id="alamat_sekolah_asal"
                        name="alamat_sekolah_asal"
                        rows="3"
                        placeholder="Masukkan alamat lengkap sekolah..."
                        class="w-full border border-slate-200 rounded-lg text-sm text-slate-800 px-3.5 py-2.5
                               focus:ring-1 focus:ring-[#00B686]
                               focus:border-[#00B686]
                               resize-none">{{ old('alamat_sekolah_asal', $rows->alamat_sekolah_asal ?? '') }}</textarea>

                </div>


                <!-- Kabupaten Sekolah -->
                <div>

                    <label for="kabupaten_sekolah_asal"
                           class="block text-xs font-semibold text-slate-700 mb-1.5">

                        Kabupaten Sekolah Asal

                    </label>

                    <input
                        type="text"
                        id="kabupaten_sekolah_asal"
                        name="kabupaten_sekolah_asal"
                        placeholder="Kabupaten Asal Sekolah"
                        value="{{ old('kabupaten_sekolah_asal', $rows->kab_sekolah ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg text-sm text-slate-800 px-3.5 py-2.5
                               focus:ring-1 focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>


                <!-- Provinsi Sekolah -->
                <div>

                    <label for="provinsi_sekolah_asal"
                           class="block text-xs font-semibold text-slate-700 mb-1.5">

                        Provinsi Sekolah Asal

                    </label>

                    <input
                        type="text"
                        id="provinsi_sekolah_asal"
                        name="provinsi_sekolah_asal"
                        placeholder="Provinsi Asal Sekolah"
                        value="{{ old('provinsi_sekolah_asal', $rows->prov_sekolah ?? '') }}"
                        class="w-full border border-slate-200 rounded-lg text-sm text-slate-800 px-3.5 py-2.5
                               focus:ring-1 focus:ring-[#00B686]
                               focus:border-[#00B686]">

                </div>

            </div>


            <!-- Form Action -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100">

                <button
                    type="reset"
                    class="px-5 py-2 text-sm font-medium text-slate-600
                           hover:text-slate-800 transition-colors">

                    Reset

                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5
                           bg-[#00B686] hover:bg-[#009e74]
                           text-white text-sm font-semibold
                           rounded-lg shadow-sm transition-colors">

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

                    <span>Simpan Perubahan</span>

                </button>

            </div>

        </div>

    </section>


    <!-- INFORMASI PENTING -->
    <section class="bg-[#eff6ff] rounded-xl border border-blue-100 p-5 flex items-start gap-4 mt-5">

        <div class="w-6 h-6 rounded-full flex items-center justify-center
                    text-[#0284c7] flex-shrink-0 mt-0.5">

            <svg class="w-6 h-6"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <circle cx="12"
                        cy="12"
                        r="10"
                        stroke-width="2">
                </circle>

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
                Informasi Penting
            </h4>

            <p>
                Pastikan data asal sekolah sesuai dengan buku rapor atau
                Surat Keterangan Lulus (SKL) terakhir Anda.
                Ketidaksesuaian data dapat menghambat proses verifikasi berkas.
            </p>

        </div>

    </section>

</form>