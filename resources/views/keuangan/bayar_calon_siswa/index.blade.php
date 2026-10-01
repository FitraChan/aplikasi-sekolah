@extends('layout.app')

@section('title', 'Pembayaran Calon Siswa')

@section('page_title', 'Pembayaran Calon Siswa')

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

                Pembayaran Calon Siswa

            </h1>


            <p class="text-sm text-slate-500 mt-1">

                Kelola history pembayaran dan detail transaksi
                calon siswa.

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
                    class="grid grid-cols-2"
                    aria-label="Tabs"
                >


                    <!-- =========================================
                         HISTORY PEMBAYARAN
                    ========================================== -->

                    <button
                        type="button"
                        data-tab-target="history-pembayaran"
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
                                d="M3 6h18"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 6v14h14V6"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 3h8"
                            />

                            <path
                                stroke-linecap="round"
                                d="M8 10h8"
                            />

                            <path
                                stroke-linecap="round"
                                d="M8 14h5"
                            />

                        </svg>


                        <span class="text-xs sm:text-sm whitespace-nowrap">

                            History Pembayaran

                        </span>

                    </button>


                    <!-- =========================================
                         DETAIL TRANSAKSI
                    ========================================== -->

                    <button
                        type="button"
                        data-tab-target="detail-transaksi"
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
                                y="4"
                                width="18"
                                height="16"
                                rx="2"
                            />

                            <path
                                stroke-linecap="round"
                                d="M7 8h10"
                            />

                            <path
                                stroke-linecap="round"
                                d="M7 12h10"
                            />

                            <path
                                stroke-linecap="round"
                                d="M7 16h6"
                            />

                        </svg>


                        <span class="text-xs sm:text-sm whitespace-nowrap">

                            Detail Transaksi

                        </span>

                    </button>

                </nav>

            </div>


            <!-- =================================================
                 TAB CONTENT
            ================================================== -->

            <div class="p-4 sm:p-6">


                <!-- =============================================
                     HISTORY PEMBAYARAN
                ============================================== -->

                <div
                    id="history-pembayaran"
                    class="tab-content"
                    role="tabpanel"
                >

                    @include(
                        'keuangan.bayar_calon_siswa.history_pembayaran'
                    )

                </div>


                <!-- =============================================
                     DETAIL TRANSAKSI
                ============================================== -->

                <div
                    id="detail-transaksi"
                    class="tab-content hidden"
                    role="tabpanel"
                >

                    @include(
                        'keuangan.bayar_calon_siswa.detail_transaksi'
                    )

                </div>

            </div>

        </div>

    </section>

</main>


<!-- =============================================================
     JAVASCRIPT
============================================================== -->

@include('keuangan.bayar_calon_siswa.js.history_js')

@include('keuangan.bayar_calon_siswa.js.detail_js')


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
               AKTIFKAN TAB
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
               TAMPILKAN CONTENT
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