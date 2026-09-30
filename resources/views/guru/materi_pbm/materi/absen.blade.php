@extends('layout.main')

@section('tittle')
Materi PBM
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">PBM</li>
    <li class="breadcrumb-item">Materi</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <div
        class="intro-y col-span-12 alert alert-success alert-dismissible show flex items-center mb-6"
        role="alert">

        <span>
            <i data-lucide="info" class="w-4 h-4 mr-2"></i>
        </span>

        <span>
            Mata Pelajaran :
            <strong>
                {{ $master->jadwal->mapel->nama_mapel ?? '-' }}
            </strong>
        </span>

        <button
            type="button"
            class="btn-close text-white"
            data-tw-dismiss="alert"
            aria-label="Close">
        </button>

    </div>

    <div class="intro-y box">

        <div class="p-5 border-b flex items-start">

            <div>
                <h2 class="font-semibold text-lg">
                    Kelas
                    {{ $master->jadwal->nkelas ?? '' }}
                    {{ $master->jadwal->kelas->nama_kelas ?? '' }}
                </h2>

                <div class="mt-2 text-slate-500">
                    Pertemuan Ke:
                    <strong>{{ $master->idpertemuan }}</strong>

                    <span class="mx-2">|</span>

                    Tanggal :
                    <strong>
                        {{ $master->tgl ? \Carbon\Carbon::parse($master->tgl)->format('d-m-Y') : '-' }}
                    </strong>
                </div>
            </div>

       <div class="ml-auto">                
               <button
                    type="button"
                    class="btn btn-primary"
                    onclick="simpanAbsensi()">

                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan

                </button>
            </div>

        </div>



        <div class="p-5">

            <div class="overflow-x-auto">
                <div id="tableAbsensi"></div>
            </div>

        </div>

    </div>

</div>

<script>
    const tableAbsensi = new Tabulator("#tableAbsensi", {
        layout: "fitDataStretch",
        data: @json($isi),
        selectableRows: 1,
        columns: [{
                title: "No",
                formatter: "rownum",
                width: 60,
                hozAlign: "center",
            },
            {
                title: "NIPD",
                field: "nipd",
                width: 100,
            },
            {
                title: "Nama Siswa",
                field: "nama_siswa",
                minWidth: 150,
            },
            
            {
                title: "Status",
                field: "sts_hadir",
                width: 100,
                editor: "list",
                editorParams: {
                    values: [{
                            label: "Hadir",
                            value: "H"
                        },
                        {
                            label: "Izin",
                            value: "I"
                        },
                        {
                            label: "Sakit",
                            value: "S"
                        },
                        {
                            label: "Alfa",
                            value: "A"
                        }
                    ]
                }
            },
            {
                title: "Keterangan",
                field: "ket_hadir",
                minWidth: 200,
            },
        ],
    });

    function simpanAbsensi() {

    // ambil semua data dari tabulator
        const data = tableAbsensi.getData();

        console.log('data',data);
        

        // ambil hanya field penting
        const payload = data.map(row => ({
            id: row.id,
            sts_hadir: row.sts_hadir,
            ket_hadir: row.ket_hadir
        }));

        fetch("{{ url('/absensi/simpanDetailAbsensi') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                data: payload
            })
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                alert("Absensi berhasil disimpan");

                if (window.tableRekap) {
                    window.tableRekap.replaceData();
                }

            } else {
                alert("Gagal: " + data.msg);

                console.log(data);
                
            }

        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan server");
        });
    }
</script>

@endsection