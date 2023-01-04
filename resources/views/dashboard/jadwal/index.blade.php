@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Jadwal Keberangkatan Bus</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/jadwal/create')}}" class=" btn btn-primary">Tambah Jadwal Keberangkatan Bus Baru</a>
    </p>

    <form action="{{ url('/cari-jadwal') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="Pencarian jadwal">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('jadwal')}}" class="btn btn-outline-primary" style="align-content: center"><span data-feather="refresh-ccw"></span></a>
            </div>
        </div>
    </form>

    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Jadwal Keberangkatan</th>
                <th>Rute Perjalanan</th>
                <th>Jadwal Keberangkatan</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($jadwals as $jadwal)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ucwords($jadwal->nama)}}</td>
                <td>{{ucwords($jadwal->rute->awal->nama.' -> '.$jadwal->rute->tujuan->nama)}}</td>
                <td>{{$jadwal->keberangkatan}}</td>
                <td>Rp. {{number_format($jadwal->harga,2,",",".")}}</td>
                <td>
                    <a href="{{url('/jadwal/'.$jadwal->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/jadwal/'.$jadwal->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$jadwals->links('pagination::bootstrap-5')}}
@endsection
