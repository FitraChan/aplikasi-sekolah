<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Peserta Ujian</title>

    <style>
        @page {
            size: A4 portrait;
            margin: 20px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #334155;
            background: #ffffff;
            margin: 0;
        }

        .container {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            overflow: hidden;
        }

        /* HEADER */
        .header {
            background: #064e45;
            color: #ffffff;
            padding: 22px 25px;
            text-align: center;
            border-bottom: 5px solid #02bc9c;
        }

        .header .school-name {
            font-size: 21px;
            font-weight: bold;
            margin: 0 0 7px;
            letter-spacing: 1px;
        }

        .header .school-address {
            font-size: 10px;
            color: #d1fae5;
            margin: 0 0 17px;
        }

        .header .card-title {
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0;
        }

        .header .subtitle {
            font-size: 9px;
            color: #a7f3d0;
            margin-top: 6px;
        }

        /* CONTENT */
        .content {
            padding: 25px;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #047857;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            padding-bottom: 9px;
            border-bottom: 1px solid #d1fae5;
            margin-bottom: 14px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 5px;
            vertical-align: top;
        }

        .label {
            width: 125px;
            color: #64748b;
        }

        .separator {
            width: 15px;
            color: #94a3b8;
        }

        .value {
            font-weight: bold;
            color: #1e293b;
        }

        /* FOTO */
        .photo-cell {
            width: 125px;
            text-align: right;
            vertical-align: top;
        }

        .photo {
            width: 100px;
            height: 130px;
            border: 2px solid #d1d5db;
            border-radius: 7px;
            text-align: center;
            padding-top: 55px;
            color: #94a3b8;
            font-size: 10px;
            background: #f8fafc;
            margin-left: auto;
        }

        /* JADWAL */
        .schedule {
            margin-top: 25px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 9px;
            padding: 15px;
        }

        .schedule-title {
            color: #047857;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
        }

        .schedule-table td {
            padding: 6px 4px;
        }

        .schedule-label {
            width: 125px;
            color: #64748b;
        }

        .schedule-value {
            color: #064e45;
            font-weight: bold;
        }

        /* NOTICE */
        .notice {
            margin-top: 20px;
            padding: 12px;
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            color: #92400e;
            font-size: 9px;
            line-height: 1.6;
        }

        /* FOOTER */
        .footer {
            margin-top: 35px;
            text-align: right;
            line-height: 1.6;
            color: #475569;
        }

        .signature {
            margin-top: 55px;
            font-weight: bold;
            text-decoration: underline;
            color: #1e293b;
        }

        .bottom {
            background: #f1f5f9;
            padding: 11px 20px;
            text-align: center;
            font-size: 9px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }

        .badge {
            display: inline-block;
            background: #d1fae5;
            color: #047857;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">

        <h1 class="school-name">
            NAMA SEKOLAH
        </h1>

        <p class="school-address">
            Alamat sekolah dan nomor telepon
        </p>

        <h2 class="card-title">
            KARTU PESERTA UJIAN CALON SISWA
        </h2>

        <div class="subtitle">
            PENERIMAAN PESERTA DIDIK BARU
        </div>

        <div class="badge">
            KARTU PESERTA UJIAN
        </div>

    </div>


    {{-- CONTENT --}}
    <div class="content">

        <div class="section-title">
            Identitas Peserta
        </div>

        <table width="100%">
            <tr>

                <td style="vertical-align:top;">

                    <table class="info-table">

                        <tr>
                            <td class="label">Nomor Peserta</td>
                            <td class="separator">:</td>
                            <td class="value">
                                {{ $calonSiswa->no_daftar ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Nama Lengkap</td>
                            <td class="separator">:</td>
                            <td class="value">
                                {{ $calonSiswa->nama_lengkap ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Tempat Lahir</td>
                            <td class="separator">:</td>
                            <td>
                                {{ $calonSiswa->tempat_lahir ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Tanggal Lahir</td>
                            <td class="separator">:</td>
                            <td>
                                {{ $calonSiswa->tanggal_lahir
                                    ? \Carbon\Carbon::parse($calonSiswa->tanggal_lahir)->format('d-m-Y')
                                    : '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Asal Sekolah</td>
                            <td class="separator">:</td>
                            <td>
                                {{ $calonSiswa->asal_sekolah ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan Jurusan</td>
                            <td class="separator">:</td>
                            <td class="value">
                                {{ $calonSiswa->jurusan?->nama_jurusan ?? '-' }}
                            </td>
                        </tr>

                    </table>

                </td>

                {{-- FOTO --}}
               {{-- FOTO PESERTA --}}

               
        <td class="photo-cell">

        @php
            use Illuminate\Support\Facades\Storage;

            $fotoDatabase = $calonSiswa->foto_siswa;

            // Normalisasi path dari database
            $fotoDatabase = str_replace('\\', '/', $fotoDatabase);
            $fotoDatabase = preg_replace('#^storage/#', '', $fotoDatabase);
            $fotoDatabase = preg_replace('#^public/#', '', $fotoDatabase);

            // Jika database hanya menyimpan nama file
            if (!str_contains($fotoDatabase, '/')) {
                $fotoDatabase = 'uploads/foto_siswa/' . $fotoDatabase;
            }

            $fotoPath = Storage::disk('public')->path($fotoDatabase);

            $fotoAda = file_exists($fotoPath) && is_readable($fotoPath);

            // Ubah menjadi Base64 agar lebih mudah dibaca DomPDF
            $fotoBase64 = null;

            if ($fotoAda) {
                $mime = mime_content_type($fotoPath);
                $fotoBase64 = 'data:' . $mime . ';base64,' .
                    base64_encode(file_get_contents($fotoPath));
            }
        @endphp
            

        

            @if (!empty($fotoBase64))
                <img
                    src="{{ $fotoBase64 }}"
                    alt="Foto Peserta"
                    style="
                        width: 100px;
                        height: 130px;
                        object-fit: cover;
                        border: 1px solid #cbd5e1;">
            @else
                <div class="photo">
                    FOTO TIDAK ADA
                </div>
            @endif

        </td>

            </tr>
        </table>


        {{-- JADWAL UJIAN --}}
        <div class="schedule">

            <div class="schedule-title">
                INFORMASI JADWAL UJIAN
            </div>

            <table class="schedule-table">

                <tr>
                    <td class="schedule-label">
                        Tanggal Ujian
                    </td>

                    <td width="15">:</td>

                    <td class="schedule-value">
                        {{ $ujian->tanggal_mulai
                            ? $ujian->tanggal_mulai->locale('id')->translatedFormat('d F Y')
                            : '-' }}
                    </td>
                </tr>

                <tr>
                    <td class="schedule-label">
                        Waktu Ujian
                    </td>

                    <td>:</td>

                    <td class="schedule-value">
                        {{ $ujian->tanggal_mulai
                            ? $ujian->tanggal_mulai->format('H.i') . ' WITA'
                            : '-' }}
                    </td>
                </tr>

                <tr>
                    <td class="schedule-label">
                        Tempat Ujian
                    </td>

                    <td>:</td>

                    <td class="schedule-value">
                        Laboratorium Komputer
                    </td>
                </tr>

            </table>

        </div>


        {{-- NOTICE --}}
        <div class="notice">
            <strong>PERHATIAN:</strong><br>
            1. Peserta wajib membawa kartu ujian ini pada saat mengikuti ujian.<br>
            2. Peserta diharapkan hadir 15 menit sebelum ujian dimulai.<br>
            3. Peserta wajib mengikuti tata tertib ujian yang berlaku.
        </div>


        {{-- FOOTER --}}
        <div class="footer">

            <div>
                Denpasar,
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <div>
                Panitia Penerimaan Siswa Baru
            </div>

            <div class="signature">
                Ketua Panitia
            </div>

        </div>

    </div>


    {{-- BOTTOM --}}
    <div class="bottom">
        Kartu ini merupakan bukti resmi peserta ujian penerimaan siswa baru.
        Harap disimpan dan dibawa saat ujian.
    </div>

</div>

</body>
</html>