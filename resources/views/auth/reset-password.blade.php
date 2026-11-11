<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Password Baru - PPDB MOBIS</title>

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

<body class="min-h-screen bg-[#eceff5] flex items-center justify-center p-4 font-sans antialiased">

    <main class="w-full max-w-[480px]">

        <div class="bg-white rounded-2xl shadow-2xl shadow-slate-300/60 overflow-hidden">

            {{-- Header --}}
            <div class="bg-[#02BC9C] px-8 py-8 text-center">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-white flex items-center justify-center shadow-lg mb-4">

                    <svg class="w-9 h-9 text-[#02BC9C]" fill="none" stroke="currentColor"
                        stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>

                </div>

                <h1 class="text-2xl font-extrabold text-white">
                    Buat Password Baru
                </h1>

                <p class="text-sm text-emerald-50 mt-2">
                    PPDB {{ date('Y') }} / MOBIS
                </p>

            </div>

            {{-- Form --}}
            <div class="p-8">

                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-800">
                        Atur Ulang Password
                    </h2>

                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Silakan buat password baru untuk akun Anda.
                        Gunakan password yang kuat dan mudah diingat.
                    </p>
                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-xl border border-red-200 bg-red-50 text-red-700"
                        role="alert">

                        <p class="text-sm font-bold mb-1">
                            Reset Password Gagal!
                        </p>

                        @foreach ($errors->all() as $error)
                            <p class="text-xs">{{ $error }}</p>
                        @endforeach

                    </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-5">

                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div>
                        <label for="email"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $email) }}"
                            required
                            readonly
                            class="block w-full px-4 py-3 bg-slate-100
                            border border-[#d6e0ec] rounded-lg
                            text-sm text-slate-500 cursor-not-allowed">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Password Baru
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                minlength="8"
                                placeholder="Minimal 8 karakter"
                                class="block w-full px-4 pr-12 py-3 bg-[#f5f8fc]
                                border {{ $errors->has('password') ? 'border-red-400' : 'border-[#d6e0ec]' }}
                                rounded-lg text-sm text-slate-700
                                focus:bg-white focus:outline-none focus:ring-2
                                focus:ring-[#02BC9C] focus:border-transparent">

                            <button type="button"
                                onclick="togglePassword('password', 'eye1')"
                                class="absolute inset-y-0 right-0 px-4 flex items-center text-slate-400 hover:text-slate-600">

                                <svg id="eye1" class="w-5 h-5" fill="none"
                                    stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                            </button>

                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Konfirmasi Password Baru
                        </label>

                        <div class="relative">

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                required
                                placeholder="Ulangi password baru"
                                class="block w-full px-4 pr-12 py-3 bg-[#f5f8fc]
                                border border-[#d6e0ec] rounded-lg text-sm text-slate-700
                                focus:bg-white focus:outline-none focus:ring-2
                                focus:ring-[#02BC9C] focus:border-transparent">

                            <button type="button"
                                onclick="togglePassword('password_confirmation', 'eye2')"
                                class="absolute inset-y-0 right-0 px-4 flex items-center text-slate-400 hover:text-slate-600">

                                <svg id="eye2" class="w-5 h-5" fill="none"
                                    stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7s-8.268-2.943-9.542-7z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                            </button>

                        </div>
                    </div>

                    {{-- Password Info --}}
                    <div class="flex items-start gap-2 p-3 rounded-lg bg-[#e6f9f5] text-[#015345]">

                        <svg class="w-5 h-5 flex-shrink-0" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                        <p class="text-xs leading-relaxed">
                            Password minimal 8 karakter. Gunakan kombinasi huruf,
                            angka, dan simbol untuk meningkatkan keamanan.
                        </p>

                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full flex justify-center items-center py-3 px-4 rounded-lg
                        shadow-md shadow-[#02BC9C]/30 text-sm font-semibold text-white
                        bg-[#02BC9C] hover:bg-[#02a387] active:scale-[0.99]
                        transition-all">

                        Simpan Password Baru

                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 12h14m-7-7l7 7-7 7"/>
                        </svg>

                    </button>

                </form>

                <div class="mt-7 text-center">

                    <a href="{{ route('form-login') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-[#02BC9C] hover:text-[#02a387]">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 12H5m7 7l-7-7 7-7"/>
                        </svg>

                        Kembali ke Login

                    </a>

                </div>

            </div>

        </div>

        <p class="text-center text-xs text-slate-400 mt-6">
            &copy; {{ date('Y') }} PPDB Online System - MOBIS
        </p>

    </main>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>

</body>
</html>