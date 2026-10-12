
@extends('layout.app')

@section('title', 'Siswa')
@section('page_title', 'Siswa')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <div class="flex items-center gap-2 mb-2">
                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2 text-sm font-medium text-[#02BC9C] hover:text-[#02a387] transition-colors">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                    Kembali
                </a>
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Siswa
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data siswa yang terdaftar dalam sistem.
            </p>
        </div>

        {{-- Tombol tambah --}}
        <a href="{{ route('siswa.create') }}"
           class="inline-flex items-center justify-center gap-2
                  bg-[#00bfa5] hover:bg-[#00a892]
                  text-white font-semibold
                  px-4 py-2.5 rounded-lg
                  shadow-sm hover:shadow
                  transition-all">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Tambah Siswa
        </a>

    </div>


    {{-- Card Daftar Siswa --}}
    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">

        {{-- Card Header --}}
        <div class="flex items-center gap-3 p-5 border-b border-slate-200">

            <div class="w-10 h-10 rounded-lg
                        bg-teal-50 border border-teal-100
                        flex items-center justify-center
                        text-teal-600">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8zm6 4a3 3 0 10-6 0 3 3 0 006 0z"/>
                </svg>

            </div>

            <div>
                <h2 class="text-base font-semibold text-slate-800">
                    Daftar Siswa
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Data siswa berdasarkan tahun ajaran, jurusan, dan kelas.
                </p>
            </div>

        </div>


        {{-- Content --}}
        <div class="p-5">

            {{-- Filter --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-5">

                {{-- Tahun Ajaran --}}
                <div>
                    <label for="filter-tahun"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Angkatan
                    </label>

                    <select id="filter-tahun"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   focus:border-teal-500 focus:ring-2
                                   focus:ring-teal-500/20 focus:outline-none
                                   transition">

                        <option value="">
                            Semua Angkatan
                        </option>

                        @foreach ($tahunAjaran as $tahun)
                            <option value="{{ $tahun->id }}">
                                {{ $tahun->thn_ajaran }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Jurusan --}}
                <div>
                    <label for="filter-jurusan"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Jurusan
                    </label>

                    <select id="filter-jurusan"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   focus:border-teal-500 focus:ring-2
                                   focus:ring-teal-500/20 focus:outline-none
                                   transition">

                        <option value="">
                            Semua Jurusan
                        </option>

                        @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_jurusan }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Kelas --}}
                <div>
                    <label for="filter-kelas"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Kelas
                    </label>

                    <select id="filter-kelas"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   focus:border-teal-500 focus:ring-2
                                   focus:ring-teal-500/20 focus:outline-none
                                   transition">

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach ($kelas as $item)
                            <option value="{{ $item->idx }}">
                                {{ $item->nama_kelas }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Search --}}
                <div>
                    <label for="search-siswa"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Nama / NIPD
                    </label>

                    <div class="relative">

                        <div class="absolute inset-y-0 left-0
                                    flex items-center pl-3
                                    pointer-events-none
                                    text-slate-400">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>
                            </svg>

                        </div>

                        <input
                            type="text"
                            id="search-siswa"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white pl-9 pr-3 py-2.5
                                   text-sm text-slate-700
                                   placeholder:text-slate-400
                                   focus:border-teal-500 focus:ring-2
                                   focus:ring-teal-500/20 focus:outline-none
                                   transition"
                            placeholder="Cari NIPD atau nama...">

                    </div>
                </div>


                {{-- Tombol Cari --}}
                <div class="flex items-end">

                    <button
                        type="button"
                        id="cari"
                        class="w-full inline-flex items-center
                               justify-center gap-2
                               bg-[#00bfa5] hover:bg-[#00a892]
                               text-white font-semibold
                               px-4 py-2.5 rounded-lg
                               shadow-sm hover:shadow
                               transition-all">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"/>
                        </svg>

                        Cari
                    </button>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">
                <div id="table-siswa"></div>
            </div>

        </div>

    </section>

</main>


<script>

    let table = new Tabulator("#table-siswa", {

        ajaxURL: "{{ route('siswa.data') }}",

        layout: "fitDataStretch",

        height: "500px",

        pagination: true,

        paginationSize: 10,

        placeholder: "Data siswa tidak ditemukan.",

        columns: [

            {
                title: "No",
                width: 70,
                hozAlign: "center",
                headerHozAlign: "center",
                headerSort: false,

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
                title: "NIPD",
                field: "nipd",
                width: 140,

                formatter: function(cell) {

                    return cell.getValue() ?? "-";

                }
            },


            {
                title: "Nama Lengkap",
                field: "nama_lengkap",
                width: 250,

                formatter: function(cell) {

                    return cell.getValue() ?? "-";

                }
            },


            {
                title: "No HP",
                field: "no_hp",
                width: 180,

                formatter: function(cell) {

                    return cell.getValue() ?? "-";

                }
            },


            {
                title: "Jurusan",
                field: "nama_jurusan",
                width: 220,

                formatter: function(cell) {

                    return cell.getValue() ?? "-";

                }
            },




            {
                title: "Kelas",
                field: "kelas",
                width: 160,

                formatter: function(cell) {

                    return cell.getValue() ?? "-";

                }
            },


            {
                title: "Aksi",
                width: 120,
                hozAlign: "center",
                headerHozAlign: "center",
                headerSort: false,

                formatter: function(cell) {

                    let data = cell.getData();

                    return `

                        <div class="flex items-center
                                    justify-center gap-2">

                            <a
                                href="{{ url('siswa/edit') }}/${data.id}"
                                target="_blank"
                                title="Edit Siswa"
                                class="w-9 h-9
                                       inline-flex items-center
                                       justify-center
                                       rounded-lg
                                       bg-amber-50
                                       text-amber-600
                                       border border-amber-100
                                       hover:bg-amber-100
                                       transition-colors">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                </svg>

                            </a>


                            <button
                                type="button"
                                title="Hapus Siswa"
                                onclick="deleteData(${data.id})"
                                class="w-9 h-9
                                       inline-flex items-center
                                       justify-center
                                       rounded-lg
                                       bg-red-50
                                       text-red-600
                                       border border-red-100
                                       hover:bg-red-100
                                       transition-colors">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M3 6h18"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M8 6V4a1 1 0 011-1h6a1 1 0 011 1v2"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M19 6l-1 14H6L5 6"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M10 11v5M14 11v5"/>

                                </svg>

                            </button>

                        </div>

                    `;
                }
            }

        ]

    });


    // Search lokal berdasarkan Nama / NIPD
    document
        .getElementById("search-siswa")
        .addEventListener("input", function() {

            const keyword =
                this.value.trim().toLowerCase();

            if (keyword === "") {

                table.clearFilter();

                return;
            }

            table.setFilter(function(data) {

                const nipd =
                    String(data.nipd ?? "")
                        .toLowerCase();

                const nama =
                    String(data.nama_lengkap ?? "")
                        .toLowerCase();

                return nipd.includes(keyword) ||
                       nama.includes(keyword);

            });

        });


    // Filter berdasarkan Tahun, Jurusan dan Kelas
    document
        .getElementById("cari")
        .addEventListener("click", function() {

            const params = {

                tahun:
                    document.getElementById("filter-tahun").value,

                jurusan:
                    document.getElementById("filter-jurusan").value,

                kelas:
                    document.getElementById("filter-kelas").value,

                search:
                    document.getElementById("search-siswa")
                        .value
                        .trim(),

            };


            console.log(params);


            table.setData(
                "{{ route('siswa.data') }}",
                params
            );

        });


    // Hapus siswa
    function deleteData(id) {

        if (!confirm('Yakin hapus data siswa?')) {
            return;
        }


        fetch(
            "{{ url('siswa/delete') }}/" + id,
            {

                method: 'DELETE',

                headers: {

                    'X-CSRF-TOKEN':
                        '{{ csrf_token() }}',

                    'Accept':
                        'application/json'

                }

            }
        )

        .then(async response => {

            let result;

            try {

                result =
                    await response.json();

            } catch (error) {

                throw new Error(
                    'Response server bukan JSON.'
                );

            }


            if (
                !response.ok ||
                result.success === false
            ) {

                throw new Error(
                    result.message ??
                    'Data siswa gagal dihapus.'
                );

            }


            return result;

        })


        .then(result => {

            alert(
                result.message ??
                'Data siswa berhasil dihapus.'
            );


            table.replaceData();

        })


        .catch(error => {

            console.error(error);

            alert(error.message);

        });

    }

</script>

@endsection
