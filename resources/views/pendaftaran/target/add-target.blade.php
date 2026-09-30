
<div id="modal-add-target"
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

                <!-- ICON -->
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

                        <!-- Target Icon -->
                        <circle cx="12" cy="12" r="9"></circle>

                        <circle cx="12" cy="12" r="5"></circle>

                        <circle cx="12" cy="12" r="1"></circle>

                    </svg>

                </div>


                <!-- TITLE -->
                <div>

                    <h3 class="text-lg font-bold text-slate-900">
                        Tambah Target Pendaftaran
                    </h3>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Tentukan target penerimaan siswa berdasarkan tahun ajaran dan jurusan.
                    </p>

                </div>

            </div>

        </div>



        <!-- FORM -->
        <form
            id="form-add-target"
            onsubmit="event.preventDefault(); saveData();">


            <!-- BODY -->
            <div class="px-6 py-6 sm:px-7">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                    <!-- TAHUN AJARAN -->
                    <div>

                        <label
                            for="add_id_thn_ajaran"
                            class="block text-xs font-semibold text-slate-700 mb-2">

                            Tahun Ajaran

                        </label>


                        <div class="relative">

                            <select
                                id="add_id_thn_ajaran"
                                required

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

                                <option value="">
                                    Pilih Tahun Ajaran
                                </option>

                                @foreach($tahunAjaran as $item)

                                    <option value="{{ $item->id }}">
                                        {{ $item->thn_ajaran }}
                                    </option>

                                @endforeach

                            </select>


                            <!-- ARROW -->
                            <div class="pointer-events-none
                                        absolute inset-y-0 right-0
                                        flex items-center px-3
                                        text-slate-400">

                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     viewBox="0 0 24 24">

                                    <polyline points="6 9 12 15 18 9"></polyline>

                                </svg>

                            </div>

                        </div>

                    </div>



                    <!-- JURUSAN -->
                    <div>

                        <label
                            for="add_id_jurusan"
                            class="block text-xs font-semibold text-slate-700 mb-2">

                            Jurusan

                        </label>


                        <div class="relative">

                            <select
                                id="add_id_jurusan"
                                required

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

                                <option value="">
                                    Pilih Jurusan
                                </option>

                                @foreach($jurusan as $item)

                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_jurusan }}
                                    </option>

                                @endforeach

                            </select>


                            <!-- ARROW -->
                            <div class="pointer-events-none
                                        absolute inset-y-0 right-0
                                        flex items-center px-3
                                        text-slate-400">

                                <svg class="w-4 h-4"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     viewBox="0 0 24 24">

                                    <polyline points="6 9 12 15 18 9"></polyline>

                                </svg>

                            </div>

                        </div>

                    </div>



                    <!-- TARGET -->
                    <div class="sm:col-span-2">

                        <label
                            for="add_target"
                            class="block text-xs font-semibold text-slate-700 mb-2">

                            Target Pendaftaran

                        </label>


                        <div class="relative">

                            <input
                                type="number"
                                id="add_target"
                                min="0"
                                value="0"
                                placeholder="Masukkan jumlah target"
                                required

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


                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Masukkan jumlah siswa yang ditargetkan untuk jurusan tersebut.
                        </p>

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

                        Pastikan tahun ajaran, jurusan, dan jumlah target
                        sudah sesuai sebelum menyimpan data.

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
                        onclick="closeModal()"
                        type="button"

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



                    <!-- SIMPAN -->
                    <button
                        type="submit"

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


                        Simpan Target

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
