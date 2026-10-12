<div id="modal-edit-gelombang"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">

    <div class="relative w-full max-w-2xl
                bg-white
                rounded-3xl
                shadow-2xl
                text-left
                border border-slate-100
                overflow-hidden">


        <!-- HEADER -->
        <div class="px-6 py-5 sm:px-7 border-b border-slate-100">

            <div class="flex items-center gap-3">

                <div class="w-12 h-12
                            rounded-2xl
                            bg-teal-50
                            text-teal-600
                            flex items-center justify-center
                            border border-teal-100">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M12 20h9">
                        </path>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16.5 3.5
                                 a2.121 2.121 0 0 1 3 3
                                 L7 19l-4 1
                                 1-4Z">
                        </path>

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-900">
                        Edit Gelombang
                    </h3>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Perbarui informasi dan periode pendaftaran.
                    </p>

                </div>

            </div>

        </div>


        <!-- BODY -->
        <div class="px-6 py-6 sm:px-7">

            <!-- ID -->
            <input type="hidden"
                   id="edit_id">


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                <!-- ID TAHUN -->
                <div>

                    <label for="edit_id_tahun"
                           class="block text-xs font-semibold text-slate-700 mb-2">

                        ID Tahun

                    </label>

                    <input
                        type="text"
                        id="edit_id_tahun"

                        class="w-full
                               px-4 py-2.5
                               rounded-xl
                               border border-slate-300
                               bg-white
                               text-sm text-slate-800
                               placeholder-slate-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20">

                </div>


                <!-- NAMA GELOMBANG -->
                <div>

                    <label for="edit_nama_gelombang"
                           class="block text-xs font-semibold text-slate-700 mb-2">

                        Nama Gelombang

                    </label>

                    <input
                        type="text"
                        id="edit_nama_gelombang"

                        class="w-full
                               px-4 py-2.5
                               rounded-xl
                               border border-slate-300
                               bg-white
                               text-sm text-slate-800
                               placeholder-slate-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20">

                </div>


                <!-- TANGGAL AWAL -->
                <div>

                    <label for="edit_awal"
                           class="block text-xs font-semibold text-slate-700 mb-2">

                        Tanggal Awal

                    </label>

                    <input
                        type="date"
                        id="edit_awal"

                        class="w-full
                               px-4 py-2.5
                               rounded-xl
                               border border-slate-300
                               bg-white
                               text-sm text-slate-800
                               shadow-sm
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20">

                </div>


                <!-- TANGGAL AKHIR -->
                <div>

                    <label for="edit_akhir"
                           class="block text-xs font-semibold text-slate-700 mb-2">

                        Tanggal Akhir

                    </label>

                    <input
                        type="date"
                        id="edit_akhir"

                        class="w-full
                               px-4 py-2.5
                               rounded-xl
                               border border-slate-300
                               bg-white
                               text-sm text-slate-800
                               shadow-sm
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20">

                </div>


                <!-- STATUS -->
                <div>

                    <label for="edit_is_current"
                           class="block text-xs font-semibold text-slate-700 mb-2">

                        Status

                    </label>

                    <div class="relative">

                        <select
                            id="edit_is_current"

                            class="w-full
                                   appearance-none
                                   px-4 py-2.5 pr-10
                                   rounded-xl
                                   border border-slate-300
                                   bg-white
                                   text-sm text-slate-700
                                   shadow-sm
                                   outline-none
                                   transition
                                   focus:border-teal-500
                                   focus:ring-2
                                   focus:ring-teal-500/20">

                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
                                Tidak Aktif
                            </option>

                        </select>


                        <div class="pointer-events-none
                                    absolute inset-y-0 right-0
                                    flex items-center px-3
                                    text-slate-400">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <polyline points="6 9 12 15 18 9">
                                </polyline>

                            </svg>

                        </div>

                    </div>

                </div>

                <div>

                    <label for="edit_nama_gelombang"
                           class="block text-xs font-semibold text-slate-700 mb-2">

                        Kuota

                    </label>

                    <input
                        type="text"
                        id="edit_kuota"

                        class="w-full
                               px-4 py-2.5
                               rounded-xl
                               border border-slate-300
                               bg-white
                               text-sm text-slate-800
                               placeholder-slate-400
                               shadow-sm
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20">

                </div>


            

            </div>


            <!-- INFORMATION -->
            <div class="mt-5
                        flex items-start gap-3
                        bg-teal-50
                        border border-teal-100
                        rounded-xl
                        p-3.5">

                <svg class="w-5 h-5 text-teal-600 shrink-0 mt-0.5"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <circle cx="12"
                            cy="12"
                            r="10">
                    </circle>

                    <line x1="12"
                          y1="16"
                          x2="12"
                          y2="12">
                    </line>

                    <line x1="12"
                          y1="8"
                          x2="12.01"
                          y2="8">
                    </line>

                </svg>

                <p class="text-xs
                          leading-relaxed
                          text-teal-800">

                    Periksa kembali data gelombang sebelum
                    menyimpan perubahan, terutama periode
                    tanggal dan status gelombang.

                </p>

            </div>

        </div>


        <!-- FOOTER -->
        <div class="px-6 py-4 sm:px-7
                    bg-slate-50
                    border-t border-slate-100">

            <div class="flex flex-col-reverse sm:flex-row
                        sm:justify-end
                        gap-3">


                <!-- BATAL -->
                <button
                    type="button"
                    onclick="closeModal()"

                    class="w-full sm:w-auto
                           inline-flex
                           items-center
                           justify-center
                           gap-2
                           px-5 py-2.5
                           rounded-xl
                           border border-slate-300
                           bg-white
                           text-slate-700
                           font-semibold
                           text-xs
                           hover:bg-slate-50
                           transition
                           cursor-pointer">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <line x1="18"
                              y1="6"
                              x2="6"
                              y2="18">
                        </line>

                        <line x1="6"
                              y1="6"
                              x2="18"
                              y2="18">
                        </line>

                    </svg>

                    Batal

                </button>


                <!-- UPDATE -->
                <button
                    type="button"
                    onclick="saveData()"

                    class="w-full sm:w-auto
                           inline-flex
                           items-center
                           justify-center
                           gap-2
                           px-5 py-2.5
                           rounded-xl
                           bg-[#00bfa5]
                           hover:bg-[#00a892]
                           text-white
                           font-bold
                           text-xs
                           shadow-sm
                           transition
                           active:scale-95
                           cursor-pointer">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z">
                        </path>

                        <polyline points="17 21 17 13 7 13 7 21">
                        </polyline>

                        <polyline points="7 3 7 8 15 8">
                        </polyline>

                    </svg>

                    Update Gelombang

                </button>

            </div>

        </div>

    </div>

</div>
