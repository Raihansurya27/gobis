@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data User</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/user/create')}}" class=" btn btn-primary">Tambah User Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Password</th>
                <th>Peran</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{ Str::limit($user->password, 50)}}</td>
                <td>{{$user->peran->nama}}</td>
                @empty($user->picture)
                <td><img src="{{asset('img/noprofile.png')}}" alt="{{$user->name}}" style="width: 125px; height: 100px;"></td>
                @else
                <td><img src="{{asset('img/profil/'.$user->picture)}}" alt="{{$user->name}}" style="width: 125px; height: 100px;"></td>
                @endempty
                <td>
                    <a href="{{url('/user/'.$user->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/user/'.$user->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$users->links('pagination::bootstrap-5')}}
@endsection
