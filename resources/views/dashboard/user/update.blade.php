@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data User</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/user/'.$users->id)}}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name')is-invalid
                    @enderror" id="name" placeholder="Contoh: Muhammad Raihan Surya" name="name" value="{{old('name',$users->name)}}">
                    @error('name')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Anda</label>
                    <input type="email" class="form-control @error('email')is-invalid
                    @enderror" id="email" placeholder="Contoh: raihanganteng@example.com" name="email" value="{{old('email',$users->email)}}">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Anda</label>
                    <input type="password" class="form-control @error('password')is-invalid
                    @enderror" id="password" placeholder="Contoh: Min. 8 Karakter" name="password" value="{{old('password',$users->password)}}">
                    @error('password')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="peran_id" class="form-label">Peran Akun\Role</label> <br>
                    <select class="form-select" aria-label="Default select example" name="peran_id" id="peran_id">
                        <option selected>Pilih Peran Akun\Role</option>
                        @forelse ($perans as $peran)
                        @if (old('peran_id',$users->peran_id)==$peran->id)
                            <option value="{{$peran->id}}" selected>{{$peran->nama}}</option>
                        @else
                            <option value="{{$peran->id}}">{{$peran->nama}}</option>
                        @endif
                        @empty
                            <option>Tidak ada data Peran</option>
                        @endforelse
                      </select>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control  @error('picture')is-invalid
                    @enderror" name="picture" id="picture" value="{{old('picture', $users->picture)}}">
                    @error('picture')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
