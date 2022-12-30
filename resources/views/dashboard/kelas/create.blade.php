@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Kelas Bus</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/class-buses') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Kelas Bus</label>
                    <input type="text" name="nama"
                        class="form-control @error('nama')is-invalid
                    @enderror" id="nama"
                        value="{{ ucwords(old('nama')) }}">
                    @error('nama')
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
