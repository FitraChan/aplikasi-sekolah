<!DOCTYPE html>
<!--
Template Name: Tinker - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('public/dist/images/open.png')}}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">

    <style>
        .tabulator-cell {
            white-space: normal !important;
            word-break: break-word;
            overflow: visible !important;
        }

        .tabulator-row {
            min-height: 60px;
        }

        .tabulator-row.tabulator-selected {
            background-color: #dbeafe !important;
        }

        .tabulator-row.tabulator-selected:hover {
            background-color: #bfdbfe !important;
        }

        .sidebar-mini .side-menu__title {
            display: none;
        }

        .sidebar-mini .side-menu {
            justify-content: center;
        }

        .sidebar-mini .side-menu__icon {
            margin-right: 0 !important;
        }

        .sidebar-mini .side-nav {
            width: 70px !important;
        }
    </style>
    <title>@yield('tittle')</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('public/dist/css/app.css')}}" />

    <link href="https://unpkg.com/tabulator-tables@6.2.5/dist/css/tabulator.min.css" rel="stylesheet">
    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/ckfinder/ckfinder.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@6.2.5/dist/js/tabulator.min.js"></script>
    <!-- END: CSS Assets-->

    {{-- tabulator --}}




    {{-- sweatalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>
<!-- END: Head -->

<body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
    @if (empty($side))
    @php
    $side = '';
    @endphp
    @endif
    @if (empty($drop_down))
    @php
    $drop_down = '';
    @endphp
    @endif
    <!-- BEGIN: Mobile Menu -->


    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Midone - HTML Admin Template" class="w-6" src="{{asset('public/dist/images/open.png')}}">
            </a>
            <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <div class="scrollable">
            <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            <ul class="scrollable__content py-2">
                <li>
                    <a href="{{route('admin')}}" class=menu {{$side == 'admin'? 'menu--active':''}}">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title"> Dashboard</div>
                    </a>
                </li>
                @if(Auth::user()->hasRole('admin'))
                <li>
                    <a href="{{ route('role.index') }}" class="menu {{ $side == 'role' ? 'menu--active' : '' }}">

                        <div class="menu__icon">
                            <i data-lucide="shield"></i>
                        </div>

                        <div class="menu__title">
                            Management Role
                        </div>

                    </a>
                </li>


              

                @endif



                @if(Auth::user()->hasAnyRole(['admin', 'Akademik']))
                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="menu__title">
                            Pendaftaran
                            <div class="menu__sub-icon {{ in_array($side, ['gelombang', 'calon-siswa','target','set-kelas','rekap_kelas','daftar-siswa','ujian-calon-siswa']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['gelombang','tahun-ajaran', 'calon-siswa','target','set-kelas','rekap_kelas','daftar-siswa','ujian-calon-siswa']) ? 'menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('gelombang.index') }}" class="menu {{ $side == 'gelombang' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="menu__title"> Gelombang </div>
                            </a>
                        </li>

                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('tahunAjaran.index') }}" class="menu {{ $side == 'tahun-ajaran' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="menu__title"> Tahun Ajaran </div>
                            </a>
                        </li>

                        

                        <li>
                            <a href="{{ route('calon-siswa.index') }}"
                                class="menu {{ $side == 'calon-siswa' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="users"></i>
                                </div>

                                <div class="menu__title">
                                    Calon Siswa
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('set-kelas.index') }}"
                                class="menu {{ $side == 'set-kelas' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="file-text"></i>
                                </div>

                                <div class="menu__title">
                                    Set Kelas
                                </div>

                            </a>
                        </li>


                        <li>
                            <a href="{{ url('rekapKelas') }}"
                                class="menu {{ $side == 'rekap_kelas' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="clipboard"></i>
                                </div>

                                <div class="menu__title">
                                    Rekap Kelas
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ url('daftarSiswa') }}"
                                class="menu {{ $side == 'daftar-siswa' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="archive"></i>
                                </div>

                                <div class="menu__title">
                                    Daftar Siswa
                                </div>

                            </a>
                        </li>


                        <li>
                            <a href="{{ url('target') }}"
                                class="menu {{ $side == 'target' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="user-check"></i>
                                </div>

                                <div class="menu__title">
                                    Kuota Siswa
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('broadcast.index') }}"
                                class="menu {{ $side == 'broadcast' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="book-open"></i>
                                </div>

                                <div class="menu__title">
                                    Broadcast
                                </div>

                            </a>
                        </li>



                        <li>
                            <a href="{{ route('ujianCalonAdmin.index') }}"
                                class="menu {{ $side == 'ujian-calon-siswa' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="clipboard"></i>
                                </div>

                                <div class="menu__title">
                                    Ujian Calon Siswa
                                </div>

                            </a>
                        </li>


                        <!-- Anda bisa menambah sub-menu lain di bawah ini jika diperlukan di masa depan -->
                    </ul>
                </li>

                @endif

                @if(Auth::user()->hasRole('guru'))
                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="menu__title">
                            Pengajaran
                            <div class="menu__sub-icon {{ in_array($side, ['pbm', 'jadwalGuru','ujianGuru','soalGuru']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['pbm','jadwalGuru','ujianGuru','soalGuru']) ? 'menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('pbm.index') }}" class="menu {{ $side == 'pbm' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="menu__title"> PBM </div>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('jadwalGuru.index') }}" class="menu {{ $side == 'jadwalGuru' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="map"></i> </div>
                                <div class="menu__title"> Jadwal </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('ujianGuru.index') }}" class="menu {{ $side == 'ujianGuru' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="pen-tool"></i> </div>
                                <div class="menu__title"> Ujian </div>
                            </a>
                        </li>   


                          <li>
                            <a href="{{ route('soalGuru.index') }}" class="menu {{ $side == 'soalGuru' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="monitor"></i> </div>
                                <div class="menu__title">Master Soal </div>
                            </a>
                        </li>   


                    </ul>
                </li>
                @endif

                @if(Auth::user()->hasRole('admin'))

                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="sun"></i> </div>
                        <div class="menu__title">
                            Siswa
                            <div class="menu__sub-icon {{ in_array($side, ['siswa','daftar-ulang','siswa-baru']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['siswa','daftar-ulang','siswa-baru']) ? 'menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('siswa.index') }}" class="menu {{ $side == 'siswa' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="coffee"></i> </div>
                                <div class="menu__title"> Siswa </div>
                            </a>
                        </li>

                         <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('daftarCalonSiswa') }}" class="menu {{ $side == 'daftar-ulang' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="coffee"></i> </div>
                                <div class="menu__title"> Calon Siswa </div>
                            </a>
                        </li>
                         <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('set-kelas.index') }}" class="menu {{ $side == 'set-kelas' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="coffee"></i> </div>
                                <div class="menu__title"> Set Kelas </div>
                            </a>
                        </li>


                      
                    </ul>
                <li>        

                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="gift"></i> </div>
                        <div class="menu__title">
                            Keuangan
                            <div class="menu__sub-icon {{ in_array($side, ['kat-item-bayar', 'kat-periode-bayar', 'item-bayar', 'template-bayar', 'bayar','bayar-calon-siswa']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['kat-item-bayar','kat-periode-bayar','item-bayar','template-bayar','bayar','bayar-calon-siswa']) ? 'menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('kat-item-bayar.index') }}" class="menu {{ $side == 'kat-item-bayar' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="menu__title"> Kategori Item </div>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('kat-periode-bayar.index') }}"
                                class="menu {{ $side == 'kat-periode-bayar' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="calendar"></i>
                                </div>

                                <div class="menu__title">
                                    Kategori Periode
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('item-bayar.index') }}"
                                class="menu {{ $side == 'item-bayar' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="credit-card"></i>
                                </div>

                                <div class="menu__title">
                                    Item Bayar
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('template-bayar.index') }}"
                                class="menu {{ $side == 'template-bayar' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="file-text"></i>
                                </div>

                                <div class="menu__title">
                                    Template Bayar
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bayar.index') }}"
                                class="menu {{ $side == 'bayar' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="credit-card"></i>
                                </div>

                                <div class="menu__title">
                                    Pembayaran
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bayar-calon-siswa.index') }}"
                                class="menu {{ $side == 'bayar-calon-siswa' ? 'menu--active' : '' }}">

                                <div class="menu__icon">
                                    <i data-lucide="umbrella"></i>
                                </div>

                                <div class="menu__title">
                                    Bayar Calon Siswa
                                </div>

                            </a>
                        </li>



                    </ul>
                </li>


                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="menu__title">
                            Akademik
                            <div class="menu__sub-icon {{ in_array($side, ['kelas','jurusan','tahun-ajaran','mapel','master-jadwal','nilai','absensi','soal','pengumuman']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['kelas','jurusan','mapel','master-jadwal','tahun-ajaran','nilai','absensi','soal','pengumuman']) ? 'menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('kelas.index') }}" class="menu {{ $side == 'kelas' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="hard-drive"></i> </div>
                                <div class="menu__title"> Kelas </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('jurusan.index') }}" class="menu {{ $side == 'jurusan' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="credit-card"></i> </div>
                                <div class="menu__title"> Jurusan </div>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('tahunAjaran.index') }}" class="menu {{ $side == 'tahun-ajaran' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="menu__title"> Tahun Ajaran </div>
                            </a>
                        </li>



                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('mapel.index') }}" class="menu {{ $side == 'mapel' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="credit-card"></i> </div>
                                <div class="menu__title"> Mata Pelajaran </div>
                            </a>
                        </li>


                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('master-jadwal.index') }}" class="menu {{ $side == 'master-jadwal' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="credit-card"></i> </div>
                                <div class="menu__title"> Penjadwalan </div>
                            </a>
                        </li>

                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('nilai.index') }}" class="menu {{ $side == 'nilai' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="credit-card"></i> </div>
                                <div class="menu__title"> Nilai </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('absensi.index') }}" class="menu {{ $side == 'absensi' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="users"></i> </div>
                                <div class="menu__title"> Absensi </div>
                            </a>
                        </li>



                        <li>
                            <a href="{{ route('soal.index') }}" class="menu {{ $side == 'soal' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="menu__title"> Soal Ujian </div>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('pengumuman.index') }}" class="menu {{ $side == 'pengumuman' ? 'menu--active' : '' }}">
                                <div class="menu__icon"> <i data-lucide="clipboard"></i> </div>
                                <div class="menu__title"> Pengumuman </div>
                            </a>
                        </li>




                    </ul>
                </li>


                @endif

                @if(Auth::user()->hasRole('calon'))
                <li>
                    <a href="{{  route('calon-siswa.profil') }}" class="menu {{$side == 'calon-siswa'? 'menu--active':''}}">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title"> Calon Siswa</div>
                    </a>
                </li>


                 <li>
                    <a href="{{  route('ujianCalon.index') }}" class="menu {{$side == 'ujian'? 'menu--active':''}}">
                        <div class="menu__icon"> <i data-lucide="clipboard"></i> </div>
                        <div class="menu__title"> Ujian</div>
                    </a>
                </li>


                <li>
                    <a href="{{  route('pengumumanCalon.index') }}" class="menu {{$side == 'pengumumanCalon'? 'menu--active':''}}">
                        <div class="menu__icon"> <i data-lucide="shield"></i> </div>
                        <div class="menu__title"> Pengumuman</div>
                    </a>
                </li>


                @endif
            </ul>
        </div>
    </div>


    <!-- END: Mobile Menu -->
    <div class="flex mt-[4.7rem] md:mt-0 overflow-hidden">
        <!-- BEGIN: Side Menu -->
        <nav id="sidebar" class="side-nav">

            <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
                <img alt="Midone - HTML Admin Template" class="w-6" src="{{asset('public/dist/images/open.png')}}">
                <span class="hidden xl:block text-white text-lg ml-3"> OPEN SCHOOL </span>


            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>

                <li>
                    <a href="{{route('admin')}}" class="side-menu {{$side == 'admin'? 'side-menu--active':''}}">
                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="side-menu__title"> Dashboard</div>
                    </a>
                </li>
                @if(Auth::user()->hasRole('admin'))
                <li>
                    <a href="{{ route('role.index') }}" class="side-menu {{ $side == 'role' ? 'side-menu--active' : '' }}">

                        <div class="side-menu__icon">
                            <i data-lucide="shield"></i>
                        </div>

                        <div class="side-menu__title">
                            Management Role
                        </div>

                    </a>
                </li>


             

                @endif



                @if(Auth::user()->hasRole('guru'))
                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Pengajaran
                            <div class="side-menu__sub-icon {{ in_array($side, ['pbm','jadwalGuru','ujianGuru','soalGuru']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-side-menu Wrapper -->
                    <ul class="{{ in_array($side, ['pbm','jadwalGuru','ujianGuru','soalGuru']) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('pbm.index') }}" class="side-menu {{ $side == 'pbm' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> PBM </div>
                            </a>
                        </li>

                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('jadwalGuru.index') }}" class="side-menu {{ $side == 'jadwalGuru' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="map"></i> </div>
                                <div class="side-menu__title"> Jadwal </div>
                            </a>
                        </li>

                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('ujianGuru.index') }}" class="side-menu {{ $side == 'ujianGuru' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="pen-tool"></i> </div>
                                <div class="side-menu__title"> Ujian </div>
                            </a>
                        </li>    
                        
                        
                          <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('soalGuru.index') }}" class="side-menu {{ $side == 'soalGuru' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                                <div class="side-menu__title"> Master Soal </div>
                            </a>
                        </li>  


                    </ul>
                </li>
                @endif



                @if(Auth::user()->hasAnyRole(['admin', 'Akademik']))
                <li>
                    <!-- Indikator 'side-menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Pendaftaran
                            <div class="side-menu__sub-icon {{ in_array($side, ['gelombang', 'tahun-ajaran','calon-siswa','set-kelas','rekap_kelas','daftar-siswa','target','ujian-calon-siswa']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['gelombang','tahun-ajaran', 'calon-siswa','set-kelas','rekap_kelas','daftar-siswa','target','ujian-calon-siswa']) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('gelombang.index') }}" class="side-menu {{ $side == 'gelombang' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Gelombang </div>
                            </a>
                        </li>

                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('tahunAjaran.index') }}" class="side-menu {{ $side == 'tahun-ajaran' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Tahun Ajaran </div>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('calon-siswa.index') }}"
                                class="side-menu {{ $side == 'calon-siswa' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="users"></i>
                                </div>

                                <div class="side-menu__title">
                                    Calon Siswa
                                </div>

                            </a>
                        </li>

                        


                        <li>
                            <a href="{{ url('rekapKelas') }}"
                                class="side-menu {{ $side == 'rekap_kelas' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="clipboard"></i>
                                </div>

                                <div class="side-menu__title">
                                    Rekap Kelas
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ url('daftarSiswa') }}"
                                class="side-menu {{ $side == 'daftar-siswa' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="archive"></i>
                                </div>

                                <div class="side-menu__title">
                                    Daftar Siswa
                                </div>

                            </a>
                        </li>


                        <li>
                            <a href="{{ url('target') }}"
                                class="side-menu {{ $side == 'target' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="user-check"></i>
                                </div>

                                <div class="side-menu__title">
                                    Kuota Siswa
                                </div>

                            </a>
                        </li>


                        <li>
                            <a href="{{ route('broadcast.index') }}"
                                class="side-menu {{ $side == 'broadcast' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="book-open"></i>
                                </div>

                                <div class="side-menu__title">
                                    Broadcast
                                </div>

                            </a>
                        </li>



                          <li>
                            <a href="{{ route('ujianCalonAdmin.index') }}"
                                class="side-menu {{ $side == 'ujian-calon-siswa' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="clipboard"></i>
                                </div>

                                <div class="side-menu__title">
                                    Ujian Calon Siswa
                                </div>

                            </a>
                        </li>
                        <!-- Anda bisa menambah sub-menu lain di bawah ini jika diperlukan di masa depan -->
                    </ul>
                </li>

                @endif

                @if(Auth::user()->hasRole('admin'))

                   <li>
                    <!-- Indikator 'side-menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="sun"></i> </div>
                        <div class="side-menu__title">
                            Siswa
                            <div class="side-menu__sub-icon {{ in_array($side, ['siswa','set-kelas','daftar-ulang','siswa-baru']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['siswa','set-kelas','daftar-ulang','siswa-baru']) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('siswa.index') }}" class="side-menu {{ $side == 'siswa' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="coffee"></i> </div>
                                <div class="side-menu__title"> Siswa </div>
                            </a>
                        </li>
                        <li>
                                <a href="{{ route('daftarCalonSiswa') }}"
                                    class="side-menu {{ $side == 'daftar-ulang' ? 'side-menu--active' : '' }}">

                                    <div class="side-menu__icon">
                                        <i data-lucide="users"></i>
                                    </div>

                                    <div class="side-menu__title">
                                        Calon Siswa
                                    </div>

                                </a>
                        </li>

                        <li>
                            <a href="{{ route('set-kelas.index') }}"
                                class="side-menu {{ $side == 'set-kelas' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="file-text"></i>
                                </div>

                                <div class="side-menu__title">
                                    Set Kelas
                                </div>

                            </a>
                        </li>

                        


                

                    </ul>   
                   </li>

                <li>
                    <!-- Indikator 'side-menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="gift"></i> </div>
                        <div class="side-menu__title">
                            Keuangan
                            <div class="side-menu__sub-icon {{ in_array($side, ['kat-item-bayar', 'kat-periode-bayar', 'item-bayar', 'template-bayar', 'bayar','bayar-calon-siswa']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-Menu Wrapper -->
                    <ul class="{{ in_array($side, ['kat-item-bayar','kat-periode-bayar','item-bayar','template-bayar','bayar','bayar-calon-siswa']) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-Menu Gelombang -->
                            <a href="{{ route('kat-item-bayar.index') }}" class="side-menu {{ $side == 'kat-item-bayar' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Kategori Item </div>
                            </a>
                        </li>


                        <li>
                            <a href="{{ route('kat-periode-bayar.index') }}"
                                class="side-menu {{ $side == 'kat-periode-bayar' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="calendar"></i>
                                </div>

                                <div class="side-menu__title">
                                    Kategori Periode
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('item-bayar.index') }}"
                                class="side-menu {{ $side == 'item-bayar' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="credit-card"></i>
                                </div>

                                <div class="side-menu__title">
                                    Item Bayar
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('template-bayar.index') }}"
                                class="side-menu {{ $side == 'template-bayar' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="file-text"></i>
                                </div>

                                <div class="side-menu__title">
                                    Template Bayar
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bayar.index') }}"
                                class="side-menu {{ $side == 'bayar' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="dollar-sign"></i>
                                </div>

                                <div class="side-menu__title">
                                    Pembayaran
                                </div>

                            </a>
                        </li>

                        <li>
                            <a href="{{ route('bayar-calon-siswa.index') }}"
                                class="side-menu {{ $side == 'bayar-calon-siswa' ? 'side-menu--active' : '' }}">

                                <div class="side-menu__icon">
                                    <i data-lucide="umbrella"></i>
                                </div>

                                <div class="side-menu__title">
                                    Bayar Calon Siswa
                                </div>

                            </a>
                        </li>



                    </ul>
                </li>

                <li>
                    <!-- Indikator 'menu--active' dipasang di menu utama jika salah satu sub-menunya sedang aktif -->
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                        <div class="side-menu__title">
                            Akademik
                            <div class="side-menu__sub-icon {{ in_array($side, ['kelas','tahun-ajaran','jurusan','mapel','master-jadwal','nilai','absensi','soal','pengumuman']) ? 'transform rotate-180' : '' }}">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <!-- Sub-side-menu Wrapper -->
                    <ul class="{{ in_array($side, ['kelas','jurusan','mapel','tahun-ajaran','master-jadwal','nilai','absensi','soal','pengumuman']) ? 'side-menu__sub-open' : '' }}">
                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('kelas.index') }}" class="side-menu {{ $side == 'kelas' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                                <div class="side-menu__title"> Kelas </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jurusan.index') }}" class="side-menu {{ $side == 'jurusan' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="credit-card"></i> </div>
                                <div class="side-menu__title"> Jurusan </div>
                            </a>
                        </li>


                         <li>
                            <a href="{{ route('tahunAjaran.index') }}" class="side-menu {{ $side == 'tahun-ajaran' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Tahun Ajaran </div>
                            </a>
                        </li>



                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('mapel.index') }}" class="side-menu {{ $side == 'mapel' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="credit-card"></i> </div>
                                <div class="side-menu__title"> Mata Pelajaran </div>
                            </a>
                        </li>


                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('master-jadwal.index') }}" class="side-menu {{ $side == 'master-jadwal' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="file-text"></i> </div>
                                <div class="side-menu__title"> Penjadwalan </div>
                            </a>
                        </li>


                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('nilai.index') }}" class="side-menu {{ $side == 'nilai' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Nilai </div>
                            </a>
                        </li>


                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('absensi.index') }}" class="side-menu {{ $side == 'absensi' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                                <div class="side-menu__title"> Absensi </div>
                            </a>
                        </li>


                        <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('soal.index') }}" class="side-menu {{ $side == 'soal' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                <div class="side-menu__title"> Soal </div>
                            </a>
                        </li>


                         <li>
                            <!-- Sub-side-menu Gelombang -->
                            <a href="{{ route('pengumuman.index') }}" class="side-menu {{ $side == 'pengumuman' ? 'side-menu--active' : '' }}">
                                <div class="side-menu__icon"> <i data-lucide="clipboard"></i> </div>
                                <div class="side-menu__title"> Pengumuman </div>
                            </a>
                        </li>






                    </ul>
                </li>


                @endif

                @if(Auth::user()->hasRole('calon'))
                <li>
                    <a href="{{  route('calon-siswa.profil') }}" class="side-menu {{$side == 'calon-siswa'? 'side-menu--active':''}}">
                        <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="side-menu__title"> Calon Siswa</div>
                    </a>
                </li>


                 <li>
                    <a href="{{  route('ujianCalon.index') }}" class="side-menu {{$side == 'ujian'? 'side-menu--active':''}}">
                        <div class="side-menu__icon"> <i data-lucide="clipboard"></i> </div>
                        <div class="side-menu__title"> Ujian</div>
                    </a>
                </li>


                <li>
                    <a href="{{  route('pengumumanCalon.index') }}" class="side-menu {{$side == 'pengumumanCalon'? 'side-menu--active':''}}">
                        <div class="side-menu__icon"> <i data-lucide="shield"></i> </div>
                        <div class="side-menu__title"> Pengumuman</div>
                    </a>
                </li>

                @endif


            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">

                <div class="mr-3">
                    <button
                        id="btnToggleSidebar"
                        class="btn btn-outline-secondary">

                        <i data-lucide="menu"></i>

                    </button>
                </div>
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                    @yield('top-nav')

                </nav>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                        <img alt="Midone - HTML Admin Template" src="{{asset('public/dist/images/open_green.png')}}">
                    </div>
                    <div class="dropdown-menu w-56">
                        <ul class="dropdown-content bg-primary text-white">
                            <li class="p-2">
                                <div class="font-medium"></div>
                                <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">Guru</div>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider border-white/[0.08]">
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
            <!-- END: Top Bar -->
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 2xl:col-span-12">
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: General Report -->
                        <div class="col-span-12 mt-8">
                            @include('layout.response')
                            @yield('body')

                        </div>
                        <!-- END: General Report -->

                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>

    <!-- BEGIN: JS Assets-->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <script src="{{asset('public/dist/js/app.js')}}"></script>
    <!-- END: JS Assets-->
    {{-- ckeditor --}}
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    {{-- ckeditor --}}

    <script>
        // Toggle sidebar
        document
            .getElementById('btnToggleSidebar')
            .addEventListener('click', function() {

                document.body.classList.toggle('sidebar-mini');

            });
    </script>
</body>

</html>