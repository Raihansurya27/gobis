@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Peran/Role User</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/peran/create')}}" class=" btn btn-primary">Tambah Peran/Role Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($perans as $peran)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$peran->nama}}</td>
                <td>
                    <a href="{{url('/peran/'.$peran->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/peran/'.$peran->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$perans->links('pagination::bootstrap-5')}}
@endsection
