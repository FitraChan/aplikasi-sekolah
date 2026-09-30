@extends('layout.main')

@section('tittle')
Jadwal Guru
@endsection

@section('top-nav')
<ol class="breadcrumb">

    <li class="breadcrumb-item">Jadwal</li>
</ol>
@endsection

@section('body')
<div class="content">

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            AKADEMIK
        </h2>

        <div class="text-slate-500">
            Jadwal Pelajaran / Detail
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">

        @foreach($hari as $hri)

        <div class="intro-y col-span-12 lg:col-span-6">

            <div class="box">

                <div class="flex items-center border-b border-slate-200 px-5 py-4">
                    <h2 class="font-medium text-base">
                        Jadwal Hari {{ $hri['nama_hari'] }}
                    </h2>
                </div>

                <div class="overflow-x-auto">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php
                            $adaData = false;
                            @endphp

                            @foreach($isi as $row)

                            @if($row->id_hari == $hri['id'])

                            @php
                            $adaData = true;
                            @endphp

                            <tr>

                                <td>
                                    {{ $row->jam->jam_awal }} - {{ $row->jam->jam_akhir }}
                                </td>

                                <td>
                                    {{ $row->jadwal->mapel->nama_mapel }}
                                </td>

                                <td>
                                    {{ $row->jadwal->kelas->kelas }}
                                    {{ $row->jadwal->kelas->nama_kelas }}
                                </td>

                                <td>

                                    <div class="flex justify-center gap-2">
                                        <a href="{{ url('pbm/dataMateri/' . $row->idpenjadwalan) }}"
                                            class="btn btn-sm btn-outline-primary"  title="Lihat Data Materi">
                                            <i data-lucide="eye"></i>
                                        </a>

                                       

                                        <a href="{{ url('pbm/nilai/' . $row->idpenjadwalan) }}"
                                            class="btn btn-sm btn-outline-warning"  title="Lihat Nilai">
                                            <i data-lucide="graduation-cap"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                            @endif

                            @endforeach

                            @if(!$adaData)

                            <tr>
                                <td colspan="4" class="text-center text-slate-500">
                                    Tidak ada jadwal.
                                </td>
                            </tr>

                            @endif

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endsection