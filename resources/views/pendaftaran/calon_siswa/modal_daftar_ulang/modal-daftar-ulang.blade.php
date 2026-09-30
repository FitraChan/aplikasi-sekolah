
<div
    id="modal-daftar-ulang"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4 backdrop-blur-sm"
    aria-hidden="true"
>
    <div
        class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl"
    >

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">
                    Form Daftar Ulang
                </h2>

                <p class="mt-0.5 text-sm text-slate-500">
                    Lengkapi data daftar ulang siswa
                </p>
            </div>

            <button
                type="button"
                onclick="closeModalDaftarUlang()"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                aria-label="Tutup"
            >
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>


        {{-- Form --}}
        <form id="form-daftar-ulang">

            @csrf

            <div class="grid grid-cols-12 gap-5 px-6 py-6">

                {{-- No Kwitansi --}}
                <div class="col-span-12 sm:col-span-6">
                    <label
                        for="no_kwitansi"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        No Kwitansi
                    </label>

                    <input
                        type="text"
                        id="no_kwitansi"
                        name="no_kwitansi"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
                        placeholder="Masukkan no kwitansi"
                    >
                </div>


                {{-- NIPD --}}
                <div class="col-span-12 sm:col-span-6">
                    <label
                        for="nipd"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Set NIPD
                    </label>

                    <input
                        type="text"
                        id="nipd"
                        name="nipd"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
                        placeholder="Masukkan NIPD"
                    >

                    <input
                        type="hidden"
                        id="id_cawa"
                        name="id_cawa"
                    >
                </div>


                {{-- No Daftar --}}
                <div class="col-span-12 sm:col-span-6">
                    <label
                        for="no_daftar"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        No Daftar
                    </label>

                    <input
                        type="text"
                        id="no_daftar"
                        name="no_daftar"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
                        placeholder="Masukkan no daftar"
                    >
                </div>


                {{-- Nama --}}
                <div class="col-span-12 sm:col-span-6">
                    <label
                        for="nama"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Nama
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
                        placeholder="Nama calon siswa"
                    >
                </div>


                {{-- Jurusan --}}
                <div class="col-span-12">
                    <label
                        for="id_jurusan"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Jurusan
                    </label>

                    <select
                        id="id_jurusan"
                        name="id_jurusan"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20"
                    >
                        <option value="">
                            Pilih Jurusan
                        </option>

                        @foreach($jurusan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>


            {{-- Footer --}}
            <div class="flex items-center justify-end gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4">

                <button
                    type="button"
                    onclick="closeModalDaftarUlang()"
                    class="rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-100"
                >
                    Batal
                </button>

                <button
                    type="button"
                    id="btn-simpan-daftar-ulang"
                    onclick="simpanDaftarUlang()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
                >
                    <i data-lucide="save" class="h-4 w-4"></i>
                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>


<script>
    function closeModalDaftarUlang() {
        const modal = document.getElementById('modal-daftar-ulang');

        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>
