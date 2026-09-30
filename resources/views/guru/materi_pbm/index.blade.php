@extends('layout.main')

@section('tittle')
Materi PBM
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">PBM</li>
    <li class="breadcrumb-item">Materi</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <ul class="nav nav-boxed-tabs" role="tablist">

        <li class="nav-item flex-1" role="presentation">

            <button
                class="nav-link w-full py-2 active"
                data-tw-toggle="pill"
                data-tw-target="#materi-pbm"
                type="button"
                role="tab">

                Materi PBM

            </button>

        </li>

        <li class="nav-item flex-1" role="presentation">

            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#data-ujian"
                type="button"
                role="tab">

                Data Ujian

            </button>

        </li>

    </ul>

    <div class="tab-content mt-5">

        {{-- TAB MATERI --}}
        <div
            id="materi-pbm"
            class="tab-pane leading-relaxed active"
            role="tabpanel">

            @include('guru.materi_pbm.materi.materi')

        </div>

        {{-- TAB UJIAN --}}
        <div
            id="data-ujian"
            class="tab-pane leading-relaxed"
            role="tabpanel">

            @include('guru.materi_pbm.ujian.ujian')

        </div>

    </div>

</div>



@endsection