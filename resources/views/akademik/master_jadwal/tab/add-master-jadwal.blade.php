{{-- =========================================================
    MODAL TAMBAH MASTER JADWAL
========================================================= --}}
<div
    id="modal-add-jadwal"
    class="fixed inset-0 z-[999] hidden overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-sm"
    aria-hidden="true">

    <div class="flex min-h-full items-center justify-center">

        <div
            class="relative w-full max-w-4xl overflow-hidden rounded-2xl
                   border border-slate-200 bg-white shadow-2xl">

            {{-- =================================================
                HEADER
            ================================================== --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-xl bg-[#02BC9C]/10 text-[#02BC9C]">

                        <i
                            data-lucide="calendar-plus"
                            class="h-5 w-5">
                        </i>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-800">
                            Tambah Master Jadwal
                        </h2>

                        <p class="text-sm text-slate-500">
                            Tambahkan jadwal mata pelajaran baru.
                        </p>

                    </div>

                </div>


                {{-- Close --}}
                <button
                    type="button"
                    data-tw-dismiss="modal"
                    class="flex h-9 w-9 items-center justify-center
                           rounded-lg text-slate-400
                           transition hover:bg-slate-100 hover:text-slate-600">

                    <i
                        data-lucide="x"
                        class="h-5 w-5">
                    </i>

                </button>

            </div>


            {{-- =================================================
                BODY
            ================================================== --}}
            <div class="p-6">

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Angkatan --}}
                    <div>

                        <label
                            for="add_id_tahun"
                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Angkatan

                        </label>

                        <select
                            id="add_id_tahun"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="">
                                Pilih Tahun Angkatan
                            </option>

                            @foreach($tahun as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->thn_ajaran }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Semester --}}
                    <div>

                        <label
                            for="add_semester"
                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Semester

                        </label>

                        <select
                            id="add_semester"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="1">
                                Semester 1
                            </option>

                            <option value="2">
                                Semester 2
                            </option>

                        </select>

                    </div>


                    {{-- Kelas --}}
                    <div>

                        <label
                            for="add_id_kelas"
                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Kelas

                        </label>

                        <select
                            id="add_id_kelas"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="">
                                Pilih Kelas
                            </option>

                            @foreach($kelas as $item)

                                <option value="{{ $item->idx }}">
                                    {{ $item->nama_kelas }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Mata Pelajaran --}}
                    <div>

                        <label
                            for="add_id_mapel"
                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Mata Pelajaran

                        </label>

                        <select
                            id="add_id_mapel"
                            class="tom-select w-full">

                            <option value="">
                                Pilih Mata Pelajaran
                            </option>

                            @foreach($mapel as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->nama_mapel }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Guru --}}
                    <div class="sm:col-span-2">

                        <label
                            for="add_id_gtk"
                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Guru Pengajar

                        </label>

                        <select
                            id="add_id_gtk"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="">
                                Pilih Guru
                            </option>

                            @foreach($guru as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->nama_gtk }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Jumlah Jam --}}
                    <div>

                        <label
                            for="add_jml_jam"
                            class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Jumlah Jam

                        </label>

                        <div class="relative">

                            <i
                                data-lucide="clock-3"
                                class="pointer-events-none absolute left-3 top-1/2
                                       h-4 w-4 -translate-y-1/2 text-slate-400">
                            </i>

                            <input
                                type="number"
                                id="add_jml_jam"
                                value="0"
                                min="0"
                                class="w-full rounded-xl border border-slate-300
                                       bg-white py-2.5 pl-10 pr-3 text-sm
                                       text-slate-700 outline-none transition
                                       focus:border-[#02BC9C]
                                       focus:ring-2 focus:ring-[#02BC9C]/20">

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                FOOTER
            ================================================== --}}
            <div
                class="flex flex-col-reverse gap-2 border-t border-slate-200
                       bg-slate-50/70 px-6 py-4 sm:flex-row sm:justify-end">

                {{-- Batal --}}
                <button
                    type="button"
                    data-tw-dismiss="modal"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl border border-slate-300 bg-white
                           px-5 py-2.5 text-sm font-semibold text-slate-600
                           transition hover:bg-slate-100 hover:text-slate-800">

                    <i
                        data-lucide="x"
                        class="h-4 w-4">
                    </i>

                    Batal

                </button>


                {{-- Simpan --}}
                <button
                    type="button"
                    onclick="saveData()"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[#02BC9C] px-5 py-2.5
                           text-sm font-semibold text-white shadow-sm
                           transition hover:bg-[#00A98C]
                           focus:outline-none
                           focus:ring-2 focus:ring-[#02BC9C]/30">

                    <i
                        data-lucide="save"
                        class="h-4 w-4">
                    </i>

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

});
</script>