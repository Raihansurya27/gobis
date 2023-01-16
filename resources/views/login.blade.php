<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
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
    <!-- login -->
    <div class="grid-container">
        <div class="title">
            <h2>Log in</h2>
        </div>
        <div class="col-1">
            <img src="{{ asset('img/bus.jpg') }}" alt="">
        </div>
        <div class="col-2">
            <div class="create-account">
                <p>Belum punya akun? <a href="{{ url('register') }}">Yuk buat
                        sekarang!!</a> </p>
            </div>
            <form action="{{ url('/login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="kontent">
                    <div class="col-25">
                        <p>Email</p>
                    </div>
                    <div class="col-75 @error('email')is-invalid @enderror">
                        <input type="text" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan Email anda1">
                    </div>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="kontent">
                    <div class="col-25">
                        <p>Password</p>
                    </div>
                    <div class="col-75 @error('password')is-invalid @enderror">
                        <input type="password" name="password" value="{{ old('password') }}"
                            placeholder="Masukkan password anda1">
                    </div>
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                <div class="daftar">
                    <button type="submit" name="button">Login</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</body>

</html>
