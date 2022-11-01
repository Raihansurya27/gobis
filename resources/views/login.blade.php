@extends('layout.main')
@section('container')
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
    <div class="grid-container">
        <div class="title">
            <h2>Log in</h2>
            @if (session()->has('daftar'))
                <div class="alert alert-success" role="alert">
                    {{ session('daftar') }}
                </div>
            @endif
        </div>
        <div class="col-1">
            <img src="{{ asset('img/bus.jpg') }}" alt="">
        </div>
        <div class="col-2">
            <div class="create-account">
                <p>Belum Punya Akun ? <a href="{{ url('register') }}">Yuk Daftar!!!</a> </p>
            </div>
            <form action="{{ url('/login') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="kontent">
                    <div class="col-25">
                        <p>Username</p>
                    </div>
                    <div class="col-75">
                        <input class="@error('email')is-invalid @enderror" type="email" name="email"
                            value="{{ old('email') }}" placeholder="E-mail">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="kontent">
                    <div class="col-25">
                        <p>Password</p>
                    </div>
                    <div class="col-75">
                        <input class="@error('password')is-invalid @enderror" type="password" name="password"
                            value="{{ old('password') }}" placeholder="Password">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="daftar">
                    <button type="submit" name="button">Login</button>
                </div>
        </div>
        </form>
        {{-- <div class="forgot-password">
                    <a href="#">Forgot your password ?</a>
                </div> --}}
    </div>
@endsection
