@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Pesanan Tiket Bus baru</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/pesanan') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">Nama Pelanggan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="user_id" id="user_id">
                        @forelse ($users as $user)
                            @if (old('user_id') == $user->id)
                                <option value="{{ $user->id }}" selected>{{ ucwords($user->nama) }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ ucwords($user->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data pelanggan</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jadwal_id" class="form-label">Rute Perjalanan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="jadwal_id" id="jadwal_id">
                        @forelse ($jadwals as $jadwal)
                            @if (old('jadwal_id') == $jadwal->id)
                                <option value="{{ $jadwal->id }}" id="{{ $jadwal->harga }}" selected>
                                    {{ ucwords($jadwal->rute->awal->nama . '->' . $jadwal->rute->tujuan->nama) }}, Jadwal
                                    keberangkatan : {{ $jadwal->keberangkatan }}</option>
                            @else
                                <option value="{{ $jadwal->id }}" id="{{ $jadwal->harga }}">
                                    {{ ucwords($jadwal->rute->awal->nama . '->' . $jadwal->rute->tujuan->nama) }}, Jadwal
                                    keberangkatan : {{ $jadwal->keberangkatan }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data jadwal perjalanan</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label> <br>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option value="dipesan">Dipesan</option>
                        <option value="dibayar">Dibayar</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_pesan" class="form-label">Tanggal Pemesanan</label>
                    <input type="datetime-local"
                        class="form-control @error('tanggal_pesan')is-invalid
                    @enderror"
                        id="tanggal_pesan" name="tanggal_pesan" value="{{ ucwords(old('tanggal_pesan')) }}">
                    @error('tanggal_pesan')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal_beli" class="form-label">Tanggal Bayar</label>
                    <input type="datetime-local"
                        class="form-control @error('tanggal_beli')is-invalid
                    @enderror"
                        id="tanggal_beli" name="tanggal_beli" value="{{ ucwords(old('tanggal_beli')) }}">
                    @error('tanggal_beli')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Bangku</label>
                    <input type="number" class="form-control @error('jumlah')is-invalid
                    @enderror"
                        id="jumlah" placeholder="Contoh: 3" name="jumlah" value="{{ ucwords(old('jumlah')) }}">
                    @error('jumlah')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control @error('total')is-invalid
                    @enderror"
                        id="total" placeholder="Tekan disini dan totalnya akan tampil disini" name="total"
                        value="{{ ucwords(old('total')) }}" readonly="true" onclick="totalFun()" value="{{old('total')}}">
                    @error('total')
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

<script type="text/javascript">
    function totalFun() {
        var harga = document.getElementById('jadwal_id');
        var jumlah = document.getElementById('jumlah');
        var total = document.getElementById('total');
        var totalHarga = (parseInt(harga.selectedOptions[0].id) * parseInt(jumlah.value));
        console.log(totalHarga)
        total.value = parseInt(totalHarga);
    }
</script>
