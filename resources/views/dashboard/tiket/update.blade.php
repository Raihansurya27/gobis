@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data Terminal Bus</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/terminal/'.$terminal->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Terminal Bus</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Makanan Pembuka" name="nama" value="{{ ucwords(old('nama',$terminal->nama)) }}">
                    @error('nama')
                        {{ $message }}
                    @enderror
                </div>
                <h3>Alamat</h3>
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id"
                        onchange="kabupaten()">
                        <option value="pilih" selected>Pilih Provinsi</option>
                        @forelse ($provinsis as $provinsi)
                            @if (old('provinsi_id',$terminal->kelurahan->kecamatan->kabupaten->provinsi_id) == $provinsi->id)
                                <option value="{{ $provinsi->id }}" selected>{{ ucwords($provinsi->nama) }}</option>
                            @else
                                <option value="{{ $provinsi->id }}">{{ ucwords($provinsi->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Provinsi</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kabupaten_id" class="form-label">Kabupaten</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kabupaten_id" id="kabupaten_id"
                        onchange="kecamatan()">
                        <option value="pilih" selected>Pilih Kabupaten</option>
                        @forelse ($kabupatens as $kabupaten)
                            @if (old('kabupaten_id',$terminal->kelurahan->kecamatan->kabupaten_id) == $kabupaten->id)
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

                <div class="mb-3">
                    <label for="kecamatan_id" class="form-label">Kecamatan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kecamatan_id" id="kecamatan_id"
                        onchange="kelurahan()">
                        <option value="pilih" selected>Pilih Kecamatan</option>
                        @forelse ($kecamatans as $kecamatan)
                            @if (old('kecamatan_id',$terminal->kelurahan->kecamatan_id) == $kecamatan->id)
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

                <div class="mb-3">
                    <label for="kelurahan_id" class="form-label">Kelurahan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kelurahan_id" id="kelurahan_id">
                        <option value="pilih" selected>Pilih Kelurahan</option>
                        @forelse ($kelurahans as $kelurahan)
                            @if (old('kelurahan_id',$terminal->kelurahan_id) == $kelurahan->id)
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

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat')is-invalid
                    @enderror" id="alamat" rows="3"
                        name="alamat">{{ Str::ucfirst(old('alamat',$terminal->alamat)) }}</textarea>
                    @error('alamat')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi')is-invalid
                    @enderror" id="deskripsi" rows="3"
                        name="deskripsi">{{ Str::ucfirst( old('deskripsi',$terminal->deskripsi) ) }}</textarea>
                    @error('deskripsi')
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
