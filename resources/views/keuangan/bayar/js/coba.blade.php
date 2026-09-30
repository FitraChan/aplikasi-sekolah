<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let tableSiswa = new Tabulator("#tableBayar", {

        ajaxURL: "{{ route('bayar.data') }}",
        selectableRows: 1,
        pagination: true,
        paginationMode: "remote",
        paginationSize: 10,

        layout: "fitDataStretch",
        height: "500px",


        columns: [

            {
                title: "No",
                formatter: "rownum",
                width: 60,
                hozAlign: "center"
            },

            {
                title: "NIPD",
                field: "nipd"
            },
            {
                title: "Nama Siswa",
                field: "nama_lengkap",
                width: 250
            },
            {
                title: "Kelas",
                field: "kelas.nama_kelas"
            },
            {
                title: "Tahun",
                field: "tahun_ajaran.thn_ajaran"
            },
        ]
    });

    let selectedSiswaId = null;
    let currentTemplateId = 0;
    tableSiswa.on("rowClick", function(e, row) {
        document.getElementById('nipd').value = row.getData().nipd;

            selectedSiswaId = row.getData().nipd; // atau id_siswa
        showDetail(row.getData().nipd);
    });

    function cetakKewajiban() {

        if (!selectedSiswaId) {
            alert('Pilih siswa terlebih dahulu');
            return;
        }
        const cetakUrl = "{{ url('/bayar/createReportPdf') }}";
        window.open(`${cetakUrl}/${selectedSiswaId}`, '_blank');
    }


    let detailLoaded = {};

    let tableDetail = new Tabulator("#tableHistoryBayar", {

        layout: "fitDataStretch",
        height: "500px",
        selectableRows: 1,

       

        title: "<button class='btn btn-primary btn-sm'>Tambah</button>",


        rowHeader: {
            formatter: function(cell) {
                return "<span style='font-size:18px'>+</span>";
            },
            width: 50,
            hozAlign: "center",
            cellClick: function(e, cell) {

                let row = cell.getRow();
                let data = row.getData();

                let holder = row.getElement().querySelector(".detail-holder");

                if (holder) {
                    holder.remove();
                    cell.getElement().innerHTML =

                        "<span style='font-size:18px'>+</span>";
                    return;
                }

                let detailDiv = document.createElement("div");
                detailDiv.classList.add("detail-holder");
                detailDiv.style.padding = "10px";

                let tableDiv = document.createElement("div");

                detailDiv.appendChild(tableDiv);

                row.getElement().appendChild(detailDiv);

                cell.getElement().innerHTML =
                    "<span style='font-size:18px'>-</span>";

                new Tabulator(tableDiv, {

                    ajaxURL: "{{ url('/bayar/detailBayar') }}/" + data.id,
                    layout: "fitColumns",

                    placeholder: "Tidak ada detail pembayaran",

                    columns: [{
                            title: "Item Bayar",
                            field: "nama_item",

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
                });
            }
        },

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
    });


     tableDetail.on("rowClick", function(e, row) {

        let data = row.getData();

        console.log(data.id);

    document.getElementById('id_bayar').value = data.id;
    })



    function showDetail(id) {
        currentTemplateId = id;

        document.getElementById('id_bayar').value = "";
        console.log(id);
        tableDetail.setData(
            "{{ url('bayar/detail') }}/" + id
        );

    }

    function saveData() {
        let id = document.getElementById('id').value;

        let isEdit = id != '';

        let url = isEdit ?
            "{{ url('template-bayar/update') }}/" + id :
            "{{ url('template-bayar/store') }}";

        fetch(url, {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({

                    id_tahun: document.getElementById('id_tahun').value,

                    id_jurusan: document.getElementById('id_jurusan').value,

                    id_gelombang: document.getElementById('id_gelombang').value,

                    jns_kelas: document.getElementById('jns_kelas').value,

                    keterangan: document.getElementById('keterangan').value,

                    sts: document.getElementById('sts').value

                })

            })
            .then(res => res.json())
            .then(res => {

                const modal =
                    tailwind.Modal.getOrCreateInstance(
                        document.querySelector("#modal-form")
                    );

                modal.hide();

                table.replaceData();

            })
            .catch(err => {

                console.log(err);

            });
    }

    function editTemplateBayar(data) {
        document.getElementById('id').value =
            data.id ?? '';

        document.getElementById('id_tahun').value =
            data.id_tahun ?? '';

        document.getElementById('id_jurusan').value =
            data.id_jurusan ?? '';

        document.getElementById('id_gelombang').value =
            data.id_gelombang ?? '';

        document.getElementById('jns_kelas').value =
            data.jns_kelas ?? '';

        document.getElementById('keterangan').value =
            data.keterangan ?? '';

        document.getElementById('sts').value =
            data.sts ?? 1;
    }

    function deleteTemplateBayar(id) {
        if (confirm('Hapus data?')) {

            fetch(
                    "{{ url('template-bayar/delete') }}/" + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                )
                .then(res => res.json())
                .then(res => {
                    table.replaceData();
                    alert('Berhasil dihapus');
                })
                .catch(err => {
                    console.log(err);
                    alert('Gagal menghapus data');
                });
        }
    }


    function saveDetail() {

        let idDetail = document.getElementById('id_detail').value;

        let url = idDetail ?
            "{{ url('template-bayar-detail/updateDetail') }}/" + idDetail :
            "{{ route('template-bayar-detail.storeDetail') }}";

        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    id_template: currentTemplateId,
                    id_item: document.getElementById('id_item').value,
                    jml_bayar: document.getElementById('jml_bayar').value,
                    ket_bayar: document.getElementById('ket_bayar').value
                })
            })
            .then(response => response.json())
            .then(response => {

                const modal = tailwind.Modal.getOrCreateInstance(
                    document.querySelector("#modal-detail-form")
                );

                modal.hide();

                // reset form
                document.getElementById('id_detail').value = '';
                document.getElementById('id_item').value = '';
                document.getElementById('jml_bayar').value = '';
                document.getElementById('ket_bayar').value = '';

                tableDetail.setData(
                    "{{ url('template-bayar/detail') }}/" + currentTemplateId
                );

                toastr.success(response.msg);

            })
            .catch(error => {
                console.error(error);
                toastr.error('Terjadi kesalahan');
            });
    }

    function editDetail(row) {

        document.getElementById('id_detail').value = row.id;
        document.getElementById('id_item').value = row.id_item;
        document.getElementById('jml_bayar').value = row.jml_bayar;
        document.getElementById('ket_bayar').value = row.ket_bayar ?? '';

        const modal = tailwind.Modal.getOrCreateInstance(
            document.querySelector("#modal-detail-form")
        );

        modal.show();
    }

    function deleteDetail(id) {

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        fetch("{{ url('template-bayar-detail/deleteDetail') }}/" + id, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(response => response.json())
            .then(response => {

                tableDetail.setData(
                    "{{ url('template-bayar/detail') }}/" + currentTemplateId
                );


            })
            .catch(error => {

                console.error(error);


            });
    }

    async function saveDefBulan() {

        try {

            const response = await fetch(
                "{{ route('bayar.setDefBulan') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        id_thn_ajaran: document.getElementById('id_thn_ajaran').value,
                        id_jurusan: document.getElementById('id_jurusan').value,
                        id_tahun: document.getElementById('id_tahun').value,
                        id_bulan: document.getElementById('id_bulan').value
                    })
                }
            );

            const result = await response.json();

            console.log(result);

            if (result.success) {

                Swal.fire({
                    icon: "success",
                    title: result.title,
                    text: result.msg
                });

                // tutup modal
                const modal = tailwind.Modal.getInstance(
                    document.querySelector("#modal-bulanan-all-siswa")
                );

                if (modal) {
                    modal.hide();
                }

                // reload tabulator jika perlu
                if (typeof table !== 'undefined') {
                    table.replaceData();
                }

            } else {

                Swal.fire({
                    icon: "error",
                    title: result.title,
                    text: result.msg
                });

            }

        } catch (error) {

            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.message
            });

            console.error(error);
        }
    }

    function applyFilter() {

        let tahun = $('#filter_tahun').val();
        let jurusan = $('#filter_jurusan').val();
        let kelas = $('#filter_kelas').val().toLowerCase();
        let keyword = $('#filter_keyword').val().toLowerCase();

        tableSiswa.setFilter(function(data) {

            console.log(data);


            let matchTahun = !tahun ||
                (data.tahun_ajaran &&
                    data.tahun_ajaran.thn_ajaran == tahun);

            let matchJurusan = !jurusan ||
                (data.jurusan &&
                    data.jurusan.nama_jurusan == jurusan);

            let matchKelas = !kelas ||
                (data.kelas &&
                    data.kelas.nama_kelas.toLowerCase()
                    .includes(kelas));

            let matchKeyword = !keyword ||
                (data.nama_lengkap &&
                    data.nama_lengkap.toLowerCase()
                    .includes(keyword)) ||
                (data.nipd &&
                    data.nipd.toLowerCase()
                    .includes(keyword));

            return matchTahun &&
                matchJurusan &&
                matchKelas &&
                matchKeyword;
        });
    }

    document
        .getElementById('filter_tahun')
        .addEventListener('change', applyFilter);

    document
        .getElementById('filter_jurusan')
        .addEventListener('change', applyFilter);

    document
        .getElementById('filter_kelas')
        .addEventListener('keyup', applyFilter);

    document
        .getElementById('filter_keyword')
        .addEventListener('keyup', applyFilter);

    function resetFilter() {

        document.getElementById('filter_tahun').value = '';
        document.getElementById('filter_jurusan').value = '';
        document.getElementById('filter_kelas').value = '';
        document.getElementById('filter_keyword').value = '';

        tableSiswa.clearFilter();
    }

    async function saveBayar() {

        let id = document.getElementById('id_bayar').value;

        const url = "{{ route('bayar.set-lunas', ':id') }}".replace(':id', id);

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]'
                ).content
            },
            body: JSON.stringify({
                tgl_bayar: document.getElementById('tgl_bayar').value,
                no_kwitansi: document.getElementById('no_kwitansi').value,
                keterangan: document.getElementById('keterangan').value
            })
        });

        const result = await response.json();

                Swal.fire({
                    icon: "success",
                    title: result.title,
                    text: result.msg
                });
 const modal = tailwind.Modal.getOrCreateInstance(
                    document.querySelector("#modal-bayar-form")
                );

                modal.hide();
        tableDetail.replaceData();

    }

    function openModalBayar() {

        let idBayar = document.getElementById('id_bayar').value;

        if (!idBayar) {

           Swal.fire(
                'Peringatan',
                'Pilih data pembayaran terlebih dahulu',
                'warning'
        );

            return;
        }

        const modal = tailwind.Modal.getOrCreateInstance(
            document.querySelector("#modal-bayar-form")
        );

        modal.show();
    }

    function openModalCicilan() {

        let nipd = document.getElementById('nipd').value;

        if (!nipd) {

           Swal.fire(
                'Peringatan',
                'Pilih data siswa terlebih dahulu',
                'warning'
        );

            return;
        }

        const modal = tailwind.Modal.getOrCreateInstance(
            document.querySelector("#modal-cicilan-form")
        );

        modal.show();
    }


    async function saveCicilan() {

        try {

            const response = await fetch('{{ route("bayar.simpanCicilan") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id_csiswa: document.getElementById('nipd').value,
                    tgl_bayar: document.getElementById('tgl_bayar').value,
                    no_kwitansi: document.getElementById('no_kwitansi').value,
                    keterangan: document.getElementById('keterangan').value,
                    jml_dpp: document.getElementById('jml_dpp').value || 0,
                    jml_seragam: document.getElementById('jml_seragam').value || 0,
                    jml_spp: document.getElementById('jml_spp').value || 0,
                    jml_tabungan: document.getElementById('jml_tabungan').value || 0,
                    jml_osis: document.getElementById('jml_osis').value || 0,
                    //cicilan: document.getElementById('cicilan').value || 0
                })
            });

            const result = await response.json();

            //console.log('hasilllll', result);

            if (result.success) {

                 Swal.fire({
                    icon: "success",
                    title: result.title,
                    text: result.msg
                });

                const modal = tailwind.Modal.getInstance(
                    document.querySelector('#modal-cicilan-form')
                );

                modal.hide();

                // reload tabel jika ada
               // if (typeof table !== 'undefined') {
                    tableDetail.replaceData();
               // }

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
                    title: "Error",
                    text: "Terjadi kesalahan saat menyimpan data"
                });
              
        }
    }
</script>
