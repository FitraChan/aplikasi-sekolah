<div class="max-w-7xl mx-auto p-6">
   
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                    <h2 class="font-medium text-base mr-auto">
                        Daftar Jadwal
                    </h2>
                </div>

                <div class="p-5">

                    <div class="overflow-x-auto">

                        <div class="flex flex-wrap gap-3 mb-4">

                            <select id="filter_tahun" class="form-select w-56">
                                <option value="">Semua Tahun Ajaran</option>

                                @foreach($tahun as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->thn_ajaran }}
                                </option>
                                @endforeach
                            </select>

                            <select id="filter_jurusan" class="form-select w-56">
                                <option value="">Semua Jurusan</option>

                                @foreach($jurusan as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->nama_jurusan }}
                                </option>
                                @endforeach
                            </select>

                            <select id="filter_kelas" class="form-select w-56">
                                <option value="">Semua Kelas</option>
                                @foreach($kelas as $item)
                                <option value="{{ $item->idx }}">
                                    {{ $item->nama_kelas }}
                                </option>
                                @endforeach
                            </select>

                            <select
                                id="filter_semester"
                                class="form-select w-56">

                                <option value="">
                                    Pilih Semester
                                </option>

                                <option value="1">
                                    Ganjil
                                </option>

                                <option value="0">
                                    Genap
                                </option>

                            </select>

                            <select id="filter_angkatan" class="form-select w-56">
                                <option value="">Angkatan</option>

                                @foreach($tahun as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->thn_ajaran }}
                                </option>
                                @endforeach
                            </select>

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

                        <div id="table-jadwal"></div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const guruOptions = @json(
        $guru->pluck('nama_gtk', 'id')
    );

    let changedRows = [];

    let table = new Tabulator("#table-jadwal", {

        ajaxURL: "{{ route('master-jadwal.data') }}",

        layout: "fitDataStretch",
        ajaxParams: {},

        pagination: true,

        paginationSize: 10,
        selectableRows: 1,



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
                title: "Tahun Ajaran",
                field: "tahun_ajaran",
                width: 180
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

            // {
            //     title: "Kelas",
            //     field: "nama_kelas",
            //     width: 180
            // },

            {
                title: "Mapel",
                field: "nama_mapel",
                width: 250
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
                width: 120,
                hozAlign: "center"
            },

            {
                title: "Action",
                hozAlign: "center",
                width: 180,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `
                    <button
                        class="btn btn-primary btn-sm"
                        data-tw-toggle="modal"
                        data-tw-target="#modal-edit-jadwal"
                        onclick='editJadwal(${JSON.stringify(data)})'>

                        Edit

                    </button>

                    <button
                        onclick="deleteJadwal(${data.id})"
                        class="btn btn-danger btn-sm">

                        Hapus

                    </button>
                `;
                }
            }
        ]
    });

      table.on("rowClick", function(e, row) {



        showDetail(
            
            row.getData()
        );


    });

      function showDetail(data) {

       // console.log(data);

         if (window.tableRekap) {
            window.tableRekap.setData(
                "{{ url('absensi/dataAbsensi') }}/" + data.id
            );


                document.getElementById('id_jadwal').value = data.id;

                document.getElementById('filter_mapel_detail').value = data.nama_mapel;
                document.getElementById('filter_guru_detail').value = data.nama_gtk;
                document.getElementById('filter_kelas_detail').value = data.nama_kelas;


        }


      }

    function loadData() {
        table.setData(
            "{{ route('master-jadwal.data') }}", {
                id_tahun: document.getElementById('filter_tahun').value,
                id_jurusan: document.getElementById('filter_jurusan').value,
                id_kelas: document.getElementById('filter_kelas').value
            }
        );
    }

    function resetFilter() {
        document.getElementById('filter_tahun').value = '';
        document.getElementById('filter_jurusan').value = '';
        document.getElementById('filter_kelas').value = '';

        loadData();
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


    function editJadwal(data) {
        document.getElementById('edit_id').value =
            data.id ?? '';

        document.getElementById('edit_id_tahun').value =
            data.id_tahun ?? '';

        document.getElementById('edit_semester').value =
            data.semester ?? '';

        document.getElementById('edit_id_kelas').value =
            data.id_kelas ?? '';

        document.getElementById('edit_id_mapel')
            .tomselect
            .setValue(data.id_mapel ?? '');

        document.getElementById('edit_id_gtk').value =
            data.id_gtk ?? '';

        document.getElementById('edit_jml_jam').value =
            data.jml_jam ?? '';


    }


    function saveData() {
        let id = document.getElementById('edit_id').value;

        let isEdit = id != '';

        let prefix = isEdit ? 'edit_' : 'add_';

        let url = isEdit ?
            "{{ url('master-jadwal/update') }}/" + id :
            "{{ url('master-jadwal/store') }}";

        fetch(url, {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json',

                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({

                    id_tahun: document.getElementById(prefix + 'id_tahun').value ?? '',

                    semester: document.getElementById(prefix + 'semester').value ?? '',

                    id_kelas: document.getElementById(prefix + 'id_kelas').value ?? '',

                    id_mapel: document.getElementById(prefix + 'id_mapel').value ?? '',

                    id_gtk: document.getElementById(prefix + 'id_gtk').value ?? '',

                    jml_jam: document.getElementById(prefix + 'jml_jam').value ?? '',



                })

            })
            .then(res => res.json())
            .then(res => {

                const modal = isEdit ?
                    tailwind.Modal.getOrCreateInstance(
                        document.querySelector("#modal-edit-jadwal")
                    ) :
                    tailwind.Modal.getOrCreateInstance(
                        document.querySelector("#modal-add-jadwal")
                    );

                modal.hide();

                 table.replaceData();

            });
    }


    function deleteJadwal(id) {
        if (confirm('Hapus data ?')) {
            fetch("{{ url('master-jadwal/delete') }}/" + id, {

                    method: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }

                })
                .then(res => res.json())
                .then(res => {

                    table.replaceData();

                    alert('Data berhasil dihapus');

                });
        }
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

   async function inisialisasiJadwal()
{
    let thn = document.getElementById('filter_tahun').value;
    let smt = document.getElementById('filter_semester').value;
    let jurusan = document.getElementById('filter_jurusan').value;

    if(thn === '')
    {
        alert('Tahun Ajaran harus dipilih');
        return;
    }

    if(smt === '')
    {
        alert('Semester harus dipilih');
        return;
    }

    if(jurusan === '')
    {
        alert('Jurusan harus dipilih');
        return;
    }

    if(
        !confirm(
            'Apakah Anda yakin akan melakukan inisialisasi data?\n\n' +
            'Data jadwal yang sudah ada pada Tahun Ajaran, Semester, dan Jurusan yang dipilih akan dihapus dan dibuat ulang.'
        )
    )
    {
        return;
    }

    try {

        const response = await fetch(
            "{{ route('master-jadwal.inisialisasi') }}",
            {
                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    thn: thn,
                    smt: smt,
                    ang: thn,
                    jurusan: jurusan
                })
            }
        );

        const res = await response.json();

        alert(res.msg);

        if(res.success)
        {
            table.replaceData();
        }

    } catch (e) {

        console.error(e);

        alert('Gagal melakukan inisialisasi');
    }
}

