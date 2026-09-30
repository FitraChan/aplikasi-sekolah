@extends('layout.main')

@section('tittle')
Master Soal & Ujian
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Data Soal</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <ul class="nav nav-boxed-tabs" role="tablist">

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2 active"
                data-tw-toggle="pill"
                data-tw-target="#tab-jadwal"
                type="button"
                role="tab"
                aria-controls="tab-jadwal"
                aria-selected="true">
                Master Jadwal
            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#tab-soal"
                type="button"
                role="tab"
                aria-controls="tab-soal"
                aria-selected="false">
                Master Soal
            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#tab-ujian"
                type="button"
                role="tab"
                aria-controls="tab-ujian"
                aria-selected="false">
                Master Ujian
            </button>
        </li>

    </ul>

    <div class="tab-content mt-5">

        {{-- Master Jadwal --}}
        <div
            id="tab-jadwal"
            class="tab-pane leading-relaxed active"
            role="tabpanel">

            @include('akademik.soal.jadwal')

        </div>

        {{-- Master Soal --}}
        <div
            id="tab-soal"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('akademik.soal.soal')

        </div>

        {{-- Master Ujian --}}
        <div
            id="tab-ujian"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('akademik.soal.ujian')

        </div>

    </div>

</div>

@endsection