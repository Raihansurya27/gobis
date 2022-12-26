@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rute Kabupaten</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/kabupaten/create')}}" class=" btn btn-primary">Tambah Rute Kabupaten Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Provinsi</th>
                <th>Nama Kabupten</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($kabupatens as $kabupaten)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ucwords($kabupaten->provinsi->nama)}}</td>
                <td>{{ucwords($kabupaten->nama)}}</td>
                <td>
                    <a href="{{url('/kabupaten/'.$kabupaten->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/kabupaten/'.$kabupaten->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$kabupatens->links('pagination::bootstrap-5')}}
@endsection
