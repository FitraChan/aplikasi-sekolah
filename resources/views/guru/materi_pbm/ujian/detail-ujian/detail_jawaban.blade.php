@extends('layout.main')

@section('tittle')
Materi PBM
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">PBM</li>
    <li class="breadcrumb-item">Detail Jawaban Siswa</li>
</ol>
@endsection

@section('body')
<div class="intro-y box mt-5">

    <div class="flex items-center px-5 py-4 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto">
            Informasi Hasil Ujian
        </h2>
    </div>

    <div class="p-5">

        <form id="frm-ujian">

            <input type="hidden" name="id" value="{{ $ujian->id }}">

            <div class="grid grid-cols-12 gap-5">

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Nama Siswa</div>
                        <input type="text" class="form-control"
                            value="{{ $siswa->siswa->nama_lengkap }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">NIPD</div>
                        <input type="text" class="form-control"
                            value="{{ $siswa->peserta_id }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Nama Ujian</div>
                        <input type="text" class="form-control"
                            value="{{ $ujian->judul }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Tanggal</div>
                        <input type="date" class="form-control"
                            value="{{ \Carbon\Carbon::parse($ujian->tgl_quiz)->format('Y-m-d') }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Mulai</div>
                        <input type="datetime-local" class="form-control"
                            value="{{ \Carbon\Carbon::parse($jawabanpeserta->tgl_mulai_quiz)->format('Y-m-d\TH:i') }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Selesai</div>
                        <input type="datetime-local" class="form-control"
                            value="{{ \Carbon\Carbon::parse($jawabanpeserta->tgl_selesai_quiz)->format('Y-m-d\TH:i') }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Jumlah Soal</div>
                        <input type="number" class="form-control"
                            value="{{ $jawabansiswa->count() }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Durasi</div>
                        <input type="number" class="form-control"
                            value="{{ $ujian->durasi }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Benar</div>
                        <input type="number"
                            class="form-control text-success font-bold"
                            value="{{ $jawabanpeserta->jwb_benar }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Salah</div>
                        <input type="number"
                            class="form-control text-danger font-bold"
                            value="{{ $jawabanpeserta->jwb_salah }}" readonly>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="input-group">
                        <div class="input-group-text w-36">Total Skor</div>
                        <input type="number"
                            class="form-control text-primary font-bold"
                            value="{{ $jawabanpeserta->total_skor }}" readonly>
                    </div>
                </div>

                <div class="col-span-12">
                    <div class="input-group">
                        <div class="input-group-text w-36">
                            Petunjuk
                        </div>

                        <textarea
                            class="form-control"
                            rows="4"
                            readonly>{{ $ujian->deskripsi }}</textarea>
                    </div>
                </div>

            </div>

        </form>

    </div>

    <div class="flex items-center px-5 py-4 border-b border-slate-200/60">
        <h2 class="font-medium text-base mr-auto">
            Detail Jawaban Siswa
        </h2>
    </div>

    <div class="p-5">

        <form id="frm-skor">

            @csrf

            @foreach($jawabansiswa as $index => $row)

                <div class="box border border-slate-200 rounded-md p-5 mb-5">

                    <div class="flex items-center justify-between mb-4">

                        <h3 class="font-medium text-lg">
                            Soal No. {{ $index + 1 }}
                        </h3>

                      

                    </div>

                    <div class="leading-relaxed">

                        {!! $row->detailQuiz->soal->soal !!}

                    </div>

                    @if($row->detailQuiz->soal->jenis_soal_id == 1)

            <ol style="list-style-type: upper-alpha; padding-left:25px;">

                            <li>{!! $row->detailQuiz->soal->jawaban_a !!}</li>

                            <li>{!! $row->detailQuiz->soal->jawaban_b !!}</li>

                            <li>{!! $row->detailQuiz->soal->jawaban_c !!}</li>

                            <li>{!! $row->detailQuiz->soal->jawaban_d !!}</li>

                            @if($row->detailQuiz->soal->jawaban_e)

                                <li>{!! $row->detailQuiz->soal->jawaban_e !!}</li>

                            @endif

                        </ol>

                    @endif

                    <div class="grid grid-cols-12 gap-4 mt-5">

                        <div class="col-span-12 lg:col-span-6">

                            <div class="alert alert-success">

                                <strong>Jawaban Benar :</strong>

                                {{ $row->jawaban_benar }}

                            </div>

                        </div>

                        <div class="col-span-12 lg:col-span-6">

                            <div class="alert {{ $row->jawaban == $row->jawaban_benar ? 'alert-success' : 'alert-danger' }}">

                                <strong>Jawaban Siswa :</strong>

                                {{ $row->jawaban }}

                                @if($row->jawaban == $row->jawaban_benar)

                                    <span class="ml-2 font-bold">✔ BENAR</span>

                                @else

                                    <span class="ml-2 font-bold">✘ SALAH</span>

                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="grid grid-cols-12 gap-4 mt-5">

                        <div class="col-span-12 lg:col-span-4">

                            <div class="input-group">

                                <div class="input-group-text">

                                    Skor

                                </div>

                                <input
                                    type="hidden"
                                    name="detail_jawaban_peserta_id[]"
                                    value="{{ $row->id }}">

                                <input
                                    type="number"
                                    name="skor[]"
                                    class="form-control"
                                    value="{{ $row->skor }}">

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

            <div class="mt-5 text-right">

                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="updateSkor()">

                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>

                    Simpan Skor

                </button>

            </div>

        </form>

    </div>

</div>

@endsection