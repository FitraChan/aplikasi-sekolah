{{-- MODAL TAMBAH PERTEMUAN --}}
<div id="modalPertemuan"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-2xl
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
                        Tambah Pertemuan
                    </h3>

                    <p class="text-xs text-slate-500">
                        Masukkan informasi kegiatan pembelajaran.
                    </p>

                </div>

            </div>

            <button type="button"
                    onclick="closeModalPertemuan()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-slate-400
                           hover:text-slate-600
                           hover:bg-slate-100
                           transition-colors">

                <i data-lucide="x" class="w-5 h-5"></i>

            </button>

        </div>


        {{-- FORM --}}
        <form id="form1" method="post">

            {{-- MODAL BODY --}}
            <div class="p-6 space-y-5">

                {{-- PERTEMUAN KE & TANGGAL --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- PERTEMUAN KE --}}
                    <div>

                        <label for="idpertemuan"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Pertemuan Ke
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="number"
                               id="idpertemuan"
                               name="idpertemuan"
                               min="1"
                               placeholder="Contoh: 1"
                               class="w-full rounded-xl
                                      border border-slate-300
                                      px-4 py-3
                                      text-sm text-slate-800
                                      placeholder:text-slate-400
                                      focus:border-[#02BC9C]
                                      focus:ring-2 focus:ring-[#02BC9C]/20
                                      outline-none transition">

                    </div>


                    {{-- TANGGAL --}}
                    <div>

                        <label for="tgl_pbm"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Tanggal
                            <span class="text-rose-500">*</span>
                        </label>

                        <input type="date"
                               id="tgl_pbm"
                               name="tgl_pbm"
                               class="w-full rounded-xl
                                      border border-slate-300
                                      px-4 py-3
                                      text-sm text-slate-800
                                      focus:border-[#02BC9C]
                                      focus:ring-2 focus:ring-[#02BC9C]/20
                                      outline-none transition">

                    </div>

                </div>


                {{-- MATERI PEMBELAJARAN --}}
                <div>

                    <label for="materi"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Materi Pembelajaran
                        <span class="text-rose-500">*</span>
                    </label>

                    <textarea id="materi"
                              name="materi"
                              rows="4"
                              placeholder="Tuliskan materi yang disampaikan pada pertemuan ini..."
                              class="w-full rounded-xl
                                     border border-slate-300
                                     px-4 py-3
                                     text-sm text-slate-800
                                     placeholder:text-slate-400
                                     focus:border-[#02BC9C]
                                     focus:ring-2 focus:ring-[#02BC9C]/20
                                     outline-none transition resize-y"></textarea>

                </div>


                {{-- GURU PENGGANTI --}}
                <div>

                    <label for="guru_pengganti"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Guru Pengganti
                    </label>

                    <select id="guru_pengganti"
                            name="guru_pengganti"
                            class="tom-select w-full">

                        <option value="">
                            Pilih Guru
                        </option>

                        @foreach($guru as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_gtk }}
                            </option>
                        @endforeach

                    </select>

                    <p class="mt-2 text-xs text-slate-400">
                        Kosongkan jika pembelajaran dilakukan oleh guru pengampu.
                    </p>

                </div>


                {{-- KETERANGAN --}}
                <div>

                    <label for="keterangan"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Keterangan
                    </label>

                    <textarea id="keterangan"
                              name="keterangan"
                              rows="3"
                              placeholder="Tambahkan keterangan jika diperlukan..."
                              class="w-full rounded-xl
                                     border border-slate-300
                                     px-4 py-3
                                     text-sm text-slate-800
                                     placeholder:text-slate-400
                                     focus:border-[#02BC9C]
                                     focus:ring-2 focus:ring-[#02BC9C]/20
                                     outline-none transition resize-y"></textarea>

                </div>

            </div>


            {{-- MODAL FOOTER --}}
            <div class="flex items-center justify-end gap-3
                        px-6 py-4
                        border-t border-slate-200
                        bg-slate-50 rounded-b-2xl">

                <button type="button"
                        onclick="closeModalPertemuan()"
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
                        onclick="simpanData()"
                        class="inline-flex items-center justify-center gap-2
                               px-4 py-2.5 rounded-lg
                               bg-[#00bfa5] hover:bg-[#00a892]
                               text-white text-sm font-semibold
                               shadow-sm transition-all">

                    <i data-lucide="save" class="w-4 h-4"></i>

                    Simpan Pertemuan

                </button>

            </div>

        </form>

    </div>

</div>


<script>
    function closeModalPertemuan() {
        const modal = document.getElementById('modalPertemuan');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

        modal.setAttribute('aria-hidden', 'true');
    }

    function openModalPertemuan() {
        const modal = document.getElementById('modalPertemuan');

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