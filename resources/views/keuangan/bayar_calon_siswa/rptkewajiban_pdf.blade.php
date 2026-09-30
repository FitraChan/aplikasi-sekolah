<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Kewajiban Siswa</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl th,
        .tbl td {
            border: 1px solid #000;
            padding: 5px;
        }

        .tbl th {
            background: #eaeaea;
        }

        .header td {
            padding: 2px;
        }

        hr {
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    <div class="center">

        <h2 style="margin:0">
            {{ $profile->nama ?? '-' }}
        </h2>

        <div>
            {{ $profile->alamat ?? '-' }}
        </div>

        <div>
            Telp. {{ $profile->telp ?? '-' }}
        </div>

    </div>

    <hr>

    <h3 class="center">
        LAPORAN KEWAJIBAN SISWA
    </h3>

    <br>

    <table class="header">
        <tr>
            <td width="120">No Daftar</td>
            <td width="10">:</td>
            <td>{{ $atas->id_calon_siswa }}</td>
        </tr>

        <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td>{{ $atas->nama_lengkap }}</td>
        </tr>

      
        <tr>
            <td>Jurusan</td>
            <td>:</td>
            <td>{{ $atas->jurusan->nama_jurusan ?? '-' }}</td>
        </tr>
    </table>

    <br>

    @php
    $no = 1;
    $totBayar = 0;
    $totKewajiban = 0;
    $totPotongan = 0;
    @endphp

    <table class="tbl">

        <thead>
            <tr>
                <th width="40">No</th>
                <th>Item Pembayaran</th>
                <th width="120">Kewajiban</th>
                <th width="120">Potongan</th>
                <th width="120">Dibayar</th>
                <th width="120">Sisa</th>
            </tr>
        </thead>

        <tbody>

            @foreach($hasil as $row)

            @php
            $sisa = $row->SUMK2 - $row->SUMP - $row->SUMB;

            $totBayar += $row->SUMB;
            $totKewajiban += $row->SUMK2;
            $totPotongan += $row->SUMP;
            @endphp

            <tr>

                <td class="center">
                    {{ $no++ }}
                </td>

                <td>
                    {{ $row->nama_item }}
                </td>

                <td class="right">
                    {{ number_format($row->SUMK2,0,',','.') }}
                </td>

                <td class="right">
                    {{ number_format($row->SUMP,0,',','.') }}
                </td>

                <td class="right">
                    {{ number_format($row->SUMB,0,',','.') }}
                </td>

                <td class="right">
                    {{ number_format($sisa,0,',','.') }}
                </td>

            </tr>

            @endforeach

        </tbody>

        <tfoot>

            <tr class="bold">

                <td colspan="2" class="center">
                    TOTAL
                </td>

                <td class="right">
                    {{ number_format($totKewajiban,0,',','.') }}
                </td>

                <td class="right">
                    {{ number_format($totPotongan,0,',','.') }}
                </td>

                <td class="right">
                    {{ number_format($totBayar,0,',','.') }}
                </td>

                <td class="right">
                    {{ number_format($totKewajiban - $totPotongan - $totBayar,0,',','.') }}
                </td>

            </tr>

        </tfoot>

    </table>

    <br><br><br>

    <table border="0">
        <tr>
            <td width="60%"></td>

            <td align="center">

                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}

                <br><br>

                Petugas

                <br><br><br><br>

                <u>
                    {{ auth()->user()->name ?? '-' }}
                </u>

            </td>
        </tr>
    </table>

</body>

</html>