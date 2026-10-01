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


    /* =========================================================
       MODAL BULANAN ALL SISWA
    ========================================================== */

    function openModalBulananAllSiswa() {

        const modal =
            document.getElementById('modal-bulanan-all-siswa');

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
            document.getElementById('modal-bulanan-all-siswa');

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

            ajaxURL: "{{ route('bayar-calon-siswa.data') }}",

            selectableRows: 1,

            pagination: true,

            paginationSize: 10,

            layout: "fitDataStretch",

            columns: [

                {
                    title: "No",
                    formatter: "rownum",
                    width: 60
                },

                {
                    title: "No Daftar",
                    field: "no_daftar"
                },

                {
                    title: "Nama",
                    field: "nama_lengkap"
                },

                {
                    title: "Status",
                    field: "status_daftar"
                },

                {
                    title: "Jurusan",
                    field: "jurusan.nama_jurusan"
                },

                {
                    title: "Tahun",
                    field: "tahun_ajaran.thn_ajaran"
                }

            ]
        });


        tableSiswa.on("rowClick", function(e, row) {

            const data = row.getData();

            console.log('data', data.no_daftar);


            document.getElementById(
                'id_calon_siswa_detail'
            ).value = data.no_daftar ?? '';


            document.getElementById(
                'id_calon_siswa_cicilan'
            ).value = data.no_daftar ?? '';


            document.getElementById(
                'nama_siswa_detail'
            ).value = data.nama_lengkap ?? '';


            document.getElementById(
                'jurusan_siswa_detail'
            ).value =
                data.jurusan?.nama_jurusan ?? '';


            document.getElementById(
                'id_calon_siswa'
            ).value = data.no_daftar ?? '';


            selectedSiswaId =
                data.no_daftar ?? null;


            showDetail(data.no_daftar);

        });
    }


    /* =========================================================
       TABLE HISTORY
    ========================================================== */

    function initTableHistory() {

        tableDetail = new Tabulator(
            "#tableHistoryBayar",
            {

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

                        let holder =
                            row.getElement()
                               .querySelector(".detail-holder");


                        if (holder) {

                            holder.remove();

                            cell.getElement().innerHTML =
                                "<span style='font-size:18px'>+</span>";

                            return;
                        }


                        let detailDiv =
                            document.createElement("div");

                        detailDiv.classList.add(
                            "detail-holder"
                        );

                        detailDiv.style.padding = "10px";


                        let tableDiv =
                            document.createElement("div");


                        detailDiv.appendChild(tableDiv);


                        row.getElement().appendChild(
                            detailDiv
                        );


                        cell.getElement().innerHTML =
                            "<span style='font-size:18px'>-</span>";


                        new Tabulator(tableDiv, {

                            ajaxURL:
                                "{{ url('/bayar-calon-siswa/detailBayar') }}/" +
                                data.id,

                            layout: "fitColumns",

                            placeholder:
                                "Tidak ada detail pembayaran",

                            columns: [

                                {
                                    title: "Item Bayar",
                                    field: "nama_item"
                                },

                                {
                                    title: "Kewajiban",
                                    field: "kwajiban_bayar",

                                    formatter: function(cell) {

                                        return new Intl.NumberFormat(
                                            'id-ID',
                                            {
                                                style: 'currency',
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }
                                        ).format(
                                            cell.getValue() || 0
                                        );
                                    }
                                },

                                {
                                    title: "Potongan",
                                    field: "potongan",

                                    formatter: function(cell) {

                                        return new Intl.NumberFormat(
                                            'id-ID',
                                            {
                                                style: 'currency',
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }
                                        ).format(
                                            cell.getValue() || 0
                                        );
                                    }
                                },

                                {
                                    title: "Jumlah Bayar",
                                    field: "jml_bayar",

                                    formatter: function(cell) {

                                        return new Intl.NumberFormat(
                                            'id-ID',
                                            {
                                                style: 'currency',
                                                currency: 'IDR',
                                                minimumFractionDigits: 0
                                            }
                                        ).format(
                                            cell.getValue() || 0
                                        );
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

                            let value =
                                cell.getValue();

                            if (!value) {
                                return "";
                            }

                            let date =
                                new Date(value);

                            return String(
                                date.getDate()
                            ).padStart(2, '0') +
                            "-" +
                            String(
                                date.getMonth() + 1
                            ).padStart(2, '0') +
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
                                'id-ID',
                                {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(
                                cell.getValue() || 0
                            );
                        }
                    },

                    {
                        title: "Total Kewajiban",
                        field: "total_kwajiban",
                        hozAlign: "right",

                        formatter: function(cell) {

                            return new Intl.NumberFormat(
                                'id-ID',
                                {
                                    style: 'currency',
                                    currency: 'IDR',
                                    minimumFractionDigits: 0
                                }
                            ).format(
                                cell.getValue() || 0
                            );
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

            document.getElementById(
                'id_bayar'
            ).value = data.id;

        });
    }


    /* =========================================================
       SHOW DETAIL
    ========================================================== */

    function showDetail(id) {

        currentTemplateId = id;

        document.getElementById(
            'id_bayar'
        ).value = '';


        tableDetail.setData(
            "{{ url('bayar-calon-siswa/detail') }}/" + id
        );


        if (window.tableHistoryDetail) {

            window.tableHistoryDetail.setData(
                "{{ url('bayar-calon-siswa/detail') }}/" + id
            );

        }
    }


    /* =========================================================
       MODAL BAYAR
    ========================================================== */

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
            document.getElementById('modal-bayar-form');


        if (!modal) {

            console.error(
                'Modal pembayaran tidak ditemukan'
            );

            return;
        }


        modal.classList.remove('hidden');

        modal.classList.add('flex');
    }


    function closeModalBayar() {

        const modal =
            document.getElementById('modal-bayar-form');


        if (!modal) {
            return;
        }


        modal.classList.remove('flex');

        modal.classList.add('hidden');
    }


    /* =========================================================
       MODAL CICILAN
    ========================================================== */

    function openModalCicilan() {

        let id_calon_siswa =
            document.getElementById(
                'id_calon_siswa'
            ).value;


        if (!id_calon_siswa) {

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


        modal.classList.remove('hidden');

        modal.classList.add('flex');
    }


    function closeModalCicilan() {

        const modal =
            document.getElementById(
                'modal-cicilan-form'
            );


        if (!modal) {
            return;
        }


        modal.classList.remove('flex');

        modal.classList.add('hidden');
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


        tombol.disabled = true;


        tombol.innerHTML = `
            <span
                class="animate-spin inline-block
                       w-4 h-4
                       border-2 border-white
                       border-t-transparent
                       rounded-full mr-2">
            </span>
            Mohon tunggu...
        `;


        try {

            const url =
                "{{ route('bayar-calon-siswa.set-lunas', ':id') }}"
                .replace(':id', id);


            const response =
                await fetch(url, {

                    method: 'POST',

                    headers: {

                        'Content-Type':
                            'application/json',

                        'X-CSRF-TOKEN':
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content

                    },

                    body: JSON.stringify({

                        tgl_bayar:
                            document.getElementById(
                                'tgl_bayar'
                            ).value,

                        no_kwitansi:
                            document.getElementById(
                                'no_kwitansi'
                            ).value,

                        keterangan:
                            document.getElementById(
                                'keterangan'
                            ).value

                    })

                });


            const result =
                await response.json();


            Swal.fire({

                icon: result.success
                    ? "success"
                    : "error",

                title: result.title,

                text: result.msg

            });


            if (result.success) {

                closeModalBayar();

                tableDetail.replaceData();

            }


        } catch (error) {

            console.error(error);


            Swal.fire({

                icon: "error",

                title: "Error",

                text:
                    "Terjadi kesalahan saat menyimpan pembayaran"

            });

        } finally {

            tombol.disabled = false;

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

            const response =
                await fetch(
                    '{{ route("bayar-calon-siswa.simpanCicilan") }}',
                    {

                        method: 'POST',

                        headers: {

                            'Content-Type':
                                'application/json',

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).getAttribute('content'),

                            'Accept':
                                'application/json'

                        },

                        body: JSON.stringify({

                            id_bukti:
                                document.getElementById(
                                    'id_bukti'
                                )?.value ?? 0,

                            id_csiswa:
                                document.getElementById(
                                    'id_calon_siswa_cicilan'
                                ).value,

                            tgl_bayar:
                                document.getElementById(
                                    'tgl_bayar'
                                ).value,

                            no_kwitansi:
                                document.getElementById(
                                    'no_kwitansi'
                                ).value,

                            keterangan:
                                document.getElementById(
                                    'keterangan'
                                ).value,

                            jml_pendaftaran:
                                document.getElementById(
                                    'jml_pendaftaran'
                                ).value || 0,

                            jml_dpp:
                                document.getElementById(
                                    'jml_dpp'
                                ).value || 0,

                            jml_mos:
                                document.getElementById(
                                    'jml_mos'
                                ).value || 0,

                            jml_seragam:
                                document.getElementById(
                                    'jml_seragam'
                                ).value || 0

                        })

                    }
                );


            const result =
                await response.json();


            if (result.success) {

                Swal.fire({

                    icon: "success",

                    title: result.title,

                    text: result.msg

                });


                closeModalCicilan();


                tableDetail.replaceData();


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

                text:
                    "Terjadi kesalahan saat menyimpan data"

            });


        } finally {

            button.disabled = false;

            buttonText.innerHTML =
                originalText;

        }

    }


    /* =========================================================
       SAVE CICILAN BUKTI BAYAR
    ========================================================== */

    async function saveCicilanBuktiBayar() {

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

            const response =
                await fetch(
                    '{{ route("bayar-calon-siswa.simpanCicilan") }}',
                    {

                        method: 'POST',

                        headers: {

                            'Content-Type':
                                'application/json',

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).getAttribute('content'),

                            'Accept':
                                'application/json'

                        },

                        body: JSON.stringify({

                            id_bukti:
                                document.getElementById(
                                    'id_bukti'
                                ).value,

                            id_csiswa:
                                document.getElementById(
                                    'id_calon_siswa_cicilan'
                                ).value,

                            tgl_bayar:
                                document.getElementById(
                                    'tgl_bayar'
                                ).value,

                            no_kwitansi:
                                document.getElementById(
                                    'no_kwitansi'
                                ).value,

                            keterangan:
                                document.getElementById(
                                    'keterangan'
                                ).value,

                            jml_pendaftaran:
                                document.getElementById(
                                    'jml_pendaftaran'
                                ).value || 0,

                            jml_dpp:
                                document.getElementById(
                                    'jml_dpp'
                                ).value || 0,

                            jml_mos:
                                document.getElementById(
                                    'jml_mos'
                                ).value || 0,

                            jml_seragam:
                                document.getElementById(
                                    'jml_seragam'
                                ).value || 0

                        })

                    }
                );


            const result =
                await response.json();


            if (result.success) {

                Swal.fire({

                    icon: "success",

                    title: result.title,

                    text: result.msg

                });


                closeModalCicilan();


                tableDetail.replaceData();


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

                text:
                    "Terjadi kesalahan saat menyimpan data"

            });


        } finally {

            button.disabled = false;

            buttonText.innerHTML =
                originalText;

        }

    }


    /* =========================================================
       GENERATE TAGIHAN BULANAN
    ========================================================== */

    async function saveDefBulan() {

        try {

            const response =
                await fetch(
                    "{{ route('bayar-calon-siswa.setDefBulan') }}",
                    {

                        method: "POST",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "X-CSRF-TOKEN":
                                "{{ csrf_token() }}",

                            "Accept":
                                "application/json"

                        },

                        body: JSON.stringify({

                            id_thn_ajaran:
                                document.getElementById(
                                    'id_thn_ajaran'
                                ).value,

                            id_jurusan:
                                document.getElementById(
                                    'id_jurusan'
                                ).value,

                            id_tahun:
                                document.getElementById(
                                    'id_tahun'
                                ).value,

                            id_bulan:
                                document.getElementById(
                                    'id_bulan'
                                ).value

                        })

                    }
                );


            const result =
                await response.json();


            console.log(result);


            if (result.success) {

                Swal.fire({

                    icon: "success",

                    title: result.title,

                    text: result.msg

                });


                closeModalBulananAllSiswa();


                if (tableSiswa) {

                    tableSiswa.replaceData();

                }


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

                text:
                    error.message

            });

        }

    }


    /* =========================================================
       FILTER
    ========================================================== */

    function applyFilter() {

        tableSiswa.setData(
            "{{ route('bayar-calon-siswa.data') }}",
            {

                tahun:
                    document.getElementById(
                        'filter_tahun'
                    ).value,

                jurusan:
                    document.getElementById(
                        'filter_jurusan'
                    ).value,

                kelas:
                    document.getElementById(
                        'filter_kelas'
                    ).value,

                keyword:
                    document.getElementById(
                        'filter_keyword'
                    ).value

            }
        );

    }


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
            "{{ url('/bayar-calon-siswa/createReportPdf') }}";


        window.open(
            `${cetakUrl}/${selectedSiswaId}`,
            '_blank'
        );

    }

</script>