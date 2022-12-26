@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rute Provinsi</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/provinsi/create')}}" class=" btn btn-primary">Tambah Rute Provinsi Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Provinsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($provinsis as $provinsi)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ucwords($provinsi->nama)}}</td>
                <td>
                    <a href="{{url('/provinsi/'.$provinsi->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/provinsi/'.$provinsi->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$provinsis->links('pagination::bootstrap-5')}}
@endsection
