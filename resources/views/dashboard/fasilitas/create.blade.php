@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Fasilitas Bus baru</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/facilities')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Fasilitas</label>
                    <input type="text" class="form-control @error('ket')is-invalid
                    @enderror" id="nama" placeholder="Contoh: Full AC" name="nama" value="{{old('nama')}}">
                    @error('nama')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
