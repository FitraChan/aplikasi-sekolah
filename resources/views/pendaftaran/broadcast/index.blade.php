@extends('layout.app')

@section('title', 'Broadcast')
@section('page_title', 'Broadcast')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <div class="flex items-center gap-2 mb-2">

                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2
                          text-sm font-medium
                          text-[#02BC9C]
                          hover:text-[#02a387]
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
                Broadcast
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola pesan broadcast dan kirim informasi kepada calon siswa.
            </p>

        </div>


        <!-- TAMBAH -->
        <button
            type="button"
            onclick="openBroadcast()"
            class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5
                   bg-[#00bfa5]
                   hover:bg-[#00a892]
                   text-white
                   text-sm font-semibold
                   rounded-lg
                   shadow-sm
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

            Tambah Broadcast

        </button>

    </div>


    <!-- TABLE CARD -->
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

        <!-- CARD HEADER -->
        <div class="flex items-center gap-3
                    p-6 border-b border-slate-200">

            <div class="w-10 h-10 rounded-lg
                        bg-teal-50
                        border border-teal-100
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
                    Daftar Broadcast
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Daftar pesan broadcast yang tersedia
                </p>

            </div>

        </div>


        <!-- TABLE -->
        <div class="p-6">

            <div class="overflow-x-auto">

                <div id="table-broadcast"></div>

            </div>

        </div>

    </section>


    <!-- BROADCAST CARD -->
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

        <!-- CARD HEADER -->
        <div class="flex items-center gap-3
                    p-6 border-b border-slate-200">

            <div class="w-10 h-10 rounded-lg
                        bg-teal-50
                        border border-teal-100
                        flex items-center justify-center
                        text-teal-600">

                <!-- MEGAPHONE -->
                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     viewBox="0 0 24 24">

                    <path d="M3 11v2"></path>

                    <path d="M5 9h4l10-5v16L9 15H5z"></path>

                    <path d="M9 15l2 5"></path>

                </svg>

            </div>

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Kirim Broadcast
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Kirim pesan kepada calon siswa berdasarkan gelombang.
                </p>

            </div>

        </div>


        <!-- BODY -->
        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                <!-- BROADCAST -->
                <div>

                    <label
                        for="status"
                        class="block text-xs font-semibold text-slate-700 mb-2">

                        Pilih Broadcast

                    </label>

                    <div class="relative">

                        <select
                            id="status"
                            onchange="changeBroadcast(this)"
                            class="w-full appearance-none rounded-xl
                                   border border-slate-200
                                   bg-white
                                   px-4 py-3 pr-10
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-teal-500
                                   focus:ring-2
                                   focus:ring-teal-500/20">

                            <option value="">
                                -- Pilih Broadcast --
                            </option>

                            <?php foreach ($broadcast as $row): ?>

                                <option
                                    value="<?= $row->id ?>"
                                    data-pesan='@json($row->pesan)'>

                                    <?= $row->judul ?>

                                </option>

                            <?php endforeach; ?>

                        </select>


                        <div
                            class="pointer-events-none absolute inset-y-0 right-0
                                   flex items-center pr-3
                                   text-slate-400">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>

                            </svg>

                        </div>

                    </div>

                </div>


                <!-- GELOMBANG -->
                <div>

                    <label
                        for="id_gelombang"
                        class="block text-xs font-semibold text-slate-700 mb-2">

                        Pilih Gelombang

                    </label>

                    <div class="relative">

                        <select
                            id="id_gelombang"
                            class="w-full appearance-none rounded-xl
                                   border border-slate-200
                                   bg-white
                                   px-4 py-3 pr-10
                                   text-sm text-slate-700
                                   outline-none transition
                                   focus:border-teal-500
                                   focus:ring-2
                                   focus:ring-teal-500/20">

                            <option value="">
                                -- Pilih Gelombang --
                            </option>

                            <option value="all">
                                -- Semua Gelombang --
                            </option>

                            @foreach ($gelombang as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->nama_gelombang }}
                                </option>

                            @endforeach

                        </select>


                        <div
                            class="pointer-events-none absolute inset-y-0 right-0
                                   flex items-center pr-3
                                   text-slate-400">

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>

                            </svg>

                        </div>

                    </div>

                </div>


                <!-- CATATAN -->
                <div class="md:col-span-2">

                    <label
                        for="textarea-pesan"
                        class="block text-xs font-semibold text-slate-700 mb-2">

                        Catatan

                    </label>

                    <textarea
                        id="textarea-pesan"
                        name="isi"
                        rows="6"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-3
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20"></textarea>

                </div>

            </div>


            <!-- INFO -->
            <div
                class="mt-5 rounded-2xl
                       border border-teal-100
                       bg-teal-50
                       px-4 py-3">

                <div class="flex gap-3">

                    <div class="mt-0.5 text-teal-600">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 21
                                   a9 9 0 100-18 9 9 0 000 18z">
                            </path>

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-semibold text-teal-800">
                            Informasi Broadcast
                        </p>

                        <p class="text-xs text-teal-700 mt-0.5 leading-relaxed">
                            Pilih pesan dan gelombang penerima sebelum
                            mengirimkan broadcast kepada calon siswa.
                        </p>

                    </div>

                </div>

            </div>


            <!-- BUTTON -->
            <div class="mt-5 flex justify-end">

                <button
                    type="button"
                    onclick="broadcastSemua()"
                    class="inline-flex items-center gap-2
                           px-5 py-2.5
                           rounded-xl
                           bg-teal-600
                           hover:bg-teal-700
                           text-white
                           text-sm font-semibold
                           shadow-sm
                           transition-colors">

                    <!-- SEND ICON -->
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M22 2L11 13">
                        </path>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M22 2l-7 20-4-9-9-4 20-7z">
                        </path>

                    </svg>

                    Broadcast Calon Siswa

                </button>

            </div>

        </div>

    </section>

</main>


<!-- ========================================================= -->
<!-- MODAL BROADCAST -->
<!-- ========================================================= -->

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


<div
    id="modal-broadcast"
    class="fixed inset-0 z-50 hidden items-center justify-center
           p-4 bg-slate-900/60 backdrop-blur-xs">

    <div
        class="relative w-full max-w-2xl
               bg-white rounded-3xl
               shadow-2xl text-left
               border border-slate-100
               overflow-hidden">


        <!-- HEADER -->
        <div class="px-6 py-5 sm:px-7 border-b border-slate-100">

            <div class="flex items-center gap-3">

                <div
                    class="w-12 h-12 rounded-2xl
                           bg-teal-50
                           text-teal-600
                           flex items-center justify-center
                           border border-teal-100">

                    <!-- MEGAPHONE -->
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 11v2h4l10 5V6L7 11H3z">
                        </path>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M7 13l2 6">
                        </path>

                    </svg>

                </div>


                <div>

                    <h3 class="text-lg font-bold text-slate-900">
                        Tambah Broadcast
                    </h3>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Buat pesan broadcast baru untuk calon siswa.
                    </p>

                </div>

            </div>

        </div>


        <!-- BODY -->
        <div class="px-6 py-6 sm:px-7">

            <input
                type="hidden"
                id="id">


            <div class="space-y-5">


                <!-- JUDUL -->
                <div>

                    <label
                        for="judul"
                        class="block text-xs font-semibold
                               text-slate-700 mb-2">

                        Judul

                    </label>

                    <input
                        type="text"
                        id="judul"
                        placeholder="Masukkan judul broadcast"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-3
                               text-sm text-slate-700
                               outline-none transition
                               focus:border-teal-500
                               focus:ring-2
                               focus:ring-teal-500/20">

                </div>


                <!-- PESAN -->
                <div>

                    <label
                        for="pesan"
                        class="block text-xs font-semibold
                               text-slate-700 mb-2">

                        Pesan

                    </label>

                    <textarea
                        id="pesan"
                        rows="10"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-3
                               text-sm text-slate-700
                               outline-none transition"></textarea>

                </div>

            </div>


            <!-- INFO -->
            <div
                class="mt-5 rounded-2xl
                       border border-teal-100
                       bg-teal-50
                       px-4 py-3">

                <div class="flex gap-3">

                    <div class="mt-0.5 text-teal-600">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 21
                                   a9 9 0 100-18 9 9 0 000 18z">
                            </path>

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-semibold text-teal-800">
                            Tips
                        </p>

                        <p class="text-xs text-teal-700 mt-0.5">
                            Gunakan judul yang singkat dan pesan yang jelas
                            agar mudah dipahami oleh penerima.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- FOOTER -->
        <div
            class="px-6 py-4 sm:px-7
                   bg-slate-50
                   border-t border-slate-100">

            <div
                class="flex flex-col-reverse
                       sm:flex-row
                       sm:justify-end gap-3">


                <!-- BATAL -->
                <button
                    type="button"
                    onclick="closeBroadcast()"
                    class="w-full sm:w-auto
                           px-5 py-2.5
                           rounded-xl
                           border border-slate-200
                           bg-white
                           text-sm font-semibold
                           text-slate-600
                           hover:bg-slate-100
                           transition">

                    Batal

                </button>


                <!-- SIMPAN -->
                <button
                    type="button"
                    onclick="saveData()"
                    class="w-full sm:w-auto
                           px-5 py-2.5
                           rounded-xl
                           bg-teal-600
                           text-white
                           text-sm font-semibold
                           hover:bg-teal-700
                           focus:outline-none
                           focus:ring-2
                           focus:ring-teal-500/30
                           transition">

                    Simpan Broadcast

                </button>

            </div>

        </div>

    </div>

</div>


<script>

/*
|--------------------------------------------------------------------------
| CKEDITOR
|--------------------------------------------------------------------------
*/

let editorPesan = null;

ClassicEditor
    .create(document.querySelector('#pesan'))
    .then(editor => {

        editorPesan = editor;

    })
    .catch(error => {

        console.error(error);

    });


let editorPesanBroadcast = null;

ClassicEditor
    .create(document.querySelector('#textarea-pesan'))
    .then(editor => {

        editorPesanBroadcast = editor;

    })
    .catch(error => {

        console.error(error);

    });


/*
|--------------------------------------------------------------------------
| OPEN MODAL
|--------------------------------------------------------------------------
*/

function openBroadcast()
{

    document.getElementById('id').value = '';

    document.getElementById('judul').value = '';

    if (editorPesan) {

        editorPesan.setData('');

    }

    const modal =
        document.getElementById('modal-broadcast');

    modal.classList.remove('hidden');

    modal.classList.add('flex');

}


/*
|--------------------------------------------------------------------------
| CLOSE MODAL
|--------------------------------------------------------------------------
*/

function closeBroadcast()
{

    const modal =
        document.getElementById('modal-broadcast');

    modal.classList.add('hidden');

    modal.classList.remove('flex');

}


/*
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
*/

function editData(data)
{

    document.getElementById('id').value =
        data.id ?? '';

    document.getElementById('judul').value =
        data.judul ?? '';

    if (editorPesan) {

        editorPesan.setData(
            data.pesan ?? ''
        );

    }

    const modal =
        document.getElementById('modal-broadcast');

    modal.classList.remove('hidden');

    modal.classList.add('flex');

}


/*
|--------------------------------------------------------------------------
| SAVE DATA
|--------------------------------------------------------------------------
*/

function saveData()
{

    let id =
        document.getElementById('id').value;


    let url = id
        ? "{{ url('broadcast/update') }}/" + id
        : "{{ url('broadcast/store') }}";


    fetch(url, {

        method: 'POST',

        headers: {

            'Content-Type':
                'application/json',

            'Accept':
                'application/json',

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}'

        },

        body: JSON.stringify({

            judul:
                document.getElementById(
                    'judul'
                ).value,

            pesan:
                editorPesan
                    ? editorPesan.getData()
                    : ''

        })

    })

    .then(async response => {

        const result =
            await response.json();

        if (!response.ok) {

            throw result;

        }

        return result;

    })

    .then(result => {

        table.replaceData();

        closeBroadcast();

        document.getElementById('id').value = '';

        document.getElementById('judul').value = '';

        if (editorPesan) {

            editorPesan.setData('');

        }

        alert(
            result.message ??
            'Data berhasil disimpan'
        );

    })

    .catch(error => {

        console.error(error);

        alert(
            error.message ??
            'Terjadi kesalahan saat menyimpan data'
        );

    });

}


/*
|--------------------------------------------------------------------------
| CHANGE BROADCAST
|--------------------------------------------------------------------------
*/

function changeBroadcast(select)
{

    const option =
        select.options[
            select.selectedIndex
        ];

    const rawPesan =
        option.getAttribute(
            'data-pesan'
        );


    let pesan = '';


    if (rawPesan) {

        try {

            pesan =
                JSON.parse(rawPesan);

        } catch (error) {

            pesan =
                rawPesan;

        }

    }


    if (editorPesanBroadcast) {

        editorPesanBroadcast.setData(
            pesan ?? ''
        );

    }

}


/*
|--------------------------------------------------------------------------
| BROADCAST SEMUA
|--------------------------------------------------------------------------
*/

function broadcastSemua()
{

    let id_broadcast =
        document.getElementById(
            'status'
        ).value;


    const idGelombang =
        document.getElementById(
            'id_gelombang'
        ).value;


    if (id_broadcast === '') {

        alert(
            'Pilih broadcast terlebih dahulu'
        );

        return;

    }


    fetch(
        "{{ url('broadcast/kirimSemua') }}",
        {

            method: 'POST',

            headers: {

                'Content-Type':
                    'application/json',

                'Accept':
                    'application/json',

                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}'

            },

            body: JSON.stringify({

                id_broadcast:
                    id_broadcast,

                id_gelombang:
                    idGelombang

            })

        }

    )

    .then(response => response.json())

    .then(result => {

        alert(
            result.message
        );

    })

    .catch(error => {

        console.error(error);

        alert(
            'Terjadi kesalahan saat mengirim broadcast'
        );

    });

}


/*
|--------------------------------------------------------------------------
| TABULATOR
|--------------------------------------------------------------------------
*/

let table = new Tabulator(
    "#table-broadcast",
    {

        ajaxURL:
            "{{ route('broadcast.data') }}",

        layout:
            "fitColumns",

        pagination:
            true,

        paginationSize:
            10,

        placeholder:
            "Belum ada data broadcast.",


        columns: [

            {
                title: "No",

                formatter: "rownum",

                hozAlign: "center",

                width: 70
            },


            {
                title: "Judul",

                field: "judul",

                minWidth: 180,

                formatter: function(cell) {

                    return `
                        <span class="font-semibold text-slate-700">
                            ${cell.getValue() ?? ''}
                        </span>
                    `;

                }

            },


            {
                title: "Pesan",

                field: "pesan",

                minWidth: 300,

                formatter: function(cell) {

                    let value =
                        cell.getValue() ?? '';

                    let text =
                        value
                            .replace(/<[^>]*>/g, '')
                            .substring(0, 100);

                    return `
                        <span class="text-sm text-slate-500">
                            ${text}${value.length > 100 ? '...' : ''}
                        </span>
                    `;

                }

            },


            {
                title: "Tanggal",

                field: "tgl_update",

                hozAlign: "center",

                minWidth: 150

            },


            {
                title: "Aksi",

                hozAlign: "center",

                width: 150,

                headerSort: false,


                formatter: function(cell) {

                    let data =
                        cell.getData();


                    return `

                        <div class="flex items-center
                                    justify-center gap-2">


                            <!-- EDIT -->

                            <button
                                type="button"

                                onclick='editData(${JSON.stringify(data)})'

                                class="w-9 h-9
                                       inline-flex
                                       items-center
                                       justify-center
                                       rounded-lg
                                       bg-amber-50
                                       border
                                       border-amber-100
                                       text-amber-600
                                       hover:bg-amber-100
                                       transition-colors"

                                title="Edit">

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 20h9">
                                    </path>

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16.5 3.5a2.121
                                           2.121 0 013 3L7 19l-4 1
                                           1-4z">
                                    </path>

                                </svg>

                            </button>


                            <!-- DELETE -->

                            <button
                                type="button"

                                onclick="deleteData(${data.id})"

                                class="w-9 h-9
                                       inline-flex
                                       items-center
                                       justify-center
                                       rounded-lg
                                       bg-red-50
                                       border
                                       border-red-100
                                       text-red-600
                                       hover:bg-red-100
                                       transition-colors"

                                title="Hapus">

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <polyline
                                        points="3 6 5 6 21 6">
                                    </polyline>

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 6v14a2 2 0
                                           01-2 2H7a2 2 0
                                           01-2-2V6">
                                    </path>

                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>

                                    <path
                                        d="M9 6V4a2 2 0
                                           012-2h2a2 2 0
                                           012 2v2">
                                    </path>

                                </svg>

                            </button>

                        </div>

                    `;

                }

            }

        ]

    });


/*
|--------------------------------------------------------------------------
| DELETE
|--------------------------------------------------------------------------
*/

function deleteData(id)
{

    if (!confirm(
        'Hapus data broadcast ini?'
    )) {

        return;

    }


    fetch(
        "{{ url('broadcast/delete') }}/" + id,
        {

            method: 'DELETE',

            headers: {

                'Accept':
                    'application/json',

                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}'

            }

        }

    )

    .then(async response => {

        const result =
            await response.json();

        if (!response.ok) {

            throw result;

        }

        return result;

    })

    .then(result => {

        table.replaceData();

        alert(
            result.message ??
            'Data berhasil dihapus'
        );

    })

    .catch(error => {

        console.error(error);

        alert(
            error.message ??
            'Terjadi kesalahan saat menghapus data'
        );

    });

}

</script>

@endsection