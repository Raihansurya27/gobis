@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Kelas Bus</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/kelas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas Bus</label>
                    <input type="text" name="nama_kelas"
                        class="form-control @error('nama_kelas')is-invalid
                    @enderror" id="nama_kelas"
                        value="{{ ucwords(old('nama_kelas')) }}">
                    @error('nama_kelas')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
