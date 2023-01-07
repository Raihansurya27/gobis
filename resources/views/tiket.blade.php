<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style_tiket.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                <li> <a href="{{ url('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">Home</a></li>
                <li> <a href="{{ url('bis') }}" class="{{ Request::is('bis') ? 'active' : '' }}">Bis</a></li>
                <li> <a href="#">Kontak</a></li>
                <li> <a href="{{ url('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">Tentang Kami</a>
                </li>
                @auth
                    <li>Hai, Rehan</li>
                    {{-- @empty(auth()->user()->picture)
                    <img src="{{asset('img/noprofile.png')}}" alt="{{auth()->user()->name}}" class="d-flex justify-content-center" style="width: 30px; height: 30px;">
                    @else
                    <img src="{{asset('img/profil/'.auth()->user()->picture)}}" alt="{{auth()->user()->name}}" class="d-flex justify-content-center" style="width: 30px; height: 30px;">
                    @endempty --}}
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button>Logout</button>
                    </form>
                @else
                    <li> <a href="{{ url('register') }}" class="{{ Request::is('register') ? 'active' : '' }}">Register</a>
                    </li>
                    <li> <a href="{{ url('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
  <!-- tiket -->
  <div class="title">
    <p>Tiket Pesanan Anda</p>
  </div>
  <hr>
  <div class="tiket">
    <div class="header">
      <p>tipe bus</p>
      <p>kelas bus</p>
    </div>
    <div class="isi">
      <div class="isi1">
        <div class="keberangkatan">
          <h3>keberangkatan</h3>
          <p>Sabtu,31 Desember 2022 Pukul 23.49 Terminal Bandar Buat Jl.Kusuma WIjaya, Raheem Casper, Padang Utara, Padang, Sumatera Barat.</p>
        </div>
        <div class="tujuan">
          <h3>Tujuan</h3>
          <p>Terminal Bandar Buat Jl.Kusuma WIjaya, Raheem Casper, Padang Utara, Padang, Sumatera Barat.</p>
        </div>
        <div class="harga">
          <h3>Rp.100.000.-</h3>
          <p>/kursi</p>
        </div>
      </div>
      <div class="isi2">
        <div class="totalharga">
          <h3>Jumlah Bangku : 5 </h3>
          <h1>Total : RP.500.000.-</h1>
        </div>
        <div class="button">
          <button class="batal" name="button">Batal</button>
          <button class="ubah" type="button" name="button">Ubah</button>
          <button class="bayar" name="button">Bayar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end-tiket -->
  <br>
  <div class="tiket">
    <div class="header">
      <p>tipe bus</p>
      <p>kelas bus</p>
    </div>
    <div class="isi">
      <div class="isi1">
        <div class="keberangkatan">
          <h3>keberangkatan</h3>
          <p>Sabtu,31 Desember 2022 Pukul 23.49 Terminal Bandar Buat Jl.Kusuma WIjaya, Raheem Casper, Padang Utara, Padang, Sumatera Barat.</p>
        </div>
        <div class="tujuan">
          <h3>Tujuan</h3>
          <p>Terminal Bandar Buat Jl.Kusuma WIjaya, Raheem Casper, Padang Utara, Padang, Sumatera Barat.</p>
        </div>
        <div class="harga">
          <h3>Rp.100.000.-</h3>
          <p>/kursi</p>
        </div>
      </div>
      <div class="isi2">
        <div class="totalharga">
          <h3>Jumlah Bangku : 5 </h3>
          <h1>Total : RP.500.000.-</h1>
        </div>
        <div class="button">
          <button class="batal" name="button">Batal</button>
          <button class="ubah" type="button" name="button">Ubah</button>
          <button class="bayar" name="button">Bayar</button>
        </div>
      </div>
    </div>
  </div>
  <br>
  <!-- end-tiket -->
</body>
</html>
