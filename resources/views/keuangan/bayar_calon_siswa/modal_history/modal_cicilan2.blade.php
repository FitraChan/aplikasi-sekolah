
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id="modal-cicilan-form"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs">
    <div class="modal-dialog modal-xl">
                <input type="hidden" id="id_calon_siswa_cicilan" name="id_csiswa">

        <div
            class="modal-content
                   rounded-2xl border-0
                   bg-white shadow-xl overflow-hidden"
        >

            {{-- Header --}}
            <div
                class="flex items-center justify-between
                       border-b border-slate-100
                       px-6 py-5"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-xl bg-emerald-50 text-emerald-600"
                    >
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            Input Pembayaran Cicilan
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-500">
                            Masukkan detail pembayaran cicilan siswa.
                        </p>
                    </div>

                </div>

            </div>


            {{-- Body --}}
            <div class="px-6 py-6">

                <input
                    type="hidden"
                    id="id_bukti"
                    name="id_bukti"
                >

                <div class="grid grid-cols-12 gap-5">

                    {{-- Tanggal Bayar --}}
                    <div class="col-span-12 md:col-span-6">

                        <label
                            for="tgl_bayar"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Tanggal Bayar
                        </label>

                        <input
                            type="date"
                            id="tgl_bayar"
                            name="tgl_bayar"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5
                                   text-sm text-slate-700
                                   outline-none
                                   transition
                                   focus:border-emerald-500
                                   focus:ring-2 focus:ring-emerald-100"
                        >

                    </div>


                    {{-- No Kwitansi --}}
                    <div class="col-span-12 md:col-span-6">

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
                            placeholder="Masukkan nomor kwitansi"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none
                                   transition
                                   focus:border-emerald-500
                                   focus:ring-2 focus:ring-emerald-100"
                        >

                    </div>


                    {{-- Keterangan --}}
                    <div class="col-span-12">

                        <label
                            for="keterangan"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Keterangan
                        </label>

                        <textarea
                            id="keterangan"
                            name="keterangan"
                            rows="3"
                            placeholder="Masukkan keterangan"
                            class="w-full resize-none rounded-xl
                                   border border-slate-300
                                   bg-white px-4 py-3
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none
                                   transition
                                   focus:border-emerald-500
                                   focus:ring-2 focus:ring-emerald-100"
                        ></textarea>

                    </div>


                    {{-- Rincian Pembayaran --}}
                    <div class="col-span-12">

                        <div
                            class="mb-4 flex items-center gap-2
                                   border-b border-slate-100 pb-3"
                        >
                            <i
                                data-lucide="receipt"
                                class="h-4 w-4 text-emerald-600"
                            ></i>

                            <span
                                class="text-sm font-semibold text-slate-700"
                            >
                                Rincian Pembayaran
                            </span>
                        </div>

                    </div>


                    {{-- Pendaftaran --}}
                    <div class="col-span-12 sm:col-span-6 md:col-span-3">

                        <label
                            for="jml_pendaftaran"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Pendaftaran
                        </label>

                        <div class="relative">

                            <span
                                class="absolute left-3 top-1/2
                                       -translate-y-1/2
                                       text-xs font-medium text-slate-400"
                            >
                                Rp
                            </span>

                            <input
                                type="number"
                                id="jml_pendaftaran"
                                name="jml_pendaftaran"
                                value="0"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white py-2.5 pl-10 pr-3
                                       text-sm text-slate-700
                                       outline-none
                                       transition
                                       focus:border-emerald-500
                                       focus:ring-2 focus:ring-emerald-100"
                            >

                        </div>

                    </div>


                    {{-- DPP --}}
                    <div class="col-span-12 sm:col-span-6 md:col-span-3">

                        <label
                            for="jml_dpp"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            DPP
                        </label>

                        <div class="relative">

                            <span
                                class="absolute left-3 top-1/2
                                       -translate-y-1/2
                                       text-xs font-medium text-slate-400"
                            >
                                Rp
                            </span>

                            <input
                                type="number"
                                id="jml_dpp"
                                name="jml_dpp"
                                value="0"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white py-2.5 pl-10 pr-3
                                       text-sm text-slate-700
                                       outline-none
                                       transition
                                       focus:border-emerald-500
                                       focus:ring-2 focus:ring-emerald-100"
                            >

                        </div>

                    </div>


                    {{-- MOS --}}
                    <div class="col-span-12 sm:col-span-6 md:col-span-3">

                        <label
                            for="jml_mos"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            MOS
                        </label>

                        <div class="relative">

                            <span
                                class="absolute left-3 top-1/2
                                       -translate-y-1/2
                                       text-xs font-medium text-slate-400"
                            >
                                Rp
                            </span>

                            <input
                                type="number"
                                id="jml_mos"
                                name="jml_mos"
                                value="0"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white py-2.5 pl-10 pr-3
                                       text-sm text-slate-700
                                       outline-none
                                       transition
                                       focus:border-emerald-500
                                       focus:ring-2 focus:ring-emerald-100"
                            >

                        </div>

                    </div>


                    {{-- Seragam --}}
                    <div class="col-span-12 sm:col-span-6 md:col-span-3">

                        <label
                            for="jml_seragam"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Seragam
                        </label>

                        <div class="relative">

                            <span
                                class="absolute left-3 top-1/2
                                       -translate-y-1/2
                                       text-xs font-medium text-slate-400"
                            >
                                Rp
                            </span>

                            <input
                                type="number"
                                id="jml_seragam"
                                name="jml_seragam"
                                value="0"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white py-2.5 pl-10 pr-3
                                       text-sm text-slate-700
                                       outline-none
                                       transition
                                       focus:border-emerald-500
                                       focus:ring-2 focus:ring-emerald-100"
                            >

                        </div>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div
                class="flex flex-col-reverse gap-3
                       border-t border-slate-100
                       bg-slate-50/70
                       px-6 py-4
                       sm:flex-row sm:items-center sm:justify-end"
            >

                <button
                    type="button"
                    onclick="closeCicilan()"
                    class="inline-flex items-center justify-center
                        rounded-xl border border-slate-300
                        bg-white px-5 py-2.5
                        text-sm font-medium text-slate-700
                        shadow-sm
                        transition
                        hover:bg-slate-50"
                >
                    Batal
                </button>


                <button
                    type="button"
                    id="btn-save-cicilan"
                    onclick="saveCicilan()"
                    class="inline-flex items-center justify-center
                           rounded-xl bg-emerald-600
                           px-5 py-2.5
                           text-sm font-semibold text-white
                           shadow-sm
                           transition
                           hover:bg-emerald-700
                           focus:outline-none
                           focus:ring-2 focus:ring-emerald-500
                           focus:ring-offset-2"
                >
                    <i
                        data-lucide="credit-card"
                        class="mr-2 h-4 w-4"
                    ></i>

                    <span id="text-save-cicilan">
                        Simpan Pembayaran
                    </span>
                </button>

            </div>

        </div>

    </div>

