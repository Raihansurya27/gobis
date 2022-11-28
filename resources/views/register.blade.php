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
      @csrf
      <div class="kontent">
        <div class="col-25">
          <p>Nama Lengkap</p>
        </div>
        <div class="col-75">
          <input type="text" class="@error('nama')is-invalid @enderror" name="nama" value="{{ old('nama') }}"
          placeholder="Nama Lengkap">
          @error('nama')
          {{ $message }}
          @enderror
        </div>
        <div class="col-25">
          <p>Email</p>
        </div>
        <div class="col-75">
          <input type="email" class="@error('email')is-invalid @enderror" name="email" value="{{ old('email') }}"
          placeholder="Email">
          @error('email')
          {{ $message }}
          @enderror
        </div>
        <div class="col-25">
          <p>Password</p>
        </div>
        <div class="col-75">
          <input type="password" class="@error('password')is-invalid @enderror" name="password" value="{{ old('password') }}"
          placeholder="Password minimal 8 karakter">
          @error('password')
          {{ $message }}
          @enderror
        </div>
        <div class="col-25">
          <p>Alamat</p>
        </div>
        <div class="col-75">
          {{-- <input type="text" class="@error('nohp')is-invalid @enderror" name="nohp" value="" placeholder="No Hp"> --}}
          <textarea name="alamat" class="@error('email')is-invalid @enderror" rows="2" cols="" placeholder="Alamat">{{ old('password') }}</textarea>
          @error('alamat')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div class="daftar">
        <button type="submit" name="button">Daftar</button>
      </div>
    </form>
  </div>
</div>
@endsection
