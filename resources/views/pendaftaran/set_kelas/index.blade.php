@extends('layout.app')

@section('title', 'Set Kelas')
@section('page_title', 'Set Kelas')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center
        sm:justify-between gap-4">

        <div>

           

            <h1 class="text-2xl sm:text-3xl font-extrabold
                text-slate-900 tracking-tight">

                Set Kelas

            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Atur kelas siswa sesuai dengan jurusan dan tahun ajaran.
            </p>

        </div>

    </div>


    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm
        overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200
            flex flex-col sm:flex-row sm:items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-teal-50
                flex items-center justify-center shrink-0">

                <i data-lucide="school"
                    class="w-5 h-5 text-teal-600"></i>

            </div>

            <div>

                <h2 class="text-lg font-semibold text-slate-800">
                    Data Set Kelas
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Daftar siswa yang dapat diatur kelasnya.
                </p>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="p-5">

            <div class="overflow-x-auto">

                <div id="table-set-kelas"></div>

            </div>

        </div>

    </div>

</main>


{{-- MODAL EDIT KELAS --}}
<div
    id="modal-edit-kelas"
    class="fixed inset-0 z-50 hidden items-center justify-center
        bg-slate-900/60 backdrop-blur-sm p-4">

    <div
        class="w-full max-w-lg bg-white rounded-3xl shadow-2xl
        border border-slate-100 overflow-hidden">

        {{-- MODAL HEADER --}}
        <div class="px-6 py-5 border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-teal-50
                    flex items-center justify-center">

                    <i data-lucide="school"
                        class="w-5 h-5 text-teal-600"></i>

                </div>

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        Edit Kelas
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Tentukan kelas untuk siswa.
                    </p>

                </div>

            </div>

        </div>


        {{-- MODAL BODY --}}
        <div class="p-6 space-y-5">

            <input type="hidden" id="edit_id">


            {{-- NAMA SISWA --}}
            <div>

                <label
                    for="edit_nama"
                    class="block text-sm font-semibold
                    text-slate-700 mb-2">

                    Nama Siswa

                </label>

                <input
                    type="text"
                    id="edit_nama"
                    readonly
                    class="w-full rounded-xl border border-slate-200
                        bg-slate-100 px-4 py-2.5
                        text-sm text-slate-600
                        cursor-not-allowed">

            </div>


            {{-- PILIH KELAS --}}
            <div>

                <label
                    for="edit_id_kelas"
                    class="block text-sm font-semibold
                    text-slate-700 mb-2">

                    Pilih Kelas

                </label>

                <select
                    id="edit_id_kelas"
                    class="w-full rounded-xl border border-slate-200
                        bg-white px-4 py-2.5
                        text-sm text-slate-700
                        focus:border-teal-500
                        focus:ring-2 focus:ring-teal-500/20
                        outline-none transition">

                    @foreach($kelas as $item)

                        @php

                            if ($item->sisa < 0) {

                                $kuota = ' - Lebih ' .
                                    abs($item->sisa) .
                                    ' Siswa';

                            } else {

                                $kuota = ' - Kuota ' .
                                    $item->sisa .
                                    ' Siswa';

                            }

                        @endphp

                        <option value="{{ $item->idx }}">

                            {{ $item->nama_kelas . $kuota }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- INFO --}}
            <div class="rounded-xl border border-teal-100
                bg-teal-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i data-lucide="info"
                        class="w-5 h-5 text-teal-600
                        mt-0.5 shrink-0"></i>

                    <p class="text-sm text-teal-700">

                        Pilih kelas sesuai dengan kuota yang tersedia.
                        Informasi kuota akan ditampilkan pada pilihan kelas.

                    </p>

                </div>

            </div>

        </div>


        {{-- MODAL FOOTER --}}
        <div class="px-6 py-5 border-t border-slate-200
            bg-slate-50 flex justify-end gap-3">

            <button
                type="button"
                onclick="closeKelasModal()"
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
                onclick="saveKelas()"
                class="inline-flex items-center justify-center
                    gap-2 px-6 py-2.5 rounded-xl
                    bg-teal-600 text-white
                    text-sm font-semibold
                    hover:bg-teal-700
                    focus:outline-none
                    focus:ring-2 focus:ring-teal-500/30
                    transition">

                <i data-lucide="save"
                    class="w-4 h-4"></i>

                Simpan

            </button>

        </div>

    </div>

</div>


<script>

    let table = new Tabulator("#table-set-kelas", {

        ajaxURL: "{{ route('set-kelas.data') }}",

        layout: "fitColumns",

        pagination: true,

        paginationSize: 10,

        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 60,
            },

            {
                title: "Nama Siswa",
                field: "nama_lengkap"
            },

            {
                title: "Tahun Ajaran",
                field: "tahun_ajaran"
            },

            {
                title: "Jurusan",
                field: "nama_jurusan"
            },

            {
                title: "Kelas",
                field: "nama_kelas",

                formatter: function(cell) {

                    let value = cell.getValue();

                    return value ?? '-';

                }
            },

            {
                title: "Status",
                field: "status_siswa"
            },

            {
                title: "Action",
                hozAlign: "center",
                width: 130,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `
                        <button
                            type="button"
                            onclick='editKelas(${JSON.stringify(data)})'
                            class="inline-flex items-center gap-2
                                px-3 py-2 rounded-lg
                                bg-teal-50 text-teal-700
                                border border-teal-100
                                text-xs font-semibold
                                hover:bg-teal-100
                                transition">

                            <i data-lucide="school"
                                class="w-4 h-4"></i>

                            Set Kelas

                        </button>
                    `;
                }
            }

        ],

    });


    // =====================================================
    // OPEN MODAL
    // =====================================================

    function openKelasModal() {

        const modal =
            document.getElementById('modal-edit-kelas');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    }


    // =====================================================
    // CLOSE MODAL
    // =====================================================

    function closeKelasModal() {

        const modal =
            document.getElementById('modal-edit-kelas');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

    }


    // =====================================================
    // EDIT KELAS
    // =====================================================

    function editKelas(data) {

        document.getElementById('edit_id').value =
            data.id;

        document.getElementById('edit_nama').value =
            data.nama_lengkap;

        document.getElementById('edit_id_kelas').value =
            data.id_kelas ?? '';

        openKelasModal();

    }


    // =====================================================
    // SAVE KELAS
    // =====================================================

    function saveKelas() {

        let id =
            document.getElementById('edit_id').value;

        let idKelas =
            document.getElementById('edit_id_kelas').value;


        fetch("{{ url('set-kelas/updateKelas') }}/" + id, {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json',

                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}',

                'Accept':
                    'application/json'

            },

            body: JSON.stringify({

                id_kelas: idKelas

            })

        })

        .then(res => res.json())

        .then(res => {

            closeKelasModal();

            table.replaceData();

        })

        .catch(error => {

            console.error(
                'Gagal menyimpan kelas:',
                error
            );

        });

    }


    // =====================================================
    // CLOSE MODAL KETIKA KLIK AREA LUAR
    // =====================================================

    document.getElementById('modal-edit-kelas')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                closeKelasModal();

            }

        });


</script>

@endsection