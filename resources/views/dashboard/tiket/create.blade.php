@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Tiket Bus Baru</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/tiket') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kode_tiket" class="form-label">Kode Tiket</label>
                    <input type="text" class="form-control @error('kode_tiket')is-invalid
                    @enderror"
                        id="kode_tiket" placeholder="Contoh: BKT002-01-02" name="kode_tiket" value="{{ ucwords(old('kode_tiket')) }}">
                    @error('kode_tiket')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pesanan_id" class="form-label">Pesanan Perjalanan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="pesanan_id" id="pesanan_id">
                        <option value="pilih" selected>Pilih Pesanan Perjalanan</option>
                        @forelse ($pesanans as $pesanan)
                            @if (old('pesanan_id') == $pesanan->id)
                                <option value="{{ $pesanan->id }}" selected>{{ ucwords(''.$pesanan->jadwal->rute->awal->nama.'->'.$pesanan->jadwal->rute->tujuan->nama.', Keberangkatan : '.$pesanan->jadwal->keberangkatan) }}</option>
                            @else
                                <option value="{{ $pesanan->id }}">{{ ucwords(''.$pesanan->jadwal->rute->awal->nama.'->'.$pesanan->jadwal->rute->tujuan->nama.', Keberangkatan : '.$pesanan->jadwal->keberangkatan) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data pesanan</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

