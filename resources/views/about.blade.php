<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use App\Models\Pesanan; ?>

<head>
    <link rel="stylesheet" href="{{ asset('css/style_tentangkami.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('/img/icon-web.png') }}" rel="icon">
    <title>Go-BIS</title>
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

    <div class="tentangkami">
        <div class="title">
            <h2>Tentang Kami</h2>
        </div>
        <div class="card">
            <h3>Siapa Kami ?</h3>
            <p>GO-BIS adalah platform pemesanan tiket bus online terbesar di dunia, yang menghubungkan berbagai kota di
                seluruh dunia dengan hanya klik satu tombol. Didirikan pada tahun 2006, GO-BIS menjual lebih dari 40
                juta tiket hingga saat ini. Kami adalah bagian dari Grup ibibo dan didanai oleh Naspers (sebuah
                perusahaan multinasional Afrika Selatan). Naspers mengubah industri e-commerce di lebih dari 135 negara
                yang beroperasi dengan menggunakan layanan internet, TV berbayar, dan media cetak. </p>
        </div>
        <div class="card">
            <h3>Mengapa memesan tiket bus kepada kami ?</h3>
            <p>GO-BIS menyediakan bus wisatawan dengan sistem pemesanan yang paling sederhana dan tidak repot. Pilih
                tujuan Anda, lihat susunan posisi kursi, pilih kursi yang nyaman, dan pesan tiket Anda hanya dalam
                beberapa klik! Pengalaman GO-BIS tidak berakhir hanya dengan pemesanan. Kami memiliki
                timlayananpelanggan khusus untuk memenuhi semua kebutuhan Anda saat Anda berada di perjalanan. Kami
                mengharapkan umpan balik dari para pelanggan kami secara berkala dan selalu berusaha untuk memperbaiki
                diri! p>
        </div>
        <div class="card">
            <h3>Perjalanan Kami </h3>

            <p>2006 - Kami memulai padabulan Agustus 2006.</p>
            <p>2010 - Kami berada di antara 5 startups teratas yang diawasi oleh Majalah Forbes</p>
            <p>2011 - Teknologi kami beradadi antara 5 pemenang teratas pada ajang penghargaan bergengsi CIO Asia Award
                di Singapura</p>
            <p>2012- 10 juta tiket terjual. Mendapatkan penghargaan Marico Innovation Awards. Menerima hadiah
                penghargaan Porter pada ajang penghargaan IFC Mint Strategy Awards</p>
            <p>2013 - Diakuisisi oleh Grup ibibo, perusahaan patungan Naspers Afrika Selatan</p>
            <p>2014- 20 juta tiket terjual. Pemenang Mobile Innovation di bidang Travel.</p>

        </div>
    </div>
    <!-- footer -->
    <div class="footer">
        <a href="#"><i class="fa-regular fa-copyright"></i> 2022 | GO-BIS</a>
    </div>


</html>
