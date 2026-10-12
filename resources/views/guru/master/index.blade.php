@extends('layout.app')

@section('title', 'Master Guru')
@section('page_title', 'Master Guru')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
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
                Master Guru
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data guru dan tenaga kependidikan sekolah.
            </p>

        </div>

        <button type="button"
                onclick="openModalGuru('add')"
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

            Tambah Guru

        </button>

    </div>


    {{-- =========================================================
         TABLE CARD
    ========================================================== --}}
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

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
                          d="M17 20h5v-2a4 4 0 00-4-4h-1"/>

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M9 20H4v-2a4 4 0 014-4h1"/>

                    <circle cx="12"
                            cy="7"
                            r="4"/>

                </svg>

            </div>

            <div>

                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Guru
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Data guru dan tenaga kependidikan.
                </p>

            </div>

        </div>


        <div class="p-5">
            <div class="flex items-center justify-between mb-4">

    <div class="relative w-full max-w-sm">
        <input type="text"
            id="search-guru"
            placeholder="Cari guru..."
            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200
                   focus:ring-2 focus:ring-teal-500 focus:border-teal-500
                   text-sm outline-none">

        <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"></circle>
            <path d="m20 20-4-4"></path>
        </svg>
    </div>

</div>

            <div id="table-guru"></div>

        </div>

    </section>

</main>


