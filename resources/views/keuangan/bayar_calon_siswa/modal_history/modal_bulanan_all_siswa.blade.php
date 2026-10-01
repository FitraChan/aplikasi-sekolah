<div
    id="modal-bulanan-all-siswa"
    class="hidden fixed inset-0 z-[9999] items-center justify-center bg-slate-900/50 p-4"
    tabindex="-1"
>
    <div class="w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800">
                Generate Tagihan Bulanan
            </h2>

            <button
                type="button"
                onclick="closeModalBulananAllSiswa()"
                class="inline-flex items-center justify-center w-8 h-8 rounded-lg
                       text-slate-400 hover:text-slate-600 hover:bg-slate-100
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
        <div class="px-6 py-5 space-y-5">

            {{-- Tahun Ajaran --}}
            <div>
                <label
                    for="id_thn_ajaran"
                    class="block text-sm font-medium text-slate-700 mb-1.5"
                >
                    Tahun Ajaran
                </label>

                <select
                    id="id_thn_ajaran"
                    class="w-full rounded-lg border border-slate-300
                           bg-white px-3 py-2.5 text-sm text-slate-700
                           outline-none transition
                           focus:border-[#02BC9C]
                           focus:ring-2 focus:ring-[#02BC9C]/20"
                >
                    <option value="">
                        Pilih Tahun Ajaran
                    </option>

                    @foreach($tahun as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->thn_ajaran }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jurusan --}}
            <div>
                <label
                    for="id_jurusan"
                    class="block text-sm font-medium text-slate-700 mb-1.5"
                >
                    Jurusan
                </label>

                <select
                    id="id_jurusan"
                    class="w-full rounded-lg border border-slate-300
                           bg-white px-3 py-2.5 text-sm text-slate-700
                           outline-none transition
                           focus:border-[#02BC9C]
                           focus:ring-2 focus:ring-[#02BC9C]/20"
                >
                    <option value="">
                        Pilih Jurusan
                    </option>

                    @foreach($jurusan as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tahun Pembayaran --}}
            <div>
                <label
                    for="id_tahun"
                    class="block text-sm font-medium text-slate-700 mb-1.5"
                >
                    Tahun Pembayaran
                </label>

                <input
                    type="number"
                    id="id_tahun"
                    placeholder="Masukkan Tahun"
                    class="w-full rounded-lg border border-slate-300
                           bg-white px-3 py-2.5 text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none transition
                           focus:border-[#02BC9C]
                           focus:ring-2 focus:ring-[#02BC9C]/20"
                >
            </div>

            {{-- Bulan --}}
            <div>
                <label
                    for="id_bulan"
                    class="block text-sm font-medium text-slate-700 mb-1.5"
                >
                    Bulan
                </label>

                <select
                    id="id_bulan"
                    class="w-full rounded-lg border border-slate-300
                           bg-white px-3 py-2.5 text-sm text-slate-700
                           outline-none transition
                           focus:border-[#02BC9C]
                           focus:ring-2 focus:ring-[#02BC9C]/20"
                >
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>

        </div>

        {{-- Footer --}}
        <div
            class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2
                   px-6 py-4 bg-slate-50 border-t border-slate-200"
        >

            <button
                type="button"
                onclick="closeModalBulananAllSiswa()"
                class="inline-flex items-center justify-center
                       px-4 py-2.5 rounded-lg
                       border border-slate-300
                       bg-white text-sm font-medium text-slate-700
                       hover:bg-slate-50 transition"
            >
                Batal
            </button>

            <button
                type="button"
                onclick="saveDefBulan()"
                class="inline-flex items-center justify-center
                       px-4 py-2.5 rounded-lg
                       bg-[#02BC9C] text-white
                       text-sm font-medium
                       hover:bg-[#00B686]
                       focus:outline-none
                       focus:ring-2 focus:ring-[#02BC9C]/30
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
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                Simpan
            </button>

        </div>

    </div>
</div>