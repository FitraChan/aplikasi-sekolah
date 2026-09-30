<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let selectedSiswaId = null;
    let currentTemplateId = 0;

    let tableSiswa;
    let tableDetail;

    document.addEventListener("DOMContentLoaded", function() {

        initTableSiswa();
        initTableHistory();

        // initFilter();

    });

    function initTableSiswa() {

        tableSiswa = new Tabulator("#tableBayar", {

            ajaxURL: "{{ route('bayar.data') }}",

            selectableRows: 1,

            pagination: true,
            // paginationMode: "remote",
            paginationSize: 10,

            layout: "fitDataStretch",
            // height: "500px",

            columns: [

                {
                    title: "No",
                    formatter: "rownum",
                    width: 60
                },

                {
                    title: "NIPD",
                    field: "nipd"
                },

                {
                    title: "Nama",
                    field: "nama_lengkap"
                },

                {
                    title: "Kelas",
                    field: "kelas.nama_kelas"
                },

                {
                    title: "Jurusan",
                    field: "jurusan.nama_jurusan"
                },
                {
                    title: "Tahun",
                    field: "tahun_ajaran.thn_ajaran"
                },

            ]
        });




        tableSiswa.on("rowClick", function(e, row) {

            const data = row.getData();


            document.getElementById('nipd_detail').value =
                data.nipd ?? '';

            document.getElementById('nama_siswa_detail').value =
                data.nama_lengkap ?? '';

            document.getElementById('jurusan_siswa_detail').value =
                data.jurusan.nama_jurusan ?? '';


            document.getElementById('nipd').value =
                row.getData().nipd;

            selectedSiswaId =
                row.getData().nipd;

            showDetail(
                row.getData().nipd
            );

        });
    }


    function initTableHistory() {

        tableDetail = new Tabulator(
            "#tableHistoryBayar", {
                layout: "fitDataStretch",
                height: "500px",
                selectableRows: 1,

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
            }
        );

        tableDetail.on("rowClick", function(e, row) {

            let data = row.getData();

            console.log(data.id);

            document.getElementById('id_bayar').value = data.id;
        });
    }

    function showDetail(id) {

        currentTemplateId = id;
        document.getElementById('id_bayar').value = '';
        tableDetail.setData(
            "{{ url('bayar/detail') }}/" + id
        );

        if (window.tableHistoryDetail) {
            window.tableHistoryDetail.setData(
                "{{ url('bayar/detail') }}/" + id
            );
        }
    }

    function openModalBayar() {

        let idBayar =
            document.getElementById('id_bayar').value;

        if (!idBayar) {

            Swal.fire(
                'Peringatan',
                'Pilih data pembayaran terlebih dahulu',
                'warning'
            );

            return;
        }

        const modal =
            tailwind.Modal.getOrCreateInstance(
                document.querySelector(
                    "#modal-bayar-form"
                )
            );

        modal.show();
    }

    function openModalCicilan() {

        let nipd =
            document.getElementById('nipd').value;

        if (!nipd) {

            Swal.fire(
                'Peringatan',
                'Pilih data siswa terlebih dahulu',
                'warning'
            );

            return;
        }

        const modal =
            tailwind.Modal.getOrCreateInstance(
                document.querySelector(
                    "#modal-cicilan-form"
                )
            );

        modal.show();
    }



    async function saveBayar() {

        const tombol = document.getElementById('btn-save-bayar');
        const teksAwal = tombol.innerHTML;

        let id = document.getElementById('id_bayar').value;

        tombol.disabled = true;
        tombol.innerHTML = `
            <span class="animate-spin inline-block w-4 h-4 border-2 border-white border-t-transparent rounded-full mr-2"></span>
            Mohon tunggu...
        `;

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

         tombol.disabled = false;
        tombol.innerHTML = teksAwal;

    }

    async function saveCicilan() {

        try {

            const button = document.getElementById('btn-save-cicilan');
            const buttonText = document.getElementById('text-save-cicilan');

            // Simpan tampilan awal tombol
            const originalText = buttonText.innerHTML;

            // Ubah tombol menjadi loading
            button.disabled = true;
            buttonText.innerHTML = 'Tunggu sebentar...';

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

                button.disabled = false;
                buttonText.innerHTML = originalText;
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

    async function saveDefBulan() {

        try {
     const tombol = document.getElementById('btn-save-def-bulan');
    const teksAwal = tombol.innerHTML;

            const idThnAjaran = document
                .getElementById('id_thn_ajaran')
                .value
                .trim();

            const idJurusan = document
                .getElementById('id_jurusan')
                .value
                .trim();

            const idTahun = document
                .getElementById('id_tahun')
                .value
                .trim();

            const idBulan = document
                .getElementById('id_bulan')
                .value
                .trim();

            if (
                idThnAjaran === '' ||
                idJurusan === '' ||
                idTahun === '' ||
                idBulan === ''
            ) {
                alert('Semua data wajib diisi.');
                return;
            }

            if (idTahun.length !== 4) {
                alert('Tahun harus terdiri dari 4 digit.');
                document.getElementById('id_tahun').focus();
                return;
            }
 tombol.disabled = true;
        tombol.innerHTML = 'Mohon tunggu...';

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

                        // Kembalikan tombol setelah proses selesai atau gagal
                tombol.disabled = false;
                tombol.innerHTML = teksAwal;


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

        tableSiswa.setData("{{ route('bayar.data') }}", {
            tahun: document.getElementById('filter_tahun').value,
            jurusan: document.getElementById('filter_jurusan').value,
            kelas: document.getElementById('filter_kelas').value,
            keyword: document.getElementById('filter_keyword').value
        });
    }

    // document
    //     .getElementById('filter_tahun')
    //     .addEventListener('change', applyFilter);

    // document
    //     .getElementById('filter_jurusan')
    //     .addEventListener('change', applyFilter);

    // document
    //     .getElementById('filter_kelas')
    //     .addEventListener('keyup', applyFilter);

    // document
    //     .getElementById('filter_keyword')
    //     .addEventListener('keyup', applyFilter);

    function resetFilter() {

        document.getElementById('filter_tahun').value = '';
        document.getElementById('filter_jurusan').value = '';
        document.getElementById('filter_kelas').value = '';
        document.getElementById('filter_keyword').value = '';

        tableSiswa.clearFilter();
    }

    function cetakKewajiban() {

        if (!selectedSiswaId) {
            alert('Pilih siswa terlebih dahulu');
            return;
        }
        const cetakUrl = "{{ url('/bayar/createReportPdf') }}";
        window.open(`${cetakUrl}/${selectedSiswaId}`, '_blank');
    }
</script>