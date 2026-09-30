@extends('layout.app')

@section('title', 'Ujian Calon Siswa')
@section('page_title', 'Ujian Calon Siswa')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center
        sm:justify-between gap-4">

        <div>

            <h1 class="text-2xl sm:text-3xl font-extrabold
                text-slate-900 tracking-tight">

                Ujian Calon Siswa

            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola ujian, soal, peserta, dan hasil ujian calon siswa.
            </p>

        </div>


        {{-- TAMBAH UJIAN --}}
        <a href="{{ route('ujianCalonAdmin.create') }}"
            class="inline-flex items-center justify-center gap-2
            px-5 py-2.5 rounded-xl
            bg-teal-600 text-white
            text-sm font-semibold
            hover:bg-teal-700
            focus:outline-none
            focus:ring-2 focus:ring-teal-500/30
            transition">

            <i data-lucide="plus"
                class="w-4 h-4"></i>

            Tambah Ujian

        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))

        <div
            class="flex items-start gap-3
            rounded-xl border border-emerald-200
            bg-emerald-50 px-4 py-3
            text-sm text-emerald-700">

            <i data-lucide="check-circle"
                class="w-5 h-5 mt-0.5 shrink-0"></i>

            <div>

                <div class="font-semibold">
                    Berhasil
                </div>

                <div class="mt-0.5">
                    {{ session('success') }}
                </div>

            </div>

        </div>

    @endif


    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl border border-slate-200
        shadow-sm overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200
            flex flex-col sm:flex-row sm:items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-teal-50
                flex items-center justify-center shrink-0">

                <i data-lucide="clipboard-check"
                    class="w-5 h-5 text-teal-600"></i>

            </div>

            <div>

                <h2 class="text-lg font-semibold text-slate-800">
                    Data Ujian
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Daftar ujian yang tersedia untuk calon siswa.
                </p>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="p-5">

            <div class="overflow-x-auto">

                <div id="table-ujian"></div>

            </div>

        </div>

    </div>

</main>


{{-- =========================================================
    DELETE CONFIRM MODAL
========================================================= --}}

<div
    id="modal-delete-ujian"
    class="fixed inset-0 z-50 hidden items-center justify-center
    bg-slate-900/60 backdrop-blur-sm p-4">

    <div
        class="w-full max-w-md bg-white rounded-3xl
        shadow-2xl border border-slate-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-red-50
                    flex items-center justify-center">

                    <i data-lucide="trash-2"
                        class="w-5 h-5 text-red-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        Hapus Ujian
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Konfirmasi penghapusan data ujian.
                    </p>

                </div>

            </div>

        </div>


        {{-- BODY --}}
        <div class="p-6">

            <input type="hidden" id="delete_id">

            <p class="text-sm text-slate-600">

                Apakah Anda yakin ingin menghapus ujian

                <span
                    id="delete_nama"
                    class="font-semibold text-slate-800">
                </span>

                ?

            </p>

            <div
                class="mt-4 rounded-xl border border-red-100
                bg-red-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i data-lucide="triangle-alert"
                        class="w-5 h-5 text-red-600
                        mt-0.5 shrink-0"></i>

                    <p class="text-sm text-red-700">
                        Data soal dan data terkait ujian dapat ikut terhapus.
                        Pastikan Anda benar-benar ingin melanjutkan.
                    </p>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div
            class="px-6 py-5 border-t border-slate-200
            bg-slate-50 flex justify-end gap-3">

            <button
                type="button"
                onclick="closeDeleteModal()"
                class="inline-flex items-center justify-center
                gap-2 px-5 py-2.5 rounded-xl
                border border-slate-300
                bg-white text-slate-700
                text-sm font-semibold
                hover:bg-slate-50 transition">

                <i data-lucide="x"
                    class="w-4 h-4"></i>

                Batal

            </button>


            <button
                type="button"
                onclick="deleteUjian()"
                class="inline-flex items-center justify-center
                gap-2 px-5 py-2.5 rounded-xl
                bg-red-600 text-white
                text-sm font-semibold
                hover:bg-red-700
                focus:outline-none
                focus:ring-2 focus:ring-red-500/30
                transition">

                <i data-lucide="trash-2"
                    class="w-4 h-4"></i>

                Hapus

            </button>

        </div>

    </div>

