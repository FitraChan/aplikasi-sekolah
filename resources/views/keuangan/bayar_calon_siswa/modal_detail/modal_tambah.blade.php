<div
    id="modal-tambah-form"
    class="hidden fixed inset-0 z-[9999] items-center justify-center bg-slate-900/50 p-4"
    tabindex="-1"
>
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden">

        <form id="form-item">

            <input
                type="hidden"
                id="id_bayar"
                name="id_bayar"
            >

            <input
                type="hidden"
                id="id_detail"
                name="id_detail"
            >

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">

                <h2 class="text-lg font-semibold text-slate-800">
                    Item Pembayaran
                </h2>

                <button
                    type="button"
                    onclick="closeModalTambah()"
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

                <div class="grid grid-cols-12 gap-5">

                    {{-- Item Pembayaran --}}
                    <div class="col-span-12">

                        <label
                            for="id_item"
                            class="block text-sm font-medium text-slate-700 mb-1.5"
                        >
                            Item Pembayaran
                        </label>

                        <select
                            id="id_item"
                            name="id_item"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20"
                        >
                            <option value="">
                                Pilih Item Pembayaran
                            </option>

                            @foreach ($itemBayar as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_item }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- Kewajiban Bayar --}}
                    <div class="col-span-12 md:col-span-4">

                        <label
                            for="kwajiban_bayar"
                            class="block text-sm font-medium text-slate-700 mb-1.5"
                        >
                            Kewajiban Bayar
                        </label>

                        <input
                            type="number"
                            id="kwajiban_bayar"
                            name="kwajiban_bayar"
                            placeholder="Jumlah"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20"
                        >

                    </div>

                    {{-- Jumlah Bayar --}}
                    <div class="col-span-12 md:col-span-4">

                        <label
                            for="jml_bayar"
                            class="block text-sm font-medium text-slate-700 mb-1.5"
                        >
                            Jumlah Bayar
                        </label>

                        <input
                            type="number"
                            id="jml_bayar"
                            name="jml_bayar"
                            placeholder="Jumlah"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20"
                        >

                    </div>

                    {{-- Potongan --}}
                    <div class="col-span-12 md:col-span-4">

                        <label
                            for="potongan"
                            class="block text-sm font-medium text-slate-700 mb-1.5"
                        >
                            Potongan
                        </label>

                        <input
                            type="number"
                            id="potongan"
                            name="potongan"
                            placeholder="Potongan"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   outline-none transition
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20"
                        >

                    </div>

                    {{-- Cicilan --}}
                    <div class="col-span-12 md:col-span-3">

                        <label
                            for="id_cicilan"
                            class="block text-sm font-medium text-slate-700 mb-1.5"
                        >
                            Cicilan Ke
                        </label>

                        <input
                            type="number"
                            id="id_cicilan"
                            name="id_cicilan"
                            placeholder="Cicilan"
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
                    <div class="col-span-12 md:col-span-9">

                        <label
                            for="keterangan"
                            class="block text-sm font-medium text-slate-700 mb-1.5"
                        >
                            Keterangan
                        </label>

                        <input
                            type="text"
                            id="keterangan"
                            name="keterangan"
                            placeholder="Masukkan keterangan"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
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
                    onclick="closeModalTambah()"
                    class="inline-flex items-center justify-center
                           px-4 py-2.5
                           rounded-lg
                           border border-slate-300
                           bg-white
                           text-sm font-medium
                           text-slate-700
                           hover:bg-slate-100
                           transition-colors"
                >
                    Batal
                </button>

                <button
                    type="button"
                    onclick="saveItemBayar()"
                    class="inline-flex items-center justify-center
                           gap-2
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
                        class="w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V7l-4-4z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 3v5H7V3M7 21v-6h10v6"
                        />
                    </svg>

                    Simpan
                </button>

            </div>

        </form>

    </div>
</div>