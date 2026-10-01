<div class="w-full">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">


        <!-- =====================================================
             DATA CALON SISWA
        ====================================================== -->

        <div class="col-span-12">

            <div class="bg-white rounded-xl
                        border border-slate-200
                        shadow-sm">

                <div class="p-5">

                    <div class="mb-5">

                        <input
                            type="hidden"
                            id="id_bayar_detail"
                            readonly
                        >


                        <!-- NO DAFTAR -->

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center
                                    gap-2 sm:gap-3
                                    mb-3">

                            <label
                                class="sm:w-32
                                       text-sm font-medium
                                       text-slate-700">

                                No Daftar

                            </label>

                            <input
                                type="text"
                                id="id_calon_siswa_detail"
                                class="w-full sm:flex-1
                                       h-9
                                       px-3
                                       rounded-lg
                                       border border-slate-300
                                       bg-slate-50
                                       text-sm text-slate-700
                                       outline-none"
                                readonly
                            >

                        </div>


                        <!-- NAMA SISWA -->

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center
                                    gap-2 sm:gap-3
                                    mb-3">

                            <label
                                class="sm:w-32
                                       text-sm font-medium
                                       text-slate-700">

                                Nama Siswa

                            </label>

                            <input
                                type="text"
                                id="nama_siswa_detail"
                                class="w-full sm:flex-1
                                       h-9
                                       px-3
                                       rounded-lg
                                       border border-slate-300
                                       bg-slate-50
                                       text-sm text-slate-700
                                       outline-none"
                                readonly
                            >

                        </div>


                        <!-- JURUSAN -->

                        <div class="flex flex-col sm:flex-row
                                    sm:items-center
                                    gap-2 sm:gap-3">

                            <label
                                class="sm:w-32
                                       text-sm font-medium
                                       text-slate-700">

                                Jurusan

                            </label>

                            <input
                                type="text"
                                id="jurusan_siswa_detail"
                                class="w-full sm:flex-1
                                       h-9
                                       px-3
                                       rounded-lg
                                       border border-slate-300
                                       bg-slate-50
                                       text-sm text-slate-700
                                       outline-none"
                                readonly
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- =====================================================
             HISTORY PEMBAYARAN
        ====================================================== -->

        <div class="col-span-12 lg:col-span-6">

            <div class="bg-white rounded-xl
                        border border-slate-200
                        shadow-sm
                        h-full
                        overflow-hidden">


                <!-- HEADER -->

                <div class="flex flex-col sm:flex-row
                            items-start sm:items-center
                            gap-3
                            px-5 py-4
                            border-b border-slate-200">

                    <h2 class="text-base
                               font-semibold
                               text-slate-800
                               mr-auto">

                        History Pembayaran

                    </h2>


                    <div class="flex flex-wrap gap-2">


                        <!-- EDIT -->

                        <button
                            type="button"
                            onclick="editHistoryBayar()"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   px-4 py-2
                                   rounded-lg
                                   bg-[#02BC9C]
                                   hover:bg-[#00aF8f]
                                   text-white
                                   text-sm
                                   font-medium
                                   transition-colors
                                   shadow-sm">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 20h9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 3.5a2.12 2.12 0 0 1 3 3
                                       L8 18l-4 1 1-4Z"
                                />

                            </svg>

                            Edit

                        </button>


                        <!-- HAPUS -->

                        <button
                            type="button"
                            onclick="hapusHistoryBayar()"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   px-4 py-2
                                   rounded-lg
                                   bg-red-600
                                   hover:bg-red-700
                                   text-white
                                   text-sm
                                   font-medium
                                   transition-colors
                                   shadow-sm">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 6h18"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 6V4h8v2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 6l-1 14H6L5 6"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M10 11v5M14 11v5"
                                />

                            </svg>

                            Hapus

                        </button>

                    </div>

                </div>


                <!-- TABLE -->

                <div class="p-5">

                    <div
                        id="tableHistoryBayarDetail"
                        class="w-full overflow-x-auto">
                    </div>

                </div>

            </div>

        </div>



        <!-- =====================================================
             DETAIL TRANSAKSI
        ====================================================== -->

        <div class="col-span-12 lg:col-span-6">

            <div class="bg-white rounded-xl
                        border border-slate-200
                        shadow-sm
                        h-full
                        overflow-hidden">


                <!-- HEADER -->

                <div class="flex flex-col sm:flex-row
                            items-start sm:items-center
                            gap-3
                            px-5 py-4
                            border-b border-slate-200">

                    <h2 class="text-base
                               font-semibold
                               text-slate-800
                               mr-auto">

                        Data Pembayaran Calon Siswa

                    </h2>


                    <div class="flex flex-wrap gap-2">


                        <!-- TAMBAH -->

                        <button
    type="button"
    onclick="openModalTambah()"
    class="inline-flex
           items-center
           justify-center
           gap-2
           px-4 py-2
           rounded-lg
           bg-amber-500
           hover:bg-amber-600
           text-white
           text-sm
           font-medium
           transition-colors
           shadow-sm">

    <svg
        class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M14 2H6a2 2 0 0 0-2 2v16
               a2 2 0 0 0 2 2h12
               a2 2 0 0 0 2-2V8Z"
        />

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M14 2v6h6"
        />

        <path
            stroke-linecap="round"
            d="M12 12v6M9 15h6"
        />

    </svg>

    Tambah

</button>


                        <!-- EDIT -->

                        <button
                            type="button"
                            onclick="editData()"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   px-4 py-2
                                   rounded-lg
                                   bg-[#02BC9C]
                                   hover:bg-[#00aF8f]
                                   text-white
                                   text-sm
                                   font-medium
                                   transition-colors
                                   shadow-sm">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 20h9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 3.5a2.12 2.12 0 0 1 3 3
                                       L8 18l-4 1 1-4Z"
                                />

                            </svg>

                            Edit

                        </button>


                        <!-- HAPUS -->

                        <button
                            type="button"
                            onclick="hapusData()"
                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   px-4 py-2
                                   rounded-lg
                                   bg-red-600
                                   hover:bg-red-700
                                   text-white
                                   text-sm
                                   font-medium
                                   transition-colors
                                   shadow-sm">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 6h18"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 6V4h8v2"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 6l-1 14H6L5 6"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M10 11v5M14 11v5"
                                />

                            </svg>

                            Hapus

                        </button>

                    </div>

                </div>


                <!-- TABLE -->

                <div class="p-5">

                    <div class="overflow-x-auto">

                        <div
                            id="tableDetailBayar"
                            class="w-full">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     MODAL
============================================================== -->

@include(
    'keuangan.bayar_calon_siswa.modal_detail.modal_tambah'
)

@include(
    'keuangan.bayar_calon_siswa.modal_detail.modal_update_history'
)