</div>


<script>

    // =====================================================
    // DATA DARI LARAVEL
    // =====================================================

    const ujianData = @json($data->items());


    // =====================================================
    // TABULATOR
    // =====================================================

    let table = new Tabulator("#table-ujian", {

        data: ujianData,

        layout: "fitDataStretch",

        pagination: "local",

        paginationSize: 10,

        paginationSizeSelector: [10, 25, 50],

        placeholder: "Belum ada data ujian.",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 60,
            },


            {
                title: "Nama Ujian",
                field: "nama_ujian",
                minWidth: 220,

                formatter: function(cell) {

                    let data = cell.getRow().getData();

                    let nama =
                        data.nama_ujian ?? '-';

                    let deskripsi =
                        data.deskripsi ?? '';

                    if (deskripsi.length > 60) {

                        deskripsi =
                            deskripsi.substring(0, 60) + '...';

                    }

                    return `
                        <div class="py-1">

                            <div class="font-semibold
                                text-slate-800">

                                ${nama}

                            </div>

                            <div class="text-xs
                                text-slate-500 mt-1">

                                ${deskripsi}

                            </div>

                        </div>
                    `;

                }

            },


            {
                title: "Durasi",
                field: "durasi",
                hozAlign: "center",

                formatter: function(cell) {

                    return `
                        <span class="text-sm
                            text-slate-600">

                            ${cell.getValue() ?? 0} menit

                        </span>
                    `;

                }

            },


            {
                title: "Nilai Minimal",
                field: "nilai_minimal",
                hozAlign: "center",

                formatter: function(cell) {

                    let value =
                        Number(cell.getValue() ?? 0);

                    return `
                        <span class="font-medium
                            text-slate-700">

                            ${value.toLocaleString('id-ID')}

                        </span>
                    `;

                }

            },


            {
                title: "Jumlah Soal",
                field: "soal_count",
                hozAlign: "center",

                formatter: function(cell) {

                    return `
                        <span class="inline-flex
                            items-center justify-center
                            min-w-8 px-2 py-1
                            rounded-lg
                            bg-blue-50
                            text-blue-700
                            text-xs font-semibold">

                            ${cell.getValue() ?? 0}

                        </span>
                    `;

                }

            },


            {
                title: "Peserta",
                field: "peserta_count",
                hozAlign: "center",

                formatter: function(cell) {

                    return `
                        <span class="inline-flex
                            items-center justify-center
                            min-w-8 px-2 py-1
                            rounded-lg
                            bg-violet-50
                            text-violet-700
                            text-xs font-semibold">

                            ${cell.getValue() ?? 0}

                        </span>
                    `;

                }

            },


            {
                title: "Status",
                field: "status",
                hozAlign: "center",

                formatter: function(cell) {

                    let aktif =
                        Number(cell.getValue()) === 1;

                    if (aktif) {

                        return `
                            <span
                                class="inline-flex items-center
                                gap-1.5 px-2.5 py-1
                                rounded-full
                                bg-emerald-50
                                text-emerald-700
                                text-xs font-semibold">

                                <span
                                    class="w-1.5 h-1.5
                                    rounded-full
                                    bg-emerald-500">
                                </span>

                                Aktif

                            </span>
                        `;

                    }

                    return `
                        <span
                            class="inline-flex items-center
                            gap-1.5 px-2.5 py-1
                            rounded-full
                            bg-slate-100
                            text-slate-500
                            text-xs font-semibold">

                            <span
                                class="w-1.5 h-1.5
                                rounded-full
                                bg-slate-400">
                            </span>

                            Tidak Aktif

                        </span>
                    `;

                }

            },


            {
                title: "Aksi",
                hozAlign: "center",
                minWidth: 330,

                formatter: function(cell) {

                    let data =
                        cell.getRow().getData();

                    return `

                        <div class="flex items-center
                            justify-center gap-2">

                            {{-- SOAL --}}
                            <a
                                href="/soalCalon/${data.id}"
                                class="inline-flex
                                items-center gap-1.5
                                px-3 py-2 rounded-lg
                                bg-blue-50
                                text-blue-700
                                border border-blue-100
                                text-xs font-semibold
                                hover:bg-blue-100
                                transition">

                                <i data-lucide="file-question"
                                    class="w-4 h-4">
                                </i>

                                Soal

                            </a>


                            {{-- EDIT --}}
                            <a
                                href="/ujianCalonAdmin/${data.id}/edit"
                                class="inline-flex
                                items-center gap-1.5
                                px-3 py-2 rounded-lg
                                bg-amber-50
                                text-amber-700
                                border border-amber-100
                                text-xs font-semibold
                                hover:bg-amber-100
                                transition">

                                <i data-lucide="pencil"
                                    class="w-4 h-4">
                                </i>

                                Edit

                            </a>


                            {{-- HASIL --}}
                            <a
                                href="/ujianCalonAdmin/${data.id}/peserta"
                                class="inline-flex
                                items-center gap-1.5
                                px-3 py-2 rounded-lg
                                bg-emerald-50
                                text-emerald-700
                                border border-emerald-100
                                text-xs font-semibold
                                hover:bg-emerald-100
                                transition">

                                <i data-lucide="bar-chart-3"
                                    class="w-4 h-4">
                                </i>

                                Hasil

                            </a>


                            {{-- HAPUS --}}
                            <button
                                type="button"
                                onclick='openDeleteModal(${JSON.stringify(data)})'
                                class="inline-flex
                                items-center gap-1.5
                                px-3 py-2 rounded-lg
                                bg-red-50
                                text-red-700
                                border border-red-100
                                text-xs font-semibold
                                hover:bg-red-100
                                transition">

                                <i data-lucide="trash-2"
                                    class="w-4 h-4">
                                </i>

                                Hapus

                            </button>

                        </div>

                    `;

                }

            }

        ],

        renderComplete: function() {

          //  if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            //}

        }

    });


    // =====================================================
    // DELETE MODAL
    // =====================================================

    function openDeleteModal(data) {

        document.getElementById('delete_id').value =
            data.id;

        document.getElementById('delete_nama').textContent =
            data.nama_ujian ?? '';

        const modal =
            document.getElementById('modal-delete-ujian');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    }


    function closeDeleteModal() {

        const modal =
            document.getElementById('modal-delete-ujian');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

    }


    // =====================================================
    // DELETE UJIAN
    // =====================================================

    function deleteUjian() {

        let id =
            document.getElementById('delete_id').value;

        let form =
            document.createElement('form');

        form.method = 'POST';

        form.action =
            "{{ url('ujianCalonAdmin/hapus') }}/" + id;


        let csrf =
            document.createElement('input');

        csrf.type = 'hidden';

        csrf.name = '_token';

        csrf.value =
            "{{ csrf_token() }}";


        let method =
            document.createElement('input');

        method.type = 'hidden';

        method.name = '_method';

        method.value = 'DELETE';


        form.appendChild(csrf);

        form.appendChild(method);

        document.body.appendChild(form);

        form.submit();

    }


    // =====================================================
    // CLOSE MODAL OUTSIDE
    // =====================================================

    document
        .getElementById('modal-delete-ujian')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                closeDeleteModal();

            }

        });


    // =====================================================
    // LUCIDE
    // =====================================================

    if (typeof lucide !== 'undefined') {

        lucide.createIcons();

    }

</script>

@endsection

