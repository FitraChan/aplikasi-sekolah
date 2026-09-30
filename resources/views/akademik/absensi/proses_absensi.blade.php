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

        <!-- REKAP KEHADIRAN -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box h-full">

                <div class="flex items-center px-5 py-4 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Rekap Kehadiran
                    </h2>

                    <button
                        data-tw-toggle="modal"
                        data-tw-target="#modalPertemuan"
                        class="btn btn-primary">

                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Tambah Pertemuan

                    </button>

                </div>

                <div class="p-5">
                    <div class="overflow-x-auto">
                        <div id="tableRekap"></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- DATA ABSENSI -->
        <div class="col-span-12 lg:col-span-6">
            <div class="box h-full">

                <div class="flex items-center px-5 py-4 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Data Absensi
                    </h2>

                    <div class="flex gap-2">

                        <button
                            class="btn btn-success"
                            onclick="simpanAbsensi()">

                            <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                            Simpan

                        </button>

                    </div>

                </div>

                <div class="p-5">
                    <div class="overflow-x-auto">
                        <div id="tableAbsensi"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    const tableAbsensi = new Tabulator("#tableAbsensi", {
        layout: "fitDataStretch",
        selectableRows: 1,
        columns: [{
                title: "No",
                formatter: "rownum",
                width: 60,
                hozAlign: "center",
            },
            {
                title: "NIPD",
                field: "nipd",
                width: 100,
            },
            {
                title: "Nama Siswa",
                field: "nama",
                minWidth: 150,
            },
            {
                title: "JK",
                field: "jk",
                width: 80,
               // hozAlign: "center",
            },
            {
                title: "Status",
                field: "sts_hadir",
                width: 100,
                editor: "list",
                editorParams: {
                    values: [
                        {label: "Hadir", value: "H"},
                        {label: "Izin", value: "I"},
                        {label: "Sakit", value: "S"},
                        {label: "Alfa", value: "A"}
                    ]
                }
            },
            {
                title: "Keterangan",
                field: "ket_hadir",
                minWidth: 200,
            },
        ],
    });


    window.tableRekap = new Tabulator("#tableRekap", {
        layout: "fitDataStretch",

        selectableRows:1,
        // data: [],
        columns: [{
                title: "Pertemuan",
                field: "pertemuan_ke",
                hozAlign: "center"
            },
            {
                title: "Tanggal",
                field: "tanggal",
                hozAlign: "center",
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
                hozAlign: "center"
            },
            {
                title: "S",
                field: "sakit",
                hozAlign: "center"
            },
            {
                title: "I",
                field: "izin",
                hozAlign: "center"
            },
            {
                title: "A",
                field: "alfa",
                // hozAlign: "center"
            }
        ]
    });

    tableRekap.on("rowClick", function(e, row) {
        showDetailAbsensi(

            row.getData()
        );
    });

    function showDetailAbsensi(data) {
console.log(data);

         if (tableAbsensi) {
            tableAbsensi.setData(
                "{{ url('absensi/dataDetailAbsensi') }}/" + data.id
            );

        }

      

    }

    async function simpanData() {

        const form = document.getElementById('form1');
        const formData = new FormData(form);

        formData.append(
            'idjadwal',
            document.getElementById('id_jadwal').value
        );

        try {

            const response = await fetch(
                "{{ route('absensi.store') }}", {
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

                // reset form
                form.reset();

                // tutup modal
                const modalEl = document.getElementById('modalPertemuan');
                const modal = tailwind.Modal.getOrCreateInstance(modalEl);
                modal.hide();

                // reload tabulator
                if (window.tableRekap) {
                    window.tableRekap.replaceData();
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Berhasil Di Simpan'
                });

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan pada server'
                });
            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan pada server'
            });
        }
    }


    function simpanAbsensi() {

    // ambil semua data dari tabulator
        const data = tableAbsensi.getData();
        
        // ambil hanya field penting
        const payload = data.map(row => ({
            id: row.id,
            sts_hadir: row.sts_hadir,
            ket_hadir: row.ket_hadir
        }));

        fetch("{{ url('/absensi/simpanDetailAbsensi') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                data: payload
            })
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                alert("Absensi berhasil disimpan");

                if (window.tableRekap) {
                    window.tableRekap.replaceData();
                }

            } else {
                alert("Gagal: " + data.msg);

                console.log(data);
                
            }

        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan server");
        });
    }
</script>