@extends('layout.app')

@section('title', 'Gelombang PPDB 2026')
@section('page_title', 'Gelombang Pendaftaran')

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
                Gelombang Pendaftaran
            </h1>


            <p class="text-sm text-slate-500 mt-1">
                Kelola periode dan gelombang pendaftaran siswa baru.
            </p>

        </div>


        <!-- TAMBAH -->

        <button
            type="button"
            onclick="openTambah()"
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

            Tambah Gelombang

        </button>

    </div>







    <!-- =========================================================
         DAFTAR GELOMBANG
    ========================================================== -->

    <section>

        <!-- HEADER -->

        <div class="flex flex-col sm:flex-row
                    sm:items-center
                    justify-between
                    gap-4
                    mb-5">

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
                        Daftar Gelombang
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Data periode pendaftaran siswa
                    </p>

                </div>

            </div>

        </div>



        <!-- CARD CONTAINER -->

        <div id="gelombang-container"
            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

            <!-- LOADING -->

            <div class="col-span-full
                        flex items-center justify-center
                        py-12
                        text-sm
                        text-slate-400">

                Memuat data gelombang...

            </div>

        </div>

    </section>



</main>



<!-- =========================================================
     MODAL TAMBAH
========================================================== -->

@include('pendaftaran.gelombang.add-gelombang')


<!-- =========================================================
     MODAL EDIT
========================================================== -->

@include('pendaftaran.gelombang.edit-gelombang')



