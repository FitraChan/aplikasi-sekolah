<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Kewajiban Calon Siswa</title>

    <style>
        @page {
            margin: 30px 35px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #334155;
            line-height: 1.5;
            margin: 0;
        }

        .header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .header td {
            vertical-align: middle;
        }

        .school-name {
            font-size: 19px;
            font-weight: bold;
            color: #0f766e;
            margin: 0;
            letter-spacing: .3px;
        }

        .school-info {
            font-size: 9px;
            color: #64748b;
            line-height: 1.7;
        }

        .document-label {
            text-align: right;
            font-size: 9px;
            color: #64748b;
        }

        .document-label strong {
            display: block;
            font-size: 12px;
            color: #0f766e;
        }

        .divider {
            height: 3px;
            background: #0f766e;
            margin-bottom: 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 18px;
        }

        .title h2 {
            font-size: 16px;
            color: #0f172a;
            margin: 0 0 4px;
            letter-spacing: .5px;
        }

        .title p {
            color: #64748b;
            font-size: 9px;
            margin: 0;
        }

        .student-card {
            width: 100%;
            border-collapse: collapse;
            background: #f0fdfa;
            border: 1px solid #ccfbf1;
            margin-bottom: 18px;
        }

        .student-card td {
            padding: 9px 12px;
            vertical-align: top;
        }

        .label {
            color: #64748b;
            font-size: 9px;
            width: 100px;
        }

        .value {
            font-weight: bold;
            color: #0f172a;
            font-size: 10px;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .tbl {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl th {
            background: #0f766e;
            color: #ffffff;
            padding: 9px 7px;
            font-size: 9px;
            text-align: center;
            font-weight: bold;
        }

        .tbl td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 7px;
            font-size: 9px;
        }

        .tbl tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .tbl tfoot td {
            background: #f0fdfa;
            border-top: 2px solid #0f766e;
            border-bottom: 1px solid #ccfbf1;
            font-weight: bold;
            color: #0f172a;
            padding: 10px 7px;
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

        .summary {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin: 18px -8px 0;
        }

        .summary td {
            width: 33.33%;
            padding: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }

        .summary-label {
            font-size: 8px;
            color: #64748b;
        }

        .summary-value {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 4px;
        }

        .summary-value.green {
            color: #0f766e;
        }

        .summary-value.red {
            color: #dc2626;
        }

        .note {
            margin-top: 15px;
            padding: 10px 12px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
            font-size: 9px;
        }

        .signature {
            width: 100%;
            margin-top: 35px;
            border-collapse: collapse;
        }

        .signature td {
            vertical-align: top;
        }

        .signature-box {
            text-align: center;
            width: 220px;
            float: right;
        }

        .signature-date {
            color: #64748b;
            font-size: 9px;
        }

        .signature-name {
            font-weight: bold;
            color: #0f172a;
            text-decoration: underline;
        }

        .footer {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            color: #94a3b8;
            font-size: 8px;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- HEADER SEKOLAH --}}
    <table class="header">
        <tr>
            <td width="70%">
                <h1 class="school-name">
                    {{ $profile->nama ?? '-' }}
                </h1>

                <div class="school-info">
                    {{ $profile->alamat ?? '-' }}
                    <br>
                    Telp. {{ $profile->telp ?? '-' }}
                </div>
            </td>

            <td width="30%" class="document-label">
                <strong>LAPORAN KEUANGAN</strong>
                DOKUMEN KEWAJIBAN SISWA
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    {{-- JUDUL --}}
    <div class="title">
        <h2>LAPORAN KEWAJIBAN SISWA</h2>
        <p>Rincian kewajiban, potongan, pembayaran dan sisa tagihan</p>
    </div>

    {{-- IDENTITAS SISWA --}}
    <table class="student-card">
        <tr>
            <td width="50%">
                <div class="label">Nomor Pendaftaran</div>
                <div class="value">{{ $atas->no_daftar ?? '-' }}</div>
            </td>

            <td width="50%">
                <div class="label">Nama Siswa</div>
                <div class="value">{{ $atas->nama_lengkap ?? '-' }}</div>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="label">Program Studi / Jurusan</div>
                <div class="value">
                    {{ $atas->jurusan->nama_jurusan ?? '-' }}
                </div>
            </td>
        </tr>
    </table>

    {{-- PERHITUNGAN --}}
    @php
        $no = 1;
        $totBayar = 0;
        $totKewajiban = 0;
        $totPotongan = 0;
    @endphp

    {{-- TABEL KEWAJIBAN --}}
    <div class="section-title">
        Rincian Kewajiban Pembayaran
    </div>

    <table class="tbl">

        <thead>
            <tr>
                <th width="35">No</th>
                <th>Item Pembayaran</th>
                <th width="100">Kewajiban</th>
                <th width="90">Potongan</th>
                <th width="100">Dibayar</th>
                <th width="100">Sisa</th>
            </tr>
        </thead>

        <tbody>

            @forelse($hasil as $row)

                @php
                    $kewajiban = (float) ($row->SUMK2 ?? 0);
                    $potongan = (float) ($row->SUMP ?? 0);
                    $dibayar = (float) ($row->SUMB ?? 0);

                    $sisa = $kewajiban - $potongan - $dibayar;

                    $totBayar += $dibayar;
                    $totKewajiban += $kewajiban;
                    $totPotongan += $potongan;
                @endphp

                <tr>
                    <td class="center">
                        {{ $no++ }}
                    </td>

                    <td>
                        {{ $row->nama_item ?? '-' }}
                    </td>

                    <td class="right">
                        {{ number_format($kewajiban, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        {{ number_format($potongan, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        {{ number_format($dibayar, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        {{ number_format($sisa, 0, ',', '.') }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6" class="center">
                        Belum terdapat data kewajiban pembayaran.
                    </td>
                </tr>

            @endforelse

        </tbody>

        <tfoot>
            <tr>
                <td colspan="2" class="center">
                    TOTAL KESELURUHAN
                </td>

                <td class="right">
                    {{ number_format($totKewajiban, 0, ',', '.') }}
                </td>

                <td class="right">
                    {{ number_format($totPotongan, 0, ',', '.') }}
                </td>

                <td class="right">
                    {{ number_format($totBayar, 0, ',', '.') }}
                </td>

                <td class="right">
                    {{ number_format($totKewajiban - $totPotongan - $totBayar, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>

    </table>

    {{-- RINGKASAN --}}
    <table class="summary">
        <tr>
            <td>
                <div class="summary-label">TOTAL KEWAJIBAN</div>
                <div class="summary-value">
                    Rp {{ number_format($totKewajiban, 0, ',', '.') }}
                </div>
            </td>

            <td>
                <div class="summary-label">TOTAL PEMBAYARAN</div>
                <div class="summary-value green">
                    Rp {{ number_format($totBayar, 0, ',', '.') }}
                </div>
            </td>

            <td>
                <div class="summary-label">SISA KEWAJIBAN</div>
                <div class="summary-value red">
                    Rp {{ number_format($totKewajiban - $totPotongan - $totBayar, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    {{-- CATATAN --}}
    <div class="note">
        <strong>Catatan:</strong>
        Laporan ini merupakan rincian kewajiban administrasi dan pembayaran siswa.
        Simpan dokumen ini sebagai arsip dan bukti informasi keuangan.
    </div>

    {{-- TANDA TANGAN --}}
    <table class="signature">
        <tr>
            <td width="55%"></td>

            <td width="45%" class="center">
                <div class="signature-date">
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </div>

                <br>

                Petugas Keuangan

                <br><br><br><br><br>

                <span class="signature-name">
                    {{ auth()->user()->name ?? '-' }}
                </span>
            </td>
        </tr>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        Dokumen ini dicetak secara elektronik melalui sistem informasi sekolah.
    </div>

</body>
</html>