</div>

<script>

     async function saveCicilan() {

        try {
            const button = document.getElementById('btn-save-cicilan');
            const buttonText = document.getElementById('text-save-cicilan');

            // Simpan tampilan awal tombol
            const originalText = buttonText.innerHTML;

            // Ubah tombol menjadi loading
            button.disabled = true;
            buttonText.innerHTML = 'Tunggu sebentar...';
            const response = await fetch('{{ route("bayar-calon-siswa.simpanCicilan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id_bukti: document.getElementById('id_bukti')?.value ?? 0,
                    id_csiswa: document.getElementById('id_calon_siswa_cicilan').value,
                    tgl_bayar: document.getElementById('tgl_bayar').value,
                    no_kwitansi: document.getElementById('no_kwitansi').value,
                    keterangan: document.getElementById('keterangan').value,
                    jml_pendaftaran: document.getElementById('jml_pendaftaran').value || 0,
                    jml_dpp: document.getElementById('jml_dpp').value || 0,
                    jml_mos: document.getElementById('jml_mos').value || 0,
                    jml_seragam: document.getElementById('jml_seragam').value || 0,
                    //cicilan: document.getElementById('cicilan').value || 0
                })
            });

            const result = await response.json();

            //console.log('hasilllll', result);

            if (result.success) {

                Swal.fire({
                    icon: "success",
                    title: result.title,
                    text: result.msg
                });

                 const modal = document.getElementById('modal-cicilan-form');

                modal.classList.remove('flex');
                modal.classList.add('hidden');

                window.location.reload();

                // reload tabel jika ada
                // if (typeof table !== 'undefined') {
               
                // }

            } else {

                Swal.fire({
                    icon: "error",
                    title: result.title,
                    text: result.msg
                });
            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Terjadi kesalahan saat menyimpan data"
            });

        }
    }
</script>