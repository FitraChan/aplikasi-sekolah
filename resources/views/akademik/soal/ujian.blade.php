<div class="max-w-7xl mx-auto p-6">
    <div class="grid grid-cols-12 gap-6">

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
                        <div id="tableUjian"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>

    window.tableUjian = new Tabulator("#tableUjian", {   
    layout: "fitDataStretch",
    columns: [
        { title: "Soal ID", field: "id" },
        { title: "Nama Ujian", field: "judul" },
        { title: "Tingkat", field: "nkelas" },
        { title: "Kelas", field: "nama_kelas" },
        { title: "Mata Pelajaran", field: "nama_mapel" },
    ],
});
</script>