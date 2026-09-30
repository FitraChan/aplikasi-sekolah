@extends('layout.main')

@section('tittle')
Pembayaran Calon Siswa
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Pembayaran Calon Siswa</li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <ul class="nav nav-boxed-tabs" role="tablist">

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2 active"
                data-tw-toggle="pill"
                data-tw-target="#history-pembayaran"
                type="button"
                role="tab"
                aria-controls="history-pembayaran"
                aria-selected="true">
                History Pembayaran
            </button>
        </li>

        <li class="nav-item flex-1" role="presentation">
            <button
                class="nav-link w-full py-2"
                data-tw-toggle="pill"
                data-tw-target="#detail-transaksi"
                type="button"
                role="tab"
                aria-controls="detail-transaksi"
                aria-selected="false">
                Detail Transaksi
            </button>
        </li>

    </ul>

    <div class="tab-content mt-5">

        <div
            id="history-pembayaran"
            class="tab-pane leading-relaxed active"
            role="tabpanel">
            @include('keuangan.bayar_calon_siswa.history_pembayaran')
        </div>

        <div
            id="detail-transaksi"
            class="tab-pane leading-relaxed"
            role="tabpanel">
            @include('keuangan.bayar_calon_siswa.detail_transaksi')
        </div>

    </div>

</div>

@include('keuangan.bayar_calon_siswa.js.history_js')
@include('keuangan.bayar_calon_siswa.js.detail_js')


@endsection