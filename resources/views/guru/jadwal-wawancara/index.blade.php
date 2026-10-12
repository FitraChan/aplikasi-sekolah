@extends('layout.main')

@section('tittle')
Jadwal Wawancara
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Jadwal Wawancara</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row gap-2 mb-3">

        <div>
            <h2 class="text-lg font-medium">
                Jadwal Wawancara
            </h2>

            <div class="text-slate-500 text-sm mt-1">
                Jadwal wawancara yang menjadi tanggung jawab Anda.
            </div>
        </div>

    </div>


    {{-- Informasi Guru --}}
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <div class="mr-auto">

                        <h2 class="font-medium text-base">
                            {{ $guru->nama_gtk }}
                        </h2>

                        <div class="text-slate-500 text-xs mt-1">
                            Jadwal wawancara calon siswa
                        </div>

                    </div>

                </div>

                {{-- Filter --}}
                <div class="p-5 border-b border-slate-200/60">

                    <div class="grid grid-cols-12 gap-4">

                        {{-- Tanggal --}}
                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                id="filter-tanggal"
                                class="form-control">

                        </div>


                        {{-- Status --}}
                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                id="filter-status"
                                class="form-select">

                                <option value="">
                                    Semua Status
                                </option>

                                <option value="terjadwal">
                                    Terjadwal
                                </option>

                                <option value="selesai">
                                    Selesai
                                </option>

                                <option value="tidak_hadir">
                                    Tidak Hadir
                                </option>

                            </select>

                        </div>


                        {{-- Tombol --}}
                        <div class="col-span-12 md:col-span-4 flex items-end gap-2">

                            <button
                                type="button"
                                id="btn-filter"
                                class="btn btn-primary">

                                <i data-lucide="search" class="w-4 h-4 mr-1"></i>

                                Filter

                            </button>

                            <button
                                type="button"
                                id="btn-reset"
                                class="btn btn-outline-secondary">

                                <i data-lucide="refresh-cw" class="w-4 h-4 mr-1"></i>

                                Reset

                            </button>

                        </div>

                    </div>

                </div>


                {{-- Table --}}
                <div class="p-5">

                    <div class="overflow-x-auto">

                        <div id="table-jadwal-wawancara"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const tableJadwal = new Tabulator(
        "#table-jadwal-wawancara",
        {

            ajaxURL: "{{ route('jadwalGuru.data') }}",

            layout: "fitDataStretch",

            pagination: true,

            paginationSize: 10,

            paginationSizeSelector: [10, 25, 50, 100],

            responsiveLayout: "collapse",

            placeholder: "Belum ada jadwal wawancara.",

            ajaxParams: {

                tanggal: "",
                status: ""

            },

            columns: [

                {
                    title: "No",
                    formatter: "rownum",
                    width: 60,
                    hozAlign: "center"
                },


                {
                    title: "Tanggal",
                    field: "tanggal",
                    width: 130,

                    formatter: function(cell) {

                        const value = cell.getValue();

                        if (!value) {
                            return "-";
                        }

                        const date = new Date(value);

                        return date.toLocaleDateString(
                            'id-ID',
                            {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            }
                        );

                    }

                },


                {
                    title: "Jam",
                    field: "jam_mulai",
                    width: 150,

                    formatter: function(cell) {

                        const data = cell.getData();

                        const mulai = data.jam_mulai
                            ? data.jam_mulai.substring(0, 5)
                            : '-';

                        const selesai = data.jam_selesai
                            ? data.jam_selesai.substring(0, 5)
                            : '-';

                        return mulai + ' - ' + selesai;

                    }

                },


                {
                    title: "No. Pendaftaran",
                    field: "calon_siswa.no_daftar",
                    width: 160
                },


                {
                    title: "Nama Calon Siswa",
                    field: "calon_siswa.nama_lengkap",
                    width: 280
                },


                {
                    title: "Jurusan",
                    field: "calon_siswa.jurusan.nama_jurusan",
                    width: 220
                },


                {
                    title: "Tempat",
                    field: "tempat",
                    width: 200,

                    formatter: function(cell) {

                        return cell.getValue() || '-';

                    }

                },


                {
                    title: "Status",
                    field: "status",
                    width: 150,

                    formatter: function(cell) {

                        const status = cell.getValue();

                        let label = status;
                        let cls = '';

                        switch (status) {

                            case 'terjadwal':

                                label = 'Terjadwal';

                                cls =
                                    'bg-primary text-white';

                                break;

                            case 'selesai':

                                label = 'Selesai';

                                cls =
                                    'bg-success text-white';

                                break;

                            case 'tidak_hadir':

                                label = 'Tidak Hadir';

                                cls =
                                    'bg-warning text-white';

                                break;

                            case 'batal':

                                label = 'Batal';

                                cls =
                                    'bg-danger text-white';

                                break;

                            default:

                                label = status || '-';

                                cls =
                                    'bg-slate-200 text-slate-700';

                        }

                        return `
                            <span class="px-2 py-1 rounded text-xs ${cls}">
                                ${label}
                            </span>
                        `;

                    }

                },


                {
                    title: "Catatan",
                    field: "catatan",
                    width: 250,

                    formatter: function(cell) {

                        return cell.getValue() || '-';

                    }

                },
                {
    title: "Aksi",
    field: "id",
    width: 160,
    hozAlign: "center",
    headerHozAlign: "center",

    formatter: function(cell) {

        const data = cell.getData();

        const url = "{{ route('hasilWawancara.create', ':id') }}"
            .replace(':id', data.id);

        // Jika wawancara sudah selesai
        if (data.status === 'selesai') {

            return `
                <a
                    href="${url}"
                    class="inline-flex items-center px-3 py-1.5
                           bg-success text-white rounded text-xs
                           hover:opacity-90 transition"
                >
                    Lihat Hasil
                </a>
            `;
        }

        // Jika masih terjadwal
        if (data.status === 'terjadwal') {

            return `
                <a
                    href="${url}"
                    class="inline-flex items-center px-3 py-1.5
                           bg-primary text-white rounded text-xs
                           hover:opacity-90 transition"
                >
                    Mulai Wawancara
                </a>
            `;
        }

        return `
            <span class="text-slate-400 text-xs">
                Tidak tersedia
            </span>
        `;
    }
},

            ]

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Filter
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('btn-filter')
        .addEventListener('click', function () {

            const tanggal =
                document.getElementById('filter-tanggal').value;

            const status =
                document.getElementById('filter-status').value;


            tableJadwal.setData(
                "{{ route('jadwalGuru.data') }}",
                {
                    tanggal: tanggal,
                    status: status
                }
            );

        });


    /*
    |--------------------------------------------------------------------------
    | Reset
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('btn-reset')
        .addEventListener('click', function () {

            document.getElementById('filter-tanggal').value = '';

            document.getElementById('filter-status').value = '';


            tableJadwal.setData(
                "{{ route('jadwalGuru.data') }}",
                {
                    tanggal: '',
                    status: ''
                }
            );

        });

});

</script>

@endsection
