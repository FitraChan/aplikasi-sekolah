<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Rekap Pembayaran Calon Siswa</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0 0 5px;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 5px;
        }

        th {
            background-color: #e8f5f2;
            text-align: center;
            font-weight: bold;
        }

        td {
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #eeeeee;
            font-weight: bold;
        }

        .lunas {
            color: #008000;
            font-weight: bold;
        }

        .belum-lunas {
            color: #d97706;
            font-weight: bold;
        }

        .belum-tagihan {
            color: #666;
            font-weight: bold;
        }

        .footer {
            margin-top: 15px;
            font-size: 9px;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Rekap Pembayaran Registrasi Calon Siswa</h2>
        <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="10%">No. Pendaftaran</th>
                <th width="17%">Nama Calon Siswa</th>
                <th width="9%">Tahun Ajaran</th>
                <th width="12%">Jurusan</th>
                <th width="8%">Kelas</th>
                <th width="10%">Kewajiban</th>
                <th width="9%">Potongan</th>
                <th width="10%">Total Bayar</th>
                <th width="10%">Sisa</th>
                <th width="10%">Status</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($data as $index => $item)

                <tr>
                    <td class="text-center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item['no_daftar'] }}
                    </td>

                    <td>
                        {{ $item['nama_lengkap'] }}
                    </td>

                    <td class="text-center">
                        {{ $item['tahun_ajaran'] ?? '-' }}
                    </td>

                    <td>
                        {{ $item['jurusan'] ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ $item['kelas'] ?? '-' }}
                    </td>

                    <td class="text-right">
                        {{ number_format($item['kewajiban'], 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($item['potongan'], 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($item['total_bayar'], 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($item['sisa'], 0, ',', '.') }}
                    </td>

                    <td class="text-center
                        {{ $item['status_bayar'] === 'Lunas' ? 'lunas' : '' }}
                        {{ $item['status_bayar'] === 'Belum Lunas' ? 'belum-lunas' : '' }}
                        {{ $item['status_bayar'] === 'Belum Ada Tagihan' ? 'belum-tagihan' : '' }}
                    ">
                        {{ $item['status_bayar'] }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="11" class="text-center">
                        Tidak ada data calon siswa.
                    </td>
                </tr>

            @endforelse

        </tbody>

        @if ($data->count() > 0)
            <tfoot>
                <tr class="total-row">
                    <td colspan="6" class="text-center">
                        TOTAL KESELURUHAN
                    </td>

                    <td class="text-right">
                        {{ number_format($totalKewajiban, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($totalPotongan, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($totalBayar, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        {{ number_format($totalSisa, 0, ',', '.') }}
                    </td>

                    <td></td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">
        Dokumen ini dicetak secara otomatis oleh sistem.
    </div>

</body>
</html>