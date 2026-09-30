<div class="max-w-7xl mx-auto p-6">

    
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Daftar Master Soal
                    </h2>

                </div>

                <div class="p-5">

                    <div class="overflow-x-auto">
                        <div class="flex justify-end mb-3">

                            <div class="w-80">
                                <input
                                    type="text"
                                    id="search-master-soal"
                                    class="form-control"
                                    placeholder="🔍 Cari judul, mapel, jenis soal, semester...">
                            </div>

                        </div>

                        <div id="table-master-soal"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const dataSoal = @json($mastersoal);

    const table = new Tabulator("#table-master-soal", {

        data: dataSoal,

        layout: "fitDataStretch",

        responsiveLayout: "collapse",

        pagination: true,

        paginationSize: 10,

        movableColumns: true,

        placeholder: "Belum ada data.",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                width: 70,
                hozAlign: "center"
            },

            {
                title: "Jenis Soal",
                field: "jenis_soal",
                minWidth: 100
            },

            {
                title: "Nama Mapel",
                field: "nama_mapel",
                width: 170,
                hozAlign: "center"
            },

            {
                title: "Semester",
                field: "smt",
                width: 100,
                //hozAlign:"center"
            },
            {
                title: "Judul Soal",
                field: "judul_soal",
                width: 100,

            },

            {
                title: "Soal",
                field: "soal",
                width: 650,
                formatter: "html",
                variableHeight: true

            },


            {
                title: "Aksi",

                width: 130,

                formatter: function(cell) {

                    const row = cell.getRow().getData();

                    return `
                    <button
                        class="btn btn-sm btn-warning mr-1"
                        onclick="pilih(${row.id})">
                        Pilih
                    </button>

                  
                `;

                }

            }

        ]

    });


    document.getElementById("search-master-soal").addEventListener("keyup", function () {

    const value = this.value.toLowerCase();

    if (value === "") {
        table.clearFilter();
        return;
    }

    table.setFilter(function (data) {

        return (
            (data.jenis_soal ?? "").toLowerCase().includes(value) ||
            (data.nama_mapel ?? "").toLowerCase().includes(value) ||
            (data.smt ?? "").toLowerCase().includes(value) ||
            (data.judul_soal ?? "").toLowerCase().includes(value) ||
            (data.soal ?? "").toLowerCase().includes(value)
        );

    });

});

    async function pilih(soalId) {

        const ujianId = {{ $ujian->id }};

        try {

            const formData = new FormData();
            formData.append("soal_id", soalId);

            const response = await fetch(`{{ url('pbm/createDetQuiz') }}/${ujianId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: formData
            });

            const res = await response.json();

            if (response.ok && res.success) {

                await Swal.fire({
                    icon: "success",
                    title: "Sukses",
                    text: res.message,
                    confirmButtonText: "OK"
                });

                location.reload();

            } else {

                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: res.message
                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Terjadi kesalahan pada server."
            });

        }

    }
</script>