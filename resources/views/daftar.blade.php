<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style_register.css') }}">
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
                <li> <a href="{{ url('register') }}" class="{{ Request::is('register') ? 'active' : '' }}">Register</a>
                </li>
                <li> <a href="{{ url('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
            </ul>
        </div>
    </div>
    <!-- register -->
    <div class="grid-container">
        <div class="title">
            <h2>Register</h2>
        </div>
        <div class="col-1">
            <img src="{{ asset('img/bus.jpg') }}" alt="">
        </div>
        <div class="col-2">
            <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3>Identitas Diri</h3>
                <div class="kontent">
                    <div class="col-25">
                        <p>Nama Lengkap</p>
                    </div>
                    <div class="col-75">
                        <input type="text" name="nama" value="{{ ucwords(old('nama')) }}"
                            placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="kontent">
                    <div class="col-25">
                        <p>Email Anda</p>
                    </div>
                    <div class="col-75">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                </div>
                <div class="kontent">
                    <div class="col-25">
                        <p>Password</p>
                    </div>
                    <div class="col-75">
                        <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">
                    </div>
                </div>
                <div class="alamat">
                    <h3>Alamat</h3>

                </div>
                <div class="kontent">
                    <div class="col-25">
                        <p>Provinsi</p>
                    </div>
                    <div class="col-75">
                        <select name="provinsi_id" id="provinsi_id" onchange="kabupaten()">
                            <option value="pilih" selected>Pilih Provinsi</option>
                            @forelse ($provinsis as $provinsi)
                                @if (old('provinsi_id') == $provinsi->id)
                                    <option value="{{ $provinsi->id }}" selected>{{ ucwords($provinsi->nama) }}
                                    </option>
                                @else
                                    <option value="{{ $provinsi->id }}">{{ ucwords($provinsi->nama) }}</option>
                                @endif
                            @empty
                                <option>Tidak ada data Provinsi</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="kontent" id="bag-kab" hidden="true">
                    <div class="col-25">
                        <p>Kabupaten</p>
                    </div>
                    <div class="col-75">
                        <select name="kabupaten_id" id="kabupaten_id" onchange="kecamatan()">
                            <option value="pilih" selected>Pilih Kabupaten</option>
                            @forelse ($kabupatens as $kabupaten)
                                @if (old('kabupaten_id') == $kabupaten->id)
                                    <option value="{{ $kabupaten->id }}" id="{{ $kabupaten->provinsi_id }}" selected>
                                        {{ ucwords($kabupaten->nama) }}</option>
                                @else
                                    <option value="{{ $kabupaten->id }}" id="{{ $kabupaten->provinsi_id }}">
                                        {{ ucwords($kabupaten->nama) }}</option>
                                @endif
                            @empty
                                <option>Tidak ada data Kabupaten</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="kontent" id="bag-kec" hidden="true">
                    <div class="col-25">
                        <p>Kecamatan</p>
                    </div>
                    <div class="col-75">
                        <select name="kecamatan_id" id="kecamatan_id" onchange="kelurahan()">
                            <option value="pilih" selected>Pilih Kelurahan</option>
                            @forelse ($kecamatans as $kecamatan)
                                @if (old('kecamatan_id') == $kecamatan->id)
                                    <option value="{{ $kecamatan->id }}" id="{{ $kecamatan->kabupaten_id }}"
                                        selected>
                                        {{ ucwords($kecamatan->nama) }}</option>
                                @else
                                    <option value="{{ $kecamatan->id }}" id="{{ $kecamatan->kabupaten_id }}">
                                        {{ ucwords($kecamatan->nama) }}</option>
                                @endif
                            @empty
                                <option>Tidak ada data Kecamatan</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="kontent" id="bag-kel" hidden="true">
                    <div class="col-25">
                        <p>Kelurahan</p>
                    </div>
                    <div class="col-75">
                        <select name="kelurahan_id" id="kelurahan_id">
                            <option value="pilih" selected>Pilih Kelurahan</option>
                            @forelse ($kelurahans as $kelurahan)
                                @if (old('kelurahan_id') == $kelurahan->id)
                                    <option value="{{ $kelurahan->id }}" id="{{ $kelurahan->kecamatan_id }}"
                                        selected>
                                        {{ ucwords($kelurahan->nama) }}</option>
                                @else
                                    <option value="{{ $kelurahan->id }}" id="{{ $kelurahan->kecamatan_id }}">
                                        {{ ucwords($kelurahan->nama) }}</option>
                                @endif
                            @empty
                                <option>Tidak ada data Kelurahan</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="kontent">
                    <div class="col-25">
                        <p>Alamat</p>
                    </div>
                    <div class="col-75">
                        <textarea class="@error('deskripsi')is-invalid @enderror" id="alamat" rows="3" name="alamat">{{ Str::ucfirst(old('alamat')) }}</textarea>
                    </div>
                </div>
                <div class="daftar">
                    <button type="submit" name="button">Registrasi</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script type="text/javascript">
    function kabupaten() {
        var provinsi = document.getElementById("provinsi_id");
        var kabupaten = document.getElementById("kabupaten_id");
        var hasil_prov = provinsi.value;
        var hasil_kab = kabupaten.options;
        var div_kab = document.getElementById("bag-kab");
        if (hasil_prov !== "pilih") {
            div_kab.hidden = false;
            for (i = 1; i < hasil_kab.length; i++) {
                if (parseInt(hasil_prov) != parseInt(hasil_kab[i].id)) {
                    hasil_kab[i].hidden = true;
                } else {
                    hasil_kab[i].hidden = false;
                    hasil_kab[0].selected = true;
                }
            }
        } else {
            div_kab.hidden = true;
        }
    }

    function kecamatan() {
        var kabupaten = document.getElementById("kabupaten_id");
        var kecamatan = document.getElementById("kecamatan_id");
        var hasil_kab = kabupaten.value;
        var hasil_kec = kecamatan.options;
        var div_kec = document.getElementById("bag-kec");
        if (hasil_kab !== "pilih") {
            div_kec.hidden = false;
            for (i = 1; i < hasil_kec.length; i++) {
                if (parseInt(hasil_kab) != parseInt(hasil_kec[i].id)) {
                    hasil_kec[i].hidden = true;
                } else {
                    hasil_kec[i].hidden = false;
                    hasil_kec[0].selected = true;
                }
            }
        } else {
            div_kec.hidden = true;
        }
    }

    function kelurahan() {
        var kecamatan = document.getElementById("kecamatan_id");
        var kelurahan = document.getElementById("kelurahan_id");
        var hasil_kec = kecamatan.value;
        var hasil_kel = kelurahan.options;
        var div_kel = document.getElementById("bag-kel");
        if (hasil_kec !== "pilih") {
            div_kel.hidden = false;
            for (i = 1; i < hasil_kel.length; i++) {
                if (parseInt(hasil_kec) != parseInt(hasil_kel[i].id)) {
                    hasil_kel[i].hidden = true;
                } else {
                    hasil_kel[i].hidden = false;
                    hasil_kel[0].selected = true;
                }
            }
        } else {
            div_kel.hidden = true;
        }
    }
</script>

</html>
