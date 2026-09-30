<div class="max-w-7xl mx-auto p-6">

    <div class="flex gap-2 mb-3">

        <button
            class="btn btn-success"
            onclick="saveNilaiHarian()">
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
                                id="filter_mapel_harian"
                                class="form-control"
                                placeholder="mata pelajaran...">

                        </div>

                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Nama Guru
                            </label>

                            <input
                                type="text"
                                id="filter_guru_harian"
                                class="form-control"
                                placeholder="nama guru...">

                        </div>

                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Kelas
                            </label>

                            <input
                                type="text"
                                id="filter_kelas_harian"
                                class="form-control"
                                placeholder="kelas...">

                        </div>

                    </div>



                    <!-- TABLE -->
                    <div class="overflow-x-auto">

                        <div id="table-nilai-harian"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<style>
.tabulator .tabulator-col-title{
    text-align:center;
    font-weight:bold;
}

.tabulator-col{
    text-align:center;
}
 </style>   
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let changedRowsharian = [];
    window.tableNilaiHarian = new Tabulator("#table-nilai-harian", {

        layout: "fitDataTable",
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

            {
                title: "Rubrik Penilaian",

                columns: [

                    {
                        title: "R1",
                        columns: [{
                                title: "P",
                                field: "p_1",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_1",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_1",
                                editor: "input",
                                width: 60
                            },
                        ]
                    },

                    {
                        title: "R2",
                        columns: [{
                                title: "P",
                                field: "p_2",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_2",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_2",
                                editor: "input",
                                width: 60
                            },
                        ]
                    },

                    {
                        title: "R3",
                        columns: [{
                                title: "P",
                                field: "p_3",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_3",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_3",
                                editor: "input",
                                width: 60
                            },
                        ]
                    },

                    {
                        title: "R4",
                        columns: [{
                                title: "P",
                                field: "p_4",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_4",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_4",
                                editor: "input",
                                width: 60
                            },
                        ]
                    }

                ]
            },

            {
                title: "Penilaian Harian",

                columns: [

                    {
                        title: "PH1",
                        columns: [{
                                title: "P",
                                field: "p_5",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_5",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_5",
                                editor: "input",
                                width: 60
                            },
                        ]
                    },

                    {
                        title: "PH2",
                        columns: [{
                                title: "P",
                                field: "p_6",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_6",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_6",
                                editor: "input",
                                width: 60
                            },
                        ]
                    },

                    {
                        title: "PH3",
                        columns: [{
                                title: "P",
                                field: "p_7",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_7",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_7",
                                editor: "input",
                                width: 60
                            },
                        ]
                    },

                    {
                        title: "PH4",
                        columns: [{
                                title: "P",
                                field: "p_8",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "K",
                                field: "k_8",
                                editor: "input",
                                width: 60
                            },
                            {
                                title: "S",
                                field: "s_8",
                                editor: "input",
                                width: 60
                            },
                        ]
                    }

                ]
            }

        ]

    });


    tableNilaiHarian.on("cellEdited", function(cell) {


        let rowData = cell.getRow().getData();
        let id = rowData.id;

        if (!changedRowsharian[id]) {

            const {
                nama_lengkap,
                ...data
            } = rowData;

            changedRowsharian[id] = data;

        } else {

            changedRowsharian[id][cell.getField()] = cell.getValue();
        }





    });

    async function saveNilaiHarian() {

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
                    rows: Object.values(changedRowsharian)
                })
            });

            const result = await response.json();

            changedRowsharian = {};

           

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