
<div
    id="modal-edit-konfig"
    class="fixed inset-0 z-50 hidden items-center justify-center
           overflow-y-auto p-4
           bg-slate-900/60 backdrop-blur-xs"
>
    <div
        class="relative w-full max-w-2xl my-8
               bg-white rounded-3xl shadow-2xl
               border border-slate-100 overflow-hidden"
    >

        {{-- Header --}}
        <div
            class="flex items-center justify-between
                   px-6 py-5
                   border-b border-slate-100"
        >

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
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        Edit Konfigurasi
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Perbarui konfigurasi tahun dan semester
                    </p>
                </div>

            </div>

            {{-- Close --}}
            <button
                type="button"
                onclick="closeModalKonfig()"
                class="w-9 h-9 rounded-lg
                       flex items-center justify-center
                       text-slate-400
                       hover:bg-slate-100
                       hover:text-slate-600
                       transition"
                aria-label="Tutup"
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
        <div class="px-6 py-6">

            <input
                type="hidden"
                id="edit_id"
            >

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                {{-- ID Tahun --}}
                <div>

                    <label
                        for="edit_id_tahun"
                        class="block text-sm font-medium text-slate-700 mb-2"
                    >
                        ID Tahun
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
                            type="number"
                            id="edit_id_tahun"
                            class="w-full rounded-xl
                                   border border-slate-200
                                   bg-white
                                   pl-10 pr-4 py-3
                                   text-sm text-slate-700
                                   outline-none
                                   transition
                                   focus:border-teal-500
                                   focus:ring-2
                                   focus:ring-teal-500/10"
                            placeholder="Masukkan ID Tahun"
                        >

                    </div>

                </div>


                {{-- Semester --}}
                <div>

                    <label
                        for="edit_smt"
                        class="block text-sm font-medium text-slate-700 mb-2"
                    >
                        Semester
                    </label>

                    <div class="relative">

                        <select
                            id="edit_smt"
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
                            <option value="1">
                                Ganjil
                            </option>

                            <option value="2">
                                Genap
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

                </div>


                {{-- ID Tahun PPDB --}}
                <div>

                    <label
                        for="edit_id_thn_ppdb"
                        class="block text-sm font-medium text-slate-700 mb-2"
                    >
                        ID Tahun PPDB
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
                                    d="M12 14l9-5-9-5-9 5 9 5z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 14l6.16-3.422A12.083 12.083 0 0118 15.5c0 1.933-2.686 3.5-6 3.5s-6-1.567-6-3.5c0-.34.06-.67.16-.99L12 14z"
                                />
                            </svg>
                        </div>

                        <input
                            type="number"
                            id="edit_id_thn_ppdb"
                            class="w-full rounded-xl
                                   border border-slate-200
                                   bg-white
                                   pl-10 pr-4 py-3
                                   text-sm text-slate-700
                                   outline-none
                                   transition
                                   focus:border-teal-500
                                   focus:ring-2
                                   focus:ring-teal-500/10"
                            placeholder="Masukkan ID Tahun PPDB"
                        >

                    </div>

                </div>

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
                onclick="closeModalKonfig()"
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
                onclick="saveDataKonfig()"
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

                Update
            </button>

        </div>

    </div>
</div>
