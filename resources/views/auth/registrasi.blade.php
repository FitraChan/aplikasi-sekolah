<!DOCTYPE html>

<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PPDB Admin - Login Admin Akademik</title>
  <!-- Google Fonts: Plus Jakarta Sans -->
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap"
    rel="stylesheet" />
  <!-- Tailwind CSS CDN with Forms and Container Queries plugins -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              DEFAULT: '#02BC9C',
              hover: '#02a387',
              dark: '#015345',
              light: '#e6f9f5'
            }
          },
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style data-purpose="custom-decorations">
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Subtle decorative circular ripples matching the background canvas */
    .bg-radial-circle {
      position: absolute;
      border-radius: 9999px;
      border: 1.5px solid rgba(226, 232, 240, 0.7);
      pointer-events: none;
    }
  </style>
</head>

<body
  class="min-h-screen bg-[#eceff5] flex flex-col items-center justify-center p-4 md:p-8 font-sans relative overflow-x-hidden antialiased">
  <!-- BEGIN: DecorativeBackgroundCircles -->
  <div aria-hidden="true" class="absolute inset-0 overflow-hidden pointer-events-none z-0 hidden lg:block">
    <div class="bg-radial-circle w-[420px] h-[420px] top-[10%] left-[8%] -translate-x-12 opacity-60"></div>
    <div class="bg-radial-circle w-[580px] h-[580px] top-[2%] left-[4%] -translate-x-16 opacity-40"></div>
  </div>
  <!-- END: DecorativeBackgroundCircles -->
  <!-- BEGIN: MainLoginCard -->
  <main
    class="w-full max-w-[1020px] my-auto bg-white rounded-2xl shadow-2xl shadow-slate-300/60 overflow-hidden grid grid-cols-1 lg:grid-cols-12 relative z-10">
    <!-- BEGIN: LeftInfoPanel -->
    <section class="lg:col-span-6 bg-[#02BC9C] p-8 md:p-10 lg:p-11 flex flex-col justify-between text-white relative">
      <!-- Top Content: Brand & Headline -->
      <div>
        <!-- Logo & Brand Header -->
        <div class="flex items-center gap-3 mb-7" data-purpose="brand-identifier">
          <div
            class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-[#02BC9C] flex-shrink-0 shadow-md shadow-emerald-800/10">
            <!-- Graduation Cap Icon -->
             <img src="{{ asset('public/images/Favicon_MOBIS_WARNA.png') }}"
                        alt="Logo"
                        class="w-8 h-8 object-contain">

          </div>
          <div>
            <div class="font-extrabold text-lg text-white tracking-tight leading-none">PPDB {{ date('Y')}}</div>
            <div class="text-xs text-teal-100 font-medium mt-1">MOBIS (Mobile Information School)</div>
          </div>
        </div>
        <!-- Headline -->
        <h1 class="text-2xl sm:text-3xl font-extrabold leading-snug tracking-tight mb-4 text-white">
          Portal Manajemen Penerimaan Siswa Baru
        </h1>
        <!-- Subtitle Description -->
        <p class="text-emerald-50 text-[14.5px] leading-relaxed opacity-95 pr-2">
          Selamat datang di dashboard pusat administrasi. Kelola data pendaftaran, verifikasi dokumen, dan proses
          seleksi dengan efisien dan transparan.
        </p>
      </div>
      <!-- Mid Content: Office/Team Photo Showcase -->
      <div class="my-7" data-purpose="showcase-image-container">
        <div
          class="rounded-xl overflow-hidden border border-emerald-400/30 shadow-lg shadow-emerald-900/20 bg-emerald-700/20 aspect-[16/9] w-full max-w-full">
          <img alt="Suasana ruang kerja tim administrasi PPDB"
            class="w-full h-full object-cover brightness-95 contrast-105"
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFbeHQwkMwZHEjSnt2L_j0EIWY-k2cM2Y4zUPfe_CjTA&s=10" />
        </div>
      </div>
      <!-- Bottom Content: Security Tag -->
      <footer class="flex items-center space-x-2 text-xs font-medium text-emerald-100/90 pt-1">
        <svg class="w-4 h-4 text-emerald-200" fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
          <path
            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
            stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span>Sistem Terenkripsi End-to-End</span>
      </footer>
    </section>
    <!-- END: LeftInfoPanel -->
    <!-- BEGIN: RightFormPanel -->
   {{-- Panel Form Pendaftaran --}}
<section class="lg:col-span-6 p-8 md:p-10 lg:p-12 flex flex-col justify-between bg-white">

    <div>
        {{-- Header --}}
        <header class="mb-7">
            <div class="inline-flex items-center rounded-full bg-[#e6f9f5] px-3 py-1.5 text-xs font-semibold text-[#015345] mb-4">
                Pendaftaran Siswa Baru
            </div>

            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                Buat Akun Pendaftaran
            </h2>

            <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                Lengkapi data berikut untuk membuat akun dan melanjutkan proses pendaftaran siswa baru.
            </p>
        </header>

        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4">
                <p class="text-sm font-semibold text-red-700">
                    Periksa kembali data yang Anda masukkan.
                </p>

                <ul class="mt-2 list-disc pl-5 text-sm text-red-600 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Pesan Error Umum --}}
        @if (session('error'))
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form Pendaftaran --}}
        <form action="{{ url('cekregister') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama Lengkap --}}
            <div>
                <label for="nama_lengkap"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama_lengkap"
                    name="nama_lengkap"
                    value="{{ old('nama_lengkap') }}"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 placeholder-slate-400 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">
            </div>

            {{-- Nomor Telepon --}}
            <div>
                <label for="no_telp"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Nomor Telepon / WhatsApp
                </label>

                <input
                    type="tel"
                    id="no_telp"
                    name="no_telp"
                    value="{{ old('no_telp') }}"
                    placeholder="Contoh: 081234567890"
                    autocomplete="tel"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 placeholder-slate-400 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">
            </div>

            {{-- Email --}}
            <div>
                <label for="email"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 placeholder-slate-400 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">

                @error('email')
                    <p class="mt-1.5 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Jurusan --}}
            <div>
                <label for="id_jurusan"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Pilihan Jurusan
                </label>

                <select
                    id="id_jurusan"
                    name="id_jurusan"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">

                    <option value="">-- Pilih Jurusan --</option>

                    @foreach ($jurusan as $row)
                        <option
                            value="{{ $row->id }}"
                            {{ (string) old('id_jurusan') === (string) $row->id ? 'selected' : '' }}>
                            {{ $row->nama_jurusan }}
                        </option>
                    @endforeach
                </select>

                @error('id_jurusan')
                    <p class="mt-1.5 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Sekolah Asal --}}
            <div>
                <label for="nama_sekolah_asal"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Sekolah Asal
                </label>

                <input
                    type="text"
                    id="nama_sekolah_asal"
                    name="nama_sekolah_asal"
                    value="{{ old('nama_sekolah_asal') }}"
                    placeholder="Nama SMP / MTs asal"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 placeholder-slate-400 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">
            </div>

            {{-- Password --}}
            <div>
                <label for="password"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 8 karakter"
                    autocomplete="new-password"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 placeholder-slate-400 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation"
                    class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    required
                    class="block w-full rounded-lg border border-[#d6e0ec] bg-[#f5f8fc] px-4 py-3 text-sm text-slate-700 placeholder-slate-400 transition focus:border-[#02BC9C] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C]/20">
            </div>

           

            {{-- Tombol Daftar --}}
            <div class="pt-2">
                <button
                    type="submit"
                    class="flex w-full items-center justify-center rounded-lg bg-[#02BC9C] px-4 py-3 text-sm font-semibold text-white shadow-md shadow-[#02BC9C]/20 transition hover:bg-[#02a387] focus:outline-none focus:ring-2 focus:ring-[#02BC9C] focus:ring-offset-2 active:scale-[0.99]">

                    Daftar Sekarang

                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            {{-- Link Login --}}
            <div class="pt-2 text-center">
                <p class="text-sm text-slate-500">
                    Sudah memiliki akun?

                    <a href="{{ route('login') }}"
                        class="font-semibold text-[#02BC9C] transition hover:text-[#02a387] hover:underline">
                        Login di sini
                    </a>
                </p>
            </div>

        </form>
    </div>

    {{-- Footer --}}
    <footer class="mt-8 border-t border-slate-100 pt-4 text-center text-xs text-slate-400">
        &copy; {{ date('Y') }} PPDB Online System
    </footer>

</section>
    <!-- END: RightFormPanel -->
  </main>
  <!-- END: MainLoginCard -->
  <!-- BEGIN: InteractiveHandlers -->
  <script data-purpose="event-handlers">
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (toggleBtn && passwordInput) {
      toggleBtn.addEventListener('click', () => {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
      });
    }
  </script>
  <!-- END: InteractiveHandlers -->
</body>

</html>