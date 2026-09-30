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

    <div class="intro-y box">

        <div class="p-5 border-b">

            <h2 class="text-xl font-semibold">
                Mata Pelajaran {{ $master->mapel->nama_mapel }}
            </h2>

            <p class="text-slate-500 mt-1">
                Kelas {{ $master->nkelas }}
                {{ $master->kelas->nama_kelas }}
            </p>

        </div>

        <div class="p-5">

            @if ($errors->any())
            <div class="alert alert-danger mb-5">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="form-materi" action="{{ $materi ? route('pbm.updateMateri',$materi->id) : route('pbm.simpanMateri') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @if($materi)
                @method('PUT')
                @endif
                <input
                    type="hidden"
                    name="idjadwal"
                    value="{{ $id }}">

                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">
                            Pertemuan Ke
                        </label>

                        <input
                            type="number"
                            name="idpertemuan"
                            class="form-control"
                            value="{{ old('idpertemuan',$materi->idpertemuan ?? '') }}">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">
                            Judul Materi
                        </label>

                        <input
                            type="text"
                            name="judul_materi"
                            class="form-control"
                            value="{{ old('judul_materi',$materi->judul_materi ?? '') }}">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">
                            Tanggal
                        </label>

                       <input
                            type="date"
                            name="tgl"
                            class="form-control"
                            value="{{ old(
                                'tgl',
                                !empty($materi?->tgl)
                                    ? \Carbon\Carbon::parse($materi->tgl)->format('Y-m-d')
                                    : ''
                            ) }}">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">
                            Guru Pengganti
                        </label>

                        <select
                            name="guru_pengganti"
                            class="form-select">

                            <option value="">Pilih Guru</option>

                            @foreach($guru as $row)
                            <option
                                value="{{ $row->id }}"
                                {{ old('guru_pengganti', $materi->guru_pengganti ?? '') == $row->id ? 'selected' : '' }}>
                                {{ $row->nama_gtk }}
                            </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">
                            URL Video
                        </label>

                        <input
                            type="text"
                            name="url_video"
                            class="form-control"
                            value="{{ old('url_video', $materi->url_video ?? '') }}">
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="form-label">
                            Jenis Video
                        </label>

                        <select
                            name="is_youtube"
                            class="form-select">

                            <option
                                value="1"
                                {{ old('is_youtube', $materi->is_youtube ?? 1) == 1 ? 'selected' : '' }}>
                                Video Youtube
                            </option>

                            <option
                                value="0"
                                {{ old('is_youtube', $materi->is_youtube ?? 1) == 0 ? 'selected' : '' }}>
                                File Video
                            </option>

                        </select>

                    </div>

                </div>

                <div class="mt-5">

                    <label class="form-label">
                        Materi
                    </label>

                    <textarea
                        name="materi"
                        rows="10"
                        class="form-control">{{ old('materi', $materi->materi ?? '') }}</textarea>

                </div>

                <div class="grid grid-cols-12 gap-4 mt-5">

                    <div class="col-span-12 md:col-span-4">
                        <label class="form-label">
                            Lampiran 1
                        </label>

                        <input
                            type="file"
                            name="url_materi_1"
                            class="form-control">

                        @if(!empty($materi?->url_materi_1))
                        <div class="mt-2">
                            <a href="{{ asset($materi->url_materi_1) }}"
                                target="_blank"
                                class="text-primary">
                                Lihat Lampiran 1
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="col-span-12 md:col-span-4">
                        <label class="form-label">
                            Lampiran 2
                        </label>

                        <input
                            type="file"
                            name="url_materi_2"
                            class="form-control">

                        @if(!empty($materi?->url_materi_2))
                        <div class="mt-2">
                            <a href="{{ asset($materi->url_materi_2) }}"
                                target="_blank"
                                class="text-primary">
                                Lihat Lampiran 2
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="col-span-12 md:col-span-4">
                        <label class="form-label">
                            Lampiran 3
                        </label>

                        <input
                            type="file"
                            name="url_materi_3"
                            class="form-control">

                        @if(!empty($materi?->url_materi_3))
                        <div class="mt-2">
                            <a href="{{ asset($materi->url_materi_3) }}"
                                target="_blank"
                                class="text-primary">
                                Lihat Lampiran 3
                            </a>
                        </div>
                        @endif
                    </div>

                </div>

                <hr class="my-6">

                <h3 class="font-semibold text-lg mb-4">
                    Data Tugas
                </h3>

                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-12 md:col-span-6">

                        <label class="form-label">
                            Judul Tugas
                        </label>

                        <input
                            type="text"
                            name="judul_tugas"
                            class="form-control"
                            value="{{ old('judul_tugas', $materi->judul_tugas ?? '') }}">

                    </div>

                    <div class="col-span-12 md:col-span-3">

                        <label class="form-label">
                            Batas Submit
                        </label>

                        <input
                            type="datetime-local"
                            name="tgl_batas_submit"
                            class="form-control"
                            value="{{ old(
        'tgl_batas_submit',
        !empty($materi?->tgl_batas_submit)
            ? \Carbon\Carbon::parse($materi->tgl_batas_submit)->format('Y-m-d\TH:i')
            : ''
    ) }}">

                    </div>

                    <div class="col-span-12 md:col-span-3">

                        <label class="form-label">
                            Lampiran Tugas
                        </label>

                        <input
                            type="file"
                            name="url_tugas"
                            class="form-control">

                        @if(!empty($materi?->url_tugas))
                        <div class="mt-2">
                            <a href="{{ asset($materi->url_tugas) }}"
                                target="_blank"
                                class="text-primary">
                                Lihat Lampiran Tugas
                            </a>
                        </div>
                        @endif

                    </div>

                </div>

                <div class="mt-5">

                    <label class="form-label">
                        Tugas
                    </label>

                    <textarea
                        name="tugas"
                        rows="8"
                        class="form-control">{{ old('tugas', $materi->tugas ?? '') }}</textarea>

                </div>

                <div class="mt-5">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        rows="4"
                        class="form-control">{{ old('keterangan', $materi->keterangan ?? '') }}</textarea>

                </div>

                <div class="mt-6">

                   <button
                    type="submit"
                    class="btn btn-success w-full">

                    {{ $materi ? 'Update Materi' : 'Simpan Materi' }}

                </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection