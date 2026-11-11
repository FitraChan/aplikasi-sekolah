<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - PPDB MOBIS</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>

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
                        sans: ['"Plus Jakarta Sans"', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-[#eceff5] flex flex-col items-center justify-center p-4 md:p-8 font-sans relative overflow-x-hidden antialiased">

    {{-- Background --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none hidden lg:block">
        <div class="absolute w-[420px] h-[420px] rounded-full border border-slate-300/60 top-[10%] left-[8%]"></div>
        <div class="absolute w-[580px] h-[580px] rounded-full border border-slate-300/40 top-[2%] left-[4%]"></div>
    </div>

    <main class="w-full max-w-[480px] relative z-10">

        <div class="bg-white rounded-2xl shadow-2xl shadow-slate-300/60 overflow-hidden">

            {{-- Header --}}
            <div class="bg-[#02BC9C] px-8 py-9 text-center">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-white flex items-center justify-center shadow-lg mb-5">

                    <svg class="w-9 h-9 text-[#02BC9C]" fill="none" stroke="currentColor"
                        stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>

                </div>

                <h1 class="text-2xl font-extrabold text-white">
                    Lupa Password?
                </h1>

                <p class="text-sm text-emerald-50 mt-2">
                    PPDB {{ date('Y') }} / MOBIS
                </p>

            </div>

            {{-- Content --}}
            <div class="p-8 md:p-10">

                <div class="text-center mb-7">

                    <h2 class="text-xl font-bold text-slate-800">
                        Reset Password Anda
                    </h2>

                    <p class="text-sm text-slate-500 mt-3 leading-relaxed">
                        Jangan khawatir! Masukkan email yang terdaftar pada akun Anda.
                        Kami akan mengirimkan tautan untuk mengatur ulang password.
                    </p>

                </div>

                {{-- Success --}}
                @if (session('status'))

                    <div class="mb-5 flex items-start gap-3 p-4 rounded-xl border border-green-200 bg-green-50 text-green-700">

                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7"/>
                        </svg>

                        <div>
                            <p class="text-sm font-bold">Email Berhasil Diproses!</p>
                            <p class="text-xs mt-1">{{ session('status') }}</p>
                        </div>

                    </div>

                @endif

                {{-- Error --}}
                @if ($errors->any())

                    <div class="mb-5 flex items-start gap-3 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700">

                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.86L1.82 18a2 2 0 001.7 3h16.96a2 2 0 001.7-3L13.7 3.86a2 2 0 00-3.4 0z"/>
                        </svg>

                        <div>
                            <p class="text-sm font-bold">Permintaan Gagal!</p>

                            @foreach ($errors->all() as $error)
                                <p class="text-xs mt-1">{{ $error }}</p>
                            @endforeach

                        </div>

                    </div>

                @endif

                {{-- Form --}}
                <form action="{{ route('password.email') }}" method="POST" class="space-y-5">

                    @csrf

                    <div>

                        <label for="email"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Email Terdaftar
                        </label>

                        <div class="relative">

                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                    stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>
                                </svg>

                            </div>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                placeholder="nama@email.com"
                                class="block w-full pl-11 pr-4 py-3 bg-[#f5f8fc]
                                border {{ $errors->has('email') ? 'border-red-400' : 'border-[#d6e0ec]' }}
                                rounded-lg text-sm text-slate-700
                                placeholder-slate-400
                                focus:bg-white focus:outline-none focus:ring-2
                                focus:ring-[#02BC9C] focus:border-transparent transition-all">
                        </div>

                        <p class="text-xs text-slate-400 mt-2">
                            Pastikan email yang dimasukkan masih aktif.
                        </p>

                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full flex justify-center items-center py-3 px-4 rounded-lg
                        shadow-md shadow-[#02BC9C]/30 text-sm font-semibold text-white
                        bg-[#02BC9C] hover:bg-[#02a387] active:scale-[0.99]
                        transition-all">

                        Kirim Link Reset Password

                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 12h14m-7-7l7 7-7 7"/>
                        </svg>

                    </button>

                </form>

                {{-- Back Login --}}
                <div class="mt-7 text-center">

                    <a href="{{ route('form-login') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-[#02BC9C] hover:text-[#02a387] transition-colors">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 12H5m7 7l-7-7 7-7"/>
                        </svg>

                        Kembali ke Halaman Login

                    </a>

                </div>

            </div>

        </div>

        {{-- Footer --}}
        <footer class="mt-6 text-center text-xs text-slate-400">
            <p>&copy; {{ date('Y') }} PPDB Online System - MOBIS</p>

            <div class="flex justify-center items-center gap-2 mt-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Sistem Online</span>
            </div>
        </footer>

    </main>

</body>
</html>