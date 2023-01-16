@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data User</h1>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <p>
        <a href="{{ url('/user/create') }}" class=" btn btn-primary">Tambah User Baru</a>
    </p>

    <form action="{{ url('/cari-user') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="Pencarian akun">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{ url('user') }}" class="btn btn-success" style="align-content: center"><span
                        class="material-symbols-sharp">
                        restart_alt
                    </span></a>
            </div>
        </div>
    </form>

    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Password</th>
                <th>Peran</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($user->nama) }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ Str::limit($user->password, 5) }} </td>
                <td>{{ ucwords($user->role->nama) }}</td>
                <td id="pendek-{{ $loop->iteration }}">
                    {{ ucwords(
                        Str::limit(
                            implode(', ', [
                                $user->alamat,
                                $user->kelurahan->nama,
                                $user->kelurahan->kecamatan->nama,
                                $user->kelurahan->kecamatan->kabupaten->nama,
                                $user->kelurahan->kecamatan->kabupaten->provinsi->nama,
                            ]),
                            5,
                        ),
                    ) }}
                    <button onclick="tampilkan({{ $loop->iteration }})"><span class="material-symbols-outlined">
                            open_in_full
                        </span>
                    </button>
                </td>
                <td id="panjang-{{ $loop->iteration }}" hidden="true">
                    {{ ucwords(
                        implode(', ', [
                            $user->alamat,
                            $user->kelurahan->nama,
                            $user->kelurahan->kecamatan->nama,
                            $user->kelurahan->kecamatan->kabupaten->nama,
                            $user->kelurahan->kecamatan->kabupaten->provinsi->nama,
                        ]),
                    ) }}
                    <button onclick="sembunyikan({{ $loop->iteration }})"><span class="material-symbols-outlined">
                            close_fullscreen
                        </span>
                    </button>
                </td>
                <td>
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ url('/user/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ url('/user/' . $user->id) }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
        @endforelse
    </table>
    {{ $users->links('pagination::bootstrap-5') }}
@endsection

<script type="text/javascript">
    function tampilkan(id) {
        var pendek = document.getElementById('pendek-' + id);
        var panjang = document.getElementById('panjang-' + id);
        pendek.hidden = true;
        panjang.hidden = false;
    }

    function sembunyikan(id) {
        var pendek = document.getElementById('pendek-' + id);
        var panjang = document.getElementById('panjang-' + id);
        panjang.hidden = true;
        pendek.hidden = false;
    }
</script>
