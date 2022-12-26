@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Data Rute Kabupaten</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/kabupaten/' . $kabupaten->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Nama Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id">
                        @forelse ($provinsis as $provinsi)
                            @if (old('provinsi_id', $kabupaten->provinsi_id) == $provinsi->id)
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
                    <label for="nama" class="form-label">Nama Kabupaten</label>
                    <input type="text"
                        class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Padang" name="nama"
                        value="{{ ucwords(old('nama', $kabupaten->nama)) }}">
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
