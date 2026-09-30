
<div
    id="modal-add-tahun-ajaran"
    class="fixed inset-0 z-50 hidden items-center justify-center
           overflow-y-auto p-4
           bg-slate-900/60 backdrop-blur-xs"
>
    <div
        class="relative w-full max-w-lg my-8
               bg-white rounded-3xl shadow-2xl
               border border-slate-100 overflow-hidden"
    >

        {{-- Header --}}
        <div class="flex items-center justify-between
                    px-6 py-5
                    border-b border-slate-100">

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-xl
                           bg-teal-50 text-teal-600
                           flex items-center justify-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v12m6-6H6"
                        />
                    </svg>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Tambah Tahun Ajaran
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Tambahkan tahun ajaran baru
                    </p>
                </div>

            </div>

            {{-- Close --}}
            <button
                type="button"
                onclick="closeModalTahunAjaran()"
                class="w-9 h-9 rounded-lg
                       flex items-center justify-center
                       text-slate-400
                       hover:bg-slate-100
                       hover:text-slate-600
                       transition"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>


        {{-- Body --}}
        <div class="px-6 py-6 space-y-5">

            {{-- Tahun Ajaran --}}
            <div>

                <label
                    for="add_thn_ajaran"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    Tahun Ajaran
                </label>

                <div class="relative">

                    <div
                        class="absolute inset-y-0 left-0
                               pl-3 flex items-center
                               pointer-events-none"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </div>

                    <input
                        type="text"
                        id="add_thn_ajaran"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white
                               pl-10 pr-4 py-3
                               text-sm text-slate-700
                               placeholder-slate-400
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/10"
                        placeholder="Contoh: 2026/2027"
                    >

                </div>

                <div
                    id="add_thn_ajaran_error"
                    class="validation-error hidden
                           text-red-500 text-xs mt-1.5"
                ></div>

            </div>


            {{-- Status --}}
            <div>

                <label
                    for="add_isaktiv"
                    class="block text-sm font-medium text-slate-700 mb-2"
                >
                    Status
                </label>

                <div class="relative">

                    <select
                        id="add_isaktiv"
                        class="w-full appearance-none
                               rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-3 pr-10
                               text-sm text-slate-700
                               outline-none
                               transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/10"
                    >
                        <option value="0">
                            Tidak Aktif
                        </option>

                        <option value="1">
                            Aktif
                        </option>
                    </select>

                    <div
                        class="pointer-events-none
                               absolute inset-y-0 right-0
                               flex items-center pr-3
                               text-slate-400"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 9l6 6 6-6"
                            />
                        </svg>
                    </div>

                </div>

                <div
                    id="add_isaktiv_error"
                    class="validation-error hidden
                           text-red-500 text-xs mt-1.5"
                ></div>

            </div>

        </div>


        {{-- Footer --}}
        <div
            class="flex items-center justify-end gap-3
                   px-6 py-4
                   bg-slate-50
                   border-t border-slate-100"
        >

            <button
                type="button"
                onclick="closeModalTahunAjaran()"
                class="inline-flex items-center justify-center
                       px-5 py-2.5
                       rounded-xl
                       border border-slate-200
                       bg-white
                       text-sm font-medium text-slate-600
                       hover:bg-slate-100
                       transition"
            >
                Batal
            </button>

            <button
                type="button"
                id="btn-save-add"
                onclick="saveData('add')"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-2.5
                       rounded-xl
                       bg-teal-500
                       text-white
                       text-sm font-semibold
                       shadow-sm
                       hover:bg-teal-600
                       focus:outline-none
                       focus:ring-2
                       focus:ring-teal-500/30
                       transition"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14M12 5l7 7-7 7"
                    />
                </svg>

                Simpan
            </button>

        </div>

    </div>
</div>

