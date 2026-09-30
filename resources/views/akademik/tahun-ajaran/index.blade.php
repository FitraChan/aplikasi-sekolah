@extends('layout.app')

@section('title', 'Tahun Ajaran')
@section('page_title', 'Tahun Ajaran')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    <!-- ========================================================= -->
    <!-- HEADER -->
    <!-- ========================================================= -->

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <a href="javascript:history.back()"
                    class="inline-flex items-center gap-2
                          text-sm font-medium
                          text-[#02BC9C]
                          hover:text-[#02a387]
                          transition-colors">

                    <svg class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.2"
                        viewBox="0 0 24 24">

                        <line x1="19" x2="5" y1="12" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>

                    </svg>

                    Kembali

                </a>

            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Tahun Ajaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola tahun ajaran dan konfigurasi akademik sekolah.
            </p>

        </div>


        <!-- TAMBAH -->

        <button
            type="button"
            onclick="openTambahTahun()"
            class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5
                   bg-[#00bfa5]
                   hover:bg-[#00a892]
                   text-white text-sm font-semibold
                   rounded-lg
                   shadow-sm
                   transition-colors">

            <svg class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2.2"
                viewBox="0 0 24 24">

                <line x1="12" x2="12" y1="5" y2="19"></line>
                <line x1="5" x2="19" y1="12" y2="12"></line>

            </svg>

            Tambah Tahun Ajaran

        </button>

    </div>


    <!-- ========================================================= -->
    <!-- ALERT -->
    <!-- ========================================================= -->

    <div id="alert-message"
        class="hidden
                rounded-xl
                border
                px-4 py-3
                text-sm
                font-medium">
    </div>


    <!-- ========================================================= -->
    <!-- STATISTIC -->
    <!-- ========================================================= -->

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


        <!-- TOTAL -->

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm
                    p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Tahun Ajaran
                    </p>

                    <h3 id="total-tahun-ajaran"
                        class="text-2xl font-bold text-slate-900 mt-1">
                        -
                    </h3>

                </div>


                <div class="w-11 h-11
                            rounded-xl
                            bg-teal-50
                            border border-teal-100
                            flex items-center justify-center
                            text-teal-600">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>

                    </svg>

                </div>

            </div>

        </div>


        <!-- AKTIF -->

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm
                    p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Tahun Aktif
                    </p>

                    <h3 id="tahun-ajaran-aktif"
                        class="text-2xl font-bold text-teal-600 mt-1">
                        -
                    </h3>

                </div>


                <div class="w-11 h-11
                            rounded-xl
                            bg-emerald-50
                            border border-emerald-100
                            flex items-center justify-center
                            text-emerald-600">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <polyline points="20 6 9 17 4 12"></polyline>

                    </svg>

                </div>

            </div>

        </div>


        <!-- NON AKTIF -->

        <div class="bg-white
                    rounded-xl
                    border border-slate-200
                    shadow-sm
                    p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Tidak Aktif
                    </p>

                    <h3 id="tahun-ajaran-nonaktif"
                        class="text-2xl font-bold text-slate-600 mt-1">
                        -
                    </h3>

                </div>


                <div class="w-11 h-11
                            rounded-xl
                            bg-slate-100
                            border border-slate-200
                            flex items-center justify-center
                            text-slate-500">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="8" y1="8" x2="16" y2="16"></line>
                        <line x1="16" y1="8" x2="8" y2="16"></line>

                    </svg>

                </div>

            </div>

        </div>

    </div>


    <!-- ========================================================= -->
    <!-- GRID TABLE -->
    <!-- ========================================================= -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


        <!-- ===================================================== -->
        <!-- TABLE TAHUN AJARAN -->
        <!-- ===================================================== -->

        <section class="bg-white
                        rounded-xl
                        border border-slate-200
                        shadow-sm
                        overflow-hidden">

            <!-- HEADER -->

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        justify-between
                        gap-4
                        p-6
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10
                                rounded-lg
                                bg-teal-50
                                border border-teal-100
                                flex items-center justify-center
                                text-teal-600">

                        <svg class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Daftar Tahun Ajaran
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Data tahun ajaran sekolah
                        </p>

                    </div>

                </div>

            </div>


            <!-- TABLE -->

            <div class="p-6">

                <div class="overflow-x-auto">

                    <div id="table-tahun-ajaran"></div>

                </div>

            </div>

        </section>



        <!-- ===================================================== -->
        <!-- TABLE KONFIGURASI -->
        <!-- ===================================================== -->

        <section class="bg-white
                        rounded-xl
                        border border-slate-200
                        shadow-sm
                        overflow-hidden">

            <!-- HEADER -->

            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        justify-between
                        gap-4
                        p-6
                        border-b border-slate-200">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10
                                rounded-lg
                                bg-indigo-50
                                border border-indigo-100
                                flex items-center justify-center
                                text-indigo-600">

                        <svg class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <circle cx="12" cy="12" r="3"></circle>

                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9c.6.35 1 .99 1 1.7V11a2 2 0 0 1-1 4z"></path>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-lg font-bold text-slate-900">
                            Konfigurasi Akademik
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Pengaturan semester dan PPDB
                        </p>

                    </div>

                </div>

            </div>


            <!-- TABLE -->

            <div class="p-6">

                <div class="overflow-x-auto">

                    <div id="table-konfig"></div>

                </div>

            </div>

        </section>

    </div>

</main>


<!-- ============================================================= -->
<!-- MODAL -->
<!-- ============================================================= -->

@include('akademik.tahun-ajaran.add')
@include('akademik.tahun-ajaran.edit')

@include('konfig.edit-konfig')


<script>
    const csrfToken = '{{ csrf_token() }}';


    /*
    |--------------------------------------------------------------------------
    | TABULATOR TAHUN AJARAN
    |--------------------------------------------------------------------------
    */

    let table = new Tabulator("#table-tahun-ajaran", {

        ajaxURL: "{{ route('tahunAjaran.data') }}",

        layout: "fitColumns",

        pagination: true,

        paginationSize: 10,

        placeholder: "Belum ada data tahun ajaran.",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 60
            },


            {
                title: "Tahun Ajaran",
                field: "thn_ajaran",
                minWidth: 130,

                formatter: function(cell) {

                    return `
                    <span class="font-semibold text-slate-800">
                        ${cell.getValue() ?? '-'}
                    </span>
                `;

                }
            },


            {
                title: "Status",
                field: "isaktiv",
                hozAlign: "center",

                formatter: function(cell) {

                    const aktif =
                        Number(cell.getValue()) === 1;

                    if (aktif) {

                        return `
                        <span class="inline-flex
                                     items-center
                                     gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-emerald-50
                                     border border-emerald-100
                                     text-emerald-700
                                     text-xs
                                     font-semibold">

                            <span class="w-1.5 h-1.5
                                         rounded-full
                                         bg-emerald-500">
                            </span>

                            Aktif

                        </span>
                    `;

                    }

                    return `
                    <span class="inline-flex
                                 items-center
                                 gap-1.5
                                 px-2.5 py-1
                                 rounded-full
                                 bg-slate-100
                                 border border-slate-200
                                 text-slate-600
                                 text-xs
                                 font-semibold">

                        <span class="w-1.5 h-1.5
                                     rounded-full
                                     bg-slate-400">
                        </span>

                        Tidak Aktif

                    </span>
                `;

                }

            },


            {
                title: "Aksi",

                width: 125,

                hozAlign: "center",

                headerSort: false,

                formatter: function(cell) {

                    const data = cell.getData();

                    const encodedData =
                        encodeURIComponent(
                            JSON.stringify(data)
                        );

                    return `

                    <div class="flex
                                items-center
                                justify-center
                                gap-2">

                        <!-- EDIT -->

                        <button
                            type="button"
                            onclick="editTahunAjaran('${encodedData}')"
                            class="w-9 h-9
                                   inline-flex
                                   items-center
                                   justify-center
                                   rounded-lg
                                   bg-amber-50
                                   border border-amber-100
                                   text-amber-600
                                   hover:bg-amber-100
                                   transition-colors"
                            title="Edit">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <path d="M12 20h9"></path>

                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>

                            </svg>

                        </button>


                        <!-- DELETE -->

                        <button
                            type="button"
                            onclick="deleteTahunAjaran(${data.id})"
                            class="w-9 h-9
                                   inline-flex
                                   items-center
                                   justify-center
                                   rounded-lg
                                   bg-red-50
                                   border border-red-100
                                   text-red-600
                                   hover:bg-red-100
                                   transition-colors"
                            title="Hapus">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <polyline points="3 6 5 6 21 6"></polyline>

                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>

                                <path d="M10 11v6"></path>

                                <path d="M14 11v6"></path>

                                <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"></path>

                            </svg>

                        </button>

                    </div>

                `;

                }

            }

        ]

    });


    /*
    |--------------------------------------------------------------------------
    | STATISTIK TAHUN AJARAN
    |--------------------------------------------------------------------------
    */

    table.on("dataLoaded", function(data) {

        const total = data.length;

        const aktif = data.filter(function(item) {

            return Number(item.isaktiv) === 1;

        }).length;

        const nonaktif = total - aktif;


        document.getElementById(
            'total-tahun-ajaran'
        ).innerText = total;


        document.getElementById(
            'tahun-ajaran-aktif'
        ).innerText = aktif;


        document.getElementById(
            'tahun-ajaran-nonaktif'
        ).innerText = nonaktif;

    });


    /*
    |--------------------------------------------------------------------------
    | BUKA MODAL TAMBAH
    |--------------------------------------------------------------------------
    */

    function openTambahTahun() {

        resetAddForm();

        const modal =
            document.getElementById(
                'modal-add-tahun-ajaran'
            );

        if (!modal) {
            console.error(
                'Modal add tahun ajaran tidak ditemukan.'
            );

            return;
        }

        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    function editTahunAjaran(encodedData) {

        const data = JSON.parse(
            decodeURIComponent(encodedData)
        );


        document.getElementById(
            'edit_id_thn'
        ).value = data.id ?? '';


        document.getElementById(
            'edit_thn_ajaran'
        ).value = data.thn_ajaran ?? '';


        document.getElementById(
                'edit_isaktiv'
            ).value =
            Number(data.isaktiv) === 1 ?
            '1' :
            '0';


        clearValidationErrors();


        const modal =
            document.getElementById(
                'modal-edit-tahun-ajaran'
            );

        if (modal) {

            modal.classList.remove('hidden');

            modal.classList.add('flex');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL
    |--------------------------------------------------------------------------
    */

    function closeModalTahunAjaran() {

        const addModal =
            document.getElementById(
                'modal-add-tahun-ajaran'
            );

        const editModal =
            document.getElementById(
                'modal-edit-tahun-ajaran'
            );


        if (addModal) {

            addModal.classList.add('hidden');

            addModal.classList.remove('flex');

        }


        if (editModal) {

            editModal.classList.add('hidden');

            editModal.classList.remove('flex');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | SAVE TAHUN AJARAN
    |--------------------------------------------------------------------------
    */

    async function saveData(type) {

        const isEdit =
            type === 'edit';


        const prefix =
            isEdit ?
            'edit_' :
            'add_';


        const id =
            isEdit ?
            document.getElementById(
                'edit_id_thn'
            ).value :
            null;


        const url =
            isEdit ?
            "{{ url('tahunAjaran/update') }}/" + id :
            "{{ route('tahunAjaran.store') }}";


        const button =
            document.getElementById(
                isEdit ?
                'btn-save-edit' :
                'btn-save-add'
            );


        clearValidationErrors();


        if (button) {

            button.disabled = true;

            button.innerHTML = `

            <svg class="w-4 h-4 animate-spin"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <circle cx="12"
                        cy="12"
                        r="9"
                        class="opacity-25">
                </circle>

                <path d="M12 3a9 9 0 0 1 9 9"
                      class="opacity-75">
                </path>

            </svg>

            Menyimpan...

        `;

        }


        try {

            const response =
                await fetch(url, {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': csrfToken

                    },

                    body: JSON.stringify({

                        thn_ajaran: document
                            .getElementById(
                                prefix +
                                'thn_ajaran'
                            )
                            .value
                            .trim(),

                        isaktiv: document
                            .getElementById(
                                prefix +
                                'isaktiv'
                            )
                            .value

                    })

                });


            const result =
                await response.json();


            if (!response.ok) {

                if (response.status === 422) {

                    showValidationErrors(
                        result.errors,
                        prefix
                    );

                }

                throw new Error(
                    result.message ??
                    'Data gagal disimpan.'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Tutup modal
            |--------------------------------------------------------------------------
            */




            /*
            |--------------------------------------------------------------------------
            | Reset form tambah
            |--------------------------------------------------------------------------
            */

            if (!isEdit) {

                resetAddForm();

            }


            /*
            |--------------------------------------------------------------------------
            | Refresh table
            |--------------------------------------------------------------------------
            */

            await table.replaceData();

            if (typeof tableKonfig !== 'undefined') {

                await tableKonfig.replaceData();

            }


            /*
            |--------------------------------------------------------------------------
            | Alert
            |--------------------------------------------------------------------------
            */

            showAlert(
                result.message ??
                'Data berhasil disimpan.',
                'success'
            );


        } catch (error) {

            console.error(error);


            showAlert(
                error.message ??
                'Terjadi kesalahan.',
                'danger'
            );


        } finally {

            if (button) {

                button.disabled = false;

                button.innerHTML = `

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>

                    <polyline points="17 21 17 13 7 13 7 21"></polyline>

                    <polyline points="7 3 7 8 15 8"></polyline>

                </svg>

                Simpan

            `;

            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE TAHUN AJARAN
    |--------------------------------------------------------------------------
    */

    async function deleteTahunAjaran(id) {

        if (!confirm(
                'Hapus tahun ajaran ini?'
            )) {

            return;

        }


        try {

            const response =
                await fetch(
                    "{{ url('tahunAjaran/delete') }}/" +
                    id, {

                        method: 'DELETE',

                        headers: {

                            'Accept': 'application/json',

                            'X-CSRF-TOKEN': csrfToken

                        }

                    }
                );


            const result =
                await response.json();


            if (!response.ok) {

                throw new Error(
                    result.message ??
                    'Data gagal dihapus.'
                );

            }


            await table.replaceData();


            showAlert(
                result.message ??
                'Data berhasil dihapus.',
                'success'
            );


        } catch (error) {

            console.error(error);


            showAlert(
                error.message ??
                'Gagal menghapus data.',
                'danger'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    function showValidationErrors(
        errors,
        prefix
    ) {

        Object.keys(
            errors ?? {}
        ).forEach(function(field) {

            const errorElement =
                document.getElementById(
                    prefix +
                    field +
                    '_error'
                );


            if (errorElement) {

                errorElement.innerText =
                    errors[field][0];

                errorElement.classList.remove(
                    'hidden'
                );

            }

        });

    }


    function clearValidationErrors() {

        document
            .querySelectorAll(
                '.validation-error'
            )
            .forEach(function(element) {

                element.innerText = '';

                element.classList.add(
                    'hidden'
                );

            });

    }


    /*
    |--------------------------------------------------------------------------
    | RESET ADD
    |--------------------------------------------------------------------------
    */

    function resetAddForm() {

        const tahun =
            document.getElementById(
                'add_thn_ajaran'
            );

        const status =
            document.getElementById(
                'add_isaktiv'
            );


        if (tahun) {

            tahun.value = '';

        }


        if (status) {

            status.value = '0';

        }


        clearValidationErrors();

    }


    /*
    |--------------------------------------------------------------------------
    | ALERT
    |--------------------------------------------------------------------------
    */

    function showAlert(
        message,
        type = 'success'
    ) {

        const alertElement =
            document.getElementById(
                'alert-message'
            );


        if (!alertElement) {

            return;

        }


        if (type === 'success') {

            alertElement.className =
                `rounded-xl
             border
             border-emerald-200
             bg-emerald-50
             text-emerald-700
             px-4 py-3
             text-sm
             font-medium`;

        } else {

            alertElement.className =
                `rounded-xl
             border
             border-red-200
             bg-red-50
             text-red-700
             px-4 py-3
             text-sm
             font-medium`;

        }


        alertElement.innerText =
            message;


        alertElement.classList.remove(
            'hidden'
        );


        window.scrollTo({

            top: 0,

            behavior: 'smooth'

        });


        setTimeout(function() {

            alertElement.classList.add(
                'hidden'
            );

        }, 4000);

    }


    /* ============================================================= */
    /* KONFIGURASI */
    /* ============================================================= */


    let tableKonfig = new Tabulator(
        "#table-konfig", {

            ajaxURL: "{{ route('konfig.data') }}",

            layout: "fitColumns",

            pagination: true,

            paginationSize: 10,

            placeholder: "Belum ada konfigurasi.",

            columns: [

                {

                    title: "No",

                    formatter: "rownum",

                    hozAlign: "center",

                    width: 55

                },


                {

                    title: "ID Tahun",

                    field: "id_tahun",

                    hozAlign: "center",

                    width: 90

                },


                {

                    title: "Semester",

                    field: "smt",

                    hozAlign: "center",

                    formatter: function(cell) {

                        return Number(
                                cell.getValue()
                            ) === 1

                            ?
                            `
                                <span class="inline-flex
                                             px-2.5 py-1
                                             rounded-full
                                             bg-blue-50
                                             border border-blue-100
                                             text-blue-700
                                             text-xs
                                             font-semibold">
                                    Ganjil
                                </span>
                              `

                            :
                            `
                                <span class="inline-flex
                                             px-2.5 py-1
                                             rounded-full
                                             bg-violet-50
                                             border border-violet-100
                                             text-violet-700
                                             text-xs
                                             font-semibold">
                                    Genap
                                </span>
                              `;

                    }

                },


                {

                    title: "ID Tahun PPDB",

                    field: "id_thn_ppdb",

                    hozAlign: "center"

                },


                {

                    title: "Aksi",

                    width: 90,

                    hozAlign: "center",

                    headerSort: false,

                    formatter: function(cell) {

                        const data =
                            cell.getData();


                        return `

                            <div class="flex
                                        items-center
                                        justify-center">

                                <button
                                    type="button"
                                    onclick='editKonfig(${JSON.stringify(data)})'
                                    class="w-9 h-9
                                           inline-flex
                                           items-center
                                           justify-center
                                           rounded-lg
                                           bg-amber-50
                                           border border-amber-100
                                           text-amber-600
                                           hover:bg-amber-100
                                           transition-colors"
                                    title="Edit">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         stroke-width="2"
                                         viewBox="0 0 24 24">

                                        <path d="M12 20h9"></path>

                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>

                                    </svg>

                                </button>

                            </div>

                        `;

                    }

                }

            ]

        }
    );


    /*
    |--------------------------------------------------------------------------
    | EDIT KONFIG
    |--------------------------------------------------------------------------
    */

    function editKonfig(data) {

        document.getElementById(
                'edit_id'
            ).value =
            data.id ?? '';


        document.getElementById(
                'edit_id_tahun'
            ).value =
            data.id_tahun ?? '';


        document.getElementById(
                'edit_smt'
            ).value =
            data.smt ?? 1;


        document.getElementById(
                'edit_id_thn_ppdb'
            ).value =
            data.id_thn_ppdb ?? '';


        const modal =
            document.getElementById(
                'modal-edit-konfig'
            );


        if (modal) {

            modal.classList.remove(
                'hidden'
            );

            modal.classList.add(
                'flex'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | SAVE KONFIG
    |--------------------------------------------------------------------------
    */

    function saveDataKonfig() {

        const id =
            document.getElementById(
                'edit_id'
            ).value;


        const url =
            id !== '' ?
            "{{ url('konfig/update') }}/" +
            id :
            "{{ url('konfig/store') }}";


        fetch(
                url, {

                    method: 'POST',

                    headers: {

                        'Content-Type': 'application/json',

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': csrfToken

                    },

                    body: JSON.stringify({

                        id_tahun: document.getElementById(
                            'edit_id_tahun'
                        ).value,

                        smt: document.getElementById(
                            'edit_smt'
                        ).value,

                        id_thn_ppdb: document.getElementById(
                            'edit_id_thn_ppdb'
                        ).value

                    })

                }
            )

            .then(async response => {

                const result =
                    await response.json();


                if (!response.ok) {

                    throw new Error(
                        result.message ??
                        'Gagal menyimpan konfigurasi.'
                    );

                }


                return result;

            })

            .then(result => {

                const modal =
                    document.getElementById(
                        'modal-edit-konfig'
                    );


                if (modal) {

                    modal.classList.add(
                        'hidden'
                    );

                    modal.classList.remove(
                        'flex'
                    );

                }


                tableKonfig.replaceData();


                showAlert(
                    result.message ??
                    'Konfigurasi berhasil disimpan.',
                    'success'
                );

            })

            .catch(error => {

                console.error(error);

                showAlert(
                    error.message ??
                    'Terjadi kesalahan.',
                    'danger'
                );

            });



    }

    function closeModalKonfig() {
        const modal = document.getElementById('modal-edit-konfig');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>

@endsection