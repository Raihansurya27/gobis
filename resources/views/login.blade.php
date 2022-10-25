@extends('layout.main')
@section('container')
<link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
<div class="grid-container">
    <div class="title">
        <h2>Log in</h2>
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
                <div class="text">
                    <p>Username</p>
                    <p>Password</p>
                </div>
                <div class="input">
                    <input type="email" name="email" value="" placeholder="E-mail">
                    <input type="password" name="password" value="" placeholder="Password">
                </div>
            </div>
            <div class="forgot-password">
                <a href="#">Forgot your password ?</a>
            </div>
            <div class="daftar">
                <button type="submit" name="button">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection
