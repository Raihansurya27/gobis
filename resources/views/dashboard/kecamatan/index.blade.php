@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rute Kecamatan</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/kecamatan/create')}}" class=" btn btn-primary">Tambah Rute Kecamatan Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Provinsi</th>
                <th>Nama Kabupaten</th>
                <th>Nama Kecamatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($kecamatans as $kecamatan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ucwords($kecamatan->kabupaten->provinsi->nama)}}</td>
                <td>{{ucwords($kecamatan->kabupaten->nama)}}</td>
                <td>{{ucwords($kecamatan->nama)}}</td>
                <td>
                    <a href="{{url('/kecamatan/'.$kecamatan->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/kecamatan/'.$kecamatan->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$kecamatans->links('pagination::bootstrap-5')}}
@endsection
