<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Pembayaran Diproses</title>

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
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 46px;
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

        .alert {
            margin-bottom: 20px;
            padding: 14px 16px;
            border-radius: 12px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 14px;
            line-height: 1.6;
            text-align: left;
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

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-paid {
            background: #dcfce7;
            color: #15803d;
        }

        .status-pending {
            background: #fef3c7;
            color: #b45309;
        }

        .status-failed {
            background: #fee2e2;
            color: #b91c1c;
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

    <div class="icon">✓</div>

    <h1>Pembayaran telah diproses</h1>

    <p class="description">
        Anda telah kembali dari halaman pembayaran iPaymu.
        Status pembayaran akan diperbarui setelah sistem menerima
        konfirmasi dari iPaymu.
    </p>

    
    <a
        href="sekolahapp://payment-history"
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