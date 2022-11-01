@extends('layout.main')
@section('container')
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
    <div class="grid-container">
        <div class="title">
            <h2>Bis</h2>
        </div>
        <div class="col-1">
            <img src="{{ asset('img/bus.jpg') }}" alt="">
        </div>
        <div class="col-2">
            <div class="kontent">
                <div class="text">
                    <p>Nama Bus</p>
                    <p>Tipe Bus</p>
                    <p>Deskripsi</p>
                </div>
            </div>
        </div>
    </div>
@endsection
