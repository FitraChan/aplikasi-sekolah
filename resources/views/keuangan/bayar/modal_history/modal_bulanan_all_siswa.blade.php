<div
    id="modal-bulanan-all-siswa"
    class="hidden fixed inset-0 z-[9999]
           items-center justify-center
           bg-slate-900/50
           p-4"
    tabindex="-1"
>

    <div
        class="w-full max-w-lg
               bg-white
               rounded-xl
               shadow-xl
               overflow-hidden"
    >

        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div
            class="flex items-center justify-between
                   px-6 py-4
                   border-b border-slate-200"
        >

            <h2 class="text-lg font-semibold text-slate-800">
                Generate Tagihan Bulanan
            </h2>

            <!-- TOMBOL CLOSE -->

            <button
                type="button"
                onclick="closeModalBulananAllSiswa()"
                class="inline-flex items-center justify-center
                       w-8 h-8
                       rounded-lg
                       text-slate-400
                       hover:text-slate-600
                       hover:bg-slate-100
                       transition-colors"
                aria-label="Tutup"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6l12 12M6 18L18 6"
                    />

                </svg>

            </button>

        </div>


        <!-- =====================================================
             BODY
        ====================================================== -->

        <div class="px-6 py-5 space-y-5">


            <!-- TAHUN ANGKATAN -->

            <div>

                <label
                    for="id_thn_ajaran"
                    class="block text-sm font-medium
                           text-slate-700 mb-1.5"
                >
                    Tahun Angkatan
                </label>

                <select
                    id="id_thn_ajaran"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

                    <option value="">
                        Pilih Tahun Angkatan
                    </option>

                    @foreach($tahun as $row)

                        <option value="{{ $row->id }}">
                            {{ $row->thn_ajaran }}
                        </option>

                    @endforeach

                </select>

            </div>


            <!-- JURUSAN -->

            <div>

                <label
                    for="id_jurusan"
                    class="block text-sm font-medium
                           text-slate-700 mb-1.5"
                >
                    Jurusan
                </label>

                <select
                    id="id_jurusan"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

                    <option value="">
                        Pilih Jurusan
                    </option>

                    <option value="all_jurusan">
                        Semua Jurusan
                    </option>

                    @foreach($jurusan as $row)

                        <option value="{{ $row->id }}">
                            {{ $row->nama_jurusan }}
                        </option>

                    @endforeach

                </select>

            </div>


            <!-- TAHUN PEMBAYARAN -->

            <div>

                <label
                    for="id_tahun"
                    class="block text-sm font-medium
                           text-slate-700 mb-1.5"
                >
                    Tahun Pembayaran
                </label>

                <input
                    type="number"
                    id="id_tahun"
                    name="id_tahun"
                    placeholder="Masukkan Tahun"
                    min="1000"
                    max="9999"
                    required
                    oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4)"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

            </div>


            <!-- BULAN -->

            <div>

                <label
                    for="id_bulan"
                    class="block text-sm font-medium
                           text-slate-700 mb-1.5"
                >
                    Bulan
                </label>

                <select
                    id="id_bulan"
                    class="w-full
                           rounded-lg
                           border border-slate-300
                           bg-white
                           px-3 py-2.5
                           text-sm text-slate-700
                           outline-none
                           transition
                           focus:border-[#02BC9C]
                           focus:ring-2
                           focus:ring-[#02BC9C]/20"
                >

                    <option value="all_bulan">
                        Semua Bulan
                    </option>

                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>

                </select>

            </div>

        </div>


        <!-- =====================================================
             FOOTER
        ====================================================== -->

        <div
            class="flex flex-col-reverse sm:flex-row
                   sm:justify-end
                   gap-2
                   px-6 py-4
                   bg-slate-50
                   border-t border-slate-200"
        >

            <!-- BATAL -->

            <button
                type="button"
                onclick="closeModalBulananAllSiswa()"
                class="inline-flex items-center justify-center
                       px-4 py-2.5
                       rounded-lg
                       border border-slate-300
                       bg-white
                       text-sm font-medium
                       text-slate-700
                       hover:bg-slate-100
                       transition-colors"
            >
                Batal
            </button>


            <!-- SIMPAN -->

            <button
                type="button"
                onclick="saveDefBulan()"
                id="btn-save-def-bulan"
                class="inline-flex items-center justify-center
                       gap-2
                       px-4 py-2.5
                       rounded-lg
                       bg-[#02BC9C]
                       hover:bg-[#00B686]
                       text-white
                       text-sm font-medium
                       shadow-sm
                       transition-colors"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12l4 4L19 6"
                    />

                </svg>

                Simpan

            </button>

        </div>

    </div>

</div>