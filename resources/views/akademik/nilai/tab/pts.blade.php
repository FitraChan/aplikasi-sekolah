<div class="max-w-7xl mx-auto p-6">

    <div class="flex gap-2 mb-3">

        <button
            class="btn btn-success"
            onclick="saveNilaiPts()">
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
                                id="filter_mapel_pts"
                                class="form-control"
                                placeholder="mata pelajaran...">

                        </div>

                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Nama Guru
                            </label>

                            <input
                                type="text"
                                id="filter_guru_pts"
                                class="form-control"
                                placeholder="nama guru...">

                        </div>

                        <div class="col-span-12 md:col-span-4">

                            <label class="form-label">
                                Kelas
                            </label>

                            <input
                                type="text"
                                id="filter_kelas_pts"
                                class="form-control"
                                placeholder="kelas...">

                        </div>

                    </div>



                    <!-- TABLE -->
                    <div class="overflow-x-auto">

                        <div id="table-nilai-pts"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
    let changedRowsPts = [];
    window.tablePts = new Tabulator("#table-nilai-pts", {

        layout: "fitDataStretch",

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
                title: "PTS",
                columns: [{
                        title: "P",
                        field: "p_9",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "K",
                        field: "k_9",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "S",
                        field: "s_9",
                        editor: "input",
                        width: 70
                    },
                ]
            },

            {
                title: "PAS",
                columns: [{
                        title: "P",
                        field: "p_10",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "K",
                        field: "k_10",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "S",
                        field: "s_10",
                        editor: "input",
                        width: 70
                    },
                ]
            },

            {
                title: "Remedial",
                columns: [{
                        title: "P",
                        field: "p_11",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "K",
                        field: "k_11",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "S",
                        field: "s_11",
                        editor: "input",
                        width: 70
                    },
                ]
            },

            {
                title: "Raport",
                columns: [{
                        title: "P",
                        field: "p_12",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "K",
                        field: "k_12",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "S",
                        field: "s_12",
                        editor: "input",
                        width: 70
                    },
                ]
            },

            {
                title: "Predikat",
                columns: [{
                        title: "P",
                        field: "p_13",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "K",
                        field: "k_13",
                        editor: "input",
                        width: 70
                    },
                    {
                        title: "S",
                        field: "s_13",
                        editor: "input",
                        width: 70
                    },
                ]
            }

        ]
    });

    tablePts.on("cellEdited", function(cell) {


        let rowData = cell.getRow().getData();
        let id = rowData.id;

        if (!changedRowsPts[id]) {

            const {
                nama_lengkap,
                ...data
            } = rowData;

            changedRowsPts[id] = data;

        } else {

            changedRowsPts[id][cell.getField()] = cell.getValue();
        }


    });


    async function saveNilaiPts() {

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
                    rows: Object.values(changedRowsPts)
                })
            });

            const result = await response.json();

            changedRowsPts = {};



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