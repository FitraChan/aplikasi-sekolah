@extends('layout.main')

@section('tittle')
Daftar Siswa
@endsection

@section('top-nav')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        Daftar Siswa
    </li>
</ol>
@endsection

@section('body')

<div class="max-w-7xl mx-auto p-6">

    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12">

            <div class="intro-y box">

                <!-- HEADER -->
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">

                    <h2 class="font-medium text-base mr-auto">

                        Data Daftar Siswa

                    </h2>

                </div>

                <!-- TABLE -->
                <div class="p-5">

                    <div class="overflow-x-auto">

                        <table class="table table-bordered table-hover">

                            <thead>

                                <tr>

                                    <th class="text-center w-20">
                                        No
                                    </th>

                                    <th>
                                        Nama Siswa
                                    </th>

                                    <th>
                                        Tahun Ajaran
                                    </th>

                                    <th>
                                        Jurusan
                                    </th>

                                    <th>
                                        Kelas
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($data as $row)

                                <tr>

                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ $row->nama_lengkap }}
                                    </td>

                                    <td>
                                        {{ optional($row->tahunAjaran)->thn_ajaran ?? '-' }}
                                    </td>

                                    <td>
                                        {{ optional($row->jurusan)->nama_jurusan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ optional($row->kelas)->nama_kelas ?? '-' }}
                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5" class="text-center text-slate-500">

                                        Data tidak ditemukan

                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection