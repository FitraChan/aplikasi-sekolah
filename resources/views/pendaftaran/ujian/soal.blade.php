@extends('layout.app')

@section('title', 'Soal Ujian')
@section('page_title', 'Soal Ujian')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-xl bg-teal-50
                            flex items-center justify-center
                            text-teal-600">

                    <i data-lucide="file-question" class="w-6 h-6"></i>

                </div>

                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold
                               text-slate-900 tracking-tight">

                        Soal {{ $ujian->nama_ujian }}

                    </h1>

                    <div class="flex flex-wrap items-center gap-3 mt-1
                                text-sm text-slate-500">

                        <span class="inline-flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            Durasi {{ $ujian->durasi }} menit
                        </span>

                        <span class="text-slate-300">•</span>

                        <span class="inline-flex items-center gap-1.5">
                            <i data-lucide="help-circle" class="w-4 h-4"></i>
                            {{ $soal->total() }} Soal
                        </span>

                    </div>
                </div>

            </div>
        </div>


        {{-- TAMBAH SOAL --}}
        <a href="{{ route('soalCalon.create', ['ujian' => $ujian->id]) }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  bg-teal-600 hover:bg-teal-700
                  text-white text-sm font-semibold
                  shadow-sm transition">

            <i data-lucide="plus" class="w-5 h-5"></i>

            Tambah Soal

        </a>

    </div>


    {{-- SUCCESS --}}
    @if (session('success'))

        <div class="flex items-start gap-3
                    rounded-xl border border-emerald-200
                    bg-emerald-50
                    px-4 py-3
                    text-sm text-emerald-700">

            <i data-lucide="circle-check"
               class="w-5 h-5 flex-shrink-0 mt-0.5"></i>

            <div>
                <div class="font-semibold">
                    Berhasil
                </div>

                <div class="mt-0.5">
                    {{ session('success') }}
                </div>
            </div>

        </div>

    @endif


    {{-- DAFTAR SOAL --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="flex items-center justify-between
                    px-5 py-4
                    border-b border-slate-200
                    bg-slate-50/70">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-teal-50
                            flex items-center justify-center
                            text-teal-600">

                    <i data-lucide="list-checks"
                       class="w-5 h-5"></i>

                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-800">
                        Daftar Soal
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Kelola soal dan pilihan jawaban ujian
                    </p>
                </div>

            </div>

            <div class="hidden sm:flex items-center gap-2
                        px-3 py-1.5 rounded-lg
                        bg-white border border-slate-200
                        text-sm font-semibold text-slate-600">

                <i data-lucide="clipboard-list"
                   class="w-4 h-4 text-teal-600"></i>

                {{ $soal->total() }} Soal

            </div>

        </div>


        {{-- CONTENT --}}
        <div class="p-5 sm:p-6">

            @forelse ($soal as $item)

                <div class="border border-slate-200
                            rounded-2xl
                            p-5 sm:p-6
                            mb-5 last:mb-0
                            hover:border-slate-300
                            transition">

                    {{-- NOMOR + AKSI --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                justify-between gap-4">

                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-lg
                                        bg-teal-50
                                        text-teal-700
                                        flex items-center justify-center
                                        font-bold text-sm">

                                {{ $soal->firstItem() + $loop->index }}

                            </div>

                            <div>
                                <div class="text-sm font-bold text-slate-800">
                                    Soal {{ $soal->firstItem() + $loop->index }}
                                </div>

                                <div class="text-xs text-slate-400 mt-0.5">
                                    Pertanyaan pilihan ganda
                                </div>
                            </div>

                        </div>


                        {{-- AKSI --}}
                        <div class="flex items-center gap-2">

                            {{-- EDIT --}}
                            <a href="{{ route('soalCalon.edit', [
                                        'soal' => $item->id
                                    ]) }}"
                               class="inline-flex items-center gap-1.5
                                      px-3 py-2 rounded-lg
                                      bg-amber-50
                                      text-amber-700
                                      border border-amber-100
                                      text-xs font-semibold
                                      hover:bg-amber-100
                                      transition">

                                <i data-lucide="pencil"
                                   class="w-4 h-4"></i>

                                Edit

                            </a>


                            {{-- HAPUS --}}
                            <form
                                action="{{ route('soalCalon.destroy', [
                                    'soal' => $item->id
                                ]) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus soal ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-2 rounded-lg
                                               bg-red-50
                                               text-red-700
                                               border border-red-100
                                               text-xs font-semibold
                                               hover:bg-red-100
                                               transition">

                                    <i data-lucide="trash-2"
                                       class="w-4 h-4"></i>

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </div>


                    {{-- PERTANYAAN --}}
                    <div class="mt-5">

                        <div class="text-base sm:text-[17px]
                                    leading-7
                                    font-medium
                                    text-slate-800">

                            {!! nl2br(e($item->pertanyaan)) !!}

                        </div>

                    </div>


                    {{-- PILIHAN JAWABAN --}}
                    <div class="grid grid-cols-1 md:grid-cols-2
                                gap-3 mt-5">

                        @foreach (['A', 'B', 'C', 'D', 'E'] as $pilihan)

                            @php
                                $field = 'pilihan_' . strtolower($pilihan);
                                $isCorrect = $item->jawaban_benar === $pilihan;
                            @endphp

                            @if ($item->$field)

                                <div class="flex items-start gap-3
                                            p-4 rounded-xl
                                            border
                                            {{ $isCorrect
                                                ? 'border-emerald-300 bg-emerald-50'
                                                : 'border-slate-200 bg-slate-50/50' }}">

                                    {{-- HURUF --}}
                                    <div class="w-8 h-8 flex-shrink-0
                                                rounded-lg
                                                flex items-center justify-center
                                                text-sm font-bold
                                                {{ $isCorrect
                                                    ? 'bg-emerald-600 text-white'
                                                    : 'bg-white text-slate-600 border border-slate-200' }}">

                                        {{ $pilihan }}

                                    </div>


                                    {{-- JAWABAN --}}
                                    <div class="flex-1 min-w-0">

                                        <div class="text-sm sm:text-[15px]
                                                    leading-6
                                                    {{ $isCorrect
                                                        ? 'text-emerald-800 font-semibold'
                                                        : 'text-slate-700' }}">

                                            {{ $item->$field }}

                                        </div>

                                        @if ($isCorrect)

                                            <div class="flex items-center gap-1.5
                                                        mt-2
                                                        text-xs font-semibold
                                                        text-emerald-600">

                                                <i data-lucide="circle-check"
                                                   class="w-4 h-4"></i>

                                                Jawaban benar

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="py-16 text-center">

                    <div class="w-16 h-16 mx-auto
                                rounded-2xl
                                bg-slate-100
                                flex items-center justify-center
                                text-slate-400">

                        <i data-lucide="file-question"
                           class="w-8 h-8"></i>

                    </div>

                    <h3 class="mt-4
                               text-base font-bold
                               text-slate-700">

                        Belum ada soal

                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Belum ada soal yang ditambahkan untuk ujian ini.
                    </p>

                    <a href="{{ route('soalCalon.create', [
                                'ujian' => $ujian->id
                            ]) }}"
                       class="inline-flex items-center gap-2
                              mt-5 px-4 py-2.5
                              rounded-xl
                              bg-teal-600 hover:bg-teal-700
                              text-white
                              text-sm font-semibold
                              transition">

                        <i data-lucide="plus"
                           class="w-4 h-4"></i>

                        Tambah Soal

                    </a>

                </div>

            @endforelse


            {{-- PAGINATION --}}
            @if ($soal->hasPages())

                <div class="mt-6 pt-5
                            border-t border-slate-200">

                    {{ $soal->links() }}

                </div>

            @endif

        </div>

    </div>

</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });
</script>

@endsection