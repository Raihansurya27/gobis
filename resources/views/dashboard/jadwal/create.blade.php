@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Jadwal Keberangkatan Bus baru</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/jadwal') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Judul Keberangkatan</label>
                    <input type="text" class="form-control @error('ket')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Spesial Lebaran" name="nama"
                        value="{{ ucwords(old('nama')) }}">
                    @error('nama')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="rute_id" class="form-label">Rute Perjalanan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="rute_id" id="rute_id">
                        @forelse ($rutes as $rute)
                            @if (old('rute_id') == $rute->id)
                                <option value="{{ $rute->id }}" selected>
                                    {{ ucwords($rute->awal->nama . '->' . $rute->tujuan->nama) }}</option>
                            @else
                                <option value="{{ $rute->id }}">
                                    {{ ucwords($rute->awal->nama . '->' . $rute->tujuan->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data rute perjalanan</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                    <input type="datetime-local" class="form-control @error('ket')is-invalid
                    @enderror"
                        id="keberangkatan" name="keberangkatan" value="{{ ucwords(old('keberangkatan')) }}">
                    @error('keberangkatan')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Tiket</label>
                    <input type="number" class="form-control @error('ket')is-invalid
                    @enderror"
                        id="harga" placeholder="Contoh: 50000" name="harga" value="{{ ucwords(old('harga')) }}">
                    @error('harga')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        var bangku =
    </script>
@endsection
