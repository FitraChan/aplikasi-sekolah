<!-- Mobile Drawer Backdrop -->
<div id="sidebar-backdrop"
    class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden lg:hidden"
    aria-hidden="true">
</div>


<!-- SIDEBAR -->
<aside id="main-sidebar"
    class="fixed lg:static inset-y-0 left-0 z-50
           w-72 lg:w-64 h-screen
           flex flex-col shrink-0
           bg-white border-r border-slate-200
           overflow-hidden
           transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 ease-in-out"> <!-- ========================= -->
    <!-- TOP -->
    <!-- ========================= -->
    <div class="flex flex-col flex-1 min-h-0">
        <!-- BRAND -->
        <div class="shrink-0 px-2 pt-4 pb-6">
            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center">

                    <img src="{{ asset('public/images/Favicon_MOBIS_WARNA.png') }}"
                        alt="Logo"
                        class="w-8 h-8 object-contain">

                </div>

                <div>

                    <div class="font-extrabold text-lg text-slate-800 tracking-tight leading-none">
                        PPDB {{ date('Y') }}
                    </div>

                    <div class="text-xs text-slate-400 font-medium mt-1">
                        MOBIS (Mobile Information School)
                    </div>

                </div>

            </div>


            <!-- CLOSE MOBILE -->
            <button id="close-sidebar-btn"
                type="button"
                class="lg:hidden p-1.5 rounded-lg text-slate-400
                           hover:text-slate-600 hover:bg-slate-100 transition">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M6 18L18 6M6 6l12 12"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                    </path>

                </svg>

            </button>

        </div>


        <!-- ========================= -->
        <!-- NAVIGATION -->
        <!-- ========================= -->
        <nav aria-label="Menu Utama"
            class="flex-1 min-h-0 overflow-y-auto overflow-x-hidden overscroll-contain px-2 pb-4 space-y-1.5 sidebar-scroll">

            {{-- ========================================= --}}
            {{-- ROLE CALON --}}
            {{-- ========================================= --}}
            @if(Auth::user()->hasRole('calon'))

            <!-- CALON SISWA -->
            @php
            $side = $side ?? '';
            @endphp

            <a href="{{ route('calon-siswa.profil') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                    {{ $side == 'calon-siswa'
                        ? 'bg-[#00B686] text-white shadow-sm font-semibold'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}
                    transition-colors text-sm">

                <svg class="w-5 h-5 {{ $side == 'calon-siswa' ? 'text-white' : 'text-gray-500' }}"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>

                </svg>

                <span>Calon Siswa</span>

            </a>


            <!-- UJIAN -->
            <a href="{{ route('ujianCalon.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                          {{ $side == 'ujian'
                              ? 'bg-[#00B686] text-white shadow-sm font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}
                          transition-colors text-sm">

                <svg class="w-5 h-5 {{ $side == 'ujian' ? 'text-white' : 'text-gray-500' }}"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M9 5h6"></path>
                    <path d="M9 3h6a2 2 0 0 1 2 2v2H7V5a2 2 0 0 1 2-2Z"></path>
                    <rect x="4" y="7" width="16" height="14" rx="2"></rect>
                    <path d="m9 14 2 2 4-4"></path>

                </svg>

                <span>Ujian</span>

            </a>


            <!-- PENGUMUMAN -->
            <a href="{{ route('pengumumanCalon.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                          {{ $side == 'pengumumanCalon'
                              ? 'bg-[#00B686] text-white shadow-sm font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}
                          transition-colors text-sm">

                <svg class="w-5 h-5 {{ $side == 'pengumumanCalon' ? 'text-white' : 'text-gray-500' }}"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M4 4h16v16H4z"></path>
                    <path d="M8 8h8"></path>
                    <path d="M8 12h8"></path>
                    <path d="M8 16h5"></path>

                </svg>

                <span>Pengumuman</span>

            </a>


            <!-- PENGUMUMAN -->
            <a href="{{ route('pembayaranCalonSiswa') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                          {{ $side == 'pembayaranCalonSiswa'
                              ? 'bg-[#00B686] text-white shadow-sm font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}
                          transition-colors text-sm">

                <svg class="w-5 h-5 {{ $side == 'pembayaranCalonSiswa' ? 'text-white' : 'text-gray-500' }}"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <rect height="14" rx="2" width="20" x="2" y="5"></rect>
                    <line x1="2" x2="22" y1="10" y2="10"></line>

                </svg>

                <span>Pembayaran</span>

            </a>

            @endif


            {{-- ========================================= --}}
            {{-- ROLE ADMIN --}}
            {{-- ========================================= --}}
            @if(Auth::user()->hasRole('admin'))

            @php
            $side = $side ?? '';
            @endphp

            <!-- DASHBOARD -->
            <a href="{{ route('admin') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                          {{ $side == 'admin'
                              ? 'bg-[#00B686] text-white shadow-sm font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}
                          transition-colors text-sm">

                <svg class="w-5 h-5 {{ $side == 'admin' ? 'text-white' : 'text-gray-500' }}"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="m3 10 9-7 9 7"></path>
                    <path d="M5 9v11h14V9"></path>

                </svg>

                <span class="flex-1 text-left text-[16px] font-semibold">Dashboard</span>

            </a>


            <!-- MANAGEMENT ROLE -->
            <a href="{{ route('role.index') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                          {{ $side == 'role'
                              ? 'bg-[#00B686] text-white shadow-sm font-semibold'
                              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}
                          transition-colors text-sm">

                <svg class="w-5 h-5 {{ $side == 'role' ? 'text-white' : 'text-gray-500' }}"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7l-8-4Z"></path>
                    <path d="M9 12l2 2 4-4"></path>

                </svg>

                <span class="flex-1 text-left text-[16px] font-semibold">Management Role</span>

            </a>


            <!-- ======================= -->
            <!-- PENDAFTARAN -->
            <!-- ======================= -->

            @php
            $pendaftaranActive = in_array($side, [
            'gelombang',
            'tahun-ajaran',
            'calon-siswa',
            'set-kelas',
            'rekap_kelas',
            'daftar-siswa',
            'target',
            'broadcast',
            'ujian-calon-siswa',
            'bukti',
            'template-bayar-pendaftaran',
            'jadwal-wawancara',
            'hasil-wawancara',

            ]);
            @endphp

            <div>

                <button type="button"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                                   text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                   transition-colors font-medium text-sm"
                    onclick="toggleSidebarSubmenu('submenu-pendaftaran')">

                    <svg class="w-5 h-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                        <path d="M7 8h10"></path>
                        <path d="M7 12h10"></path>
                        <path d="M7 16h6"></path>

                    </svg>

                    <span class="flex-1 text-left text-[16px] font-semibold">
                        Pendaftaran
                    </span>

                    <svg id="icon-pendaftaran"
                        class="w-4 h-4 transition-transform
                                    {{ $pendaftaranActive ? 'rotate-180' : '' }}"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="m6 9 6 6 6-6"></path>

                    </svg>

                </button>


                <div id="submenu-pendaftaran"
                    class="pl-4 mt-1 space-y-1 {{ $pendaftaranActive ? '' : 'hidden' }}">

                    {{-- Gelombang --}}
                    <a href="{{ route('gelombang.index') }}"
                        class="sidebar-submenu {{ $side == 'gelombang' ? 'sidebar-submenu-active' : '' }}">
                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 12h18"></path>
                            <path d="M3 6h18"></path>
                            <path d="M3 18h18"></path>
                        </svg>
                        <span>Gelombang</span>
                    </a>

                    {{-- Tahun Ajaran --}}
                    <a href="{{ route('tahunAjaran.index') }}"
                        class="sidebar-submenu {{ $side == 'tahun-ajaran' ? 'sidebar-submenu-active' : '' }}">
                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="17" rx="2"></rect>
                            <path d="M16 2v4"></path>
                            <path d="M8 2v4"></path>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span>Tahun Ajaran</span>
                    </a>

                    {{-- Calon Siswa --}}
                    <a href="{{ route('calon-siswa.index') }}"
                        class="sidebar-submenu {{ $side == 'calon-siswa' ? 'sidebar-submenu-active' : '' }}">
                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="3"></circle>
                            <path d="M5 21c0-4 3-6 7-6s7 2 7 6"></path>
                        </svg>
                        <span>Calon Siswa</span>
                    </a>
                                   
                    {{-- Kuota Siswa --}}
                    <a href="{{ url('target') }}"
                        class="sidebar-submenu {{ $side == 'target' ? 'sidebar-submenu-active' : '' }}">
                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 3v18"></path>
                            <path d="M3 12h18"></path>
                            <circle cx="12" cy="12" r="8"></circle>
                        </svg>
                        <span>Kuota Siswa</span>
                    </a>

                    {{-- Broadcast --}}
                    <a href="{{ route('broadcast.index') }}"
                        class="sidebar-submenu {{ $side == 'broadcast' ? 'sidebar-submenu-active' : '' }}">
                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M3 11l18-5v12L3 13v-2Z"></path>
                            <path d="M11 15l1 5"></path>
                        </svg>
                        <span>Broadcast</span>
                    </a>

                    {{-- Ujian Calon Siswa --}}
                    <a href="{{ route('ujianCalonAdmin.index') }}"
                        class="sidebar-submenu {{ $side == 'ujian-calon-siswa' ? 'sidebar-submenu-active' : '' }}">
                        <svg class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="4" y="3" width="16" height="18" rx="2"></rect>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h4"></path>
                            <path d="m8 16 2 2 4-4"></path>
                        </svg>
                        <span>Ujian Calon Siswa</span>
                    </a>


                    {{-- Ujian Calon Siswa --}}
                   {{-- BUKTI PEMBAYARAN --}}
