<div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

    <div class="relative transform transition-all sm:my-8 sm:w-full max-w-[95vw]
                    bg-white rounded-3xl p-6 sm:p-8 shadow-2xl text-left
                    border border-slate-100">

        <!-- Close Button -->
        <div class="flex justify-end mb-3">
            <button type="button"
                onclick="closeMapelModal()"
                class="w-9 h-9 rounded-full border-2 border-red-500
                           text-red-500 hover:bg-red-50 flex items-center
                           justify-center transition cursor-pointer shadow-xs"
                title="Tutup Modal">

                <svg class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12">
                    </path>

                </svg>
            </button>
        </div>

        <form
            id="form-mapel-modal"
            class="w-full max-w-none">

            <!-- =========================================================
         CARD FORM
    ========================================================== -->
            <div class="w-full max-w-none
                border border-slate-200/90
                rounded-2xl
                p-5 sm:p-6
                mb-6
                space-y-5
                bg-white">

                <!-- =====================================================
             URUTAN JAM
        ====================================================== -->
                <div class="w-full">

                    

                <!-- =====================================================
             FILTER
        ====================================================== -->
                <div class="w-full">

                    <div
                        class="grid
                       grid-cols-1
                       sm:grid-cols-2
                       lg:grid-cols-3
                       xl:grid-cols-6
                       gap-3
                       w-full">

                        <!-- Tahun -->
                        <div class="w-full">

                            <select
                                id="filter_tahun_detail_modal"
                                class="w-full h-11 px-3
                               rounded-xl
                               border border-slate-200
                               text-sm
                               bg-white
                               focus:border-[#02BC9C]
                               focus:ring-1
                               focus:ring-[#02BC9C]">

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


                        <!-- Jurusan -->
                        <div class="w-full">

                            <select
                                id="filter_jurusan_detail_modal"
                                class="w-full h-11 px-3
                               rounded-xl
                               border border-slate-200
                               text-sm
                               bg-white
                               focus:border-[#02BC9C]
                               focus:ring-1
                               focus:ring-[#02BC9C]">

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


                        <!-- Kelas -->
                        <div class="w-full">

                            <select
                                id="filter_kelas_detail_modal"
                                class="w-full h-11 px-3
                               rounded-xl
                               border border-slate-200
                               text-sm
                               bg-white
                               focus:border-[#02BC9C]
                               focus:ring-1
                               focus:ring-[#02BC9C]">

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


                        <!-- Semester -->
                        <div class="w-full">

                            <select
                                id="filter_semester_detail_modal"
                                class="w-full h-11 px-3
                               rounded-xl
                               border border-slate-200
                               text-sm
                               bg-white
                               focus:border-[#02BC9C]
                               focus:ring-1
                               focus:ring-[#02BC9C]">

                                <option value="">
                                    Semua Semester
                                </option>

                                <option value="1">
                                    Ganjil
                                </option>

                                <option value="0">
                                    Genap
                                </option>

                            </select>

                        </div>


                        <!-- Mata Pelajaran -->
                        <div class="w-full">

                            <input
                                type="text"
                                id="filter_mapel_detail_modal"
                                class="w-full h-11 px-4
                               rounded-xl
                               border border-slate-200
                               text-sm
                               bg-white
                               focus:border-[#02BC9C]
                               focus:ring-1
                               focus:ring-[#02BC9C]"
                                placeholder="🔍 Cari Mata Pelajaran...">

                        </div>


                        <!-- Tombol -->
                        <div class="w-full flex gap-2">

                            <button
                                type="button"
                                class="flex-1
                               h-11
                               bg-[#02BC9C]
                               hover:bg-[#00a387]
                               text-white
                               px-4
                               rounded-xl
                               font-semibold
                               transition"
                                onclick="loadDetailDataPelajaran()">
                                Cari
                            </button>

                            <button
                                type="button"
                                class="flex-1
                               h-11
                               bg-slate-100
                               hover:bg-slate-200
                               text-slate-700
                               px-4
                               rounded-xl
                               font-semibold
                               transition"
                                onclick="resetDetailFilter()">
                                Reset
                            </button>

                        </div>

                    </div>

                </div>
                <br />


                <!-- =====================================================
             TABLE
        ====================================================== -->
                <div class="w-full overflow-x-auto">

                    <div
                        id="table-detail-jadwal"
                        class="w-full min-w-full"></div>

                </div>

            </div>


            <!-- =========================================================
         BUTTON SIMPAN
    ========================================================== -->
            <div class="w-full flex justify-end">

                <button
                    type="button"
                    id="btn-submit-mapel"
                    onclick="saveDetailJadwal()"
                    class="bg-[#02BC9C]
               hover:bg-[#00a387]
               text-white
               font-semibold
               text-base
               px-6 py-3
               rounded-xl
               flex items-center
               gap-2
               shadow-sm
               transition
               active:scale-95
               cursor-pointer">

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17 21v-8H7v8M7 3v5h8V3M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2-2z" />

                    </svg>

                    <span>
                        Simpan Jam Mata Pelajaran
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>

</div>


<script>
   const jamOptions = {
    "": "Pilih Jam",
    ...@json(
        $jam->mapWithKeys(function ($item) {
            return [
                $item->id =>
                    'Jam Ke-' . $item->jam_ke .
                    ' (' . $item->jam_awal .
                    ' - ' . $item->jam_akhir . ')'
            ];
        })
    )
};

    let changedRowsDetail = [];


    /* =============================================================
       TABULATOR
    ============================================================= */


              
    

  let tableDetail;

window.tampilkanTableDetail = function() {

   tableDetail = null;
    const idHari = window.currentEditingSlot?.idHari ?? null;

    console.log('ID HARI UNTUK TABEL:', idHari);

    if (!idHari) {
        console.log('ID Hari belum tersedia');
        return;
    }

    if (tableDetail) {
        tableDetail.setData(
            "{{ route('detail-jadwal.data') }}",
            { id_hari: idHari }
        );
        return;
    }

    tableDetail = new Tabulator("#table-detail-jadwal", {
        ajaxURL: "{{ route('detail-jadwal.data') }}",

        ajaxParams: {
            id_hari: idHari
        },

        selectableRows: 1,
        layout: "fitDataStretch",
        pagination: true,
        paginationSize: 20,

        // Pertahankan konfigurasi columns milik Anda di sini.
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
                    title: "Tahun",
                    field: "tahun_ajaran",
                    width: 150
                },


                {
                    title: "Semester",
                    field: "semester",
                    width: 100,
                    hozAlign: "center"
                },


                {
                    title: "Kelas",
                    field: "nama_kelas",
                    width: 180
                },


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

                        return guruOptions[
                            cell.getValue()
                        ] ?? "-";
                    }
                },


                {
                    title: "Jam Pelajaran",
                    field: "id_jam",
                    width: 300,

                    editor: "list",

                    editorParams: {

                        values: jamOptions,

                        autocomplete: true,

                        listOnEmpty: true
                    },

                    formatter: function(cell) {

                        return jamOptions[
                            cell.getValue()
                        ] ?? "-";
                    }
                },


                {
                    title: "Waktu",
                    width: 150,

                    formatter: function(cell) {

                        let row = cell.getData();

                        return (row.jam_awal ?? '') +
                            ' - ' +
                            (row.jam_akhir ?? '');
                    }
                }

            ]

    });


     tableDetail.on(
        "cellEdited",
        function(cell) {

            let data = cell.getRow().getData();

            let idx = changedRowsDetail.findIndex(
                x => x.id == data.id
            );

            if (idx === -1) {

                changedRowsDetail.push({
                    ...data
                });

            } else {

                changedRowsDetail[idx] = {
                    ...data
                };

            }

        }
    );
};
   
let tableDetailFull = null;
window.tampilkanTableDetailFull = function() {
   
 tableDetailFull = null;
    if (tableDetailFull) {
        tableDetailFull.setData(
            "{{ route('detail-jadwal.data') }}",
           
        );
        return;
    }

    tableDetailFull = new Tabulator("#table-detail-jadwal", {
        ajaxURL: "{{ route('detail-jadwal.data') }}",

       
        selectableRows: 1,
        layout: "fitDataStretch",
        pagination: true,
        paginationSize: 20,

        // Pertahankan konfigurasi columns milik Anda di sini.
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
                    title: "Tahun",
                    field: "tahun_ajaran",
                    width: 150
                },


                {
                    title: "Semester",
                    field: "semester",
                    width: 100,
                    hozAlign: "center"
                },


                {
                    title: "Kelas",
                    field: "nama_kelas",
                    width: 180
                },


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

                        return guruOptions[
                            cell.getValue()
                        ] ?? "-";
                    }
                },


                {
                    title: "Jam Pelajaran",
                    field: "id_jam",
                    width: 300,

                    editor: "list",

                    editorParams: {

                        values: jamOptions,

                        autocomplete: true,

                        listOnEmpty: true
                    },

                    formatter: function(cell) {

                        return jamOptions[
                            cell.getValue()
                        ] ?? "-";
                    }
                },


                {
                    title: "Waktu",
                    width: 150,

                    formatter: function(cell) {

                        let row = cell.getData();

                        return (row.jam_awal ?? '') +
                            ' - ' +
                            (row.jam_akhir ?? '');
                    }
                }

            ]

    });


     tableDetailFull.on(
        "cellEdited",
        function(cell) {

            let data = cell.getRow().getData();

            let idx = changedRowsDetail.findIndex(
                x => x.id == data.id
            );

            if (idx === -1) {

                changedRowsDetail.push({
                    ...data
                });

            } else {

                changedRowsDetail[idx] = {
                    ...data
                };

            }

        }
    );
};

    /* =============================================================
       TRACK PERUBAHAN
    ============================================================= */

   


    /* =============================================================
       LOAD DATA
    ============================================================= */

    function loadDetailDataPelajaran() {

    console.log('loadDetailDataPelajaran dipanggil', document.getElementById(
                'filter_mapel_detail_modal'
            ).value);

        let params = {

            id_tahun: document.getElementById(
                'filter_tahun_detail_modal'
            ).value,

            id_jurusan: document.getElementById(
                'filter_jurusan_detail_modal'
            ).value,

            id_kelas: document.getElementById(
                'filter_kelas_detail_modal'
            ).value,

            smt: document.getElementById(
                'filter_semester_detail_modal'
            ).value,

            nama_pelajaran: document.getElementById(
                'filter_mapel_detail_modal'
            ).value

        };

        console.log(
            'Filter:',
            params
        );
if(tableDetail) {
        tableDetail.setData(
            "{{ route('detail-jadwal.data') }}",
            params
        );

}

if(tableDetailFull) {

         tableDetailFull.setData(
            "{{ route('detail-jadwal.data') }}",
            params
        );

}
    }

   

    

    async function saveDetailJadwal() {
        if (changedRowsDetail.length === 0) {

            alert('Tidak ada perubahan');

            return;
        }

        // Ambil id_hari dari currentEditingSlot
        const idHari =
            window.currentEditingSlot?.idHari ?? null;

        console.log('ID HARI:', idHari);
        console.log('DATA SEBELUM:', changedRowsDetail);


        // Tambahkan id_hari ke setiap row
        const dataToSave = changedRowsDetail.map(row => ({

            ...row,

            id_hari: row.id_hari ?? idHari,
            id_jam: row.id_jam ?? 0

        }));


        console.log('DATA YANG DIKIRIM:', dataToSave);


        try {

            const response = await fetch(
                "{{ route('detail-jadwal.update') }}", {
                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },

                    body: JSON.stringify({
                        data: dataToSave
                    })
                }
            );


            const res = await response.json();


            if (!response.ok) {

                throw new Error(
                    res.message ||
                    res.msg ||
                    'Gagal menyimpan data'
                );

            }


            if (!res.success) {

                throw new Error(
                    res.msg ||
                    'Gagal menyimpan data'
                );

            }


            alert(res.msg);


            changedRowsDetail = [];


            await reloadSchedule();

if(tableDetail) {
            tableDetail.replaceData();
}

if(tableDetailFull) {
    tableDetailFull.replaceData();
}
            // await tableDetail.replaceData();

            closeMapelModal();


        } catch (error) {

            console.error(
                'Error saveDetailJadwal:',
                error
            );

            alert(
                error.message ||
                'Terjadi kesalahan saat menyimpan data'
            );

        }
    }

    function closeMapelModal() {

        const modal = document.getElementById('mapel-modal');

        console.log('MODAL:', modal);

        if (!modal) {
            console.error('ID mapel-modal tidak ditemukan');
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

        window.currentEditingSlot = null;
    }
</script>