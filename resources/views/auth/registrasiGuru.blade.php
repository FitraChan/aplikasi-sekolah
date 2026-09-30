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
    <link href="{{asset('public/dist/images/logo.png')}}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Registrasi - SISTEM INFORMASI SEKOLAH</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('public/dist/css/app.css')}}" />
    <!-- END: CSS Assets-->

</head>
<!-- END: Head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="SISTEM INFORMASI GURU" class="w-6" src="public/dist/images/logo.png">
                    <span class="text-white text-lg ml-3"> SIAMI </span>
                </a>
                <div class="my-auto">
                    <img alt="SISTEM INFORMASI GURU" class="-intro-x w-1/2 -mt-16" src="public/dist/images/login.png">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A few more clicks to
                        <br>
                        sign in to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">SISTEM INFORMASI SEKOLAH</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-center">
                        Sign In
                    </h2>

                    @if(session('error'))
                    <div class="alert alert-danger mt-4">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. SISTEM INFORMASI GURU</div>

                    <form action="{{ url('cekRegisterGuru') }}" method="POST">
                        @csrf
                        <div class="intro-x mt-8">
                            <!-- Nama Guru -->
                            <input
                                type="text"
                                name="nama_gtk"
                                value="{{ old('nama_gtk') }}"
                                class="intro-x login__input form-control py-3 px-4 block"
                                placeholder="Nama Lengkap Guru">
                            <!-- NIK (opsional) -->
                            <input
                                type="text"
                                name="nik"
                                value="{{ old('nik') }}"
                                class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="NIK (Opsional)">
                            <!-- Jenis Kelamin -->
                            <select
                                name="jk"
                                class="intro-x login__input form-select py-3 px-4 block mt-4">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>

                            <!-- No HP / WhatsApp -->
                            <input
                                type="text"
                                name="no_hp"
                                value="{{ old('no_hp') }}"
                                class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Nomor WhatsApp">

                            <!-- Email -->
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Email (Opsional)">
                            @error('email')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!-- Password -->
                            <input
                                type="password"
                                name="password"
                                class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Password">

                            <!-- Konfirmasi Password -->
                            <input
                                type="password"
                                name="password_confirmation"
                                class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Konfirmasi Password">

                        </div>

                        <div class="mt-4 captcha-desain">
                            {{-- CAPTCHA --}}
                        </div>

                        <div class="intro-x mt-5 xl:mt-8 text-center">

                            <button
                                type="submit"
                                class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                                Daftar Guru
                            </button>

                            <a
                                href="{{ route('login') }}"
                                class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">
                                Login
                            </a>

                        </div>
                    </form>


                    {{-- <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy Policy</a> </div> --}}
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: Dark Mode Switcher-->
    {{-- <div data-url="login-dark-login.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div> --}}
    <!-- END: Dark Mode Switcher-->

    <!-- BEGIN: JS Assets-->
    <script src="{{asset('dist/js/app.js')}}"></script>
    <!-- END: JS Assets-->
</body>

</html>