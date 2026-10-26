<div class="w-full mx-auto p-3 sm:p-5 lg:p-6">   
    
{{-- ACTION BUTTON --}}
    <div class="mb-5 flex flex-wrap items-center gap-3">

        {{-- Tambah Jadwal --}}
        <button
            type="button"
            data-tw-toggle="modal"
            data-tw-target="#modal-add-jadwal"
            class="inline-flex items-center gap-2 rounded-xl bg-[#02BC9C] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#00A98C] focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/30">
            <i data-lucide="plus" class="h-4 w-4"></i>
            <span>Tambah Jadwal</span>
        </button>

        {{-- Inisialisasi Jadwal --}}
        <button
            type="button"
            onclick="inisialisasiJadwal()"
            class="inline-flex items-center gap-2 rounded-xl bg-amber-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500/30">
            <i data-lucide="save" class="h-4 w-4"></i>
            <span>Inisialisasi Jadwal</span>
        </button>

        {{-- Isi Nilai Awal --}}
        <button
            type="button"
            onclick="isiNilai()"
            class="inline-flex items-center gap-2 rounded-xl bg-red-500 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/30">
            <i data-lucide="activity" class="h-4 w-4"></i>
            <span>Isi Nilai Awal</span>
        </button>

      

    </div>


    {{-- MAIN CARD --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- CARD HEADER --}}
        <div class="flex flex-col gap-2 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="flex items-center gap-2 text-lg font-bold text-slate-800">

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#02BC9C]/10 text-[#02BC9C]">
                        <i data-lucide="calendar-days" class="h-5 w-5"></i>
                    </span>

                    <span>Daftar Jadwal</span>

                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola jadwal mata pelajaran, guru, semester, dan angkatan.
                </p>
            </div>

        </div>


        {{-- CARD BODY --}}
        <div class="p-5">

            {{-- FILTER AREA --}}
            <div class="mb-5 rounded-2xl border border-slate-200 bg-slate-50/70 p-4">

                <div class="mb-4 flex items-center gap-2">

                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-slate-600 shadow-sm">
                        <i data-lucide="filter" class="h-4 w-4"></i>
                    </span>

                    <div>
                        <h3 class="text-sm font-semibold text-slate-700">
                            Filter Jadwal
                        </h3>

                        <p class="text-xs text-slate-500">
                            Gunakan filter untuk mencari data jadwal.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">

                    {{-- Tahun Ajaran --}}
                    <div>
                        <label
                            for="filter_tahun"
                            class="mb-1.5 block text-xs font-semibold text-slate-600">
                            Tahun Ajaran
                        </label>

                        <select
                            id="filter_tahun"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="">
                                Semua Tahun Ajaran
                            </option>

                            @foreach($tahun as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->thn_ajaran }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- Jurusan --}}
                    <div>
                        <label
                            for="filter_jurusan"
                            class="mb-1.5 block text-xs font-semibold text-slate-600">
                            Jurusan
                        </label>

                        <select
                            id="filter_jurusan"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

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


                    {{-- Kelas --}}
                    <div>
                        <label
                            for="filter_kelas"
                            class="mb-1.5 block text-xs font-semibold text-slate-600">
                            Kelas
                        </label>

                        <select
                            id="filter_kelas"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="">
                                Semua Kelas
                            </option>

                            @foreach($kelas as $item)
                                <option value="{{ $item->idx }}">
                                    {{ $item->nama_kelas }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- Semester --}}
                    <div>
                        <label
                            for="filter_semester"
                            class="mb-1.5 block text-xs font-semibold text-slate-600">
                            Semester
                        </label>

                        <select
                            id="filter_semester"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

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
                    </div>


                    {{-- Angkatan --}}
                    <div>
                        <label
                            for="filter_angkatan"
                            class="mb-1.5 block text-xs font-semibold text-slate-600">
                            Angkatan
                        </label>

                        <select
                            id="filter_angkatan"
                            class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20">

                            <option value="">
                                Angkatan
                            </option>

                            @foreach($tahun as $item)
                        
                                <option value="{{ $item->id }}">
                                    {{ $item->thn_ajaran }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    {{-- Mata Pelajaran --}}
                    <div>
                        <label
                            for="filter_mapel"
                            class="mb-1.5 block text-xs font-semibold text-slate-600">
                            Mata Pelajaran
                        </label>

                        <div class="relative">

                            <i
                                data-lucide="search"
                                class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400">
                            </i>

                            <input
                                type="text"
                                id="filter_mapel"
                                class="w-full rounded-xl border border-slate-300 bg-white py-2.5 pl-9 pr-3 text-sm text-slate-700 outline-none placeholder:text-slate-400 transition focus:border-[#02BC9C] focus:ring-2 focus:ring-[#02BC9C]/20"
                                placeholder="Cari Mata Pelajaran...">

                        </div>
                    </div>

                </div>


                {{-- FILTER BUTTON --}}
                <div class="mt-4 flex flex-wrap items-center gap-2">

                    <button
                        type="button"
                        onclick="loadData()"
                        class="inline-flex items-center gap-2 rounded-xl bg-[#02BC9C] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#00A98C] focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/30">

                        <i data-lucide="search" class="h-4 w-4"></i>

                        <span>Cari</span>

                    </button>


                    <button
                        type="button"
                        onclick="resetFilter()"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-800">

                        <i data-lucide="rotate-ccw" class="h-4 w-4"></i>

                        <span>Reset</span>

                    </button>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-hidden rounded-xl border border-slate-200">

                <div
                    id="table-jadwal"
                    class="w-full">
                </div>

            </div>

        </div>

    </div>

</div>


<script>
   const guruOptions = {
    "": "Pilih Guru",
    ...@json(
        $guru->pluck('nama_gtk', 'id')
    )
};

    let changedRows = [];

    let table = new Tabulator("#table-jadwal", {

        ajaxURL: "{{ route('master-jadwal.data') }}",

        layout: "fitDataStretch",

        ajaxParams: {},

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

                    return ((page - 1) * size) +
                        row.getPosition(true);

                }
            },


            {
                title: "Tahun Ajaran",
                field: "tahun_ajaran",
                width: 180,

                formatter: function(cell) {

                    return `
                        <span class="font-medium text-slate-700">
                            ${cell.getValue() ?? '-'}
                        </span>
                    `;

                }
            },


            {
                title: "Semester",
                field: "semester",
                width: 120,
                hozAlign: "center",

                formatter: function(cell) {

                    let value = cell.getValue();

                    if (value == 1) {

                        return `
                            <span class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                Ganjil
                            </span>
                        `;

                    }

                    if (value == 0) {

                        return `
                            <span class="inline-flex items-center rounded-lg bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-700">
                                Genap
                            </span>
                        `;

                    }

                    return `
                        <span class="text-slate-400">-</span>
                    `;

                }
            },


            /*
            {
                title: "Kelas",
                field: "nama_kelas",
                width: 180
            },
            */


            {
                title: "Mapel",
                field: "nama_mapel",
                width: 250,

                formatter: function(cell) {

                    return `
                        <div class="flex items-center gap-2">

                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#02BC9C]/10 text-[#02BC9C]">
                                <i data-lucide="book-open" class="h-4 w-4"></i>
                            </span>

                            <span class="font-medium text-slate-700">
                                ${cell.getValue() ?? '-'}
                            </span>

                        </div>
                    `;

                }
            },


            {
                title: "Guru",
                field: "nama_gtk",
                width: 250,

                
            },


            {
                title: "Jml Jam",
                field: "jml_jam",
                width: 100,
                hozAlign: "center",

                formatter: function(cell) {

                    return `
                        <span class="font-semibold text-slate-700">
                            ${cell.getValue() ?? 0}
                        </span>
                    `;

                }
            },


            {
                title: "Kelas",
                field: "nkelas",
                width: 120,
                hozAlign: "center",

                
            },


            {
                title: "Action",
                hozAlign: "center",
                width: 180,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `

                        <div class="flex items-center justify-center gap-2">

                            <button
                                type="button"
                                data-tw-toggle="modal"
                                data-tw-target="#modal-edit-jadwal"
                                onclick='editJadwal(${JSON.stringify(data)})'
                                class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-600 transition hover:bg-blue-100">

                                <i data-lucide="pencil" class="h-3.5 w-3.5"></i>

                                Edit

                            </button>


                            <button
                                type="button"
                                onclick="deleteJadwal(${data.id})"
                                class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">

                                <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>

                                Hapus

                            </button>

                        </div>

                    `;

                }
            }

        ]

    });


    // Render ulang icon Lucide setelah Tabulator selesai
    table.on("renderComplete", function() {

        setTimeout(() => {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

        }, 50);

    });


    function loadData() {

         const angkatan = document.getElementById('filter_mapel').value;

      
         console.log('loadData dipanggil', angkatan);

        table.setData(
            "{{ route('master-jadwal.data') }}",
            {
                id_tahun:
                    document.getElementById('filter_tahun').value,

                id_jurusan:
                    document.getElementById('filter_jurusan').value,

                id_kelas:
                    document.getElementById('filter_kelas').value,

                smt:
                    document.getElementById('filter_semester').value,

                mapel:
                    document.getElementById('filter_mapel').value,

                angkatan:
                    document.getElementById('filter_angkatan').value,
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

        let id =
            document.getElementById('edit_id').value;

        let isEdit = id != '';

        let prefix = isEdit ? 'edit_' : 'add_';

        let url = isEdit
            ? "{{ url('master-jadwal/update') }}/" + id
            : "{{ url('master-jadwal/store') }}";


        fetch(url, {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json',

                'X-CSRF-TOKEN':
                    '{{ csrf_token() }}'

            },

            body: JSON.stringify({

                angkatan:
                    document.getElementById(
                        prefix + 'id_tahun'
                    ).value ?? '',

                semester:
                    document.getElementById(
                        prefix + 'semester'
                    ).value ?? '',

                id_kelas:
                    document.getElementById(
                        prefix + 'id_kelas'
                    ).value ?? '',

                id_mapel:
                    document.getElementById(
                        prefix + 'id_mapel'
                    ).value ?? '',

                id_gtk:
                    document.getElementById(
                        prefix + 'id_gtk'
                    ).value ?? '',

                jml_jam:
                    document.getElementById(
                        prefix + 'jml_jam'
                    ).value ?? ''

            })

        })
        .then(res => res.json())
        .then(res => {

            const modal = isEdit
                ? tailwind.Modal.getOrCreateInstance(
                    document.querySelector(
                        "#modal-edit-jadwal"
                    )
                )
                : tailwind.Modal.getOrCreateInstance(
                    document.querySelector(
                        "#modal-add-jadwal"
                    )
                );

            modal.hide();

            table.replaceData();

        });

    }


    function deleteJadwal(id) {

        if (confirm('Hapus data ?')) {

            fetch(
                "{{ url('master-jadwal/delete') }}/" + id,
                {
                    method: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}'
                    }
                }
            )
            .then(res => res.json())
            .then(res => {

                table.replaceData();

                alert('Data berhasil dihapus');

            });

        }

    }


   


    async function inisialisasiJadwal() {

        let thn =
            document.getElementById(
                'filter_tahun'
            ).value;

        let smt =
            document.getElementById(
                'filter_semester'
            ).value;

        let jurusan =
            document.getElementById(
                'filter_jurusan'
            ).value;


        if (thn === '') {

            alert('Tahun Ajaran harus dipilih');

            return;

        }


        if (smt === '') {

            alert('Semester harus dipilih');

            return;

        }


        if (jurusan === '') {

            alert('Jurusan harus dipilih');

            return;

        }


        if (
            !confirm(
                'Apakah Anda yakin akan melakukan inisialisasi data?\n\n' +
                'Data jadwal yang sudah ada pada Tahun Ajaran, Semester, dan Jurusan yang dipilih akan dihapus dan dibuat ulang.'
            )
        ) {

            return;

        }


        try {

            const response = await fetch(
                "{{ route('master-jadwal.inisialisasi') }}",
                {

                    method: "POST",

                    headers: {

                        "Content-Type":
                            "application/json",

                        "X-CSRF-TOKEN":
                            "{{ csrf_token() }}"

                    },

                    body: JSON.stringify({

                        thn: thn,

                        smt: smt,

                        ang: thn,

                        jurusan: jurusan

                    })

                }
            );


            const res =
                await response.json();

            alert(res.msg);


            if (res.success) {

                table.replaceData();

            }


        } catch (e) {

            console.error(e);

            alert(
                'Gagal melakukan inisialisasi'
            );

        }

    }


    async function isiNilai() {

        let thn =
            document.getElementById(
                'filter_tahun'
            ).value;

        let smt =
            document.getElementById(
                'filter_semester'
            ).value;

        let jurusan =
            document.getElementById(
                'filter_jurusan'
            ).value;

        let kelas =
            document.getElementById(
                'filter_kelas'
            ).value;

        let angkatan =
            document.getElementById(
                'filter_angkatan'
            ).value;


        let errors = [];


        if (!thn) {

            errors.push('Tahun Ajaran');

        }


        if (!smt) {

            errors.push('Semester');

        }


        if (!angkatan) {

            errors.push('Angkatan');

        }


        if (!jurusan && !kelas) {

            errors.push('Jurusan atau Kelas');

        }


        if (errors.length > 0) {

            alert(
                'Field berikut wajib dipilih:\n\n- ' +
                errors.join('\n- ')
            );

            return;

        }


        if (
            !confirm(
                'Apakah Anda yakin akan melakukan proses Isi Nilai?\n\n' +
                'Data nilai yang sudah ada akan dihapus dan dibuat ulang.'
            )
        ) {

            return;

        }


        try {

            const response = await fetch(
                "{{ route('master-jadwal.isi-nilai') }}",
                {

                    method: "POST",

                    headers: {

                        "Content-Type":
                            "application/json",

                        "X-CSRF-TOKEN":
                            "{{ csrf_token() }}"

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


            const res =
                await response.json();

            alert(res.msg);


            if (res.success) {

                table.replaceData();

            }


        } catch (error) {

            console.error(error);

            alert(
                'Gagal melakukan proses isi nilai'
            );

        }

    }


    // Pastikan icon Lucide muncul
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            if (typeof lucide !== 'undefined') {

                lucide.createIcons();

            }

        }
    );
</script>