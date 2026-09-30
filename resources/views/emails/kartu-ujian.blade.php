<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Ujian</title>
</head>
<body>
    <p>
        Yth. {{ $calonSiswa->nama_lengkap }},
    </p>

    <p>
        Pembayaran pendaftaran Anda telah berhasil diverifikasi.
        Kartu ujian calon siswa sudah diterbitkan.
    </p>

    <p>
        Nomor pendaftaran:
        <strong>{{ $calonSiswa->no_daftar }}</strong>
    </p>

    <p>
        Silakan klik tombol berikut untuk mengunduh kartu ujian:
    </p>

    <p>
        <a
            href="{{ $linkKartuUjian }}"
            style="
                display: inline-block;
                padding: 12px 20px;
                background: #103FD3;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
            "
        >
            Unduh Kartu Ujian
        </a>
    </p>

    <p>
        Link ini berlaku selama 7 hari.
    </p>

    <p>
        Terima kasih.
    </p>
</body>
</html>