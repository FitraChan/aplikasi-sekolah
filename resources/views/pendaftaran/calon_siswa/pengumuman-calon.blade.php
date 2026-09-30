@extends('layout.app')

@section('title', 'Pengumuman')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main class="flex-1 p-4 sm:p-6 lg:p-8 w-full space-y-6 sm:space-y-8">

    {{-- PAGE HEADER --}}
    <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
            Informasi & Pengumuman
        </h2>

        <p class="text-gray-500 text-sm mt-1.5">
            Tetap terinformasi mengenai tahapan seleksi, persyaratan,
            dan informasi terbaru PPDB.
        </p>
    </div>


    {{-- PENGUMUMAN TERBARU --}}
    @if ($pengumuman->count())

        @php
            $terbaru = $pengumuman->first();
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

            {{-- HERO --}}
            <div
                class="lg:col-span-8 relative overflow-hidden
                       bg-gradient-to-r from-[#00A87A] via-[#00B686] to-[#05C493]
                       text-white rounded-2xl p-7 md:p-8
                       flex flex-col justify-between shadow-sm"
            >

                {{-- WATERMARK --}}
                <div
                    class="absolute -right-4 -bottom-6 opacity-15
                           pointer-events-none"
                >
                    <svg
                        class="w-64 h-64 text-white"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"
                        />
                    </svg>
                </div>

                <div class="relative z-10 space-y-3.5 max-w-xl">

                    {{-- BADGE --}}
                    <div>

                        @if (is_null($terbaru->id_gelombang))

                            <span
                                class="inline-block bg-[#E11D48]
                                       text-white font-bold text-[11px]
                                       tracking-wider uppercase
                                       px-2.5 py-1 rounded"
                            >
                                PENTING
                            </span>

                        @else

                            <span
                                class="inline-block bg-[#E11D48]
                                       text-white font-bold text-[11px]
                                       tracking-wider uppercase
                                       px-2.5 py-1 rounded"
                            >
                                GELOMBANG {{ $terbaru->id_gelombang }}
                            </span>

                        @endif

                    </div>


                    {{-- JUDUL --}}
                    <h3 class="text-xl md:text-2xl font-bold leading-snug">
                        {{ $terbaru->judul }}
                    </h3>


                    {{-- DESKRIPSI --}}
                    <p class="text-emerald-50 text-sm leading-relaxed">

                        {{ \Illuminate\Support\Str::limit(
                            strip_tags($terbaru->pesan),
                            180
                        ) }}

                    </p>

                </div>


                {{-- BUTTON --}}
                <div class="relative z-10 pt-6">

                    <a
                        href="{{ route('pengumumanCalon.show', $terbaru->id) }}"
                        class="inline-flex items-center justify-center
                               bg-white text-[#00A87A]
                               hover:bg-gray-50
                               active:bg-gray-100
                               font-bold text-sm
                               px-5 py-2.5 rounded-lg
                               shadow-sm transition"
                    >

                        <svg
                            class="w-4 h-4 mr-2"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 12H3m0 0l4-4m-4 4l4 4
                                   M21 5v14a2 2 0 01-2 2H9"
                            />
                        </svg>

                        Baca Pengumuman

                    </a>

                </div>

            </div>


            {{-- INFO TERBARU --}}
            <div
                class="lg:col-span-4
                       bg-white border border-gray-200
                       rounded-2xl p-6
                       flex flex-col items-center
                       justify-center text-center
                       shadow-xs"
            >

                <div
                    class="w-12 h-12 rounded-xl
                           flex items-center justify-center
                           text-[#00B686] mb-3"
                >

                    <svg
                        class="w-9 h-9"
                        fill="none"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.9"
                        viewBox="0 0 24 24"
                    >
                        <rect
                            height="18"
                            rx="2"
                            ry="2"
                            width="18"
                            x="3"
                            y="4"
                        />

                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>

                        <path d="M8 14h.01"/>
                        <path d="M12 14h.01"/>
                        <path d="M16 14h.01"/>
                    </svg>

                </div>


                <h4 class="text-base font-bold text-gray-900">
                    Pengumuman Terbaru
                </h4>


                <p class="text-xs text-gray-500 mt-1 mb-5">
                    Informasi terbaru dari sekolah
                </p>


                <div
                    class="w-full border border-gray-200
                           rounded-xl py-4 px-6
                           bg-white shadow-xs"
                >

                    <span
                        class="block text-lg font-bold
                               text-[#00B686]"
                    >
                        {{ $terbaru->tanggal_kirim
                            ? \Carbon\Carbon::parse($terbaru->tanggal_kirim)->format('d M Y')
                            : '-' }}
                    </span>

                    <span
                        class="block text-[11px]
                               font-semibold text-gray-700
                               tracking-wider mt-1 uppercase"
                    >
                        {{ $terbaru->tanggal_kirim
                            ? \Carbon\Carbon::parse($terbaru->tanggal_kirim)->format('H:i')
                            : '-' }}
                    </span>

                </div>

            </div>

        </div>

    @endif


    {{-- LIST PENGUMUMAN --}}
    <section class="space-y-4 pt-2">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>

                <h3 class="text-lg font-bold text-gray-900">
                    Daftar Pengumuman
                </h3>

                <p class="text-xs text-gray-500 mt-1">
                    Informasi yang tersedia untuk Anda.
                </p>

            </div>

        </div>


        {{-- LIST --}}
        <div class="space-y-3.5">

            @forelse ($pengumuman as $item)

                <article
                    class="bg-white border border-gray-200
                           rounded-xl p-5
                           hover:border-gray-300
                           transition shadow-xs
                           flex items-start gap-4"
                >

                    {{-- ICON --}}
                    <div
                        class="w-10 h-10 rounded-lg
                               bg-emerald-50
                               text-[#00B686]
                               flex items-center justify-center
                               flex-shrink-0 mt-0.5"
                    >

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M14.5 2H6a2 2 0 0 0-2 2v16
                                   a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"
                            />

                            <polyline points="14 2 14 8 20 8"/>

                            <line x1="16" x2="8" y1="13" y2="13"/>
                            <line x1="16" x2="8" y1="17" y2="17"/>
                        </svg>

                    </div>


                    {{-- CONTENT --}}
                    <div class="flex-1 min-w-0">

                        {{-- TITLE + DATE --}}
                        <div
                            class="flex flex-col sm:flex-row
                                   sm:items-center
                                   justify-between
                                   gap-1 sm:gap-4"
                        >

                            <h4
                                class="text-sm md:text-base
                                       font-bold text-gray-900
                                       hover:text-[#00B686]
                                       transition"
                            >

                                <a
                                    href="{{ route('pengumumanCalon.show', $item->id) }}"
                                    class="hover:text-[#00B686]"
                                >
                                    {{ $item->judul }}
                                </a>

                            </h4>


                            {{-- TANGGAL --}}
                            <span
                                class="text-xs font-semibold
                                       text-gray-700
                                       bg-gray-50
                                       px-2.5 py-1
                                       rounded
                                       border border-gray-100
                                       whitespace-nowrap
                                       self-start sm:self-auto"
                            >

                                {{ $item->tanggal_kirim
                                    ? \Carbon\Carbon::parse($item->tanggal_kirim)->format('d M Y H:i')
                                    : '-' }}

                            </span>

                        </div>


                        {{-- BADGE GELOMBANG --}}
                        <div class="mt-2">

                            @if (is_null($item->id_gelombang))

                                <span
                                    class="inline-flex
                                           items-center
                                           px-2 py-0.5
                                           rounded-md
                                           bg-emerald-50
                                           text-[#00B686]
                                           text-[10px]
                                           font-semibold"
                                >
                                    Semua Gelombang
                                </span>

                            @else

                                <span
                                    class="inline-flex
                                           items-center
                                           px-2 py-0.5
                                           rounded-md
                                           bg-gray-50
                                           text-gray-600
                                           text-[10px]
                                           font-semibold
                                           border border-gray-100"
                                >
                                    Gelombang {{ $item->id_gelombang }}
                                </span>

                            @endif

                        </div>


                        {{-- PESAN --}}
                        <p
                            class="text-xs md:text-sm
                                   text-gray-500
                                   mt-2 leading-relaxed
                                   line-clamp-2"
                        >

                            {{ \Illuminate\Support\Str::limit(
                                strip_tags($item->pesan),
                                200
                            ) }}

                        </p>


                        {{-- FOOTER --}}
                        <div
                            class="flex items-center gap-5
                                   mt-3.5 text-xs"
                        >

                            <a
                                href="{{ route('pengumumanCalon.show', $item->id) }}"
                                class="inline-flex items-center
                                       gap-1.5
                                       text-[#00B686]
                                       hover:underline
                                       font-medium"
                            >

                                <svg
                                    class="w-3.5 h-3.5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M2 12s3-7 10-7
                                           10 7 10 7-3 7-10 7
                                           -10-7-10-7Z"
                                    />

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="3"
                                    />
                                </svg>

                                <span>
                                    Baca Selengkapnya
                                </span>

                            </a>

                        </div>

                    </div>

                </article>

            @empty

                {{-- EMPTY STATE --}}
                <div
                    class="bg-white border border-gray-200
                           rounded-2xl p-10
                           text-center shadow-xs"
                >

                    <div class="flex justify-center mb-4">

                        <div
                            class="w-16 h-16 rounded-2xl
                                   bg-emerald-50
                                   text-[#00B686]
                                   flex items-center
                                   justify-center"
                        >

                            <svg
                                class="w-8 h-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M21 15a2 2 0 0 1-2 2H7l-4 4V5
                                       a2 2 0 0 1 2-2h12
                                       a2 2 0 0 1 2 2z"
                                />
                            </svg>

                        </div>

                    </div>


                    <h3
                        class="text-lg font-semibold
                               text-slate-700"
                    >
                        Belum Ada Pengumuman
                    </h3>


                    <p class="text-slate-500 mt-2 text-sm">
                        Pengumuman untuk gelombang Anda
                        belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if ($pengumuman->hasPages())

            <div class="pt-6 pb-8 flex justify-center">

                {{ $pengumuman->links() }}

            </div>

        @endif

    </section>

</main>

@endsection