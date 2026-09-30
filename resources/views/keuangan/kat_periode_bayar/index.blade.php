
@extends('layout.app')

@section('title', 'Kategori Periode Bayar')
@section('page_title', 'Kategori Periode Bayar')

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
                Kategori Periode Bayar
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola kategori periode pembayaran.
            </p>

        </div>

        {{-- Tombol Tambah --}}
        <button type="button"
                onclick="openModalPeriodeBayar()"
                class="inline-flex items-center justify-center gap-2
                       bg-[#00bfa5] hover:bg-[#00a892]
                       text-white font-semibold
                       px-4 py-2.5 rounded-lg
                       shadow-sm hover:shadow
                       transition-all">

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

            Tambah Data

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
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

            </div>

            <div>
                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Kategori Periode
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Data kategori periode pembayaran
                </p>
            </div>

        </div>


        {{-- Table --}}
        <div class="p-5">

            <div id="tableData"></div>

        </div>

    </section>

</main>


{{-- Modal --}}
<div id="modal-form"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-lg
                max-h-[90vh] overflow-y-auto
                rounded-2xl bg-white shadow-2xl">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between
                    px-6 py-4
                    border-b border-slate-200">

            <div class="flex items-center gap-3">

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
                              d="M12 4v16m8-8H4"/>
                    </svg>

                </div>

                <div>

                    <h3 id="modal-title"
                        class="text-lg font-semibold text-slate-900">
                        Tambah Kategori Periode
                    </h3>

                    <p class="text-xs text-slate-500">
                        Masukkan nama kategori periode pembayaran.
                    </p>

                </div>

            </div>

            <button type="button"
                    onclick="closeModalPeriodeBayar()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-slate-400
                           hover:text-slate-600
                           hover:bg-slate-100
                           transition-colors">

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


        {{-- Modal Body --}}
        <div class="p-6">

            <input type="hidden" id="id">

            <label for="nama_kategori"
                   class="block text-sm font-semibold text-slate-700 mb-2">
                Nama Kategori
            </label>

            <input type="text"
                   id="nama_kategori"
                   placeholder="Contoh: SPP Bulanan"
                   class="w-full rounded-xl
                          border border-slate-300
                          px-4 py-3
                          text-sm text-slate-800
                          placeholder:text-slate-400
                          focus:border-[#02BC9C]
                          focus:ring-2 focus:ring-[#02BC9C]/20
                          outline-none transition">

            <p id="nama_kategori_error"
               class="hidden mt-2 text-xs text-red-600"></p>

        </div>


        {{-- Modal Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4
                    border-t border-slate-200
                    bg-slate-50 rounded-b-2xl">

            <button type="button"
                    onclick="closeModalPeriodeBayar()"
                    class="inline-flex items-center justify-center
                           px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-100
                           transition-colors">

                Batal

            </button>

            <button type="button"
                    id="btn-simpan"
                    onclick="saveData()"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-[#00bfa5] hover:bg-[#00a892]
                           text-white text-sm font-semibold
                           shadow-sm transition-all">

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

let table = new Tabulator("#tableData", {

    ajaxURL: "{{ route('kat-periode-bayar.data') }}",

    layout: "fitColumns",

    height: "500px",

    pagination: true,

    paginationSize: 10,

    placeholder: "Data tidak ditemukan",

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
            width: 120,
            hozAlign: "center",

            formatter: function(cell) {

                let row = cell.getData();

                return `
                    <div class="flex items-center justify-center gap-2">

                        <button
                            type="button"
                            onclick='editPeriodeBayar(${JSON.stringify(row)})'
                            title="Edit"
                            class="inline-flex items-center justify-center
                                   w-9 h-9 rounded-lg
                                   bg-amber-50 text-amber-600
                                   border border-amber-100
                                   hover:bg-amber-100
                                   transition-colors">

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
                            onclick="deletePeriodeBayar(${row.id})"
                            title="Hapus"
                            class="inline-flex items-center justify-center
                                   w-9 h-9 rounded-lg
                                   bg-red-50 text-red-600
                                   border border-red-100
                                   hover:bg-red-100
                                   transition-colors">

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
                                      d="M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M19 6l-1 14H6L5 6"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M10 11v5M14 11v5"/>

                            </svg>

                        </button>

                    </div>
                `;
            }
        }

    ]

});


function openModalPeriodeBayar()
{
    document.getElementById('id').value = '';

    document.getElementById('nama_kategori').value = '';

    document.getElementById('modal-title').textContent =
        'Tambah Kategori Periode';

    document.getElementById('nama_kategori_error').classList.add('hidden');

    const modal = document.getElementById('modal-form');

    modal.classList.remove('hidden');

    modal.classList.add('flex');

    document.getElementById('nama_kategori').focus();
}


function closeModalPeriodeBayar()
{
    const modal = document.getElementById('modal-form');

    modal.classList.add('hidden');

    modal.classList.remove('flex');
}


function editPeriodeBayar(data)
{
    document.getElementById('id').value =
        data.id ?? '';

    document.getElementById('nama_kategori').value =
        data.nama_kategori ?? '';

    document.getElementById('modal-title').textContent =
        'Edit Kategori Periode';

    document.getElementById('nama_kategori_error').classList.add('hidden');

    const modal = document.getElementById('modal-form');

    modal.classList.remove('hidden');

    modal.classList.add('flex');

    document.getElementById('nama_kategori').focus();
}


function saveData()
{
    const id =
        document.getElementById('id').value;

    const namaKategori =
        document.getElementById('nama_kategori').value.trim();

    const errorElement =
        document.getElementById('nama_kategori_error');

    const button =
        document.getElementById('btn-simpan');

    errorElement.classList.add('hidden');

    if (!namaKategori) {

        errorElement.textContent =
            'Nama kategori wajib diisi.';

        errorElement.classList.remove('hidden');

        return;
    }

    const isEdit = id !== '';

    const url = isEdit
        ? "{{ url('kat-periode-bayar/update') }}/" + id
        : "{{ url('kat-periode-bayar/store') }}";

    button.disabled = true;

    button.innerHTML = `
        <svg class="w-4 h-4 animate-spin"
             xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24">

            <circle class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4">
            </circle>

            <path class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
            </path>

        </svg>

        Menyimpan...
    `;

    fetch(url, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN': '{{ csrf_token() }}',

            'Accept': 'application/json'

        },

        body: JSON.stringify({

            nama_kategori: namaKategori

        })

    })
    .then(async response => {

        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;

    })
    .then(res => {

        closeModalPeriodeBayar();

        table.replaceData();

    })
    .catch(err => {

        console.log(err);

        if (err.errors && err.errors.nama_kategori) {

            errorElement.textContent =
                err.errors.nama_kategori[0];

            errorElement.classList.remove('hidden');

        } else {

            alert(
                err.message ||
                'Gagal menyimpan data.'
            );

        }

    })
    .finally(() => {

        button.disabled = false;

        button.innerHTML = `
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
        `;

    });
}


function deletePeriodeBayar(id)
{
    if (!confirm('Hapus data?')) {
        return;
    }

    fetch(
        "{{ url('kat-periode-bayar/delete') }}/" + id,
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
    .then(async response => {

        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;

    })
    .then(res => {

        table.replaceData();

        alert('Berhasil dihapus');

    })
    .catch(err => {

        console.log(err);

        alert(
            err.message ||
            'Gagal menghapus data'
        );

    });
}


// Klik backdrop untuk menutup modal
document.getElementById('modal-form')
    .addEventListener('click', function(e) {

        if (e.target === this) {
            closeModalPeriodeBayar();
        }

    });


// Tombol Escape untuk menutup modal
document.addEventListener('keydown', function(e) {

    if (e.key === 'Escape') {
        closeModalPeriodeBayar();
    }

});

</script>

@endsection

