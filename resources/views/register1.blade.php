<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/style_register.css')}}">
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
    <!-- register -->
    <div class="grid-container">
      <div class="title">
        <h2>Register</h2>
      </div>
      <div class="col-1">
        <img src="bus.jpg" alt="">
      </div>
      <div class="col-2">
        <form class="" action="index.html" method="post">
          <div class="kontent">
            <div class="col-25">
              <p>Nama Lengkap</p>
            </div>
            <div class="col-75">
              <input type="text" name="" value="" placeholder="Nama Lengkap">
            </div>
          </div>
          <div class="kontent">
            <div class="col-25">
              <p>Username</p>
            </div>
            <div class="col-75">
              <input type="text" name="" value="" placeholder="Username">
            </div>
          </div>
          <div class="kontent">
            <div class="col-25">
              <p>Password</p>
            </div>
            <div class="col-75">
              <input type="password" name="" value="" placeholder="Password">
            </div>
          </div>
          <div class="kontent">
            <div class="col-25">
              <p>No HP</p>
            </div>
            <div class="col-75">
              <input type="text" name="" value="" placeholder="No Hp">
            </div>
          </div>
          <div class="kontent">
            <div class="col-25">
              <p>Alamat</p>
            </div>
            <div class="col-75">
              <input type="textarea" name="" value="" placeholder="Alamat">
            </div>
          </div>
          <div class="daftar">
            <button type="button" name="button">Login</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
