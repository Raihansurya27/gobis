@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Role</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/role/create')}}" class=" btn btn-primary">Tambah Role Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($roles as $role)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$role->nama_role}}</td>
                <td>
                    <a href="{{url('/role/'.$role->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/role/'.$role->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$roles->links('pagination::bootstrap-5')}}
@endsection
