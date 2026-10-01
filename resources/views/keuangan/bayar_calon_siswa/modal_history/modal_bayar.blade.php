<div
    id="modal-bayar-form"
    class="hidden fixed inset-0 z-[9999]
           items-center justify-center
           bg-slate-900/50
           p-4"
    tabindex="-1"
>

    <div
        class="w-full max-w-2xl
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

                Pembayaran Calon Siswa

            </h2>


            <!-- TOMBOL CLOSE -->

            <button
                type="button"
                data-tw-dismiss="modal"
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


            <!-- TANGGAL BAYAR -->

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


            <!-- NO KWITANSI -->

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


            <!-- KETERANGAN -->

            <div>

                <label
                    for="keterangan"
                    class="block text-sm font-medium
                           text-slate-700 mb-1.5"
                >

                    Keterangan

                </label>

                <textarea
                    id="keterangan"
                    rows="3"
                    placeholder="Masukkan keterangan pembayaran"
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
    onclick="closeModalBayar()"
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
                id="btn-save-bayar"
                onclick="saveBayar()"
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

                Simpan Pembayaran

            </button>

        </div>

    </div>

</div>