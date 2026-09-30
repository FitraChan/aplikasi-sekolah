@extends('layout.main')

@section('tittle')
Penilaian Guru
@endsection

@section('top-nav')

<ol class="breadcrumb">
    <li class="breadcrumb-item">Nilai</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <div class="flex gap-2 mb-3">

        <button
            class="btn btn-success"
            onclick="saveNilaiDetail()">
            <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
            Save Nilai

        </button>

    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">



                <div class="p-5">

                    <!-- FILTER -->
                    <div class="grid grid-cols-12 gap-4 mb-5">

                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Mata Pelajaran
                            </label>

                            <input
                                type="text"
                                id="filter_mapel_detail"
                                class="form-control"
                                value=<?= $mapel->mapel->nama_mapel;  ?>
                                placeholder="mata pelajaran...">

                        </div>

                      

                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Kelas
                            </label>

                            <input
                                type="text"
                                id="filter_kelas_detail"
                                class="form-control"
                                value="<?= $mapel->nkelas.' '.$mapel->kelas->nama_kelas;  ?>"
                                placeholder="kelas...">

                        </div>

                    </div>



                    <!-- TABLE -->
                    <div class="overflow-x-auto">

                        <div id="table-detail-nilai"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<style>
    .tabulator .tabulator-col-title {
        text-align: center;
        font-weight: bold;
    }

    .tabulator-col {
        text-align: center;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let changedRowsDetail = [];

    const id = "{{ request()->route('id') }}";

    const tableDetailNilai = new Tabulator("#table-detail-nilai", {
        layout: "fitDataTable",

        ajaxURL: "{{ url('nilai/detail/' . request()->route('id')) }}",        movableColumns: true,
        columnHeaderVertAlign: "middle",
        columns: [
            {
                title: "NIS",
                field: "nipd",
                frozen: true,
                width: 120
            },

            {
                title: "Nama Siswa",
                field: "nama_lengkap",
                frozen: true,
                width: 250
            },

            // ==========================
            // RUBRIK PENILAIAN
            // ==========================
            // ==========================
            // RUBRIK PENILAIAN
            // ==========================
            {
                title: "Rubrik Penilaian",
                columns: [

                    {
                        title: "R1",
                        columns: [{
                                title: "P",
                                field: "p_1",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_1",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_1",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    },

                    {
                        title: "R2",
                        columns: [{
                                title: "P",
                                field: "p_2",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_2",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_2",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    },

                    {
                        title: "R3",
                        columns: [{
                                title: "P",
                                field: "p_3",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_3",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_3",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    },

                    {
                        title: "R4",
                        columns: [{
                                title: "P",
                                field: "p_4",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_4",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_4",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    }
                ]
            },

            // ==========================
            // PENILAIAN HARIAN
            // ==========================
            {
                title: "Penilaian Harian",
                columns: [

                    {
                        title: "PH1",
                        columns: [{
                                title: "P",
                                field: "p_5",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_5",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_5",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    },

                    {
                        title: "PH2",
                        columns: [{
                                title: "P",
                                field: "p_6",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_6",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_6",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    },

                    {
                        title: "PH3",
                        columns: [{
                                title: "P",
                                field: "p_7",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_7",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_7",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    },

                    {
                        title: "PH4",
                        columns: [{
                                title: "P",
                                field: "p_8",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "K",
                                field: "k_8",
                                width: 60,
                                editor: "input"
                            },
                            {
                                title: "S",
                                field: "s_8",
                                width: 60,
                                editor: "input"
                            }
                        ]
                    }
                ]
            },

            // ==========================
            // PTS
            // ==========================
            {
                title: "PTS",
                columns: [{
                        title: "P",
                        field: "p_9",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "K",
                        field: "k_9",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "S",
                        field: "s_9",
                        width: 60,
                        editor: "input"
                    }
                ]
            },

            // ==========================
            // PAS
            // ==========================
            {
                title: "PAS",
                columns: [{
                        title: "P",
                        field: "p_10",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "K",
                        field: "k_10",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "S",
                        field: "s_10",
                        width: 60,
                        editor: "input"
                    }
                ]
            },

            // ==========================
            // REMEDIAL
            // ==========================
            {
                title: "Remedial",
                columns: [{
                        title: "P",
                        field: "p_11",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "K",
                        field: "k_11",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "S",
                        field: "s_11",
                        width: 60,
                        editor: "input"
                    }
                ]
            },

            // ==========================
            // RAPORT
            // ==========================
            {
                title: "Raport",
                columns: [{
                        title: "P",
                        field: "p_12",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "K",
                        field: "k_12",
                        width: 60,
                        editor: "input"
                    },
                    {
                        title: "S",
                        field: "s_12",
                        width: 60,
                        editor: "input"
                    }
                ]
            },

            // ==========================
            // PREDIKAT
            // ==========================
            {
                title: "Predikat",
                columns: [{
                        title: "P",
                        field: "p_13",
                        width: 70,
                        editor: "input"
                    },
                    {
                        title: "K",
                        field: "k_13",
                        width: 70,
                        editor: "input"
                    },
                    {
                        title: "S",
                        field: "s_13",
                        width: 70,
                        editor: "input"
                    }
                ]
            }
        ]
    });


    tableDetailNilai.on("cellEdited", function(cell) {


        let rowData = cell.getRow().getData();
        let id = rowData.id;

        if (!changedRowsDetail[id]) {

            const {
                nama_lengkap,
                ...data
            } = rowData;

            changedRowsDetail[id] = data;

        } else {

            changedRowsDetail[id][cell.getField()] = cell.getValue();
        }


    });


    async function saveNilaiDetail() {

        try {



            const response = await fetch("{{ url('/nilai-harian/update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                },
                body: JSON.stringify({
                    rows: Object.values(changedRowsDetail)
                })
            });

            const result = await response.json();

            changedRowsDetail = {};



            Swal.fire({
                icon: result.success ? 'success' : 'warning',
                title: result.title,
                text: result.msg
            });




            console.log(result);

        } catch (error) {

            console.error(error);

            console.log('gagal');

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan pada server'
            });



        }
    }
</script>
@endsection
