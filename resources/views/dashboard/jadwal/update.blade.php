@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data Jadwal Keberangkatan Bus</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/jadwal/'.$jadwal->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Judul Keberangkatan</label>
                    <input type="text" class="form-control @error('ket')is-invalid
                    @enderror" id="nama" placeholder="Contoh: Spesial Lebaran" name="nama" value="{{ucwords(old('nama',$jadwal->nama))}}">
                    @error('nama')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jadwal_id" class="form-label">Rute Perjalanan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="jadwal_id" id="jadwal_id">
                        @forelse ($jadwals as $jadwal)
                        @if (old('jadwal_id') == $jadwal->id)
                        <option value="{{ $jadwal->id }}" selected>{{ ucwords($jadwal->rute->awal->nama.' -> '.$jadwal->rute->tujuan->nama), Jadwal keberangkatan : {{$jadwal->keberangkatan}} }}</option>
                    @else
                        <option value="{{ $jadwal->id }}">{{ ucwords($jadwal->rute->awal->nama.' -> '.$jadwal->rute->tujuan->nama) }}, Jadwal keberangkatan : {{$jadwal->keberangkatan}}</option>
                    @endif
                        @empty
                            <option>Tidak ada data jadwal perjalanan</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keberangkatan" class="form-label">Jadwal Keberangkatan</label>
                    <input type="datetime-local" class="form-control @error('ket')is-invalid
                    @enderror" id="keberangkatan" name="keberangkatan" value="{{ucwords(old('keberangkatan',$jadwal->keberangkatan))}}">
                    @error('keberangkatan')
                        {{$message}}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Tiket</label>
                    <input type="number" class="form-control @error('ket')is-invalid
                    @enderror" id="harga" placeholder="Contoh: 50000" name="harga" value="{{ucwords(old('harga',$jadwal->harga))}}">
                    @error('harga')
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
