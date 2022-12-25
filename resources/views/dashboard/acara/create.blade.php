@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Data Acara\Event</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/acara/')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Acara\Event</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror" id="nama" placeholder="Contoh: Ulang Tahun" name="nama" value="{{old('nama')}}">
                    @error('nama')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Acara\Event</label>
                    <input type="text" class="form-control @error('harga')is-invalid
                    @enderror" id="harga" placeholder="Contoh: 15000" name="harga" value="{{old('harga')}}">
                    @error('harga')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Acara</label>
                    <textarea class="form-control ckeditor @error('deskripsi')is-invalid
                    @enderror" id="deskripsi" rows="3" name="deskripsi">{{old('deskripsi')}}</textarea>
                    @error('deskripsi')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Menu</label>
                    <input type="file" class="form-control  @error('gambar')is-invalid
                    @enderror" name="gambar" id="gambar" value="{{old('gambar')}}">
                    @error('gambar')
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
