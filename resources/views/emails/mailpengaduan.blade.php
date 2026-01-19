<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        /* Reset & Basics */
        body {
            background-color: #f3f4f6;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }

        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
        }

        /* Container */
        .container {
            display: block;
            margin: 0 auto !important;
            max-width: 600px;
            padding: 10px;
            width: 600px;
        }

        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 600px;
            padding: 10px;
        }

        /* Main Area */
        .main {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 30px;
        }

        /* Typography */
        h1,
        h2,
        h3 {
            color: #064e3b;
            font-weight: 700;
            line-height: 1.2;
            margin: 0;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 15px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
            color: #374151;
        }

        /* Details Table */
        .details-table {
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .details-table td {
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2937;
        }

        .details-table .label {
            font-weight: bold;
            color: #064e3b;
            width: 40%;
        }

        /* Message Box */
        .message-box {
            background-color: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 25px;
            font-style: italic;
            color: #065f46;
        }

        /* Button */
        .btn {
            box-sizing: border-box;
            width: 100%;
            margin-bottom: 20px;
        }

        .btn>tbody>tr>td {
            padding-bottom: 15px;
        }

        .btn table {
            width: auto;
            margin: 0 auto;
        }

        .btn table td {
            background-color: #ffffff;
            border-radius: 50px;
            text-align: center;
        }

        .btn a {
            background-color: #10b981;
            border: solid 1px #10b981;
            border-radius: 50px;
            box-sizing: border-box;
            color: #ffffff;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }

        /* Footer */
        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }

        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #9ca3af;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">
                    <!-- START CENTERED WHITE CONTAINER -->
                    <table role="presentation" class="main">
                        <!-- HEADER -->
                        <tr>
                            <td style="background-color: #064e3b; padding: 20px; text-align: center;">
                                <img src="{{ $message->embed(public_path('img/core/logo.webp')) }}" alt="Agroptimal"
                                    style="height: 56px; margin-bottom: 12px; display: inline-block; border: 0;">
                                <!-- <h2 style="color: #ffffff; margin: 0; font-size: 20px;">AGROPTIMAL</h2> -->
                            </td>
                        </tr>
                        <tr>
                            <td class="wrapper">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <h1>Laporan Pengaduan Baru</h1>
                                            <p>Halo Admin, berikut adalah detail laporan yang baru saja masuk melalui
                                                website:</p>

                                            <table class="details-table">
                                                <tr>
                                                    <td class="label">Kategori</td>
                                                    <td>{{ $data->kategori }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="label">Nama Pelapor</td>
                                                    <td>{{ $data->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="label">No. WhatsApp</td>
                                                    <td>
                                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $data->no_whatsapp) }}"
                                                            style="color: #10b981; text-decoration: none; font-weight: bold;">
                                                            {{ $data->no_whatsapp }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>

                                            <p style="font-weight: bold; margin-bottom: 5px;">Isi Pesan:</p>
                                            <div class="message-box">
                                                "{{ $data->pesan }}"
                                            </div>

                                            @if ($data->lampiran)
                                                <p style="text-align: center; margin-bottom: 10px;">
                                                    Pelapor menyertakan bukti foto, silakan cek bagian
                                                    <strong>Attachments</strong> di bawah email ini.
                                                </p>
                                            @endif
                                            <p style="margin-top: 30px; font-size: 13px;">Segera tindak lanjuti laporan
                                                ini melalui WhatsApp pelapor.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!-- END CENTERED WHITE CONTAINER -->

                    <!-- START FOOTER -->
                    <div class="footer">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    <span class="apple-link">Agroptimal System Notification</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- END FOOTER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>
