@extends('layout.app')

@section('title', 'Template Bayar')
@section('page_title', 'Template Bayar')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2 text-sm font-medium
                          text-[#02BC9C] hover:text-[#02a387] transition-colors">

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
                Template Bayar
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola template pembayaran dan detail item pembayaran.
            </p>

        </div>


        {{-- Tambah Template --}}
        <button type="button"
                onclick="openModalTemplate('add')"
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

            Tambah Template

        </button>

    </div>


    {{-- ========================================================= --}}
    {{-- GRID --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">


        {{-- ===================================================== --}}
        {{-- TEMPLATE BAYAR --}}
        {{-- ===================================================== --}}

        <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

            {{-- Header --}}
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
                              d="M4 6h16M4 10h16M4 14h10M4 18h7"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-base font-semibold text-slate-800">
                        Data Template Bayar
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Daftar template pembayaran
                    </p>

                </div>

            </div>


            {{-- Filter --}}
            <div class="p-5 border-b border-slate-200 bg-slate-50/50">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                    {{-- Tahun --}}
                    <div>

                        <label for="filter-tahun"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Tahun Ajaran

                        </label>

                        <select id="filter-tahun"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white
                                       px-4 py-3
                                       text-sm text-slate-800
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none transition">

                            <option value="">
                                Semua Tahun Ajaran
                            </option>

                            @foreach($tahun as $itemTahun)

                                <option value="{{ $itemTahun->id }}">
                                    {{ $itemTahun->thn_ajaran }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Gelombang --}}
                    <div>

                        <label for="filter-gelombang"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Gelombang

                        </label>

                        <select id="filter-gelombang"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white
                                       px-4 py-3
                                       text-sm text-slate-800
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none transition">

                            <option value="">
                                Semua Gelombang
                            </option>

                            @foreach($gelombang as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->nama_gelombang }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Jurusan --}}
                    <div>

                        <label for="filter-jurusan"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Jurusan

                        </label>

                        <select id="filter-jurusan"
                                class="w-full rounded-xl
                                       border border-slate-300
                                       bg-white
                                       px-4 py-3
                                       text-sm text-slate-800
                                       focus:border-[#02BC9C]
                                       focus:ring-2
                                       focus:ring-[#02BC9C]/20
                                       outline-none transition">

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


                    {{-- Cari --}}
                    <div class="flex items-end">

                        <button type="button"
                                id="btn-cari"
                                class="w-full inline-flex items-center justify-center gap-2
                                       px-4 py-3 rounded-xl
                                       bg-[#00bfa5]
                                       hover:bg-[#00a892]
                                       text-white text-sm font-semibold
                                       shadow-sm transition-all">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <circle cx="11" cy="11" r="8"/>

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 21l-4.35-4.35"/>

                            </svg>

                            Cari

                        </button>

                    </div>

                </div>

            </div>


            {{-- Table --}}
            <div class="p-5">

                <div class="overflow-x-auto">

                    <div id="tableDataTemplateBayar"></div>

                </div>

            </div>

        </section>



        {{-- ===================================================== --}}
        {{-- DETAIL TEMPLATE --}}
        {{-- ===================================================== --}}

        <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row
                        sm:items-center
                        gap-3
                        p-5
                        border-b border-slate-200">

                <div class="flex items-center gap-3 mr-auto">

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
                                  d="M8 6h13M8 12h13M8 18h13"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M3 6h.01M3 12h.01M3 18h.01"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-base font-semibold text-slate-800">
                            Detail Template Bayar
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Item pembayaran dari template yang dipilih
                        </p>

                    </div>

                </div>


                <div class="flex items-center gap-2">

                    {{-- Set Default --}}
                    <button type="button"
                            onclick="setDefaultDetail()"
                            class="inline-flex items-center justify-center gap-2
                                   px-3 py-2.5 rounded-lg
                                   bg-slate-800 hover:bg-slate-700
                                   text-white text-sm font-semibold
                                   transition-colors">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 3v18M3 12h18"/>

                        </svg>

                        Set Default

                    </button>


                    {{-- Tambah Detail --}}
                    <button type="button"
                            onclick="openModalDetail('add')"
                            class="inline-flex items-center justify-center gap-2
                                   px-3 py-2.5 rounded-lg
                                   bg-[#00bfa5] hover:bg-[#00a892]
                                   text-white text-sm font-semibold
                                   transition-all">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"/>

                        </svg>

                        Tambah Detail

                    </button>

                </div>

            </div>


            {{-- Detail Table --}}
            <div class="p-5">

                <div class="overflow-x-auto">

                    <div id="tableDetailDataTemplateBayar"></div>

                </div>

            </div>

        </section>

    </div>

</main>



{{-- ========================================================= --}}
{{-- MODAL TEMPLATE BAYAR --}}
{{-- ========================================================= --}}

<div id="modal-form"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-2xl
                max-h-[90vh]
                overflow-y-auto
                rounded-2xl
                bg-white
                shadow-2xl">


        {{-- Header --}}
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

                    <h3 id="modal-template-title"
                        class="text-lg font-semibold text-slate-900">

                        Tambah Template Bayar

                    </h3>

                    <p class="text-xs text-slate-500">
                        Isi informasi template pembayaran.
                    </p>

                </div>

            </div>


            <button type="button"
                    onclick="closeModalTemplate()"
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


        {{-- Body --}}
        <div class="p-6 space-y-5">

            <input type="hidden" id="id">


            {{-- Tahun --}}
            <div>

                <label for="id_tahun"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Tahun Ajaran

                </label>

                <select id="id_tahun"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

                    <option value="">
                        Pilih Tahun Ajaran
                    </option>

                    @foreach($tahun as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->thn_ajaran }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Gelombang --}}
            <div>

                <label for="id_gelombang"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Gelombang

                </label>

                <select id="id_gelombang"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

                    <option value="">
                        Pilih Gelombang
                    </option>

                    @foreach($gelombang as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_gelombang }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Tipe Jurusan --}}
            <div>

                <label for="tipe_jurusan"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Tipe Jurusan

                </label>

                <select id="tipe_jurusan"
                        onchange="toggleJurusan()"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

                    <option value="semua">
                        Semua Jurusan
                    </option>

                    <option value="khusus">
                        Jurusan Tertentu
                    </option>

                </select>

            </div>


            {{-- Jurusan --}}
            <div id="wrapper-jurusan"
                 class="hidden">

                <label for="id_jurusan"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Jurusan

                </label>

                <select id="id_jurusan"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

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


            {{-- Jenis Kelas --}}
            <div>

                <label for="jns_kelas"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Jenis Kelas

                </label>

                <select id="jns_kelas"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

                    <option value="1">
                        Reguler
                    </option>

                    <option value="2">
                        Karyawan
                    </option>

                </select>

            </div>


            {{-- Keterangan --}}
            <div>

                <label for="keterangan"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Keterangan

                </label>

                <textarea id="keterangan"
                          rows="3"
                          placeholder="Keterangan template..."
                          class="w-full rounded-xl
                                 border border-slate-300
                                 px-4 py-3
                                 text-sm
                                 resize-none
                                 focus:border-[#02BC9C]
                                 focus:ring-2
                                 focus:ring-[#02BC9C]/20
                                 outline-none"></textarea>

            </div>


            {{-- Status --}}
            <div>

                <label for="sts"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Status

                </label>

                <select id="sts"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

                    <option value="1">
                        Aktif
                    </option>

                    <option value="0">
                        Tidak Aktif
                    </option>

                </select>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4
                    border-t border-slate-200
                    bg-slate-50
                    rounded-b-2xl">

            <button type="button"
                    onclick="closeModalTemplate()"
                    class="px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white
                           text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-100">

                Batal

            </button>

            <button type="button"
                    id="btn-simpan-template"
                    onclick="saveData()"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-[#00bfa5]
                           hover:bg-[#00a892]
                           text-white text-sm font-semibold">

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



{{-- ========================================================= --}}
{{-- MODAL DETAIL --}}
{{-- ========================================================= --}}

<div id="modal-detail-form"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-xl
                max-h-[90vh]
                overflow-y-auto
                rounded-2xl
                bg-white
                shadow-2xl">


        {{-- Header --}}
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

                    <h3 id="modal-detail-title"
                        class="text-lg font-semibold text-slate-900">

                        Tambah Detail

                    </h3>

                    <p class="text-xs text-slate-500">
                        Isi item pembayaran.
                    </p>

                </div>

            </div>


            <button type="button"
                    onclick="closeModalDetail()"
                    class="w-9 h-9 rounded-lg
                           flex items-center justify-center
                           text-slate-400
                           hover:text-slate-600
                           hover:bg-slate-100">

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


        {{-- Body --}}
        <div class="p-6 space-y-5">

            <input type="hidden" id="id_detail">


            {{-- Item --}}
            <div>

                <label for="id_item"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Item Pembayaran

                </label>

                <select id="id_item"
                        class="w-full rounded-xl
                               border border-slate-300
                               bg-white
                               px-4 py-3
                               text-sm
                               focus:border-[#02BC9C]
                               focus:ring-2
                               focus:ring-[#02BC9C]/20
                               outline-none">

                    <option value="">
                        Pilih Item Pembayaran
                    </option>

                    @foreach($itemBayar ?? [] as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->nama_item }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Jumlah --}}
            <div>

                <label for="jml_bayar"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Jumlah Bayar

                </label>

                <input type="number"
                       id="jml_bayar"
                       min="0"
                       placeholder="Contoh: 500000"
                       class="w-full rounded-xl
                              border border-slate-300
                              px-4 py-3
                              text-sm
                              focus:border-[#02BC9C]
                              focus:ring-2
                              focus:ring-[#02BC9C]/20
                              outline-none">

            </div>


            {{-- Keterangan --}}
            <div>

                <label for="ket_bayar"
                       class="block text-sm font-semibold text-slate-700 mb-2">

                    Keterangan

                </label>

                <textarea id="ket_bayar"
                          rows="3"
                          placeholder="Keterangan pembayaran..."
                          class="w-full rounded-xl
                                 border border-slate-300
                                 px-4 py-3
                                 text-sm
                                 resize-none
                                 focus:border-[#02BC9C]
                                 focus:ring-2
                                 focus:ring-[#02BC9C]/20
                                 outline-none"></textarea>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4
                    border-t border-slate-200
                    bg-slate-50
                    rounded-b-2xl">

            <button type="button"
                    onclick="closeModalDetail()"
                    class="px-4 py-2.5 rounded-lg
                           border border-slate-300
                           bg-white
                           text-slate-700
                           text-sm font-semibold
                           hover:bg-slate-100">

                Batal

            </button>

            <button type="button"
                    id="btn-simpan-detail"
                    onclick="saveDetail()"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-[#00bfa5]
                           hover:bg-[#00a892]
                           text-white text-sm font-semibold">

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

let currentTemplateId = 0;


/* =========================================================
   TABLE TEMPLATE
========================================================= */

let table = new Tabulator("#tableDataTemplateBayar", {

    ajaxURL: "{{ route('template-bayar.data') }}",

    layout: "fitDataStretch",

    height: "500px",

    pagination: true,

    paginationMode: "local",

    paginationSize: 10,

    paginationSizeSelector: [10, 25, 50, 100],

    placeholder: "Data template tidak ditemukan",

    columns: [

        {
            title: "No",
            formatter: "rownum",
            hozAlign: "center",
            width: 60
        },

        {
            title: "ID",
            field: "id",
            width: 70
        },

        {
            title: "Tahun",
            field: "tahun_ajaran.thn_ajaran",
            minWidth: 110
        },

        {
            title: "Gelombang",
            field: "gelombang.nama_gelombang",
            minWidth: 130
        },

        {
            title: "Jenis Kelas",
            field: "jns_kelas",
            minWidth: 120,

            formatter: function(cell) {

                return cell.getValue() == 1
                    ? "Reguler"
                    : "Karyawan";

            }
        },

        {
            title: "Jurusan",
            field: "jurusan.nama_jurusan",
            minWidth: 150
        },

        {
            title: "Status",
            field: "sts",
            minWidth: 100,

            formatter: function(cell) {

                return cell.getValue() == 1

                    ? `<span class="inline-flex items-center px-2.5 py-1
                              rounded-full text-xs font-semibold
                              bg-emerald-50 text-emerald-600
                              border border-emerald-100">
                            Aktif
                       </span>`

                    : `<span class="inline-flex items-center px-2.5 py-1
                              rounded-full text-xs font-semibold
                              bg-slate-100 text-slate-500
                              border border-slate-200">
                            Tidak Aktif
                       </span>`;

            }
        },

        {
            title: "Aksi",
            width: 150,
            minWidth: 150,
            hozAlign: "center",
            headerSort: false,

            formatter: function(cell) {

                let row = cell.getData();

                return `

                    <div class="flex items-center justify-center gap-2">

                        <button
                            type="button"
                            onclick='editTemplateBayar(${JSON.stringify(row)})'
                            title="Edit"
                            class="inline-flex items-center justify-center
                                   w-9 h-9 rounded-lg
                                   bg-amber-50 text-amber-600
                                   border border-amber-100
                                   hover:bg-amber-100">

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
                            onclick="deleteTemplateBayar(${row.id})"
                            title="Hapus"
                            class="inline-flex items-center justify-center
                                   w-9 h-9 rounded-lg
                                   bg-red-50 text-red-600
                                   border border-red-100
                                   hover:bg-red-100">

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


/* =========================================================
   KLIK TEMPLATE
========================================================= */

table.on("rowClick", function(e, row) {

    showDetail(row.getData().id);

});


/* =========================================================
   FILTER
========================================================= */

document
    .getElementById("btn-cari")
    .addEventListener("click", function() {

        table.setData(

            "{{ route('template-bayar.data') }}",

            {

                id_thn_ajaran:
                    document.getElementById("filter-tahun").value,

                id_gelombang:
                    document.getElementById("filter-gelombang").value,

                id_jurusan:
                    document.getElementById("filter-jurusan").value

            }

        );

    });


/* =========================================================
   TABLE DETAIL
========================================================= */

let tableDetail = new Tabulator(
    "#tableDetailDataTemplateBayar",
    {

        layout: "fitDataStretch",

        height: "500px",

        placeholder: "Pilih template terlebih dahulu",

        columns: [

            {
                title: "Item",
                field: "nama_item",
                minWidth: 160
            },

            {
                title: "Kategori",
                field: "kategori",
                minWidth: 120
            },

            {
                title: "Jumlah Bayar",
                field: "jml_bayar",
                hozAlign: "right",
                minWidth: 130,

                formatter: function(cell) {

                    return new Intl.NumberFormat(
                        "id-ID",
                        {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0
                        }
                    ).format(cell.getValue() || 0);

                }

            },

            {
                title: "Keterangan",
                field: "ket_bayar",
                minWidth: 150
            },

            {
                title: "Aksi",
                width: 120,
                minWidth: 120,
                hozAlign: "center",
                headerSort: false,

                formatter: function(cell) {

                    let row = cell.getData();

                    return `

                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                onclick='editDetail(${JSON.stringify(row)})'
                                title="Edit"
                                class="inline-flex items-center justify-center
                                       w-9 h-9 rounded-lg
                                       bg-amber-50 text-amber-600
                                       border border-amber-100
                                       hover:bg-amber-100">

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
                                onclick="deleteDetail(${row.id})"
                                title="Hapus"
                                class="inline-flex items-center justify-center
                                       w-9 h-9 rounded-lg
                                       bg-red-50 text-red-600
                                       border border-red-100
                                       hover:bg-red-100">

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

    }
);


/* =========================================================
   SHOW DETAIL
========================================================= */

function showDetail(idTemplate)
{

    currentTemplateId = idTemplate;

    tableDetail.setData(
        "{{ url('template-bayar/detail') }}/" + idTemplate
    );

}


/* =========================================================
   SET DEFAULT
========================================================= */

function setDefaultDetail()
{

    if (!currentTemplateId) {

        alert("Pilih Template Bayar terlebih dahulu");

        return;

    }


    if (!confirm(
        "Set detail pembayaran ke nilai default?"
    )) {

        return;

    }


    fetch(
        "{{ url('template-bayar/set-default') }}/" +
        currentTemplateId,
        {

            method: "POST",

            headers: {

                "Content-Type":
                    "application/json",

                "X-CSRF-TOKEN":
                    "{{ csrf_token() }}",

                "Accept":
                    "application/json"

            }

        }
    )

    .then(response => response.json())

    .then(response => {

        tableDetail.setData(
            "{{ url('template-bayar/detail') }}/" +
            currentTemplateId
        );

    })

    .catch(error => {

        console.error(error);

        alert("Terjadi kesalahan");

    });

}


/* =========================================================
   MODAL TEMPLATE
========================================================= */

function openModalTemplate(mode = "add")
{

    if (mode === "add") {

        document.getElementById("id").value = "";

        document.getElementById("id_tahun").value = "";

        document.getElementById("id_jurusan").value = "";

        document.getElementById("id_gelombang").value = "";

        document.getElementById("jns_kelas").value = "1";

        document.getElementById("keterangan").value = "";

        document.getElementById("sts").value = "1";

        document.getElementById("tipe_jurusan").value = "semua";

        toggleJurusan();

        document.getElementById(
            "modal-template-title"
        ).textContent = "Tambah Template Bayar";

    }


    const modal =
        document.getElementById("modal-form");

    modal.classList.remove("hidden");

    modal.classList.add("flex");

}


function closeModalTemplate()
{

    const modal =
        document.getElementById("modal-form");

    modal.classList.add("hidden");

    modal.classList.remove("flex");

}


function editTemplateBayar(data)
{

    document.getElementById("id").value =
        data.id ?? "";

    document.getElementById("id_tahun").value =
        data.id_tahun ?? "";

    document.getElementById("id_jurusan").value =
        data.id_jurusan ?? "";

    document.getElementById("id_gelombang").value =
        data.id_gelombang ?? "";

    document.getElementById("jns_kelas").value =
        data.jns_kelas ?? "1";

    document.getElementById("keterangan").value =
        data.keterangan ?? "";

    document.getElementById("sts").value =
        data.sts ?? "1";


    document.getElementById("tipe_jurusan").value =
        data.id_jurusan ? "khusus" : "semua";

    toggleJurusan();


    document.getElementById(
        "modal-template-title"
    ).textContent = "Edit Template Bayar";


    const modal =
        document.getElementById("modal-form");

    modal.classList.remove("hidden");

    modal.classList.add("flex");

}


/* =========================================================
   TOGGLE JURUSAN
========================================================= */

function toggleJurusan()
{

    const tipe =
        document.getElementById("tipe_jurusan").value;

    const wrapper =
        document.getElementById("wrapper-jurusan");


    if (tipe === "khusus") {

        wrapper.classList.remove("hidden");

    } else {

        wrapper.classList.add("hidden");

        document.getElementById(
            "id_jurusan"
        ).value = "";

    }

}


/* =========================================================
   SAVE TEMPLATE
========================================================= */

function saveData()
{

    const id =
        document.getElementById("id").value;

    const isEdit =
        id !== "";


    const tipeJurusan =
        document.getElementById(
            "tipe_jurusan"
        ).value;


    const idJurusan =
        tipeJurusan === "semua"

            ? null

            : document.getElementById(
                "id_jurusan"
              ).value;


    const url = isEdit

        ? "{{ url('template-bayar/update') }}/" + id

        : "{{ url('template-bayar/store') }}";


    const button =
        document.getElementById(
            "btn-simpan-template"
        );


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

        method: "POST",

        headers: {

            "Content-Type":
                "application/json",

            "Accept":
                "application/json",

            "X-CSRF-TOKEN":
                "{{ csrf_token() }}"

        },

        body: JSON.stringify({

            id_tahun:
                document.getElementById(
                    "id_tahun"
                ).value,

            tipe_jurusan:
                tipeJurusan,

            id_jurusan:
                idJurusan,

            id_gelombang:
                document.getElementById(
                    "id_gelombang"
                ).value,

            jns_kelas:
                document.getElementById(
                    "jns_kelas"
                ).value,

            keterangan:
                document.getElementById(
                    "keterangan"
                ).value,

            sts:
                document.getElementById(
                    "sts"
                ).value

        })

    })

    .then(async response => {

        const result =
            await response.json();

        if (!response.ok) {

            throw new Error(
                result.message ??
                "Data gagal disimpan."
            );

        }

        return result;

    })

    .then(result => {

        closeModalTemplate();

        table.replaceData();

        alert(
            result.message ??
            "Data berhasil disimpan."
        );

    })

    .catch(error => {

        console.error(error);

        alert(error.message);

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


/* =========================================================
   DELETE TEMPLATE
========================================================= */

function deleteTemplateBayar(id)
{

    if (!confirm("Yakin ingin menghapus data ini?")) {

        return;

    }


    fetch(
        "{{ url('template-bayar/delete') }}/" + id,
        {

            method: "DELETE",

            headers: {

                "X-CSRF-TOKEN":
                    "{{ csrf_token() }}",

                "Accept":
                    "application/json"

            }

        }
    )

    .then(response => response.json())

    .then(response => {

        table.replaceData();

        alert(
            response.message ??
            "Data berhasil dihapus"
        );

    })

    .catch(error => {

        console.error(error);

        alert("Gagal menghapus data");

    });

}


/* =========================================================
   MODAL DETAIL
========================================================= */

function openModalDetail(mode = "add")
{

    if (!currentTemplateId) {

        alert(
            "Pilih Template Bayar terlebih dahulu"
        );

        return;

    }


    if (mode === "add") {

        document.getElementById(
            "id_detail"
        ).value = "";

        document.getElementById(
            "id_item"
        ).value = "";

        document.getElementById(
            "jml_bayar"
        ).value = "";

        document.getElementById(
            "ket_bayar"
        ).value = "";

        document.getElementById(
            "modal-detail-title"
        ).textContent = "Tambah Detail";

    }


    const modal =
        document.getElementById(
            "modal-detail-form"
        );

    modal.classList.remove("hidden");

    modal.classList.add("flex");

}


function closeModalDetail()
{

    const modal =
        document.getElementById(
            "modal-detail-form"
        );

    modal.classList.add("hidden");

    modal.classList.remove("flex");

}


/* =========================================================
   SAVE DETAIL
========================================================= */

function saveDetail()
{

    let idDetail =
        document.getElementById(
            "id_detail"
        ).value;


    let url = idDetail

        ? "{{ url('template-bayar-detail/updateDetail') }}/" +
          idDetail

        : "{{ route('template-bayar-detail.storeDetail') }}";


    const button =
        document.getElementById(
            "btn-simpan-detail"
        );


    button.disabled = true;


    fetch(url, {

        method: "POST",

        headers: {

            "Content-Type":
                "application/json",

            "X-CSRF-TOKEN":
                "{{ csrf_token() }}",

            "Accept":
                "application/json"

        },

        body: JSON.stringify({

            id_template:
                currentTemplateId,

            id_item:
                document.getElementById(
                    "id_item"
                ).value,

            jml_bayar:
                document.getElementById(
                    "jml_bayar"
                ).value,

            ket_bayar:
                document.getElementById(
                    "ket_bayar"
                ).value

        })

    })

    .then(async response => {

        const result =
            await response.json();

        if (!response.ok) {

            throw new Error(
                result.message ??
                "Data gagal disimpan."
            );

        }

        return result;

    })

    .then(response => {

        closeModalDetail();

        document.getElementById(
            "id_detail"
        ).value = "";

        document.getElementById(
            "id_item"
        ).value = "";

        document.getElementById(
            "jml_bayar"
        ).value = "";

        document.getElementById(
            "ket_bayar"
        ).value = "";


        tableDetail.setData(
            "{{ url('template-bayar/detail') }}/" +
            currentTemplateId
        );


        if (typeof toastr !== "undefined") {

            toastr.success(
                response.msg ??
                "Data berhasil disimpan"
            );

        }

    })

    .catch(error => {

        console.error(error);

        if (typeof toastr !== "undefined") {

            toastr.error(
                error.message ??
                "Terjadi kesalahan"
            );

        } else {

            alert(error.message);

        }

    })

    .finally(() => {

        button.disabled = false;

    });

}


/* =========================================================
   EDIT DETAIL
========================================================= */

function editDetail(row)
{

    document.getElementById(
        "id_detail"
    ).value = row.id;


    document.getElementById(
        "id_item"
    ).value = row.id_item;


    document.getElementById(
        "jml_bayar"
    ).value = row.jml_bayar;


    document.getElementById(
        "ket_bayar"
    ).value =
        row.ket_bayar ?? "";


    document.getElementById(
        "modal-detail-title"
    ).textContent =
        "Edit Detail";


    const modal =
        document.getElementById(
            "modal-detail-form"
        );

    modal.classList.remove("hidden");

    modal.classList.add("flex");

}


/* =========================================================
   DELETE DETAIL
========================================================= */

function deleteDetail(id)
{

    if (!confirm(
        "Yakin ingin menghapus data ini?"
    )) {

        return;

    }


    fetch(
        "{{ url('template-bayar-detail/deleteDetail') }}/" +
        id,
        {

            method: "DELETE",

            headers: {

                "X-CSRF-TOKEN":
                    "{{ csrf_token() }}",

                "Accept":
                    "application/json"

            }

        }
    )

    .then(response => response.json())

    .then(response => {

        tableDetail.setData(
            "{{ url('template-bayar/detail') }}/" +
            currentTemplateId
        );

    })

    .catch(error => {

        console.error(error);

        alert(
            "Gagal menghapus data"
        );

    });

}


/* =========================================================
   BACKDROP
========================================================= */

document.getElementById(
    "modal-form"
).addEventListener(
    "click",
    function(e) {

        if (e.target === this) {

            closeModalTemplate();

        }

    }
);


document.getElementById(
    "modal-detail-form"
).addEventListener(
    "click",
    function(e) {

        if (e.target === this) {

            closeModalDetail();

        }

    }
);


/* =========================================================
   ESCAPE
========================================================= */

document.addEventListener(
    "keydown",
    function(e) {

        if (e.key !== "Escape") {
            return;
        }

        closeModalTemplate();

        closeModalDetail();

    }
);

</script>

@endsection
