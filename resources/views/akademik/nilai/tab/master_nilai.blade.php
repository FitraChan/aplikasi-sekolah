<div class="max-w-7xl mx-auto p-6">

    <div class="flex gap-2 mb-3">

        <button
            class="btn btn-success"
            onclick="saveGuru()">
            <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
            Save Guru

        </button>

    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">
                        Daftar Master Jadwal
                    </h2>

                </div>

                <div class="p-5">

                    <!-- FILTER -->
                    <div class="grid grid-cols-12 gap-4 mb-5">

                        <div class="col-span-12 md:col-span-3">

                            <label class="form-label">
                                Tahun Ajaran
                            </label>

                            <select
                                id="filter_thn"
                                class="form-select">

                                @foreach($tahun as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ $item->isaktiv == 1 ? 'selected' : '' }}>

                                    {{ $item->thn_ajaran }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-span-12 md:col-span-3">

                            <label class="form-label">
                                Angkatan
                            </label>

                            <select
                                id="filter_ang"
                                class="form-select">

                                <option value="">
                                    Semua Angkatan
                                </option>

                                @foreach($angkatan as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->id }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-span-12 md:col-span-3">

                            <label class="form-label">
                                Jurusan
                            </label>

                            <select
                                id="filter_jurusan"
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

                        <div class="col-span-12 md:col-span-3">

                            <label class="form-label">
                                Kelas
                            </label>

                            <select
                                id="filter_kelas"
                                class="form-select">

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $item)

                                <option value="{{ $item->id }}">
                                    {{ $item->nama_kelas }}
                                </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="flex gap-2 mb-5">

                        <button
                            class="btn btn-primary"
                            onclick="loadData()">

                            Cari

                        </button>

                        <button
                            class="btn btn-secondary"
                            onclick="resetFilter()">

                            Reset

                        </button>

                    </div>

                    <!-- TABLE -->
                    <div class="overflow-x-auto">

                        <div id="table-jadwal"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const guruOptions = @json(
        $guru-> pluck('nama_gtk', 'id')
    );
    let changedRows = [];

    let table = new Tabulator("#table-jadwal", {

        ajaxURL: "{{ route('nilai.data') }}",

        layout: "fitDataStretch",
        selectableRows: 1,
        pagination: true,

        paginationSize: 20,

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
                title: "Tahun",
                field: "tahun_ajaran",
                minWidth: 140
            },

            {
                title: "Semester",
                field: "semester",
                width: 100,
                hozAlign: "center",

                formatter: function(cell) {

                    let value = cell.getValue();

                    if (value == 1) {
                        return "Ganjil";
                    }

                    if (value == 0) {
                        return "Genap";
                    }

                    return "-";
                }
            },

            {
                title: "Kelas",
                field: "nama_kelas",
                minWidth: 50
            },

            {
                title: "Mapel",
                field: "nama_mapel",
                minWidth: 250
            },

            {
                title: "Guru",
                field: "id_gtk",

                width: 250,

                editor: "list",

                editorParams: {
                    values: guruOptions,
                    autocomplete: true,
                    listOnEmpty: true,
                    freetext: false
                },

                formatter: function(cell) {
                    return guruOptions[cell.getValue()] ?? "-";
                }
            },

            {
                title: "Jml Jam",
                field: "jml_jam",
                width: 100,
                hozAlign: "center"
            },

            {
                title: "Angkatan",
                field: "angkatan",
                width: 100,
                // hozAlign: "center"
            },



        ]

    });

    table.on("rowClick", function(e, row) {



        showDetail(
            
            row.getData()
        );


    });

    function showDetail(data) {

    document.getElementById('filter_mapel_pts').value = data.nama_mapel ?? '';
    document.getElementById('filter_guru_pts').value = data.nama_gtk ?? '';
    document.getElementById('filter_kelas_pts').value = data.nama_kelas ?? '';

    document.getElementById('filter_mapel_harian').value = data.nama_mapel ?? '';
    document.getElementById('filter_guru_harian').value = data.nama_gtk ?? '';
    document.getElementById('filter_kelas_harian').value = data.nama_kelas ?? '';

    document.getElementById('filter_mapel_detail').value = data.nama_mapel ?? '';
    document.getElementById('filter_guru_detail').value = data.nama_gtk ?? '';
    document.getElementById('filter_kelas_detail').value = data.nama_kelas ?? '';
    

        if (window.tableNilaiHarian) {
            window.tableNilaiHarian.setData(
                "{{ url('nilai/detail') }}/" + data.id
            );
        }

         if (window.tablePts) {
            window.tablePts.setData(
                "{{ url('nilai/detail') }}/" + data.id
            );
        }

         if (window.tableDetailNilai) {
            window.tableDetailNilai.setData(
                "{{ url('nilai/detail') }}/" + data.id
            );
        }
    }



    table.on("cellEdited", function(cell) {

        let data = cell.getRow().getData();

        let idx = changedRows.findIndex(
            x => x.id == data.id
        );

        if (idx === -1) {
            changedRows.push({
                ...data
            });
        } else {
            changedRows[idx] = {
                ...data
            };
        }

        //console.log(changedRows);
    });


    function loadData() {
        table.setData(
            "{{ route('nilai.data') }}", {
                thn: document.getElementById('filter_thn').value,
                ang: document.getElementById('filter_ang').value,
                jurusan: document.getElementById('filter_jurusan').value,
                kelas: document.getElementById('filter_kelas').value
            }
        );
    }


    function resetFilter() {
        document.getElementById('filter_ang').value = '';
        document.getElementById('filter_jurusan').value = '';
        document.getElementById('filter_kelas').value = '';

        loadData();
    }

    function saveGuru() {
        if (changedRows.length === 0) {
            alert('Tidak ada perubahan');

            return;
        }

        fetch("{{ route('master-jadwal.update-guru') }}", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    data: changedRows
                })

            })
            .then(res => res.json())
            .then(res => {

                alert(res.msg);

                changedRows = [];

                // table.replaceData();
            });
    }
</script>