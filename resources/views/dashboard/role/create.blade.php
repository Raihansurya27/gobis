@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Data User baru</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/role')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Peran</label>
                    <input type="text" class="form-control @error('nama_role')is-invalid
                    @enderror" id="nama" placeholder="Contoh: Muhammad Raihan Surya" name="nama" value="{{old('nama')}}">
                    @error('nama_role')
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