<a href="{{ route('listBuktiPembayaran') }}"
    class="sidebar-submenu {{ $side == 'bukti' ? 'sidebar-submenu-active' : '' }}">

    <svg class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        {{-- Credit Card --}}
        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
        <path d="M3 10h18"></path>
        <path d="M7 15h3"></path>

    </svg>

    <span>Bukti Pembayaran</span>
</a>


{{-- TEMPLATE PEMBAYARAN --}}
<a href="{{ route('templatePendaftaran.index') }}"
    class="sidebar-submenu {{ $side == 'template-bayar-pendaftaran' ? 'sidebar-submenu-active' : '' }}">

    <svg class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        {{-- Document --}}
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="8" y1="13" x2="16" y2="13"></line>
        <line x1="8" y1="17" x2="13" y2="17"></line>

    </svg>

    <span>Template Pembayaran</span>
</a>


{{-- JADWAL WAWANCARA --}}
<a href="{{ route('jadwal-wawancara.index') }}"
    class="sidebar-submenu {{ $side == 'jadwal-wawancara' ? 'sidebar-submenu-active' : '' }}">

    <svg class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        {{-- Calendar --}}
        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>

        {{-- Calendar date --}}
        <path d="M8 14h.01"></path>
        <path d="M12 14h.01"></path>
        <path d="M16 14h.01"></path>
        <path d="M8 18h.01"></path>
        <path d="M12 18h.01"></path>

    </svg>

    <span>Jadwal Wawancara</span>
