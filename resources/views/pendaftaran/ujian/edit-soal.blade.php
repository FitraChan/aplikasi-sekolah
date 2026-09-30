@extends('layout.app')

@section('title', 'Edit Soal')
@section('page_title', 'Edit Soal')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl
                        bg-amber-50
                        flex items-center justify-center
                        text-amber-600">

                <i data-lucide="pencil" class="w-6 h-6"></i>

            </div>

            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold
                           text-slate-900 tracking-tight">
                    Edit Soal
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Perbarui pertanyaan dan pilihan jawaban.
                </p>
            </div>

        </div>

        {{-- KEMBALI --}}
        <a href="{{ route('soalCalon.index', [
                    'id' => $soal->id_ujian
                ]) }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5
                  rounded-xl
                  border border-slate-200
                  bg-white
                  text-slate-600
                  text-sm font-semibold
                  hover:bg-slate-50
                  transition">

            <i data-lucide="arrow-left" class="w-4 h-4"></i>

            Kembali

        </a>

    </div>


    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="flex items-center gap-3
                    px-5 sm:px-6 py-4
                    border-b border-slate-200
                    bg-slate-50/70">

            <div class="w-10 h-10 rounded-xl
                        bg-amber-50
                        flex items-center justify-center
                        text-amber-600">

                <i data-lucide="file-pen-line"
                   class="w-5 h-5"></i>

            </div>

            <div>
                <h2 class="text-base font-bold text-slate-800">
                    Informasi Soal
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Edit data soal ujian
                </p>
            </div>

        </div>


        <form
            action="{{ route('soalCalon.update', [
                'soal' => $soal->id
            ]) }}"
            method="POST"
            class="p-5 sm:p-6">

            @csrf
            @method('PUT')


            {{-- ERROR UMUM --}}
            @if ($errors->any())

                <div class="mb-6 rounded-xl
                            border border-red-200
                            bg-red-50
                            px-4 py-3
                            text-sm text-red-700">

                    <div class="flex items-center gap-2 font-semibold">

                        <i data-lucide="circle-alert"
                           class="w-5 h-5"></i>

                        Terdapat kesalahan

                    </div>

                    <ul class="mt-2 list-disc list-inside space-y-1">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- PERTANYAAN --}}
            <div class="mb-6">

                <label for="pertanyaan"
                       class="block text-sm font-semibold
                              text-slate-700 mb-2">

                    Pertanyaan

                    <span class="text-red-500">*</span>

                </label>

                <textarea
                    id="pertanyaan"
                    name="pertanyaan"
                    rows="6"
                    required
                    placeholder="Tuliskan pertanyaan..."
                    class="w-full rounded-xl
                           border border-slate-200
                           bg-white
                           px-4 py-3
                           text-sm text-slate-700
                           placeholder:text-slate-400
                           outline-none
                           focus:border-teal-500
                           focus:ring-4
                           focus:ring-teal-500/10
                           transition"
                >{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>

                @error('pertanyaan')

                    <p class="flex items-center gap-1.5
                              mt-1.5
                              text-xs font-medium text-red-600">

                        <i data-lucide="circle-alert"
                           class="w-3.5 h-3.5"></i>

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- PILIHAN JAWABAN --}}
            <div>

                <div class="flex items-center gap-2 mb-4">

                    <div class="w-8 h-8 rounded-lg
                                bg-blue-50
                                flex items-center justify-center
                                text-blue-600">

                        <i data-lucide="list"
                           class="w-4 h-4"></i>

                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">
                            Pilihan Jawaban
                        </h3>

                        <p class="text-xs text-slate-500">
                            Pilihan E bersifat opsional.
                        </p>
                    </div>

                </div>


                <div class="space-y-4">

                    @foreach (['A', 'B', 'C', 'D', 'E'] as $pilihan)

                        @php
                            $field = 'pilihan_' . strtolower($pilihan);
                        @endphp

                        <div>

                            <label for="{{ $field }}"
                                   class="flex items-center gap-2
                                          text-sm font-semibold
                                          text-slate-700 mb-2">

                                <span class="w-7 h-7 rounded-lg
                                             bg-slate-100
                                             flex items-center justify-center
                                             text-xs font-bold
                                             text-slate-600">

                                    {{ $pilihan }}

                                </span>

                                Pilihan {{ $pilihan }}

                                @if ($pilihan !== 'E')

                                    <span class="text-red-500">*</span>

                                @else

                                    <span class="text-xs font-normal
                                                 text-slate-400">
                                        (opsional)
                                    </span>

                                @endif

                            </label>


                            <textarea
                                id="{{ $field }}"
                                name="{{ $field }}"
                                rows="2"
                                @required($pilihan !== 'E')
                                placeholder="Tuliskan pilihan {{ $pilihan }}..."
                                class="w-full rounded-xl
                                       border border-slate-200
                                       bg-white
                                       px-4 py-3
                                       text-sm text-slate-700
                                       placeholder:text-slate-400
                                       outline-none
                                       focus:border-teal-500
                                       focus:ring-4
                                       focus:ring-teal-500/10
                                       transition"
                            >{{ old($field, $soal->$field) }}</textarea>


                            @error($field)

                                <p class="flex items-center gap-1.5
                                          mt-1.5
                                          text-xs font-medium
                                          text-red-600">

                                    <i data-lucide="circle-alert"
                                       class="w-3.5 h-3.5"></i>

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- JAWABAN BENAR + BOBOT --}}
            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-5 mt-6">


                {{-- JAWABAN BENAR --}}
                <div>

                    <label for="jawaban_benar"
                           class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Jawaban Benar

                        <span class="text-red-500">*</span>

                    </label>


                    <div class="relative">

                        <select
                            id="jawaban_benar"
                            name="jawaban_benar"
                            required
                            class="w-full appearance-none
                                   rounded-xl
                                   border border-slate-200
                                   bg-white
                                   px-4 py-3 pr-10
                                   text-sm text-slate-700
                                   outline-none
                                   focus:border-teal-500
                                   focus:ring-4
                                   focus:ring-teal-500/10
                                   transition">

                            <option value="">
                                Pilih jawaban
                            </option>

                            @foreach (['A', 'B', 'C', 'D', 'E'] as $pilihan)

                                <option
                                    value="{{ $pilihan }}"
                                    @selected(
                                        old(
                                            'jawaban_benar',
                                            $soal->jawaban_benar
                                        ) === $pilihan
                                    )
                                >
                                    Jawaban {{ $pilihan }}
                                </option>

                            @endforeach

                        </select>

                        <i data-lucide="chevron-down"
                           class="absolute right-3 top-1/2
                                  -translate-y-1/2
                                  w-4 h-4
                                  text-slate-400
                                  pointer-events-none"></i>

                    </div>


                    @error('jawaban_benar')

                        <p class="flex items-center gap-1.5
                                  mt-1.5
                                  text-xs font-medium
                                  text-red-600">

                            <i data-lucide="circle-alert"
                               class="w-3.5 h-3.5"></i>

                            {{ $message }}

                        </p>

                    @enderror

                </div>


                {{-- BOBOT --}}
                <div>

                    <label for="bobot"
                           class="block text-sm font-semibold
                                  text-slate-700 mb-2">

                        Bobot

                        <span class="text-red-500">*</span>

                    </label>


                    <input
                        id="bobot"
                        type="number"
                        name="bobot"
                        value="{{ old('bobot', $soal->bobot) }}"
                        min="0.01"
                        step="0.01"
                        required
                        placeholder="1"
                        class="w-full rounded-xl
                               border border-slate-200
                               bg-white
                               px-4 py-3
                               text-sm text-slate-700
                               placeholder:text-slate-400
                               outline-none
                               focus:border-teal-500
                               focus:ring-4
                               focus:ring-teal-500/10
                               transition"
                    />


                    @error('bobot')

                        <p class="flex items-center gap-1.5
                                  mt-1.5
                                  text-xs font-medium
                                  text-red-600">

                            <i data-lucide="circle-alert"
                               class="w-3.5 h-3.5"></i>

                            {{ $message }}

                        </p>

                    @enderror

                </div>

            </div>


            {{-- STATUS --}}
            <div class="mt-6">

                <label class="flex items-center gap-3
                              cursor-pointer
                              p-4 rounded-xl
                              border border-slate-200
                              bg-slate-50/50
                              hover:bg-slate-50
                              transition">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        @checked(
                            old('status', $soal->status)
                        )
                        class="w-5 h-5
                               rounded
                               border-slate-300
                               text-teal-600
                               focus:ring-teal-500"
                    >

                    <div>

                        <div class="text-sm font-semibold text-slate-700">
                            Soal Aktif
                        </div>

                        <div class="text-xs text-slate-500 mt-0.5">
                            Soal dapat digunakan dalam ujian.
                        </div>

                    </div>

                </label>

            </div>


            {{-- ACTION --}}
            <div class="flex flex-col-reverse sm:flex-row
                        sm:items-center
                        justify-end gap-3
                        mt-8 pt-5
                        border-t border-slate-200">


                {{-- KEMBALI --}}
                <a
                    href="{{ route('soalCalon.index', [
                        'id' => $soal->id_ujian
                    ]) }}"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5
                           rounded-xl
                           border border-slate-200
                           bg-white
                           text-slate-600
                           text-sm font-semibold
                           hover:bg-slate-50
                           transition">

                    <i data-lucide="arrow-left"
                       class="w-4 h-4"></i>

                    Kembali

                </a>


                {{-- UPDATE --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5
                           rounded-xl
                           bg-teal-600
                           hover:bg-teal-700
                           text-white
                           text-sm font-semibold
                           shadow-sm
                           transition">

                    <i data-lucide="save"
                       class="w-4 h-4"></i>

                    Update Soal

                </button>

            </div>

        </form>

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