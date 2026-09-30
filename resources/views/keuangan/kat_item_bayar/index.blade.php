
@extends('layout.app')

@section('title', 'Kategori Item Bayar')
@section('page_title', 'Kategori Item Bayar')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    <!-- =========================================================
         HEADER
    ========================================================== -->

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <a
                    href="javascript:history.back()"
                    class="inline-flex items-center gap-2 text-sm font-medium
                           text-[#02BC9C] hover:text-[#02a387]
                           transition-colors"
                >

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.2"
                        viewBox="0 0 24 24"
                    >
                        <line x1="19" x2="5" y1="12" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>

                    Kembali

                </a>

            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Kategori Item Bayar
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola kategori item yang digunakan dalam pembayaran.
            </p>

        </div>


        <!-- TAMBAH DATA -->

        <button
            type="button"
            onclick="openModalKatItemBayar()"
            class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5
                   bg-[#00bfa5] hover:bg-[#00a892]
                   text-white text-sm font-semibold
                   rounded-lg shadow-sm
                   transition-colors"
        >

            <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2.2"
                viewBox="0 0 24 24"
            >
                <line x1="12" x2="12" y1="5" y2="19"></line>
                <line x1="5" x2="19" y1="12" y2="12"></line>
            </svg>

            Tambah Data

        </button>

    </div>


    <!-- =========================================================
         TABLE
    ========================================================== -->

    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

        <!-- CARD HEADER -->

        <div
            class="flex flex-col sm:flex-row
                   sm:items-center justify-between
                   gap-4 p-6 border-b border-slate-200"
        >

            <div class="flex items-center gap-3">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-teal-50 border border-teal-100
                           flex items-center justify-center
                           text-teal-600"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >

                        <path d="M4 6h16"></path>
                        <path d="M4 12h16"></path>
                        <path d="M4 18h16"></path>

                        <circle cx="8" cy="6" r="1"></circle>
                        <circle cx="8" cy="12" r="1"></circle>
                        <circle cx="8" cy="18" r="1"></circle>

                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Daftar Kategori
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Data kategori item pembayaran
                    </p>

                </div>

            </div>

        </div>


        <!-- TABLE -->

        <div class="p-6">

            <div class="overflow-x-auto">

                <div id="tableData"></div>

            </div>

        </div>

    </section>

</main>


<!-- =============================================================
     MODAL FORM
============================================================== -->

<div
    id="modal-form"
    class="fixed inset-0 z-50 hidden items-center justify-center
           bg-slate-900/50 p-4 backdrop-blur-sm"
    aria-hidden="true"
>

    <div
        class="relative w-full max-w-lg
               max-h-[90vh] overflow-y-auto
               rounded-2xl bg-white shadow-2xl"
    >

        <!-- HEADER -->

        <div
            class="flex items-center justify-between
                   border-b border-slate-200
                   px-6 py-4"
        >

            <div>

                <h2
                    id="modal-title"
                    class="text-lg font-semibold text-slate-800"
                >
                    Tambah Kategori
                </h2>

                <p class="mt-0.5 text-sm text-slate-500">
                    Masukkan nama kategori item pembayaran.
                </p>

            </div>


            <button
                type="button"
                onclick="closeModalKatItemBayar()"
                class="flex h-9 w-9 items-center justify-center
                       rounded-lg text-slate-400
                       transition hover:bg-slate-100
                       hover:text-slate-600"
                aria-label="Tutup"
            >

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>

            </button>

        </div>


        <!-- BODY -->

        <div class="px-6 py-6">

            <input
                type="hidden"
                id="id"
                value=""
            >

            <div>

                <label
                    for="nama_kategori"
                    class="block text-sm font-semibold
                           text-slate-700 mb-2"
                >
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="nama_kategori"
                    name="nama_kategori"
                    class="w-full rounded-lg
                           border border-slate-200
                           bg-white px-3 py-2.5
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           focus:border-teal-500
                           focus:ring-2 focus:ring-teal-500/10
                           outline-none transition"
                    placeholder="Masukkan nama kategori..."
                >

                <p
                    id="nama_kategori_error"
                    class="hidden mt-1.5 text-xs text-red-600"
                ></p>

            </div>

        </div>


        <!-- FOOTER -->

        <div
            class="flex items-center justify-end gap-3
                   border-t border-slate-200
                   bg-slate-50
                   px-6 py-4"
        >

            <button
                type="button"
                onclick="closeModalKatItemBayar()"
                class="inline-flex items-center justify-center
                       rounded-lg
                       border border-slate-200
                       bg-white
                       px-4 py-2.5
                       text-sm font-semibold
                       text-slate-600
                       hover:bg-slate-100
                       transition-colors"
            >
                Batal
            </button>


            <button
                type="button"
                id="btn-save"
                onclick="saveData()"
                class="inline-flex items-center justify-center
                       gap-2 rounded-lg
                       bg-[#00bfa5]
                       hover:bg-[#00a892]
                       px-5 py-2.5
                       text-sm font-semibold
                       text-white
                       transition-colors"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >

                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>

                </svg>

                Simpan

            </button>

        </div>

    </div>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | TABULATOR
    |--------------------------------------------------------------------------
    */

    let table = new Tabulator("#tableData", {

        ajaxURL: "{{ route('kat-item-bayar.data') }}",

        layout: "fitColumns",

        height: "500px",

        pagination: true,

        paginationSize: 10,

        placeholder: "Belum ada data kategori.",

        columns: [

            {
                title: "ID",
                field: "id",
                width: 80,
                hozAlign: "center"
            },

            {
                title: "Nama Kategori",
                field: "nama_kategori",
                minWidth: 250
            },

            {
                title: "Aksi",
                hozAlign: "center",
                width: 180,

                formatter: function(cell) {

                    let row = cell.getData();

                    return `

                        <div class="flex items-center
                                    justify-center gap-2">

                            <!-- EDIT -->

                            <button
                                type="button"
                                onclick='editKatItemBayar(${JSON.stringify(row)})'
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
                                title="Edit"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <path d="M12 20h9"></path>

                                    <path
                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"
                                    ></path>

                                </svg>

                            </button>


                            <!-- DELETE -->

                            <button
                                type="button"
                                onclick="deleteKatItemBayar(${row.id})"
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
                                title="Hapus"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >

                                    <polyline points="3 6 5 6 21 6"></polyline>

                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"
                                    ></path>

                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>

                                    <path
                                        d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"
                                    ></path>

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
    | OPEN MODAL TAMBAH
    |--------------------------------------------------------------------------
    */

    function openModalKatItemBayar() {

        document.getElementById('id').value = '';

        document.getElementById('nama_kategori').value = '';

        document.getElementById('modal-title').innerText =
            'Tambah Kategori';

        document.getElementById('nama_kategori_error').classList.add('hidden');

        const modal =
            document.getElementById('modal-form');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeModalKatItemBayar() {

        const modal =
            document.getElementById('modal-form');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        modal.classList.remove('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    function editKatItemBayar(data) {

        document.getElementById('id').value =
            data.id ?? '';

        document.getElementById('nama_kategori').value =
            data.nama_kategori ?? '';

        document.getElementById('modal-title').innerText =
            'Edit Kategori';

        document.getElementById('nama_kategori_error').classList.add('hidden');

        const modal =
            document.getElementById('modal-form');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | SAVE
    |--------------------------------------------------------------------------
    */

    function saveData() {

        let id =
            document.getElementById('id').value;

        let isEdit =
            id !== '';

        let url =
            isEdit
                ? "{{ url('kat-item-bayar/update') }}/" + id
                : "{{ url('kat-item-bayar/store') }}";


        const btn =
            document.getElementById('btn-save');

        btn.disabled = true;

        btn.innerHTML = `

            <svg
                class="w-4 h-4 animate-spin"
                fill="none"
                viewBox="0 0 24 24"
            >

                <circle
                    cx="12"
                    cy="12"
                    r="9"
                    stroke="currentColor"
                    stroke-width="3"
                    class="opacity-25"
                ></circle>

                <path
                    d="M12 3a9 9 0 0 1 9 9"
                    stroke="currentColor"
                    stroke-width="3"
                ></path>

            </svg>

            Menyimpan...

        `;


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

            body: JSON.stringify({

                nama_kategori:
                    document.getElementById(
                        'nama_kategori'
                    ).value

            })

        })

        .then(async response => {

            const res = await response.json();

            if (!response.ok) {

                throw res;

            }

            return res;

        })

        .then(res => {

            closeModalKatItemBayar();

            table.replaceData();

        })

        .catch(err => {

            console.log(err);

            if (err.errors &&
                err.errors.nama_kategori) {

                const error =
                    document.getElementById(
                        'nama_kategori_error'
                    );

                error.innerText =
                    err.errors.nama_kategori[0];

                error.classList.remove('hidden');

            } else {

                alert(
                    err.message ??
                    'Terjadi kesalahan.'
                );

            }

        })

        .finally(() => {

            btn.disabled = false;

            btn.innerHTML = `

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                >

                    <path
                        d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"
                    ></path>

                    <polyline
                        points="17 21 17 13 7 13 7 21"
                    ></polyline>

                    <polyline
                        points="7 3 7 8 15 8"
                    ></polyline>

                </svg>

                Simpan

            `;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    function deleteKatItemBayar(id) {

        if (!confirm('Yakin ingin menghapus kategori ini?')) {
            return;
        }


        fetch(
            "{{ url('kat-item-bayar/delete') }}/" + id,
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

            const res =
                await response.json();

            if (!response.ok) {
                throw res;
            }

            return res;

        })

        .then(res => {

            table.replaceData();

        })

        .catch(err => {

            console.log(err);

            alert(
                err.message ??
                'Gagal menghapus data.'
            );

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE BACKDROP
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('modal-form')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                closeModalKatItemBayar();

            }

        });


    /*
    |--------------------------------------------------------------------------
    | ESCAPE
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeModalKatItemBayar();

        }

    });

</script>

@endsection

