<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Rekap Pembayaran Siswa</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .tanggal {
            text-align: right;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px;
        }

        th {
            background: #e5e7eb;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total {
            background: #e5e7eb;
            font-weight: bold;
        }

        .lunas {
            color: green;
            font-weight: bold;
        }

        .belum {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>REKAP PEMBAYARAN SISWA</h2>

    <div class="tanggal">
        Dicetak: {{ $tanggalCetak }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="25">No</th>
                <th>NIPD</th>
                <th>Nama Siswa</th>
                <th>Tahun Ajaran</th>
                <th>Jurusan</th>
                <th>Kelas</th>
                <th>Kewajiban</th>
                <th>Potongan</th>
                <th>Total Bayar</th>
                <th>Sisa</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($data as $i => $row)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>

                    <td>{{ $row['nipd'] }}</td>

                    <td>{{ $row['nama_lengkap'] }}</td>

                    <td class="text-center">
                        {{ $row['tahun_ajaran'] }}
                    </td>

                    <td>{{ $row['jurusan'] }}</td>

                    <td class="text-center">
                        {{ $row['kelas'] }}
                    </td>

                    <td class="text-right">
                        {{ number_format($row['kewajiban'], 2, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($row['potongan'], 2, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($row['total_bayar'], 2, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($row['sisa'], 2, ',', '.') }}
                    </td>

                    <td class="text-center">
                        {{ $row['status_bayar'] }}
                    </td>
                </tr>
            @endforeach

        </tbody>

        <tfoot>
            <tr class="total">
                <td colspan="6" class="text-center">
                    TOTAL KESELURUHAN
                </td>

                <td class="text-right">
                    {{ number_format($totalKewajiban, 2, ',', '.') }}
                </td>

                <td class="text-right">
                    {{ number_format($totalPotongan, 2, ',', '.') }}
                </td>

                <td class="text-right">
                    {{ number_format($totalBayar, 2, ',', '.') }}
                </td>

                <td class="text-right">
                    {{ number_format($totalSisa, 2, ',', '.') }}
                </td>

                <td></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>