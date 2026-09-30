<div
    id="modal-edit-target"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">

    <div
        class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl text-left border border-slate-100 overflow-hidden">

        <!-- HEADER -->
        <div class="px-6 py-5 sm:px-7 border-b border-slate-100">

            <div class="flex items-center gap-3">

                <!-- ICON -->
                <div
                    class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600
                           flex items-center justify-center border border-amber-100">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.464
                               4.5 19.5l1.036-3.75L16.862 3.487z" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.5 5.85l3.65 3.65" />

                    </svg>

                </div>

                <!-- TITLE -->
                <div>

                    <h3 class="text-lg font-bold text-slate-900">
                        Edit Target Pendaftaran
                    </h3>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Perbarui target penerimaan siswa berdasarkan tahun ajaran dan jurusan.
                    </p>

                </div>

            </div>

        </div>


        <!-- FORM -->
        <form
            id="form-edit-target"
            onsubmit="event.preventDefault(); saveData();">

            <input
                type="hidden"
                id="edit_id">


            <!-- BODY -->
            <div class="px-6 py-6 sm:px-7">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                    <!-- TAHUN AJARAN -->
                    <div>

                        <label
                            for="edit_id_thn_ajaran"
                            class="block text-xs font-semibold text-slate-700 mb-2">

                            Tahun Ajaran

                        </label>

                        <div class="relative">

                            <select
                                id="edit_id_thn_ajaran"
                                required
                                class="w-full appearance-none rounded-xl border border-slate-200
                                       bg-white px-4 py-3 pr-10 text-sm text-slate-700
                                       outline-none transition
                                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">

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
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0
                                       flex items-center pr-3 text-slate-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7" />

                                </svg>

                            </div>

                        </div>

                    </div>


                    <!-- JURUSAN -->
                    <div>

                        <label
                            for="edit_id_jurusan"
                            class="block text-xs font-semibold text-slate-700 mb-2">

                            Jurusan

                        </label>

                        <div class="relative">

                            <select
                                id="edit_id_jurusan"
                                required
                                class="w-full appearance-none rounded-xl border border-slate-200
                                       bg-white px-4 py-3 pr-10 text-sm text-slate-700
                                       outline-none transition
                                       focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">

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
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0
                                       flex items-center pr-3 text-slate-400">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19 9l-7 7-7-7" />

                                </svg>

                            </div>

                        </div>

                    </div>


                    <!-- TARGET -->
                    <div class="sm:col-span-2">

                        <label
                            for="edit_target"
                            class="block text-xs font-semibold text-slate-700 mb-2">

                            Target

                        </label>

                        <input
                            type="number"
                            id="edit_target"
                            min="0"
                            required
                            placeholder="Masukkan target"
                            class="w-full rounded-xl border border-slate-200
                                   bg-white px-4 py-3 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20">

                    </div>

                </div>


                <!-- INFORMATION -->
                <div
                    class="mt-5 rounded-2xl border border-teal-100
                           bg-teal-50 px-4 py-3">

                    <div class="flex gap-3">

                        <div class="mt-0.5 text-teal-600">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 21
                                       a9 9 0 100-18 9 9 0 000 18z" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs font-semibold text-teal-800">
                                Informasi
                            </p>

                            <p class="text-xs text-teal-700 mt-0.5 leading-relaxed">
                                Pastikan tahun ajaran, jurusan, dan jumlah target
                                sudah sesuai sebelum menyimpan perubahan.
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- FOOTER -->
            <div
                class="px-6 py-4 sm:px-7 bg-slate-50 border-t border-slate-100">

                <div
                    class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                    <!-- BATAL -->
                    <button
                        type="button"
                        onclick="closeModal()"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl
                               border border-slate-200 bg-white
                               text-sm font-semibold text-slate-600
                               hover:bg-slate-100 transition">

                        Batal

                    </button>


                    <!-- UPDATE -->
                    <button
                        type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl
                               bg-teal-600 text-white
                               text-sm font-semibold
                               hover:bg-teal-700
                               focus:outline-none focus:ring-2
                               focus:ring-teal-500/30 transition">

                        Update Target

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>