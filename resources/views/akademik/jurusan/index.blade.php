
@extends('layout.app')

@section('title', 'Jurusan')
@section('page_title', 'Jurusan')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <div class="flex items-center gap-2 mb-2">
                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2 text-sm font-medium text-[#02BC9C] hover:text-[#02a387] transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                    Kembali
                </a>
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Jurusan
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola daftar program keahlian dan kuota pendaftaran untuk Tahun Ajaran {{ $tahun }}
            </p>
        </div>

        <button type="button"
                onclick="openModalJurusan('add')"
                class="inline-flex items-center justify-center gap-2
                       bg-[#00bfa5] hover:bg-[#00a892]
                       text-white font-semibold
                       px-4 py-2.5 rounded-lg
                       shadow-sm hover:shadow transition-all">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Tambah Jurusan
        </button>

    </div>


    {{-- Table Card --}}
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

        {{-- Card Header --}}
        <div class="flex items-center gap-3 p-5 border-b border-slate-200">

            <div class="w-10 h-10 rounded-lg
                        bg-teal-50 border border-teal-100
                        flex items-center justify-center
                        text-teal-600">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 14l9-5-9-5-9 5 9 5z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 14l6.16-3.42A12.04 12.04 0 0118 17c0 1.1-.9 2-2 2H8a2 2 0 01-2-2c0-2.1-.34-4.15-1-6.42L12 14z"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 9v6"/>
                </svg>

            </div>

            <div>
                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Jurusan
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Daftar jurusan yang tersedia.
                </p>
            </div>

        </div>


        {{-- Table --}}
        <div class="p-5">

            <div id="table-jurusan"></div>

        </div>

    </section>

</main>


{{-- =========================================================
     MODAL JURUSAN
========================================================= --}}
<div id="modal-jurusan"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto
                rounded-2xl bg-white shadow-2xl">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between
                    px-6 py-4 border-b border-slate-200">

            <div>
                <h3 id="modal-jurusan-title"
                    class="text-lg font-semibold text-slate-800">
                    Tambah Jurusan
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Isi informasi jurusan dengan lengkap.
                </p>
            </div>

            <button type="button"
                    onclick="closeModalJurusan()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-slate-400 hover:text-slate-600
                           hover:bg-slate-100 transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>

            </button>

        </div>


        {{-- Form --}}
        <div class="p-6 space-y-5">

            <input type="hidden"
                   id="jurusan_id"
                   value="">


            {{-- Nama Jurusan --}}
            <div>

                <label for="nama_jurusan"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Jurusan
                    <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       id="nama_jurusan"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm text-slate-700
                              outline-none
                              focus:border-teal-500
                              focus:ring-2 focus:ring-teal-100
                              transition"
                       placeholder="Contoh: Rekayasa Perangkat Lunak">

            </div>


            {{-- Singkatan --}}
            <div>

                <label for="singkatan"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Singkatan
                    <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       id="singkatan"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm text-slate-700
                              uppercase outline-none
                              focus:border-teal-500
                              focus:ring-2 focus:ring-teal-100
                              transition"
                       placeholder="Contoh: RPL">

            </div>


            {{-- Jumlah Siswa --}}
            <div>

                <label for="jumlah_siswa"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Jumlah Siswa
                </label>

                <input type="number"
                       id="jumlah_siswa"
                       min="0"
                       value="0"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm text-slate-700
                              outline-none
                              focus:border-teal-500
                              focus:ring-2 focus:ring-teal-100
                              transition">

            </div>

        </div>


        {{-- Modal Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4 border-t border-slate-200 bg-slate-50/70">

            <button type="button"
                    onclick="closeModalJurusan()"
                    class="inline-flex items-center justify-center
                           px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-50 transition">
                Batal
            </button>

            <button type="button"
                    onclick="saveData()"
                    id="btn-save-jurusan"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-[#00bfa5] hover:bg-[#00a892]
                           text-white text-sm font-semibold
                           shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M5 13l4 4L19 7"/>

                </svg>

                Simpan

            </button>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    window.tableJurusan = new Tabulator("#table-jurusan", {

        ajaxURL: "{{ route('jurusan.data') }}",

        layout: "fitColumns",

        height: "500px",

        pagination: true,

        paginationSize: 10,

        paginationSizeSelector: [10, 25, 50, 100],

        placeholder: "Data jurusan tidak ditemukan",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 70
            },

            {
                title: "Nama Jurusan",
                field: "nama_jurusan",
                minWidth: 220
            },

            {
                title: "Singkatan",
                field: "singkatan",
                hozAlign: "center",
                width: 130
            },

           {
    title: "Pendaftar / Kuota",
    field: "pendaftar",
    hozAlign: "center",
    width: 180,

    formatter: function(cell) {

        let data = cell.getData();

        let pendaftar = Number(data.pendaftar || 0);

        let target = Number(data.jumlah_siswa || 0);

        let progress = Number(data.progress || 0);

        return `
            <div class="inline-flex flex-col items-center">

                <!-- PROGRESS BAR -->
                <div
                    class="w-20
                           bg-slate-100
                           h-1.5
                           rounded-full
                           overflow-hidden
                           mb-1.5">

                    <div
                        class="bg-blue-600
                               h-full
                               rounded-full"
                        style="width: ${progress}%;">
                    </div>

                </div>

                <!-- ANGKA -->
                <span
                    class="text-[11px]
                           font-bold
                           text-blue-600">

                    ${pendaftar} / ${target}

                </span>

            </div>
        `;
    }
},

            {
                title: "Aksi",
                hozAlign: "center",
                width: 130,

                formatter: function (cell) {

                    let data = cell.getData();

                    return `
                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                title="Edit"
                                onclick='editJurusan(${JSON.stringify(data)})'
                                class="w-9 h-9 rounded-lg
                                       flex items-center justify-center
                                       bg-amber-50 text-amber-600
                                       border border-amber-100
                                       hover:bg-amber-100
                                       transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                </svg>

                            </button>


                            <button
                                type="button"
                                title="Hapus"
                                onclick="deleteJurusan(${data.id})"
                                class="w-9 h-9 rounded-lg
                                       flex items-center justify-center
                                       bg-red-50 text-red-600
                                       border border-red-100
                                       hover:bg-red-100
                                       transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M3 6h18"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M19 6l-1 14a1 1 0 01-1 1H7a1 1 0 01-1-1L5 6"/>

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M10 11v6M14 11v6"/>

                                </svg>

                            </button>

                        </div>
                    `;
                }
            }

        ]

    });

});


/*
|--------------------------------------------------------------------------
| Buka Modal
|--------------------------------------------------------------------------
*/

function openModalJurusan(type = 'add')
{
    const modal = document.getElementById('modal-jurusan');

    const title = document.getElementById('modal-jurusan-title');

    if (type === 'add') {

        title.textContent = 'Tambah Jurusan';

        document.getElementById('jurusan_id').value = '';

        document.getElementById('nama_jurusan').value = '';

        document.getElementById('singkatan').value = '';

        document.getElementById('jumlah_siswa').value = 0;

    }

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Tutup Modal
|--------------------------------------------------------------------------
*/

function closeModalJurusan()
{
    const modal = document.getElementById('modal-jurusan');

    modal.classList.add('hidden');

    modal.classList.remove('flex');
}


/*
|--------------------------------------------------------------------------
| Edit Jurusan
|--------------------------------------------------------------------------
*/

function editJurusan(data)
{
    document.getElementById('jurusan_id').value =
        data.id ?? '';

    document.getElementById('nama_jurusan').value =
        data.nama_jurusan ?? '';

    document.getElementById('singkatan').value =
        data.singkatan ?? '';

    document.getElementById('jumlah_siswa').value =
        data.jumlah_siswa ?? 0;

    document.getElementById('modal-jurusan-title').textContent =
        'Edit Jurusan';

    const modal = document.getElementById('modal-jurusan');

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Simpan Data
|--------------------------------------------------------------------------
*/

function saveData()
{
    let id =
        document.getElementById('jurusan_id').value;

    let isEdit =
        id !== '';

    let url = isEdit
        ? "{{ url('jurusan/update') }}/" + id
        : "{{ url('jurusan/store') }}";


    let button =
        document.getElementById('btn-save-jurusan');

    button.disabled = true;

    button.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 animate-spin"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <circle cx="12"
                    cy="12"
                    r="10"
                    stroke-width="4"
                    class="opacity-25"/>

            <path
                d="M4 12a8 8 0 018-8"
                stroke-width="4"
                stroke-linecap="round"/>

        </svg>

        Menyimpan...
    `;


    fetch(url, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}',

            'Accept':
                'application/json'

        },

        body: JSON.stringify({

            nama_jurusan:
                document.getElementById('nama_jurusan').value,

            singkatan:
                document.getElementById('singkatan').value,

            jumlah_siswa:
                document.getElementById('jumlah_siswa').value

        })

    })

    .then(res => res.json())

    .then(res => {

        if (res.success) {

            closeModalJurusan();

            tableJurusan.replaceData();

            alert('Data berhasil disimpan');

        } else {

            alert(
                res.message ??
                'Gagal menyimpan data'
            );

        }

    })

    .catch(err => {

        console.error(err);

        alert('Terjadi kesalahan saat menyimpan data');

    })

    .finally(() => {

        button.disabled = false;

        button.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"/>

            </svg>

            Simpan
        `;

    });
}


/*
|--------------------------------------------------------------------------
| Hapus Jurusan
|--------------------------------------------------------------------------
*/

function deleteJurusan(id)
{
    if (!confirm('Yakin ingin menghapus data jurusan ini ?')) {
        return;
    }


    fetch(
        "{{ url('jurusan/delete') }}/" + id,
        {

            method: 'DELETE',

            headers: {

                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}',

                'Accept':
                    'application/json'

            }

        }
    )

    .then(res => res.json())

    .then(res => {

        if (res.success) {

            tableJurusan.replaceData();

            alert('Data berhasil dihapus');

        } else {

            alert(
                res.message ??
                'Gagal menghapus data'
            );

        }

    })

    .catch(err => {

        console.error(err);

        alert('Gagal menghapus data');

    });
}


/*
|--------------------------------------------------------------------------
| Tutup Modal dengan klik overlay
|--------------------------------------------------------------------------
*/

document
    .getElementById('modal-jurusan')
    .addEventListener('click', function (event) {

        if (event.target === this) {

            closeModalJurusan();

        }

    });


/*
|--------------------------------------------------------------------------
| Escape untuk tutup modal
|--------------------------------------------------------------------------
*/

document.addEventListener('keydown', function (event) {

    if (event.key === 'Escape') {

        const modal =
            document.getElementById('modal-jurusan');

        if (!modal.classList.contains('hidden')) {

            closeModalJurusan();

        }

    }

});

</script>

@endsection

