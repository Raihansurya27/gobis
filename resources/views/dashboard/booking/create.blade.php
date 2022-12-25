@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Entri Data Booking</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/booking')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="tanggal_booking" class="form-label">Tanggal Booking</label>
                    <input type="date" name="tanggal_booking" class="form-control @error('tanggal_booking')is-invalid
                    @enderror" id="tanggal booking" value="{{old('tanggal_booking')}}">
                    @error('tanggal_booking')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="notelp" class="form-label">No. Telp</label>
                    <input type="text" class="form-control @error('notelp')is-invalid
                    @enderror" id="notelp" placeholder="Contoh: 08xxxxx atau (021)1231xxx" name="notelp" value="{{old('notelp')}}">
                    @error('notelp')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Orang</label>
                    <input type="number" class="form-control @error('jumlah')is-invalid
                    @enderror" name="jumlah" id="jumlah" value="{{old('jumlah')}}">
                    @error('jumlah')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Booking</label>
                    <textarea class="form-control ckeditor @error('deskripsi')is-invalid
                    @enderror" id="deskripsi" rows="3" name="deskripsi">{{old('deskripsi')}}</textarea>
                    @error('deskripsi')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="book" class="form-label">Status Booking</label> <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="book" value="dibooking" checked>
                        <label class="form-check-label" for="l">Dibooking</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="selesai" value="Selesai">
                        <label class="form-check-label" for="selesai">Selesai</label>
                    </div>
                </div
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
