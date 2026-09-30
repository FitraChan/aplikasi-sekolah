
@extends('layout.app')

@section('title', 'Kategori Item Bayar')
@section('page_title', 'Kategori Item Bayar')

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
                Kategori Item Bayar
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola item pembayaran dan nominal biaya yang digunakan.
            </p>

        </div>


        {{-- Tombol Tambah --}}
        <button type="button"
                onclick="openModalItemBayar()"
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
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 5a3 3 0 016 0v0a3 3 0 01-6 0z"/>
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 13h6M9 17h4"/>
                </svg>

            </div>

            <div>

                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Item Pembayaran
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Data item, kategori, periode, dan nominal pembayaran
                </p>

            </div>

        </div>


        {{-- Table --}}
        <div class="p-5">

            <div id="tableData"></div>

        </div>

    </section>

</main>


{{-- ========================================================= --}}
{{-- MODAL --}}
{{-- ========================================================= --}}

<div id="modal-form"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-2xl
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
                        Tambah Item Pembayaran
                    </h3>

                    <p class="text-xs text-slate-500">
                        Isi informasi item pembayaran.
                    </p>

                </div>

            </div>


            <button type="button"
                    onclick="closeModalItemBayar()"
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
        <div class="p-6 space-y-5">

            <input type="hidden" id="id">


            {{-- Nama Item --}}
            <div>

                <label for="nama_item"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Nama Item
                </label>

                <input type="text"
                       id="nama_item"
                       placeholder="Contoh: SPP Bulanan"
                       class="w-full rounded-xl
                              border border-slate-300
                              px-4 py-3
                              text-sm text-slate-800
                              placeholder:text-slate-400
                              focus:border-[#02BC9C]
                              focus:ring-2 focus:ring-[#02BC9C]/20
                              outline-none transition">

            </div>


            {{-- Kategori & Periode --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Kategori --}}
                <div>

                    <label for="id_kategori"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Kategori
                    </label>

                    <select id="id_kategori"
                            class="w-full rounded-xl
                                   border border-slate-300
                                   bg-white
                                   px-4 py-3
                                   text-sm text-slate-800
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20
                                   outline-none transition">

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach($kategori ?? [] as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- Periode --}}
                <div>

                    <label for="id_kat_periode"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Periode
                    </label>

                    <select id="id_kat_periode"
                            class="w-full rounded-xl
                                   border border-slate-300
                                   bg-white
                                   px-4 py-3
                                   text-sm text-slate-800
                                   focus:border-[#02BC9C]
                                   focus:ring-2 focus:ring-[#02BC9C]/20
                                   outline-none transition">

                        <option value="">
                            Pilih Periode
                        </option>

                        @foreach($periode ?? [] as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach

                    </select>

                </div>

            </div>


            {{-- Default --}}
            <div>

                <label for="def_value"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Nominal Default
                </label>

                <div class="relative">

                    <span class="absolute left-4 top-1/2 -translate-y-1/2
                                 text-sm font-semibold text-slate-500">
                        Rp
                    </span>

                    <input type="number"
                           id="def_value"
                           min="0"
                           placeholder="0"
                           class="w-full rounded-xl
                                  border border-slate-300
                                  pl-11 pr-4 py-3
                                  text-sm text-slate-800
                                  placeholder:text-slate-400
                                  focus:border-[#02BC9C]
                                  focus:ring-2 focus:ring-[#02BC9C]/20
                                  outline-none transition">

                </div>

            </div>


            {{-- Keterangan --}}
            <div>

                <label for="keterangan"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Keterangan
                </label>

                <textarea id="keterangan"
                          rows="3"
                          placeholder="Keterangan item pembayaran..."
                          class="w-full rounded-xl
                                 border border-slate-300
                                 px-4 py-3
                                 text-sm text-slate-800
                                 placeholder:text-slate-400
                                 focus:border-[#02BC9C]
                                 focus:ring-2 focus:ring-[#02BC9C]/20
                                 outline-none transition"></textarea>

            </div>

        </div>


        {{-- Modal Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4
                    border-t border-slate-200
                    bg-slate-50 rounded-b-2xl">

            <button type="button"
                    onclick="closeModalItemBayar()"
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

    ajaxURL: "{{ route('item-bayar.data') }}",

    layout: "fitColumns",

    height: "500px",

    pagination: true,

    paginationSize: 10,

    placeholder: "Data tidak ditemukan",

    columns: [

        {
            title: "ID",
            field: "id",
            width: 70,
            hozAlign: "center"
        },

        {
            title: "Nama Item",
            field: "nama_item",
            minWidth: 180
        },

        {
            title: "Kategori",
            field: "kategori",
            minWidth: 150
        },

        {
            title: "Periode",
            field: "periode",
            minWidth: 130
        },

        {
            title: "Default",
            field: "def_value",
            hozAlign: "right",
            minWidth: 140,

            formatter: function(cell) {

                let value = cell.getValue() || 0;

                return new Intl.NumberFormat('id-ID', {

                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0

                }).format(value);

            }
        },

        {
            title: "Keterangan",
            field: "keterangan",
            minWidth: 200
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
                            onclick='editItemBayar(${JSON.stringify(row)})'
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
                            onclick="deleteItemBayar(${row.id})"
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


function openModalItemBayar()
{
    document.getElementById('id').value = '';

    document.getElementById('nama_item').value = '';
    document.getElementById('id_kategori').value = '';
    document.getElementById('id_kat_periode').value = '';
    document.getElementById('def_value').value = '';
    document.getElementById('keterangan').value = '';

    document.getElementById('modal-title').textContent =
        'Tambah Item Pembayaran';

    const modal = document.getElementById('modal-form');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('nama_item').focus();
}


function closeModalItemBayar()
{
    const modal = document.getElementById('modal-form');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}


function editItemBayar(data)
{
    document.getElementById('id').value =
        data.id ?? '';

    document.getElementById('nama_item').value =
        data.nama_item ?? '';

    document.getElementById('id_kategori').value =
        data.id_kategori ?? '';

    document.getElementById('id_kat_periode').value =
        data.id_kat_periode ?? '';

    document.getElementById('def_value').value =
        data.def_value ?? '';

    document.getElementById('keterangan').value =
        data.keterangan ?? '';

    document.getElementById('modal-title').textContent =
        'Edit Item Pembayaran';

    const modal = document.getElementById('modal-form');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('nama_item').focus();
}


function saveData()
{
    const id =
        document.getElementById('id').value;

    const isEdit = id !== '';

    const url = isEdit
        ? "{{ url('item-bayar/update') }}/" + id
        : "{{ url('item-bayar/store') }}";

    const button =
        document.getElementById('btn-simpan');

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

            nama_item:
                document.getElementById('nama_item').value,

            id_kategori:
                document.getElementById('id_kategori').value,

            id_kat_periode:
                document.getElementById('id_kat_periode').value,

            def_value:
                document.getElementById('def_value').value,

            keterangan:
                document.getElementById('keterangan').value

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

        closeModalItemBayar();

        table.replaceData();

    })
    .catch(err => {

        console.log(err);

        alert(
            err.message ||
            'Gagal menyimpan data.'
        );

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


function deleteItemBayar(id)
{
    if (!confirm('Hapus data?')) {
        return;
    }

    fetch(
        "{{ url('item-bayar/delete') }}/" + id,
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
            closeModalItemBayar();
        }

    });


// Tombol Escape
document.addEventListener('keydown', function(e) {

    if (e.key === 'Escape') {
        closeModalItemBayar();
    }

});

</script>

@endsection

