@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Data Karyawan</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/kecamatan/' . $kecamatan->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Nama Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id"
                        onchange="kabupaten()">
                        @forelse ($provinsis as $provinsi)
                            @if (old('provinsi_id', $kecamatan->kabupaten->provinsi_id) == $provinsi->id)
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
                    <label for="kabupaten_id" class="form-label">Nama Kabupaten</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kabupaten_id" id="kabupaten_id"
                        onchange="kecamatan()">
                        @forelse ($kabupatens as $kabupaten)
                            @if (old('kabupaten_id', $kecamatan->kabupaten_id) == $kabupaten->id)
                                <option value="{{ $kabupaten->id }}" selected id="{{ $kabupaten->provinsi_id }}">
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
                    <label for="nama" class="form-label">Nama Kecamatan</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Pauh" name="nama"
                        value="{{ ucwords(old('nama', $kecamatan->nama)) }}">
                    @error('nama')
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
