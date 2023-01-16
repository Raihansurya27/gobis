<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php use Carbon\Carbon;
use App\Models\Pesanan; ?>

<head>
    <link rel="stylesheet" href="{{ asset('css/style_caribus.css') }}">
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
    <!-- heading -->
    <div class="heading">
        <p>Silahkan pilih bus sesuai dengan kebutuhan anda.</p>
    </div>
    <!-- cari -->
    <div class="daridanke">
        <!-- dari dan ke -->
        <p>{{ ucwords($awal['nama']) }} <i class="fa-solid fa-arrow-right"></i> {{ ucwords($tujuan['nama']) }}</p>
        <!-- tanggal -->
        <div class="tanggal">
            <p>Pencarian {{ $berangkat }}</p>
        </div>
        <hr>
    </div>
    <div class="ubahpencarian">
        <button type="button" name="button" onclick="ubahpencarian()">Ubah Pencarian</button>
    </div>
    <div class="kotak" id="kotak">
        <div class="label">
            <h3>Cari Tiket Bus</h3>
        </div>
        <div class="form">
            <form action="{{ url('/cari') }}" method="GET">
                @csrf
                <div class="grid">
                    <div class="col-1">
                        <p>Dari</p>
                        <input type="text" name="awal_id" id="awal_id" value="{{ old('awal_id') }}">
                    </div>
                    <div class="col-2">
                        <p>Tujuan</p>
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

                    <div class="col-5">
                        <button type="submit" name="button"> Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end cari -->
    <!-- jenis bus -->
    @forelse ($jadwals as $jadwal)
        <div class="jenisbus">

            <div class="listbus">
                <div class="kotakbus">
                    <div class="bus">
                        <div class="namabus">
                            <p>{{ ucwords($jadwal->rute->bus->nama) }}</p>
                        </div>
                        <div class="kelasbus">
                            <p>{{ ucwords($jadwal->rute->bus->class_bus->nama) }}</p>
                        </div>
                    </div>
                    <div class="isikotakbus">
                        <div class="keberangkatan">
                            <h3>keberangkatan :</h3>
                            <p>{{ Carbon::parse($jadwal->keberangkatan)->isoFormat('dddd, D MMMM Y') }} Pukul:
                                {{ strftime('%H:%M', strtotime($jadwal->keberangkatan)) }}</p>
                            <p>{{ ucwords($jadwal->rute->awal->nama . ', ' . $jadwal->rute->awal->alamat . ', ' . $jadwal->rute->awal->kelurahan->nama . ', ' . $jadwal->rute->awal->kelurahan->kecamatan->nama . ', ' . $jadwal->rute->awal->kelurahan->kecamatan->kabupaten->nama . ', ' . $jadwal->rute->awal->kelurahan->kecamatan->kabupaten->provinsi->nama) }}
                            </p>
                        </div>
                        <div class="tujuan">
                            <h3>Tujuan :</h3>
                            <br>
                            <p>{{ ucwords($jadwal->rute->tujuan->nama . ', ' . $jadwal->rute->tujuan->alamat . ', ' . $jadwal->rute->tujuan->kelurahan->nama . ', ' . $jadwal->rute->tujuan->kelurahan->kecamatan->nama . ', ' . $jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->nama . ', ' . $jadwal->rute->tujuan->kelurahan->kecamatan->kabupaten->provinsi->nama) }}
                            </p>
                        </div>
                        <div class="harga">
                            <h2>Rp. {{ number_format($jadwal->harga, 2, ',', '.') }} </h2>
                            <p>/kursi</p>
                            <p>Tersisa {{ $jadwal->jumlah_bangku }} bangku</p>
                            <form action="{{ url('order/' . $jadwal->id) }}" method="get">
                                <button type="submit" name="button">Pesan Sekarang</button>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="tomboltambahan">
                        <button type="button" name="button" onclick="detailbus({{ $jadwal->id }})">Detail
                            bus</button>
                    </div>
                </div>
            </div>
            <!-- detail bus -->
            <div class="bungkus" style="margin-bottom: 20px">
                <div class="detailbus" id="detailbus-{{ $jadwal->id }}">
                    <div class="textdetailbus">
                        <p>Detail Bus</p>
                    </div>
                    <div class="isidetailbus">
                        <p>Kelas Bus : {{ ucwords($jadwal->rute->bus->class_bus->nama) }}</p>
                        <p>Kapasitas Kursi : {{ $jadwal->rute->bus->bangku }} kursi</p>
                        <p>Format Kursi : 1-1</p>
                        <p>Fasilitas :
                        <ul style="margin-left: 20px">
                            @forelse ($facilities->where('bus_id',$jadwal->rute->bus_id) as $facility)
                                <li>{{ $facility->facility->nama }}</li>
                            @empty
                                <li>Tidak ada data</li>
                            @endforelse
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="jenisbus">
            <div class="container" style="text-align: center; margin-bottom: 20px">
                tidak ada data
            </div>
        </div>
    @endforelse
    <!-- footer -->
    <div>
        <footer class="footer">
            <a href="#"><i class="fa-regular fa-copyright"></i> 2022 | GO-BIS</a>
        </footer>
    </div>
</body>

<script type="text/javascript">
    function ubahpencarian() {
        var x = document.getElementById("kotak")
        if (x.style.display == "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function detailbus(id) {
        var x = document.getElementById("detailbus-" + id)
        // var y = document.getElementById("rutebus")
        // var z = document.getElementById("lamaperjalanan")
        if (x.style.display == "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
            // y.style.display = "none";
            // z.style.display = "none";
        }
    }

    // function rutebus() {
    //     var x = document.getElementById("rutebus")
    //     var y = document.getElementById("detailbus")
    //     var z = document.getElementById("lamaperjalanan")
    //     if (x.style.display == "block") {
    //         x.style.display = "none";
    //     } else {
    //         x.style.display = "block";
    //         y.style.display = "none";
    //         z.style.display = "none";
    //     }
    // }

    // function lamaperjalanan() {
    //     var x = document.getElementById("lamaperjalanan")
    //     var y = document.getElementById("detailbus")
    //     var z = document.getElementById("rutebus")
    //     if (x.style.display == "block") {
    //         x.style.display = "none";
    //     } else {
    //         x.style.display = "block";
    //         y.style.display = "none";
    //         z.style.display = "none";
    //     }
    // }
</script>

</html>
