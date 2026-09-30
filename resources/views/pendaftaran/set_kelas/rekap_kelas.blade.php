
@extends('layout.app')

@section('title', 'Rekap Kelas')
@section('page_title', 'Rekap Kelas')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    <!-- =========================================================
         HEADER
    ========================================================== -->

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            {{-- KEMBALI --}}
            <div class="flex items-center gap-2 mb-2">

                <a
                    href="javascript:history.back()"
                    class="inline-flex items-center gap-2 text-sm font-medium
                           text-[#02BC9C] hover:text-[#02a387]
                           transition-colors"
                >

                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.2"
                        viewBox="0 0 24 24"
                    >
                        <line x1="19" x2="5" y1="12" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>

                    Kembali

                </a>

            </div>


            {{-- TITLE --}}
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                Rekap Kelas
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Rekap jumlah siswa berdasarkan kelas dan jurusan.
            </p>

        </div>

    </div>


    <!-- =========================================================
         TABLE
    ========================================================== -->

    <section class="bg-white rounded-xl border border-slate-200 shadow-sm">


        <!-- CARD HEADER -->

        <div
            class="flex flex-col sm:flex-row
                   sm:items-center justify-between
                   gap-4 p-6 border-b border-slate-200"
        >

            <div class="flex items-center gap-3">

                {{-- ICON --}}

                <div
                    class="w-10 h-10 rounded-lg
                           bg-teal-50 border border-teal-100
                           flex items-center justify-center
                           text-teal-600"
                >

                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >

                        {{-- School --}}
                        <path d="M3 21h18"></path>

                        <path d="M5 21V9l7-4 7 4v12"></path>

                        <path d="M9 21v-6h6v6"></path>

                        <path d="M9 10h.01"></path>
                        <path d="M12 10h.01"></path>
                        <path d="M15 10h.01"></path>

                    </svg>

                </div>


                {{-- TITLE CARD --}}

                <div>

                    <h2 class="text-lg font-bold text-slate-900">
                        Data Rekap Kelas
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Daftar jumlah siswa setiap kelas
                    </p>

                </div>

            </div>

        </div>


        <!-- =====================================================
             TABLE
        ====================================================== -->

        <div class="p-6">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <!-- HEADER -->

                    <thead>

                        <tr
                            class="border-b border-slate-200
                                   bg-slate-50"
                        >

                            <th
                                class="px-4 py-3.5
                                       text-center
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-slate-600
                                       w-20"
                            >
                                No
                            </th>


                            <th
                                class="px-4 py-3.5
                                       text-left
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-slate-600"
                            >
                                Kelas
                            </th>


                            <th
                                class="px-4 py-3.5
                                       text-left
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-slate-600"
                            >
                                Jurusan
                            </th>


                            <th
                                class="px-4 py-3.5
                                       text-center
                                       text-xs font-semibold
                                       uppercase tracking-wide
                                       text-slate-600
                                       w-48"
                            >
                                Jumlah Siswa
                            </th>

                        </tr>

                    </thead>


                    <!-- BODY -->

                    <tbody class="divide-y divide-slate-100">

                        @forelse($data as $row)

                            <tr
                                class="transition-colors
                                       hover:bg-slate-50"
                            >

                                {{-- NO --}}

                                <td
                                    class="px-4 py-4
                                           text-center
                                           text-slate-500
                                           font-medium"
                                >
                                    {{ $loop->iteration }}
                                </td>


                                {{-- KELAS --}}

                                <td
                                    class="px-4 py-4
                                           font-semibold
                                           text-slate-800"
                                >
                                    {{ $row->nama_kelas }}
                                </td>


                                {{-- JURUSAN --}}

                                <td
                                    class="px-4 py-4
                                           text-slate-600"
                                >
                                    {{ $row->nama_jurusan }}
                                </td>


                                {{-- JUMLAH SISWA --}}

                                <td
                                    class="px-4 py-4
                                           text-center"
                                >

                                    <span
                                        class="inline-flex
                                               items-center
                                               justify-center
                                               gap-1.5
                                               rounded-full
                                               bg-teal-50
                                               border border-teal-100
                                               px-3 py-1.5
                                               text-xs font-semibold
                                               text-teal-700"
                                    >

                                        <svg
                                            class="w-3.5 h-3.5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                                            ></path>

                                            <circle
                                                cx="9"
                                                cy="7"
                                                r="4"
                                            ></circle>

                                            <path
                                                d="M22 21v-2a4 4 0 0 0-3-3.87"
                                            ></path>

                                            <path
                                                d="M16 3.13a4 4 0 0 1 0 7.75"
                                            ></path>

                                        </svg>

                                        {{ $row->jml_siswa }} Siswa

                                    </span>

                                </td>

                            </tr>

                        @empty

                            {{-- EMPTY DATA --}}

                            <tr>

                                <td
                                    colspan="4"
                                    class="px-4 py-16 text-center"
                                >

                                    <div
                                        class="flex flex-col
                                               items-center
                                               justify-center"
                                    >

                                        <div
                                            class="w-12 h-12
                                                   rounded-full
                                                   bg-slate-100
                                                   flex items-center
                                                   justify-center
                                                   mb-3"
                                        >

                                            <svg
                                                class="w-6 h-6
                                                       text-slate-400"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    d="M3 3v18h18"
                                                ></path>

                                                <path
                                                    d="m7 16 4-5 3 3 4-6"
                                                ></path>

                                            </svg>

                                        </div>


                                        <p
                                            class="text-sm
                                                   font-semibold
                                                   text-slate-600"
                                        >
                                            Data tidak ditemukan
                                        </p>


                                        <p
                                            class="mt-1
                                                   text-xs
                                                   text-slate-400"
                                        >
                                            Belum ada data rekap kelas
                                            yang tersedia.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</main>

@endsection

