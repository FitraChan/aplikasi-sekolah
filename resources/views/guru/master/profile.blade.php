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


            <div class="grid grid-cols-12 gap-4">

                {{-- Nama GTK --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Nama GTK
                    </label>

                    <input
                        type="text"
                        name="nama_gtk"
                        class="form-control"
                        value="{{ old('nama_gtk', $gtk->nama_gtk ?? '') }}">
                </div>

                {{-- NIK --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        class="form-control"
                        value="{{ old('nik', $gtk->nik ?? '') }}">
                </div>

                {{-- Tempat Lahir --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Tempat Lahir
                    </label>

                    <input
                        type="text"
                        name="tmp_lahir"
                        class="form-control"
                        value="{{ old('tmp_lahir', $gtk->tmp_lahir ?? '') }}">
                </div>

                {{-- Tanggal Lahir --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        name="tgl_lahir"
                        class="form-control"
                        value="{{ old('tgl_lahir', $gtk->tgl_lahir ?? '') }}">
                </div>

                {{-- Alamat --}}
                <div class="col-span-12">
                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="3">{{ old('alamat', $gtk->alamat ?? '') }}</textarea>
                </div>

                {{-- Agama --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Agama
                    </label>

                    <select
                        name="idagama"
                        class="form-select">

                        <option value="">-- Pilih Agama --</option>

                        @foreach($agama as $item)
                        <option
                            value="{{ $item->id }}"
                            {{ old('idagama', $gtk->idagama ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_agama }}
                        </option>
                        @endforeach

                    </select>
                </div>

                {{-- No HP --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        No. HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp', $gtk->no_hp ?? '') }}">
                </div>

                {{-- Email --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $gtk->email ?? '') }}">
                </div>

                {{-- Password --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        value="{{ old('password') }}">

                    <div class="text-slate-500 text-xs mt-1">
                        Kosongkan jika tidak ingin mengubah password.
                    </div>
                </div>

                {{-- Foto --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="form-label">
                        Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control">

                    @if(!empty($gtk->foto))
                    <div class="mt-3">
                        <img
                            src="{{ asset('storage/' . $gtk->foto) }}"
                            alt="Foto GTK"
                            class="w-24 h-24 object-cover rounded-lg border">
                    </div>
                    @endif
                </div>

            </div>


        </div>

    </div>

</div>

@endsection