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
    <section class="lg:col-span-6 p-8 md:p-12 lg:p-12 flex flex-col justify-between bg-white">
      <!-- Top Form Area -->
      <div>
        <!-- Form Header -->
        <header class="mb-7">
          <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Login Admin Akademik</h2>
          <p class="text-sm text-slate-500 mt-2 font-normal">
            Silakan masukkan kredensial Anda untuk mengakses dashboard.
          </p>
        </header>
        <!-- Authentication Form -->
        <form action="{{route('login')}}" class="space-y-4" method="POST">
          <!-- Username / Email Field -->
          <div data-purpose="form-input-username">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2" for="username">
              Username atau Email
            </label>
            <div class="relative rounded-lg shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                  <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                </svg>
              </div>
              <input
                class="block w-full pl-11 pr-4 py-2.5 bg-[#f5f8fc] border border-[#d6e0ec] rounded-lg text-slate-700 placeholder-slate-400 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C] focus:border-transparent transition-all duration-150"
                id="username" value="{{old('email')}}" name="email" placeholder="nama@sekolah.sch.id" type="text" />
            </div>
          </div>
          <!-- Password Field -->
          <div class="pt-1" data-purpose="form-input-password">
            <div class="flex items-center justify-between mb-2">
              <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider" for="password">
                Kata Sandi
              </label>
              <!--<a class="text-xs font-semibold text-[#02BC9C] hover:text-[#02a387] hover:underline transition-colors" href="LupaPassword.html">
                Lupa Password?
              </a>-->
            </div>
            <div class="relative rounded-lg shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewbox="0 0 24 24">
                  <path
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                    stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </div>
              <input
                class="block w-full pl-11 pr-11 py-2.5 bg-[#f5f8fc] border border-[#d6e0ec] rounded-lg text-slate-700 placeholder-slate-400 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#02BC9C] focus:border-transparent tracking-widest transition-all duration-150"
                id="password" name="password" type="password" value="secretpassword" />
              <button id="togglePassword" aria-label="Tampilkan atau sembunyikan kata sandi"
                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none transition-colors"
                type="button">
                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8"
                  viewbox="0 0 24 24">
                  <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                    stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </button>
            </div>
          </div>
          <!-- Remember Me Checkbox -->
          <div class="flex items-center pt-2">
            <input class="h-4 w-4 text-[#02BC9C] focus:ring-[#02BC9C] border-slate-300 rounded cursor-pointer"
              id="remember-me" name="remember-me" type="checkbox" />
            <label class="ml-2.5 block text-xs text-slate-600 select-none cursor-pointer" for="remember-me">
              Tetap login di perangkat ini
            </label>
          </div>
          <!-- Submit Button -->
          <div class="pt-3">
            <button
              class="w-full flex justify-center items-center py-3 px-4 rounded-lg shadow-md shadow-[#02BC9C]/30 text-sm font-semibold text-white bg-[#02BC9C] hover:bg-[#02a387] active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#02BC9C] transition-all"
              type="submit">
              <span>Masuk ke Dashboard</span>
              <svg class="ml-2 w-4 h-4 stroke-[2.2]" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                <path d="M11 16l4-4m0 0l-4-4m4 4H3m13-7h3a2 2 0 012 2v10a2 2 0 01-2 2h-3" stroke-linecap="round"
                  stroke-linejoin="round"></path>
              </svg>
            </button>
          </div>
        </form>
      </div>
      <!-- Bottom Meta Footer -->
      <footer class="mt-8 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
        <span>&copy; {{ date('Y') }} PPDB Online System</span>
        <div class="flex items-center space-x-1.5">
          <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
          <span>Server Online</span>
        </div>
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