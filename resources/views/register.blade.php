@extends('layout.main')
@section('container')
<!-- register -->
<link rel="stylesheet" href="{{ asset('css/style_register.css') }}">
<div class="grid-container">
    <div class="title">
        <h2>Register</h2>
    </div>
    <div class="col-1">
        <img src="{{ asset('img/bus.jpg') }}" alt="">
    </div>
    <div class="col-2">
        <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data">
            <div class="kontent">
                <div class="text">
                    <p>Nama Lengkap</p>
                    <p>Username</p>
                    <p>Password</p>
                    <p>No Handphone</p>
                    <p>Alamat</p>
                </div>
                <div class="input">
                    @csrf
                    <input type="text" name="nama" value="" placeholder="Nama Lengkap">
                    <input type="text" name="username" value="" placeholder="Username">
                    <input type="password" name="password" value="" placeholder="Password">
                    <input type="text" name="nohp" value="" placeholder="No Hp">
                    <textarea name="alamat" rows="2" cols="" placeholder="Alamat"></textarea>
                </div>
            </div>
            <div class="daftar">
                <button type="submit" name="button">Daftar</button>
            </div>
        </form>
    </div>
</div>
@endsection
