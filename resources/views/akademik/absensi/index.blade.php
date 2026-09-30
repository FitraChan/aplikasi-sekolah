@extends('layout.main')

@section('tittle')
Absensi
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Absensi</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">
    <ul class="nav nav-boxed-tabs" role="tablist">
        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2 active"
                data-tw-toggle="pill"
                data-tw-target="#master-jadwal"
                type="button"
                role="tab"
                aria-controls="master-jadwal"
                aria-selected="true">

                Master Jadwal

            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#detail-jadwal"
                type="button"
                role="tab"
                aria-controls="detail-jadwal"
                aria-selected="false">

                Proses Belajar Mengajar

            </button>
        </li>

    </ul>

    <div class="tab-content mt-5">

        <div
            id="master-jadwal"
            class="tab-pane leading-relaxed active"
            role="tabpanel">

            @include('akademik.absensi.master-jadwal')

        </div>

        <div
            id="detail-jadwal"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('akademik.absensi.proses_absensi')

        </div>

    </div>

</div>

@include('akademik.absensi.tab.add-absen')
@include('akademik.absensi.tab.edit-absen')
@include('akademik.absensi.tab.add-rekap')




@endsection