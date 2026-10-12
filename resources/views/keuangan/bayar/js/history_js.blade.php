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

        tableSiswa = new Tabulator(
            "#tableBayar",
            {

                ajaxURL:
                    "{{ route('bayar.data') }}",

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
                        title: "NIPD",
                        field: "nipd"
                    },

                    {
                        title: "Nama",
                        field: "nama_lengkap",
                         width: 150
                    },

                    {
                        title: "Kelas",
                        field: "kelas.nama_kelas",
                         width: 100

                    },

                    // {
                    //     title: "Jurusan",
                    //     field: "jurusan.nama_jurusan"
                    // },

                    {
                        title: "Tahun",
                        field: "tahun_ajaran.thn_ajaran",
                        
                    }

                ]

            }
        );


        tableSiswa.on(
            "rowClick",
            function(e, row) {

                const data =
                    row.getData();


                console.log(
                    'data',
                    data.nipd
                );


                document.getElementById(
                    'nipd_detail'
                ).value =
                    data.nipd ?? '';


                document.getElementById(
                    'nama_siswa_detail'
                ).value =
                    data.nama_lengkap ?? '';


                document.getElementById(
                    'jurusan_siswa_detail'
                ).value =
                    data.jurusan?.nama_jurusan ?? '';


                document.getElementById(
                    'nipd'
                ).value =
                    data.nipd ?? '';


                selectedSiswaId =
                    data.nipd ?? null;


                showDetail(
                    data.nipd
                );

            }
        );

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

                        return `
                            <span
                                style="font-size:18px">
                                +
                            </span>
                        `;

                    },


                    width: 50,

                    hozAlign: "center",


                    cellClick: function(e, cell) {

                        let row =
                            cell.getRow();

                        let data =
                            row.getData();


                        let holder =
                            row.getElement()
                               .querySelector(
                                   ".detail-holder"
                               );


                        /*
                        |--------------------------------------------------------------------------
                        | TUTUP DETAIL
                        |--------------------------------------------------------------------------
                        */

                        if (holder) {

                            holder.remove();

                            cell.getElement()
                                .innerHTML = `
                                    <span
                                        style="font-size:18px">
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

                        let detailDiv =
                            document.createElement(
                                "div"
                            );


                        detailDiv.classList.add(
                            "detail-holder"
                        );


                        detailDiv.style.padding =
                            "10px";


                        let tableDiv =
                            document.createElement(
                                "div"
                            );


                        detailDiv.appendChild(
                            tableDiv
                        );


                        row.getElement()
                           .appendChild(
                               detailDiv
                           );


                        cell.getElement()
                            .innerHTML = `
                                <span
                                    style="font-size:18px">
                                    -
                                </span>
                            `;


                        /*
                        |--------------------------------------------------------------------------
                        | DETAIL TABULATOR
                        |--------------------------------------------------------------------------
                        */

                        new Tabulator(
                            tableDiv,
                            {

                                ajaxURL:
                                    "{{ url('/bayar/detailBayar') }}/" +
                                    data.id,

                                layout:
                                    "fitColumns",

                                placeholder:
                                    "Tidak ada detail pembayaran",


                                columns: [

                                    {
                                        title:
                                            "Item Bayar",

                                        field:
                                            "nama_item"

                                    },


                                    {
                                        title:
                                            "Kewajiban",

                                        field:
                                            "kwajiban_bayar",

                                        formatter:
                                            function(cell) {

                                                return new Intl.NumberFormat(
                                                    'id-ID',
                                                    {
                                                        style:
                                                            'currency',

                                                        currency:
                                                            'IDR',

                                                        minimumFractionDigits:
                                                            0
                                                    }
                                                ).format(
                                                    cell.getValue() || 0
                                                );

                                            }

                                    },


                                    {
                                        title:
                                            "Potongan",

                                        field:
                                            "potongan",

                                        formatter:
                                            function(cell) {

                                                return new Intl.NumberFormat(
                                                    'id-ID',
                                                    {
                                                        style:
                                                            'currency',

                                                        currency:
                                                            'IDR',

                                                        minimumFractionDigits:
                                                            0
                                                    }
                                                ).format(
                                                    cell.getValue() || 0
                                                );

                                            }

                                    },


                                    {
                                        title:
                                            "Jumlah Bayar",

                                        field:
                                            "jml_bayar",

                                        formatter:
                                            function(cell) {

                                                return new Intl.NumberFormat(
                                                    'id-ID',
                                                    {
                                                        style:
                                                            'currency',

                                                        currency:
                                                            'IDR',

                                                        minimumFractionDigits:
                                                            0
                                                    }
                                                ).format(
                                                    cell.getValue() || 0
                                                );

                                            }

                                    }

                                ]

                            }
                        );

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

                        formatter:
                            function(cell) {

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

                        formatter:
                            function(cell) {

                                return new Intl.NumberFormat(
                                    'id-ID',
                                    {
                                        style:
                                            'currency',

                                        currency:
                                            'IDR',

                                        minimumFractionDigits:
                                            0
                                    }
                                ).format(
                                    cell.getValue() || 0
                                );

                            }

                    },


                    {
                        title: "Total Kewajiban",

                        field: "tot_kwajiban",

                        hozAlign: "right",

                        formatter:
                            function(cell) {

                                return new Intl.NumberFormat(
                                    'id-ID',
                                    {
                                        style:
                                            'currency',

                                        currency:
                                            'IDR',

                                        minimumFractionDigits:
                                            0
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


        /*
        |--------------------------------------------------------------------------
        | PILIH HISTORY
        |--------------------------------------------------------------------------
        */

        tableDetail.on(
            "rowClick",
            function(e, row) {

                let data =
                    row.getData();


                console.log(
                    data.id
                );


                document.getElementById(
                    'id_bayar'
                ).value =
                    data.id;

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
                    url,
                    {

                        method: 'POST',

                        headers: {

                            'Content-Type':
                                'application/json',

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    'meta[name="csrf-token"]'
                                ).content,

                            'Accept':
                                'application/json'

                        },


                        body:
                            JSON.stringify({

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

                    }
                );


            const result =
                await response.json();


            Swal.fire({

                icon:
                    result.success
                        ? "success"
                        : "error",

                title:
                    result.title,

                text:
                    result.msg

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

                text:
                    "Terjadi kesalahan saat menyimpan pembayaran"

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
                '{{ route("bayar.simpanCicilan") }}',
                {

                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN':
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            ).getAttribute(
                                'content'
                            ),

                        'Accept':
                            'application/json'

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

                title:
                    result.title,

                text:
                    result.msg

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

                title:
                    result.title,

                text:
                    result.msg

            });

        }


    } catch (error) {

        console.error(
            error
        );


        Swal.fire({

            icon: 'error',

            title: 'Error',

            text:
                'Terjadi kesalahan saat menyimpan data'

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

        const tombol =
            document.getElementById(
                'btn-save-def-bulan'
            );


        const teksAwal =
            tombol.innerHTML;


        try {

            const idThnAjaran =
                document
                    .getElementById(
                        'id_thn_ajaran'
                    )
                    .value
                    .trim();


            const idJurusan =
                document
                    .getElementById(
                        'id_jurusan'
                    )
                    .value
                    .trim();


            const idTahun =
                document
                    .getElementById(
                        'id_tahun'
                    )
                    .value
                    .trim();


            const idBulan =
                document
                    .getElementById(
                        'id_bulan'
                    )
                    .value
                    .trim();


            /*
            |--------------------------------------------------------------------------
            | VALIDASI
            |--------------------------------------------------------------------------
            */

            if (
                idThnAjaran === '' ||
                idJurusan === '' ||
                idTahun === '' ||
                idBulan === ''
            ) {

                Swal.fire({

                    icon: "warning",

                    title: "Peringatan",

                    text:
                        "Semua data wajib diisi."

                });

                return;

            }


            if (
                idTahun.length !== 4
            ) {

                Swal.fire({

                    icon: "warning",

                    title: "Peringatan",

                    text:
                        "Tahun harus terdiri dari 4 digit."

                });


                document
                    .getElementById(
                        'id_tahun'
                    )
                    .focus();


                return;

            }


            /*
            |--------------------------------------------------------------------------
            | LOADING
            |--------------------------------------------------------------------------
            */

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


            /*
            |--------------------------------------------------------------------------
            | REQUEST
            |--------------------------------------------------------------------------
            */

            const response =
                await fetch(
                    "{{ route('bayar.setDefBulan') }}",
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


                        body:
                            JSON.stringify({

                                id_thn_ajaran:
                                    idThnAjaran,

                                id_jurusan:
                                    idJurusan,

                                id_tahun:
                                    idTahun,

                                id_bulan:
                                    idBulan

                            })

                    }
                );


            const result =
                await response.json();


            console.log(
                result
            );


            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            if (result.success) {

                Swal.fire({

                    icon: "success",

                    title:
                        result.title,

                    text:
                        result.msg

                });


                closeModalBulananAllSiswa();


                if (tableSiswa) {

                    tableSiswa.replaceData();

                }


            } else {

                Swal.fire({

                    icon: "error",

                    title:
                        result.title,

                    text:
                        result.msg

                });

            }


        } catch (error) {

            console.error(
                error
            );


            Swal.fire({

                icon: "error",

                title: "Error",

                text:
                    error.message

            });


        } finally {

            tombol.disabled =
                false;

            tombol.innerHTML =
                teksAwal;

        }

    }


    /* =========================================================
       FILTER
    ========================================================== */

    function applyFilter() {

        tableSiswa.setData(
            "{{ route('bayar.data') }}",
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

</script>