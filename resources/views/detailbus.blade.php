<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use Carbon\Carbon;
use App\Models\Pesanan; ?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style_detailbus.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('/img/icon-web.png') }}" rel="icon">
    <title>GO-BIS</title>
</head>

<body>
    <div class="navbar">
        <input type="checkbox" name="" value="" id="check">
        <label for="check">
            <i class="material-icons" id="dehaze">dehaze</i>
            <i class="material-icons" id="close">close</i>
        </label>
        <div class="logo">
            <h2>Go-Bis</h2>
        </div>
        <div class="nav">
            <ul>
                <li> <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li> <a href="{{ url('/#pesan') }}" class="{{ Request::is('/#pesan') ? 'active' : '' }}">Cara Pesan</a>
                </li>
                <li> <a href="{{ url('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">Tentang Kami</a>
                </li>
                @auth
                    <?php $notif = Pesanan::where('user_id', auth()->user()->id)
                        ->where('status', 'dipesan')
                        ->get(); ?>
                    <li> <a href="{{ url('order') }}" class="{{ Request::is('order') ? 'active' : '' }}">Tiket Anda
                            @if (count($notif) > 0)
                                ({{ count($notif) }})
                            @endif
                        </a>
                    </li>
                    @if (ucwords(auth()->user()->role->nama) == 'Admin')
                        <li> <a href="{{ url('dashboard') }}"
                                class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard
                            </a>
                        </li>
                    @endif
                    <li>
                        <p style="margin-right: 5px">{{ ucwords(auth()->user()->nama) }}</p>
                    </li>
                    <li>
                        <form action="{{ url('/logout') }}" method="POST">
                            @csrf
                            <button name="button" class="logout">Logout</button>
                        </form>
                    </li>
                @else
                    <li> <a href="{{ url('register') }}"
                            class="{{ Request::is('register') ? 'active' : '' }}">Register</a>
                    </li>
                    <li> <a href="{{ url('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <!-- detailbus -->
    <div class="title">
        <h3>Detail Tiket Bus</h3>
        <p>{{ ucwords($jadwal->rute->awal->kelurahan->kecamatan->kabupaten->nama) }} ->
            {{ ucwords($jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->nama) }}</p>
    </div>
    <hr>
    <form action="{{ url('order') }}" method="POST">
        @csrf
        <div class="tiket">
            <div class="header">
                <input type="hidden" name="jadwal_id" value="{{ old('jadwal_id', $jadwal->id) }}">
                <p>{{ ucwords($jadwal->rute->bus->nama) }}</p>
                <p>{{ ucwords($jadwal->rute->bus->class_bus->nama) }}</p>
            </div>
            <div class="isi">
                <div class="gambar">
                    <img src="{{ asset('img/bus/' . $jadwal->rute->bus->foto) }}"
                        alt="{{ $jadwal->rute->bus->nama }}">
                </div>
                <div class="isi1">
                    <div class="keberangkatan">
                        <h3>keberangkatan</h3>
                        <p>{{ Carbon::parse($jadwal->keberangkatan)->isoFormat('dddd, D MMMM Y') }}, Pukul:
                            {{ strftime('%H:%M', strtotime($jadwal->keberangkatan)) }}</p>
                    </div>
                    <div class="dari">
                        <h3>Dari</h3>
                        <p>{{ ucwords($jadwal->rute->awal->nama . ', ' . $jadwal->rute->awal->alamat . ', ' . $jadwal->rute->awal->kelurahan->nama . ', ' . $jadwal->rute->awal->kelurahan->kecamatan->nama . ', ' . $jadwal->rute->awal->kelurahan->kecamatan->kabupaten->nama . ', ' . $jadwal->rute->awal->kelurahan->kecamatan->kabupaten->provinsi->nama) }}
                        </p>
                    </div>
                    <div class="tujuan">
                        <h3>Tujuan</h3>
                        <p>{{ ucwords($jadwal->rute->tujuan->nama . ', ' . $jadwal->rute->tujuan->alamat . ', ' . $jadwal->rute->tujuan->kelurahan->nama . ', ' . $jadwal->rute->tujuan->kelurahan->kecamatan->nama . ', ' . $jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->nama . ', ' . $jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->provinsi->nama) }}
                        </p>
                    </div>

                    <div class="jmlbangku">
                        <p>Jumlah bangku tersisa : {{ $jadwal->jumlah_bangku }}</p>
                        <h3>Jumlah bangku : <input
                                class="@error('jumlah')is-invalid
                            @enderror" type="number"
                                name="jumlah" id="jumlah" value="{{ old('jumlah') }}"></h3>
                        @error('jumlah')
                            <p style="color: red;">Masukkan jumlah bangku yang ingin dipesan</p>
                        @enderror
                    </div>
                </div>
                <div class="isi2">
                    <div class="harga">
                        <h3>Rp. {{ number_format($jadwal->harga, 2, ',', '.') }}</h3>
                        <p>/Kursi</p>
                    </div>
                    <div class="button">
                        <button class="bayar" name="button" type="submit">Pesan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- end-detailbus -->
    <br>

</body>

</html>
