<div class="w-full">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- =====================================================
             DATA PEMBAYARAN CALON SISWA
        ====================================================== -->

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            <!-- HEADER -->

            <div class="flex flex-col sm:flex-row
                        items-start sm:items-center
                        gap-3
                        p-5
                        border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800 mr-auto">
                    Data Pembayaran Calon Siswa
                </h2>


                <div class="flex flex-wrap gap-2">

                    <!-- SET BULANAN -->

                   <button
    type="button"
    onclick="openModalBulananAllSiswa()"
    class="inline-flex items-center justify-center
           gap-2
           px-4 py-2
           rounded-lg
           bg-[#02BC9C]
           hover:bg-[#00AF8F]
           text-white
           text-sm font-medium
           transition-colors
           shadow-sm"
>
    <svg
        class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 5v14M5 12h14"
        />
    </svg>

    Set Bulanan All Siswa
</button>


                    <!-- CETAK KEWAJIBAN -->

                    <button
                        type="button"
                        onclick="cetakKewajiban()"
                        class="inline-flex items-center justify-center
                               gap-2
                               px-4 py-2
                               rounded-lg
                               bg-emerald-600
                               hover:bg-emerald-700
                               text-white
                               text-sm font-medium
                               transition-colors
                               shadow-sm">

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 9V2h12v7"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18H4a2 2 0 0 1-2-2v-5
                                   a2 2 0 0 1 2-2h16
                                   a2 2 0 0 1 2 2v5
                                   a2 2 0 0 1-2 2h-2"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 14h12v8H6z"
                            />

                        </svg>

                        Cetak Kewajiban

                    </button>

                </div>

            </div>


            <!-- CONTENT -->

            <div class="p-5">

                <div class="overflow-x-auto">


                    <!-- =========================================
                         FILTER
                    ========================================== -->

                    <div class="grid grid-cols-1
                                sm:grid-cols-2
                                lg:grid-cols-12
                                gap-3
                                mb-5">


                        <!-- TAHUN -->

                        <div class="lg:col-span-3">

                            <label
                                for="filter_tahun"
                                class="block text-xs font-medium
                                       text-slate-600 mb-1">

                                Tahun Ajaran

                            </label>

                            <select
                                id="filter_tahun"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2
                                       text-sm text-slate-700
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none">

                                <option value="">
                                    Semua Tahun Ajaran
                                </option>

                                @foreach($tahun as $row)

                                    <option value="{{ $row->thn_ajaran }}">
                                        {{ $row->thn_ajaran }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- JURUSAN -->

                        <div class="lg:col-span-3">

                            <label
                                for="filter_jurusan"
                                class="block text-xs font-medium
                                       text-slate-600 mb-1">

                                Jurusan

                            </label>

                            <select
                                id="filter_jurusan"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2
                                       text-sm text-slate-700
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none">

                                <option value="">
                                    Semua Jurusan
                                </option>

                                @foreach($jurusan as $row)

                                    <option value="{{ $row->id }}">
                                        {{ $row->nama_jurusan }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- KELAS -->

                        <div class="lg:col-span-3">

                            <label
                                for="filter_kelas"
                                class="block text-xs font-medium
                                       text-slate-600 mb-1">

                                Kelas

                            </label>

                            <select
                                id="filter_kelas"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2
                                       text-sm text-slate-700
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none">

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $row)

                                    <option value="{{ $row->idx }}">
                                        {{ $row->nama_kelas }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- KEYWORD -->

                        <div class="lg:col-span-2">

                            <label
                                for="filter_keyword"
                                class="block text-xs font-medium
                                       text-slate-600 mb-1">

                                Pencarian

                            </label>

                            <input
                                type="text"
                                id="filter_keyword"
                                placeholder="Nama / NIPD"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2
                                       text-sm text-slate-700
                                       placeholder:text-slate-400
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none">

                        </div>


                        <!-- CARI -->

                        <div class="lg:col-span-1 flex items-end">

                            <button
                                type="button"
                                onclick="applyFilter()"
                                class="w-full inline-flex
                                       items-center justify-center
                                       gap-2
                                       px-4 py-2
                                       rounded-lg
                                       bg-slate-700
                                       hover:bg-slate-800
                                       text-white
                                       text-sm font-medium
                                       transition-colors">

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24">

                                    <circle
                                        cx="11"
                                        cy="11"
                                        r="7"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        d="m20 20-4-4"
                                    />

                                </svg>

                                Cari

                            </button>

                        </div>

                    </div>


                    <!-- TABLE -->

                    <div
                        id="tableBayar"
                        class="w-full">
                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             HISTORY PEMBAYARAN
        ====================================================== -->

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            <!-- HEADER -->

            <div class="flex flex-col sm:flex-row
                        items-start sm:items-center
                        gap-3
                        p-5
                        border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800 mr-auto">
                    History Pembayaran Calon Siswa
                </h2>


                <div class="flex flex-wrap gap-2">

                    <!-- CICILAN -->

                    <button
                        type="button"
                        onclick="openModalCicilan()"
                        class="inline-flex items-center justify-center
                               gap-2
                               px-4 py-2
                               rounded-lg
                               bg-amber-500
                               hover:bg-amber-600
                               text-white
                               text-sm font-medium
                               transition-colors
                               shadow-sm">

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <rect
                                x="2"
                                y="5"
                                width="20"
                                height="14"
                                rx="2"
                            />

                            <path
                                stroke-linecap="round"
                                d="M2 10h20"
                            />

                        </svg>

                        Cicilan

                    </button>


                    <!-- BAYAR -->

                    <button
                        type="button"
                        onclick="openModalBayar()"
                        class="inline-flex items-center justify-center
                               gap-2
                               px-4 py-2
                               rounded-lg
                               bg-emerald-600
                               hover:bg-emerald-700
                               text-white
                               text-sm font-medium
                               transition-colors
                               shadow-sm">

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <rect
                                x="2"
                                y="5"
                                width="20"
                                height="14"
                                rx="2"
                            />

                            <path
                                stroke-linecap="round"
                                d="M2 10h20"
                            />

                            <path
                                stroke-linecap="round"
                                d="M7 15h.01"
                            />

                            <path
                                stroke-linecap="round"
                                d="M11 15h6"
                            />

                        </svg>

                        Bayar

                    </button>

                </div>

            </div>


            <!-- CONTENT -->

            <div class="p-5">

                <div class="overflow-x-auto">


                    <!-- HIDDEN ID -->

                    <input
                        type="hidden"
                        id="id_bayar"
                        value=""
                    >

                    <input
                        type="hidden"
                        id="id_calon_siswa"
                        value=""
                    >


                    <!-- TABLE -->

                    <div
                        id="tableHistoryBayar"
                        class="w-full">
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================
     MODAL
============================================================== -->

@include(
    'keuangan.bayar_calon_siswa.modal_history.modal_bulanan_all_siswa'
)

@include(
    'keuangan.bayar_calon_siswa.modal_history.modal_bayar'
)

@include(
    'keuangan.bayar_calon_siswa.modal_history.modal_cicilan'
)