</a>


{{-- HASIL WAWANCARA --}}
<a href="{{ route('hasilWawancara') }}"
    class="sidebar-submenu {{ $side == 'hasil-wawancara' ? 'sidebar-submenu-active' : '' }}">

    <svg class="w-4 h-4"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">

        {{-- Clipboard --}}
        <rect x="5" y="4" width="14" height="18" rx="2"></rect>

        {{-- Clipboard top --}}
        <path d="M9 4V2h6v2"></path>

        {{-- Checklist --}}
        <polyline points="8 10 9.5 11.5 12 9"></polyline>
        <line x1="13" y1="10" x2="16" y2="10"></line>

        <polyline points="8 15 9.5 16.5 12 14"></polyline>
        <line x1="13" y1="15" x2="16" y2="15"></line>

    </svg>

    <span>Hasil Wawancara</span>
</a>

                </div>

            </div>


            <!-- ======================= -->
            <!-- SISWA -->
            <!-- ======================= -->

            @php
            $siswaActive = in_array($side, [
            'siswa',
            'daftar-ulang',
            'siswa-baru',
            'set-kelas'
            ]);
            @endphp

            <div>

                <button type="button"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                                   text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                   transition-colors font-medium text-sm"
                    onclick="toggleSidebarSubmenu('submenu-siswa')">

                    <svg class="w-5 h-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <circle cx="9" cy="8" r="3"></circle>
                        <circle cx="17" cy="9" r="2"></circle>
                        <path d="M3 20c0-3 2.5-5 6-5s6 2 6 5"></path>
                        <path d="M15 15c3 0 5 2 5 5"></path>

                    </svg>

                    <span class="flex-1 text-left text-[16px] font-semibold">
                        Siswa
                    </span>

                    <svg id="icon-siswa"
                        class="w-4 h-4 transition-transform {{ $siswaActive ? 'rotate-180' : '' }}"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="m6 9 6 6 6-6"></path>

                    </svg>

                </button>



                <div id="submenu-siswa"
                    class="pl-4 mt-1 space-y-1 {{ $siswaActive ? '' : 'hidden' }}">

                    {{-- Siswa --}}
                    <a href="{{ route('siswa.index') }}"
                        class="sidebar-submenu flex items-center gap-2
               {{ $side == 'siswa' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-8a4 4 0 110 8 4 4 0 010-8zm6 4a3 3 0 10-6 0 3 3 0 006 0z" />

                        </svg>

                        <span>Siswa</span>

                    </a>



                    <a href="{{ route('daftarCalonSiswa') }}"
                        class="sidebar-submenu flex items-center gap-2
               {{ $side == 'daftar-ulang' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                            <circle cx="9"
                                cy="7"
                                r="4" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 8v6M22 11h-6" />

                        </svg>

                        <span>Calon Siswa</span>

                    </a>


                    {{-- Set Kelas --}}
                    <a href="{{ route('set-kelas.index') }}"
                        class="sidebar-submenu flex items-center gap-2
               {{ $side == 'set-kelas' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7l9-4 9 4-9 4-9-4z" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 12l9 4 9-4" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 17l9 4 9-4" />

                        </svg>

                        <span>Set Kelas</span>

                    </a>

                </div>


            </div>


            <!-- ======================= -->
            <!-- KEUANGAN -->
            <!-- ======================= -->

            @php
            $keuanganActive = in_array($side, [
            'kat-item-bayar',
            'kat-periode-bayar',
            'item-bayar',
            'template-bayar',
            'bayar',
            'bayar-calon-siswa'
            ]);
            @endphp

            <div>

                <button type="button"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                                   text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                   transition-colors font-medium text-sm"
                    onclick="toggleSidebarSubmenu('submenu-keuangan')">

                    <svg class="w-5 h-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                        <path d="M3 10h18"></path>
                        <path d="M7 15h4"></path>

                    </svg>

                    <span class="flex-1 text-left text-[16px] font-semibold">
                        Keuangan
                    </span>

                    <svg class="w-4 h-4 transition-transform {{ $keuanganActive ? 'rotate-180' : '' }}"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="m6 9 6 6 6-6"></path>

                    </svg>

                </button>



                <div id="submenu-keuangan"
                    class="pl-4 mt-1 space-y-1 {{ $keuanganActive ? '' : 'hidden' }}">

                    {{-- Kategori Item --}}
                    <a href="{{ route('kat-item-bayar.index') }}"
                        class="sidebar-submenu {{ $side == 'kat-item-bayar' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 5a3 3 0 016 0v0a3 3 0 01-6 0z" />

                        </svg>

                        <span>Kategori Item</span>

                    </a>


                    {{-- Kategori Periode --}}
                    <a href="{{ route('kat-periode-bayar.index') }}"
                        class="sidebar-submenu {{ $side == 'kat-periode-bayar' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7V3m8 4V3M5 11h14M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z" />

                        </svg>

                        <span>Kategori Periode</span>

                    </a>


                    {{-- Item Bayar --}}
                    <a href="{{ route('item-bayar.index') }}"
                        class="sidebar-submenu {{ $side == 'item-bayar' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 14l2 2 4-4" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                        </svg>

                        <span>Item Bayar</span>

                    </a>


                    {{-- Template Bayar --}}
                    <a href="{{ route('template-bayar.index') }}"
                        class="sidebar-submenu {{ $side == 'template-bayar' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 4h16v16H4z" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 8h8M8 12h8M8 16h5" />

                        </svg>

                        <span>Template Bayar</span>

                    </a>


                    {{-- Pembayaran --}}
                    <a href="{{ route('bayar.index') }}"
                        class="sidebar-submenu {{ $side == 'bayar' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7h18M5 7V5a2 2 0 012-2h10a2 2 0 012 2v2M5 7v12a2 2 0 002 2h10a2 2 0 002-2V7" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 12h8" />

                        </svg>

                        <span>Pembayaran</span>

                    </a>


                    {{-- Bayar Calon Siswa --}}
                    <a href="{{ route('bayar-calon-siswa.index') }}"
                        class="sidebar-submenu {{ $side == 'bayar-calon-siswa' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                            <circle cx="9"
                                cy="7"
                                r="4" />

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 8v6M22 11h-6" />

                        </svg>

                        <span>Bayar Calon Siswa</span>

                    </a>

                </div>



            </div>


            <!-- ======================= -->
            <!-- AKADEMIK -->
            <!-- ======================= -->

            @php
            $akademikActive = in_array($side, [
            'kelas',
            'jurusan',
            'tahun-ajaran',
            'mapel',
            'master-jadwal',
            'nilai',
            'absensi',
            'soal',
            'pengumuman'
            ]);
            @endphp

            <div>

                <button type="button"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                                   text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                   transition-colors font-medium text-sm"
                    onclick="toggleSidebarSubmenu('submenu-akademik')">

                    <svg class="w-5 h-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="M3 6h18"></path>
                        <path d="M5 6v13h14V6"></path>
                        <path d="M8 3h8v3H8z"></path>

                    </svg>

                    <span class="flex-1 text-left text-[16px] font-semibold">
                        Akademik
                    </span>

                    <svg class="w-4 h-4 transition-transform {{ $akademikActive ? 'rotate-180' : '' }}"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="m6 9 6 6 6-6"></path>

                    </svg>

                </button>



                <div id="submenu-akademik"
                    class="pl-4 mt-1 space-y-1 {{ $akademikActive ? '' : 'hidden' }}">

                    {{-- Kelas --}}
                    <a href="{{ route('kelas.index') }}"
                        class="sidebar-submenu {{ $side == 'kelas' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7l9-4 9 4-9 4-9-4z" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 10v6c0 1.5 3.1 3 7 3s7-1.5 7-3v-6" />
                        </svg>

                        <span>Kelas</span>

                    </a>


                    {{-- Jurusan --}}
                    <a href="{{ route('jurusan.index') }}"
                        class="sidebar-submenu {{ $side == 'jurusan' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 21V5a2 2 0 012-2h12a2 2 0 012 2v16" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7h8M8 11h8M8 15h5" />
                        </svg>

                        <span>Jurusan</span>

                    </a>


                    {{-- Tahun Ajaran --}}
                    <a href="{{ route('tahunAjaran.index') }}"
                        class="sidebar-submenu {{ $side == 'tahun-ajaran' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 3v4M16 3v4M4 9h16" />
                            <rect x="4"
                                y="5"
                                width="16"
                                height="16"
                                rx="2" />
                        </svg>

                        <span>Tahun Ajaran</span>

                    </a>


                    {{-- Mata Pelajaran --}}
                    <a href="{{ route('mapel.index') }}"
                        class="sidebar-submenu {{ $side == 'mapel' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 5a2 2 0 012-2h10a2 2 0 012 2v16H6a2 2 0 01-2-2V5z" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 7h6M8 11h6M8 15h4" />
                        </svg>

                        <span>Mata Pelajaran</span>

                    </a>


                    {{-- Penjadwalan --}}
                    <a href="{{ route('master-jadwal.index') }}"
                        class="sidebar-submenu {{ $side == 'master-jadwal' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 3v4M16 3v4M4 9h16" />
                            <rect x="4"
                                y="5"
                                width="16"
                                height="16"
                                rx="2" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 13h3M8 17h6" />
                        </svg>

                        <span>Penjadwalan</span>

                    </a>


                    {{-- Nilai --}}
                    <a href="{{ route('nilai.index') }}"
                        class="sidebar-submenu {{ $side == 'nilai' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 19V5" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 19h16" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 16v-5M12 16V8M16 16v-3" />
                        </svg>

                        <span>Nilai</span>

                    </a>


                    {{-- Absensi --}}
                    <a href="{{ route('absensi.index') }}"
                        class="sidebar-submenu {{ $side == 'absensi' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12"
                                cy="8"
                                r="4" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 21a7 7 0 0114 0" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 12l2 2 4-4" />
                        </svg>

                        <span>Absensi</span>

                    </a>


                    {{-- Soal Ujian --}}
                    <a href="{{ route('soal.index') }}"
                        class="sidebar-submenu {{ $side == 'soal' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 8h8M8 12h5" />
                            <circle cx="16"
                                cy="16"
                                r="2" />
                        </svg>

                        <span>Soal Ujian</span>

                    </a>


                    {{-- Pengumuman --}}
                    <a href="{{ route('pengumuman.index') }}"
                        class="sidebar-submenu {{ $side == 'pengumuman' ? 'sidebar-submenu-active' : '' }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 11v2a2 2 0 002 2h2l3 5h3l-2-5h3l5 3V6l-5 3H7a4 4 0 00-4 4z" />
                        </svg>

                        <span>Pengumuman</span>

                    </a>

                </div>



            </div>



             @php 
                    $guruActive = in_array($side, [ 'master-guru', ]); 
            @endphp 
            <div> 
                {{-- Menu Guru --}}
                <button type="button" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors font-medium text-sm" onclick="toggleSidebarSubmenu('submenu-guru')">
                    {{-- Icon Guru --}}
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">

                        <circle cx="9" cy="8" r="3"></circle>
                        <path d="M3 20c0-3 2.5-5 6-5s6 2 6 5"></path>
                        <path d="M16 11h5"></path>
                        <path d="M18.5 8.5v5"></path>
                    </svg>
                    <span class="flex-1 text-left text-[16px] font-semibold"> Guru </span> 
                    {{-- Arrow --}} 
                    <svg id="icon-guru" class="w-4 h-4 transition-transform {{ $guruActive ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg> </button> {{-- Submenu Guru --}}
                <div id="submenu-guru" class="pl-4 mt-1 space-y-1 {{ $guruActive ? '' : 'hidden' }}"> {{-- Master Guru --}} 
                    <a href="{{ route('masterGuru.index') }}" class="sidebar-submenu flex items-center gap-2 {{ $side == 'master-guru' ? 'sidebar-submenu-active' : '' }}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 3.5a4 4 0 010 7.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21v-2a4 4 0 00-3-3.87" />
                        </svg> <span>Master Guru</span>
                    </a>
                </div>
            </div>
            @endif


            {{-- ========================================= --}}
            {{-- ROLE GURU --}}
            {{-- ========================================= --}}
            @if(Auth::user()->hasRole('guru'))

            @php
            $pengajaranActive = in_array($side, [
            'pbm',
            'jadwalGuru',
            'ujianGuru',
            'soalGuru'
            ]);
            @endphp

            <div>

                <button type="button"
                    class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-lg
                                   text-gray-600 hover:bg-gray-50 hover:text-gray-900
                                   transition-colors font-medium text-sm"
                    onclick="toggleSidebarSubmenu('submenu-pengajaran')">

                    <svg class="w-5 h-5 text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="M4 5h16v14H4z"></path>
                        <path d="M8 9h8"></path>
                        <path d="M8 13h5"></path>

                    </svg>

                    <span class="flex-1 text-left">
                        Pengajaran
                    </span>

                    <svg class="w-4 h-4 transition-transform {{ $pengajaranActive ? 'rotate-180' : '' }}"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path d="m6 9 6 6 6-6"></path>

                    </svg>

                </button>


                <div id="submenu-pengajaran"
                    class="pl-4 mt-1 space-y-1 {{ $pengajaranActive ? '' : 'hidden' }}">

                    <a href="{{ route('pbm.index') }}"
                        class="sidebar-submenu {{ $side == 'pbm' ? 'sidebar-submenu-active' : '' }}">
                        <span>PBM</span>
                    </a>

                    <a href="{{ route('jadwalGuru.index') }}"
                        class="sidebar-submenu {{ $side == 'jadwalGuru' ? 'sidebar-submenu-active' : '' }}">
                        <span>Jadwal</span>
                    </a>

                    <a href="{{ route('ujianGuru.index') }}"
                        class="sidebar-submenu {{ $side == 'ujianGuru' ? 'sidebar-submenu-active' : '' }}">
                        <span>Ujian</span>
                    </a>

                    <a href="{{ route('soalGuru.index') }}"
                        class="sidebar-submenu {{ $side == 'soalGuru' ? 'sidebar-submenu-active' : '' }}">
                        <span>Master Soal</span>
                    </a>

                </div>

            </div>

           

            @endif

        </nav>

    </div>


    <!-- ========================= -->
    <!-- BOTTOM -->
    <!-- ========================= -->

    <div class="space-y-2 pt-6 border-t border-gray-100">

        <!-- HELP -->
        <a href="#"
            class="flex items-center gap-3 px-3.5 py-2 rounded-lg
                  text-gray-600 hover:bg-gray-50 hover:text-gray-900
                  transition-colors font-medium text-sm">

            <svg class="w-5 h-5 text-gray-500"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <circle cx="12" cy="12" r="9"></circle>
                <path d="M9.5 9a2.5 2.5 0 1 1 4 2c-1 0-1.5 1-1.5 2"></path>
                <circle cx="12" cy="17" r=".5"></circle>

            </svg>

            <span>Help Center</span>

        </a>


        <!-- LOGOUT -->
        <a href="{{ route('logout') }}"
            class="flex items-center gap-3 px-3.5 py-2 rounded-lg
                  text-gray-600 hover:text-red-600 hover:bg-slate-50
                  transition-colors font-medium text-sm">

            <svg class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                viewBox="0 0 24 24">

                <path d="M10 17l5-5-5-5"></path>
                <path d="M15 12H3"></path>
                <path d="M21 4v16"></path>

            </svg>

            <span>Logout</span>

        </a>

    </div>

</aside>



<style>
    .sidebar-submenu {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 10px 12px;

        /* TULISAN DIPERBESAR */
        font-size: 15px;
        font-weight: 500;

        color: #334155;

        border-radius: 10px;

        transition: all 0.2s ease;
    }

    .sidebar-submenu:hover {
        background: #f8fafc;
        color: #00a878;
    }

    .sidebar-submenu:hover svg {
        color: #00a878;
    }

    .sidebar-submenu-active {
        background: #ecfdf5;
        color: #00a878 !important;
        font-weight: 600;
    }

    .sidebar-submenu-active svg {
        color: #00a878;
    }

    .sidebar-submenu svg {
        flex-shrink: 0;
        width: 17px;
        height: 17px;
    }
</style>


<!-- SIDEBAR SCRIPT -->
<script>
    /* =====================================================
       SIDEBAR SUBMENU
    ===================================================== */
    function toggleSidebarSubmenu(id) {

        const submenu = document.getElementById(id);

        if (!submenu) {
            return;
        }

        submenu.classList.toggle('hidden');

        const icon = document.querySelector(
            `button[onclick="toggleSidebarSubmenu('${id}')"] svg:last-child`
        );

        if (icon) {
            icon.classList.toggle('rotate-180');
        }
    }


    /* =====================================================
       MOBILE SIDEBAR DRAWER
    ===================================================== */
    document.addEventListener('DOMContentLoaded', function () {

        const sidebar = document.getElementById('main-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const closeBtn = document.getElementById('close-sidebar-btn');

        if (!sidebar) {
            return;
        }

        /* -----------------------------------------------
           OPEN SIDEBAR
        ------------------------------------------------ */
        window.openSidebar = function () {

            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');

            if (backdrop) {
                backdrop.classList.remove('hidden');
            }

            document.body.classList.add('overflow-hidden');
        };


        /* -----------------------------------------------
           CLOSE SIDEBAR
        ------------------------------------------------ */
        window.closeSidebar = function () {

            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');

            if (backdrop) {
                backdrop.classList.add('hidden');
            }

            document.body.classList.remove('overflow-hidden');
        };


        /* -----------------------------------------------
           TOMBOL X
        ------------------------------------------------ */
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                closeSidebar();
            });
        }


        /* -----------------------------------------------
           KLIK BACKDROP
        ------------------------------------------------ */
        if (backdrop) {
            backdrop.addEventListener('click', function () {
                closeSidebar();
            });
        }


        /* -----------------------------------------------
           ESC UNTUK MENUTUP
        ------------------------------------------------ */
        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                closeSidebar();
            }
        });


        /* -----------------------------------------------
           KLIK MENU -> TUTUP DI MOBILE
        ------------------------------------------------ */
        sidebar.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function () {

                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });


        /* -----------------------------------------------
           RESIZE DESKTOP / MOBILE
        ------------------------------------------------ */
        window.addEventListener('resize', function () {

            if (window.innerWidth >= 1024) {

                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');

                if (backdrop) {
                    backdrop.classList.add('hidden');
                }

                document.body.classList.remove('overflow-hidden');

            } else {

                /*
                 * Pada mobile sidebar default tertutup.
                 * Jangan menutup jika sedang terbuka.
                 */
                if (!sidebar.classList.contains('translate-x-0')) {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });

    });
</script>