@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rute Kelurahan</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/kelurahan/create')}}" class=" btn btn-primary">Tambah Rute Kelurahan Baru</a>
    </p>

    <form action="{{ url('/cari-kelurahan') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="ex: Kapalo Koto">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('kelurahan')}}" class="btn btn-outline-primary" style="align-content: center"><span data-feather="refresh-ccw"></span></a>
            </div>
        </div>
    </form>

    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Provinsi</th>
                <th>Nama Kabupaten</th>
                <th>Nama Kecamatan</th>
                <th>Nama Kelurahan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($kelurahans as $kelurahan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ucwords($kelurahan->kecamatan->kabupaten->provinsi->nama)}}</td>
                <td>{{ucwords($kelurahan->kecamatan->kabupaten->nama)}}</td>
                <td>{{ucwords($kelurahan->kecamatan->nama)}}</td>
                <td>{{ucwords($kelurahan->nama)}}</td>
                <td>
                    <a href="{{url('/kelurahan/'.$kelurahan->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/kelurahan/'.$kelurahan->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$kelurahans->links('pagination::bootstrap-5')}}
@endsection
