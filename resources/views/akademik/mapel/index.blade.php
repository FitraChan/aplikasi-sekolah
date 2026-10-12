
@extends('layout.app')

@section('title', 'Mata Pelajaran')
@section('page_title', 'Mata Pelajaran')

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
                Mata Pelajaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data mata pelajaran, jurusan, kurikulum, dan semester.
            </p>

        </div>


        <button type="button"
                onclick="openModalMapel('add')"
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

            Tambah Mapel

        </button>

    </div>


    {{-- Card --}}
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
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>

                </svg>

            </div>

            <div>

                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Mata Pelajaran
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Data mata pelajaran berdasarkan jurusan dan kurikulum.
                </p>

            </div>

        </div>


        <div class="p-5">

            {{-- Filter --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-5">

                {{-- Jurusan --}}
                <div>

                    <label for="filter_jurusan"
                           class="block text-xs font-semibold text-slate-600 mb-1.5">
                        Jurusan
                    </label>

                    <select id="filter_jurusan"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-100
                                   transition">

                        <option value="">
                            Semua Jurusan
                        </option>

                        @foreach($jurusan as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_jurusan }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Kurikulum --}}
                <div>

                    <label for="filter_kurikulum"
                           class="block text-xs font-semibold text-slate-600 mb-1.5">
                        Kurikulum
                    </label>

                    <select id="filter_kurikulum"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-100
                                   transition">

                        <option value="">
                            Semua Kurikulum
                        </option>

                        @foreach($kurikulum as $item)

                            <option value="{{ $item }}">
                                {{ $item->kurikulum }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Keyword --}}
                <div>

                    <label for="filter_keyword"
                           class="block text-xs font-semibold text-slate-600 mb-1.5">
                        Pencarian
                    </label>

                    <input type="text"
                           id="filter_keyword"
                           placeholder="Cari Nama Mapel..."
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm text-slate-700
                                  outline-none
                                  focus:border-teal-500
                                  focus:ring-2 focus:ring-teal-100
                                  transition">

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button type="button"
                            onclick="loadDataMapel()"
                            class="inline-flex items-center justify-center gap-2
                                   flex-1
                                   bg-[#00bfa5] hover:bg-[#00a892]
                                   text-white font-semibold
                                   px-4 py-2.5 rounded-lg
                                   transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>

                        </svg>

                        Cari

                    </button>


                    <button type="button"
                            onclick="resetFilterMapel()"
                            class="inline-flex items-center justify-center gap-2
                                   px-4 py-2.5 rounded-lg
                                   border border-slate-300
                                   bg-white text-slate-700
                                   font-semibold
                                   hover:bg-slate-50
                                   transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                        </svg>

                        Reset

                    </button>

                </div>

            </div>


            {{-- Table --}}
            <div id="table-mapel"></div>

        </div>

    </section>

</main>


{{-- =========================================================
     MODAL MAPEL
========================================================= --}}
<div id="modal-mapel"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto
                rounded-2xl bg-white shadow-2xl">

        {{-- Header --}}
        <div class="flex items-center justify-between
                    px-6 py-4 border-b border-slate-200">

            <div>

                <h3 id="modal-mapel-title"
                    class="text-lg font-semibold text-slate-800">
                    Tambah Mata Pelajaran
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Isi informasi mata pelajaran.
                </p>

            </div>


            <button type="button"
                    onclick="closeModalMapel()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-slate-400
                           hover:text-slate-600
                           hover:bg-slate-100
                           transition">

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
                   id="mapel_id"
                   value="">


            {{-- Nama Mapel --}}
            <div>

                <label for="nama_mapel"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Mata Pelajaran
                    <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       id="nama_mapel"
                       placeholder="Contoh: Pemrograman Dasar"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm text-slate-700
                              outline-none
                              focus:border-teal-500
                              focus:ring-2 focus:ring-teal-100
                              transition">

            </div>


            {{-- Jurusan & Kategori --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <label for="id_jurusan"
                           class="block text-sm font-medium text-slate-700 mb-2">
                        Jurusan
                        <span class="text-red-500">*</span>
                    </label>

                    <select id="id_jurusan"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-100
                                   transition">

                        <option value="">
                            Pilih Jurusan
                        </option>

                        @foreach($jurusan as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_jurusan }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div>

                    <label for="id_kategori_mapel"
                           class="block text-sm font-medium text-slate-700 mb-2">
                        Kategori Mapel
                        <span class="text-red-500">*</span>
                    </label>

                    <select id="id_kategori_mapel"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-100
                                   transition">

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach($kategori_mapel ?? [] as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_kategori ?? $item->nama }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- Kurikulum --}}
            <div>

                <label for="kurikulum"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Kurikulum
                    <span class="text-red-500">*</span>
                </label>

                <select id="kurikulum"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none
                               focus:border-teal-500
                               focus:ring-2 focus:ring-teal-100
                               transition">

                    <option value="">
                        Pilih Kurikulum
                    </option>

                    @foreach($kurikulum as $item)

                        <option value="{{ $item->kurikulum }}">
                            {{ $item->kurikulum }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Semester --}}
            <div>

                <label class="block text-sm font-medium text-slate-700 mb-3">
                    Semester
                </label>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">

                    @for($i = 1; $i <= 6; $i++)

                        <div>

                            <label for="smt{{ $i }}"
                                   class="block text-xs font-medium text-slate-500 mb-1.5">
                                Semester {{ $i }}
                            </label>

                            <input type="number"
                                   id="smt{{ $i }}"
                                   value="0"
                                   min="0"
                                   class="w-full rounded-lg border border-slate-300
                                          px-3 py-2.5 text-sm text-slate-700
                                          outline-none
                                          focus:border-teal-500
                                          focus:ring-2 focus:ring-teal-100
                                          transition">

                        </div>

                    @endfor

                </div>

            </div>


            {{-- Keterangan --}}
            <div>

                <label for="ket"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Keterangan
                </label>

                <input type="text"
                       id="ket"
                       placeholder="Keterangan..."
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm text-slate-700
                              outline-none
                              focus:border-teal-500
                              focus:ring-2 focus:ring-teal-100
                              transition">

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4 border-t border-slate-200
                    bg-slate-50/70">

            <button type="button"
                    onclick="closeModalMapel()"
                    class="px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-50 transition">

                Batal

            </button>


            <button type="button"
                    id="btn-save-mapel"
                    onclick="saveData()"
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

