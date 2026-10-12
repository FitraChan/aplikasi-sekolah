@extends('layout.app')

@section('title', 'Jadwal Wawancara')
@section('page_title', 'Jadwal Wawancara')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-8 min-w-0">


    {{-- =========================================================
    HEADER
========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Daftar Jadwal Wawancara
            </h2>

            <p class="text-sm text-slate-500 mt-1 font-medium">
                Manajemen jadwal wawancara calon siswa.
            </p>
        </div>

        <a href="{{ route('jadwal-wawancara.create') }}"
            class="inline-flex items-center gap-2 bg-[#02BC9C] hover:bg-[#02a387]
               text-white font-semibold text-sm px-5 py-2.5 rounded-xl
               shadow-sm hover:shadow transition-all duration-150 active:scale-[0.99]">

            <svg class="w-4 h-4 stroke-current stroke-2"
                fill="none"
                viewBox="0 0 24 24">

                <line x1="12" x2="12" y1="5" y2="19"></line>
                <line x1="5" x2="19" y1="12" y2="12"></line>

            </svg>

            <span>Buat Jadwal Baru</span>
        </a>

    </div>


    {{-- =========================================================
    STAT CARD
========================================================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Total --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm
                flex flex-col justify-between h-36">

            <div class="flex items-center justify-between">

                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600
                        flex items-center justify-center">

                    <svg class="w-5 h-5 stroke-current stroke-2"
                        fill="none"
                        viewBox="0 0 24 24">

                        <rect height="18" rx="2" width="18" x="3" y="4"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>

                    </svg>

                </div>

            </div>

            <div>
                <p class="text-xs text-slate-400 font-medium tracking-wide">
                    Total Jadwal
                </p>

                <p id="stat-total"
                    class="text-2xl font-black text-slate-800 mt-0.5 tracking-tight">
                    0
                </p>
            </div>

        </div>


        {{-- Terjadwal --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm
                flex flex-col justify-between h-36">

            <div class="flex items-center justify-between">

                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600
                        flex items-center justify-center">

                    <svg class="w-5 h-5 stroke-current stroke-2"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path d="M12 8v4l3 3"
                            stroke-linecap="round"
                            stroke-linejoin="round"></path>

                        <circle cx="12" cy="12" r="9"></circle>

                    </svg>

                </div>

            </div>

            <div>

                <p class="text-xs text-slate-400 font-medium tracking-wide">
                    Terjadwal
                </p>

                <p id="stat-terjadwal"
                    class="text-2xl font-black text-slate-800 mt-0.5 tracking-tight">
                    0
                </p>

            </div>

        </div>


        {{-- Selesai --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm
                flex flex-col justify-between h-36">

            <div class="flex items-center justify-between">

                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600
                        flex items-center justify-center">

                    <svg class="w-5 h-5 stroke-current stroke-2"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path d="M9 12l2 2 4-4"
                            stroke-linecap="round"
                            stroke-linejoin="round"></path>

                        <circle cx="12" cy="12" r="9"></circle>

                    </svg>

                </div>

            </div>

            <div>

                <p class="text-xs text-slate-400 font-medium tracking-wide">
                    Selesai
                </p>

                <p id="stat-selesai"
                    class="text-2xl font-black text-slate-800 mt-0.5 tracking-tight">
                    0
                </p>

            </div>

        </div>


        {{-- Hari Ini --}}
        <div class="bg-[#02BC9C] rounded-2xl p-5 shadow-sm
                flex flex-col justify-between h-36 text-white relative overflow-hidden">

            <div class="flex items-center justify-between">

                <div class="w-10 h-10 rounded-xl bg-white/20 text-white
                        flex items-center justify-center">

                    <svg class="w-5 h-5 stroke-current stroke-2"
                        fill="none"
                        viewBox="0 0 24 24">

                        <rect height="18" rx="2" width="18" x="3" y="4"></rect>
                        <line x1="16" x2="16" y1="2" y2="6"></line>
                        <line x1="8" x2="8" y1="2" y2="6"></line>
                        <line x1="3" x2="21" y1="10" y2="10"></line>

                    </svg>

                </div>

                <div class="w-2.5 h-2.5 rounded-full bg-white opacity-80"></div>

            </div>

            <div>

                <p class="text-xs text-white/90 font-medium tracking-wide">
                    Wawancara Hari Ini
                </p>

                <p id="stat-hari-ini"
                    class="text-2xl font-black text-white mt-0.5 tracking-tight">
                    0
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
    TABLE CONTAINER
========================================================== --}}
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden">

        {{-- =====================================================
        FILTER
    ====================================================== --}}
        <div class="p-5 border-b border-slate-100">

            <div class="flex flex-col xl:flex-row
                    items-center justify-between gap-4">

                {{-- Search --}}
                <div class="relative w-full xl:w-96">

                    <span class="absolute inset-y-0 left-0 flex items-center
                             pl-3.5 pointer-events-none text-slate-400">

                        <svg class="w-4 h-4 stroke-current stroke-2"
                            fill="none"
                            viewBox="0 0 24 24">

                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" x2="16.65" y1="21" y2="16.65"></line>

                        </svg>

                    </span>

                    <input
                        id="search-jadwal"
                        type="text"
                        placeholder="Cari nama atau ID calon siswa..."
                        class="w-full pl-10 pr-4 py-2
                           bg-slate-50/50 border border-slate-200
                           rounded-xl text-xs sm:text-sm text-slate-700
                           placeholder-slate-400
                           focus:outline-none focus:ring-2
                           focus:ring-[#02BC9C]
                           focus:border-transparent">

                </div>


                {{-- Filters --}}
                <div class="flex flex-wrap items-center gap-3
                        w-full xl:w-auto justify-end">

                    {{-- Tanggal --}}
                    <div class="flex items-center gap-2">

                        <span class="text-xs sm:text-sm font-semibold text-slate-500">
                            Tanggal:
                        </span>

                        <input
                            id="filter-tanggal"
                            type="date"
                            class="bg-white border border-slate-200
                               rounded-xl px-3 py-2
                               text-xs sm:text-sm font-semibold
                               text-slate-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-[#02BC9C]">

                    </div>


                    {{-- Status --}}
                    <div class="flex items-center gap-2">

                        <span class="text-xs sm:text-sm font-semibold text-slate-500">
                            Status:
                        </span>

                        <div class="relative">

                            <select
                                id="filter-status"
                                class="appearance-none bg-white
                                   border border-slate-200
                                   rounded-xl px-4 py-2 pr-9
                                   text-xs sm:text-sm font-semibold
                                   text-slate-700
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-[#02BC9C]
                                   cursor-pointer">

                                <option value="">Semua Status</option>
                                <option value="terjadwal">Terjadwal</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                                <option value="tidak_hadir">Tidak Hadir</option>

                            </select>

                            <span class="absolute inset-y-0 right-0 flex items-center
                                     pr-3 pointer-events-none text-slate-400">

                                <svg class="w-4 h-4 stroke-current stroke-2"
                                    fill="none"
                                    viewBox="0 0 24 24">

                                    <polyline points="6 9 12 15 18 9"></polyline>

                                </svg>

                            </span>

                        </div>

                    </div>


                    {{-- Reset --}}
                    <button
                        type="button"
                        id="btn-reset-filter"
                        class="inline-flex items-center gap-2
                           border border-slate-200
                           hover:bg-slate-50
                           text-slate-700
                           text-xs sm:text-sm font-semibold
                           px-4 py-2 rounded-xl
                           transition-colors">

                        <svg class="w-4 h-4 text-slate-500 stroke-current stroke-2"
                            fill="none"
                            viewBox="0 0 24 24">

                            <path d="M3 12a9 9 0 109-9"
                                stroke-linecap="round"
                                stroke-linejoin="round"></path>

                            <polyline points="3 3 3 9 9 9"></polyline>

                        </svg>

                        <span>Reset</span>

                    </button>

                </div>

            </div>

        </div>


        {{-- =====================================================
        TABULATOR
    ====================================================== --}}
        <div class="p-4">

            <div id="table-jadwal-wawancara"></div>

        </div>

    </div>


</main>

{{-- =============================================================
SCRIPT
============================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.tableWawancara = new Tabulator("#table-jadwal-wawancara", {

            ajaxURL: "{{ route('jadwal-wawancara.data') }}",

            layout: "fitColumns",

            height: "550px",

            pagination: true,

            paginationSize: 10,

            paginationSizeSelector: [10, 25, 50, 100],

            placeholder: "Data jadwal wawancara tidak ditemukan",

            ajaxResponse: function(url, params, response) {

                // console.log('Response API:', response);

                // Update statistik
                updateStat(response);

                // Tabulator harus menerima ARRAY
                return Array.isArray(response.data) ?
                    response.data :
                    [];
            },

            columns: [{
                    title: "No",
                    formatter: "rownum",
                    width: 60,
                    hozAlign: "center"
                },
                {
                    title: "Calon Siswa",
                    field: "calon_siswa.nama_lengkap",
                    minWidth: 200,
                    formatter: function(cell) {

                        const data = cell.getRow().getData();

                        return `
                    <div>
                        <div class="font-medium">
                            ${data.calon_siswa?.nama_lengkap ?? '-'}
                        </div>

                        <div class="text-xs text-slate-500">
                            ${data.calon_siswa?.no_daftar ?? '-'}
                        </div>
                    </div>
                `;
                    }
                },
                {
                    title: "Tanggal & Waktu",
                    field: "tanggal",
                    width: 160,
                    formatter: function(cell) {

                        const data = cell.getRow().getData();

                        const tanggal = data.tanggal;
                        const jamMulai = data.jam_mulai;
                        const jamSelesai = data.jam_selesai;

                        if (!tanggal) {
                            return '-';
                        }

                        const tanggalFormatted = new Date(tanggal).toLocaleDateString(
                            'id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            }
                        );

                        const waktu = jamMulai ?
                            `${jamMulai.substring(0, 5)}${jamSelesai ? ' - ' + jamSelesai.substring(0, 5) : ''}` :
                            '-';

                        return `
            <div>
                <div class="font-bold text-sm text-slate-800">
    ${tanggalFormatted}
</div>

                <div class="font-bold text-xs text-slate-500">
                    ${waktu}
                </div>
            </div>
        `;
                    }
                },
                {
                    title: "Tempat",
                    field: "tempat",
                    minWidth: 180,
                    formatter: function(cell) {
                        return cell.getValue() ?? '-';
                    }
                },
                {
                    title: "Pewawancara",
                    field: "gtk.nama_gtk",
                    minWidth: 180,
                    formatter: function(cell) {

                        const data = cell.getRow().getData();

                        return data.gtk?.nama_gtk ?? '-';
                    }
                },
                {
                    title: "Status",
                    field: "status",
                    width: 130,
                    hozAlign: "center",
                    formatter: function(cell) {

                        const status = cell.getValue();

                        const badge = {
                            terjadwal: `
                        <span class="px-2.5 py-1 rounded-full
                            bg-amber-100 text-amber-700 text-xs font-medium">
                            Terjadwal
                        </span>
                    `,
                            selesai: `
                        <span class="px-2.5 py-1 rounded-full
                            bg-emerald-100 text-emerald-700 text-xs font-medium">
                            Selesai
                        </span>
                    `,
                            batal: `
                        <span class="px-2.5 py-1 rounded-full
                            bg-red-100 text-red-700 text-xs font-medium">
                            Batal
                        </span>
                    `,
                            tidak_hadir: `
                        <span class="px-2.5 py-1 rounded-full
                            bg-slate-100 text-slate-700 text-xs font-medium">
                            Tidak Hadir
                        </span>
                    `
                        };

                        return badge[status] ?? status;
                    }
                },
                {
                    title: "Aksi",
                    width: 130,
                    hozAlign: "center",
                    headerHozAlign: "center",
                    formatter: function(cell) {

                        const data = cell.getRow().getData();

                        return `
            <div class="flex items-center justify-center gap-2">

                <a
                    href="{{ url('jadwal-wawancara') }}/edit/${data.id}"
                    class="inline-flex items-center justify-center
                           w-8 h-8 rounded-lg
                           bg-[#e6f9f5]
                           text-[#02BC9C]
                           hover:bg-[#02BC9C]
                           hover:text-white
                           transition"
                    title="Edit">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M11 4H6a2 2 0 0 0-2 2v12
                               a2 2 0 0 0 2 2h12
                               a2 2 0 0 0 2-2v-5"/>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1
                               1-4 9.5-9.5z"/>

                    </svg>

                </a>


                <button
                    type="button"
                    onclick="hapusJadwalWawancara(${data.id})"
                    class="inline-flex items-center justify-center
                           w-8 h-8 rounded-lg
                           bg-red-50
                           text-red-600
                           hover:bg-red-600
                           hover:text-white
                           transition"
                    title="Hapus">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         viewBox="0 0 24 24">

                        <polyline
                            points="3 6 5 6 21 6">
                        </polyline>

                        <path
                            d="M19 6v14a2 2 0 0 1-2 2H7
                               a2 2 0 0 1-2-2V6
                               m3 0V4a2 2 0 0 1 2-2h4
                               a2 2 0 0 1 2 2v2">
                        </path>

                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>

                    </svg>

                </button>

            </div>
        `;
                    }
                }
            ]
        });


        // =========================================================
        // SEARCH
        // =========================================================

        document
            .getElementById('search-jadwal')
            .addEventListener('keyup', function() {

                let value = this.value
                    .toLowerCase()
                    .trim();

                tableJadwalWawancara.setFilter(function(
                    data
                ) {

                    let nama =
                        data.calon_siswa?.nama_lengkap
                        ?.toLowerCase() ?? '';

                    let noDaftar =
                        data.calon_siswa?.no_daftar
                        ?.toLowerCase() ?? '';

                    return nama.includes(value) ||
                        noDaftar.includes(value);

                });

            });


        // =========================================================
        // FILTER TANGGAL
        // =========================================================

        document
            .getElementById('filter-tanggal')
            .addEventListener('change', function() {

                let value = this.value;

                if (!value) {

                    tableJadwalWawancara.clearFilter();

                    return;

                }

                tableJadwalWawancara.setFilter(
                    'tanggal',
                    '=',
                    value
                );

            });


        // =========================================================
        // FILTER STATUS
        // =========================================================

        document
            .getElementById('filter-status')
            .addEventListener('change', function() {

                let value = this.value;

                if (!value) {

                    tableJadwalWawancara.clearFilter();

                    return;

                }

                tableJadwalWawancara.setFilter(
                    'status',
                    '=',
                    value
                );

            });


        // =========================================================
        // RESET FILTER
        // =========================================================

        document
            .getElementById('btn-reset-filter')
            .addEventListener('click', function() {

                document.getElementById('search-jadwal').value = '';

                document.getElementById('filter-tanggal').value = '';

                document.getElementById('filter-status').value = '';

                tableJadwalWawancara.clearFilter();

            });


        // =========================================================
        // UPDATE STAT CARD
        // =========================================================

        tableJadwalWawancara.on(
            "dataLoaded",
            function(data) {

                updateStat(data);

            }
        );


        function updateStat(response) {

            const rows = Array.isArray(response?.data) ?
                response.data :
                [];


            // Total semua jadwal
            const total = rows.length;

            console.log('total', total);


            // Status terjadwal
            const terjadwal = rows.filter(function(item) {
                return item.status === 'terjadwal';
            }).length;

            // Status selesai
            const selesai = rows.filter(function(item) {
                return item.status === 'selesai';
            }).length;

            // Tanggal hari ini berdasarkan waktu lokal browser
            const now = new Date();

            const today =
                now.getFullYear() +
                '-' +
                String(now.getMonth() + 1).padStart(2, '0') +
                '-' +
                String(now.getDate()).padStart(2, '0');

            // Wawancara hari ini
            const hariIni = rows.filter(function(item) {

                if (!item.tanggal) {
                    return false;
                }

                // Ambil YYYY-MM-DD dari tanggal ISO
                const tanggal = new Date(item.tanggal);

                const tanggalItem =
                    tanggal.getFullYear() +
                    '-' +
                    String(tanggal.getMonth() + 1).padStart(2, '0') +
                    '-' +
                    String(tanggal.getDate()).padStart(2, '0');

                return tanggalItem === today;

            }).length;


            document.getElementById('stat-total').innerText =
                total.toLocaleString('id-ID');

            document.getElementById('stat-terjadwal').innerText =
                terjadwal.toLocaleString('id-ID');

            document.getElementById('stat-selesai').innerText =
                selesai.toLocaleString('id-ID');

            document.getElementById('stat-hari-ini').innerText =
                hariIni.toLocaleString('id-ID');
        }


        // =========================================================
        // DELETE
        // =========================================================

        document.addEventListener(
            'click',
            function(e) {

                let button =
                    e.target.closest('.btn-hapus-jadwal');

                if (!button) {
                    return;
                }

                let id =
                    button.dataset.id;


                if (!confirm(
                        'Apakah Anda yakin ingin menghapus jadwal wawancara ini?'
                    )) {
                    return;
                }


                fetch(
                        `/jadwal-wawancara/${id}`, {
                            method: 'DELETE',

                            headers: {

                                'X-CSRF-TOKEN': document
                                    .querySelector(
                                        'meta[name="csrf-token"]'
                                    )
                                    .getAttribute('content'),

                                'Accept': 'application/json'

                            }

                        }
                    )
                    .then(function(response) {

                        return response.json();

                    })
                    .then(function(result) {

                        if (result.status) {

                            alert(result.message);

                            tableJadwalWawancara
                                .replaceData();

                        } else {

                            alert(
                                result.message ??
                                'Gagal menghapus jadwal.'
                            );

                        }

                    })
                    .catch(function(error) {

                        console.error(error);

                        alert(
                            'Terjadi kesalahan saat menghapus data.'
                        );

                    });

            }
        );

    });

    async function hapusJadwalWawancara(id) {

    const yakin = confirm(
        'Apakah Anda yakin ingin menghapus jadwal wawancara ini?'
    );

    if (!yakin) {
        return;
    }

    try {

        const response = await fetch(
            `{{ url('jadwal-wawancara/delete') }}/${id}`,
            {
                method: 'DELETE',

                headers: {
                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        )?.getAttribute('content')
                        ?? '{{ csrf_token() }}',

                    'Accept': 'application/json'
                }
            }
        );


        const result = await response.json();


        if (!response.ok) {

            alert(
                result.message ??
                'Gagal menghapus jadwal wawancara.'
            );

            return;
        }


        alert(
            result.message ??
            'Jadwal wawancara berhasil dihapus.'
        );


        // Refresh Tabulator
        if (window.tableWawancara) {
            window.tableWawancara.replaceData();
        }


    } catch (error) {

        console.error(error);

        alert(
            'Terjadi kesalahan saat menghapus jadwal wawancara.'
        );

    }

}
</script>

@endsection