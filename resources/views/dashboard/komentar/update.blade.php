@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data Komentar</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/komentar/'.$komentars->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="ket" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('ket')is-invalid
                    @enderror" id="ket" placeholder="Contoh: Makanannya dan tempatnya enak" name="ket" value="{{old('ket',$komentars->ket)}}">
                    @error('ket')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Deskripsi Komentar</label>
                    <textarea class="form-control ckeditor @error('isi')is-invalid
                    @enderror" id="isi" rows="3" name="isi">{{old('isi',$komentars->isi)}}</textarea>
                    @error('isi')
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
