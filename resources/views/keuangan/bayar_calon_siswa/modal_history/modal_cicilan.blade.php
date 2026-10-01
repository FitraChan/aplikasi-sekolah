<div
    id="modal-cicilan-form"
    class="hidden fixed inset-0 z-[9999] items-center justify-center bg-slate-900/50 p-4"
    tabindex="-1"
>
    <div class="w-full max-w-5xl bg-white rounded-xl shadow-xl overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">

            <h2 class="text-lg font-semibold text-slate-800">
                Input Pembayaran Cicilan
            </h2>

            <button
                type="button"
                onclick="closeModalCicilan()"
                class="inline-flex items-center justify-center
                       w-8 h-8 rounded-lg
                       text-slate-400
                       hover:text-slate-600
                       hover:bg-slate-100
                       transition-colors"
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
        <div class="px-6 py-5">

            <input
                type="hidden"
                id="id_calon_siswa_cicilan"
                name="id_csiswa"
            >

            <div class="grid grid-cols-12 gap-5">

                {{-- Tanggal Bayar --}}
                <div class="col-span-12 md:col-span-6">

                    <label
                        for="tgl_bayar"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Tanggal Bayar
                    </label>

                    <input
                        type="date"
                        id="tgl_bayar"
                        name="tgl_bayar"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    >

                </div>

                {{-- No Kwitansi --}}
                <div class="col-span-12 md:col-span-6">

                    <label
                        for="no_kwitansi"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        No Kwitansi
                    </label>

                    <input
                        type="text"
                        id="no_kwitansi"
                        name="no_kwitansi"
                        placeholder="Masukkan nomor kwitansi"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               placeholder:text-slate-400
                               outline-none transition
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    >

                </div>

                {{-- Keterangan --}}
                <div class="col-span-12">

                    <label
                        for="keterangan"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Keterangan
                    </label>

                    <textarea
                        id="keterangan"
                        name="keterangan"
                        rows="3"
                        placeholder="Masukkan keterangan"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               placeholder:text-slate-400
                               outline-none transition resize-none
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    ></textarea>

                </div>

                {{-- Pendaftaran --}}
                <div class="col-span-12 sm:col-span-6 md:col-span-3">

                    <label
                        for="jml_pendaftaran"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Pendaftaran
                    </label>

                    <input
                        type="number"
                        id="jml_pendaftaran"
                        name="jml_pendaftaran"
                        value="0"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    >

                </div>

                {{-- DPP --}}
                <div class="col-span-12 sm:col-span-6 md:col-span-3">

                    <label
                        for="jml_dpp"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        DPP
                    </label>

                    <input
                        type="number"
                        id="jml_dpp"
                        name="jml_dpp"
                        value="0"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    >

                </div>

                {{-- MOS --}}
                <div class="col-span-12 sm:col-span-6 md:col-span-3">

                    <label
                        for="jml_mos"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        MOS
                    </label>

                    <input
                        type="number"
                        id="jml_mos"
                        name="jml_mos"
                        value="0"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    >

                </div>

                {{-- Seragam --}}
                <div class="col-span-12 sm:col-span-6 md:col-span-3">

                    <label
                        for="jml_seragam"
                        class="block text-sm font-medium text-slate-700 mb-1.5"
                    >
                        Seragam
                    </label>

                    <input
                        type="number"
                        id="jml_seragam"
                        name="jml_seragam"
                        value="0"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-[#02BC9C]
                               focus:ring-2 focus:ring-[#02BC9C]/20"
                    >

                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div
            class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2
                   px-6 py-4
                   bg-slate-50
                   border-t border-slate-200"
        >

            <button
                type="button"
                onclick="closeModalCicilan()"
                class="inline-flex items-center justify-center
                       px-4 py-2.5
                       rounded-lg
                       border border-slate-300
                       bg-white
                       text-sm font-medium text-slate-700
                       hover:bg-slate-50
                       transition"
            >
                Batal
            </button>

            <button
                type="button"
                id="btn-save-cicilan"
                onclick="saveCicilan()"
                class="inline-flex items-center justify-center
                       px-4 py-2.5
                       rounded-lg
                       bg-[#02BC9C]
                       text-white
                       text-sm font-medium
                       hover:bg-[#00B686]
                       focus:outline-none
                       focus:ring-2
                       focus:ring-[#02BC9C]/30
                       transition"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 mr-1.5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <rect
                        width="16"
                        height="12"
                        x="4"
                        y="6"
                        rx="2"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8 10h.01M12 10h.01M16 10h.01M8 14h8"
                    />
                </svg>

                <span id="text-save-cicilan">
                    Simpan Pembayaran
                </span>

            </button>

        </div>

    </div>
</div>