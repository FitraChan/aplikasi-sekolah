<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Kartu Ujian Calon Siswa</title>

    <style>
        @page {
            margin: 15px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            font-size: 11px;
            margin: 0;
        }

        .card {
            border: 2px solid #00a982;
            border-radius: 12px;
            padding: 18px;
            position: relative;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #00a982;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }

        .header td {
            vertical-align: middle;
        }

        .school-name {
            font-size: 17px;
            font-weight: bold;
            color: #006b53;
            text-transform: uppercase;
        }

        .school-info {
            font-size: 9px;
            color: #64748b;
            margin-top: 4px;
        }

        .title {
            text-align: center;
            font-size: 17px;
            font-weight: bold;
            color: #006b53;
            margin-bottom: 3px;
        }

        .subtitle {
            text-align: center;
            font-size: 10px;
            color: #64748b;
            margin-bottom: 15px;
        }

        .content {
            width: 100%;
        }

        .content td {
            vertical-align: top;
        }

        .details {
            width: 72%;
        }

        .photo {
            width: 28%;
            text-align: center;
        }

        .photo img {
            width: 105px;
            height: 130px;
            object-fit: cover;
            border: 1px solid #cbd5e1;
            padding: 3px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 6px 3px;
            vertical-align: top;
        }

        .label {
            width: 125px;
            color: #64748b;
        }

        .separator {
            width: 10px;
        }

        .value {
            font-weight: bold;
            color: #1e293b;
        }

        .exam-box {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 10px;
            margin-top: 12px;
        }

        .exam-title {
            font-size: 11px;
            font-weight: bold;
            color: #047857;
            margin-bottom: 7px;
        }

        .exam-table {
            width: 100%;
        }

        .exam-table td {
            padding: 4px 2px;
        }

        .footer {
            width: 100%;
            margin-top: 15px;
            border-top: 1px solid #cbd5e1;
            padding-top: 10px;
        }

        .footer td {
            vertical-align: top;
        }

        .note {
            font-size: 9px;
            color: #64748b;
            line-height: 1.6;
        }

        .signature {
            text-align: center;
            width: 180px;
            font-size: 9px;
        }

        .signature-space {
            height: 35px;
        }

        .participant-number {
            background: #00a982;
            color: white;
            display: inline-block;
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            margin-top: 5px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

@php
    $tanggalMulai = $ujian->tanggal_mulai
        ? \Carbon\Carbon::parse($ujian->tanggal_mulai)->translatedFormat('l, d F Y H:i')
        : '-';

    $tanggalSelesai = $ujian->tanggal_selesai
        ? \Carbon\Carbon::parse($ujian->tanggal_selesai)->translatedFormat('l, d F Y H:i')
        : '-';

    $foto = $siswa->foto ?? null;
@endphp

<div class="card">

    {{-- HEADER SEKOLAH --}}
    <table class="header">
        <tr>
            <td>
                <div class="school-name">
                    {{ $profile->nama_sekolah ?? 'Nama Sekolah' }}
                </div>

                <div class="school-info">
                    {{ $profile->alamat ?? '' }}<br>
                    {{ $profile->telepon ?? '' }}
                </div>
            </td>

            <td class="text-center" style="width: 90px;">
                {{-- Logo sekolah jika tersedia --}}
                @if (!empty($profile->logo))
                    <img
                        src="{{ public_path($profile->logo) }}"
                        style="width: 65px; height: 65px; object-fit: contain;">
                @endif
            </td>
        </tr>
    </table>

    {{-- JUDUL --}}
    <div class="title">
        KARTU PESERTA UJIAN
    </div>

    <div class="subtitle">
        {{ strtoupper($ujian->nama_ujian) }}
    </div>

    {{-- IDENTITAS PESERTA --}}
    <table class="content">

        <tr>

            <td class="details">

                <table class="data-table">

                    <tr>
                        <td class="label">Nomor Peserta</td>
                        <td class="separator">:</td>
                        <td class="value">
                            {{ $peserta->no_peserta ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Nomor Pendaftaran</td>
                        <td class="separator">:</td>
                        <td class="value">
                            {{ $siswa->no_daftar ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="separator">:</td>
                        <td class="value">
                            {{ $siswa->nama_lengkap ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">NIPD</td>
                        <td class="separator">:</td>
                        <td class="value">
                            {{ $siswa->nipd ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td class="label">Program Keahlian</td>
                        <td class="separator">:</td>
                        <td class="value">
                            {{ $siswa->jurusan->nama_jurusan ?? '-' }}
                        </td>
                    </tr>

                </table>

            </td>

            {{-- FOTO --}}
            <td class="photo">

                @if ($foto && file_exists(public_path($foto)))
                    <img src="{{ public_path($foto) }}">
                @else
                    <div style="
                        width: 105px;
                        height: 130px;
                        border: 1px solid #cbd5e1;
                        background: #f8fafc;
                        text-align: center;
                        padding-top: 55px;
                        box-sizing: border-box;
                        color: #94a3b8;
                    ">
                        FOTO
                    </div>
                @endif

                <div class="participant-number">
                    {{ $peserta->no_peserta ?? '-' }}
                </div>

            </td>

        </tr>

    </table>

    {{-- INFORMASI JADWAL --}}
    <div class="exam-box">

        <div class="exam-title">
            INFORMASI JADWAL UJIAN
        </div>

        <table class="exam-table">

            <tr>
                <td style="width: 120px;">Mulai Ujian</td>
                <td style="width: 10px;">:</td>
                <td><strong>{{ $tanggalMulai }}</strong></td>

                <td style="width: 80px;">Durasi</td>
                <td style="width: 10px;">:</td>
                <td><strong>{{ $ujian->durasi ?? 0 }} Menit</strong></td>
            </tr>

            <tr>
                <td>Selesai Ujian</td>
                <td>:</td>
                <td colspan="4">
                    <strong>{{ $tanggalSelesai }}</strong>
                </td>
            </tr>

        </table>

    </div>

    {{-- FOOTER --}}
    <table class="footer">

        <tr>

            <td class="note">

                <strong>Perhatian:</strong><br>
                1. Kartu ini wajib dibawa saat mengikuti ujian.<br>
                2. Peserta wajib hadir tepat waktu.<br>
                3. Peserta wajib menjaga ketertiban selama ujian berlangsung.

            </td>

            <td class="signature">

                {{ now()->translatedFormat('d F Y') }}<br>
                Panitia Penerimaan Siswa Baru

                <div class="signature-space"></div>

                <strong>(................................)</strong>

            </td>

        </tr>

    </table>

</div>

</body>
</html>