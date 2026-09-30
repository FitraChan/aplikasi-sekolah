@extends('layout.main')

@section('tittle')
Calon Siswa
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Siswa Baru</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">
    <!-- Bagian Tombol Aksi -->
   

    <!-- Sistem Grid untuk membagi tabel menjadi sebelah-menyebelah -->
    <!-- md:grid-cols-3 artinya membagi halaman menjadi 3 kolom saat layar komputer/tablet -->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- Kolom Kiri: Tempat Table User (Kita beri porsi lebih besar, mengambil 2 kolom) -->
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> Daftar Siswa Baru</h2>

                </div>

                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div id="table-calon-siswa"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>


<div id="modal-set-nipd" class="modal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h2 class="font-medium text-base mr-auto">
                    Set NIPD Siswa
                </h2>

            </div>

            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                <input
                    type="hidden"
                    id="siswa-id">

                <div class="col-span-12">

                    <label class="form-label">
                        NIPD
                    </label>

                    <input
                        type="text"
                        id="nipd"
                        class="form-control"
                        placeholder="Masukkan NIPD siswa">

                    <div
                        id="error_set_nipd"
                        class="text-danger text-sm mt-2 hidden">
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    data-tw-dismiss="modal"
                    class="btn btn-outline-secondary w-24 mr-1">

                    Batal

                </button>

                <button
                    type="button"
                    id="btn-simpan-nipd"
                    onclick="saveNIPD()"
                    class="btn btn-primary w-24">

                    Simpan

                </button>

            </div>

        </div>

    </div>

</div>



<script>
    let table = new Tabulator("#table-calon-siswa", {

        ajaxURL: "{{ route('dataSiswaBaru') }}",


        layout: "fitDataStretch",
        height: "500px",
        pagination: true,

        paginationSize: 10,

        columns: [

            {
                    title: "No",
                    width: 70,
                    hozAlign: "center",
                    formatter: function(cell) {

                        let row = cell.getRow();
                        let table = row.getTable();

                        let page = table.getPage();
                        let size = table.getPageSize();

                        return ((page - 1) * size) + row.getPosition(true);
                    }
            },

            {
                title: "Nama Lengkap",
                field: "nama_lengkap",
                width: 250
            },

            {
                title: "No Daftar",
                field: "no_daftar",
                width: 150
            },

           

            {
                title: "Tahun",
                field: "tahun",
                width: 180
            },

            {
                title: "Jurusan",
                field: "nama_jurusan",
                width: 220
            },

            {
                title: "Gelombang",
                field: "nama_gelombang",
                width: 220
            },

            {
                title: "Action",
                hozAlign: "center",
                width: 150,


                formatter: function(cell) {
                    let data = cell.getData();

                    return `

                    <div class="flex gap-2">

                        <a href="{{ url('calon-siswa/edit') }}/${data.id}"
                            target="_blank"
                            class="btn btn-primary btn-sm">

                                Edit

                        </a>

                        <button
                            class="btn btn-danger btn-sm"

                            onclick='deleteData(${data.id})'>

                            Hapus

                        </button>

                         
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                onclick='setNIPD(${JSON.stringify(data)})'>
                                Set NIPD
                            </button>
                      
               
                    </div>

                `;
                }
            }
        ]
    });


    function openDaftarUlang(data) {
    //const row = table.getRow(id);

        console.log(data);    
        if (!data) {
            alert("Data calon siswa tidak ditemukan.");
            return;
        }

        //const data = get.getData();

        document.getElementById("id_cawa").value = data.id ?? "";
        document.getElementById("no_daftar").value = data.no_daftar ?? "";
        document.getElementById("nama").value = data.nama_lengkap ?? "";
        document.getElementById("id_jurusan").value = data.id_jurusan ?? "";

        const modalElement = document.querySelector("#modal-daftar-ulang");
        const modal = tailwind.Modal.getOrCreateInstance(modalElement);

        modal.show();
    }


    function editData(data) {
        document.getElementById('edit_id').value = data.id;
        document.getElementById('edit_nama_lengkap').value =
            data.nama_lengkap;
        document.getElementById('edit_jk').value =
            data.jk;

        document.getElementById('edit_nisn').value =
            data.nisn;

        document.getElementById('edit_no_hp').value =
            data.no_hp;

        document.getElementById('edit_id_jurusan').value =
            data.id_jurusan;

        document.getElementById('edit_id_gelombang').value =
            data.id_gelombang;
    }


    function saveData(type) {
        let prefix = type == 'add' ?
            'add_' :
            'edit_';

        let id = type == 'edit' ?
            document.getElementById('edit_id').value :
            '';

        let url = type == 'edit' ?
            "{{ url('calon-siswa/update') }}/" + id :
            "{{ url('calon-siswa/store') }}";

        fetch(url, {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({

                    nama_lengkap: document.getElementById(prefix + 'nama_lengkap').value,

                    jk: document.getElementById(prefix + 'jk').value,

                    nisn: document.getElementById(prefix + 'nisn').value,

                    no_hp: document.getElementById(prefix + 'no_hp').value,

                    id_jurusan: document.getElementById(prefix + 'id_jurusan').value,

                    id_gelombang: document.getElementById(prefix + 'id_gelombang').value,
                })

            })
            .then(res => res.json())
            .then(res => {

                table.replaceData();

            });
    }


    function deleteData(id) {
        if (confirm('Yakin hapus data?')) {
            fetch("{{ url('calon-siswa/delete') }}/" + id, {

                    method: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }

                })
                .then(res => res.json())
                .then(res => {

                    table.replaceData();

                });
        }
    }

    async function simpanDaftarUlang() {

        const btn = document.getElementById("btn-simpan-daftar-ulang");

        btn.disabled = true;
        btn.innerHTML = "Menyimpan...";

        try {

            const form = document.getElementById("form-daftar-ulang");

            const formData = new FormData(form);

            const response = await fetch(
                "{{ route('calon-siswa.save-daftar-ulang') }}",
                {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                    },
                    body: formData
                }
            );

            const result = await response.json();

            if (!response.ok || result.success === false) {

                alert(result.message);

                btn.disabled = false;
                btn.innerHTML = "Simpan";

                return;
            }

            alert(result.message);

            form.reset();

            table.replaceData();

            tailwind.Modal
                .getOrCreateInstance(
                    document.getElementById("modal-daftar-ulang")
                )
                .hide();

        } catch (err) {

            console.error(err);

            alert("Terjadi kesalahan.");

        } finally {

            btn.disabled = false;
            btn.innerHTML = "Simpan";

        }

    }


   function setNIPD(data) {
    document.getElementById('siswa-id').value = data.id;
    document.getElementById('nipd').value = data.nipd ?? '';

    const modalElement = document.querySelector('#modal-set-nipd');
    const modal = tailwind.Modal.getOrCreateInstance(modalElement);

    modal.show();

    setTimeout(() => {
        document.getElementById('nipd').focus();
    }, 300);
}
</script>

@endsection