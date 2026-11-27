<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let selectedSiswaId = null;
    let currentTemplateId = 0;

    let tableSiswa;
    let tableDetail;


    document.addEventListener("DOMContentLoaded", function() {

        initTableSiswa();
        initTableHistory();

    });

    window.muatDetailBayar = async function(idBayar) {

        const url = "{{ route('detailVerifikasi', ':id') }}"
            .replace(':id', idBayar);

        const container = document.getElementById('content-detail-bayar-siswa');

        container.innerHTML = `
        <div class="text-center py-12 text-slate-400">
            <span class="animate-spin rounded-full h-8 w-8 border-b-2 border-teal-600 inline-block"></span>
            <p class="mt-3">Memuat detail pembayaran...</p>
        </div>
    `;

        try {

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal memuat detail pembayaran.');
            }

            const html = await response.text();

            container.innerHTML = html;

            if (window.lucide) {
                lucide.createIcons();
            }



        } catch (error) {

            console.error('Error muatDetailBayar:', error);

            container.innerHTML = `
            <div class="text-center py-12 text-red-500">
                Gagal memuat detail pembayaran.
            </div>
        `;

            throw error;
        }
    };


    /* =========================================================
       MODAL BULANAN ALL SISWA
    ========================================================== */

    function openModalBulananAllSiswa() {

        const modal =
            document.getElementById(
                'modal-bulanan-all-siswa'
            );

        if (!modal) {

            console.error(
                'Modal #modal-bulanan-all-siswa tidak ditemukan'
            );

            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }


    function closeModalBulananAllSiswa() {

        const modal =
            document.getElementById(
                'modal-bulanan-all-siswa'
            );

        if (!modal) {
            return;
        }

        modal.classList.remove('flex');
        modal.classList.add('hidden');

    }


    /* =========================================================
       TABLE SISWA
    ========================================================== */

    function initTableSiswa() {

        tableSiswa = new Tabulator("#tableBayar", {

            ajaxURL: "{{ route('bayar.data') }}",

            selectableRows: 1,

            pagination: true,
            paginationSize: 10,

            layout: "fitColumns",

            responsiveLayout: false,

            columns: [

                {
                    title: "No",
                    formatter: "rownum",
                    width: 65,
                    hozAlign: "center",
                    headerSort: false,
                    cssClass: "col-number"
                },

                {
                    title: "NIPD",
                    field: "nipd",
                    minWidth: 110,

                    formatter: function(cell) {
                        return `
                        <span class="siswa-nipd">
                            ${cell.getValue() ?? '-'}
                        </span>
                    `;
                    }
                },

                {
                    title: "Nama Siswa",
                    field: "nama_lengkap",
                    minWidth: 180,
                    variableHeight: true,

                    formatter: function(cell) {
                        return `
                        <div class="siswa-name">
                            <div class="siswa-avatar">
                                <i data-lucide="user-round"></i>
                            </div>
                            <div class="siswa-name-text">
                                ${cell.getValue() ?? '-'}
                            </div>
                        </div>
                    `;
                    }
                },
                {
                    title: "Tot Bayar",
                    field: "total_bayar",
                    minWidth: 150,

                    formatter: function(cell) {
                        const nilai = Number(cell.getValue() ?? 0);

                        return `
                            <span class="siswa-tahun">
                                <i data-lucide="wallet"></i>
                                ${nilai.toLocaleString('id-ID', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                })}
                            </span>
                        `;
                    }
                },

                {
                    title: "Sisa Bayar",
                    field: "sisa",
                    minWidth: 150,

                    formatter: function(cell) {
                        const nilai = Number(cell.getValue() ?? 0);

                        return `
                            <span class="siswa-tahun">
                                <i data-lucide="wallet"></i>
                                ${nilai.toLocaleString('id-ID', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                })}
                            </span>
                        `;
                    }
                },
                {
                    title: "Kelas",
                    field: "kelas.nama_kelas",
                    minWidth: 110,

                    formatter: function(cell) {
                        return `
                        <span class="siswa-kelas">
                            <i data-lucide="graduation-cap"></i>
                            ${cell.getValue() ?? '-'}
                        </span>
                    `;
                    }
                },

               

            ],

            rowFormatter: function(row) {
                row.getElement().style.cursor = "pointer";
            }

        });


        tableSiswa.on("rowClick", function(e, row) {

            const data = row.getData();

            console.log('data', data.nipd);

            document.getElementById('nipd_detail').value =
                data.nipd ?? '';

            document.getElementById('nama_siswa_detail').value =
                data.nama_lengkap ?? '';

            document.getElementById('jurusan_siswa_detail').value =
                data.jurusan?.nama_jurusan ?? '';

            document.getElementById('nipd').value =
                data.nipd ?? '';

            selectedSiswaId = data.nipd ?? null;

            showDetail(data.nipd);

        });

        tableSiswa.on("tableBuilt", function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });

    }


    /* =========================================================
       TABLE HISTORY
    ========================================================== */

    function initTableHistory() {

        const formatRupiah = function(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value || 0);
        };


        /*
        |--------------------------------------------------------------------------
        | TABEL HISTORY PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        tableDetail = new Tabulator(
            "#tableHistoryBayar", {

                layout: "fitData",

                height: "500px",
                processing: true,
                serverSide: true,

                dom: 'Bfrtip',

                buttons: [{
                    text: '<i class="fa fa-refresh"></i> Reload',
                    action: function(e, dt) {
                        dt.ajax.reload(null, false);
                    }
                }],

                selectableRows: 1,

                placeholder: "Belum ada riwayat pembayaran",

                columnHeaderVertAlign: "middle",

                rowHeader: {

                    formatter: function(cell) {

                        return `
                        <span class="history-expand-btn">
                            +
                        </span>
                    `;

                    },

                    width: 45,

                    hozAlign: "center",

                    headerSort: false,

                    cellClick: function(e, cell) {

                        let row = cell.getRow();

                        let data = row.getData();

                        let holder = row.getElement()
                            .querySelector(".detail-holder");


                        /*
                        |--------------------------------------------------------------------------
                        | TUTUP DETAIL
                        |--------------------------------------------------------------------------
                        */

                        if (holder) {

                            holder.remove();

                            cell.getElement().innerHTML = `
                            <span class="history-expand-btn">
                                +
                            </span>
                        `;

                            return;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | BUAT DETAIL
                        |--------------------------------------------------------------------------
                        */

                        let detailDiv = document.createElement("div");

                        detailDiv.classList.add("detail-holder");


                        detailDiv.innerHTML = `
                        <div class="detail-title">
                            <span class="detail-title-icon">
                                <i data-lucide="receipt-text"></i>
                            </span>
                            <div>
                                <div class="detail-title-text">Rincian Item Pembayaran</div>
                                <div class="detail-title-sub">Detail komponen transaksi</div>
                            </div>
                        </div>
                        <div class="detail-table"></div>
                    `;

                        row.getElement().appendChild(detailDiv);


                        cell.getElement().innerHTML = `
                        <span class="history-expand-btn">
                            −
                        </span>
                    `;


                        let tableDiv = detailDiv.querySelector(".detail-table");


                        /*
                        |--------------------------------------------------------------------------
                        | DETAIL TABULATOR
                        |--------------------------------------------------------------------------
                        */

                        new Tabulator(
                            tableDiv, {

                                ajaxURL: "{{ url('/bayar/detailBayar') }}/" + data.id,

                                layout: "fitData",

                                placeholder: "Tidak ada detail pembayaran",

                                columns: [

                                    {
                                        title: "Item Pembayaran",
                                        field: "nama_item",
                                        minWidth: 180,
                                        formatter: function(cell) {

                                            return `
                                            <span class="font-semibold text-slate-700">
                                                ${cell.getValue() || '-'}
                                            </span>
                                        `;

                                        }
                                    },

                                    {
                                        title: "Kewajiban",
                                        field: "kwajiban_bayar",
                                        hozAlign: "right",
                                        formatter: function(cell) {

                                            return formatRupiah(cell.getValue());

                                        }
                                    },

                                    {
                                        title: "Potongan",
                                        field: "potongan",
                                        hozAlign: "right",
                                        formatter: function(cell) {

                                            return `
                                            <span class="text-rose-600">
                                                ${formatRupiah(cell.getValue())}
                                            </span>
                                        `;

                                        }
                                    },

                                    {
                                        title: "Jumlah Bayar",
                                        field: "jml_bayar",
                                        hozAlign: "right",
                                        formatter: function(cell) {

                                            return `
                                            <span class="font-bold text-emerald-600">
                                                ${formatRupiah(cell.getValue())}
                                            </span>
                                        `;

                                        }
                                    }



                                ]

                            }
                        );

                    }

                },


                /*
                |--------------------------------------------------------------------------
                | KOLOM UTAMA
                |--------------------------------------------------------------------------
                */

                columns: [

                    {
                        title: "No",
                        formatter: "rownum",
                        width: 55,
                        hozAlign: "center",
                        headerSort: false
                    },

                    {
                        title: "Tahun",
                        field: "tahun_ajaran",
                        minWidth: 50
                    },

                    {
                        title: "Bulan",
                        field: "bulan",
                        minWidth: 100
                    },

                    {
                        title: "Status",
                        field: "status",
                        minWidth: 150,

                        formatter: function(cell) {
                            const status = cell.getValue();

                            let color = "bg-slate-100 text-slate-600";
                            let dot = "bg-slate-400";

                            if (status === "Menunggu Konfirmasi") {
                                color = "bg-amber-50 text-amber-700";
                                dot = "bg-amber-500";
                            } else if (status === "Lunas") {
                                color = "bg-emerald-50 text-emerald-700";
                                dot = "bg-emerald-500";
                            } else if (status === "Belum Lunas") {
                                color = "bg-red-50 text-red-700";
                                dot = "bg-red-500";
                            }

                            return `
                                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold ${color}">
                                            <span class="w-1.5 h-1.5 rounded-full ${dot}"></span>
                                            ${status ?? '-'}
                                        </span>
                                    `;
                        }
                    },

                    {
                        title: "Tgl Bayar",
                        field: "tgl_bayar",
                        minWidth: 125,

                        formatter: function(cell) {

                            let value = cell.getValue();

                            if (!value) return "-";

                            let date = new Date(value);

                            if (isNaN(date.getTime())) return "-";

                            return `
                            <span class="font-medium text-slate-700">
                                ${String(date.getDate()).padStart(2, '0')}-
                                ${String(date.getMonth() + 1).padStart(2, '0')}-
                                ${date.getFullYear()}
                            </span>
                        `;

                        }

                    },

                    {
                        title: "Tot Bayar",
                        field: "tot_bayar",
                        hozAlign: "right",
                        minWidth: 145,

                        formatter: function(cell) {

                            return `
                            <span class="font-bold text-emerald-600">
                                ${formatRupiah(cell.getValue())}
                            </span>
                        `;

                        }

                    },

                    {
                        title: "Tot Kewajiban",
                        field: "tot_kwajiban",
                        hozAlign: "right",
                        minWidth: 155,

                        formatter: function(cell) {

                            return `
                            <span class="font-semibold text-slate-800">
                                ${formatRupiah(cell.getValue())}
                            </span>
                        `;

                        }

                    },

                    {
                        title: "Aksi",
                        width: 110,
                        hozAlign: "center",
                        headerSort: false,

                        formatter: function(cell) {
                            let data = cell.getData();

                            return `
                                <div class="flex items-center justify-center">
                                    <button
                                        type="button"
                                        class="btn-detail-siswa"
                                        title="Lihat Detail">

                                        <i data-lucide="eye"></i>
                                        <span>Detail</span>

                                    </button>
                                </div>
                            `;
                        },

                        cellClick: async function(e, cell) {

                            if (!e.target.closest('.btn-detail-siswa')) return;

                            let data = cell.getData();

                            let url = "{{ route('detailVerifikasi', ':id') }}";
                            url = url.replace(':id', data.id);

                            // Aktifkan tab detail pembayaran
                            aktifkanTab('detail-bayar-siswa');

                            const container = document.getElementById(
                                'content-detail-bayar-siswa'
                            );

                            container.innerHTML = `
                                <div class="text-center py-12 text-slate-400">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-teal-600 mx-auto mb-3"></div>
                                    Memuat detail pembayaran...
                                </div>
                            `;

                            try {

                                const response = await fetch(url, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Accept': 'text/html'
                                    }
                                });

                                if (!response.ok) {
                                    throw new Error('Gagal mengambil detail pembayaran.');
                                }

                                const html = await response.text();

                                container.innerHTML = html;

                                // Render ulang icon Lucide jika digunakan
                                if (window.lucide) {
                                    lucide.createIcons();
                                }

                            } catch (error) {

                                console.error(error);

                                container.innerHTML = `
                                    <div class="text-center py-12 text-red-500">
                                        Gagal memuat detail pembayaran.
                                    </div>
                                `;

                            }

                        }
                    }
                ]

            }
        );


        /*
        |--------------------------------------------------------------------------
        | PILIH HISTORY PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        tableDetail.on(
            "rowClick",
            function(e, row) {

                let data = row.getData();

                document.getElementById('id_bayar').value = data.id;

            }
        );

    }


    /* =========================================================
       SHOW DETAIL
    ========================================================== */

    function showDetail(id) {

        currentTemplateId =
            id;


        document.getElementById(
            'id_bayar'
        ).value = '';


        tableDetail.setData(
            "{{ url('bayar/detail') }}/" +
            id
        );


        if (window.tableHistoryDetail) {
            console.log('data history', id);

            window.tableHistoryDetail.setData(
                "{{ url('bayar/detail') }}/" +
                id
            );

        }

    }


    /* =========================================================
       MODAL BAYAR
    ========================================================== */

    function openModalBayar() {

        let idBayar =
            document.getElementById(
                'id_bayar'
            ).value;


        if (!idBayar) {

            Swal.fire(
                'Peringatan',
                'Pilih data pembayaran terlebih dahulu',
                'warning'
            );

            return;
        }


        const modal =
            document.getElementById(
                'modal-bayar-form'
            );


        if (!modal) {

            console.error(
                'Modal pembayaran tidak ditemukan'
            );

            return;
        }


        modal.classList.remove(
            'hidden'
        );

        modal.classList.add(
            'flex'
        );

    }


    function closeModalBayar() {

        const modal =
            document.getElementById(
                'modal-bayar-form'
            );


        if (!modal) {
            return;
        }


        modal.classList.remove(
            'flex'
        );

        modal.classList.add(
            'hidden'
        );

    }


    /* =========================================================
       MODAL CICILAN
    ========================================================== */

    function openModalCicilan() {

        let nipd =
            document.getElementById(
                'nipd'
            ).value;


        if (!nipd) {

            Swal.fire(
                'Peringatan',
                'Pilih data siswa terlebih dahulu',
                'warning'
            );

            return;
        }


        const modal =
            document.getElementById(
                'modal-cicilan-form'
            );


        if (!modal) {

            console.error(
                'Modal cicilan tidak ditemukan'
            );

            return;
        }


        modal.classList.remove(
            'hidden'
        );

        modal.classList.add(
            'flex'
        );

    }


    function closeModalCicilan() {

        const modal =
            document.getElementById(
                'modal-cicilan-form'
            );


        if (!modal) {
            return;
        }


        modal.classList.remove(
            'flex'
        );

        modal.classList.add(
            'hidden'
        );

    }


    /* =========================================================
       SAVE BAYAR
    ========================================================== */

    async function saveBayar() {

        const tombol =
            document.getElementById(
                'btn-save-bayar'
            );


        const teksAwal =
            tombol.innerHTML;


        let id =
            document.getElementById(
                'id_bayar'
            ).value;


        tombol.disabled =
            true;


        tombol.innerHTML = `
            <span
                class="animate-spin
                       inline-block
                       w-4 h-4
                       border-2
                       border-white
                       border-t-transparent
                       rounded-full
                       mr-2">
            </span>
            Mohon tunggu...
        `;


        try {

            const url =
                "{{ route('bayar.set-lunas', ':id') }}"
                .replace(
                    ':id',
                    id
                );


            const response =
                await fetch(
                    url, {

                        method: 'POST',

                        headers: {

                            'Content-Type': 'application/json',

                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content,

                            'Accept': 'application/json'

                        },


                        body: JSON.stringify({

                            tgl_bayar: document.getElementById(
                                'tgl_bayar'
                            ).value,

                            no_kwitansi: document.getElementById(
                                'no_kwitansi'
                            ).value,

                            keterangan: document.getElementById(
                                'keterangan'
                            ).value

                        })

                    }
                );


            const result =
                await response.json();


            Swal.fire({

                icon: result.success ?
                    "success" : "error",

                title: result.title,

                text: result.msg

            });


            if (result.success) {

                closeModalBayar();

                tableDetail.replaceData();

            }


        } catch (error) {

            console.error(
                error
            );


            Swal.fire({

                icon: "error",

                title: "Error",

                text: "Terjadi kesalahan saat menyimpan pembayaran"

            });

        } finally {

            tombol.disabled =
                false;

            tombol.innerHTML =
                teksAwal;

        }

    }


    /* =========================================================
       SAVE CICILAN
    ========================================================== */

    async function saveCicilan() {

        const button =
            document.getElementById(
                'btn-save-cicilan'
            );

        const buttonText =
            document.getElementById(
                'text-save-cicilan'
            );

        const originalText =
            buttonText.innerHTML;

        button.disabled = true;

        buttonText.innerHTML =
            'Tunggu sebentar...';


        try {

            /*
            |--------------------------------------------------------------------------
            | FORM DATA
            |--------------------------------------------------------------------------
            */

            const formData =
                new FormData();


            /*
            |--------------------------------------------------------------------------
            | DATA SISWA
            |--------------------------------------------------------------------------
            */

            formData.append(
                'id_csiswa',
                document.getElementById(
                    'nipd'
                ).value
            );


            /*
            |--------------------------------------------------------------------------
            | DATA PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            formData.append(
                'tgl_bayar',
                document.getElementById(
                    'tgl_bayar'
                ).value
            );

            formData.append(
                'no_kwitansi',
                document.getElementById(
                    'no_kwitansi'
                ).value
            );

            formData.append(
                'keterangan',
                document.getElementById(
                    'keterangan'
                ).value
            );


            /*
            |--------------------------------------------------------------------------
            | JUMLAH PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            formData.append(
                'jml_dpp',
                document.getElementById(
                    'jml_dpp'
                ).value || 0
            );

            formData.append(
                'jml_seragam',
                document.getElementById(
                    'jml_seragam'
                ).value || 0
            );

            formData.append(
                'jml_spp',
                document.getElementById(
                    'jml_spp'
                ).value || 0
            );

            formData.append(
                'jml_tabungan',
                document.getElementById(
                    'jml_tabungan'
                ).value || 0
            );

            formData.append(
                'jml_osis',
                document.getElementById(
                    'jml_osis'
                ).value || 0
            );

            formData.append(
                'jml_lain',
                document.getElementById(
                    'jml_lain'
                )?.value || 0
            );


            /*
            |--------------------------------------------------------------------------
            | UPLOAD BUKTI BAYAR
            |--------------------------------------------------------------------------
            */

            const fileInput =
                document.getElementById(
                    'bukti_bayar_cicilan'
                );

            if (
                fileInput &&
                fileInput.files &&
                fileInput.files.length > 0
            ) {

                formData.append(
                    'bukti_bayar',
                    fileInput.files[0]
                );

            }


            /*
            |--------------------------------------------------------------------------
            | REQUEST
            |--------------------------------------------------------------------------
            */

            const response =
                await fetch(
                    '{{ route("bayar.simpanCicilan") }}', {

                        method: 'POST',

                        headers: {

                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]'
                            ).getAttribute(
                                'content'
                            ),

                            'Accept': 'application/json'

                        },

                        body: formData

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | RESPONSE
            |--------------------------------------------------------------------------
            */

            const result =
                await response.json();


            if (result.success) {

                Swal.fire({

                    icon: 'success',

                    title: result.title,

                    text: result.msg

                });


                /*
                |--------------------------------------------------------------------------
                | TUTUP MODAL
                |--------------------------------------------------------------------------
                */

                closeModalCicilan();


                /*
                |--------------------------------------------------------------------------
                | REFRESH TABLE
                |--------------------------------------------------------------------------
                */

                tableDetail.replaceData();

                window.tableHistoryDetail.replaceData();


                /*
                |--------------------------------------------------------------------------
                | RESET FILE
                |--------------------------------------------------------------------------
                */

                if (fileInput) {

                    fileInput.value = '';

                }


                const namaFile =
                    document.getElementById(
                        'nama-file-bukti-cicilan'
                    );

                if (namaFile) {

                    namaFile.textContent = '';

                    namaFile.classList.add(
                        'hidden'
                    );

                }


            } else {

                Swal.fire({

                    icon: 'error',

                    title: result.title,

                    text: result.msg

                });

            }


        } catch (error) {

            console.error(
                error
            );


            Swal.fire({

                icon: 'error',

                title: 'Error',

                text: 'Terjadi kesalahan saat menyimpan data'

            });


        } finally {

            button.disabled =
                false;

            buttonText.innerHTML =
                originalText;

        }

    }


    /* =========================================================
       SAVE BULANAN ALL SISWA
    ========================================================== */


    async function saveDefBulan() {

        const tombol = document.getElementById('btn-save-def-bulan');

        if (!tombol || tombol.disabled) return;

        const teksAwal = tombol.innerHTML;

        try {

            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA
            |--------------------------------------------------------------------------
            */

            const idTahun = document
                .getElementById('id_tahun')
                .value
                .trim();

            const idBulan = document
                .getElementById('id_bulan')
                .value
                .trim();


            /*
            |--------------------------------------------------------------------------
            | VALIDASI
            |--------------------------------------------------------------------------
            */

            if (idTahun === '' || idBulan === '') {

                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Tahun pembayaran dan bulan wajib diisi."
                });

                return;
            }

            if (!/^\d{4}$/.test(idTahun)) {

                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Tahun harus terdiri dari 4 digit."
                });

                document.getElementById('id_tahun').focus();

                return;
            }

            const daftarBulan = [
                'all_bulan',
                '1', '2', '3', '4', '5', '6',
                '7', '8', '9', '10', '11', '12'
            ];

            if (!daftarBulan.includes(idBulan)) {

                Swal.fire({
                    icon: "warning",
                    title: "Peringatan",
                    text: "Pilihan bulan tidak valid."
                });

                document.getElementById('id_bulan').focus();

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | KONFIRMASI
            |--------------------------------------------------------------------------
            */

           


            /*
            |--------------------------------------------------------------------------
            | LOADING
            |--------------------------------------------------------------------------
            */

            tombol.disabled = true;

            tombol.innerHTML = `
            <span class="animate-spin inline-block w-4 h-4
                border-2 border-white border-t-transparent
                rounded-full mr-2"></span>
            Mohon tunggu...
        `;


            /*
            |--------------------------------------------------------------------------
            | REQUEST
            |--------------------------------------------------------------------------
            */

            const response = await fetch(
                "{{ route('bayar.setDefBulan') }}", {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },

                    body: JSON.stringify({
                        id_tahun: idTahun,
                        id_bulan: idBulan
                    })
                }
            );

            const result = await response.json();

            console.log(result);

            closeModalBulananAllSiswa();


            /*
            |--------------------------------------------------------------------------
            | HASIL REQUEST
            |--------------------------------------------------------------------------
            */

            if (!response.ok || !result.success) {

                Swal.fire({
                    icon: "error",
                    title: result.title || "Gagal",
                    text: result.msg || "Terjadi kesalahan saat membuat tagihan."
                });

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            await Swal.fire({
                icon: "success",
                title: result.title || "Success",
                text: result.msg,
                confirmButtonText: "OK"
            });

            


            /*
            |--------------------------------------------------------------------------
            | RELOAD TABEL
            |--------------------------------------------------------------------------
            */

            if (typeof tableSiswa !== 'undefined' && tableSiswa) {
                tableSiswa.replaceData();
            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.message || "Terjadi kesalahan pada server."
            });

        } finally {

            tombol.disabled = false;
            tombol.innerHTML = teksAwal;

        }

    }



    /* =========================================================
       FILTER
    ========================================================== */

    function applyFilter() {

        tableSiswa.setData(
            "{{ route('bayar.data') }}", {

                tahun: document.getElementById(
                    'filter_tahun'
                ).value,

                jurusan: document.getElementById(
                    'filter_jurusan'
                ).value,

                kelas: document.getElementById(
                    'filter_kelas'
                ).value,

                keyword: document.getElementById(
                    'filter_keyword'
                ).value,
                sts_trans: document.getElementById(
                    'filter_sts_trans'
                ).value,

            }
        );

    }


    /* =========================================================
       RESET FILTER
    ========================================================== */

    function resetFilter() {

        document.getElementById(
            'filter_tahun'
        ).value = '';


        document.getElementById(
            'filter_jurusan'
        ).value = '';


        document.getElementById(
            'filter_kelas'
        ).value = '';


        document.getElementById(
            'filter_keyword'
        ).value = '';


        tableSiswa.clearFilter();

    }


    /* =========================================================
       CETAK KEWAJIBAN
    ========================================================== */

    function cetakKewajiban() {

        if (!selectedSiswaId) {

            Swal.fire(
                'Peringatan',
                'Pilih siswa terlebih dahulu',
                'warning'
            );

            return;
        }


        const cetakUrl =
            "{{ url('/bayar/createReportPdf') }}";


        window.open(
            `${cetakUrl}/${selectedSiswaId}`,
            '_blank'
        );

    }

    function aktifkanTab(targetId) {

        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(function(btn) {

            const aktif = btn.dataset.tabTarget === targetId;

            btn.classList.toggle('border-[#00B686]', aktif);
            btn.classList.toggle('text-[#00B686]', aktif);
            btn.classList.toggle('font-semibold', aktif);

            btn.classList.toggle('border-transparent', !aktif);
            btn.classList.toggle('text-slate-500', !aktif);
            btn.classList.toggle('font-medium', !aktif);

            btn.setAttribute('aria-selected', aktif ? 'true' : 'false');

        });

        tabContents.forEach(function(content) {

            content.classList.toggle('hidden', content.id !== targetId);

        });

    }

    window.simpanEditBayar = async function() {



        const form = document.getElementById('formEditBayar');
        const btn = document.getElementById('btnSimpanEditBayar');

        if (btn.disabled) return;

        const teksAwal = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = `
        <span class="animate-spin rounded-full h-4 w-4 border-2 border-white border-t-transparent"></span>
        Menyimpan...
    `;

        try {

            const formData = new FormData(form);

            const idBayar = formData.get('id_bayar');

            // UPDATE PEMBAYARAN
            const response = await fetch(
                "{{ route('updateStatusDanBayarTransaksi') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                }
            );

            const result = await response.json();

            if (!response.ok) {
                const errors = Object.values(result.errors || {})
                    .flat()
                    .join('\n');

                throw new Error(
                    errors || result.message || 'Gagal menyimpan pembayaran.'
                );
            }

            // Tutup modal
            tutupModalBayar();

            tableDetail.replaceData();

            // Tampilkan notifikasi
            alert(result.message || 'Pembayaran berhasil diperbarui.');

            // MUAT ULANG DETAIL TRANSAKSI
            if (typeof window.muatDetailBayar === 'function') {

                await window.muatDetailBayar(idBayar);

            } else {

                console.warn('Fungsi muatDetailBayar() belum tersedia.');

            }



        } catch (error) {

            console.group('ERROR SIMPAN PEMBAYARAN');
            console.error('Pesan:', error.message);
            console.error('Stack:', error.stack);
            console.trace('Lokasi pemanggilan error');
            console.groupEnd();

            alert(error.message);

        } finally {

            btn.disabled = false;
            btn.innerHTML = teksAwal;

            if (window.lucide) {
                lucide.createIcons();
            }

        }

    }

    async function setujuiPembayaran(url, idBayar) {

        if (!confirm('Apakah Anda yakin ingin menyetujui pembayaran ini?')) {
            return;
        }

        const btn = document.getElementById('btnSetujuiPembayaran');

        if (btn.disabled) return;

        const teksAwal = btn.innerHTML;

        btn.disabled = true;

        btn.innerHTML = `
        <span class="animate-spin rounded-full h-4 w-4 border-2
        border-white border-t-transparent"></span>
        Memproses...
    `;

        try {

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Gagal menyetujui pembayaran.');
            }

            tableDetail.replaceData();


            alert(result.message || 'Pembayaran berhasil disetujui.');

            // Muat ulang detail pembayaran jika diperlukan
            // window.muatDetailBayar(idBayar);

            // MUAT ULANG DETAIL TRANSAKSI
            if (typeof window.muatDetailBayar === 'function') {

                await window.muatDetailBayar(idBayar);

            } else {

                console.warn('Fungsi muatDetailBayar() belum tersedia.');

            }

        } catch (error) {

            console.error(error);

            alert(error.message || 'Terjadi kesalahan.');

            btn.disabled = false;
            btn.innerHTML = teksAwal;

        }

    }

    function cetakPdf() {
        const params = new URLSearchParams();

        params.set('tahun', document.getElementById('filter_tahun')?.value ?? '');
        params.set('jurusan', document.getElementById('filter_jurusan')?.value ?? '');
        params.set('kelas', document.getElementById('filter_kelas')?.value ?? '');
        params.set('keyword', document.getElementById('filter_keyword')?.value ?? '');

        window.open(
            `{{ route('siswa.cetakPdf') }}?${params.toString()}`,
            '_blank'
        );
    }
</script>