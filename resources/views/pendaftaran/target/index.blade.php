@extends('layout.app')

@section('title', 'Target Pendaftaran')
@section('page_title', 'Target Pendaftaran')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">
    <!-- HEADER -->
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
                Target Pendaftaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola target penerimaan siswa berdasarkan tahun ajaran dan jurusan.
            </p>

        </div>


        <!-- TAMBAH -->
        <button
            type="button"
            onclick="openTambah()"
            class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5
                   bg-[#00bfa5]
                   hover:bg-[#00a892]
                   text-white
                   text-sm font-semibold
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

            Tambah Target

        </button>

    </div>

    <!-- TABLE CARD -->
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">


        <!-- CARD HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center
                    justify-between gap-4
                    p-6 border-b border-slate-200">

            <div class="flex items-center gap-3">


                <div class="w-10 h-10 rounded-lg
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

                        <path d="M3 6h18"></path>

                        <path d="M3 12h18"></path>

                        <path d="M3 18h18"></path>

                    </svg>

                </div>


                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Daftar Target Pendaftaran
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Data target penerimaan siswa berdasarkan jurusan
                    </p>

                </div>

            </div>

        </div>



        <!-- TABLE -->
        <div class="p-6">

            <div class="overflow-x-auto">

                <div id="table-target"></div>

            </div>

        </div>

    </section>

</main>



<!-- MODAL -->
@include('pendaftaran.target.add-target')
@include('pendaftaran.target.edit-target')



<script>


/*
|--------------------------------------------------------------------------
| TABULATOR
|--------------------------------------------------------------------------
*/

let table = new Tabulator("#table-target", {

    ajaxURL: "{{ route('target.data') }}",

    layout: "fitColumns",

    pagination: true,

    paginationSize: 10,

    placeholder: "Belum ada data target.",


    columns: [


        /*
        |--------------------------------------------------------------------------
        | NO
        |--------------------------------------------------------------------------
        */

        {
            title: "No",

            formatter: "rownum",

            hozAlign: "center",

            width: 70
        },


        /*
        |--------------------------------------------------------------------------
        | TAHUN AJARAN
        |--------------------------------------------------------------------------
        */

        {
            title: "Tahun Ajaran",

            field: "thn_ajaran",

            hozAlign: "center",

            minWidth: 130
        },


        /*
        |--------------------------------------------------------------------------
        | JURUSAN
        |--------------------------------------------------------------------------
        */

        {
            title: "Jurusan",

            field: "nama_jurusan",

            minWidth: 180
        },


        /*
        |--------------------------------------------------------------------------
        | TARGET
        |--------------------------------------------------------------------------
        */

        {
            title: "Target",

            field: "target",

            hozAlign: "right",

            minWidth: 120,

            formatter: function(cell) {

                return `
                    <span class="font-semibold text-slate-700">
                        ${formatAngka(cell.getValue())}
                    </span>
                `;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | PENCAPAIAN
        |--------------------------------------------------------------------------
        */

        {
            title: "Pencapaian",

            field: "pencapaian",

            hozAlign: "right",

            minWidth: 130,

            formatter: function(cell) {

                return `
                    <span class="font-semibold text-emerald-600">
                        ${formatAngka(cell.getValue())}
                    </span>
                `;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE
        |--------------------------------------------------------------------------
        */

        {
            title: "Persentase",

            hozAlign: "center",

            minWidth: 130,

            formatter: function(cell) {

                let data = cell.getData();


                let target =
                    parseFloat(data.target) || 0;


                let pencapaian =
                    parseFloat(data.pencapaian) || 0;


                let persentase =
                    target > 0
                        ? (pencapaian / target) * 100
                        : 0;


                /*
                |--------------------------------------------------------------------------
                | >= 100%
                |--------------------------------------------------------------------------
                */

                if (persentase >= 100) {

                    return `

                        <span class="inline-flex items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-emerald-50
                                     border border-emerald-100
                                     text-emerald-700
                                     text-xs font-semibold">

                            <span class="w-1.5 h-1.5
                                         rounded-full
                                         bg-emerald-500">
                            </span>

                            ${persentase.toFixed(2)}%

                        </span>

                    `;

                }


                /*
                |--------------------------------------------------------------------------
                | >= 75%
                |--------------------------------------------------------------------------
                */

                if (persentase >= 75) {

                    return `

                        <span class="inline-flex items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-amber-50
                                     border border-amber-100
                                     text-amber-700
                                     text-xs font-semibold">

                            <span class="w-1.5 h-1.5
                                         rounded-full
                                         bg-amber-500">
                            </span>

                            ${persentase.toFixed(2)}%

                        </span>

                    `;

                }


                /*
                |--------------------------------------------------------------------------
                | < 75%
                |--------------------------------------------------------------------------
                */

                return `

                    <span class="inline-flex items-center gap-1.5
                                 px-2.5 py-1
                                 rounded-full
                                 bg-red-50
                                 border border-red-100
                                 text-red-700
                                 text-xs font-semibold">

                        <span class="w-1.5 h-1.5
                                     rounded-full
                                     bg-red-500">
                        </span>

                        ${persentase.toFixed(2)}%

                    </span>

                `;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | SISA TARGET
        |--------------------------------------------------------------------------
        */

        {
            title: "Sisa Target",

            hozAlign: "right",

            minWidth: 120,

            formatter: function(cell) {

                let data = cell.getData();


                let target =
                    parseFloat(data.target) || 0;


                let pencapaian =
                    parseFloat(data.pencapaian) || 0;


                let sisa =
                    target - pencapaian;


                if (sisa <= 0) {

                    return `

                        <span class="font-semibold text-emerald-600">

                            0

                        </span>

                    `;

                }


                return `

                    <span class="font-semibold text-slate-700">

                        ${formatAngka(sisa)}

                    </span>

                `;

            }

        },


        /*
        |--------------------------------------------------------------------------
        | AKSI
        |--------------------------------------------------------------------------
        */

        {

            title: "Aksi",

            hozAlign: "center",

            width: 150,

            headerSort: false,


            formatter: function(cell) {

                let data =
                    cell.getData();


                return `

                    <div class="flex items-center justify-center gap-2">


                        <!-- EDIT -->

                        <button
                            type="button"

                            onclick='editTarget(${JSON.stringify(data)})'

                            class="w-9 h-9
                                   inline-flex items-center justify-center
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

                            onclick="deleteTarget(${data.id})"

                            class="w-9 h-9
                                   inline-flex items-center justify-center
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
| DATA LOADED
|--------------------------------------------------------------------------
*/





/*
|--------------------------------------------------------------------------
| FORMAT ANGKA
|--------------------------------------------------------------------------
*/

function formatAngka(value)
{

    return new Intl.NumberFormat(
        'id-ID'
    ).format(
        parseFloat(value) || 0
    );

}



/*
|--------------------------------------------------------------------------
| TAMBAH
|--------------------------------------------------------------------------
*/

function openTambah()
{

    document.getElementById(
        'add_id_thn_ajaran'
    ).value = '';


    document.getElementById(
        'add_id_jurusan'
    ).value = '';


    document.getElementById(
        'add_target'
    ).value = '';


    const modal =
        document.getElementById(
            'modal-add-target'
        );


    modal.classList.remove(
        'hidden'
    );


    modal.classList.add(
        'flex'
    );

}



/*
|--------------------------------------------------------------------------
| CLOSE MODAL
|--------------------------------------------------------------------------
*/

function closeModal()
{

    const addModal =
        document.getElementById(
            'modal-add-target'
        );


    const editModal =
        document.getElementById(
            'modal-edit-target'
        );


    if (addModal) {

        addModal.classList.add(
            'hidden'
        );

        addModal.classList.remove(
            'flex'
        );

    }


    if (editModal) {

        editModal.classList.add(
            'hidden'
        );

        editModal.classList.remove(
            'flex'
        );

    }

}



/*
|--------------------------------------------------------------------------
| EDIT TARGET
|--------------------------------------------------------------------------
*/

function editTarget(data)
{

    const modal =
        document.getElementById(
            'modal-edit-target'
        );


    modal.classList.remove(
        'hidden'
    );


    modal.classList.add(
        'flex'
    );


    document.getElementById(
        'edit_id'
    ).value =
        data.id ?? '';


    document.getElementById(
        'edit_id_thn_ajaran'
    ).value =
        data.id_thn_ajaran ?? '';


    document.getElementById(
        'edit_id_jurusan'
    ).value =
        data.id_jurusan ?? '';


    document.getElementById(
        'edit_target'
    ).value =
        data.target ?? 0;

}



/*
|--------------------------------------------------------------------------
| SAVE DATA
|--------------------------------------------------------------------------
*/

function saveData()
{

    const id =
        document.getElementById(
            'edit_id'
        ).value;


    const isEdit =
        id !== '';


    const prefix =
        isEdit
            ? 'edit_'
            : 'add_';


    const url =
        isEdit

            ? "{{ url('target/update') }}/" + id

            : "{{ url('target/store') }}";


    const data = {


        id_thn_ajaran:

            document.getElementById(
                prefix + 'id_thn_ajaran'
            ).value,


        id_jurusan:

            document.getElementById(
                prefix + 'id_jurusan'
            ).value,


        target:

            document.getElementById(
                prefix + 'target'
            ).value

    };


    fetch(url, {

        method: 'POST',

        headers: {

            'Content-Type':
                'application/json',

            'Accept':
                'application/json',

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}'

        },

        body:
            JSON.stringify(data)

    })


    .then(async response => {


        const result =
            await response.json();


        if (!response.ok) {

            throw result;

        }


        return result;

    })


    .then(result => {


        if (!result.success) {

            alert(
                result.message ??
                'Data gagal disimpan'
            );

            return;

        }


        const modalId =
            isEdit
                ? 'modal-edit-target'
                : 'modal-add-target';


        const modal =
            document.getElementById(
                modalId
            );


        if (modal) {

            modal.classList.add(
                'hidden'
            );

            modal.classList.remove(
                'flex'
            );

        }


        document.getElementById(
            'edit_id'
        ).value = '';


        table.replaceData();


        alert(
            result.message ??
            'Data berhasil disimpan'
        );

    })


    .catch(error => {


        console.error(error);


        if (error.errors) {


            let pesan =
                Object.values(
                    error.errors
                )
                .flat()
                .join('\n');


            alert(pesan);


            return;

        }


        alert(
            error.message ??
            'Terjadi kesalahan saat menyimpan data'
        );

    });

}



/*
|--------------------------------------------------------------------------
| DELETE TARGET
|--------------------------------------------------------------------------
*/

function deleteTarget(id)
{

    if (!confirm(
        'Hapus data target ini?'
    )) {

        return;

    }


    fetch(
        "{{ url('target/delete') }}/" + id,
        {

            method: 'DELETE',

            headers: {

                'Accept':
                    'application/json',

                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}'

            }

        }

    )


    .then(async response => {


        const result =
            await response.json();


        if (!response.ok) {

            throw result;

        }


        return result;

    })


    .then(result => {


        if (!result.success) {

            alert(
                result.message ??
                'Data gagal dihapus'
            );

            return;

        }


        table.replaceData();


        alert(
            result.message ??
            'Data berhasil dihapus'
        );

    })


    .catch(error => {


        console.error(error);


        alert(
            error.message ??
            'Terjadi kesalahan saat menghapus data'
        );

    });

}

</script>

@endsection