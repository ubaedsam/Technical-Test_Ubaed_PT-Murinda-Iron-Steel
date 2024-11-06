<?php

define("DOMPDF_FONT_HEIGHT_RATIO", 0.75);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ url('/') }}">
    <title>Report Transaksi Jurnal</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <style>
        body {
            font-family: 'sans-serif';
            color: #000;
            margin: 0.2cm; /* Set the margin for the entire page */
            position: relative;
        }

        .footer {
            position: absolute;
            /* bottom: 0; */
            margin: 1.5cm;
            left: 0;
            width: 100%;
            /* text-align: center; */
        }

        .margin-binggris {
            margin: 1.5cm;
        }

        .container {
            margin: 0 auto; /* Center the content within the page */
            max-width: 100%; /* Ensure the content does not overflow */
        }

        .gradient-border {
            position: relative;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 80%;
            padding-bottom: 10px; /* Sesuaikan dengan ketebalan border yang diinginkan */
        }

        .gradient-border::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to right, #AB1C16 50%, grey 50%);
        }

        .page_break { page-break-after: always; }

        .col-4 {
            display: inline-block;
            width: 33.33%;
            box-sizing: border-box;
        }

        .col-4 p {
            margin: 0;
            font-weight: bold;
            font-size: 12px;
            /* text-align: center; */
        }

    </style>

    @stack('styles')
    <script>var hostUrl = "{{ asset('assets') }}/";</script>
</head>
<body style="font-family: 'sans-serif'; color: #000">
    <div class="container">
        <div>
            <p style="text-align: center; font-weight: bold; margin-bottom: 10px;">JURNAL TRANSACTION</p>

            <div class="col-4">
                <p>Kode Jurnal : {{ $item->jrcode }}</p>
            </div>
            <div class="col-4">
                <p>Tanggal : {{ $item->tanggal_transaksi }}</p>
            </div>
            <div class="col-4">
                <p>Ref : {{ $item->nomor_ref }}</p>
            </div>
            
            <div class="col-4">
                <p>Keterangan : {{ $item->remark }}</p>
            </div>

            <table class="table table-bordered" style="width: 100%; border-collapse: collapse; font-size: 12px; margin-top: 20px;">
                <thead>
                    <tr>
                        <th style="text-align: center; font-weight: bold; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">
                            <p style="margin-top: 10px; margin-bottom: 10px;">Acc Code</p>
                        </th>
                        <th style="text-align: center; font-weight: bold; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">
                            <p style="margin-top: 10px; margin-bottom: 10px;">Uraian Transaksi</p>
                        </th>
                        <th style="text-align: center; font-weight: bold; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">
                            <p style="margin-top: 10px; margin-bottom: 10px;">Depart</p>
                        </th>
                        <th style="text-align: center; font-weight: bold; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">
                            <p style="margin-top: 10px; margin-bottom: 10px;">Debet</p>
                        </th>
                        <th style="text-align: center; font-weight: bold; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">
                            <p style="margin-top: 10px; margin-bottom: 10px;">Kredit</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 13px; text-align: center; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">{{ $item->mis_kodeacc }}</td>
                        <td style="font-size: 13px; text-align: center; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">{{ $item->description }}</td>
                        <td style="font-size: 13px; text-align: center; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">{{ $item->departemen }}</td>
                        <td style="font-size: 13px; text-align: center; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">{{ $item->debet }}</td>
                        <td style="font-size: 13px; text-align: center; border: 1px solid; padding: 0 !important; padding-left: 5px !important; padding-right: 5px !important; line-height: 16px;">{{ $item->kredit }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
