<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-12 gap-6">

        <!-- INFORMASI JADWAL -->
        <div class="col-span-12">
            <div class="box">
                <div class="p-5">

                    <input type="hidden" id="id_jadwal">

                    <div class="grid grid-cols-12 gap-4">

                        <div class="col-span-12 md:col-span-4">
                            <label class="form-label">Mata Pelajaran</label>
                            <input
                                type="text"
                                id="filter_mapel_detail"
                                class="form-control"
                                readonly>
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="form-label">Nama Guru</label>
                            <input
                                type="text"
                                id="filter_guru_detail"
                                class="form-control"
                                readonly>
                        </div>

                        <div class="col-span-12 md:col-span-4">
                            <label class="form-label">Kelas</label>
                            <input
                                type="text"
                                id="filter_kelas_detail"
                                class="form-control"
                                readonly>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        

        <!-- DATA ABSENSI -->
        <div class="col-span-12">
            <div class="box h-full">

                <div class="flex items-center px-5 py-4 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Master Soal
                    </h2>

                 

                </div>

                <div class="p-5">
                    <div class="overflow-x-auto">
                        <div id="tableSoal"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>

 window.tableSoal = new Tabulator("#tableSoal", {
    layout: "fitDataStretch",
    pagination: true,
    paginationSize: 20,

    columns: [
        {
            title: "Soal ID",
            field: "id",
            width: 100
        },
        {
            title: "Jenis Soal",
            field: "jenis_soal",
            width: 150
        },
        {
            title: "Soal",
            field: "soal",
            width: 350
        },
        {
            title: "Mata Pelajaran",
            field: "nama_mapel",
            width: 200
        },
        {
            title: "Semester",
            field: "smt",
            width: 100,
           // hozAlign: "center"
        }
    ]
});
    </script>
