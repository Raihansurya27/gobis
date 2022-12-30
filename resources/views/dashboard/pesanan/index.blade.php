@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pesanan Tiket Bus</h1>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <p>
        <a href="{{ url('/pesanan/create') }}" class=" btn btn-primary">Tambah Pesan Tiket Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Pelanggan</th>
                <th>Jadwal Keberangkatan</th>
                <th>Rute Perjalanan</th>
                <th>Tangggal Pesan</th>
                <th>Tanggal Beli</th>
                <th>Status</th>
                <th>Jumlah Bangku</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($pesanans as $pesanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($pesanan->user->nama) }}</td>
                <td>{{ $pesanan->jadwal->keberangkatan }}</td>
                <td>{{ ucwords($pesanan->jadwal->rute->awal->nama . '->' . $pesanan->jadwal->rute->tujuan->nama) }}</td>
                <td>{{ $pesanan->tanggal_pesan }}</td>
            @empty($pesanan->tanggal_beli)
                <td>Belum ditentukan</td>
            @else
                <td>{{ $pesanan->tanggal_beli }}</td>
            @endempty
            <td>{{ ucwords($pesanan->status) }}</td>
            <td>{{ $pesanan->jumlah }}</td>
            <td>Rp. {{ number_format($pesanan->total, 2, ',', '.') }}</td>
            <td>
                <a href="{{ url('/pesanan/' . $pesanan->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ url('/pesanan/' . $pesanan->id) }}" class="d-inline" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
    @endforelse
</table>
{{ $pesanans->links('pagination::bootstrap-5') }}
@endsection
