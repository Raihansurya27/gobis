@extends('dashboard.layout.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Role</h1>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <p>
        <a href="{{ url('/role/create') }}" class=" btn btn-primary">Tambah Role Baru</a>
    </p>

    <form action="{{ url('/cari-role') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="ex: Admin">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('role')}}" class="btn btn-success" style="align-content: center"><span class="material-symbols-sharp">
                    restart_alt
                    </span></a>
            </div>
        </div>
    </form>

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
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($role->nama) }}</td>
                <td>
                    <a href="{{ url('/role/' . $role->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ url('/role/' . $role->id) }}" class="d-inline" method="POST">
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
    {{ $roles->links('pagination::bootstrap-5') }}
@endsection
