<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Pembayaran Dibatalkan</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            color: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 100%;
            max-width: 520px;
            padding: 32px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.10);
            text-align: center;
        }

        .icon {
            width: 88px;
            height: 88px;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: #fee2e2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 26px;
        }

        .description {
            margin: 0 0 24px;
            color: #6b7280;
            font-size: 15px;
            line-height: 1.7;
        }

        .detail {
            margin: 24px 0;
            padding: 18px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .label {
            color: #6b7280;
            font-size: 14px;
        }

        .value {
            color: #111827;
            font-size: 14px;
            font-weight: 700;
            text-align: right;
            word-break: break-word;
        }

        .button {
            display: block;
            width: 100%;
            padding: 14px 18px;
            border: 0;
            border-radius: 12px;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .button-retry {
            margin-bottom: 12px;
            background: #16a34a;
        }

        .button-secondary {
            margin-top: 12px;
            background: #f3f4f6;
            color: #374151;
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .card {
                padding: 24px 18px;
            }

            h1 {
                font-size: 22px;
            }

            .detail-row {
                flex-direction: column;
                gap: 5px;
            }

            .value {
                text-align: left;
            }
        }
    </style>
</head>

<body>

<div class="card">

    <div class="icon">×</div>

    <h1>Pembayaran dibatalkan</h1>

    <p class="description">
        Proses pembayaran tidak dilanjutkan.
        Tidak ada pembayaran yang dinyatakan berhasil dari halaman ini.
        Anda dapat mencoba kembali melalui aplikasi.
    </p>

    

    <a
        href="sekolahapp://payment"
        class="button">
        Kembali ke Aplikasi
    </a>

    <button
        type="button"
        class="button button-secondary"
        onclick="window.close()">
        Tutup Halaman
    </button>

</div>

</body>
</html>