{{-- =========================================================
     MODAL GURU
========================================================== --}}
<div id="modal-guru"
     class="fixed inset-0 z-50 hidden items-center justify-center
            bg-slate-900/50 backdrop-blur-sm p-4"
     aria-hidden="true">

    <div class="w-full max-w-4xl max-h-[92vh] overflow-y-auto
                rounded-2xl bg-white shadow-2xl">

        {{-- HEADER --}}
        <div class="flex items-center justify-between
                    px-6 py-4 border-b border-slate-200 sticky top-0
                    bg-white z-10">

            <div>

                <h3 id="modal-guru-title"
                    class="text-lg font-semibold text-slate-800">
                    Tambah Guru
                </h3>

                <p class="text-xs text-slate-500 mt-1">
                    Isi informasi guru dengan lengkap.
                </p>

            </div>

            <button type="button"
                    onclick="closeModalGuru()"
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


        {{-- FORM --}}
        <div class="p-6 space-y-7">

            <input type="hidden" id="guru_id">


            {{-- =================================================
                 DATA UTAMA
            ================================================== --}}
            <div>

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-teal-50
                                flex items-center justify-center text-teal-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <circle cx="12"
                                    cy="7"
                                    r="4"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M5.5 21a6.5 6.5 0 0113 0"/>

                        </svg>

                    </div>

                    <h4 class="font-semibold text-slate-800">
                        Data Utama
                    </h4>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Nama --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Nama Guru <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="nama_gtk"
                               placeholder="Nama lengkap guru"
                               class="input-guru">

                    </div>


                    {{-- NIK --}}
                    <div>

                        <label class="label-guru">
                            NIK
                        </label>

                        <input type="text"
                               id="nik"
                               placeholder="Nomor Induk Kependudukan"
                               class="input-guru">

                    </div>


                    {{-- NUPTK --}}
                    <div>

                        <label class="label-guru">
                            NUPTK
                        </label>

                        <input type="text"
                               id="nuptk"
                               placeholder="Nomor NUPTK"
                               class="input-guru">

                    </div>


                    {{-- NIY --}}
                    <div>

                        <label class="label-guru">
                            NIY
                        </label>

                        <input type="text"
                               id="niy"
                               placeholder="Nomor NIY"
                               class="input-guru">

                    </div>


                    {{-- NIP --}}
                    <div>

                        <label class="label-guru">
                            NIP
                        </label>

                        <input type="text"
                               id="nip"
                               placeholder="Nomor NIP"
                               class="input-guru">

                    </div>


                    {{-- Jenis Kelamin --}}
                    <div>

                        <label class="label-guru">
                            Jenis Kelamin
                        </label>

                        <select id="jk"
                                class="input-guru">

                            <option value="">Pilih jenis kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>

                        </select>

                    </div>


                    {{-- Tempat Lahir --}}
                    <div>

                        <label class="label-guru">
                            Tempat Lahir
                        </label>

                        <input type="text"
                               id="tmp_lahir"
                               class="input-guru">

                    </div>


                    {{-- Tanggal Lahir --}}
                    <div>

                        <label class="label-guru">
                            Tanggal Lahir
                        </label>

                        <input type="date"
                               id="tgl_lahir"
                               class="input-guru">

                    </div>


                    {{-- No HP --}}
                    <div>

                        <label class="label-guru">
                            No. HP
                        </label>

                        <input type="text"
                               id="no_hp"
                               placeholder="08xxxxxxxxxx"
                               class="input-guru">

                    </div>


                    {{-- Email --}}
                    <div>

                        <label class="label-guru">
                            Email
                        </label>

                        <input type="email"
                               id="email"
                               placeholder="email@contoh.com"
                               class="input-guru">

                    </div>

                </div>

            </div>


            {{-- =================================================
                 KEPEGAWAIAN
            ================================================== --}}
            <div class="border-t border-slate-200 pt-6">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-blue-50
                                flex items-center justify-center text-blue-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 19h16M6 17V7a2 2 0 012-2h8a2 2 0 012 2v10"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 9h6M9 13h6"/>

                        </svg>

                    </div>

                    <h4 class="font-semibold text-slate-800">
                        Kepegawaian
                    </h4>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label class="label-guru">
                            ID Kepegawaian
                        </label>

                        <input type="text"
                               id="idkepegawaian"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            ID PTK
                        </label>

                        <input type="text"
                               id="idptk"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Pangkat
                        </label>

                        <input type="text"
                               id="pangkat"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            No. Guru
                        </label>

                        <input type="text"
                               id="no_guru"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            SK Pengangkatan
                        </label>

                        <input type="text"
                               id="sk_pengangkatan"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            TMT Pengangkatan
                        </label>

                        <input type="date"
                               id="tmt_pengankatan"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            SK CPNS
                        </label>

                        <input type="text"
                               id="sk_cpns"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            TMT CPNS
                        </label>

                        <input type="date"
                               id="tmt_cpns"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            TMT PNS
                        </label>

                        <input type="date"
                               id="tmt_pns"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Sumber Gaji
                        </label>

                        <input type="text"
                               id="idsumber_gaji"
                               class="input-guru">

                    </div>

                </div>

            </div>


            {{-- =================================================
                 ALAMAT
            ================================================== --}}
            <div class="border-t border-slate-200 pt-6">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-amber-50
                                flex items-center justify-center text-amber-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z"/>

                            <circle cx="12"
                                    cy="11"
                                    r="2.5"/>

                        </svg>

                    </div>

                    <h4 class="font-semibold text-slate-800">
                        Alamat
                    </h4>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">

                        <label class="label-guru">
                            Alamat
                        </label>

                        <textarea id="alamat"
                                  rows="3"
                                  class="input-guru"
                                  placeholder="Alamat lengkap"></textarea>

                    </div>


                    <div>

                        <label class="label-guru">
                            RT
                        </label>

                        <input type="text"
                               id="rt"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            RW
                        </label>

                        <input type="text"
                               id="rw"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Dusun
                        </label>

                        <input type="text"
                               id="dusun"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Desa
                        </label>

                        <input type="text"
                               id="desa"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Kecamatan
                        </label>

                        <input type="text"
                               id="kecamatan"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Kode Pos
                        </label>

                        <input type="text"
                               id="kodepos"
                               class="input-guru">

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DATA TAMBAHAN
            ================================================== --}}
            <div class="border-t border-slate-200 pt-6">

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg bg-purple-50
                                flex items-center justify-center text-purple-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 12a4 4 0 100-8 4 4 0 000 8z"/>

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M4 21a8 8 0 0116 0"/>

                        </svg>

                    </div>

                    <h4 class="font-semibold text-slate-800">
                        Data Tambahan
                    </h4>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>

                        <label class="label-guru">
                            Status Kawin
                        </label>

                        <input type="text"
                               id="status_kawin"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Kewarganegaraan
                        </label>

                        <input type="text"
                               id="kewarganegaraan"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Nama Ibu
                        </label>

                        <input type="text"
                               id="nama_ibu"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            NPWP
                        </label>

                        <input type="text"
                               id="npwp"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Nama Wajib Pajak
                        </label>

                        <input type="text"
                               id="nama_wajib_pajak"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Nama Rekening
                        </label>

                        <input type="text"
                               id="nama_rek"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Nomor Rekening
                        </label>

                        <input type="text"
                               id="no_rek"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            ID Bank
                        </label>

                        <input type="text"
                               id="idbank"
                               class="input-guru">

                    </div>


                    <div>

                        <label class="label-guru">
                            Sekolah Induk
                        </label>

                        <select id="issekolah_induk"
                                class="input-guru">

                            <option value="">Pilih</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>

                        </select>

                    </div>


                    <div>

                        <label class="label-guru">
                            Role
                        </label>

                        <input type="text"
                               id="role"
                               class="input-guru">

                    </div>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="flex items-center justify-end gap-3
                    px-6 py-4 border-t border-slate-200
                    bg-slate-50/70 sticky bottom-0">

            <button type="button"
                    onclick="closeModalGuru()"
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
                    id="btn-save-guru"
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


