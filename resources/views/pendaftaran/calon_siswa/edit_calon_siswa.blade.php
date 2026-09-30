
@extends('layout.app')

@section('title', 'Data Diri Calon Siswa - PPDB 2026')

@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full space-y-6 min-w-0">

    <!-- =========================================================
         HEADER
    ========================================================== -->

    <section>

        <div class="mb-6">

            <div class="flex items-center gap-2 mb-2">

                <a href="javascript:history.back()"
                   class="inline-flex items-center gap-2
                          text-sm font-medium
                          text-[#02BC9C]
                          hover:text-[#02a387]
                          transition-colors">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         stroke-width="2.2"
                         viewBox="0 0 24 24">

                        <line x1="19" x2="5" y1="12" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>

                    </svg>

                    Kembali

                </a>

            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold
                       text-slate-900 tracking-tight">

                Data Diri Calon Siswa

            </h1>

            <p class="text-sm text-slate-500 mt-1">

                Kelola biodata, asal sekolah, orang tua,
                dokumen, dan pembayaran calon siswa.

            </p>

        </div>


        <!-- =====================================================
             TAB CARD
        ====================================================== -->

        <div class="bg-white rounded-xl
                    border border-slate-200
                    shadow-sm overflow-hidden">


            <!-- =================================================
                 TAB NAVIGATION
            ================================================== -->

            <div class="border-b border-slate-200">

                <nav
                    class="grid grid-cols-3 sm:grid-cols-6"
                    aria-label="Tabs"
                >


                    <!-- =========================================
                         DATA CALON SISWA
                    ========================================== -->

                    <button
                        type="button"
                        data-tab-target="siswa-tab"
                        aria-selected="true"
                        class="tab-btn
                               flex flex-col items-center justify-center
                               gap-2
                               px-2 py-4
                               border-b-2
                               border-[#00B686]
                               text-[#00B686]
                               font-semibold
                               transition-all duration-200
                               hover:bg-slate-50"
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19a4 4 0 0 0-8 0"
                            />

                            <circle
                                cx="11"
                                cy="7"
                                r="4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 8v6m3-3h-6"
                            />
                        </svg>

                        <span class="text-xs sm:text-sm whitespace-nowrap">
                            Data Calon Siswa
                        </span>

                    </button>


                    <!-- =========================================
                         ASAL SEKOLAH
                    ========================================== -->

                    <button
                        type="button"
                        data-tab-target="registrasi-tab"
                        aria-selected="false"
                        class="tab-btn
                               flex flex-col items-center justify-center
                               gap-2
                               px-2 py-4
                               border-b-2
                               border-transparent
                               text-slate-500
                               font-medium
                               transition-all duration-200
                               hover:bg-slate-50"
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 21h18"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 21V9l7-4 7 4v12"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 21v-6h6v6"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 10h.01M15 10h.01"
                            />
                        </svg>

                        <span class="text-xs sm:text-sm whitespace-nowrap">
                            Asal Sekolah
                        </span>

                    </button>


                    <!-- =========================================
                         ORANG TUA
                    ========================================== -->

                    <button
                        type="button"
                        data-tab-target="orang-tua-tab"
                        aria-selected="false"
                        class="tab-btn
                               flex flex-col items-center justify-center
                               gap-2
                               px-2 py-4
                               border-b-2
                               border-transparent
                               text-slate-500
                               font-medium
                               transition-all duration-200
                               hover:bg-slate-50"
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >

                            <circle
                                cx="9"
                                cy="8"
                                r="3"
                            />

                            <circle
                                cx="17"
                                cy="9"
                                r="2"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 20a6 6 0 0 1 12 0"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 15a4 4 0 0 1 6 3"
                            />

                        </svg>

                        <span class="text-xs sm:text-sm whitespace-nowrap">
                            Orang Tua
                        </span>

                    </button>


                    <!-- =========================================
                         UPLOAD DOKUMEN
                    ========================================== -->

                    <button
                        type="button"
                        data-tab-target="upload-tab"
                        aria-selected="false"
                        class="tab-btn
                               flex flex-col items-center justify-center
                               gap-2
                               px-2 py-4
                               border-b-2
                               border-transparent
                               text-slate-500
                               font-medium
                               transition-all duration-200
                               hover:bg-slate-50"
                    >

                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 16V4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m8 8 4-4 4 4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12v7a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-7"
                            />

                        </svg>

                        <span class="text-xs sm:text-sm whitespace-nowrap">
                            Upload Dokumen
                        </span>

                    </button>


                    <!-- =========================================
                         PEMBAYARAN
                    ========================================== -->

                    @if(auth()->user()->hasRole('calon'))

                        <button
                            type="button"
                            data-tab-target="pembayaran-tab-content"
                            aria-selected="false"
                            class="tab-btn
                                   flex flex-col items-center justify-center
                                   gap-2
                                   px-2 py-4
                                   border-b-2
                                   border-transparent
                                   text-slate-500
                                   font-medium
                                   transition-all duration-200
                                   hover:bg-slate-50"
                        >

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >

                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M3 10h18"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M7 15h3"
                                />

                            </svg>

                            <span class="text-xs sm:text-sm whitespace-nowrap">
                                Pembayaran
                            </span>

                        </button>

                    @endif


                    <!-- =========================================
                         BUKTI REGISTRASI
                    ========================================== -->

                    @if(auth()->user()->hasRole('admin'))

                        <button
                            type="button"
                            data-tab-target="bukti-tab"
                            aria-selected="false"
                            class="tab-btn
                                   flex flex-col items-center justify-center
                                   gap-2
                                   px-2 py-4
                                   border-b-2
                                   border-transparent
                                   text-slate-500
                                   font-medium
                                   transition-all duration-200
                                   hover:bg-slate-50"
                        >

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 3h9l3 3v15H6z"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M9 13h6M9 17h4"
                                />

                                <path
                                    stroke-linecap="round"
                                    d="M9 9h3"
                                />

                            </svg>

                            <span class="text-xs sm:text-sm whitespace-nowrap">
                                Bukti Registrasi
                            </span>

                        </button>

                    @endif

                </nav>

            </div>


            <!-- =================================================
                 TAB CONTENT
            ================================================== -->

            <div class="p-4 sm:p-6">


                <!-- DATA CALON SISWA -->

                <div
                    id="siswa-tab"
                    class="tab-content"
                    role="tabpanel"
                >

                    @include(
                        'pendaftaran.calon_siswa.tab.data_calon_siswa'
                    )

                </div>


                <!-- ASAL SEKOLAH -->

                <div
                    id="registrasi-tab"
                    class="tab-content hidden"
                    role="tabpanel"
                >

                    @include(
                        'pendaftaran.calon_siswa.tab.registrasi'
                    )

                </div>


                <!-- ORANG TUA -->

                <div
                    id="orang-tua-tab"
                    class="tab-content hidden"
                    role="tabpanel"
                >

                    @include(
                        'pendaftaran.calon_siswa.tab.orang_tua'
                    )

                </div>


                <!-- UPLOAD DOKUMEN -->

                <div
                    id="upload-tab"
                    class="tab-content hidden"
                    role="tabpanel"
                >

                    @include(
                        'pendaftaran.calon_siswa.tab.upload'
                    )

                </div>


                <!-- BUKTI REGISTRASI -->

                @if(auth()->user()->hasRole('admin'))

                    <div
                        id="bukti-tab"
                        class="tab-content hidden"
                        role="tabpanel"
                    >

                        @include(
                            'pendaftaran.calon_siswa.tab.bukti'
                        )

                    </div>

                @endif


                <!-- PEMBAYARAN -->

                @if(auth()->user()->hasRole('calon'))

                    <div
                        id="pembayaran-tab-content"
                        class="tab-content hidden"
                        role="tabpanel"
                    >

                        @include(
                            'pendaftaran.calon_siswa.tab.pembayaran'
                        )

                    </div>

                @endif

            </div>

        </div>

    </section>

</main>


<!-- =============================================================
     TAB JAVASCRIPT
============================================================== -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const tabButtons =
        document.querySelectorAll('.tab-btn');

    const tabContents =
        document.querySelectorAll('.tab-content');


    tabButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId =
                this.dataset.tabTarget;


            /* =====================================================
               RESET SEMUA TAB
            ====================================================== */

            tabButtons.forEach(function (btn) {

                btn.classList.remove(
                    'border-[#00B686]',
                    'text-[#00B686]',
                    'font-semibold'
                );

                btn.classList.add(
                    'border-transparent',
                    'text-slate-500',
                    'font-medium'
                );

                btn.setAttribute(
                    'aria-selected',
                    'false'
                );

            });


            /* =====================================================
               AKTIFKAN TAB YANG DIKLIK
            ====================================================== */

            this.classList.remove(
                'border-transparent',
                'text-slate-500',
                'font-medium'
            );

            this.classList.add(
                'border-[#00B686]',
                'text-[#00B686]',
                'font-semibold'
            );

            this.setAttribute(
                'aria-selected',
                'true'
            );


            /* =====================================================
               SEMBUNYIKAN SEMUA CONTENT
            ====================================================== */

            tabContents.forEach(function (content) {

                content.classList.add('hidden');

            });


            /* =====================================================
               TAMPILKAN CONTENT SESUAI TAB
            ====================================================== */

            const target =
                document.getElementById(targetId);


            if (target) {

                target.classList.remove('hidden');

            }

        });

    });

});

</script>

@endsection

