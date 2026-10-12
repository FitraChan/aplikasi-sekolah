@extends('layout.main')

@section('tittle')
Profile Guru
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Master</li>
    <li class="breadcrumb-item">Guru</li>
    <li class="breadcrumb-item">Profile</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <div class="intro-y box">

        <div class="p-5 border-b">
            <h2 class="text-xl font-semibold">
                Profile Guru
            </h2>

            <p class="text-slate-500 mt-1">
                Informasi data pribadi dan kepegawaian guru
            </p>
        </div>

        <div class="p-5">

            {{-- isi profile di sini --}}

        </div>

    </div>

</div>

@endsection