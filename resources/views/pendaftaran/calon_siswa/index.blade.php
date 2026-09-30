@extends('layout.app')

@section('title', 'Calon Siswa')
@section('page_title', 'Calon Siswa')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    <!-- =========================================================
         HEADER
    ========================================================== -->

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2 text-sm font-medium
                          text-[#02BC9C] hover:text-[#02a387]
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
                Calon Siswa
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data calon siswa yang terdaftar pada PPDB.
            </p>

        </div>


        <!-- TAMBAH -->

        <a href="{{ route('calon-siswa.create') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5
                  bg-[#00bfa5] hover:bg-[#00a892]
                  text-white text-sm font-semibold
                  rounded-lg shadow-sm
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

            Tambah Calon Siswa

        </a>

    </div>


    <!-- =========================================================
         STATISTIC
    ========================================================== -->




    <!-- =========================================================
         FILTER
    ========================================================== -->

    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">


        <!-- HEADER FILTER -->

        <div class="flex items-center gap-3
                    p-6 border-b border-slate-200">

            <div class="w-10 h-10 rounded-lg
                        bg-teal-50 border border-teal-100
                        flex items-center justify-center
                        text-teal-600">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"></path>

                </svg>

            </div>


            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Filter Calon Siswa
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Gunakan filter untuk mencari data calon siswa
                </p>

            </div>

        </div>


        <!-- FILTER FORM -->

        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5">


                <!-- NAMA / NO DAFTAR -->

                <div class="lg:col-span-3">

                    <label
                        for="filter-nama"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Nama / No. Daftar

                    </label>

                    <div class="relative">

                        <div class="absolute inset-y-0 left-0
                                    pl-3 flex items-center
                                    pointer-events-none
                                    text-slate-400">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 stroke-width="2"
                                 viewBox="0 0 24 24">

                                <circle cx="11" cy="11" r="8"></circle>

                                <line x1="21" y1="21"
                                      x2="16.65" y2="16.65"></line>

                            </svg>

                        </div>


                        <input
                            type="text"
                            id="filter-nama"
                            class="w-full rounded-lg border border-slate-200
                                   bg-white pl-9 pr-3 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-500/10
                                   outline-none transition"
                            placeholder="Cari nama atau no. daftar...">

                    </div>

                </div>


                <!-- TAHUN AJARAN -->

                <div class="lg:col-span-3">

                    <label
                        for="filter-tahun-ajaran"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Tahun Ajaran

                    </label>

                    <select
                        id="filter-tahun-ajaran"
                        class="w-full rounded-lg border border-slate-200
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               focus:border-teal-500
                               focus:ring-2 focus:ring-teal-500/10
                               outline-none transition">

                        <option value="">
                            Semua Tahun Ajaran
                        </option>

                        @foreach ($tahunAjaran as $tahun)

                            <option value="{{ $tahun->id }}">
                                {{ $tahun->thn_ajaran }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- JURUSAN -->

                <div class="lg:col-span-2">

                    <label
                        for="filter-jurusan"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Jurusan

                    </label>

                    <select
                        id="filter-jurusan"
                        class="w-full rounded-lg border border-slate-200
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               focus:border-teal-500
                               focus:ring-2 focus:ring-teal-500/10
                               outline-none transition">

                        <option value="">
                            Semua Jurusan
                        </option>

                        @foreach ($jurusan as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_jurusan }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- GELOMBANG -->

                <div class="lg:col-span-2">

                    <label
                        for="filter-gelombang"
                        class="block text-sm font-semibold text-slate-700 mb-2">

                        Gelombang

                    </label>

                    <select
                        id="filter-gelombang"
                        class="w-full rounded-lg border border-slate-200
                               bg-white px-3 py-2.5
                               text-sm text-slate-700
                               focus:border-teal-500
                               focus:ring-2 focus:ring-teal-500/10
                               outline-none transition">

                        <option value="">
                            Semua Gelombang
                        </option>

                        @foreach ($gelombang as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_gelombang }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- BUTTON -->

                <div class="lg:col-span-2 flex items-end">

                    <button
                        type="button"
                        id="btn-cari"
                        class="w-full inline-flex items-center
                               justify-center gap-2
                               px-4 py-2.5
                               rounded-lg
                               bg-[#00bfa5]
                               hover:bg-[#00a892]
                               text-white text-sm font-semibold
                               transition-colors">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2"
                             viewBox="0 0 24 24">

                            <circle cx="11" cy="11" r="8"></circle>

                            <line x1="21" y1="21"
                                  x2="16.65" y2="16.65"></line>

                        </svg>

                        Cari

                    </button>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         TABLE
    ========================================================== -->

    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">


        <!-- CARD HEADER -->

        <div class="flex flex-col sm:flex-row
                    sm:items-center justify-between
                    gap-4 p-6 border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-teal-50 border border-teal-100
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
                        Daftar Calon Siswa
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Data siswa yang mendaftar PPDB
                    </p>

                </div>

            </div>

        </div>


        <!-- TABLE -->

        <div class="p-6">

            <div class="overflow-x-auto">

                <div id="table-calon-siswa"></div>

            </div>

        </div>

    </section>

</main>


<!-- =============================================================
     MODAL DAFTAR ULANG
============================================================== -->

@include('pendaftaran.calon_siswa.modal_daftar_ulang.modal-daftar-ulang')


<script>

    /*
    |--------------------------------------------------------------------------
    | TABULATOR
    |--------------------------------------------------------------------------
    */

    let table = new Tabulator("#table-calon-siswa", {

        ajaxURL: "{{ route('calon-siswa.data') }}",

        layout: "fitColumns",

        height: "500px",

        pagination: true,

        paginationSize: 10,

        placeholder: "Belum ada data calon siswa.",

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
            | NAMA
            |--------------------------------------------------------------------------
            */

            {
                title: "Nama Lengkap",
                field: "nama_lengkap",
                minWidth: 200
            },


            /*
            |--------------------------------------------------------------------------
            | NO DAFTAR
            |--------------------------------------------------------------------------
            */

            {
                title: "No Daftar",
                field: "no_daftar",
                minWidth: 140
            },


            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            {
                title: "Status",
                field: "status_daftar",
                hozAlign: "center",
                minWidth: 130,

                formatter: function(cell) {

                    let value = cell.getValue();

                    if (!value) {

                        return `
                            <span class="inline-flex items-center gap-1.5
                                         px-2.5 py-1
                                         rounded-full
                                         bg-slate-100
                                         border border-slate-200
                                         text-slate-600
                                         text-xs font-semibold">

                                <span class="w-1.5 h-1.5
                                             rounded-full
                                             bg-slate-400"></span>

                                -

                            </span>
                        `;

                    }


                    return `
                        <span class="inline-flex items-center gap-1.5
                                     px-2.5 py-1
                                     rounded-full
                                     bg-teal-50
                                     border border-teal-100
                                     text-teal-700
                                     text-xs font-semibold">

                            <span class="w-1.5 h-1.5
                                         rounded-full
                                         bg-teal-500"></span>

                            ${value}

                        </span>
                    `;

                }

            },


            /*
            |--------------------------------------------------------------------------
            | NO HP
            |--------------------------------------------------------------------------
            */

            {
                title: "No HP",
                field: "no_hp",
                minWidth: 150
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
            | GELOMBANG
            |--------------------------------------------------------------------------
            */

            {
                title: "Gelombang",
                field: "nama_gelombang",
                minWidth: 180
            },


            /*
            |--------------------------------------------------------------------------
            | ACTION
            |--------------------------------------------------------------------------
            */

            {
                title: "Aksi",

                hozAlign: "center",

                width: 180,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `

                        <div class="flex items-center
                                    justify-center gap-2">

                            <!-- EDIT -->

                            <a
                                href="{{ url('calon-siswa/edit') }}/${data.id}"
                                target="_blank"
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

                            </a>


                            <!-- DELETE -->

                            <button
                                type="button"
                                onclick="deleteData(${data.id})"
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


                            @if(isset($side) && $side === 'daftar-ulang')

                                <!-- DAFTAR ULANG -->

                                <button
                                    type="button"
                                    onclick='openDaftarUlang(${JSON.stringify(data)})'
                                    class="w-9 h-9
                                           inline-flex
                                           items-center
                                           justify-center
                                           rounded-lg
                                           bg-emerald-50
                                           border border-emerald-100
                                           text-emerald-600
                                           hover:bg-emerald-100
                                           transition-colors"
                                    title="Daftar Ulang">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-linecap="round"
                                         stroke-linejoin="round"
                                         stroke-width="2"
                                         viewBox="0 0 24 24">

                                        <path d="M20 6 9 17l-5-5"></path>

                                    </svg>

                                </button>

                            @endif

                        </div>

                    `;

                }

            }

        ]

    });


    /*
    |--------------------------------------------------------------------------
    | STATISTIK
    |--------------------------------------------------------------------------
    */

   


    /*
    |--------------------------------------------------------------------------
    | OPEN DAFTAR ULANG
    |--------------------------------------------------------------------------
    */

    function openDaftarUlang(data) {

        if (!data) {

            alert(
                "Data calon siswa tidak ditemukan."
            );

            return;

        }


        document.getElementById(
            "id_cawa"
        ).value = data.id ?? "";


        document.getElementById(
            "no_daftar"
        ).value = data.no_daftar ?? "";


        document.getElementById(
            "nama"
        ).value = data.nama_lengkap ?? "";


        document.getElementById(
            "id_jurusan"
        ).value = data.id_jurusan ?? "";


        generateNipd();


        const modal = document.getElementById(
            "modal-daftar-ulang"
        );


        if (modal) {

            modal.classList.remove("hidden");

            modal.classList.add("flex");

        }

    }


    /*
    |--------------------------------------------------------------------------
    | CLOSE DAFTAR ULANG
    |--------------------------------------------------------------------------
    */

    function closeModalDaftarUlang() {

        const modal = document.getElementById(
            "modal-daftar-ulang"
        );


        if (!modal) {
            return;
        }


        modal.classList.add("hidden");

        modal.classList.remove("flex");

    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE NIPD
    |--------------------------------------------------------------------------
    */

    async function generateNipd() {

        const inputNipd =
            document.getElementById('nipd');


        if (!inputNipd) {
            return;
        }


        inputNipd.value =
            'Memuat...';


        inputNipd.disabled =
            true;


        try {

            const response = await fetch(

                "{{ route('calon-siswa.generate-nipd') }}",

                {

                    method: 'GET',

                    headers: {

                        'Accept':
                            'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest'

                    }

                }

            );


            const result =
                await response.json();


            if (
                !response.ok ||
                !result.success
            ) {

                throw new Error(
                    result.message ??
                    'Gagal membuat NIPD.'
                );

            }


            inputNipd.value =
                result.nipd;


        } catch (error) {

            inputNipd.value = '';

            alert(error.message);


        } finally {

            inputNipd.disabled =
                false;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | EDIT DATA
    |--------------------------------------------------------------------------
    */

    function editData(data) {

        document.getElementById(
            'edit_id'
        ).value = data.id;


        document.getElementById(
            'edit_nama_lengkap'
        ).value = data.nama_lengkap;


        document.getElementById(
            'edit_jk'
        ).value = data.jk;


        document.getElementById(
            'edit_nisn'
        ).value = data.nisn;


        document.getElementById(
            'edit_no_hp'
        ).value = data.no_hp;


        document.getElementById(
            'edit_id_jurusan'
        ).value = data.id_jurusan;


        document.getElementById(
            'edit_id_gelombang'
        ).value = data.id_gelombang;

    }


    /*
    |--------------------------------------------------------------------------
    | SAVE DATA
    |--------------------------------------------------------------------------
    */

    function saveData(type) {

        let prefix =
            type == 'add'
                ? 'add_'
                : 'edit_';


        let id =
            type == 'edit'
                ? document.getElementById(
                    'edit_id'
                ).value
                : '';


        let url =
            type == 'edit'

                ? "{{ url('calon-siswa/update') }}/" + id

                : "{{ url('calon-siswa/store') }}";


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

                nama_lengkap:
                    document.getElementById(
                        prefix + 'nama_lengkap'
                    ).value,

                jk:
                    document.getElementById(
                        prefix + 'jk'
                    ).value,

                nisn:
                    document.getElementById(
                        prefix + 'nisn'
                    ).value,

                no_hp:
                    document.getElementById(
                        prefix + 'no_hp'
                    ).value,

                id_jurusan:
                    document.getElementById(
                        prefix + 'id_jurusan'
                    ).value,

                id_gelombang:
                    document.getElementById(
                        prefix + 'id_gelombang'
                    ).value

            })

        })

        .then(res => res.json())

        .then(res => {

            table.replaceData();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE DATA
    |--------------------------------------------------------------------------
    */

    function deleteData(id) {

        if (
            !confirm(
                'Yakin hapus data calon siswa ini?'
            )
        ) {

            return;

        }


        fetch(

            "{{ url('calon-siswa/delete') }}/" + id,

            {

                method: 'DELETE',

                headers: {

                    'X-CSRF-TOKEN':
                        '{{ csrf_token() }}'

                }

            }

        )

        .then(res => res.json())

        .then(res => {

            table.replaceData();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DAFTAR ULANG
    |--------------------------------------------------------------------------
    */

    async function simpanDaftarUlang() {

        const btn =
            document.getElementById(
                "btn-simpan-daftar-ulang"
            );


        if (!btn) {
            return;
        }


        btn.disabled =
            true;


        btn.innerHTML = `

            <svg class="w-4 h-4 animate-spin"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <circle
                    cx="12"
                    cy="12"
                    r="9"
                    stroke-width="3"
                    class="opacity-25">
                </circle>

                <path
                    d="M12 3a9 9 0 0 1 9 9"
                    stroke-width="3">
                </path>

            </svg>

            Menyimpan...

        `;


        try {

            const form =
                document.getElementById(
                    "form-daftar-ulang"
                );


            const formData =
                new FormData(form);


            const response =
                await fetch(

                    "{{ route('calon-siswa.save-daftar-siswa') }}",

                    {

                        method: "POST",

                        headers: {

                            "X-CSRF-TOKEN":
                                "{{ csrf_token() }}",

                            "Accept":
                                "application/json"

                        },

                        body: formData

                    }

                );


            const result =
                await response.json();


            if (
                !response.ok ||
                result.success === false
            ) {

                alert(
                    result.message
                );


                btn.disabled =
                    false;


                btn.innerHTML =
                    "Simpan";


                return;

            }


            alert(
                result.message
            );


            form.reset();


            table.replaceData();


            closeModalDaftarUlang();


        } catch (err) {

            console.error(err);

            alert(
                "Terjadi kesalahan."
            );


        } finally {

            btn.disabled =
                false;


            btn.innerHTML =
                "Simpan";

        }

    }


    /*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("btn-cari")
        .addEventListener(
            "click",
            function () {

                const params = {

                    search:
                        document.getElementById(
                            "filter-nama"
                        ).value,

                    id_thn_ajaran:
                        document.getElementById(
                            "filter-tahun-ajaran"
                        ).value,

                    id_jurusan:
                        document.getElementById(
                            "filter-jurusan"
                        ).value,

                    id_gelombang:
                        document.getElementById(
                            "filter-gelombang"
                        ).value

                };


                table.setData(

                    "{{ route('calon-siswa.data') }}",

                    params,

                    "GET"

                );

            }
        );


    /*
    |--------------------------------------------------------------------------
    | ENTER UNTUK CARI
    |--------------------------------------------------------------------------
    */

    document
        .getElementById("filter-nama")
        .addEventListener(
            "keydown",
            function (event) {

                if (
                    event.key === "Enter"
                ) {

                    document
                        .getElementById(
                            "btn-cari"
                        )
                        .click();

                }

            }
        );


    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL DENGAN BACKDROP
    |--------------------------------------------------------------------------
    */

    const modalDaftarUlang =
        document.getElementById(
            "modal-daftar-ulang"
        );


    if (modalDaftarUlang) {

        modalDaftarUlang.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === this
                ) {

                    closeModalDaftarUlang();

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape"
            ) {

                closeModalDaftarUlang();

            }

        }
    );

</script>

@endsection