<style>

    .label-guru {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: rgb(51 65 85);
        margin-bottom: 0.5rem;
    }

    .input-guru {
        width: 100%;
        border-radius: 0.5rem;
        border: 1px solid rgb(203 213 225);
        padding: 0.625rem 0.75rem;
        font-size: 0.875rem;
        color: rgb(51 65 85);
        outline: none;
        transition: all 0.2s;
    }

    .input-guru:focus {
        border-color: rgb(20 184 166);
        box-shadow: 0 0 0 2px rgb(204 251 241);
    }

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    window.tableGuru = new Tabulator("#table-guru", {

        ajaxURL: "{{ route('masterGuru.data') }}",

        layout: "fitColumns",

        height: "550px",

        pagination: true,

        paginationSize: 10,

        paginationSizeSelector: [10, 25, 50, 100],

        placeholder: "Data guru tidak ditemukan",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 70
            },

            {
                title: "Nama Guru",
                field: "nama_gtk",
                minWidth: 220,
                formatter: function (cell) {

                    let data = cell.getData();

                    return `
                        <div class="flex flex-col py-1">

                            <span class="font-semibold text-slate-800">
                                ${data.nama_gtk ?? '-'}
                            </span>

                            <span class="text-xs text-slate-500">
                                ${data.nuptk ?? data.nip ?? '-'}
                            </span>

                        </div>
                    `;

                }
            },

            {
                title: "NIK",
                field: "nik",
                minWidth: 160
            },

            {
                title: "Jenis Kelamin",
                field: "jk",
                hozAlign: "center",
                width: 130,

                formatter: function (cell) {

                    let value = cell.getValue();

                    if (value === 'L') {

                        return `
                            <span class="inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-blue-50 text-blue-600
                                         border border-blue-100">
                                Laki-laki
                            </span>
                        `;

                    }

                    if (value === 'P') {

                        return `
                            <span class="inline-flex items-center
                                         px-2.5 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-pink-50 text-pink-600
                                         border border-pink-100">
                                Perempuan
                            </span>
                        `;

                    }

                    return '-';

                }

            },

            {
                title: "NIP",
                field: "nip",
                minWidth: 150
            },

            {
                title: "No. HP",
                field: "no_hp",
                minWidth: 130
            },

            {
                title: "Email",
                field: "email",
                minWidth: 180
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
                                onclick='editGuru(${JSON.stringify(data)})'
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
                                onclick="deleteGuru(${data.id})"
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

    const searchGuru = document.getElementById('search-guru'); 
    searchGuru.addEventListener('input', function () 
    { 
    const keyword = this.value .toLowerCase() .trim(); 
    // Jika kosong, tampilkan semua data 
     if (!keyword) { tableGuru.clearFilter(); 
     return; 

     } // Pencarian ke seluruh field data 
     tableGuru.setFilter(function (data) { 
        return Object.values(data).some(function (value) { 
            if ( value === null || value === undefined ) 
                { 
                    return false; 
                } 
                return String(value) .toLowerCase() .includes(keyword);
             });
        }); 
    });

});


