@extends('layout.app')

@section('title', 'Data Siswa')
@section('page_title', $rows->exists ? 'Edit Siswa' : 'Tambah Siswa')

@section('content')

<main class="w-full flex-1 p-4 sm:p-6 lg:p-8 space-y-6 min-w-0">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center
        sm:justify-between gap-4">

        <div>

            <a href="{{ route('siswa.index') }}"
                class="inline-flex items-center gap-2
                text-sm font-medium text-slate-500
                hover:text-teal-600 transition mb-2">

                <i data-lucide="arrow-left"
                    class="w-4 h-4"></i>

                Kembali ke Data Siswa

            </a>

            <h1 class="text-2xl sm:text-3xl font-extrabold
                text-slate-900 tracking-tight">

                {{ $rows->exists ? 'Edit Siswa' : 'Tambah Siswa' }}

            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data siswa, orang tua, dan dokumen pendukung.
            </p>

        </div>

    </div>


    {{-- PESAN BERHASIL --}}
    @if (session('success'))

        <div class="rounded-xl border border-emerald-200
            bg-emerald-50 px-4 py-3 text-sm text-emerald-700">

            <div class="flex items-center gap-3">

                <i data-lucide="circle-check"
                    class="w-5 h-5 shrink-0"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif


    {{-- PESAN ERROR --}}
    @if (session('error'))

        <div class="rounded-xl border border-red-200
            bg-red-50 px-4 py-3 text-sm text-red-700">

            <div class="flex items-center gap-3">

                <i data-lucide="circle-alert"
                    class="w-5 h-5 shrink-0"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        </div>

    @endif


    {{-- ERROR VALIDASI --}}
    @if ($errors->any())

        <div class="rounded-xl border border-red-200
            bg-red-50 px-4 py-4 text-sm text-red-700">

            <div class="flex items-start gap-3">

                <i data-lucide="circle-alert"
                    class="w-5 h-5 mt-0.5 shrink-0"></i>

                <div class="flex-1">

                    <div class="font-semibold mb-2">
                        Data belum dapat disimpan:
                    </div>

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- TAB NAVIGATION --}}
    <div class="bg-white border border-slate-200
        rounded-2xl shadow-sm p-2">

        <div
            class="grid grid-cols-1 sm:grid-cols-3 gap-2"
            role="tablist"
            aria-label="Data Siswa">

            {{-- DATA SISWA --}}
            <button
                id="data-siswa-tab"
                type="button"
                role="tab"
                aria-controls="data-siswa-content"
                aria-selected="true"
                onclick="switchSiswaTab('data-siswa')"
                class="siswa-tab active">

                <i data-lucide="user"
                    class="w-4 h-4"></i>

                <span>
                    Data Siswa
                </span>

            </button>


            {{-- ORANG TUA --}}
            <button
                id="orang-tua-siswa-tab"
                type="button"
                role="tab"
                aria-controls="orang-tua-siswa-content"
                aria-selected="false"
                onclick="switchSiswaTab('orang-tua-siswa')"
                class="siswa-tab">

                <i data-lucide="users"
                    class="w-4 h-4"></i>

                <span>
                    Orang Tua
                </span>

            </button>


            {{-- UPLOAD DOKUMEN --}}
            <button
                id="upload-siswa-tab"
                type="button"
                role="tab"
                aria-controls="upload-siswa-content"
                aria-selected="false"
                onclick="switchSiswaTab('upload-siswa')"
                class="siswa-tab">

                <i data-lucide="upload-cloud"
                    class="w-4 h-4"></i>

                <span>
                    Upload Dokumen
                </span>

            </button>

        </div>

    </div>


    {{-- TAB CONTENT --}}
    <div>

        {{-- DATA SISWA --}}
        <div
            id="data-siswa-content"
            role="tabpanel"
            aria-labelledby="data-siswa-tab"
            class="siswa-content">

            @include('siswa.tab.data_siswa')

        </div>


        {{-- ORANG TUA --}}
        <div
            id="orang-tua-siswa-content"
            role="tabpanel"
            aria-labelledby="orang-tua-siswa-tab"
            class="siswa-content hidden">

            @include('siswa.tab.orang_tua')

        </div>


        {{-- UPLOAD DOKUMEN --}}
        <div
            id="upload-siswa-content"
            role="tabpanel"
            aria-labelledby="upload-siswa-tab"
            class="siswa-content hidden">

            @include('siswa.tab.upload')

        </div>

    </div>

</main>


{{-- TAB SCRIPT --}}
<script>
    function switchSiswaTab(tab) {

        const tabs = [
            'data-siswa',
            'orang-tua-siswa',
            'upload-siswa'
        ];

        tabs.forEach(function(item) {

            const button = document.getElementById(item + '-tab');
            const content = document.getElementById(item + '-content');

            if (!button || !content) {
                return;
            }

            if (item === tab) {

                // Aktifkan tab
                button.classList.add(
                    'bg-teal-50',
                    'text-teal-700',
                    'shadow-sm'
                );

                button.classList.remove(
                    'text-slate-500',
                    'hover:bg-slate-50'
                );

                button.setAttribute('aria-selected', 'true');

                // Tampilkan content
                content.classList.remove('hidden');

            } else {

                // Nonaktifkan tab
                button.classList.remove(
                    'bg-teal-50',
                    'text-teal-700',
                    'shadow-sm'
                );

                button.classList.add(
                    'text-slate-500',
                    'hover:bg-slate-50'
                );

                button.setAttribute('aria-selected', 'false');

                // Sembunyikan content
                content.classList.add('hidden');

            }

        });

        // Refresh icon Lucide jika diperlukan
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }


    // Inisialisasi tab pertama
    document.addEventListener('DOMContentLoaded', function() {

        switchSiswaTab('data-siswa');

    });
</script>


<style>
    .siswa-tab {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;

        width: 100%;

        padding: 0.75rem 1rem;

        border-radius: 0.75rem;

        font-size: 0.875rem;
        font-weight: 600;

        color: rgb(100 116 139);

        transition:
            background-color 150ms ease,
            color 150ms ease,
            box-shadow 150ms ease;
    }

    .siswa-tab:hover {
        background-color: rgb(248 250 252);
    }

    .siswa-tab.active {
        background-color: rgb(240 253 250);
        color: rgb(15 118 110);

        box-shadow:
            0 1px 2px 0 rgb(0 0 0 / 0.05);
    }
</style>

@endsection