async function isiNilai()
{
    let thn      = document.getElementById('filter_tahun').value;
    let smt      = document.getElementById('filter_semester').value;
    let jurusan  = document.getElementById('filter_jurusan').value;
    let kelas    = document.getElementById('filter_kelas').value;
    let angkatan = document.getElementById('filter_angkatan').value;

    let errors = [];

    if(!thn)
    {
        errors.push('Tahun Ajaran');
    }

    if(!smt)
    {
        errors.push('Semester');
    }

    if(!angkatan)
    {
        errors.push('Angkatan');
    }

    if(!jurusan && !kelas)
    {
        errors.push('Jurusan atau Kelas');
    }

    if(errors.length > 0)
    {
        alert(
            'Field berikut wajib dipilih:\n\n- ' +
            errors.join('\n- ')
        );

        return;
    }

    if(
        !confirm(
            'Apakah Anda yakin akan melakukan proses Isi Nilai?\n\n' +
            'Data nilai yang sudah ada akan dihapus dan dibuat ulang.'
        )
    )
    {
        return;
    }

    try {

        const response = await fetch(
            "{{ route('master-jadwal.isi-nilai') }}",
            {
                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    thn: thn,
                    smt: smt,
                    jurusan: jurusan,
                    kelas: kelas,
                    angkatan: angkatan
                })
            }
        );

        const res = await response.json();

        alert(res.msg);

        if(res.success)
        {
            table.replaceData();
        }

    } catch(error) {

        console.error(error);

        alert('Gagal melakukan proses isi nilai');
    }
}
</script>