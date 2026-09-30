@extends('layout.main')

@section('tittle')
Template Bayar
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Template Bayar</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Data Template Bayar
                    </h2>

                    <button
                        class="btn btn-primary"
                        data-tw-toggle="modal"
                        data-tw-target="#modal-form">

                        Tambah Data

                    </button>

                </div>

                <div class="p-5">

                    <div class="grid grid-cols-12 gap-3 mb-5">

                        {{-- Tahun Ajaran --}}
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                            <label class="form-label">Tahun Ajaran</label>

                            <select
                                id="filter-tahun"
                                class="form-select">

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
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                            <label class="form-label">Gelombang</label>

                            <select
                                id="filter-gelombang"
                                class="form-select">

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
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                            <label class="form-label">Jurusan</label>

                            <select
                                id="filter-jurusan"
                                class="form-select">

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

                        {{-- Tombol Cari --}}
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3 flex items-end">

                            <button
                                type="button"
                                id="btn-cari"
                                class="btn btn-primary w-full">

                                <i data-lucide="search" class="w-4 h-4 mr-2"></i>
                                Cari

                            </button>

                        </div>

                    </div>

                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div id="tableDataTemplateBayar"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto"> Data Detail Template Bayar</h2>
                    <div class="flex gap-2">
                        <button
                            type="button"
                            class="btn btn-dark"
                            onclick="setDefaultDetail()">
                            Set Default
                        </button>


                        <button
                            type="button"
                            class="btn btn-primary"
                            data-tw-toggle="modal"
                            data-tw-target="#modal-detail-form">

                            <i data-lucide="plus" class="w-4 h-4 mr-1"></i>
                            Tambah Detail

                        </button>
                    </div>
                </div>



                <div class="p-5" id="basic-table">
                    <div class="preview">
                        <div class="overflow-x-auto">
                            <div id="tableDetailDataTemplateBayar"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>

@include('keuangan.template_bayar.modal')
@include('keuangan.template_bayar.modal_detail')