/* =========================================================
   BUKA MODAL
========================================================= */

function openModalGuru(type = 'add')
{

    const modal = document.getElementById('modal-guru');

    const title = document.getElementById('modal-guru-title');

    if (type === 'add') {

        title.textContent = 'Tambah Guru';

        resetFormGuru();

    }

    modal.classList.remove('hidden');

    modal.classList.add('flex');

}


/* =========================================================
   RESET FORM
========================================================= */

function resetFormGuru()
{

    const fields = [

        'guru_id',
        'nama_gtk',
        'nik',
        'tmp_lahir',
        'tgl_lahir',
        'nuptk',
        'niy',
        'nip',
        'jk',
        'no_hp',
        'email',

        'idkepegawaian',
        'idptk',
        'pangkat',
        'no_guru',
        'sk_pengangkatan',
        'tmt_pengankatan',
        'sk_cpns',
        'tmt_cpns',
        'tmt_pns',
        'idsumber_gaji',

        'alamat',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'kodepos',

        'status_kawin',
        'kewarganegaraan',
        'nama_ibu',
        'npwp',
        'nama_wajib_pajak',
        'nama_rek',
        'no_rek',
        'idbank',
        'issekolah_induk',
        'role'

    ];

    fields.forEach(function (id) {

        const element = document.getElementById(id);

        if (element) {

            element.value = '';

        }

    });

}


/* =========================================================
   TUTUP MODAL
========================================================= */

function closeModalGuru()
{

    const modal = document.getElementById('modal-guru');

    modal.classList.add('hidden');

    modal.classList.remove('flex');

}


/* =========================================================
   EDIT GURU
========================================================= */

function editGuru(data)
{

    document.getElementById('guru_id').value =
        data.id ?? '';

    document.getElementById('nama_gtk').value =
        data.nama_gtk ?? '';

    document.getElementById('nik').value =
        data.nik ?? '';

    document.getElementById('tmp_lahir').value =
        data.tmp_lahir ?? '';

    document.getElementById('tgl_lahir').value =
        data.tgl_lahir ?? '';

    document.getElementById('nuptk').value =
        data.nuptk ?? '';

    document.getElementById('niy').value =
        data.niy ?? '';

    document.getElementById('nip').value =
        data.nip ?? '';

    document.getElementById('jk').value =
        data.jk ?? '';

    document.getElementById('no_hp').value =
        data.no_hp ?? '';

    document.getElementById('email').value =
        data.email ?? '';

    document.getElementById('idkepegawaian').value =
        data.idkepegawaian ?? '';

    document.getElementById('idptk').value =
        data.idptk ?? '';

    document.getElementById('pangkat').value =
        data.pangkat ?? '';

    document.getElementById('no_guru').value =
        data.no_guru ?? '';

    document.getElementById('sk_pengangkatan').value =
        data.sk_pengangkatan ?? '';

    document.getElementById('tmt_pengankatan').value =
        data.tmt_pengankatan ?? '';

    document.getElementById('sk_cpns').value =
        data.sk_cpns ?? '';

    document.getElementById('tmt_cpns').value =
        data.tmt_cpns ?? '';

    document.getElementById('tmt_pns').value =
        data.tmt_pns ?? '';

    document.getElementById('idsumber_gaji').value =
        data.idsumber_gaji ?? '';

    document.getElementById('alamat').value =
        data.alamat ?? '';

    document.getElementById('rt').value =
        data.rt ?? '';

    document.getElementById('rw').value =
        data.rw ?? '';

    document.getElementById('dusun').value =
        data.dusun ?? '';

    document.getElementById('desa').value =
        data.desa ?? '';

    document.getElementById('kecamatan').value =
        data.kecamatan ?? '';

    document.getElementById('kodepos').value =
        data.kodepos ?? '';

    document.getElementById('status_kawin').value =
        data.status_kawin ?? '';

    document.getElementById('kewarganegaraan').value =
        data.kewarganegaraan ?? '';

    document.getElementById('nama_ibu').value =
        data.nama_ibu ?? '';

    document.getElementById('npwp').value =
        data.npwp ?? '';

    document.getElementById('nama_wajib_pajak').value =
        data.nama_wajib_pajak ?? '';

    document.getElementById('nama_rek').value =
        data.nama_rek ?? '';

    document.getElementById('no_rek').value =
        data.no_rek ?? '';

    document.getElementById('idbank').value =
        data.idbank ?? '';

    document.getElementById('issekolah_induk').value =
        data.issekolah_induk ?? '';

    document.getElementById('role').value =
        data.role ?? '';

    document.getElementById('modal-guru-title').textContent =
        'Edit Guru';


    const modal = document.getElementById('modal-guru');

    modal.classList.remove('hidden');

    modal.classList.add('flex');

}


