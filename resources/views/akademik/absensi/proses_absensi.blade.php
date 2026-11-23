<div class="mx-auto w-full max-w-7xl space-y-6 p-4 sm:p-6 lg:p-8">

    {{-- INFORMASI JADWAL --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i data-lucide="calendar-days" class="h-5 w-5"></i>
                </div>

                <div>
                    <h2 class="text-base font-semibold text-slate-800">
                        Informasi Jadwal
                    </h2>
                    <p class="text-xs text-slate-500">
                        Informasi mata pelajaran dan pengajar
                    </p>
                </div>
            </div>
        </div>

        <div class="p-5">

            <input type="hidden" id="id_jadwal">

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        id="filter_mapel_detail"
                        readonly
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 outline-none"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        id="filter_guru_detail"
                        readonly
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 outline-none"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Kelas
                    </label>

                    <input
                        type="text"
                        id="filter_kelas_detail"
                        readonly
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 outline-none"
                    >
                </div>

            </div>
        </div>
    </div>


    {{-- GRID DATA --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        {{-- REKAP KEHADIRAN --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER --}}
            <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <i data-lucide="clipboard-list" class="h-5 w-5"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            Rekap Kehadiran
                        </h2>
                        <p class="text-xs text-slate-500">
                            Daftar pertemuan dan rekap kehadiran siswa
                        </p>
                    </div>
                </div>

                <button
                    type="button"
                    data-tw-toggle="modal"
                    data-tw-target="#modalPertemuan"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">

                    <i data-lucide="plus" class="h-4 w-4"></i>
                    Tambah Pertemuan
                </button>

            </div>

            {{-- BODY --}}
            <div class="p-5">

                <div class="overflow-x-auto">
                    <div id="tableRekap"></div>
                </div>

                <div class="mt-3 flex items-center gap-2 text-xs text-slate-400">
                    <i data-lucide="info" class="h-3.5 w-3.5"></i>
                    Klik salah satu pertemuan untuk melihat detail absensi.
                </div>

            </div>
        </div>


        {{-- DATA ABSENSI --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER --}}
            <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <i data-lucide="users" class="h-5 w-5"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            Data Absensi
                        </h2>
                        <p class="text-xs text-slate-500">
                            Pengisian status kehadiran siswa
                        </p>
                    </div>
                </div>

                <button
                    type="button"
                    onclick="simpanAbsensi()"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">

                    <i data-lucide="save" class="h-4 w-4"></i>
                    Simpan Absensi
                </button>

            </div>

            {{-- BODY --}}
            <div class="p-5">

                <div class="overflow-x-auto">
                    <div id="tableAbsensi"></div>
                </div>

                <div class="mt-3 flex items-center gap-2 text-xs text-slate-400">
                    <i data-lucide="info" class="h-3.5 w-3.5"></i>
                    Pilih status kehadiran dan isi keterangan jika diperlukan.
                </div>

            </div>
        </div>

    </div>
</div>


<script type="text/javascript">

    /* =====================================================
       TABULATOR DATA ABSENSI
    ===================================================== */

    const tableAbsensi = new Tabulator("#tableAbsensi", {

        layout: "fitDataStretch",
        selectableRows: 1,

        placeholder: "Pilih pertemuan untuk menampilkan data absensi.",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                width: 60,
                hozAlign: "center",
                headerHozAlign: "center",
            },

            {
                title: "NIPD",
                field: "nipd",
                width: 100,
                headerSort: true,
            },

            {
                title: "Nama Siswa",
                field: "nama",
                minWidth: 150,
                headerSort: true,
            },

            {
                title: "JK",
                field: "jk",
                width: 70,
                hozAlign: "center",
                headerHozAlign: "center",
            },

            {
                title: "Status",
                field: "sts_hadir",
                width: 120,
                hozAlign: "center",
                headerHozAlign: "center",

                editor: "list",

                editorParams: {
                    values: {
                        "H": "Hadir",
                        "I": "Izin",
                        "S": "Sakit",
                        "A": "Alfa"
                    }
                },

                formatter: function(cell) {

                    const value = cell.getValue();

                    const status = {
                        H: {
                            label: "Hadir",
                            color: "bg-emerald-100 text-emerald-700"
                        },
                        I: {
                            label: "Izin",
                            color: "bg-blue-100 text-blue-700"
                        },
                        S: {
                            label: "Sakit",
                            color: "bg-amber-100 text-amber-700"
                        },
                        A: {
                            label: "Alfa",
                            color: "bg-rose-100 text-rose-700"
                        }
                    };

                    const item = status[value];

                    if (!item) {
                        return `<span class="text-slate-400">-</span>`;
                    }

                    return `
                        <span class="inline-flex rounded-lg px-3 py-1 text-xs font-semibold ${item.color}">
                            ${item.label}
                        </span>
                    `;
                }
            },

            {
                title: "Keterangan",
                field: "ket_hadir",
                minWidth: 200,
                editor: "input",
            },

        ],

    });


    /* =====================================================
       TABULATOR REKAP KEHADIRAN
    ===================================================== */

    window.tableRekap = new Tabulator("#tableRekap", {

        layout: "fitDataStretch",

        selectableRows: 1,

        placeholder: "Belum ada data pertemuan.",

        columns: [

            {
                title: "Pertemuan",
                field: "pertemuan_ke",
                hozAlign: "center",
                headerHozAlign: "center",
                width: 100,
            },

            {
                title: "Tanggal",
                field: "tanggal",
                hozAlign: "center",
                headerHozAlign: "center",
                minWidth: 110,

                formatter: function(cell) {

                    let value = cell.getValue();

                    if (!value) return "";

                    let date = new Date(value);

                    let day = String(date.getDate()).padStart(2, '0');
                    let month = String(date.getMonth() + 1).padStart(2, '0');
                    let year = date.getFullYear();

                    return `${day}-${month}-${year}`;
                }
            },

            {
                title: "H",
                field: "hadir",
                hozAlign: "center",
                headerHozAlign: "center",
                width: 60,
            },

            {
                title: "S",
                field: "sakit",
                hozAlign: "center",
                headerHozAlign: "center",
                width: 60,
            },

            {
                title: "I",
                field: "izin",
                hozAlign: "center",
                headerHozAlign: "center",
                width: 60,
            },

            {
                title: "A",
                field: "alfa",
                hozAlign: "center",
                headerHozAlign: "center",
                width: 60,
            }

        ]

    });


    /* =====================================================
       KLIK REKAP UNTUK MELIHAT DETAIL ABSENSI
    ===================================================== */

    window.tableRekap.on("rowClick", function(e, row) {

        showDetailAbsensi(row.getData());

    });


    function showDetailAbsensi(data) {

        console.log(data);

        if (tableAbsensi) {

            tableAbsensi.setData(
                "{{ url('absensi/dataDetailAbsensi') }}/" + data.id
            );

        }

    }


    /* =====================================================
       SIMPAN DATA PERTEMUAN
    ===================================================== */

    async function simpanData() {

        const form = document.getElementById('form1');

        if (!form) {

            Swal.fire({
                icon: 'warning',
                title: 'Form Tidak Ditemukan',
                text: 'Form pertemuan tidak ditemukan.'
            });

            return;
        }

        const formData = new FormData(form);

        formData.append(
            'idjadwal',
            document.getElementById('id_jadwal').value
        );

        try {

            const response = await fetch(
                "{{ route('absensi.store') }}",
                {
                    method: "POST",

                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .content,

                        "Accept": "application/json"
                    },

                    body: formData
                }
            );

            const result = await response.json();

            if (result.success) {

                form.reset();

                const modalEl = document.getElementById('modalPertemuan');

                const modal = tailwind.Modal.getOrCreateInstance(modalEl);

                modal.hide();

                if (window.tableRekap) {
                    window.tableRekap.replaceData();
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data pertemuan berhasil disimpan.'
                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: result.msg || 'Terjadi kesalahan pada server.'
                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan data.'
            });

        }

    }


    /* =====================================================
       SIMPAN DETAIL ABSENSI
    ===================================================== */

    async function simpanAbsensi() {

        const data = tableAbsensi.getData();

        if (!data.length) {

            Swal.fire({
                icon: 'warning',
                title: 'Data Kosong',
                text: 'Silakan pilih pertemuan terlebih dahulu.'
            });

            return;
        }

        const payload = data.map(row => ({

            id: row.id,

            sts_hadir: row.sts_hadir,

            ket_hadir: row.ket_hadir

        }));

        try {

            const response = await fetch(
                "{{ url('/absensi/simpanDetailAbsensi') }}",
                {
                    method: "POST",

                    headers: {

                        "Content-Type": "application/json",

                        "Accept": "application/json",

                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')

                    },

                    body: JSON.stringify({
                        data: payload
                    })

                }
            );

            const result = await response.json();

            if (result.success) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data absensi berhasil disimpan.'
                });

                if (window.tableRekap) {
                    window.tableRekap.replaceData();
                }

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: result.msg || 'Absensi gagal disimpan.'
                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat menyimpan absensi.'
            });

        }

    }


    /* =====================================================
       REFRESH ICON LUCIDE
    ===================================================== */

    document.addEventListener("DOMContentLoaded", function() {

        if (window.lucide) {
            lucide.createIcons();
        }

    });

</script>