{{-- MODAL TAMBAH MASTER JADWAL --}}
<div id="modal-add-jadwal"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-3xl
                max-h-[90vh] overflow-y-auto
                rounded-2xl bg-white shadow-2xl">

        {{-- MODAL HEADER --}}
        <div class="flex items-center justify-between
                    px-6 py-4
                    border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-teal-50 border border-teal-100
                            flex items-center justify-center
                            text-teal-600">

                    <i data-lucide="calendar-plus" class="w-5 h-5"></i>

                </div>

                <div>

                    <h3 class="text-lg font-semibold text-slate-900">
                        Tambah Master Jadwal
                    </h3>

                    <p class="text-xs text-slate-500">
                        Lengkapi informasi jadwal pelajaran.
                    </p>

                </div>

            </div>

            <button type="button"
                    onclick="closeModalJadwal()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-slate-400
                           hover:text-slate-600
                           hover:bg-slate-100
                           transition-colors">

                <i data-lucide="x" class="w-5 h-5"></i>

            </button>

        </div>


        {{-- MODAL BODY --}}
        <div class="p-6 space-y-5">

            {{-- TAHUN AJARAN & SEMESTER --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <label for="add_id_tahun"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Tahun Ajaran
                        <span class="text-rose-500">*</span>
                    </label>

                    <select id="add_id_tahun"
                            class="w-full rounded-xl
                                   border border-slate-300
                                   bg-white
                                   px-4 py-3
                                   text-sm text-slate-800
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20
                                   outline-none transition">

                        <option value="">Pilih Tahun Ajaran</option>

                        @foreach($tahun as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->thn_ajaran }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div>

                    <label for="add_semester"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Semester
                        <span class="text-rose-500">*</span>
                    </label>

                    <select id="add_semester"
                            class="w-full rounded-xl
                                   border border-slate-300
                                   bg-white
                                   px-4 py-3
                                   text-sm text-slate-800
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20
                                   outline-none transition">

                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>

                    </select>

                </div>

            </div>


            {{-- KELAS & MATA PELAJARAN --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <label for="add_id_kelas"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Kelas
                        <span class="text-rose-500">*</span>
                    </label>

                    <select id="add_id_kelas"
                            class="w-full rounded-xl
                                   border border-slate-300
                                   bg-white
                                   px-4 py-3
                                   text-sm text-slate-800
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20
                                   outline-none transition">

                        <option value="">Pilih Kelas</option>

                        @foreach($kelas as $item)
                            <option value="{{ $item->idx }}">
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div>

                    <label for="add_id_mapel"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Mata Pelajaran
                        <span class="text-rose-500">*</span>
                    </label>

                    <select id="add_id_mapel"
                            class="tom-select w-full">

                        <option value="">Pilih Mata Pelajaran</option>

                        @foreach($mapel as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_mapel }}
                            </option>
                        @endforeach

                    </select>

                </div>

            </div>


            {{-- GURU PENGAJAR --}}
            <div>

                <label for="add_id_gtk"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Guru Pengajar
                    <span class="text-rose-500">*</span>
                </label>

                <select id="add_id_gtk"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm text-slate-800
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20
                               outline-none transition">

                    <option value="">Pilih Guru</option>

                    @foreach($guru as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_gtk }}
                        </option>
                    @endforeach

                </select>

            </div>


            {{-- JUMLAH JAM --}}
            <div>

                <label for="add_jml_jam"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Jumlah Jam
                    <span class="text-rose-500">*</span>
                </label>

                <div class="relative">

                    <input type="number"
                           id="add_jml_jam"
                           min="0"
                           value="0"
                           class="w-full rounded-xl
                                  border border-slate-300
                                  px-4 py-3 pr-16
                                  text-sm text-slate-800
                                  focus:border-[#02BC9C]
                                  focus:ring-2 focus:ring-[#02BC9C]/20
                                  outline-none transition">

                    <span class="absolute right-4 top-1/2 -translate-y-1/2
                                 text-xs font-medium text-slate-400">
                        Jam
                    </span>

                </div>

            </div>

        </div>


        {{-- MODAL FOOTER --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4
                    border-t border-slate-200
                    bg-slate-50 rounded-b-2xl">

            <button type="button"
                    onclick="closeModalJadwal()"
                    class="inline-flex items-center justify-center
                           px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-100
                           transition-colors">

                Batal

            </button>


            <button type="button"
                    onclick="saveData()"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-[#00bfa5] hover:bg-[#00a892]
                           text-white text-sm font-semibold
                           shadow-sm transition-all">

                <i data-lucide="save" class="w-4 h-4"></i>

                Simpan Jadwal

            </button>

        </div>

    </div>

</div>


<script>
    function closeModalJadwal() {
        const modal = document.getElementById('modal-add-jadwal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');
    }

    function openModalJadwal() {
        const modal = document.getElementById('modal-add-jadwal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

        modal.setAttribute('aria-hidden', 'false');

        if (window.lucide) {
            lucide.createIcons();
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        if (window.lucide) {
            lucide.createIcons();
        }
    });
</script>