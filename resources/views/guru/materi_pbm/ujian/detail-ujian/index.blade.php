@extends('layout.main')

@section('tittle')
Detail Ujian
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Ujian</li>
</ol>
@endsection

@section('body')
<div class="max-w-7xl mx-auto p-6">

    <div class="intro-y box p-5">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between border-b pb-4 mb-5">

            <div>
                  <div class="flex items-center">
                    <i data-lucide="graduation-cap" class="w-6 h-6 mr-2 text-primary"></i>

                    <h2 class="text-lg font-medium">
                        {{ $ujian->judul }}
                    </h2>
                </div>

                <div class="text-slate-500 mt-1">
                    Total Soal :
                    <span class="font-medium">{{ count($soals) }}</span>
                </div>
            </div>

            <div class="flex gap-2 mt-4 lg:mt-0 ml-auto">

                <button class="btn btn-primary" id="btn-update-quiz">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Update Ujian
                </button>

                <button
                    type="button"
                    class="btn btn-warning"
                    onclick="tambahSoal()">
                    <i data-lucide="plus-circle" class="w-4 h-4 mr-2"></i>
                    Soal Baru
                </button>

            </div>

        </div>

        <form id="frm-ujian">

            @csrf

            <input type="hidden" name="id" value="{{ $ujian->id }}">

            <div class="grid grid-cols-12 gap-5">

                <div class="col-span-12 lg:col-span-4">
                    <label class="form-label">Nama Ujian</label>
                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="{{ $ujian->judul }}">
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <label class="form-label">Tanggal Ujian</label>
                    <input
                        type="date"
                        name="tgl_quiz"
                        class="form-control"
                        value="{{ \Carbon\Carbon::parse($ujian->tgl_quiz)->format('Y-m-d') }}">
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <label class="form-label">Jumlah Soal</label>
                    <input
                        type="number"
                        class="form-control"
                        name="jumlah"
                        value="{{ count($soals) }}">
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <label class="form-label">Mulai Ujian</label>
                    <input
                        type="datetime-local"
                        name="tgl_mulai"
                        class="form-control"
                        value="{{ \Carbon\Carbon::parse($ujian->tgl_mulai)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <label class="form-label">Selesai Ujian</label>
                    <input
                        type="datetime-local"
                        name="tgl_selesai"
                        class="form-control"
                        value="{{ \Carbon\Carbon::parse($ujian->tgl_selesai)->format('Y-m-d\TH:i') }}">
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <label class="form-label">Durasi (Menit)</label>
                    <input
                        type="number"
                        class="form-control"
                        name="durasi"
                        value="{{ $ujian->durasi }}">
                </div>

                <div class="col-span-12">
                    <label class="form-label">Petunjuk Soal</label>

                    <textarea
                        rows="5"
                        name="deskripsi"
                        class="form-control">{{ $ujian->deskripsi }}</textarea>
                </div>

            </div>

        </form>

    </div>

</div>
<br />
<div class="max-w-7xl mx-auto p-6">


    <ul class="nav nav-boxed-tabs" role="tablist">

        <!-- Soal Ujian -->
        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2 active"
                data-tw-toggle="pill"
                data-tw-target="#soal-ujian"
                type="button"
                role="tab"
                aria-controls="soal-ujian"
                aria-selected="true">
                Soal Ujian
            </button>
        </li>

        <!-- Bank Soal -->
        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#bank-soal"
                type="button"
                role="tab"
                aria-controls="bank-soal"
                aria-selected="false">
                Bank Soal
            </button>
        </li>

        <!-- Jawaban Siswa -->
        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#jawaban-siswa"
                type="button"
                role="tab"
                aria-controls="jawaban-siswa"
                aria-selected="false">
                Jawaban Siswa
            </button>
        </li>

    </ul>

    <div class="tab-content mt-5">

        <!-- Soal Ujian -->
        <div
            id="soal-ujian"
            class="tab-pane leading-relaxed active"
            role="tabpanel">

            @include('guru.materi_pbm.ujian.detail-ujian.soal-ujian')


        </div>

        <!-- Bank Soal -->
        <div
            id="bank-soal"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('guru.materi_pbm.ujian.detail-ujian.bank-soal')

        </div>

        <!-- Jawaban Siswa -->
        <div
            id="jawaban-siswa"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('guru.materi_pbm.ujian.detail-ujian.jawaban')


        </div>

    </div>

