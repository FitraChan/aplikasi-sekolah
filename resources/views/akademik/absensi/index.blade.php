@extends('layout.app')

@section('title', 'Absensi')
@section('page_title', 'Absensi')

@section('content')

<div class="w-full max-w-[1600px] mx-auto p-4 sm:p-6 lg:p-8">

    {{-- =========================================================
        TAB NAVIGATION
    ========================================================== --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-2 shadow-sm">

        <div class="grid grid-cols-2 gap-2" role="tablist">

            {{-- Master Jadwal --}}
            <button
                type="button"
                id="tab-master-jadwal"
                onclick="switchAbsensiTab('master-jadwal')"
                class="absensi-tab flex items-center justify-center gap-2 rounded-xl
                       bg-[#02BC9C] px-4 py-3 text-sm font-semibold text-white
                       shadow-sm transition-all duration-200
                       hover:bg-[#00A98C]"
                role="tab"
                aria-controls="master-jadwal"
                aria-selected="true">

                <i data-lucide="calendar-days" class="h-4 w-4"></i>

                <span>Master Jadwal</span>

            </button>


            {{-- Proses Belajar Mengajar --}}
            <button
                type="button"
                id="tab-detail-jadwal"
                onclick="switchAbsensiTab('detail-jadwal')"
                class="absensi-tab flex items-center justify-center gap-2 rounded-xl
                       px-4 py-3 text-sm font-semibold text-slate-500
                       transition-all duration-200
                       hover:bg-slate-50 hover:text-slate-700"
                role="tab"
                aria-controls="detail-jadwal"
                aria-selected="false">

                <i data-lucide="clipboard-check" class="h-4 w-4"></i>

                <span>Proses Belajar Mengajar</span>

            </button>

        </div>

    </div>


    {{-- =========================================================
        TAB CONTENT
    ========================================================== --}}
    <div class="mt-5">

        {{-- Master Jadwal --}}
        <div
            id="master-jadwal"
            class="absensi-tab-content"
            role="tabpanel"
            aria-labelledby="tab-master-jadwal">

            @include('akademik.absensi.master-jadwal')

        </div>


        {{-- Proses Belajar Mengajar --}}
        <div
            id="detail-jadwal"
            class="absensi-tab-content hidden"
            role="tabpanel"
            aria-labelledby="tab-detail-jadwal">

            @include('akademik.absensi.proses_absensi')

        </div>

    </div>

</div>


{{-- =============================================================
    MODALS
============================================================= --}}

@include('akademik.absensi.tab.add-absen')

@include('akademik.absensi.tab.edit-absen')

@include('akademik.absensi.tab.add-rekap')


{{-- =============================================================
    TAB SCRIPT
============================================================= --}}
<script>
    function switchAbsensiTab(tabName) {

        /*
        |--------------------------------------------------------------------------
        | Tab Content
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.absensi-tab-content')
            .forEach(function(content) {

                content.classList.add('hidden');

            });


        document
            .getElementById(tabName)
            .classList.remove('hidden');


        /*
        |--------------------------------------------------------------------------
        | Reset Button
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.absensi-tab')
            .forEach(function(button) {

                button.classList.remove(
                    'bg-[#02BC9C]',
                    'text-white',
                    'shadow-sm'
                );

                button.classList.add(
                    'text-slate-500'
                );

                button.setAttribute(
                    'aria-selected',
                    'false'
                );

            });


        /*
        |--------------------------------------------------------------------------
        | Active Button
        |--------------------------------------------------------------------------
        */

        const activeButton = document.getElementById(
            'tab-' + tabName
        );

        activeButton.classList.remove(
            'text-slate-500'
        );

        activeButton.classList.add(
            'bg-[#02BC9C]',
            'text-white',
            'shadow-sm'
        );

        activeButton.setAttribute(
            'aria-selected',
            'true'
        );


        /*
        |--------------------------------------------------------------------------
        | Refresh Lucide
        |--------------------------------------------------------------------------
        */

        if (typeof lucide !== 'undefined') {

            lucide.createIcons();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Lucide
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function() {

        if (typeof lucide !== 'undefined') {

            lucide.createIcons();

        }

    });
</script>

@endsection