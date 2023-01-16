<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use App\Models\Pesanan; ?>

<head>
    <link rel="stylesheet" href="{{ asset('css/style_home.css') }}">
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
                        <p style="margin-right: 5px; color: #6e79f4;">{{ ucwords(auth()->user()->nama) }}</p>
                    </li> |
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
    <!-- header -->
    <div class="header">
        <div class="text" id="cari">
            <h2>Go-BIS</h2>
            <p>Mulai Dari Pencarian jadwal bus hingga pemesanan dan pembayaran tiket bus,
                semuanya bisa dilakukan dengan mudah dengan Go-Bis</p>
        </div>
        <div class="kotak">
            <div class="label">
                <h3>Cari Tiket Bus</h3>
            </div>
            <div class="form">
                <form action="{{ url('/cari') }}" method="GET">
                    @csrf
                    <div class="grid">
                        <div class="col-1">
                            <p>Dari (Kota)</p>
                            <input type="text" name="awal_id" id="awal_id" value="{{ old('awal_id') }}">
                        </div>
                        <div class="col-2">
                            <p>Ke (Kota)</p>
                            <input type="text" name="tujuan_id" id="tujuan_id" value="{{ old('tujuan_id') }}">
                        </div>
                        <div class="col-3">
                            <p>Dari tanggal</p>
                            <input type="date" name="dari" value="{{ old('dari') }}">
                        </div>

                        <div class="col-4">
                            <p>Sampai tanggal</p>
                            <input type="date" name="sampai" value="{{ old('sampai') }}">
                        </div>

                        {{-- <div class="col-4">
                            <p>Jumlah Kursi</p>
                            <input type="number" name="" value="">
                        </div> --}}
                        <div class="col-5">
                            <button type="submit" name="button">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <!-- fasilitas -->
    <div class="fasilitas">
        <div class="title">
            <h2>Fasilitas</h2>
        </div>
        <div class="ikon">
            <div class="isi">
                <i class="fa-solid fa-plug"></i>
                <p>Colokan Listrik pada masing-masing kursi bus</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-burger"></i>
                <p>Makanan ringan untuk setiap penumpang bus</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-toilet"></i>
                <p>Tersedia toilet yang bersih</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-chair"></i>
                <p>Tempat duduk yang berkualitas dan nyaman</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-fan"></i>
                <p>Dilengkapi AC dingin di setiap bangku bus</p>
            </div>
        </div>
    </div>
    <br>
    <!-- rutebus -->
    {{-- <div class="rutebus">
        <div class="title">
            <h2>Rute Bus Favorit</h2>
        </div>
        <div class="pembungkus">
            <div class="card">
                <img src="{{ asset('img/headercard.png') }}" alt="">
                <h3>Padang</h3>
                <table id="rutebus">
                    <tr>
                        <th>Tujuan Ke :</th>
                        <th>Harga Mulai :</th>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <img src="{{ asset('img/headercard2.png') }}" alt="">
                <h3>Jakarta</h3>
                <table id="rutebus">
                    <tr>
                        <th>Tujuan Ke :</th>
                        <th>Harga Mulai :</th>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <img src="{{ asset('img/headercard3.png') }}" alt="">
                <h3>Pekanbaru</h3>
                <table id="rutebus">
                    <tr>
                        <th>Tujuan Ke :</th>
                        <th>Harga Mulai :</th>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <img src="{{ asset('img/headercard.png') }}" alt="">
                <h3>Padang</h3>
                <table id="rutebus">
                    <tr>
                        <th>Tujuan Ke :</th>
                        <th>Harga Mulai :</th>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <img src="{{ asset('img/headercard2.png') }}" alt="">
                <h3>Jakarta</h3>
                <table id="rutebus">
                    <tr>
                        <th>Tujuan Ke :</th>
                        <th>Harga Mulai :</th>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <img src="{{ asset('img/headercard3.png') }}" alt="">
                <h3>Pekanbaru</h3>
                <table id="rutebus">
                    <tr>
                        <th>Tujuan Ke :</th>
                        <th>Harga Mulai :</th>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                    <tr>
                        <td>Jakarta</td>
                        <td>Rp.750.000</td>
                    </tr>
                    <tr>
                        <td>Bandung</td>
                        <td>Rp.850.000</td>
                    </tr>
                    <tr>
                        <td>Palembang</td>
                        <td>Rp.340.000</td>
                    </tr>
                    <tr>
                        <td>Medan</td>
                        <td>Rp.520.000</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="lainnya">
            <a href="{{ url('home/#cari') }}">Lihat Lebih banyak</a>
        </div>
    </div> --}}

    <!-- Cara Pesan Tiket Bus -->
    <div class="fasilitas" id="pesan">
        <div class="title">
            <h2>Cara Pesan Tiket Bus di Go-Bis</h2>
        </div>
        {{-- <div class="ikon">
            <div class="isi">
                <i class="fa-solid fa-plug"></i>
                <p>Colokan Listrik pada masing-masing kursi bus</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-burger"></i>
                <p>Makanan ringan untuk setiap penumpang bus</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-toilet"></i>
                <p>Tersedia toilet yang bersih</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-chair"></i>
                <p>Tempat duduk yang berkualitas dan nyaman</p>
            </div>
            <div class="isi">
                <i class="fa-solid fa-fan"></i>
                <p>Dilengkapi AC dingin di setiap bangku bus</p>
            </div>
        </div> --}}
        <div class="card">
            <div class="text" style="align-items: center">
                <p>1. Daftar/Buat akun dahulu sebelum memesan tiket</p>
                {{-- <img src="{{asset('img/bus.jpg')}}" style="height: 200px;"> --}}
                <p>2. Kemudian akan diarahkan untuk login</p>
                <p>3. Setelah login, anda akan diarahkan ke halaman home dan carilah destinasi awal, tujuan, dan estimasi keberangkatan bisnya, lalu tekan cari</p>
                <p>4. Pencarian anda akan muncul dengan berbagai informasinya (jika tidak ada tiketnya berarti tidak ada jadwalnya)</p>
                <p>5. Setelah menemukan jadwal yang pas, tekan pesan sekarang untuk pesan tiket</p>
                <p>6. Masukkan jumlah bangku yang ingin dipesan, lalu tekan pesan</p>
                <p>7. Anda akan diarahkan ke halaman tiket untuk menyelesaikan pembayaran. Anda juga bisa melakukan pembatalan atau perubahan tiket</p>
                <p>8. Setelah membayar tiket, anda bisa menampilkan atau print tiketnya. tiket bus bisa anda gunakan</p>
                <p>9. Semoga perjalanan anda menyenangkan</p>
            </div>
        </div>
    </div>
    <br>

    <!-- kebijakan kami -->
    <div class="kebijakan">
        <div class="title">
            <h2>Kebijakan Kami</h2>
        </div>
        <div class="card">
            <div class="judul">
                <p>Syarat dan Ketentuan PO GO-BIS</p>
            </div>
            <div class="text">
                <p>1. Anak berusia 3 tahun atau lebih, atau lebih tinggi dari 90 cm, harus membayar biaya tiket penuh
                </p>
                <p>2. Anak yang dipangku tidak akan dikenakan biaya. Namun, anak harus membayar biaya tiket penuh jika
                    ingin
                    duduk di kursi sendiri</p>
                <p>3. Kapasitas bagasi maksimum 10 kg. Jika lebih dari 10kg, maka kelebihannya akan dihitung seperti
                    paket.</p>
                <p>4. Penumpang dilarang membawa barang berbahaya, binatang, dan buah durian.</p>
                <p>5. Sumber Alam tidak bertanggung jawab atas barang penumpang yang hilang, rusak, atau tertukar.</p>
                <p>6. Pengembalian dana tidak akan diberikan kepada penumpang yang tertinggal bus karena terlambat tiba
                    di titik keberangkatan.</p>
                <p>7. Waktu berangkat, tipe bus, dan rute bus dapat berubah sewaktu-waktu karena alasan operasional.</p>
                <p>8. Jika bus batal berangkat, penumpang akan mendapat pengembalian dana penuh.</p>
                <p>9. Jumlah klaim yang diajukan penumpang, seperti klaim keterlambatan bus atau kecelakaan, tidak bisa
                    melebihi harga tiket.</p>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="footer">
        <a href="#"><i class="fa-regular fa-copyright"></i> 2022 | GO-BIS</a>
    </div>
</body>

</html>
