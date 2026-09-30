@extends('layout.app')

@section('title', 'Master Jadwal')
@section('page_title', 'Master Jadwal')

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
                onclick="switchJadwalTab('master-jadwal')"
                class="jadwal-tab flex items-center justify-center gap-2 rounded-xl
                       bg-[#02BC9C] px-4 py-3 text-sm font-semibold text-white
                       shadow-sm transition-all duration-200
                       hover:bg-[#00A98C]"
                role="tab"
                aria-controls="master-jadwal"
                aria-selected="true">

                <i
                    data-lucide="calendar-days"
                    class="h-4 w-4">
                </i>

                <span>
                    Master Jadwal
                </span>

            </button>


            {{-- Detail Jadwal --}}
            <button
                type="button"
                id="tab-detail-jadwal"
                onclick="switchJadwalTab('detail-jadwal')"
                class="jadwal-tab flex items-center justify-center gap-2 rounded-xl
                       px-4 py-3 text-sm font-semibold text-slate-500
                       transition-all duration-200
                       hover:bg-slate-50 hover:text-slate-700"
                role="tab"
                aria-controls="detail-jadwal"
                aria-selected="false">

                <i
                    data-lucide="list-checks"
                    class="h-4 w-4">
                </i>

                <span>
                    Detail Jadwal
                </span>

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
            class="jadwal-tab-content"
            role="tabpanel">

            @include('akademik.master_jadwal.master-jadwal')

        </div>


        {{-- Detail Jadwal --}}
        <div
            id="detail-jadwal"
            class="jadwal-tab-content hidden"
            role="tabpanel">

            @include('akademik.master_jadwal.detail-jadwal')

        </div>

    </div>

</div>


{{-- =============================================================
    MODALS
============================================================= --}}

@include('akademik.master_jadwal.tab.add-master-jadwal')

@include('akademik.master_jadwal.tab.edit-master-jadwal')


{{-- =============================================================
    TAB SCRIPT
============================================================= --}}
<script>
    function switchJadwalTab(tabName) {

        /*
        |--------------------------------------------------------------------------
        | Content
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.jadwal-tab-content')
            .forEach(function(content) {

                content.classList.add('hidden');

            });


        document
            .getElementById(tabName)
            .classList.remove('hidden');


        /*
        |--------------------------------------------------------------------------
        | Button
        |--------------------------------------------------------------------------
        */

        document.querySelectorAll('.jadwal-tab')
            .forEach(function(button) {

                // Reset button
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
        | Active button
        |--------------------------------------------------------------------------
        */

        const activeButton =
            document.getElementById(
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

    document.addEventListener(
        'DOMContentLoaded',
        function() {

            if (typeof lucide !== 'undefined') {

                lucide.createIcons();

            }

        }
    );
</script>

@endsection