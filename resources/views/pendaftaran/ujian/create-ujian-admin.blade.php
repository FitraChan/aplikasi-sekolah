@extends('layout.main')

@section('tittle')
Target Pendaftaran
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Target Pendaftaran</li>
</ol>
@endsection

@section('body')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Tambah Ujian
    </h2>
</div>

<div class="intro-y box p-5 mt-5">
    <form action="{{ route('ujianCalonAdmin.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="form-label">Nama Ujian</label>

            <input
                type="text"
                name="nama_ujian"
                class="form-control"
                value="{{ old('nama_ujian') }}"
                required
            >

            @error('nama_ujian')
                <div class="text-danger mt-1">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Deskripsi</label>

            <textarea
                name="deskripsi"
                class="form-control"
                rows="4"
            >{{ old('deskripsi') }}</textarea>
        </div>

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 md:col-span-6">
                <label class="form-label">Tanggal Mulai</label>

                <input
                    type="datetime-local"
                    name="tanggal_mulai"
                    class="form-control"
                    value="{{ old('tanggal_mulai') }}"
                >
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="form-label">Tanggal Selesai</label>

                <input
                    type="datetime-local"
                    name="tanggal_selesai"
                    class="form-control"
                    value="{{ old('tanggal_selesai') }}"
                >
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="form-label">Durasi</label>

                <div class="input-group">
                    <input
                        type="number"
                        name="durasi"
                        class="form-control"
                        value="{{ old('durasi', 60) }}"
                        min="1"
                        required
                    >

                    <div class="input-group-text">
                        Menit
                    </div>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="form-label">Nilai Minimal</label>

                <input
                    type="number"
                    name="nilai_minimal"
                    class="form-control"
                    value="{{ old('nilai_minimal', 70) }}"
                    min="0"
                    max="100"
                    required
                >
            </div>
        </div>

        <div class="mt-5">
            <label class="flex items-center mb-3">
                <input
                    type="checkbox"
                    name="acak_soal"
                    value="1"
                    class="form-check-input"
                    @checked(old('acak_soal', true))
                >

                <span class="ml-2">Acak urutan soal</span>
            </label>

            <label class="flex items-center mb-3">
                <input
                    type="checkbox"
                    name="tampil_hasil"
                    value="1"
                    class="form-check-input"
                    @checked(old('tampil_hasil', true))
                >

                <span class="ml-2">Tampilkan hasil kepada peserta</span>
            </label>

            <label class="flex items-center">
                <input
                    type="checkbox"
                    name="status"
                    value="1"
                    class="form-check-input"
                    @checked(old('status', true))
                >

                <span class="ml-2">Aktifkan ujian</span>
            </label>
        </div>

        <div class="mt-6 flex gap-2">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('ujianCalonAdmin.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </form>
</div>

@endsection
