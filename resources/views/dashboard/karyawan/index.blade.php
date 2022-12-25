@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Karyawan</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/karyawan/create')}}" class=" btn btn-primary">Tambah Karyawan Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Deskripsi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($karyawans as $karyawan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$karyawan->nama}}</td>
                <td>{{$karyawan->jabatan->nama}}</td>
                <td>{!!$karyawan->deskripsi!!}</td>
                @empty($karyawan->foto)
                    <td>Tidak ada data</td>
                @else
                    <td><img src="{{asset('img/staff/'.$karyawan->foto)}}" alt="Gambar" style="width: 125px; height: 100px;"></td>
                @endempty
                <td>
                    <a href="{{url('/karyawan/'.$karyawan->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/karyawan/'.$karyawan->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$karyawans->links('pagination::bootstrap-5')}}
@endsection
