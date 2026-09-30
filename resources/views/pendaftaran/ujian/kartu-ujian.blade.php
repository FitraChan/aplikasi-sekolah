<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Kartu Ujian</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .container {
            width: 85%;
            margin: 30px auto;
            border: 2px solid #111827;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #111827;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3 {
            margin: 4px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px;
            vertical-align: top;
        }

        .label {
            width: 160px;
        }

        .separator {
            width: 10px;
        }

        .foto {
            width: 100px;
            height: 130px;
            border: 1px solid #111827;
            text-align: center;
            line-height: 130px;
        }

        .footer {
            margin-top: 35px;
            text-align: right;
        }

        .signature {
            margin-top: 60px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <h2>NAMA SEKOLAH</h2>

            <p>
                Alamat sekolah dan nomor telepon
            </p>

            <h3>KARTU PESERTA UJIAN CALON SISWA</h3>
        </div>

        <table>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td class="label">
                                Nomor Peserta
                            </td>

                            <td class="separator">:</td>

                            <td>
                                <strong>
                                    {{ $calonSiswa->no_daftar }}
                                </strong>
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Nama Lengkap</td>
                            <td class="separator">:</td>
                            <td>{{ $calonSiswa->nama_lengkap }}</td>
                        </tr>

                        <tr>
                            <td class="label">Tempat Lahir</td>
                            <td class="separator">:</td>
                            <td>{{ $calonSiswa->tempat_lahir }}</td>
                        </tr>

                        <tr>
                            <td class="label">Tanggal Lahir</td>
                            <td class="separator">:</td>
                            <td>
                                {{ optional($calonSiswa->tanggal_lahir)->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="label">Asal Sekolah</td>
                            <td class="separator">:</td>
                            <td>{{ $calonSiswa->asal_sekolah }}</td>
                        </tr>

                        <tr>
                            <td class="label">Pilihan Jurusan</td>
                            <td class="separator">:</td>
                            <td>
                                {{ $calonSiswa->jurusan?->nama_jurusan ?? '-' }}
                            </td>
                        </tr>

                      <tr>
            <td class="label">Tanggal Ujian</td>
                <td class="separator">:</td>
                <td>
                    {{ $ujian->tanggal_mulai->locale('id')->translatedFormat('d F Y') }}
                </td>
            </tr>

            <tr>
                <td class="label">Waktu Ujian</td>
                <td class="separator">:</td>
                <td>
                    {{ $ujian->tanggal_mulai->format('H.i') }} WITA
                </td>
            </tr>                   

                        <tr>
                            <td class="label">Tempat Ujian</td>
                            <td class="separator">:</td>
                            <td>Laboratorium Komputer</td>
                        </tr>
                    </table>
                </td>

                <td width="110">
                    <div class="foto">
                       
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer">
            <div>
                Denpasar, {{ now()->format('d-m-Y') }}
            </div>

            <div>
                Panitia Penerimaan Siswa Baru
            </div>

            <div class="signature">
                Ketua Panitia
            </div>
        </div>

    </div>
</body>
</html>