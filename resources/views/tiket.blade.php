<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use Carbon\Carbon; ?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style_tiket.css') }}">
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
    <!-- tiket -->
    @if (session()->has('pesan'))
        {{-- <div class="alert alert-success" role="alert">
            {{ session('pesan') }}
        </div> --}}
        <div class="heading" role="alert">
            <p>{{ session('pesan') }}</p>
        </div>
    @endif
    <div class="title">
        <p>Tiket Pesanan Anda</p>
    </div>
    <hr>
    @forelse ($pesanans as $pesanan)
        <div class="tiket">
            <div class="header">
                <p>{{ ucwords($pesanan->jadwal->rute->bus->nama) }}</p>
                <p>{{ ucwords($pesanan->jadwal->rute->bus->class_bus->nama) }}</p>
            </div>
            <div class="isi">
                <div class="isi1">
                    <div class="keberangkatan">
                        <h3>keberangkatan</h3>
                        <p>{{ Carbon::parse($pesanan->jadwal->keberangkatan)->isoFormat('dddd, D MMMM Y') }}, Pukul:
                            {{ strftime('%H:%M', strtotime($pesanan->jadwal->keberangkatan)) }}</p>
                        <p> {{ ucwords($pesanan->jadwal->rute->awal->nama . ', ' . $pesanan->jadwal->rute->awal->alamat . ', ' . $pesanan->jadwal->rute->awal->kelurahan->nama . ', ' . $pesanan->jadwal->rute->awal->kelurahan->kecamatan->nama . ', ' . $pesanan->jadwal->rute->awal->kelurahan->kecamatan->kabupaten->nama . ', ' . $pesanan->jadwal->rute->awal->kelurahan->kecamatan->kabupaten->provinsi->nama) }}.
                        </p>
                    </div>
                    <div class="tujuan">
                        <h3>Tujuan</h3>
                        <br>
                        <p>{{ ucwords($pesanan->jadwal->rute->tujuan->nama . ', ' . $pesanan->jadwal->rute->tujuan->alamat . ', ' . $pesanan->jadwal->rute->tujuan->kelurahan->nama . ', ' . $pesanan->jadwal->rute->tujuan->kelurahan->kecamatan->nama . ', ' . $pesanan->jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->nama . ', ' . $pesanan->jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->provinsi->nama) }}.
                        </p>
                    </div>
                    <div class="harga">
                        <h3>Rp. {{ number_format($pesanan->jadwal->harga, 2, ',', '.') }}</h3>
                        <p>/kursi</p>
                    </div>
                </div>
                <div class="isi2">
                    <div class="totalharga">
                        <h3>Jumlah Bangku : {{ $pesanan->jumlah }} </h3>
                        <h1>Total : Rp. {{ number_format($pesanan->total, 2, ',', '.') }}</h1>
                    </div>
                    <div class="button">
                        @if ($pesanan->status == 'dipesan')
                            <form action="{{ url('order/' . $pesanan->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="batal" name="button" type="submit"
                                    onclick="return confirm('Yakin membatalkan pesanan ini ?')">Batal</button>
                            </form>
                            <form action="{{ url('order/' . $pesanan->id . '/edit') }}" method="get">
                                <button class="ubah" type="submit" name="button">Ubah</button>
                            </form>
                            {{-- <a href="{{url('order/'.$pesanan->id.'/edit')}}">Ubah</a> --}}
                            <form action="{{ url('bayar/' . $pesanan->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <button class="bayar" name="button" type="submit" onclick="return confirm('Yakin membayar tiket ini')">Bayar</button>
                            </form>
                        @else
                            <form action="{{ url('tiketku/' . $pesanan->id) }}" method="get">
                                <button class="bayar" type="submit" name="button">Tampilkan tiket</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end-tiket -->
        <br>

    @empty
        <div class="tiket">
            Sepertinya kamu belum pesan tiketnya... <a href="{{ url('/') }}">Yuk pesan!!! </a>
        </div>
    @endforelse
</body>

</html>
