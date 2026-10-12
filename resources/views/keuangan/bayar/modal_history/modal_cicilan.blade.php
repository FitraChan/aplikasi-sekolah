<div
    id="modal-cicilan-form"
    class="hidden fixed inset-0 z-[9999]
           items-center justify-center
           bg-slate-900/50
           p-4
           overflow-y-auto"
    tabindex="-1"
    aria-hidden="true"
>

    <div
        class="w-full max-w-4xl
               max-h-[90vh]
               bg-white
               rounded-xl
               shadow-xl
               overflow-hidden
               flex flex-col"
    >

        <!-- =====================================================
             HEADER
        ====================================================== -->

        <div
            class="flex items-center justify-between
                   px-6 py-4
                   border-b border-slate-200
                   shrink-0"
        >

            <h2 class="text-lg font-semibold text-slate-800">
                Input Pembayaran Cicilan
            </h2>

            <!-- TOMBOL CLOSE -->

            <button
                type="button"
                onclick="closeModalCicilan()"
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
             BODY INI YANG SCROLL
        ====================================================== -->

        <div
            class="px-6 py-5
                   overflow-y-auto
                   flex-1"
        >

            <input
                type="hidden"
                id="id_csiswa"
                name="id_csiswa"
            >


            <div
                class="grid
                       grid-cols-1
                       md:grid-cols-2
                       gap-5"
            >


                <!-- =================================================
                     TANGGAL BAYAR
                ================================================== -->

                <div>

                    <label
                        for="tgl_bayar"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        Tanggal Bayar
                    </label>

                    <input
                        type="date"
                        id="tgl_bayar"
                        name="tgl_bayar"
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

                </div>


                <!-- =================================================
                     NO KWITANSI
                ================================================== -->

                <div>

                    <label
                        for="no_kwitansi"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        No Kwitansi
                    </label>

                    <input
                        type="text"
                        id="no_kwitansi"
                        name="no_kwitansi"
                        placeholder="Masukkan nomor kwitansi"
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


                <!-- =================================================
                     KETERANGAN
                ================================================== -->

                <div class="md:col-span-2">

                    <label
                        for="keterangan"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        rows="3"
                        placeholder="Masukkan keterangan"
                        class="w-full
                               rounded-lg
                               border border-slate-300
                               bg-white
                               px-3 py-2.5
                               text-sm text-slate-700
                               placeholder:text-slate-400
                               outline-none
                               resize-none
                               transition
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20"
                    ></textarea>

                </div>


                <!-- =================================================
                     BUKTI BAYAR
                ================================================== -->

                <div class="md:col-span-2">

                    <label
                        for="bukti_bayar_cicilan"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        Bukti Bayar
                    </label>

                    <div
                        class="relative
                               rounded-lg
                               border-2 border-dashed
                               border-slate-300
                               bg-slate-50
                               hover:border-[#02BC9C]
                               hover:bg-[#02BC9C]/5
                               transition-colors"
                    >

                        <input
                            type="file"
                            id="bukti_bayar_cicilan"
                            name="bukti_bayar"
                            accept="image/jpeg,image/png,image/jpg,application/pdf"
                            class="absolute inset-0
                                   w-full h-full
                                   opacity-0
                                   cursor-pointer"
                            onchange="previewBuktiBayarCicilan(this)"
                        >

                        <div
                            class="flex flex-col
                                   items-center
                                   justify-center
                                   px-6 py-6
                                   text-center"
                        >

                            <!-- ICON UPLOAD -->

                            <div
                                class="flex items-center justify-center
                                       w-12 h-12
                                       rounded-full
                                       bg-[#02BC9C]/10
                                       text-[#02BC9C]
                                       mb-3"
                            >

                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 16V4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 8l4-4 4 4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3"
                                    />

                                </svg>

                            </div>


                            <!-- TEXT -->

                            <p class="text-sm font-medium text-slate-700">
                                Klik untuk upload bukti bayar
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                JPG, JPEG, PNG atau PDF
                            </p>


                            <!-- NAMA FILE -->

                            <p
                                id="nama-file-bukti-cicilan"
                                class="hidden mt-2
                                       text-sm font-medium
                                       text-[#02BC9C]"
                            ></p>

                        </div>

                    </div>

                    <p class="mt-1.5 text-xs text-slate-500">
                        Maksimal ukuran file 2 MB.
                    </p>

                </div>


                <!-- =================================================
                     DPP
                ================================================== -->

                <div>

                    <label
                        for="jml_dpp"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        DPP
                    </label>

                    <input
                        type="number"
                        id="jml_dpp"
                        name="jml_dpp"
                        value="0"
                        min="0"
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

                </div>


                <!-- =================================================
                     SERAGAM
                ================================================== -->

                <div>

                    <label
                        for="jml_seragam"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        Seragam
                    </label>

                    <input
                        type="number"
                        id="jml_seragam"
                        name="jml_seragam"
                        value="0"
                        min="0"
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

                </div>


                <!-- =================================================
                     SPP
                ================================================== -->

                <div>

                    <label
                        for="jml_spp"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        SPP
                    </label>

                    <input
                        type="number"
                        id="jml_spp"
                        name="jml_spp"
                        value="0"
                        min="0"
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

                </div>


                <!-- =================================================
                     TABUNGAN
                ================================================== -->

                <div>

                    <label
                        for="jml_tabungan"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        Tabungan
                    </label>

                    <input
                        type="number"
                        id="jml_tabungan"
                        name="jml_tabungan"
                        value="0"
                        min="0"
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

                </div>


                <!-- =================================================
                     OSIS
                ================================================== -->

                <div>

                    <label
                        for="jml_osis"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        OSIS
                    </label>

                    <input
                        type="number"
                        id="jml_osis"
                        name="jml_osis"
                        value="0"
                        min="0"
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

                </div>


                <!-- =================================================
                     LAINNYA
                ================================================== -->

                <div>

                    <label
                        for="jml_lain"
                        class="block text-sm font-medium
                               text-slate-700 mb-1.5"
                    >
                        Lainnya
                    </label>

                    <input
                        type="number"
                        id="jml_lain"
                        name="jml_lain"
                        value="0"
                        min="0"
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

                </div>

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
                   border-t border-slate-200
                   shrink-0"
        >

            <!-- BATAL -->

            <button
                type="button"
                onclick="closeModalCicilan()"
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
                id="btn-save-cicilan"
                onclick="saveCicilan()"
                class="inline-flex items-center justify-center
                       gap-2
                       px-4 py-2.5
                       rounded-lg
                       bg-emerald-600
                       hover:bg-emerald-700
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

                    <rect
                        x="2"
                        y="5"
                        width="20"
                        height="14"
                        rx="2"
                    />

                    <path
                        stroke-linecap="round"
                        d="M2 10h20"
                    />

                    <path
                        stroke-linecap="round"
                        d="M7 15h.01"
                    />

                    <path
                        stroke-linecap="round"
                        d="M11 15h6"
                    />

                </svg>

                <span id="text-save-cicilan">
                    Simpan Pembayaran
                </span>

            </button>

        </div>

    </div>

</div>


<script>

    /* =========================================================
       PREVIEW NAMA FILE BUKTI BAYAR
    ========================================================== */

    function previewBuktiBayarCicilan(input) {

        const namaFile = document.getElementById(
            'nama-file-bukti-cicilan'
        );

        if (!namaFile) {
            return;
        }

        if (
            input.files &&
            input.files.length > 0
        ) {

            const file = input.files[0];

            namaFile.textContent =
                'File: ' + file.name;

            namaFile.classList.remove('hidden');

        } else {

            namaFile.textContent = '';

            namaFile.classList.add('hidden');

        }

    }


    /* =========================================================
       OPEN MODAL
    ========================================================== */

    function openModalCicilan() {

        const modal = document.getElementById(
            'modal-cicilan-form'
        );

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );

    }


    /* =========================================================
       CLOSE MODAL
    ========================================================== */

    function closeModalCicilan() {

        const modal = document.getElementById(
            'modal-cicilan-form'
        );

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        modal.classList.remove('flex');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );

    }

</script>