@extends('layout.main')

@section('tittle')
Ujian
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Ujian</li>
</ol>
@endsection

@section('body')


<div class="max-w-7xl mx-auto p-6">

    <div class="flex gap-2 mb-3">

        <button
            class="btn btn-primary"
            data-tw-toggle="modal"
            data-tw-target="#modal-add-ujian">

            + Tambah Ujian

        </button>

    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Daftar Ujian
                    </h2>

                </div>

                <div class="p-5">

                    <div class="overflow-x-auto">

                        <div id="table-ujian"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('guru.ujian.tambah')

<script>
    const tableQuiz = new Tabulator("#table-ujian", {

        ajaxURL: "{{ route('ujianGuru.data') }}",

        layout: "fitDataStretch",

        pagination: true,

        paginationSize: 10,

        responsiveLayout: "collapse",

        placeholder: "Belum ada data.",

        columns: [

            {
                title: "No",
                formatter: "rownum",
                width: 60,
                hozAlign: "center"
            },

            {
                title: "Judul Ujian",
                field: "judul",
                width: 450

            },

            {
                title: "Jadwal Ujian",
                field: "tgl_quiz",
                width: 150
            },

            {
                title: "Kelas",
                field: "kelas",
                width: 100
            },

            {
                title: "Nama Mapel",
                field: "nama_mapel",
                width: 250
            },
            {
                title: "Aksi",
                width: 220,

                formatter: function(cell) {

                    let data = cell.getData();
                    return `                 
                      <a href="{{ url('pbm/dataDetQuiz') }}/${data.id}"
                        class="btn btn-sm btn-outline-primary mr-1">
                            <i data-lucide="pencil" class="w-4 h-4 mr-1"></i>
                            Edit
                        </a>
                    <button class="btn btn-sm btn-outline-danger"
                        onclick="hapusQuiz(${data.id})">
                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                        Hapus
                    </button>
                `;

                }

            }

        ]

    });

    document.getElementById('btn-save-ujian').addEventListener('click', function(e) {
        e.preventDefault();

        const btn = this;
        const form = document.getElementById('frm-tambah-ujian');
        const formData = new FormData(form);

        btn.disabled = true;
        btn.innerHTML = 'Menyimpan...';

        fetch("{{ route('ujianGuru.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(res => {

                if (res.success) {

                    Swal.fire({
                        icon: 'success',
                        title: res.title,
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    form.reset();

                    // Tutup modal
                    const modal = tailwind.Modal.getOrCreateInstance(
                        document.querySelector('#modal-add-ujian')
                    );
                    modal.hide();

                    console.log(res.data);


                    // Reload DataTable jika ada
                    if (typeof tableQuiz !== 'undefined') {
                        tableQuiz.replaceData();
                    }

                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: res.title,
                        text: res.msg
                    });

                }

            })
            .catch(error => {

                console.error(error);

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan pada server.'
                });

            })
            .finally(() => {

                btn.disabled = false;
                btn.innerHTML = 'Simpan';

            });

    });

    async function hapusQuiz(id) {

        const konfirmasi = await Swal.fire({
            title: "Hapus Ujian?",
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal",
            reverseButtons: true
        });

        if (!konfirmasi.isConfirmed) {
            return;
        }

        try {
            const url = "{{ url('ujianGuru/destroy') }}/" + id;
            const response = await fetch(url, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Accept": "application/json"
                }
            });

            const result = await response.json();

            if (result.success) {

                Swal.fire({
                    icon: "success",
                    title: result.title,
                    text: result.msg,
                    timer: 1500,
                    showConfirmButton: false
                });

                // Reload Tabulator
                tableQuiz.replaceData();

            } else {

                Swal.fire({
                    icon: "error",
                    title: result.title,
                    text: result.msg
                });

            }

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Terjadi kesalahan pada server."
            });

        }

    }
</script>
@endsection