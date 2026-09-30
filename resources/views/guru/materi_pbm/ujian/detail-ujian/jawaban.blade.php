<div class="max-w-7xl mx-auto p-6">


    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <div class="p-5">

                    <div class="overflow-x-auto">


                        <div class="flex items-center mb-3">

                            <div class="flex gap-2">
                                <button class="btn btn-outline-success" id="btn-excel">Excel</button>
                                <button class="btn btn-outline-danger" id="btn-pdf">PDF</button>
                            </div>

                            <div class="w-80 ml-auto">
                                <input
                                    type="text"
                                    id="search-jawaban"
                                    class="form-control"
                                    placeholder="🔍 Cari siswa, NIS, skor...">
                            </div>

                        </div>
                        <div id="table-jawaban"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.4/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    const dataJawaban = @json($jawabansiswa);
    const tableJawaban = new Tabulator("#table-jawaban", {

        data: dataJawaban,

        layout: "fitDataStretch",

        pagination: true,
        paginationSize: 10,

        placeholder: "Belum ada data.",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                width: 60,
                hozAlign: "center"
            },

            {
                title: "NIPD",
                field: "nipd",
                width: 120
            },

            {
                title: "Nama Siswa",
                field: "nama_lengkap",
                width: 250
            },

            {
                title: "Mulai",
                field: "tgl_mulai_quiz",
                width: 200
            },

            {
                title: "Selesai",
                field: "tgl_selesai_quiz",
                width: 200
            },

            {
                title: "Skor",
                field: "total_skor",
                width: 100
            },
            {
                title: "Aksi",

                width: 120,
                formatter: function(cell) {
                    let data = cell.getData();
                    if (data.total_skor == 0) {

                        return `
                       
                    `;

                    } else {

                        return `
                        <a href="{{ url('pbm/detail-ujian-siswa') }}/${data.id_jawaban}"
                            class="btn btn-sm btn-outline-primary"
                            data-tw-toggle="tooltip"
                            title="Lihat Detail Hasil Ujian">

                            Detail

                        </a>
                    `;
                    }
                }
            }

        ]

    });

    const searchInput = document.getElementById("search-jawaban");

    searchInput.addEventListener("keyup", function() {
        const keyword = this.value.toLowerCase();

        if (keyword === "") {
            tableJawaban.clearFilter();
            return;
        }

        tableJawaban.setFilter(function(data) {
            return (
                (data.nipd && data.nipd.toLowerCase().includes(keyword)) ||
                (data.nama_lengkap && data.nama_lengkap.toLowerCase().includes(keyword)) ||
                (String(data.total_skor).includes(keyword))
            );
        });
    });



    document.getElementById("btn-pdf").addEventListener("click", function() {
        tableJawaban.download("pdf", "Laporan_Jawaban_Siswa.pdf", {
            orientation: "landscape",
            jsPDF: {
                unit: "pt",
                format: "a4",
            },
            autoTable: function(doc) {
                doc.setFontSize(18);
                doc.text("LAPORAN HASIL UJIAN SISWA", 40, 35);
                doc.setFontSize(11);
                doc.text("Tanggal : " + new Date().toLocaleDateString(), 40, 55);
                return {
                    startY: 70,
                    theme: "grid",
                    styles: {
                        fontSize: 9,
                        cellPadding: 4,
                    },
                    headStyles: {
                        fillColor: [22, 160, 133],
                        textColor: 255,
                    },
                    alternateRowStyles: {
                        fillColor: [245, 245, 245],
                    },
                };
            }

        });

    });

    document.getElementById("btn-excel").addEventListener("click", function() {

        tableJawaban.download("xlsx", "Laporan_Hasil_Ujian.xlsx", {
            sheetName: "Hasil Ujian"
        });

    });
</script>