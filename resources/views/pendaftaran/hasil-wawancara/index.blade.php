@extends('layout.app')

@section('title', 'Hasil Test Wawancara')

@section('page_title')
    Hasil Test Wawancara
@endsection

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-7 pb-16 min-w-0">

    {{-- ============================================================
        PAGE HEADER
    ============================================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div>

            <h2 class="text-2xl lg:text-[28px] font-bold text-slate-900 tracking-tight leading-snug">
                Hasil Test Wawancara
            </h2>

            <p class="text-slate-500 text-sm mt-0.5">
                Monitoring nilai dan status kelulusan hasil wawancara calon siswa.
            </p>

        </div>

        <div class="flex items-center gap-3">

            {{-- EXPORT --}}
            <button
                type="button"
                id="btn-export"
                class="inline-flex items-center gap-2 px-4 py-2.5
                       bg-white border border-slate-200
                       hover:border-slate-300 rounded-xl
                       text-sm font-semibold text-slate-700
                       shadow-sm hover:bg-slate-50 transition"
            >

                <svg
                    class="w-4 h-4 text-slate-600"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>

                <span>
                    Export CSV
                </span>

            </button>


            {{-- REFRESH --}}
            <button
                type="button"
                id="btn-refresh"
                class="inline-flex items-center gap-2
                       px-5 py-2.5
                       bg-[#02BC9C]
                       hover:bg-[#02a387]
                       rounded-xl
                       text-sm font-semibold
                       text-white
                       shadow-sm shadow-[#02BC9C]/30
                       transition"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <polyline points="23 4 23 10 17 10"></polyline>
                    <polyline points="1 20 1 14 7 14"></polyline>
                    <path d="M3.51 9a9 9 0 0 1 14.13-3.36L23 10"></path>
                    <path d="M20.49 15a9 9 0 0 1-14.13 3.36L1 14"></path>
                </svg>

                <span>
                    Refresh
                </span>

            </button>

        </div>

    </div>


    {{-- ============================================================
        STATISTICS
    ============================================================ --}}
    <section
        aria-label="Statistik hasil wawancara"
        class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5"
    >

        {{-- RATA-RATA --}}
        <article
            class="bg-white rounded-2xl p-5
                   border border-slate-200/90
                   shadow-sm relative overflow-hidden
                   flex flex-col justify-between"
        >

            <div>

                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    Rata-rata Nilai
                </p>

                <div class="flex items-baseline gap-2">

                    <span
                        id="stat-rata-rata"
                        class="text-3xl font-bold text-slate-900 tracking-tight"
                    >
                        0.00
                    </span>

                    <span class="text-sm font-semibold text-slate-500">
                        / 100
                    </span>

                </div>

            </div>

            <div class="mt-5">

                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">

                    <div
                        id="progress-rata-rata"
                        class="bg-[#02BC9C] h-1.5 rounded-full transition-all duration-500"
                        style="width: 0%;"
                    ></div>

                </div>

            </div>

            <div class="absolute right-3 bottom-2 text-slate-100 pointer-events-none">

                <svg
                    class="w-20 h-20"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M4 19h16v2H4zm1-4h3v4H5zm5-6h3v10h-3zm5-4h3v14h-3z"
                        opacity="0.6"
                    ></path>
                </svg>

            </div>

        </article>


        {{-- LULUS --}}
        <article
            class="bg-white rounded-2xl p-5
                   border border-slate-200/90
                   shadow-sm relative overflow-hidden
                   flex flex-col justify-between"
        >

            <div>

                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    Lulus
                </p>

                <div class="flex items-baseline gap-1.5">

                    <span
                        id="stat-lulus"
                        class="text-3xl font-bold text-[#02BC9C] tracking-tight"
                    >
                        0
                    </span>

                    <span class="text-sm font-semibold text-slate-500">
                        Siswa
                    </span>

                </div>

            </div>

            <div class="mt-4">

                <p
                    id="persen-lulus"
                    class="text-xs text-slate-400 font-medium"
                >
                    0% dari total hasil wawancara
                </p>

            </div>

            <div class="absolute right-3 bottom-1 text-slate-100 pointer-events-none">

                <svg
                    class="w-20 h-20"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"
                        opacity="0.55"
                    ></path>
                </svg>

            </div>

        </article>


        {{-- CADANGAN --}}
        <article
            class="bg-white rounded-2xl p-5
                   border border-slate-200/90
                   shadow-sm relative overflow-hidden
                   flex flex-col justify-between"
        >

            <div>

                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    Cadangan
                </p>

                <div class="flex items-baseline gap-1.5">

                    <span
                        id="stat-cadangan"
                        class="text-3xl font-bold text-amber-500 tracking-tight"
                    >
                        0
                    </span>

                    <span class="text-sm font-semibold text-slate-500">
                        Siswa
                    </span>

                </div>

            </div>

            <div class="mt-4">

                <p class="text-xs text-slate-400 font-medium">
                    Kandidat cadangan
                </p>

            </div>

            <div class="absolute right-3 bottom-1 text-slate-100 pointer-events-none">

                <svg
                    class="w-20 h-20"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM11 7h2v6h-2zm0 8h2v2h-2z"
                        opacity="0.55"
                    ></path>
                </svg>

            </div>

        </article>


        {{-- TIDAK LULUS --}}
        <article
            class="bg-white rounded-2xl p-5
                   border border-slate-200/90
                   shadow-sm relative overflow-hidden
                   flex flex-col justify-between"
        >

            <div>

                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                    Tidak Lulus
                </p>

                <div class="flex items-baseline gap-1.5">

                    <span
                        id="stat-tidak-lulus"
                        class="text-3xl font-bold text-red-500 tracking-tight"
                    >
                        0
                    </span>

                    <span class="text-sm font-semibold text-slate-500">
                        Siswa
                    </span>

                </div>

            </div>

            <div class="mt-4">

                <p class="text-xs text-slate-400 font-medium">
                    Perlu evaluasi lebih lanjut
                </p>

            </div>

            <div class="absolute right-2 bottom-1 text-slate-100 pointer-events-none">

                <svg
                    class="w-20 h-20"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.59 5L12 11.59 7.41 7 6 8.41 10.59 13 6 17.59 7.41 19 12 14.41 16.59 19 18 17.59 13.41 13 18 8.41z"
                        opacity="0.55"
                    ></path>
                </svg>

            </div>

        </article>

    </section>


    {{-- ============================================================
        TABLE SECTION
    ============================================================ --}}
    <section
        aria-label="Daftar hasil wawancara"
        class="bg-white rounded-2xl
               border border-slate-200/90
               shadow-sm overflow-hidden"
    >

        {{-- TABLE HEADER --}}
        <div
            class="p-6 pb-4
                   flex flex-col lg:flex-row
                   lg:items-center
                   justify-between gap-4
                   border-b border-slate-100"
        >

            <div>

                <h3 class="text-lg font-bold text-slate-900 tracking-tight">
                    Daftar Hasil Wawancara
                </h3>

                <p class="text-xs text-slate-400 mt-1">
                    Data penilaian wawancara calon siswa
                </p>

            </div>


            {{-- FILTER --}}
            <div class="flex flex-col sm:flex-row gap-3">

                {{-- SEARCH --}}
                <div class="relative">

                    <svg
                        class="absolute left-3 top-1/2 -translate-y-1/2
                               w-4 h-4 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line
                            x1="21"
                            y1="21"
                            x2="16.65"
                            y2="16.65"
                        ></line>
                    </svg>

                    <input
                        type="text"
                        id="filter-search"
                        placeholder="Cari calon siswa..."
                        class="w-full sm:w-64
                               pl-9 pr-3 py-2.5
                               bg-slate-50
                               border border-slate-200
                               rounded-xl
                               text-xs
                               text-slate-700
                               placeholder:text-slate-400
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               focus:border-[#02BC9C]"
                    >

                </div>


                {{-- STATUS --}}
                <select
                    id="filter-status"
                    class="px-3.5 py-2.5
                           bg-slate-50
                           border border-slate-200
                           rounded-xl
                           text-xs font-semibold
                           text-slate-600
                           focus:outline-none
                           focus:ring-2
                           focus:ring-[#02BC9C]/20
                           focus:border-[#02BC9C]"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option value="Lulus">
                        Lulus
                    </option>

                    <option value="Tidak Lulus">
                        Tidak Lulus
                    </option>

                    <option value="Cadangan">
                        Cadangan
                    </option>

                </select>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <div
                id="table-hasil-wawancara"
                class="w-full"
            ></div>

        </div>


        {{-- FOOTER --}}
        <div
            class="px-6 py-4
                   flex flex-col sm:flex-row
                   items-center justify-between
                   gap-3
                   border-t border-slate-100"
        >

            <p
                id="table-info"
                class="text-xs text-slate-500 font-medium"
            >
                Memuat data...
            </p>

        </div>

    </section>


    {{-- ============================================================
        ANALYTICS
    ============================================================ --}}
    <section
        aria-label="Distribusi nilai"
        class="bg-white rounded-2xl
               border border-slate-200/90
               shadow-sm p-6"
    >

        <div class="flex items-center justify-between mb-8">

            <div>

                <h3 class="text-lg font-bold text-slate-900 tracking-tight">
                    Sebaran Nilai Wawancara
                </h3>

                <p class="text-xs text-slate-400 mt-1">
                    Distribusi berdasarkan nilai akhir wawancara
                </p>

            </div>

            <span
                class="text-xs font-bold text-[#02BC9C]"
            >
                {{ date('Y') }}
            </span>

        </div>


        <div class="w-full">

            <div
                class="h-44 flex items-end justify-between
                       gap-3 sm:gap-4 px-2"
            >

                <div class="flex-1 flex flex-col items-center h-full justify-end">

                    <div
                        id="bar-rendah"
                        class="w-full bg-[#E0E7F6]
                               rounded-t-lg transition-all duration-500"
                        style="height: 20%;"
                    ></div>

                </div>


                <div class="flex-1 flex flex-col items-center h-full justify-end">

                    <div
                        id="bar-sedang"
                        class="w-full bg-[#C9D7F0]
                               rounded-t-lg transition-all duration-500"
                        style="height: 20%;"
                    ></div>

                </div>


                <div class="flex-1 flex flex-col items-center h-full justify-end">

                    <div
                        id="bar-tinggi"
                        class="w-full bg-[#02BC9C]
                               rounded-t-lg transition-all duration-500
                               shadow-sm"
                        style="height: 20%;"
                    ></div>

                </div>


                <div class="flex-1 flex flex-col items-center h-full justify-end">

                    <div
                        id="bar-tertinggi"
                        class="w-full bg-[#A5BCDF]
                               rounded-t-lg transition-all duration-500"
                        style="height: 20%;"
                    ></div>

                </div>

            </div>


            <div class="w-full h-px bg-slate-200"></div>


            <div
                class="flex justify-between
                       items-center
                       text-[10px]
                       font-bold
                       text-slate-400
                       uppercase
                       tracking-wider
                       mt-3 px-2"
            >

                <span class="flex-1 text-center sm:text-left">
                    &lt; 60
                </span>

                <span class="flex-1 text-center">
                    60 - 69
                </span>

                <span class="flex-1 text-center">
                    70 - 79
                </span>

                <span class="flex-1 text-center sm:text-right">
                    ≥ 80
                </span>

            </div>

        </div>

    </section>

</main>

@endsection


@push('styles')

<style>

    /*
    |--------------------------------------------------------------------------
    | TABULATOR CUSTOM STYLE
    |--------------------------------------------------------------------------
    */

    #table-hasil-wawancara .tabulator {
        border: none !important;
        background: white;
        font-size: 13px;
    }

    #table-hasil-wawancara .tabulator-header {
        background: rgba(248, 250, 252, .65);
        border-bottom: 1px solid #f1f5f9;
    }

    #table-hasil-wawancara .tabulator-col {
        background: transparent !important;
        border-right: none !important;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    #table-hasil-wawancara .tabulator-col-content {
        padding: 14px 18px;
    }

    #table-hasil-wawancara .tabulator-row {
        min-height: 68px;
        border-bottom: 1px solid #f1f5f9;
        background: white;
    }

    #table-hasil-wawancara .tabulator-row:hover {
        background: rgba(248, 250, 252, .7);
    }

    #table-hasil-wawancara .tabulator-cell {
        border-right: none !important;
        padding: 14px 18px;
    }

    #table-hasil-wawancara .tabulator-footer {
        border-top: 1px solid #f1f5f9;
        background: white;
    }

</style>

@endpush


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    window.tableHasilWawancara = new Tabulator(
        "#table-hasil-wawancara",
        {

            ajaxURL: "{{ route('hasilWawancara.data') }}",

            layout: "fitDataStretch",

            height: "560px",

            pagination: true,

            paginationMode: "local",

            paginationSize: 10,

            paginationSizeSelector: [
                10,
                25,
                50,
                100
            ],

            placeholder: "Belum ada hasil wawancara",

            ajaxConfig: "GET",

            columns: [

                /*
                |--------------------------------------------------------------------------
                | CALON SISWA
                |--------------------------------------------------------------------------
                */

                {
                    title: "CALON SISWA",
                    field: "calon_siswa.nama_lengkap",
                    minWidth: 260,

                    formatter: function (cell) {

                        const data =
                            cell.getRow().getData();

                        const nama =
                            data.calon_siswa?.nama_lengkap
                            ?? '-';

                        const sekolah =
                            data.calon_siswa?.asal_sekolah
                            ?? '';

                        const noDaftar =
                            data.calon_siswa?.no_daftar
                            ?? '-';

                        const initial =
                            nama
                                .trim()
                                .split(/\s+/)
                                .slice(0, 2)
                                .map(
                                    n => n.charAt(0)
                                )
                                .join('')
                                .toUpperCase();

                        return `

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-9 h-9 rounded-full
                                           bg-emerald-50
                                           text-[#02BC9C]
                                           flex items-center
                                           justify-center
                                           font-bold text-xs
                                           shrink-0"
                                >
                                    ${initial || '?'}
                                </div>

                                <div>

                                    <p
                                        class="font-bold
                                               text-slate-800
                                               text-sm
                                               leading-tight"
                                    >
                                        ${nama}
                                    </p>

                                    <p
                                        class="text-xs
                                               text-slate-400
                                               font-medium
                                               mt-0.5"
                                    >
                                        ${noDaftar}
                                    </p>

                                </div>

                            </div>

                        `;

                    }
                },


                /*
                |--------------------------------------------------------------------------
                | JURUSAN
                |--------------------------------------------------------------------------
                */

                {
                    title: "JURUSAN",
                    field: "calon_siswa.jurusan.nama_jurusan",
                    minWidth: 170,

                    formatter: function (cell) {

                        const data =
                            cell.getRow().getData();

                        return `
                            <span
                                class="text-xs
                                       font-semibold
                                       text-slate-600"
                            >
                                ${
                                    data.calon_siswa
                                        ?.jurusan
                                        ?.nama_jurusan
                                    ?? '-'
                                }
                            </span>
                        `;

                    }
                },


                /*
                |--------------------------------------------------------------------------
                | NILAI
                |--------------------------------------------------------------------------
                */

                {
                    title: "NILAI AKHIR",
                    field: "nilai_akhir",
                    width: 130,
                    hozAlign: "left",

                    formatter: function (cell) {

                        const nilai =
                            parseFloat(
                                cell.getValue() ?? 0
                            );

                        return `

                            <div class="flex flex-col">

                                <span
                                    class="text-sm
                                           font-bold
                                           text-slate-800"
                                >
                                    ${nilai.toFixed(2)}
                                </span>

                                <span
                                    class="text-[10px]
                                           text-slate-400"
                                >
                                    dari 100
                                </span>

                            </div>

                        `;

                    }
                },


                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */

                {
                    title: "STATUS KELULUSAN",
                    field: "status_lulus",
                    minWidth: 160,

                    formatter: function (cell) {

                        const status =
                            cell.getValue();

                        let bg =
                            'bg-slate-50';

                        let text =
                            'text-slate-600';

                        let dot =
                            'bg-slate-400';

                        if (status === 'Lulus') {

                            bg = 'bg-emerald-50';
                            text = 'text-emerald-700';
                            dot = 'bg-emerald-500';

                        }

                        else if (
                            status === 'Tidak Lulus'
                        ) {

                            bg = 'bg-rose-50';
                            text = 'text-rose-700';
                            dot = 'bg-rose-500';

                        }

                        else if (
                            status === 'Cadangan'
                        ) {

                            bg = 'bg-amber-50';
                            text = 'text-amber-700';
                            dot = 'bg-amber-500';

                        }

                        return `

                            <span
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       px-2.5 py-1
                                       rounded-full
                                       text-xs
                                       font-medium
                                       ${bg}
                                       ${text}"
                            >

                                <span
                                    class="w-1.5 h-1.5
                                           rounded-full
                                           ${dot}"
                                ></span>

                                ${status ?? '-'}

                            </span>

                        `;

                    }
                },


                /*
                |--------------------------------------------------------------------------
                | REKOMENDASI
                |--------------------------------------------------------------------------
                */

                {
                    title: "REKOMENDASI",
                    field: "jurusan.nama_jurusan",
                    minWidth: 180,

                    formatter: function (cell) {

                        const data =
                            cell.getRow().getData();

                        return `

                            <span
                                class="text-xs
                                       font-semibold
                                       text-slate-600"
                            >
                                ${
                                    data.jurusan
                                        ?.nama_jurusan
                                    ?? '-'
                                }
                            </span>

                        `;

                    }
                },


                /*
                |--------------------------------------------------------------------------
                | TANGGAL
                |--------------------------------------------------------------------------
                */

                {
                    title: "TANGGAL",
                    field: "tanggal_wawancara",
                    width: 120,

                    formatter: function (cell) {

                        const value =
                            cell.getValue();

                        if (!value) {
                            return '-';
                        }

                        const date =
                            new Date(value);

                        return `

                            <span
                                class="text-xs
                                       font-medium
                                       text-slate-500"
                            >
                                ${
                                    date.toLocaleDateString(
                                        'id-ID',
                                        {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric'
                                        }
                                    )
                                }
                            </span>

                        `;

                    }

                },


                /*
                |--------------------------------------------------------------------------
                | AKSI
                |--------------------------------------------------------------------------
                */

                {
                    title: "AKSI",
                    width: 80,
                    hozAlign: "center",

                    formatter: function (cell) {

                        const data =
                            cell.getRow().getData();

                        return `

                            <a
                                href="/pendaftaran/hasil-wawancara/${data.id}"
                                title="Lihat Detail"
                                aria-label="Lihat Detail"
                                class="text-slate-400
                                       hover:text-[#02BC9C]
                                       p-1.5
                                       rounded-lg
                                       hover:bg-slate-100
                                       transition
                                       inline-block"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                    ></path>

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="3"
                                    ></circle>

                                </svg>

                            </a>

                        `;

                    }

                }

            ],


            /*
            |--------------------------------------------------------------------------
            | RESPONSE
            |--------------------------------------------------------------------------
            */

            ajaxResponse: function (
                url,
                params,
                response
            ) {

                updateStatistics(
                    response.statistik ?? {}
                );

                return response.data ?? [];

            },


            /*
            |--------------------------------------------------------------------------
            | ERROR
            |--------------------------------------------------------------------------
            */

            ajaxError: function (
                xhr,
                textStatus,
                errorThrown
            ) {

                console.error(
                    'Gagal mengambil data:',
                    errorThrown
                );

            },

            /*
            |--------------------------------------------------------------------------
            | DATA LOADED
            |--------------------------------------------------------------------------
            */

            dataLoaded: function (data) {

                updateTableInfo(data);

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | UPDATE STATISTICS
    |--------------------------------------------------------------------------
    */

    function updateStatistics(stat) {

        const total =
            Number(stat.total ?? 0);

        const lulus =
            Number(stat.lulus ?? 0);

        const tidakLulus =
            Number(stat.tidak_lulus ?? 0);

        const cadangan =
            Number(stat.cadangan ?? 0);

        const rataRata =
            Number(stat.rata_rata ?? 0);


        document.getElementById(
            'stat-rata-rata'
        ).innerText =
            rataRata.toFixed(2);


        document.getElementById(
            'progress-rata-rata'
        ).style.width =
            Math.min(rataRata, 100) + '%';


        document.getElementById(
            'stat-lulus'
        ).innerText =
            lulus;


        document.getElementById(
            'stat-cadangan'
        ).innerText =
            cadangan;


        document.getElementById(
            'stat-tidak-lulus'
        ).innerText =
            tidakLulus;


        const persenLulus =
            total > 0
                ? ((lulus / total) * 100).toFixed(1)
                : 0;


        document.getElementById(
            'persen-lulus'
        ).innerText =
            `${persenLulus}% dari total hasil wawancara`;

    }


    /*
    |--------------------------------------------------------------------------
    | TABLE INFO
    |--------------------------------------------------------------------------
    */

    function updateTableInfo(data) {

        const count =
            data?.length ?? 0;

        document.getElementById(
            'table-info'
        ).innerText =
            `${count} hasil wawancara`;

    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    let searchTimeout;

    document
        .getElementById('filter-search')
        .addEventListener(
            'input',
            function () {

                clearTimeout(searchTimeout);

                searchTimeout =
                    setTimeout(
                        function () {

                            applyFilter();

                        },
                        400
                    );

            }
        );


    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('filter-status')
        .addEventListener(
            'change',
            function () {

                applyFilter();

            }
        );


    /*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    */

    function applyFilter() {

        const search =
            document
                .getElementById('filter-search')
                .value
                .trim();

        const status =
            document
                .getElementById('filter-status')
                .value;


        const params = {};


        if (search !== '') {

            params.search = search;

        }


        if (status !== '') {

            params.status = status;

        }


        tableHasilWawancara.setData(
            "{{ route('hasilWawancara.data') }}",
            params
        );

    }


    /*
    |--------------------------------------------------------------------------
    | REFRESH
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('btn-refresh')
        .addEventListener(
            'click',
            function () {

                tableHasilWawancara.setData(
                    "{{ route('hasilWawancara.data') }}"
                );

            }
        );


    /*
    |--------------------------------------------------------------------------
    | EXPORT CSV
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('btn-export')
        .addEventListener(
            'click',
            function () {

                tableHasilWawancara.download(
                    "csv",
                    "hasil-wawancara.csv"
                );

            }
        );

});

</script>

@endpush