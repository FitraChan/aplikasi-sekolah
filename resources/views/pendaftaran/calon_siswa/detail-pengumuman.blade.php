@extends('layout.app')

@section('title', 'Detail Pengumuman')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full">

    {{-- Breadcrumb & Kembali --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">

        <div class="flex items-center gap-2 text-sm">

            <a href="{{ route('pengumumanCalon.index') }}"
                class="text-[#00b074] hover:underline font-medium flex items-center gap-1.5">

                <span>←</span>
                Kembali ke Daftar Pengumuman

            </a>

            <span class="text-slate-300">/</span>

            <span class="text-slate-500 font-medium">
                Detail Pengumuman
            </span>

        </div>

        <a href="{{ route('pengumumanCalon.index') }}"
            class="px-5 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors shadow-xs">

            Kembali

        </a>

    </div>


    {{-- Header Pengumuman --}}
    <section
        class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-7 mb-6 relative overflow-hidden shadow-xs">

        {{-- Background Icon --}}
        <div aria-hidden="true"
            class="absolute right-6 top-6 pointer-events-none text-slate-200/60">

            <svg class="w-24 h-24 stroke-[1.2]"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path
                    d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.111-1.527-.449a18.17 18.17 0 0 1-1.63-4.225m3.295 0c3.03.18 6.002.66 8.87 1.412a.75.75 0 0 0 .942-.724V5.728a.75.75 0 0 0-.942-.724A24.58 24.58 0 0 0 10.34 6.42m0 9.18V6.42"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                </path>

                <path
                    d="M19.5 8.25a6 6 0 0 1 0 7.5m2.25-9.75a9 9 0 0 1 0 12"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                </path>

            </svg>

        </div>


        <div class="relative z-10 max-w-3xl">

            {{-- Label Gelombang --}}
            @if (is_null($pengumuman->id_gelombang))

                <span
                    class="inline-block px-3 py-1 bg-blue-50 text-blue-600 font-bold text-[11px] tracking-wide rounded-full uppercase mb-4">

                    SEMUA GELOMBANG

                </span>

            @else

                <span
                    class="inline-block px-3 py-1 bg-emerald-50 text-emerald-600 font-bold text-[11px] tracking-wide rounded-full uppercase mb-4">

                    GELOMBANG {{ $pengumuman->id_gelombang }}

                </span>

            @endif


            {{-- Judul --}}
            <h1
                class="text-xl sm:text-2xl lg:text-[28px] font-extrabold text-slate-900 leading-tight mb-4 tracking-tight">

                {{ $pengumuman->judul }}

            </h1>


            {{-- Tanggal --}}
            <div class="flex flex-wrap items-center gap-4 sm:gap-5 text-xs font-medium text-slate-500">

                <div class="flex items-center gap-1.5">

                    <svg class="w-4 h-4 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24">

                        <path
                            d="M6.75 3v2.25M17.25 3v2.253M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                    </svg>

                    <span>
                        Diterbitkan pada

                        {{ $pengumuman->tanggal_kirim
                            ? \Carbon\Carbon::parse($pengumuman->tanggal_kirim)->format('d M Y H:i')
                            : '-' }}

                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- Isi Pengumuman --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        {{-- Artikel --}}
        <article
            class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-8 shadow-xs">

            <div class="flex items-center gap-2 mb-6">

                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">

                    <svg class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            d="M19.5 14.25v-8.25A2.25 2.25 0 0 0 17.25 3H6.75A2.25 2.25 0 0 0 4.5 5.25v13.5A2.25 2.25 0 0 0 6.75 21h10.5A2.25 2.25 0 0 0 19.5 18.75V18"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                        <path
                            d="M8 7h8M8 11h8M8 15h5"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                    </svg>

                </div>

                <h2 class="text-lg font-bold text-slate-800">
                    Isi Pengumuman
                </h2>

            </div>


            {{-- Pesan dari Database --}}
            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">

                {!! $pengumuman->pesan !!}

            </div>


            {{-- Footer --}}
            <div class="mt-8 pt-5 border-t border-slate-200">

                <a href="{{ route('pengumumanCalon.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors">

                    <span class="mr-2">←</span>

                    Kembali ke Pengumuman

                </a>

            </div>

        </article>


        {{-- Sidebar --}}
        <aside
            class="lg:col-span-4 bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">

            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-teal-600 mb-4">

                <svg class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">

                    <path
                        d="M12 6v6l4 2"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                    </path>

                    <circle
                        cx="12"
                        cy="12"
                        r="9">
                    </circle>

                </svg>

                <span>INFORMASI</span>

            </div>


            {{-- Informasi Pengumuman --}}
            <div class="space-y-3">

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">

                    <div class="text-xs text-slate-400 mb-1">
                        Judul
                    </div>

                    <div class="text-sm font-semibold text-slate-800">
                        {{ $pengumuman->judul }}
                    </div>

                </div>


                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">

                    <div class="text-xs text-slate-400 mb-1">
                        Tanggal Diterbitkan
                    </div>

                    <div class="text-sm font-semibold text-slate-800">

                        {{ $pengumuman->tanggal_kirim
                            ? \Carbon\Carbon::parse($pengumuman->tanggal_kirim)->format('d M Y H:i')
                            : '-' }}

                    </div>

                </div>


                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">

                    <div class="text-xs text-slate-400 mb-1">
                        Target Pengumuman
                    </div>

                    <div class="text-sm font-semibold text-slate-800">

                        @if (is_null($pengumuman->id_gelombang))
                            Semua Gelombang
                        @else
                            Gelombang {{ $pengumuman->id_gelombang }}
                        @endif

                    </div>

                </div>

            </div>


            {{-- Catatan --}}
            <div class="mt-5 p-4 rounded-xl bg-emerald-50 border border-emerald-100">

                <div class="flex gap-3">

                    <svg class="w-5 h-5 text-emerald-600 shrink-0"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24">

                        <path
                            d="M12 9v3.75m0 3h.007v.008H12v-.008ZM10.29 3.86 2.82 17.25a1.5 1.5 0 0 0 1.3 2.25h15.76a1.5 1.5 0 0 0 1.3-2.25L13.71 3.86a1.5 1.5 0 0 0-2.42 0Z"
                            stroke-linecap="round"
                            stroke-linejoin="round">
                        </path>

                    </svg>

                    <div>

                        <div class="text-sm font-semibold text-emerald-800">
                            Perhatian
                        </div>

                        <div class="text-xs text-emerald-700 mt-1 leading-relaxed">
                            Pastikan Anda membaca seluruh isi pengumuman dan mengikuti informasi yang disampaikan.
                        </div>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</main>

@endsection

