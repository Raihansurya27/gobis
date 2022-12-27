@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data Peran/Role User</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/peran/'.$perans->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Peran/Role</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror" id="nama" placeholder="Contoh: Makanan Pembuka" name="nama" value="{{old('nama',$perans->nama)}}">
                    @error('nama')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
