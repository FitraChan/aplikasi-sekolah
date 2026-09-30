@extends('layout.main')

@section('tittle')
Penilaian Guru
@endsection

@section('top-nav')

<ol class="breadcrumb">
    <li class="breadcrumb-item">PBM / Jadwal Guru</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

   <div class="intro-y col-span-11 alert alert-primary alert-dismissible show flex items-center mb-6" role="alert">
                        <span><i data-lucide="info" class="w-4 h-4 mr-2"></i></span>
                        <span><p> <?= 'Mata Pelajaran Tahun ' . $thn . '/' . ($thn + 1); ?> </p></span>
                        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> 
                    </div>

<div class="grid grid-cols-12 gap-6 mt-5">

    <div class="intro-y col-span-12">

        <div class="intro-y box">

            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                <h2 class="font-medium text-base mr-auto">
                  
						<p class="text-18"><?= 'Semester ' . $smt; ?>
                </h2>

            </div>

            <div class="p-5">

                <div class="overflow-x-auto">

                    <div id="table-jadwal"></div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<script>

let table = new Tabulator("#table-jadwal", {

    ajaxURL: "{{ route('pbm.data') }}",

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
            title: "Mata Pelajaran",
            field: "nama_mapel"
        },

        {
            title: "Kelas",
            field: "nama_kelas",
            // width: 100,
            formatter: function(cell){
                let data = cell.getData();
                return data.kelas + " " + data.nama_kelas;
            }
        },

        // {
        //     title: "Jml Jam",
        //     field: "jml_jam",
        //     //hozAlign: "center",
        //   //  width: 100
        // },

       

        {
            title: "Action",
           // hozAlign: "center",
         //   width: 260,

            formatter: function(cell) {

                let data = cell.getData();

                return `
                    <a href="{{ url('pbm/dataMateri') }}/${data.id}" class="btn btn-primary btn-sm mr-1">
                       Jadwal PBM
                    </a>

                   

                    <a href="{{ url('pbm/nilai') }}/${data.id}" class="btn btn-warning btn-sm">
                        Nilai Akhir
                    </a>
                `;
            }
        }
    ]
});

</script>

@endsection
