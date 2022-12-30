@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Data User</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/user/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Muhammad Raihan Surya" name="nama"
                        value="{{ ucwords(old('nama', $user->nama)) }}">
                    @error('nama')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Anda</label>
                    <input type="email" class="form-control @error('email')is-invalid
                    @enderror"
                        id="email" placeholder="Contoh: raihanganteng@example.com" name="email"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Anda</label>
                    <input type="password" class="form-control @error('password')is-invalid
                    @enderror"
                        id="password" placeholder="Tolong, buat password sekali lagi atau baru. Min. 8 Karakter" name="password"
                        value="{{ old('password') }}">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Peran\Role Akun</label> <br>
                    <select class="form-select" aria-label="Default select example" name="role_id" id="role_id">
                        <option selected>Pilih Peran Akun\Role</option>
                        @forelse ($roles as $role)
                            @if (old('role_id', $user->role_id) == $role->id)
                                <option value="{{ $role->id }}" selected>{{ ucwords($role->nama_role) }}</option>
                            @else
                                <option value="{{ $role->id }}">{{ ucwords($role->nama_role) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Peran</option>
                        @endforelse
                    </select>
                </div>

                <h3>Alamat</h3>

                <div class="mb-3">
                    <label for="provinsi" class="form-label">Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id"
                        onchange="kabupaten()">
                        @forelse ($provinsis as $provinsi)
                            @if (old('provinsi_id', $user->kelurahan->kecamatan->kabupaten->provinsi->id) == $provinsi->id)
                                <option value="{{ $provinsi->id }}" selected>{{ ucwords($provinsi->nama) }}</option>
                            @else
                                <option value="{{ $provinsi->id }}">{{ ucwords($provinsi->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Provinsi</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3" id="bag-kab">
                    <label for="kabupaten_id" class="form-label">Kabupaten</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kabupaten_id" id="kabupaten_id"
                        onchange="kecamatan()">
                        @forelse ($kabupatens as $kabupaten)
                            @if (old('kabupaten_id', $user->kelurahan->kecamatan->kabupaten->id) == $kabupaten->id)
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

                <div class="mb-3" id="bag-kec">
                    <label for="kecamatan_id" class="form-label">Kecamatan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kecamatan_id" id="kecamatan_id"
                        onchange="kelurahan()">
                        @forelse ($kecamatans as $kecamatan)
                            @if (old('kecamatan_id', $user->kelurahan->kecamatan->id) == $kecamatan->id)
                                <option value="{{ $kecamatan->id }}" id="{{ $kecamatan->kabupaten_id }}" selected>
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

                <div class="mb-3" id="bag-kel">
                    <label for="kelurahan_id" class="form-label">Kelurahan</label> <br>
                    <select class="form-select @error('kelurahan_id')is-invalid @enderror" aria-label="Default select example" name="kelurahan_id" id="kelurahan_id">
                        @forelse ($kelurahans as $kelurahan)
                            @if (old('kelurahan_id', $user->kelurahan_id) == $kelurahan->id)
                                <option value="{{ $kelurahan->id }}" id="{{ $kelurahan->kecamatan_id }}" selected>
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

                <div class="mb-1">
                    @error('kelurahan_id')
                    {{ $message }}
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('deskripsi')is-invalid
                    @enderror" id="alamat"
                        rows="3" name="alamat">{{ ucwords((old('alamat',$user->alamat))) }}</textarea>
                    @error('alamat')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
