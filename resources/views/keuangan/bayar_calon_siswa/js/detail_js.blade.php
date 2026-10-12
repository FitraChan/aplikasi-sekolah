<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let tableDetailBayar;
    let selectedHistoryBayar = null;
    let selectedDetail = null;

    document.addEventListener("DOMContentLoaded", function() {

        initTableDetailHistory();
        initTableDetailBayar();

    });


    /* =========================================================
       TABLE HISTORY PEMBAYARAN
    ========================================================= */

    function initTableDetailHistory() {

        window.tableHistoryDetail = new Tabulator(
            "#tableHistoryBayarDetail", {
                layout: "fitDataStretch",
                height: "500px",
                selectableRows: 1,
                placeholder: "Belum ada data",

                columns: [

                    {
                        title: "No",
                        formatter: "rownum",
                        width: 60,
                        hozAlign: "center"
                    },

                    {
                        title: "Tahun",
                        field: "tahun_ajaran"
                    },

                    {
                        title: "Bulan",
                        field: "bulan"
                    },

                    {
                        title: "Tanggal Bayar",
                        field: "tgl_bayar",

                        formatter: function(cell) {

                            let value = cell.getValue();

                            if (!value) {
                                return "";
                            }

                            let date = new Date(value);

                            return String(date.getDate()).padStart(2, '0') +
                                "-" +
                                String(date.getMonth() + 1).padStart(2, '0') +
                                "-" +
                                date.getFullYear();
                        }
                    },

                    {
                        title: "Total Bayar",
                        field: "tot_bayar",

                        formatter: function(cell) {

                            return new Intl.NumberFormat(
                                'id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(cell.getValue() || 0);
                        }
                    },

                    {
                        title: "Total Kewajiban",
                        field: "total_kwajiban",
                        hozAlign: "right",

                        formatter: function(cell) {

                            return new Intl.NumberFormat(
                                'id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(cell.getValue() || 0);
                        }
                    },

                    {
                        title: "Keterangan",
                        field: "keterangan",
                        width: 250
                    },
                    {
                        title: "Bukti Bayar",
                        field: "bukti_bayar",
                        width: 130,
                        hozAlign: "center",
                        headerHozAlign: "center",

                        formatter: function(cell) {

                            const bukti =
                                cell.getValue();




                            if (!bukti) {

                                return `
                                <span
                                    class="text-xs text-slate-400"
                                >
                                    Tidak ada
                                </span>
                            `;

                            }

                            return `
                            <button
                                type="button"
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       px-3
                                       py-1.5
                                       rounded-lg
                                       bg-[#02BC9C]
                                       hover:bg-[#00aF8F]
                                       text-white
                                       text-xs
                                       font-medium
                                       transition-colors"
                                onclick="lihatBuktiBayar('${bukti}')"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="2.5"
                                    />

                                </svg>

                                Lihat

                            </button>
                        `;

                        }

                    }
                ]
            }
        );


        window.tableHistoryDetail.on("rowClick", function(e, row) {

            let data = row.getData();

            console.log(data.id);

            document.getElementById('id_bayar_detail').value =
                data.id ?? '';

            selectedHistoryBayar = data;

            showDetailBayar(data.id);
        });
    }


    /* =========================================================
       EDIT HISTORY PEMBAYARAN
    ========================================================= */

    function editHistoryBayar() {

        if (!selectedHistoryBayar) {

            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih data terlebih dahulu'
            });

            return;
        }

        console.log(selectedHistoryBayar.no_kwitansi);


        document.getElementById('id_bayar_history').value =
            selectedHistoryBayar.id ?? '';


        document.getElementById('tgl_bayar_history').value =
            selectedHistoryBayar.tgl_bayar ?? '';


        document.getElementById('no_kwitansi_history').value =
            selectedHistoryBayar.no_kwitansi ?? '';


        document.getElementById('keterangan').value =
            selectedHistoryBayar.keterangan ?? '';


        // BUKA MODAL TAILWIND
        openModalUpdateHistory();
    }


    /* =========================================================
       BUKA MODAL UPDATE HISTORY
    ========================================================= */

    function openModalUpdateHistory() {

        const modal = document.getElementById(
            'modal-update-history-form'
        );

        if (!modal) {

            console.error(
                'Modal update history tidak ditemukan'
            );

            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    /* =========================================================
       TUTUP MODAL UPDATE HISTORY
    ========================================================= */

    function closeModalUpdateHistory() {

        const modal = document.getElementById(
            'modal-update-history-form'
        );

        if (!modal) {
            return;
        }

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }


    /* =========================================================
       HAPUS HISTORY PEMBAYARAN
    ========================================================= */

    async function hapusHistoryBayar() {

        if (!selectedHistoryBayar) {

            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih data terlebih dahulu'
            });

            return;
        }


        const konfirmasi = await Swal.fire({

            icon: 'warning',

            title: 'Konfirmasi Hapus',

            text: 'Apakah Anda yakin ingin menghapus data ini?',

            showCancelButton: true,

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'
        });


        if (!konfirmasi.isConfirmed) {
            return;
        }


        try {

            const response = await fetch(
                `{{ url('bayar-calon-siswa') }}/${selectedHistoryBayar.id}`, {
                    method: 'DELETE',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            .getAttribute('content')
                    }
                }
            );


            const result = await response.json();


            Swal.fire({

                icon: result.success ?
                    'success' :
                    'error',

                title: result.title,

                text: result.msg
            });


            if (result.success) {

                window.tableHistoryDetail.replaceData();


                document.getElementById(
                    'id_bayar_detail'
                ).value = '';


                if (tableDetailBayar) {
                    tableDetailBayar.clearData();
                }


                selectedHistoryBayar = null;
            }


        } catch (error) {

            console.error(error);

            Swal.fire({

                icon: 'error',

                title: 'Error',

                text: error.message
            });
        }
    }


    /* =========================================================
       DETAIL PEMBAYARAN
    ========================================================= */

    function showDetailBayar(id) {

        if (!id) {
            return;
        }

        tableDetailBayar.setData(
            "{{ url('bayar-calon-siswa/detailBayar') }}/" + id
        );
    }


    /* =========================================================
       TABLE DETAIL BAYAR
    ========================================================= */

    function initTableDetailBayar() {

        tableDetailBayar = new Tabulator(
            "#tableDetailBayar", {

                layout: "fitDataStretch",

                height: "500px",

                selectableRows: 1,

                placeholder: "Belum ada data",

                columns: [

                    {
                        title: "No",
                        formatter: "rownum",
                        width: 60,
                        hozAlign: "center"
                    },

                    {
                        title: "Item Bayar",
                        field: "nama_item",
                        minWidth: 200
                    },

                    {
                        title: "Kewajiban",
                        field: "kwajiban_bayar",

                        formatter: function(cell) {

                            return new Intl.NumberFormat(
                                'id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(cell.getValue() || 0);
                        }
                    },

                    {
                        title: "Potongan",
                        field: "potongan",

                        formatter: function(cell) {

                            return new Intl.NumberFormat(
                                'id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(cell.getValue() || 0);
                        }
                    },

                    {
                        title: "Jumlah Bayar",
                        field: "jml_bayar",

                        formatter: function(cell) {

                            return new Intl.NumberFormat(
                                'id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(cell.getValue() || 0);
                        }
                    }
                ]
            }
        );


        tableDetailBayar.on(
            "rowClick",
            function(e, row) {

                selectedDetail = row.getData();
            }
        );
    }


    /* =========================================================
       HAPUS DETAIL PEMBAYARAN
    ========================================================= */

    async function hapusData() {

        if (!selectedDetail) {

            Swal.fire({

                icon: 'warning',

                title: 'Peringatan',

                text: 'Pilih data terlebih dahulu'
            });

            return;
        }


        const result = await Swal.fire({

            title: 'Hapus Data?',

            text: 'Data yang dihapus tidak dapat dikembalikan',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Ya, Hapus',

            cancelButtonText: 'Batal'
        });


        if (!result.isConfirmed) {
            return;
        }


        try {

            const response = await fetch(

                `{{ url('det-bayar-calon-siswa') }}/${selectedDetail.id}`,

                {
                    method: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN': document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            .getAttribute('content'),

                        'Accept': 'application/json'
                    }
                }
            );


            const data = await response.json();


            if (data.success) {

                Swal.fire({

                    icon: 'success',

                    title: data.title,

                    text: data.msg
                });


                showDetailBayar(
                    document.getElementById(
                        'id_bayar_detail'
                    ).value
                );


                selectedDetail = null;


            } else {

                Swal.fire({

                    icon: 'error',

                    title: data.title,

                    text: data.msg
                });
            }


        } catch (error) {

            console.error(error);

            Swal.fire({

                icon: 'error',

                title: 'Error',

                text: error.message
            });
        }
    }


    /* =========================================================
       EDIT DETAIL PEMBAYARAN
    ========================================================= */

    function editData() {

        const selectedRows =
            tableDetailBayar.getSelectedData();


        if (selectedRows.length === 0) {

            Swal.fire({

                icon: 'warning',

                title: 'Peringatan',

                text: 'Pilih data terlebih dahulu'
            });

            return;
        }


        const data = selectedRows[0];


        document.getElementById('id_detail').value =
            data.id ?? '';


        document.getElementById('id_bayar').value =
            data.id_bayar ?? '';


        document.getElementById('kwajiban_bayar').value =
            data.kwajiban_bayar ?? 0;


        document.getElementById('jml_bayar').value =
            data.jml_bayar ?? 0;


        document.getElementById('potongan').value =
            data.potongan ?? 0;


        document.getElementById('id_cicilan').value =
            data.id_cicilan ?? '';


        document.getElementById('keterangan').value =
            data.keterangan ?? '';


        document.getElementById('id_item').value =
            String(data.id_item ?? '');


        // BUKA MODAL TAILWIND
        openModalTambah();
    }


    /* =========================================================
       BUKA MODAL TAMBAH / EDIT ITEM
    ========================================================= */

    function openModalTambah() {

        const modal = document.getElementById(
            'modal-tambah-form'
        );

        if (!modal) {

            console.error(
                'Modal tambah tidak ditemukan'
            );

            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    /* =========================================================
       TUTUP MODAL TAMBAH / EDIT ITEM
    ========================================================= */

    function closeModalTambah() {

        const modal = document.getElementById(
            'modal-tambah-form'
        );

        if (!modal) {
            return;
        }

        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }


    /* =========================================================
       SAVE ITEM BAYAR
    ========================================================= */

    async function saveItemBayar() {

        try {

            const id =
                document.getElementById(
                    'id_detail'
                ).value;


            const formData = {

                id_bayar: document.getElementById(
                    'id_bayar_detail'
                ).value,

                id_item: document.getElementById(
                    'id_item'
                ).value,

                kwajiban_bayar: document.getElementById(
                    'kwajiban_bayar'
                ).value,

                jml_bayar: document.getElementById(
                    'jml_bayar'
                ).value,

                potongan: document.getElementById(
                    'potongan'
                ).value,

                id_cicilan: document.getElementById(
                    'id_cicilan'
                ).value,

                keterangan: document.getElementById(
                    'keterangan'
                ).value
            };


            const url = id ?
                `{{ url('det-bayar-calon-siswa') }}/${id}` :
                `{{ route('det-bayar-calon-siswa.store') }}`;


            const method = id ?
                'PUT' :
                'POST';


            const response = await fetch(
                url, {

                    method: method,

                    headers: {

                        "Content-Type": "application/json",

                        "Accept": "application/json",

                        "X-CSRF-TOKEN": document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            .getAttribute('content')
                    },

                    body: JSON.stringify(formData)
                }
            );


            const result =
                await response.json();


            if (result.success) {

                await Swal.fire({

                    icon: "success",

                    title: result.title,

                    text: result.msg
                });


                // TUTUP MODAL TAILWIND
                closeModalTambah();


                // RESET FORM
                document
                    .getElementById(
                        'form-item'
                    )
                    ?.reset();


                // REFRESH DETAIL
                showDetailBayar(
                    document.getElementById(
                        'id_bayar_detail'
                    ).value
                );


                selectedDetail = null;


            } else {

                Swal.fire({

                    icon: "error",

                    title: result.title,

                    text: result.msg
                });
            }


        } catch (error) {

            console.error(error);

            Swal.fire({

                icon: "error",

                title: "Terjadi Kesalahan",

                text: error.message ||
                    "Gagal menyimpan data."
            });
        }
    }


    /* =========================================================
       SAVE HISTORY BAYAR
    ========================================================= */

    async function saveHistoryBayar() {

        try {

            const id =
                document.getElementById(
                    'id_bayar_history'
                ).value;


            const formData = {

                tgl_bayar: document.getElementById(
                    'tgl_bayar_history'
                ).value ?? '',

                no_kwitansi: document.getElementById(
                    'no_kwitansi_history'
                ).value ?? '',

                keterangan: document.getElementById(
                    'keterangan'
                ).value ?? ''
            };


            console.log(formData);


            if (!id) {

                Swal.fire({

                    icon: 'warning',

                    title: 'Peringatan',

                    text: 'ID pembayaran tidak ditemukan'
                });

                return;
            }


            const response = await fetch(

                `{{ url('det-bayar-calon-siswa') }}/${id}`,

                {

                    method: 'PUT',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': document
                            .querySelector(
                                'meta[name="csrf-token"]'
                            )
                            .getAttribute('content')
                    },

                    body: JSON.stringify(formData)
                }
            );


            const result =
                await response.json();


            if (result.success) {

                await Swal.fire({

                    icon: 'success',

                    title: result.title,

                    text: result.msg
                });


                // TUTUP MODAL TAILWIND
                closeModalUpdateHistory();


                // REFRESH TABLE
                window.tableHistoryDetail
                    .replaceData();


                selectedHistoryBayar = null;


            } else {

                Swal.fire({

                    icon: 'error',

                    title: result.title,

                    text: result.msg
                });
            }


        } catch (error) {

            console.error(error);

            Swal.fire({

                icon: 'error',

                title: 'Terjadi Kesalahan',

                text: error.message
            });
        }
    }

    function openModalTambah() {

        const modal = document.getElementById('modal-tambah-form');

        if (!modal) {
            console.error('Modal modal-tambah-form tidak ditemukan');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function lihatBuktiBayar(namaFile) {

        if (!namaFile) {
            return;
        }

        const url =
            "{{ asset('storage/app/public') }}/" +
            namaFile;

        window.open(
            url,
            '_blank'
        );

    }
</script>