<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    //const tableHistoryDetail = window.tableHistoryDetail;
    let tableDetailBayar;
    document.addEventListener("DOMContentLoaded", function() {

        initTableDetailHistory();
        initTableDetailBayar();



        // initFilter();

    });

    let selectedHistoryBayar = null;


    function initTableDetailHistory() {

        window.tableHistoryDetail = new Tabulator(
            "#tableHistoryBayarDetail", {
                layout: "fitDataStretch",
                height: "500px",
                selectableRows: 1,

                columns: [{
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

                            if (!value) return "";

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
                       // hozAlign: "right",
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
                        field: "tot_kwajiban",
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
                    }
                ]
            }
        );

        window.tableHistoryDetail.on("rowClick", function(e, row) {

            let data = row.getData();

            console.log(data.id);

            document.getElementById('id_bayar_detail').value = data.id;
            showDetailBayar(data.id);
                            selectedHistoryBayar = row.getData();


            //editHistoryBayar(selectedHistoryBayar);

        });
    }

    

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
        selectedHistoryBayar.id;

    // Jika tgl_bayar dari database format YYYY-MM-DD
        document.getElementById('tgl_bayar_history').value =
            selectedHistoryBayar.tgl_bayar ?? '';

        document.getElementById('no_kwitansi_history').value =
            selectedHistoryBayar.no_kwitansi ?? '';

        document.getElementById('keterangan').value =
            selectedHistoryBayar.keterangan ?? '';

        tailwind.Modal
            .getOrCreateInstance(
                document.getElementById('modal-update-history-form')
            )
            .show();

        // tampilkan modal edit
    }

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
                    `{{ url('bayar') }}/${selectedHistoryBayar.id}`,
                    {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    }
                );

                const result = await response.json();

                Swal.fire({
                    icon: result.success ? 'success' : 'error',
                    title: result.title,
                    text: result.msg
                });

                if (result.success) {

                    tableHistoryDetail.replaceData();

                    document.getElementById('id_bayar_detail').value = '';

                    document.getElementById('tableDetailBayar')
                        ?.tabulator?.clearData?.();
                }

            } catch (error) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message
                });

            }
    }

    async function setRegistrasi() {

        const id_bayar = document.getElementById('id_bayar_detail').value;
        const nipd = document.getElementById('nipd_detail').value;

        if (!id_bayar) {

            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Pilih history pembayaran terlebih dahulu'
            });

            return;
        }

        const konfirmasi = await Swal.fire({
            icon: 'question',
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin melakukan Set Registrasi?',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        });

        if (!konfirmasi.isConfirmed) {
            return;
        }

        try {

            const response = await fetch(
                "{{ route('det-bayar.set-regis') }}",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        id_bayar: id_bayar,
                        nipd: nipd
                    })
                }
            );

            const result = await response.json();

            Swal.fire({
                icon: result.success ? 'success' : 'error',
                title: result.title,
                text: result.msg
            });

            if (result.success) {
                showDetailBayar(id_bayar);
            }

        } catch (error) {

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });

        }
    }


    function showDetailBayar(id) {
        tableDetailBayar.setData(
            "{{ url('bayar/detailBayar') }}/" + id
        );
    }

    let selectedDetail = null;

    function initTableDetailBayar() {
        tableDetailBayar = new Tabulator("#tableDetailBayar", {

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
                 //   hozAlign: "right",
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
                 //   hozAlign: "right",
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
        });

        tableDetailBayar.on("rowClick", function(e, row) {

                selectedDetail = row.getData();

            });

      

    }

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
                `{{ url('det-bayar') }}/${selectedDetail.id}`,
                {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
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
                    document.getElementById('id_bayar_detail').value
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

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });

        }

    }

    function editData() {

    const selectedRows = tableDetailBayar.getSelectedData();

    if (selectedRows.length === 0) {

        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Pilih data terlebih dahulu'
        });

        return;
    }

    const data = selectedRows[0];

        document.getElementById('id_detail').value = data.id;
        document.getElementById('id_bayar').value = data.id_bayar;

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
        
        document.getElementById('id_item').value = String(data.id_item);

        const modal = tailwind.Modal.getOrCreateInstance(
            document.getElementById('modal-tambah-form')
        );

        modal.show();
    }

    async function saveItemBayar() {

        try {
            const id = document.getElementById('id_detail').value;
            const formData = {
                id_bayar: document.getElementById('id_bayar_detail').value,
                id_item: document.getElementById('id_item').value,
                kwajiban_bayar: document.getElementById('kwajiban_bayar').value,
                jml_bayar: document.getElementById('jml_bayar').value,
                potongan: document.getElementById('potongan').value,
                id_cicilan: document.getElementById('id_cicilan').value,
                keterangan: document.getElementById('keterangan').value
            };
          //  console.log(formData);

            const url = id
                ? `{{ url('det-bayar') }}/${id}`
                : `{{ route('det-bayar.store') }}`;

                    const method = id ? 'PUT' : 'POST';
            
            const response = await fetch(
                url,
                {
                    method: method,
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                }
            );
//console.log(response.status);
            const result = await response.json();

            if (result.success) {
             
                 Swal.fire({
                    icon: "success",
                    title: result.title,
                    text: result.msg
                });

                const modal =
                    tailwind.Modal.getInstance(
                        document.getElementById('modal-tambah-form')
                    );

                modal.hide();

                document.getElementById('form-item').reset();

                // reload tabel
               // tableHistoryDetail.replaceData();

      tableDetailBayar.setData(
            "{{ url('bayar/detailBayar') }}/" + document.getElementById('id_bayar_detail').value
        );

            } else {

                Swal.fire({
                    icon: "error",
                    title: result.title,
                    text: result.msg
                });

            }

        } catch (error) {

            console.error(error);

            console.log("Error:", error);

            Swal.fire({
                icon: "error",
                title: "Terjadi Kesalahan",
                text: error || "Gagal menyimpan data."
            });

        }

    }


    async function saveHistoryBayar() {

        try {

            const id = document.getElementById('id_bayar_history').value;

            const formData = {
                tgl_bayar: document.getElementById('tgl_bayar_history').value ?? '',
                no_kwitansi: document.getElementById('no_kwitansi_history').value ?? '',
                keterangan: document.getElementById('keterangan').value ?? ''
            };

            console.log(formData);
            

            const response = await fetch(
                `{{ url('bayar') }}/${id}`,
                {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                }
            );

            const result = await response.json();

            if (result.success) {

                Swal.fire({
                    icon: 'success',
                    title: result.title,
                    text: result.msg
                });

                const modal = tailwind.Modal.getInstance(
                    document.getElementById('modal-update-history-form')
                );

                if (modal) {
                    modal.hide();
                }

                // refresh tabel history
                tableHistoryDetail.replaceData();

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

       
</script>