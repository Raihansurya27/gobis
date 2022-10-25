<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>GO-BIS</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <h2>Go-Bis</h2>
        </div>
        <div class="nav">
            <ul>
                <li> <a href="{{ url('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">Home</a></li>
                <li> <a href="{{ url('bis') }}" class="{{ Request::is('bis') ? 'active' : '' }}">Bis</a></li>
                {{-- <li> <a href="#">Kontak</a></li> --}}
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
    @yield('container')
    <br>
</body>

</html>