/* =========================================================
   SIMPAN DATA
========================================================= */

function saveData()
{

    let id =
        document.getElementById('guru_id').value;

    let isEdit =
        id !== '';

    let url = isEdit
        ? "{{ url('masterGuru/update') }}/" + id
        : "{{ url('masterGuru/store') }}";


    const button =
        document.getElementById('btn-save-guru');

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

            <path d="M4 12a8 8 0 018-8"
                  stroke-width="4"
                  stroke-linecap="round"/>

        </svg>

        Menyimpan...
    `;


    const fields = [

        'nama_gtk',
        'nik',
        'tmp_lahir',
        'tgl_lahir',
        'nuptk',
        'niy',
        'nip',
        'jk',
        'no_hp',
        'email',

        'idkepegawaian',
        'idptk',
        'pangkat',
        'no_guru',
        'sk_pengangkatan',
        'tmt_pengankatan',
        'sk_cpns',
        'tmt_cpns',
        'tmt_pns',
        'idsumber_gaji',

        'alamat',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'kodepos',

        'status_kawin',
        'kewarganegaraan',
        'nama_ibu',
        'npwp',
        'nama_wajib_pajak',
        'nama_rek',
        'no_rek',
        'idbank',
        'issekolah_induk',
        'role'

    ];


    let body = {};

    fields.forEach(function (field) {

        const element =
            document.getElementById(field);

        if (element) {

            body[field] =
                element.value;

        }

    });


    fetch(url, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}',

            'Accept':
                'application/json'

        },

        body: JSON.stringify(body)

    })

    .then(res => res.json())

    .then(res => {

        if (res.success) {

            closeModalGuru();

            tableGuru.replaceData();

            alert('Data guru berhasil disimpan');

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


/* =========================================================
   HAPUS
========================================================= */

function deleteGuru(id)
{

    if (!confirm(
        'Yakin ingin menghapus data guru ini ?'
    )) {

        return;

    }


    fetch(
        "{{ url('master-guru/delete') }}/" + id,
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

            tableGuru.replaceData();

            alert('Data guru berhasil dihapus');

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


/* =========================================================
   OVERLAY
========================================================= */

document
    .getElementById('modal-guru')
    .addEventListener('click', function (event) {

        if (event.target === this) {

            closeModalGuru();

        }

    });


/* =========================================================
   ESC
========================================================= */

document.addEventListener('keydown', function (event) {

    if (event.key === 'Escape') {

        const modal =
            document.getElementById('modal-guru');

        if (!modal.classList.contains('hidden')) {

            closeModalGuru();

        }

    }

});

</script>

@endsection
