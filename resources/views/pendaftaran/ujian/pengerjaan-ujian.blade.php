@extends('layout.app')

@section('title', 'Ujian PPDB 2026')
@section('page_title', 'Registrasi Siswa Baru')

@section('content')

<main id="exam-active-view"
      class="flex-1 flex flex-col lg:flex-row overflow-y-auto p-4 sm:p-6 lg:p-8 gap-6 lg:gap-8">


<!-- FORM UTAMA -->
<form
    id="form-ujian"
    action="{{ route('ujianCalon.submit', $peserta) }}"
    method="POST"
    class="flex-1 flex flex-col"
>
    @csrf

    <!-- ============================= -->
    <!-- LEFT : SOAL -->
    <!-- ============================= -->
    <section class="flex-1 flex flex-col justify-between">

        <div>

            <!-- HEADER -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">

                <div>

                    <h3
                        id="question-header-title"
                        class="text-xl sm:text-2xl font-bold text-slate-900 tracking-tight"
                    >
                        Question 1 of {{ $soal->count() }}
                    </h3>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        {{ $peserta->ujian->nama_ujian }}
                    </p>

                </div>

                <!-- PROGRESS -->
                <div class="flex items-center gap-3">

                    <span
                        id="progress-text"
                        class="text-xs font-semibold text-slate-600"
                    >
                        Progress: 0%
                    </span>

                    <div class="w-28 sm:w-36 h-2 bg-slate-200 rounded-full overflow-hidden">

                        <div
                            id="progress-bar-fill"
                            class="bg-[#004D40] h-full rounded-full transition-all duration-300"
                            style="width: 0%;"
                        ></div>

                    </div>

                </div>

            </div>


            <!-- SOAL -->
            <div
                class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-7 shadow-sm mb-6"
            >

                <div
                    id="question-prompt"
                    class="text-slate-700 text-base leading-relaxed mb-6"
                >
                </div>


                <!-- PILIHAN -->
                <div
                    id="options-container"
                    class="space-y-3.5"
                >
                </div>

            </div>

        </div>


        <!-- NAVIGASI -->
        <div class="flex items-center justify-between pt-2 gap-3">

            <button
                id="btn-prev"
                type="button"
                onclick="goToPrevQuestion()"
                class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-lg border border-[#00BFA5] text-[#00BFA5] font-semibold text-sm bg-white hover:bg-[#E0F2F1] transition shadow-sm disabled:opacity-40 disabled:pointer-events-none"
            >

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.5"
                    />
                </svg>

                <span>Previous</span>

            </button>


            <button
                id="btn-next"
                type="button"
                onclick="goToNextQuestion()"
                class="inline-flex items-center gap-2 px-5 sm:px-6 py-2.5 rounded-lg bg-[#00BFA5] text-white font-semibold text-sm hover:bg-[#009688] transition shadow-sm"
            >

                <span id="btn-next-label">
                    Next Question
                </span>

                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M14 5l7 7m0 0l-7 7m7-7H3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.5"
                    />
                </svg>

            </button>

        </div>

    </section>


    <!-- ============================= -->
    <!-- RIGHT : STATUS -->
    <!-- ============================= -->
    <aside
        class="w-full lg:w-80 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 flex flex-col justify-between shadow-sm shrink-0"
    >

        <div>

            <!-- TIMER -->
            <div
                class="border border-slate-200 rounded-xl py-4 px-3 text-center mb-6 bg-white"
            >

                <div
                    class="inline-flex items-center gap-1.5 text-slate-600 text-[11px] font-bold tracking-wider uppercase mb-1"
                >

                    <svg
                        class="w-3.5 h-3.5 text-slate-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-width="2"
                        />

                        <path
                            d="M12 7v5l3 3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                        />

                    </svg>

                    <span>Time Remaining</span>

                </div>

                <div
                    id="exam-timer"
                    class="text-3xl font-extrabold text-[#00BFA5] tracking-widest font-mono"
                >
                    00:00:00
                </div>

            </div>


            <!-- STATUS SOAL -->
            <div class="mb-4">

                <div class="flex items-center justify-between mb-3">

                    <h4
                        class="text-xs font-bold text-slate-500 tracking-wider uppercase"
                    >
                        Question Status
                    </h4>

                    <span
                        id="answered-count-badge"
                        class="text-[11px] font-semibold text-teal-700 bg-teal-50 px-2 py-0.5 rounded"
                    >
                        0/{{ $soal->count() }} Terjawab
                    </span>

                </div>


                <div
                    id="question-grid-container"
                    class="grid grid-cols-5 gap-2.5"
                >
                </div>

            </div>

        </div>


        <!-- SUBMIT -->
        <div class="pt-4">

            <button
                type="button"
                onclick="promptSubmitExam()"
                class="w-full py-3.5 px-4 bg-[#BE1E24] hover:bg-[#A3161C] text-white font-semibold rounded-xl flex items-center justify-center gap-2 shadow-md transition"
            >

                <svg
                    class="w-4 h-4 rotate-45 transform -translate-y-0.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                    />
                </svg>

                <span>Submit Exam</span>

            </button>

            <p class="text-[11px] text-slate-400 text-center mt-2.5">
                Silakan periksa seluruh jawaban sebelum mengirim.
            </p>

        </div>

    </aside>

</form>
```

</main>

<!-- ============================= -->

<!-- MODAL KONFIRMASI -->

<!-- ============================= -->

<div
    id="modal-confirm-submit"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
>

```
<div
    class="relative w-full max-w-md bg-white rounded-3xl p-6 sm:p-7 shadow-2xl"
>

    <div
        class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4 border border-amber-100"
    >
        ⚠
    </div>

    <h3 class="text-lg font-bold text-slate-900 mb-1">
        Konfirmasi Selesaikan Ujian
    </h3>

    <p
        id="submit-confirm-desc"
        class="text-xs text-slate-500 leading-relaxed mb-5"
    >
        Apakah Anda yakin ingin menyelesaikan ujian?
    </p>


    <div
        class="bg-slate-50 rounded-xl p-3.5 border border-slate-200 mb-6 text-xs space-y-2"
    >

        <div class="flex justify-between">

            <span class="text-slate-500">
                Soal Terjawab:
            </span>

            <span
                id="modal-answered-stat"
                class="font-bold text-slate-800"
            >
                0 dari {{ $soal->count() }} Soal
            </span>

        </div>


        <div class="flex justify-between">

            <span class="text-slate-500">
                Sisa Waktu:
            </span>

            <span
                id="modal-timer-stat"
                class="font-bold text-teal-600"
            >
                00:00:00
            </span>

        </div>

    </div>


    <div class="flex items-center gap-3">

        <button
            onclick="closeSubmitModal()"
            type="button"
            class="w-1/2 py-2.5 px-4 rounded-xl border border-slate-300 text-slate-700 font-semibold text-xs hover:bg-slate-50"
        >
            Periksa Kembali
        </button>

        <button
            onclick="finalizeExamSubmission()"
            type="button"
            class="w-1/2 py-2.5 px-4 rounded-xl bg-[#BE1E24] hover:bg-[#A3161C] text-white font-bold text-xs"
        >
            Ya, Kumpulkan
        </button>

    </div>

</div>


</div>

@endsection

@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | DATA SOAL DARI LARAVEL
    |--------------------------------------------------------------------------
    */

   const questions = @json($questions);


    /*
    |--------------------------------------------------------------------------
    | STATE
    |--------------------------------------------------------------------------
    */

    let currentQuestionIndex = 0;

    let userAnswers = {};

    let timerInterval = null;

    let isExamFinished = false;


    /*
    |--------------------------------------------------------------------------
    | INIT
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function () {

        renderQuestionGrid();

        renderCurrentQuestion();

        startTimer();

    });


    /*
    |--------------------------------------------------------------------------
    | RENDER GRID
    |--------------------------------------------------------------------------
    */

    function renderQuestionGrid() {

        const container =
            document.getElementById('question-grid-container');

        container.innerHTML = '';

        questions.forEach(function (question, index) {

            const button =
                document.createElement('button');

            button.type = 'button';

            button.innerText = index + 1;

            button.className =
                getGridButtonClass(index);

            button.onclick = function () {

                jumpToQuestion(index);

            };

            container.appendChild(button);

        });

        updateAnsweredBadge();

    }


    function getGridButtonClass(index) {

        const question = questions[index];

        const answered =
            userAnswers[question.id] !== undefined &&
            userAnswers[question.id] !== null;

        const current =
            index === currentQuestionIndex;


        if (current) {

            return `
                h-10 rounded-xl
                border-2 border-[#00BFA5]
                text-[#00BFA5]
                bg-teal-50
                font-bold text-sm
                flex items-center justify-center
            `;

        }


        if (answered) {

            return `
                h-10 rounded-xl
                bg-[#00BFA5]
                text-white
                font-semibold text-sm
                flex items-center justify-center
            `;

        }


        return `
            h-10 rounded-xl
            border border-slate-200
            text-slate-700
            font-medium text-sm
            flex items-center justify-center
            hover:bg-slate-50
        `;

    }


    /*
    |--------------------------------------------------------------------------
    | RENDER SOAL AKTIF
    |--------------------------------------------------------------------------
    */

    function renderCurrentQuestion() {

        const question =
            questions[currentQuestionIndex];

        if (!question) return;


        /*
        | HEADER
        */

        document.getElementById(
            'question-header-title'
        ).innerText =
            `Question ${currentQuestionIndex + 1} of ${questions.length}`;


        /*
        | PROGRESS
        */

        const percent =
            Math.round(
                ((currentQuestionIndex + 1) /
                questions.length) * 100
            );


        document.getElementById(
            'progress-text'
        ).innerText =
            `Progress: ${percent}%`;


        document.getElementById(
            'progress-bar-fill'
        ).style.width =
            `${percent}%`;


        /*
        | PERTANYAAN
        */

        document.getElementById(
            'question-prompt'
        ).innerHTML =
            nl2br(question.text);


        /*
        | PILIHAN
        */

        const container =
            document.getElementById(
                'options-container'
            );

        container.innerHTML = '';


        question.options.forEach(function (option) {

            const selected =
                userAnswers[question.id] === option.key;


            const label =
                document.createElement('label');


            label.className = selected

                ? 'flex items-center gap-4 p-4 rounded-xl border-2 border-[#00BFA5] bg-teal-50/20 cursor-pointer transition'

                : 'flex items-center gap-4 p-4 rounded-xl border border-slate-200 bg-white hover:border-slate-300 cursor-pointer transition';


            label.innerHTML = `

                <input
                    type="radio"
                    name="question_opt"
                    value="${option.key}"
                    ${selected ? 'checked' : ''}
                    class="sr-only"
                >

                <div
                    class="
                        w-8 h-8 rounded-full border
                        ${selected
                            ? 'border-[#00BFA5] bg-[#00BFA5] text-white'
                            : 'border-slate-200 bg-slate-100 text-slate-600'
                        }
                        flex items-center justify-center
                        font-bold text-sm shrink-0
                    "
                >
                    ${option.key}
                </div>

                <span class="text-base text-slate-700">
                    ${escapeHtml(option.text)}
                </span>

            `;


            const input =
                label.querySelector('input');


            input.addEventListener(
                'change',
                function () {

                    selectAnswer(
                        question.id,
                        option.key
                    );

                }
            );


            container.appendChild(label);

        });


        /*
        | PREVIOUS
        */

        document.getElementById(
            'btn-prev'
        ).disabled =
            currentQuestionIndex === 0;


        /*
        | NEXT
        */

        document.getElementById(
            'btn-next-label'
        ).innerText =
            currentQuestionIndex === questions.length - 1
                ? 'Selesai & Review'
                : 'Next Question';


        renderQuestionGrid();

    }


    /*
    |--------------------------------------------------------------------------
    | PILIH JAWABAN
    |--------------------------------------------------------------------------
    */

    function selectAnswer(questionId, answer) {

        userAnswers[questionId] = answer;


        /*
        | Buat hidden input untuk dikirim Laravel
        */

        syncHiddenAnswers();


        renderCurrentQuestion();

    }


    /*
    |--------------------------------------------------------------------------
    | SYNC JAWABAN KE FORM
    |--------------------------------------------------------------------------
    */

    function syncHiddenAnswers() {

        const form =
            document.getElementById('form-ujian');


        /*
        | Hapus hidden input lama
        */

        form.querySelectorAll(
            '.dynamic-answer'
        ).forEach(function (element) {

            element.remove();

        });


        /*
        | Buat input baru
        */

        Object.keys(userAnswers).forEach(function (questionId) {

            const input =
                document.createElement('input');

            input.type = 'hidden';

            input.name =
                `jawaban[${questionId}]`;

            input.value =
                userAnswers[questionId];

            input.className =
                'dynamic-answer';


            form.appendChild(input);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | NAVIGASI
    |--------------------------------------------------------------------------
    */

    function jumpToQuestion(index) {

        if (
            index >= 0 &&
            index < questions.length
        ) {

            currentQuestionIndex = index;

            renderCurrentQuestion();

        }

    }


    function goToPrevQuestion() {

        if (currentQuestionIndex > 0) {

            currentQuestionIndex--;

            renderCurrentQuestion();

        }

    }


    function goToNextQuestion() {

        if (
            currentQuestionIndex <
            questions.length - 1
        ) {

            currentQuestionIndex++;

            renderCurrentQuestion();

        } else {

            promptSubmitExam();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | BADGE
    |--------------------------------------------------------------------------
    */

    function updateAnsweredBadge() {

        const answered =
            Object.keys(userAnswers).length;


        document.getElementById(
            'answered-count-badge'
        ).innerText =
            `${answered}/${questions.length} Terjawab`;

    }


    /*
    |--------------------------------------------------------------------------
    | TIMER
    |--------------------------------------------------------------------------
    */

    const batasWaktu =
        new Date(
            @json($batasWaktu->toIso8601String())
        ).getTime();


    function startTimer() {

        const timerElement =
            document.getElementById(
                'exam-timer'
            );


        function updateTimer() {

            const sekarang =
                new Date().getTime();


            const selisih =
                batasWaktu - sekarang;


            if (selisih <= 0) {

                clearInterval(timerInterval);

                timerElement.innerText =
                    '00:00:00';


                alert(
                    'Waktu ujian telah habis. Jawaban akan otomatis dikirim.'
                );


                syncHiddenAnswers();


                document.getElementById(
                    'form-ujian'
                ).submit();


                return;

            }


            const totalSeconds =
                Math.floor(
                    selisih / 1000
                );


            const jam =
                Math.floor(
                    totalSeconds / 3600
                );


            const menit =
                Math.floor(
                    (totalSeconds % 3600) / 60
                );


            const detik =
                totalSeconds % 60;


            timerElement.innerText =

                String(jam).padStart(2, '0')
                + ':'
                +
                String(menit).padStart(2, '0')
                + ':'
                +
                String(detik).padStart(2, '0');

        }


        updateTimer();


        timerInterval =
            setInterval(
                updateTimer,
                1000
            );

    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT MODAL
    |--------------------------------------------------------------------------
    */

    function promptSubmitExam() {

        const answered =
            Object.keys(userAnswers).length;


        document.getElementById(
            'modal-answered-stat'
        ).innerText =
            `${answered} dari ${questions.length} Soal`;


        document.getElementById(
            'modal-timer-stat'
        ).innerText =
            document.getElementById(
                'exam-timer'
            ).innerText;


        const desc =
            document.getElementById(
                'submit-confirm-desc'
            );


        if (
            answered < questions.length
        ) {

            desc.innerHTML = `
                <span class="text-amber-600 font-bold">
                    Perhatian:
                </span>

                Masih ada

                <b>
                    ${questions.length - answered}
                    soal yang belum dijawab
                </b>.

                Apakah Anda tetap ingin mengumpulkan?
            `;

        } else {

            desc.innerHTML = `
                Seluruh
                <b>
                    ${questions.length} soal
                </b>
                telah dijawab.

                Apakah Anda yakin ingin mengumpulkan
                jawaban?
            `;

        }


        const modal =
            document.getElementById(
                'modal-confirm-submit'
            );


        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }


    function closeSubmitModal() {

        const modal =
            document.getElementById(
                'modal-confirm-submit'
            );


        modal.classList.add('hidden');

        modal.classList.remove('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | FINAL SUBMIT
    |--------------------------------------------------------------------------
    */

    function finalizeExamSubmission() {

        if (isExamFinished) return;


        isExamFinished = true;


        if (timerInterval) {

            clearInterval(timerInterval);

        }


        syncHiddenAnswers();


        document.getElementById(
            'form-ujian'
        ).submit();

    }


    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    function nl2br(text) {

        return escapeHtml(text)
            .replace(
                /\r?\n/g,
                '<br>'
            );

    }


    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent =
            text ?? '';

        return div.innerHTML;

    }

</script>

@endpush