</div>

 @include('guru.materi_pbm.ujian.detail-ujian.modal.edit-modal')
<script>

    CKEDITOR.replace('e_editor', {
    filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
    filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
        filebrowserUploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}",
    filebrowserUploadMethod: 'form',
        removePlugins: 'easyimage,cloudservices'

});

document.getElementById("formEditSoal").addEventListener("submit", async function (e) {

    e.preventDefault();

    // Sinkronkan isi CKEditor ke textarea
    for (let instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    const form = this;
    const formData = new FormData(form);

    const btnSubmit = form.querySelector('button[type="submit"]');
    btnSubmit.disabled = true;

    try {

        const mode = document.getElementById("form_mode").value;

       const url = mode === "add"
            ? "{{ url('pbm/storeSoal/'.$ujian->id) }}"
            : "{{ url('pbm/updateSoal') }}";

    const method = mode === "add"
    ? "GET"
    : "POST";

        const response = await fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json"
            },
            body: formData
        })

        const res = await response.json();

        btnSubmit.disabled = false;

        if (response.ok && res.success) {

             Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: res.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });


            tailwind.Modal.getOrCreateInstance(
                document.getElementById("modal-add-ujian")
            ).hide();


            // Reset form
            form.reset();

            document.getElementById("form_mode").value = "add";
            document.getElementById("e_id").value = "";

            // Reset CKEditor
            CKEDITOR.instances.e_editor.setData("");

            // Reset preview gambar
            const preview = document.getElementById("preview_soal");
            preview.src = "";
            preview.classList.add("hidden");

        } else {

             Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: res.message || 'Gagal menyimpan data'
            });

        }

    } catch (error) {

        btnSubmit.disabled = false;

        console.error(error);

         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan pada server.'
        });


    }

});

async function tambahSoal() {

    document.getElementById("form_mode").value = "add";

    const form = document.getElementById("formEditSoal");
  //  form.reset();

    document.getElementById("e_id").value = "";

    document.querySelector("#modal-add-ujian .modal-header h2").innerHTML =
        "Tambah Soal";

    CKEDITOR.instances.e_editor.setData("");

    document.getElementById("preview_soal").src = "";
    document.getElementById("preview_soal").classList.add("hidden");

    try {

        const response = await fetch("{{ url('pbm/dataMasterSoal') }}");

        if (!response.ok) {
            throw new Error("Gagal mengambil data.");
        }

        const res = await response.json();

        // ==========================
        // Jenis Soal
        // ==========================
        const jenis = document.getElementById("e_jenis_soal_id");
        jenis.innerHTML = '<option value="">Pilih Jenis Soal</option>';

        res.jenis_soal.forEach(item => {
            jenis.innerHTML += `
                <option value="${item.id}">
                    ${item.jenis_soal}
                </option>
            `;
        });

        // ==========================
        // Mapel
        // ==========================
        const mapel = document.getElementById("e_mapel_id");
        mapel.innerHTML = '<option value="">Pilih Mata Pelajaran</option>';

        res.mapel.forEach(item => {
            mapel.innerHTML += `
                <option value="${item.id_mapel}">
                    ${item.mapel.nama_mapel}
                </option>
            `;
        });

        tailwind.Modal.getOrCreateInstance(
            document.getElementById("modal-add-ujian")
        ).show();

    } catch (err) {

        console.error(err);

        console.log(err);
        

        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "Tidak dapat mengambil data master."
        });

    }

}
</script>
@endsection