<div class="max-w-7xl mx-auto p-6">

    <div class="intro-y col-span-11 alert alert-secondary alert-dismissible show flex items-center mb-6" role="alert">
        <span><i data-lucide="info" class="w-4 h-4 mr-2"></i></span>
        <span>
            <h2 class="font-semibold text-lg"> <?= 'Mata Pelajaran  ' . $master->mapel->nama_mapel; ?> </h2>
        </span>
        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close">
    </div>

    <div class="intro-y box">

    <div class="p-5 border-b flex flex-col md:flex-row md:items-center gap-3">

    <h2 class="font-semibold text-lg">
        Kelas {{ $master->nkelas }}
        {{ $master->kelas->nama_kelas }}
    </h2>

   <div class="md:ml-auto text-right">
    <a href="{{ route('pbm.tambahMateri', $id) }}"
       class="btn btn-primary shadow-md">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Materi
    </a>
</div>

</div>

        <div class="p-5">
<div class="overflow-x-auto">
    <div id="table-materi"></div>
</div>

        </div>

    </div>

</div>


<script>
    let table = new Tabulator("#table-materi", {

        data: @json($isi),

        layout: "fitDataStretch",
          responsiveLayout: false,


       
        pagination: true,

        paginationSize: 10,

       

        columns: [

            {
                title: "Pertemuan",
                field: "idpertemuan",
                width: 110,
                hozAlign: "center"
            },

            {
                title: "Tanggal",
                field: "tgl",
                width: 120,
                hozAlign: "center"
            },

            {
                title: "Materi",
                field: "judul_materi",
                widthGrow: 2
            },

            {
                title: "Guru Pengganti",
                field: "nama_guru_pengganti",
                width: 180
            },

            {
                title: "Tugas",
                field: "judul_tugas",
                widthGrow: 2
            },

           

            {
                title: "H",
                field: "H",
                width: 70,

            },

            {
                title: "I",
                field: "I",
                width: 70,

            },

            {
                title: "S",
                field: "S",
                width: 70,

            },

            {
                title: "A",
                field: "A",
                width: 70,

            },

            {
                title: "Action",
                width: 180,


                formatter: function(cell) {

                    let data = cell.getData();

                    let urlAbsensi = "{{ url('pbm/dataAbsen') }}/" + data.id;

                    let urlEdit = "{{ url('pbm/editMateri') }}/" + data.id;

                    return `
                    <a href="${urlAbsensi}"
                        class="btn btn-primary btn-sm mr-1">
                        Absen
                    </a>

                    <a href="${urlEdit}"
                        class="btn btn-success btn-sm">
                        Edit
                    </a>

                      <button
                        class="btn btn-danger btn-sm"
                        onclick="hapusMateri(${data.id})">
                        Hapus
                    </button>
                `;
                }
            }

        ]

    });

        function hapusMateri(id) {

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        fetch(`{{ url('pbm/hapusMateri') }}/${id}`, {            
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]'
                ).getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(res => {

            if (res.success) {

                alert(res.msg);

                location.reload();

            } else {

                alert(res.msg);
            }

        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan');
        });

    }
</script>