<script>
    let table = new Tabulator("#tableDataTemplateBayar", {

        ajaxURL: "{{ route('template-bayar.data') }}",

        // layout: "fitColumns",

        layout: "fitDataStretch",

        height: "500px",
        width: "1000px",
        pagination: true,
        paginationMode: "local",
        paginationSize: 10,
        paginationSizeSelector: [10, 25, 50, 100],


        columns: [

            {
                title: "No",
                formatter: "rownum",
                hozAlign: "center",
                width: 60, // Sedikit diperkecil agar hemat ruang di kolom kanan
            },


            {
                title: "ID",
                field: "id"
            },


            {
                title: "Tahun",
                field: "tahun_ajaran.thn_ajaran"
            },



            {
                title: "Gelombang",
                field: "gelombang.nama_gelombang"
            },

            {
                title: "Jenis Kelas",
                field: "jns_kelas",

                formatter: function(cell) {

                    return cell.getValue() == 1 ?
                        'Reguler' :
                        'Karyawan';
                }
            },

            {
                title: "Jurusan",
                field: "jurusan.nama_jurusan"
            },

            {
                title: "Status",
                field: "sts",

                formatter: function(cell) {

                    return cell.getValue() == 1 ?
                        'Aktif' :
                        'Tidak Aktif';
                }
            },

            {
                title: "Aksi",
                width: 300,
                minWidth: 300,
                hozAlign: "left",
                headerSort: false,
                formatter: function(cell) {

                    let row = cell.getData();

                    return `

                     <a href="javascript:;"
                        data-tw-toggle="modal"
                        data-tw-target="#modal-form"
                        onclick='editTemplateBayar(${JSON.stringify(row)})'
                        class="btn btn-primary">

                        <i data-lucide="hard-drive" class="w-4 h-4 mr-2"></i> Edit

                    </a>

                    <button
                        onclick="deleteTemplateBayar(${row.id})"
                        class="btn btn-danger">

                      <i data-lucide="trash" class="w-4 h-4 mr-2"></i>   Hapus

                    </button>
                   

                     
                `;
                }
            }
        ]
    });
    let currentTemplateId = 0;
    table.on("rowClick", function(e, row) {
        showDetail(row.getData().id);
    });

    document
    .getElementById('btn-cari')
    .addEventListener('click', function () {

        table.setData(
            "{{ route('template-bayar.data') }}",
            {
                id_thn_ajaran: document.getElementById('filter-tahun').value,
                id_gelombang: document.getElementById('filter-gelombang').value,
                id_jurusan: document.getElementById('filter-jurusan').value
            }
        );

    });

    function setDefaultDetail() {

        if (!currentTemplateId) {
            alert('Pilih Template Bayar terlebih dahulu');
            return;
        }

        if (!confirm('Set detail pembayaran ke nilai default?')) {
            return;
        }

        fetch("{{ url('template-bayar/set-default') }}/" + currentTemplateId, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(response => response.json())
            .then(response => {

                tableDetail.setData(
                    "{{ url('template-bayar/detail') }}/" + currentTemplateId
                );

                // toastr.success(response.msg);

            })
            .catch(error => {

                console.error(error);

                //toastr.error('Terjadi kesalahan');

            });
    }

    var tableDetail = new Tabulator("#tableDetailDataTemplateBayar", {
        layout: "fitDataStretch",
        ajaxContentType: "json",
        height: "500px",

        columns: [{
                title: "Item",
                field: "nama_item"
            },
            {
                title: "Kategori",
                field: "kategori"
            },
            {
                title: "Jumlah Bayar",
                field: "jml_bayar",
                hozAlign: "right",

                formatter: function(cell) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(cell.getValue() || 0);
                }
            },
            {
                title: "Keterangan",
                field: "ket_bayar"
            },
            {
                title: "Aksi",
                width: 300,
                minWidth: 300,
                hozAlign: "left",
                headerSort: false,

                formatter: function(cell) {

                    let row = cell.getData();

                    return `
                    <button
                        class="btn btn-primary btn-sm"
                        onclick='editDetail(${JSON.stringify(row)})'>

                        <i data-lucide="pencil"></i>
                        Edit

                    </button>

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="deleteDetail(${row.id})">

                        <i data-lucide="trash"></i>
                        Hapus

                    </button>
                `;
                }
            }
        ]
    });



    function showDetail(idTemplate) {
        currentTemplateId = idTemplate;
        tableDetail.setData(
            "{{ url('template-bayar/detail') }}/" + idTemplate
        );

    }

    function saveData() {
        const id = document.getElementById('id').value;
        const isEdit = id !== '';

        const tipeJurusan = document
            .getElementById('tipe_jurusan')
            .value;

        const idJurusan = tipeJurusan === 'semua' ?
            null :
            document.getElementById('id_jurusan').value;

        const url = isEdit ?
            "{{ url('template-bayar/update') }}/" + id :
            "{{ url('template-bayar/store') }}";

        fetch(url, {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({
                    id_tahun: document.getElementById('id_tahun').value,

                    tipe_jurusan: tipeJurusan,

                    id_jurusan: idJurusan,

                    id_gelombang: document
                        .getElementById('id_gelombang')
                        .value,

                    jns_kelas: document
                        .getElementById('jns_kelas')
                        .value,

                    keterangan: document
                        .getElementById('keterangan')
                        .value,

                    sts: document
                        .getElementById('sts')
                        .value
                })
            })
            .then(async response => {
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(
                        result.message ?? 'Data gagal disimpan.'
                    );
                }

                return result;
            })
            .then(result => {
                const modal = tailwind.Modal.getOrCreateInstance(
                    document.querySelector("#modal-form")
                );

                modal.hide();

                table.replaceData();

                alert(result.message ?? 'Data berhasil disimpan.');
            })
            .catch(error => {
                console.error(error);

                alert(error.message);
            });
    }

    function editTemplateBayar(data) {
        document.getElementById('id').value =
            data.id ?? '';

        document.getElementById('id_tahun').value =
            data.id_tahun ?? '';

        document.getElementById('id_jurusan').value =
            data.id_jurusan ?? '';

        document.getElementById('id_gelombang').value =
            data.id_gelombang ?? '';

        document.getElementById('jns_kelas').value =
            data.jns_kelas ?? '';

        document.getElementById('keterangan').value =
            data.keterangan ?? '';

        document.getElementById('sts').value =
            data.sts ?? 1;
    }

    function deleteTemplateBayar(id) {
        if (confirm('Hapus data?')) {

            fetch(
                    "{{ url('template-bayar/delete') }}/" + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                )
                .then(res => res.json())
                .then(res => {
                    table.replaceData();
                    alert('Berhasil dihapus');
                })
                .catch(err => {
                    console.log(err);
                    alert('Gagal menghapus data');
                });
        }
    }


    function saveDetail() {

        let idDetail = document.getElementById('id_detail').value;

        let url = idDetail ?
            "{{ url('template-bayar-detail/updateDetail') }}/" + idDetail :
            "{{ route('template-bayar-detail.storeDetail') }}";

        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    id_template: currentTemplateId,
                    id_item: document.getElementById('id_item').value,
                    jml_bayar: document.getElementById('jml_bayar').value,
                    ket_bayar: document.getElementById('ket_bayar').value
                })
            })
            .then(response => response.json())
            .then(response => {

                const modal = tailwind.Modal.getOrCreateInstance(
                    document.querySelector("#modal-detail-form")
                );

                modal.hide();

                // reset form
                document.getElementById('id_detail').value = '';
                document.getElementById('id_item').value = '';
                document.getElementById('jml_bayar').value = '';
                document.getElementById('ket_bayar').value = '';

                tableDetail.setData(
                    "{{ url('template-bayar/detail') }}/" + currentTemplateId
                );

                toastr.success(response.msg);

            })
            .catch(error => {
                console.error(error);
                toastr.error('Terjadi kesalahan');
            });
    }

    function editDetail(row) {

        document.getElementById('id_detail').value = row.id;
        document.getElementById('id_item').value = row.id_item;
        document.getElementById('jml_bayar').value = row.jml_bayar;
        document.getElementById('ket_bayar').value = row.ket_bayar ?? '';

        const modal = tailwind.Modal.getOrCreateInstance(
            document.querySelector("#modal-detail-form")
        );

        modal.show();
    }

    function deleteDetail(id) {

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        fetch("{{ url('template-bayar-detail/deleteDetail') }}/" + id, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(response => response.json())
            .then(response => {

                tableDetail.setData(
                    "{{ url('template-bayar/detail') }}/" + currentTemplateId
                );


            })
            .catch(error => {

                console.error(error);


            });
    }
</script>

@endsection