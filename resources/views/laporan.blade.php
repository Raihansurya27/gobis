<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use Carbon\Carbon; ?>

<head>
    {{-- <link rel="stylesheet" href="{{ asset('css/style_laporan.css') }}"> --}}
    <meta charset="utf-8">
    {{-- <title>Laporan Penjualan</title> --}}
    {{-- <link href="{{ asset('/img/icon-web.png') }}" rel="icon"> --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;

        }

        body {
            background-color: rgb(216, 214, 213);
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin: 20px;
            text-align: center;
            align-items: center;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .isi {
            margin: 20px;
        }

        .isi .text1 {
            text-align: justify;
            margin-bottom: 20px;
        }

        .isi .text2 {
            margin-top: 20px;
            text-align: justify;

        }

        .isi .grafik {
            width: 50%;
            background-color: rgb(110, 121, 244);
            margin-bottom: 10px;
            color: white;
            margin: auto;
        }

        .isi .grafik img {
            width: 100%;
            height: 100%;
        }

        hr {
            border: 2px solid rgb(82, 85, 91);
        }

        table {
            width: 75%;
            margin: auto;
        }

        #customers td,
        #customers th {
            border: 1px solid rgb(128, 129, 132);
            padding: 8px;
        }

        #customers {
            border-collapse: collapse;
        }

        /* #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        } */

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="color:#6e79f4; font-size: 30pt">GO-BIS</h1>
            <div class="pt">
                <h2>PT. Gobis Makmur</h2>
                <p>Jl. Sukajadi, Padang, Sumatera Barat</p>
                <p>Laporan Penjualan Tiket Bus</p>
                <p>Per tanggal 31 Desember {{ now()->year }}</p>
            </div>
            {{-- <img src="{{ asset('img/logoBis.png') }}" alt="logo Go-Bis" style="width: 15%; height: 15%;"> --}}
        </div>
        <hr>
        <div class="isi">

            <div class="text1">
                <p>Laporan ini ditujukan sebagai rujukan agar pihak management dapat mempertimbangkan langkah atau kebijakannya kedepan</p>
            </div>
            <div class="text1" style="margin-top: 10px;">
                <?php
                $penjualan = 0;
                    foreach ($total_hargas as $total_harga) {
                        $penjualan = $penjualan + $total_harga->total_harga;
                    }
                    ?>
                <p>Total penjualan per 31 Desember {{ now()->year }} : Rp.
                    {{ number_format($penjualan, 2, ',', '.') }}, Berikut perinciannya pada tabel dibawah.</p>
            </div>
            <div class="tabel">
                <table id="customers">
                    <tr>
                        <th>Bulan</th>
                        <th>Total Pendapatan</th>
                        <th>Total Tiket yang dibayar</th>
                    </tr>
                    @forelse ($total_hargas as $total_harga)
                        <tr>
                            <td>{{ ucwords(Carbon::parse($total_harga->bulan)->isoFormat('MMMM')) }}</td>
                            <td>Rp. {{ number_format($total_harga->total_harga, 2, ',', '.') }}</td>
                            <td>{{ $total_harga->tiket }}</td>
                        </tr>
                    @empty
                        <tr>

                        </tr>
                    @endforelse
                </table>
            </div>
            <div class="text2">
                <p>Demikianlah laporan Penjualan Go-Bis.</p>
            </div>
        </div>
    </div>
</body>

</html>
