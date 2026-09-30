@extends('layout.main')

@section('tittle')
Nilai
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Nilai</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <ul class="nav nav-boxed-tabs" role="tablist">

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2 active"
                data-tw-toggle="pill"
                data-tw-target="#master-nilai"
                type="button"
                role="tab"
                aria-controls="master-nilai"
                aria-selected="true">

                Master Nilai

            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#nilai-pts"
                type="button"
                role="tab"
                aria-controls="nilai-pts"
                aria-selected="false">

                Nilai PTS

            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#nilai-harian"
                type="button"
                role="tab"
                aria-controls="nilai-harian"
                aria-selected="false">

                Nilai Harian

            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#detail-nilai"
                type="button"
                role="tab"
                aria-controls="detail-nilai"
                aria-selected="false">

                Detail Nilai

            </button>
        </li>

    </ul>

    <div class="tab-content mt-5">

        <!-- MASTER NILAI -->
        <div
            id="master-nilai"
            class="tab-pane leading-relaxed active"
            role="tabpanel">

            @include('akademik.nilai.tab.master_nilai')

        </div>

        <!-- PTS -->
        <div
            id="nilai-pts"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('akademik.nilai.tab.pts')

        </div>

        <!-- HARIAN -->
        <div
            id="nilai-harian"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('akademik.nilai.tab.harian')

        </div>

        <!-- DETAIL NILAI -->
        <div
            id="detail-nilai"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('akademik.nilai.tab.detail_nilai')

        </div>

    </div>

</div>

@endsection