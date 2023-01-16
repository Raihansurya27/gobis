<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use Carbon\Carbon; ?>

<head>
    <meta charset="utf-8">
    {{-- <link rel="stylesheet" href="{{ asset('css/style_tiket2.css') }}"> --}}
    <link href="{{ asset('/img/icon-web.png') }}" rel="icon">
    <title>Tiketku</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: rgb(135, 138, 142);
        }

        .container {
            width: 50%;
            margin: auto;
            margin-top: 20px;
            background-color: white;
            border-radius: 20px;
            padding: 25px;
            font-weight: bold;
            letter-spacing: .2px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header .gobis {
            display: flex;
            align-items: center;
        }

        .header .tiket-bus {
            margin-left: 5px;
            font-size: 1.2em;
        }

        .gobis .garis {
            font-size: 1.8em;
            font-weight: normal;
            margin-left: 5px;
        }

        .isi-2 {
            display: flex;
            justify-content: space-between;
        }

        .isi-2 .dari {
            flex-basis: 50%;
        }

        .isi-2 .tujuan {
            flex-basis: 50%;
        }

        .dari .darii {
            font-weight: bold;
            margin-top: 10px;
        }

        .tujuan .tujuann {
            font-weight: bold;
            margin-top: 10px;
        }

        .dari .bus {
            margin-top: 20px;
        }

        .tujuan .harga {
            margin-top: 20px;
        }



        .gobis h1 {
            color: rgb(110, 121, 244);
        }

        .gobis p {
            font-weight: bold;
        }

        .header .kode {
            font-weight: bold;
            font-size: 1.2em;
        }

        hr {
            margin-top: 20px;
            border: 1px dashed black;

        }
    </style>

</head>

<body>
    <!-- start -->
    @forelse ($tikets as $tiket)
        <div class="container">
            <div class="header">
                <div class="gobis">
                    <h1>GO-BIS </h1>
                    <p class="tiket-bus"> Tiket Bus</p>
                </div>
                <p class="kode">{{ $tiket->kode_tiket }}</p>
            </div>
            <div class="isi">
                <div class="pemesan">
                    <p>Pemesan : {{ ucwords($tiket->pesanan->user->nama) }}</p>
                </div>
                <div class="isi-2">
                    <div class="dari">
                        <p class="darii">Dari :</p>
                        <p>{{ ucwords($tiket->pesanan->jadwal->rute->awal->kelurahan->kecamatan->kabupaten->nama) }}</p>
                        <p>{{ ucwords($tiket->pesanan->jadwal->rute->awal->nama) }}</p>
                        <div class="bus">
                            <p>Bus : {{ ucwords($tiket->pesanan->jadwal->rute->bus->nama) }}</p>
                            <p>Keberangkatan :
                            </p>
                            <p>{{ Carbon::parse($tiket->pesanan->jadwal->keberangkatan)->isoFormat('dddd, D MMMM Y') }},
                                Pukul:
                                {{ strftime('%H:%M', strtotime($tiket->pesanan->jadwal->keberangkatan)) }}</p>
                        </div>
                    </div>
                    <div class="tujuan">
                        <p class="tujuann">Tujuan :</p>
                        <p>{{ ucwords($tiket->pesanan->jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->nama) }}
                        </p>
                        <p>{{ ucwords($tiket->pesanan->jadwal->rute->tujuan->nama) }}</p>
                        <div class="harga">
                            <p>Harga : Rp. {{ number_format($tiket->pesanan->jadwal->harga, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @empty
    @endforelse
    <!-- end -->
</body>

</html>
