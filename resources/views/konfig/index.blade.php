@extends('layout.main')

@section('tittle')
Konfigurasi Sistem
@endsection

@section('top-nav')

<ol class="breadcrumb">
    <li class="breadcrumb-item">Konfigurasi Sistem</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">




<div class="grid grid-cols-12 gap-6 mt-5">

    <div class="intro-y col-span-12">

        <div class="intro-y box">

            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                <h2 class="font-medium text-base mr-auto">
                    Data Konfigurasi
                </h2>

            </div>

            <div class="p-5">

                <div class="overflow-x-auto">

                    <div id="table-konfig"></div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>


@include('konfig.edit-konfig')

<script>

let table = new Tabulator("#table-konfig", {

    ajaxURL: "{{ route('konfig.data') }}",

    layout: "fitColumns",

    pagination: true,

    paginationSize: 10,

    responsiveLayout: "collapse",

    columns: [

        {
            title: "No",
            formatter: "rownum",
            hozAlign: "center",
            width: 60
        },

        {
            title: "ID Tahun",
            field: "id_tahun",
           
        },

        {
            title: "ID Gelombang",
            field: "id_gelombang",
            
        },

        {
            title: "Semester",
            field: "smt",
            
        },

        {
            title: "ID Tahun PPDB",
            field: "id_thn_ppdb",
           
        },

        {
            title: "Action",
            hozAlign: "center",
            width: 220,

            formatter: function(cell) {

                let data = cell.getData();

                return `
                    <button
                        class="btn btn-primary btn-sm mr-1"
                        data-tw-toggle="modal"
                        data-tw-target="#modal-edit-konfig"
                        onclick='editKonfig(${JSON.stringify(data)})'>

                        Edit

                    </button>

                   
                `;
            }
        }
    ]
});


function editKonfig(data)
{

console.log(data);

    document.getElementById('edit_id').value =
        data.id ?? '';

    document.getElementById('edit_id_tahun').value =
        data.id_tahun ?? '';

    document.getElementById('edit_id_gelombang').value =
        data.id_gelombang ?? '';

    document.getElementById('edit_smt').value =
        data.smt ?? 1;

    document.getElementById('edit_id_thn_ppdb').value =
        data.id_thn_ppdb ?? '';
}


function saveData()
{
    console.log('masuk cuy');
    
    let id = document.getElementById('edit_id').value;

    let isEdit = id !== '';

    let prefix = isEdit ? 'edit_' : 'add_';

    let url = isEdit
        ? "{{ url('konfig/update') }}/" + id
        : "{{ url('konfig/store') }}";

    fetch(url, {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN': '{{ csrf_token() }}'

        },

        body: JSON.stringify({

            id_tahun:
                document.getElementById(prefix + 'id_tahun').value,

            id_gelombang:
                document.getElementById(prefix + 'id_gelombang').value,

            smt:
                document.getElementById(prefix + 'smt').value,

            id_thn_ppdb:
                document.getElementById(prefix + 'id_thn_ppdb').value

        })

    })
    .then(res => res.json())
    .then(res => {

        if(res.success)
        {
            const modal = isEdit
                ? tailwind.Modal.getOrCreateInstance(
                    document.querySelector("#modal-edit-konfig")
                  )
                : tailwind.Modal.getOrCreateInstance(
                    document.querySelector("#modal-add-konfig")
                  );

            modal.hide();

            table.replaceData();

            alert('Data berhasil disimpan');
        }
        else
        {
            alert('Gagal menyimpan data');
        }

    })
    .catch(err => {

        console.error(err);

        alert('Terjadi kesalahan');

    });
}


function deleteKonfig(id)
{
    if(confirm('Yakin ingin menghapus data ini ?'))
    {
        fetch("{{ url('konfig/delete') }}/" + id, {

            method: 'DELETE',

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}'

            }

        })
        .then(res => res.json())
        .then(res => {

            if(res.success)
            {
                table.replaceData();

                alert('Data berhasil dihapus');
            }

        })
        .catch(err => {

            console.error(err);

            alert('Gagal menghapus data');

        });
    }
}

</script>

@endsection