let table;


document.addEventListener('DOMContentLoaded', function () {

    table = new Tabulator("#table-mapel", {

        ajaxURL: "{{ route('mapel.data') }}",

        layout: "fitDataStretch",

        height: "500px",

        pagination: true,

        paginationSize: 10,

        paginationSizeSelector: [10, 25, 50, 100],

        placeholder: "Data mata pelajaran tidak ditemukan",

        columns: [

            {
                title: "No",
                width: 70,
                hozAlign: "center",

                formatter: function(cell) {

                    let row = cell.getRow();

                    let table = row.getTable();

                    let page = table.getPage();

                    let size = table.getPageSize();

                    return ((page - 1) * size)
                        + row.getPosition(true);

                }
            },


            {
                title: "Nama Mapel",
                field: "nama_mapel",
                width: 250
            },


            {
                title: "Jurusan",
                field: "jurusan",
                width: 180
            },


            {
                title: "Kategori",
                field: "kategori",
                width: 220
            },


            {
                title: "Kurikulum",
                field: "kurikulum",
                width: 120,
                hozAlign: "center"
            },


            {
                title: "SMT 1",
                field: "smt1",
                hozAlign: "center",
                width: 100
            },


            {
                title: "SMT 2",
                field: "smt2",
                hozAlign: "center",
                width: 100
            },


            {
                title: "SMT 3",
                field: "smt3",
                hozAlign: "center",
                width: 100
            },
            {
                title: "SMT 4",
                field: "smt4",
                hozAlign: "center",
                width: 100
            },
            {
                title: "SMT 5",
                field: "smt5",
                hozAlign: "center",
                width: 100
            },

            {
                title: "SMT 6",
                field: "smt6",
                hozAlign: "center",
                width: 100
            },


            {
                title: "Ket",
                field: "ket",
                width: 100
            },


            {
                title: "Aksi",
                hozAlign: "center",
                width: 120,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `
                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                title="Edit"
                                onclick='editMapel(${JSON.stringify(data)})'
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
                                onclick="deleteMapel(${data.id})"
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
| Modal Tambah
|--------------------------------------------------------------------------
*/

function openModalMapel(type = 'add')
{
    const modal =
        document.getElementById('modal-mapel');

    const title =
        document.getElementById('modal-mapel-title');


    if (type === 'add') {

        title.textContent =
            'Tambah Mata Pelajaran';

        document.getElementById('mapel_id').value = '';

        document.getElementById('nama_mapel').value = '';

        document.getElementById('id_jurusan').value = '';

        document.getElementById('id_kategori_mapel').value = '';

        document.getElementById('kurikulum').value = '';

        for (let i = 1; i <= 6; i++) {

            document.getElementById('smt' + i).value = 0;

        }

        document.getElementById('ket').value = '';

    }


    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Modal Edit
|--------------------------------------------------------------------------
*/

function editMapel(data)
{
    document.getElementById('mapel_id').value =
        data.id ?? '';

    document.getElementById('nama_mapel').value =
        data.nama_mapel ?? '';

    document.getElementById('id_jurusan').value =
        data.id_jurusan ?? '';

    document.getElementById('id_kategori_mapel').value =
        data.id_kategori_mapel ?? '';

    document.getElementById('kurikulum').value =
        data.kurikulum ?? '';

    document.getElementById('smt1').value =
        data.smt1 ?? 0;

    document.getElementById('smt2').value =
        data.smt2 ?? 0;

    document.getElementById('smt3').value =
        data.smt3 ?? 0;

    document.getElementById('smt4').value =
        data.smt4 ?? 0;

    document.getElementById('smt5').value =
        data.smt5 ?? 0;

    document.getElementById('smt6').value =
        data.smt6 ?? 0;

    document.getElementById('ket').value =
        data.ket ?? '';


    document.getElementById('modal-mapel-title').textContent =
        'Edit Mata Pelajaran';


    const modal =
        document.getElementById('modal-mapel');

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Tutup Modal
|--------------------------------------------------------------------------
*/

function closeModalMapel()
{
    const modal =
        document.getElementById('modal-mapel');

    modal.classList.add('hidden');

    modal.classList.remove('flex');
}


/*
|--------------------------------------------------------------------------
| Simpan
|--------------------------------------------------------------------------
*/

function saveData()
{
    let id =
        document.getElementById('mapel_id').value;

    let isEdit =
        id !== '';


    let url = isEdit
        ? "{{ url('mapel/update') }}/" + id
        : "{{ url('mapel/store') }}";


    let button =
        document.getElementById('btn-save-mapel');

    button.disabled = true;


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

            nama_mapel:
                document.getElementById('nama_mapel').value,

            id_jurusan:
                document.getElementById('id_jurusan').value,

            id_kategori_mapel:
                document.getElementById('id_kategori_mapel').value,

            kurikulum:
                document.getElementById('kurikulum').value,

            smt1:
                document.getElementById('smt1').value,

            smt2:
                document.getElementById('smt2').value,

            smt3:
                document.getElementById('smt3').value,

            smt4:
                document.getElementById('smt4').value,

            smt5:
                document.getElementById('smt5').value,

            smt6:
                document.getElementById('smt6').value,

            ket:
                document.getElementById('ket').value

        })

    })

    .then(res => res.json())

    .then(res => {

        if (res.success !== false) {

            closeModalMapel();

            table.replaceData();

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

    });
}


/*
|--------------------------------------------------------------------------
| Hapus
|--------------------------------------------------------------------------
*/

function deleteMapel(id)
{
    if (!confirm('Yakin ingin menghapus data ini ?')) {

        return;

    }


    fetch(
        "{{ url('mapel/delete') }}/" + id,
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

        if (res.success !== false) {

            table.replaceData();

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
| Filter
|--------------------------------------------------------------------------
*/

function loadDataMapel()
{
    table.setData(
        "{{ route('mapel.data') }}",
        {

            id_jurusan:
                document.getElementById(
                    'filter_jurusan'
                ).value,

            kurikulum:
                document.getElementById(
                    'filter_kurikulum'
                ).value,

            keyword:
                document.getElementById(
                    'filter_keyword'
                ).value

        }
    );
}


/*
|--------------------------------------------------------------------------
| Reset Filter
|--------------------------------------------------------------------------
*/

function resetFilterMapel()
{
    document.getElementById(
        'filter_jurusan'
    ).value = '';

    document.getElementById(
        'filter_kurikulum'
    ).value = '';

    document.getElementById(
        'filter_keyword'
    ).value = '';

    table.setData(
        "{{ route('mapel.data') }}"
    );
}


/*
|--------------------------------------------------------------------------
| Enter pada pencarian
|--------------------------------------------------------------------------
*/

document
    .getElementById('filter_keyword')
    .addEventListener('keydown', function(event) {

        if (event.key === 'Enter') {

            loadDataMapel();

        }

    });


/*
|--------------------------------------------------------------------------
| Klik Overlay
|--------------------------------------------------------------------------
*/

document
    .getElementById('modal-mapel')
    .addEventListener('click', function(event) {

        if (event.target === this) {

            closeModalMapel();

        }

    });


/*
|--------------------------------------------------------------------------
| Escape
|--------------------------------------------------------------------------
*/

document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {

        const modal =
            document.getElementById('modal-mapel');

        if (!modal.classList.contains('hidden')) {

            closeModalMapel();

        }

    }

});

</script>

@endsection