<script>
    /*
    |--------------------------------------------------------------------------
    | GLOBAL DATA
    |--------------------------------------------------------------------------
    */

    let gelombangData = [];



    /*
    |--------------------------------------------------------------------------
    | LOAD DATA
    |--------------------------------------------------------------------------
    */

    function loadGelombang() {

        fetch("{{ route('gelombang.data') }}", {

                method: 'GET',

                headers: {

                    'Accept': 'application/json'

                }

            })

            .then(response => {

                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data gelombang.'
                    );

                }

                return response.json();

            })

            .then(result => {

                /*
                 * Bisa menerima:
                 *
                 * [
                 *     {...},
                 *     {...}
                 * ]
                 *
                 * atau:
                 *
                 * {
                 *     data: [...]
                 * }
                 */

                if (Array.isArray(result)) {

                    gelombangData = result;

                } else {

                    gelombangData =
                        Array.isArray(result.data) ?
                        result.data :
                        [];

                }


                renderGelombang(gelombangData);



            })

            .catch(error => {

                console.error(error);

                document.getElementById(
                    'gelombang-container'
                ).innerHTML = `

                <div class="col-span-full
                            bg-red-50
                            border border-red-100
                            rounded-xl
                            p-6
                            text-center">

                    <p class="text-sm
                              font-semibold
                              text-red-600">

                        Gagal memuat data gelombang.

                    </p>

                    <p class="text-xs
                              text-red-400
                              mt-1">

                        ${escapeHtml(error.message)}

                    </p>

                </div>

            `;

            });

    }



    /*
    |--------------------------------------------------------------------------
    | RENDER GELOMBANG
    |--------------------------------------------------------------------------
    */

    function renderGelombang(data) {

        const container =
            document.getElementById(
                'gelombang-container'
            );


        if (!data.length) {

            container.innerHTML = `

                <div class="col-span-full
                            bg-white
                            rounded-2xl
                            border border-slate-200
                            p-10
                            text-center">

                    <div class="w-12 h-12 mx-auto
                                rounded-xl
                                bg-slate-100
                                flex items-center
                                justify-center
                                text-slate-400">

                        <svg class="w-6 h-6"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 6h18M3 12h18M3 18h18">
                            </path>

                        </svg>

                    </div>


                    <p class="mt-3
                              text-sm
                              font-semibold
                              text-slate-600">

                        Belum ada data gelombang.

                    </p>


                    <p class="text-xs
                              text-slate-400
                              mt-1">

                        Silakan tambahkan gelombang pendaftaran.

                    </p>

                </div>

            `;

            return;
        }


        container.innerHTML = data
            .map(function(item, index) {

                console.log('item', item);


                return createGelombangCard(
                    item,
                    index
                );

            })
            .join('');

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE CARD
    |--------------------------------------------------------------------------
    */

    function createGelombangCard(item, index) {


        const nama =
            item.nama_gelombang ||
            `Gelombang Pendaftaran ${index + 1}`;


        const isAktif =
            Number(item.is_current) === 1;


        const awal =
            formatTanggal(item.awal);


        const akhir =
            formatTanggal(item.akhir);


        /*
         * DATA KUOTA
         */

        const kuota =
            Number(item.kuota || 0);


        const pendaftar = Number(item.pendaftar || 0);

        const terverifikasi = Number(item.terverifikasi || 0);


        /*
         * PERSENTASE
         */

        let persen = 0;


        if (kuota > 0) {

            persen = Math.round(
                (pendaftar / kuota) * 100
            );

        }


        if (persen > 100) {

            persen = 100;

        }


        /*
         * LABEL
         */

        const label =
            isAktif ?
            'BERJALAN' :
            'MENDATANG';


        const labelClass =
            isAktif ?
            'bg-[#e6f9f5] text-[#02BC9C]' :
            'bg-purple-50 text-purple-600';



        /*
         * CARD AKTIF
         */

        if (isAktif) {

            return `

                <div
                    class="bg-white
                           rounded-2xl
                           border-2
                           border-[#02BC9C]/60
                           shadow-sm
                           flex flex-col
                           justify-between
                           relative
                           overflow-hidden">

                    <div class="p-5 pb-4">


                        <!-- BADGES -->

                        <div class="flex items-center
                                    justify-between
                                    mb-3">

                            <span
                                class="px-2.5 py-1
                                       text-[10px]
                                       font-bold
                                       uppercase
                                       rounded-md
                                       ${labelClass}
                                       tracking-wider">

                                ${label}

                            </span>


                            <span
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       px-3 py-1
                                       rounded-full
                                       text-xs
                                       font-bold
                                       bg-[#02BC9C]
                                       text-white
                                       shadow-sm">

                                <span
                                    class="w-1.5 h-1.5
                                           rounded-full
                                           bg-white
                                           animate-pulse">
                                </span>

                                AKTIF

                            </span>

                        </div>



                        <!-- TITLE -->

                        <h4
                            class="font-bold
                                   text-slate-900
                                   text-lg
                                   leading-snug">

                            ${escapeHtml(nama)}

                        </h4>



                        <!-- DATE -->

                        <div
                            class="flex items-center
                                   gap-1.5
                                   text-xs
                                   text-slate-500
                                   mt-2
                                   font-medium">

                            ${iconCalendar()}

                            <span>
                                Berakhir ${akhir}
                            </span>

                        </div>



                        <!-- KUOTA -->

                        <div class="mt-4">

                            <div
                                class="flex
                                       justify-between
                                       text-xs
                                       font-semibold
                                       mb-1.5">

                                <span
                                    class="text-slate-500
                                           font-normal">

                                    Target Kuota

                                </span>


                                <span
                                    class="text-slate-800">

                                    ${pendaftar}/${kuota}
                                    (${persen}%)

                                </span>

                            </div>


                            <div
                                class="w-full
                                       bg-slate-100
                                       h-2
                                       rounded-full
                                       overflow-hidden">

                                <div
                                    class="bg-[#02BC9C]
                                           h-full
                                           rounded-full"
                                    style="width:${persen}%">
                                </div>

                            </div>

                        </div>



                        <!-- SUB STATS -->

                        <div
                            class="grid
                                   grid-cols-2
                                   gap-2
                                   mt-5">


                            <!-- PENDAFTAR -->

                            <!-- PENDAFTAR -->
<div
    class="bg-slate-50
           rounded-xl
           p-3
           border
           border-slate-100">

    <p
        class="text-xs
               text-slate-600
               font-semibold
               tracking-wide">

        Pendaftar

    </p>

    <p
        class="mt-1
               text-base
               font-extrabold
               text-slate-800">

        ${pendaftar}

    </p>

</div>


<!-- TERVERIFIKASI -->
<div
    class="bg-[#e6f9f5]
           rounded-xl
           p-3
           border
           border-[#02BC9C]/20">

    <p
        class="text-xs
               text-[#008f78]
               font-semibold
               tracking-wide">

        Terverifikasi

    </p>

    <p
        class="mt-1
               text-base
               font-extrabold
               text-[#02BC9C]">

        ${terverifikasi}

    </p>

</div>

                        </div>

                    </div>



                    <!-- ACTION -->

                    <div class="p-3 pt-0">

                        <button
                            type="button"
                            onclick="editGelombangById(${item.id})"
                            class="w-full
                                   py-2.5
                                   px-4
                                   bg-[#02BC9C]
                                   hover:bg-[#02a387]
                                   text-white
                                   text-xs
                                   font-bold
                                   rounded-xl
                                   flex
                                   items-center
                                   justify-center
                                   gap-2
                                   transition-colors">

                            <span>
                                Kelola Pendaftaran
                            </span>


                            <svg
                                class="w-3.5 h-3.5 stroke-[2.5]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>

                            </svg>

                        </button>

                    </div>

                </div>

            `;

        }



        /*
         * CARD MENDATANG
         */

        return `

            <div
                class="bg-white
                       rounded-2xl
                       border
                       border-slate-200
                       shadow-sm
                       flex flex-col
                       justify-between
                       overflow-hidden">


                <div class="p-5 pb-4">


                    <!-- BADGE & SETTING -->

                    <div
                        class="flex items-center
                               justify-between
                               mb-3">

                        <span
                            class="px-2.5 py-1
                                   text-[10px]
                                   font-bold
                                   uppercase
                                   rounded-md
                                   bg-purple-50
                                   text-purple-600
                                   tracking-wider">

                            MENDATANG

                        </span>


                        <button
                            type="button"
                            onclick="editGelombangById(${item.id})"
                            aria-label="Konfigurasi ${escapeHtml(nama)}"
                            class="text-slate-400
                                   hover:text-[#02BC9C]
                                   transition-colors">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24">

                                <path
                                    d="M12 6V4
                                       m0 2a2 2 0 100 4
                                       m0-4a2 2 0 110 4
                                       m-6 8a2 2 0 100-4
                                       m0 4a2 2 0 110-4
                                       m0 4v2
                                       m0-6V4
                                       m6 6v10
                                       m6-2a2 2 0 100-4
                                       m0 4a2 2 0 110-4
                                       m0 4v2
                                       m0-6V4"
                                    stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>

                            </svg>

                        </button>

                    </div>



                    <!-- TITLE -->

                    <h4
                        class="font-bold
                               text-slate-800
                               text-lg
                               leading-snug">

                        ${escapeHtml(nama)}

                    </h4>



                    <!-- DATE -->

                    <div
                        class="flex items-center
                               gap-1.5
                               text-xs
                               text-slate-500
                               mt-2
                               font-medium">

                        ${iconCalendar()}

                        <span>
                            Mulai ${awal}
                        </span>

                    </div>



                    <!-- KUOTA -->

                    <div class="mt-4">

                        <div
                            class="flex
                                   justify-between
                                   text-xs
                                   font-semibold
                                   mb-1.5">

                            <span
                                class="text-slate-500
                                       font-normal">

                                Target Kuota

                            </span>


                            <span
                                class="text-slate-800">

                                ${kuota} Kursi
                                (${persen}%)

                            </span>

                        </div>


                        <div
                            class="w-full
                                   bg-slate-100
                                   h-2
                                   rounded-full
                                   overflow-hidden">

                            <div
                                class="bg-slate-300
                                       h-full
                                       rounded-full"
                                style="width:${persen}%">
                            </div>

                        </div>

                    </div>



                    <!-- NOTIFICATION -->

                    <div
                        class="mt-5
                               p-3
                               rounded-xl
                               bg-indigo-50/50
                               border
                               border-indigo-100/60
                               flex
                               items-start
                               gap-2.5">

                        <svg
                            class="w-4 h-4
                                   text-indigo-500
                                   shrink-0
                                   mt-0.5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="12"
                                r="9">
                            </circle>

                            <line
                                x1="12"
                                x2="12.01"
                                y1="8"
                                y2="8">
                            </line>

                            <line
                                x1="12"
                                x2="12.01"
                                y1="12"
                                y2="16">
                            </line>

                        </svg>


                        <p
                            class="text-[11px]
                                   text-slate-600
                                   leading-relaxed">

                            Sistem akan otomatis membuka
                            gelombang ini pada pukul 00:00
                            di tanggal mulai.

                        </p>

                    </div>

                </div>



                <!-- ACTION -->

                <div class="p-3 pt-0">

                    <button
                        type="button"
                        onclick="editGelombangById(${item.id})"
                        class="w-full
                               py-2.5
                               px-4
                               bg-slate-50
                               hover:bg-[#e6f9f5]
                               hover:text-[#02BC9C]
                               text-slate-700
                               text-xs
                               font-bold
                               rounded-xl
                               flex
                               items-center
                               justify-between
                               transition-colors
                               border
                               border-slate-200">

                        <span>
                            Edit Konfigurasi
                        </span>


                        <svg
                            class="w-3.5 h-3.5
                                   text-slate-500"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">

                            <path
                                d="M12 6V4
                                   m0 2a2 2 0 100 4
                                   m0-4a2 2 0 110 4
                                   m-6 8a2 2 0 100-4
                                   m0 4a2 2 0 110-4
                                   m0 4v2
                                   m0-6V4
                                   m6 6v10
                                   m6-2a2 2 0 100-4
                                   m0 4a2 0 110-4
                                   m0 4v2
                                   m0-6V4"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                            </path>

                        </svg>

                    </button>

                </div>

            </div>

        `;

    }



    /*
    |--------------------------------------------------------------------------
    | ICON CALENDAR
    |--------------------------------------------------------------------------
    */

    function iconCalendar() {

        return `

            <svg
                class="w-3.5 h-3.5 text-slate-400"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <rect
                    height="18"
                    rx="2"
                    width="18"
                    x="3"
                    y="4">
                </rect>

                <line
                    x1="16"
                    x2="16"
                    y1="2"
                    y2="6">
                </line>

                <line
                    x1="8"
                    x2="8"
                    y1="2"
                    y2="6">
                </line>

                <line
                    x1="3"
                    x2="21"
                    y1="10"
                    y2="10">
                </line>

            </svg>

        `;

    }



    /*
    |--------------------------------------------------------------------------
    | FORMAT TANGGAL
    |--------------------------------------------------------------------------
    */

    function formatTanggal(value) {

        if (!value) {

            return '-';

        }


        /*
         * Ambil hanya YYYY-MM-DD.
         *
         * Ini menghindari masalah timezone
         * ketika data Laravel berupa:
         *
         * 2026-01-01T00:00:00.000000Z
         */

        const match =
            String(value).match(
                /^(\d{4})-(\d{2})-(\d{2})/
            );


        if (!match) {

            return '-';

        }


        const tahun = match[1];

        const bulan =
            Number(match[2]);

        const hari =
            match[3];


        const namaBulan = [

            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'

        ];


        return `${hari}
                ${namaBulan[bulan - 1]}
                ${tahun}`;

    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE STATISTIK
    |--------------------------------------------------------------------------
    */

    function updateStatistik(data) {

        const total =
            data.length;


        const aktif =
            data.filter(function(item) {

                return Number(item.is_current) === 1;

            }).length;


        const nonaktif =
            total - aktif;




    }



    /*
    |--------------------------------------------------------------------------
    | TAMBAH
    |--------------------------------------------------------------------------
    */

    function openTambah() {

        /*
         * Reset form tambah
         */

        const fields = [

            'add_id_tahun',
            'add_nama_gelombang',
            'add_awal',
            'add_akhir'

        ];


        fields.forEach(function(id) {

            const element =
                document.getElementById(id);

            if (element) {

                element.value = '';

            }

        });


        const current =
            document.getElementById(
                'add_is_current'
            );


        if (current) {

            current.value = '1';

        }





        /*
         * Pastikan edit ID kosong
         */

        const editId =
            document.getElementById(
                'edit_id'
            );


        if (editId) {

            editId.value = '';

        }


        /*
         * Buka modal
         */

        const modal =
            document.getElementById(
                'modal-add-gelombang'
            );


        if (modal) {

            modal.classList.remove('hidden');

            modal.classList.add('flex');

        }

    }



    /*
    |--------------------------------------------------------------------------
    | CLOSE MODAL
    |--------------------------------------------------------------------------
    */

    function closeModal() {

        const addModal =
            document.getElementById(
                'modal-add-gelombang'
            );


        const editModal =
            document.getElementById(
                'modal-edit-gelombang'
            );


        if (addModal) {

            addModal.classList.add('hidden');

            addModal.classList.remove('flex');

        }


        if (editModal) {

            editModal.classList.add('hidden');

            editModal.classList.remove('flex');

        }

    }



    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    function editGelombang(data) {

   
        const modal =
            document.getElementById(
                'modal-edit-gelombang'
            );


        if (!modal) {

            console.error(
                'Modal edit tidak ditemukan.'
            );

            return;

        }


        /*
         * ID
         */

        document.getElementById(
                'edit_id'
            ).value =
            data.id ?? '';


        /*
         * TAHUN
         */

        document.getElementById(
                'edit_id_tahun'
            ).value =
            data.id_tahun ?? '';


        /*
         * NAMA
         */

        document.getElementById(
                'edit_nama_gelombang'
            ).value =
            data.nama_gelombang ?? '';


        /*
         * AWAL
         */

        document.getElementById(
                'edit_awal'
            ).value =
            data.awal ?
            String(data.awal).substring(0, 10) :
            '';


        /*
         * AKHIR
         */

        document.getElementById(
                'edit_akhir'
            ).value =
            data.akhir ?
            String(data.akhir).substring(0, 10) :
            '';


        /*
         * STATUS
         */

        document.getElementById(
                'edit_is_current'
            ).value =
            data.is_current ?? 0;



         document.getElementById(
                'edit_kuota'
            ).value =
            data.kuota ?? '';    





        /*
         * BUKA MODAL
         */

        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }



    /*
    |--------------------------------------------------------------------------
    | EDIT BERDASARKAN ID
    |--------------------------------------------------------------------------
    */

    function editGelombangById(id) {

        const data =
            gelombangData.find(function(item) {

                return Number(item.id) === Number(id);

            });


        if (!data) {

            alert(
                'Data gelombang tidak ditemukan.'
            );

            return;

        }


        editGelombang(data);

    }



    /*
    |--------------------------------------------------------------------------
    | SAVE
    |--------------------------------------------------------------------------
    */

   function saveData() {

    // Cek apakah edit
    const editIdElement = document.getElementById('edit_id');

    const id = editIdElement ? editIdElement.value : '';
    const isEdit = id !== '';

    // Prefix form
    const prefix = isEdit ? 'edit_' : 'add_';

    // URL
    const url = isEdit
        ? "{{ url('gelombang/update') }}/" + id
        : "{{ url('gelombang/store') }}";

    // Ambil data form
    const data = {
        id_tahun: document.getElementById(prefix + 'id_tahun').value,
        nama_gelombang: document.getElementById(prefix + 'nama_gelombang').value.trim(),
        awal: document.getElementById(prefix + 'awal').value,
        akhir: document.getElementById(prefix + 'akhir').value,
        is_current: document.getElementById(prefix + 'is_current').value,

        // Kuota pendaftar
        kuota: document.getElementById(prefix + 'kuota').value
    };

    // Validasi tahun
    if (!data.id_tahun) {
        alert('Tahun wajib diisi.');
        return;
    }

    // Validasi nama gelombang
    if (!data.nama_gelombang) {
        alert('Nama gelombang wajib diisi.');
        return;
    }

    // Validasi tanggal awal
    if (!data.awal) {
        alert('Tanggal awal wajib diisi.');
        return;
    }

    // Validasi tanggal akhir
    if (!data.akhir) {
        alert('Tanggal akhir wajib diisi.');
        return;
    }

    // Validasi rentang tanggal
    if (data.akhir < data.awal) {
        alert('Tanggal akhir tidak boleh sebelum tanggal awal.');
        return;
    }

    // Validasi kuota
    if (data.kuota === '' || data.kuota === null) {
        alert('Kuota wajib diisi.');
        return;
    }

    const kuota = Number(data.kuota);

    if (!Number.isInteger(kuota) || kuota < 0) {
        alert('Kuota harus berupa bilangan bulat minimal 0.');
        return;
    }

    // Pastikan kuota dikirim sebagai angka
    data.kuota = kuota;

    // Kirim data ke Laravel
    fetch(url, {
        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },

        body: JSON.stringify(data)

    })
    .then(async function (response) {

        const result = await response.json();

        if (!response.ok) {
            throw new Error(
                result.message || 'Gagal menyimpan data.'
            );
        }

        return result;

    })
    .then(function (result) {

        // Tutup modal
        closeModal();

        // Muat ulang data gelombang
        loadGelombang();

        // Reset ID edit
        if (editIdElement) {
            editIdElement.value = '';
        }

        alert(result.message || 'Data gelombang berhasil disimpan.');

    })
    .catch(function (error) {

        console.error(error);

        alert(
            error.message || 'Terjadi kesalahan saat menyimpan data.'
        );

    });

}



    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    function deleteGelombang(id) {

        if (
            !confirm(
                'Hapus data gelombang ini?'
            )
        ) {

            return;

        }


        fetch(
                "{{ url('gelombang/delete') }}/" + id, {

                    method: 'DELETE',

                    headers: {

                        'Accept': 'application/json',

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'

                    }

                }
            )

            .then(async function(response) {

                const result =
                    await response.json();


                if (!response.ok) {

                    throw new Error(
                        result.message ||
                        'Gagal menghapus data.'
                    );

                }


                return result;

            })

            .then(function(result) {

                /*
                 * Reload card
                 */

                loadGelombang();


                alert(
                    result.message ||
                    'Berhasil dihapus.'
                );

            })

            .catch(function(error) {

                console.error(error);

                alert(
                    error.message ||
                    'Gagal menghapus data.'
                );

            });

    }



    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        if (value === null ||
            value === undefined) {

            return '';

        }


        return String(value)

            .replace(/&/g, '&amp;')

            .replace(/</g, '&lt;')

            .replace(/>/g, '&gt;')

            .replace(/"/g, '&quot;')

            .replace(/'/g, '&#039;');

    }



    /*
    |--------------------------------------------------------------------------
    | LOAD AWAL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            loadGelombang();

        }
    );
</script>

@endsection