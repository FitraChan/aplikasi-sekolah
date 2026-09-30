
@extends('layout.app')

@section('title', 'Pengumuman')
@section('page_title', 'Pengumuman')

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
                Pengumuman
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola informasi dan pengumuman yang ditampilkan kepada pengguna.
            </p>
        </div>


        <button type="button"
                onclick="openModalPengumuman('add')"
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

            Tambah Pengumuman

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
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10 21h4"/>

                </svg>

            </div>

            <div>

                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Pengumuman
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Kelola judul, kategori, status, prioritas, dan target pengumuman.
                </p>

            </div>

        </div>


        {{-- Table --}}
        <div class="p-5">

            <div id="table-pengumuman"></div>

        </div>

    </section>

</main>


{{-- =========================================================
     MODAL PENGUMUMAN
========================================================= --}}
<div id="modal-pengumuman"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-3xl max-h-[90vh] overflow-y-auto
                rounded-2xl bg-white shadow-2xl">

        {{-- Modal Header --}}
        <div class="flex items-center justify-between
                    px-6 py-4 border-b border-slate-200">

            <div>

                <h3 id="modal-pengumuman-title"
                    class="text-lg font-semibold text-slate-800">
                    Tambah Pengumuman
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Isi informasi pengumuman dengan lengkap.
                </p>

            </div>


            <button type="button"
                    onclick="closeModalPengumuman()"
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

            <input type="hidden" id="pengumuman_id">


            {{-- Kategori --}}
            <div>

                <label for="kategori_id"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Kategori
                </label>

                <select id="kategori_id"
                        class="w-full rounded-lg border border-slate-300
                               bg-white px-3 py-2.5 text-sm text-slate-700
                               outline-none
                               focus:border-teal-500
                               focus:ring-2 focus:ring-teal-100">

                    <option value="">
                        Pilih Kategori
                    </option>

                    @foreach($kategori ?? [] as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_kategori ?? $item->nama }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Judul --}}
            <div>

                <label for="judul"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Judul Pengumuman
                    <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       id="judul"
                       placeholder="Masukkan judul pengumuman"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm text-slate-700
                              outline-none
                              focus:border-teal-500
                              focus:ring-2 focus:ring-teal-100">

            </div>


            {{-- Isi --}}
            <div>

                <label for="isi"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Isi Pengumuman
                    <span class="text-red-500">*</span>
                </label>

                <textarea id="isi"
                          rows="6"
                          placeholder="Tulis isi pengumuman..."
                          class="w-full rounded-lg border border-slate-300
                                 px-3 py-2.5 text-sm text-slate-700
                                 outline-none resize-y
                                 focus:border-teal-500
                                 focus:ring-2 focus:ring-teal-100"></textarea>

            </div>


            {{-- Prioritas & Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <label for="prioritas"
                           class="block text-sm font-medium text-slate-700 mb-2">
                        Prioritas
                    </label>

                    <select id="prioritas"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-100">

                        <option value="normal">
                            Normal
                        </option>

                        <option value="penting">
                            Penting
                        </option>

                        <option value="darurat">
                            Darurat
                        </option>

                    </select>

                </div>


                <div>

                    <label for="status"
                           class="block text-sm font-medium text-slate-700 mb-2">
                        Status
                    </label>

                    <select id="status"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-2 focus:ring-teal-100">

                        <option value="draft">
                            Draft
                        </option>

                        <option value="published">
                            Published
                        </option>

                        <option value="archived">
                            Archived
                        </option>

                    </select>

                </div>

            </div>


            {{-- Tanggal --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <label for="publish_at"
                           class="block text-sm font-medium text-slate-700 mb-2">
                        Tanggal Publish
                    </label>

                    <input type="datetime-local"
                           id="publish_at"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm text-slate-700
                                  outline-none
                                  focus:border-teal-500
                                  focus:ring-2 focus:ring-teal-100">

                </div>


                <div>

                    <label for="expired_at"
                           class="block text-sm font-medium text-slate-700 mb-2">
                        Tanggal Expired
                    </label>

                    <input type="datetime-local"
                           id="expired_at"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm text-slate-700
                                  outline-none
                                  focus:border-teal-500
                                  focus:ring-2 focus:ring-teal-100">

                </div>

            </div>


            {{-- Target --}}
            <div class="border border-slate-200 rounded-xl p-4 bg-slate-50/50">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-teal-50
                                text-teal-600 flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h4 class="text-sm font-semibold text-slate-700">
                            Target Pengumuman
                        </h4>

                        <p class="text-xs text-slate-500">
                            Tentukan siapa yang dapat melihat pengumuman.
                        </p>

                    </div>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div>

                        <label for="target_type"
                               class="block text-sm font-medium text-slate-700 mb-2">
                            Target
                        </label>

                        <select id="target_type"
                                onchange="ubahTargetPengumuman()"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm text-slate-700
                                       outline-none
                                       focus:border-teal-500
                                       focus:ring-2 focus:ring-teal-100">

                            <option value="">
                                Semua
                            </option>

                            <option value="siswa">
                                Siswa
                            </option>

                            <option value="kelas">
                                Kelas
                            </option>

                            <option value="pendaftar">
                                Pendaftar
                            </option>

                            <option value="gelombang_pendaftaran">
                                Gelombang Pendaftaran
                            </option>

                            <option value="jalur_pendaftaran">
                                Jalur Pendaftaran
                            </option>

                        </select>

                    </div>


                    <div id="target_id_container"
                         class="hidden">

                        <label id="target_id_label"
                               for="target_id"
                               class="block text-sm font-medium text-slate-700 mb-2">
                            ID Target
                        </label>

                        <input type="text"
                               id="target_id"
                               placeholder="Masukkan ID"
                               class="w-full rounded-lg border border-slate-300
                                      px-3 py-2.5 text-sm text-slate-700
                                      outline-none
                                      focus:border-teal-500
                                      focus:ring-2 focus:ring-teal-100">

                    </div>

                </div>

            </div>


            {{-- Lampiran --}}
            <div>

                <label for="lampiran"
                       class="block text-sm font-medium text-slate-700 mb-2">
                    Lampiran
                </label>

                <div class="relative">

                    <input type="file"
                           id="lampiran"
                           class="block w-full text-sm text-slate-600
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-lg file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-teal-50 file:text-teal-700
                                  hover:file:bg-teal-100
                                  border border-slate-300 rounded-lg
                                  cursor-pointer">

                </div>

                <p class="text-xs text-slate-500 mt-1.5">
                    Pilih file lampiran jika diperlukan.
                </p>

            </div>


            {{-- Pinned --}}
            <div class="flex items-center justify-between
                        rounded-lg border border-slate-200
                        px-4 py-3">

                <div>

                    <div class="text-sm font-medium text-slate-700">
                        Jadikan Pinned
                    </div>

                    <div class="text-xs text-slate-500 mt-0.5">
                        Pengumuman akan ditampilkan di bagian atas.
                    </div>

                </div>

                <label class="relative inline-flex items-center cursor-pointer">

                    <input type="checkbox"
                           id="is_pinned"
                           class="sr-only peer">

                    <div class="w-11 h-6 bg-slate-200 rounded-full
                                peer peer-checked:bg-teal-500
                                after:content-['']
                                after:absolute after:top-[2px] after:left-[2px]
                                after:bg-white after:border-slate-300
                                after:border after:rounded-full
                                after:h-5 after:w-5
                                after:transition-all
                                peer-checked:after:translate-x-full
                                peer-checked:after:border-white">
                    </div>

                </label>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4 border-t border-slate-200
                    bg-slate-50/70">

            <button type="button"
                    onclick="closeModalPengumuman()"
                    class="px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-50 transition">

                Batal

            </button>


            <button type="button"
                    id="btn-save-pengumuman"
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


/*
|--------------------------------------------------------------------------
| Tabulator
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function () {

    table = new Tabulator("#table-pengumuman", {

        ajaxURL: "{{ route('pengumuman.data') }}",

        layout: "fitColumns",

        height: "500px",

        pagination: true,

        paginationSize: 10,

        paginationSizeSelector: [10, 25, 50, 100],

        placeholder: "Belum ada data pengumuman",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 65,
                headerSort: false
            },


            {
                title: "Judul",
                field: "judul",
                minWidth: 220
            },


            {
                title: "Kategori",
                field: "kategori",
                width: 150
            },


            {
                title: "Prioritas",
                field: "prioritas",
                width: 120,
                hozAlign: "center",

                formatter: function(cell) {

                    let value = cell.getValue();

                    if (value === 'darurat') {

                        return `
                            <span class="inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-red-50 text-red-700
                                         border border-red-100">
                                Darurat
                            </span>
                        `;

                    }

                    if (value === 'penting') {

                        return `
                            <span class="inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-amber-50 text-amber-700
                                         border border-amber-100">
                                Penting
                            </span>
                        `;

                    }

                    return `
                        <span class="inline-flex items-center
                                     px-2.5 py-1 rounded-full
                                     text-xs font-semibold
                                     bg-slate-100 text-slate-600
                                     border border-slate-200">
                            Normal
                        </span>
                    `;

                }
            },


            {
                title: "Status",
                field: "status",
                width: 125,
                hozAlign: "center",

                formatter: function(cell) {

                    let value = cell.getValue();

                    if (value === 'published') {

                        return `
                            <span class="inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-emerald-50 text-emerald-700
                                         border border-emerald-100">
                                Published
                            </span>
                        `;

                    }

                    if (value === 'archived') {

                        return `
                            <span class="inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-slate-800 text-white">
                                Archived
                            </span>
                        `;

                    }

                    return `
                        <span class="inline-flex items-center
                                     px-2.5 py-1 rounded-full
                                     text-xs font-semibold
                                     bg-slate-100 text-slate-600
                                     border border-slate-200">
                            Draft
                        </span>
                    `;

                }
            },


            {
                title: "Tanggal Publish",
                field: "publish_at",
                width: 170
            },


            {
                title: "Pinned",
                field: "is_pinned",
                width: 100,
                hozAlign: "center",

                formatter: function(cell) {

                    return cell.getValue() == 1

                        ? `
                            <span class="inline-flex items-center gap-1
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-teal-50 text-teal-700
                                         border border-teal-100">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-3.5 h-3.5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M5 5h14M5 12h14M5 19h14"/>

                                </svg>

                                Ya

                            </span>
                          `

                        : `
                            <span class="text-xs text-slate-400">
                                Tidak
                            </span>
                          `;

                }
            },


            {
                title: "Aksi",
                hozAlign: "center",
                width: 120,
                headerSort: false,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `
                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                title="Edit"
                                onclick='editPengumuman(${JSON.stringify(data)})'
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
                                onclick="deletePengumuman(${data.id})"
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

function openModalPengumuman(type = 'add')
{
    const modal =
        document.getElementById('modal-pengumuman');

    if (type === 'add') {

        document.getElementById('modal-pengumuman-title').textContent =
            'Tambah Pengumuman';

        document.getElementById('pengumuman_id').value = '';

        document.getElementById('kategori_id').value = '';

        document.getElementById('judul').value = '';

        document.getElementById('isi').value = '';

        document.getElementById('prioritas').value = 'normal';

        document.getElementById('status').value = 'draft';

        document.getElementById('publish_at').value = '';

        document.getElementById('expired_at').value = '';

        document.getElementById('target_type').value = '';

        document.getElementById('target_id').value = '';

        document.getElementById('target_id_container')
            .classList.add('hidden');

        document.getElementById('lampiran').value = '';

        document.getElementById('is_pinned').checked = false;

    }

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Edit
|--------------------------------------------------------------------------
*/

function editPengumuman(data)
{
    document.getElementById('pengumuman_id').value =
        data.id ?? '';

    document.getElementById('kategori_id').value =
        data.kategori_id ?? '';

    document.getElementById('judul').value =
        data.judul ?? '';

    document.getElementById('isi').value =
        data.isi ?? '';

    document.getElementById('prioritas').value =
        data.prioritas ?? 'normal';

    document.getElementById('status').value =
        data.status ?? 'draft';

    document.getElementById('publish_at').value =
        formatDateTimeLocal(data.publish_at);

    document.getElementById('expired_at').value =
        formatDateTimeLocal(data.expired_at);

    document.getElementById('target_type').value =
        data.target_type ?? '';

    document.getElementById('target_id').value =
        data.target_id ?? '';

    document.getElementById('is_pinned').checked =
        data.is_pinned == 1;


    document.getElementById('modal-pengumuman-title').textContent =
        'Edit Pengumuman';


    ubahTargetPengumuman();


    const modal =
        document.getElementById('modal-pengumuman');

    modal.classList.remove('hidden');

    modal.classList.add('flex');
}


/*
|--------------------------------------------------------------------------
| Format DateTime
|--------------------------------------------------------------------------
*/

function formatDateTimeLocal(value)
{
    if (!value) {

        return '';

    }

    return value
        .replace(' ', 'T')
        .substring(0, 16);
}


/*
|--------------------------------------------------------------------------
| Tutup Modal
|--------------------------------------------------------------------------
*/

function closeModalPengumuman()
{
    const modal =
        document.getElementById('modal-pengumuman');

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
        document.getElementById('pengumuman_id').value;

    let isEdit =
        id !== '';


    let url = isEdit
        ? "{{ url('pengumuman/update') }}/" + id
        : "{{ url('pengumuman/store') }}";


    let aksi =
        isEdit ? "PUT" : "POST";


    let formData =
        new FormData();


    formData.append(
        'kategori_id',
        document.getElementById('kategori_id').value
    );


    formData.append(
        'judul',
        document.getElementById('judul').value
    );


    formData.append(
        'isi',
        document.getElementById('isi').value
    );


    formData.append(
        'prioritas',
        document.getElementById('prioritas').value
    );


    formData.append(
        'status',
        document.getElementById('status').value
    );


    formData.append(
        'publish_at',
        document.getElementById('publish_at').value
    );


    formData.append(
        'expired_at',
        document.getElementById('expired_at').value
    );


    formData.append(
        'is_pinned',
        document.getElementById('is_pinned').checked
            ? 1
            : 0
    );


    formData.append(
        'target_type',
        document.getElementById('target_type').value
    );


    formData.append(
        'target_id',
        document.getElementById('target_id').value
    );


    let lampiran =
        document.getElementById('lampiran').files[0];


    if (lampiran) {

        formData.append(
            'lampiran',
            lampiran
        );

    }


    let button =
        document.getElementById('btn-save-pengumuman');

    button.disabled = true;


    fetch(url, {

        method: aksi,

        headers: {

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}',

            'Accept':
                'application/json'

        },

        body: formData

    })

    .then(async res => {

        let response =
            await res.json();

        if (!res.ok) {

            throw response;

        }

        return response;

    })

    .then(res => {

        closeModalPengumuman();

        table.replaceData();

        alert(
            res.message ??
            'Data berhasil disimpan'
        );

    })

    .catch(error => {

        console.error(error);

        if (error.errors) {

            let pesan =
                Object.values(error.errors)
                    .flat()
                    .join('\n');

            alert(pesan);

            return;

        }

        alert(
            error.message ??
            'Terjadi kesalahan saat menyimpan data'
        );

    })

    .finally(() => {

        button.disabled = false;

    });
}


/*
|--------------------------------------------------------------------------
| Target Pengumuman
|--------------------------------------------------------------------------
*/

function ubahTargetPengumuman()
{
    let targetType =
        document.getElementById(
            'target_type'
        ).value;


    let targetIdContainer =
        document.getElementById(
            'target_id_container'
        );


    let targetIdLabel =
        document.getElementById(
            'target_id_label'
        );


    targetIdContainer.classList.add('hidden');


    document.getElementById(
        'target_id'
    ).value = '';


    if (targetType === 'siswa') {

        targetIdContainer.classList.remove('hidden');

        targetIdLabel.innerText =
            'ID Siswa';

    }


    if (targetType === 'kelas') {

        targetIdContainer.classList.remove('hidden');

        targetIdLabel.innerText =
            'ID Kelas';

    }


    if (targetType === 'pendaftar') {

        targetIdContainer.classList.remove('hidden');

        targetIdLabel.innerText =
            'ID Pendaftar';

    }


    if (targetType === 'gelombang_pendaftaran') {

        targetIdContainer.classList.remove('hidden');

        targetIdLabel.innerText =
            'ID Gelombang';

    }


    if (targetType === 'jalur_pendaftaran') {

        targetIdContainer.classList.remove('hidden');

        targetIdLabel.innerText =
            'ID Jalur Pendaftaran';

    }

}


/*
|--------------------------------------------------------------------------
| Hapus
|--------------------------------------------------------------------------
*/

function deletePengumuman(id)
{
    if (!confirm(
        'Yakin ingin menghapus data pengumuman ini ?'
    )) {

        return;

    }


    fetch(
        "{{ url('pengumuman/delete') }}/" + id,
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

            alert(
                res.message ??
                'Data berhasil dihapus'
            );

        } else {

            alert(
                res.message ??
                'Gagal menghapus data'
            );

        }

    })

    .catch(error => {

        console.error(error);

        alert(
            'Gagal menghapus data'
        );

    });
}


/*
|--------------------------------------------------------------------------
| Klik Overlay
|--------------------------------------------------------------------------
*/

document
    .getElementById('modal-pengumuman')
    .addEventListener('click', function(event) {

        if (event.target === this) {

            closeModalPengumuman();

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
            document.getElementById('modal-pengumuman');

        if (!modal.classList.contains('hidden')) {

            closeModalPengumuman();

        }

    }

});

</script>

@endsection

