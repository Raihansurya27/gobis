@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Acara/Event</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/acara/create')}}" class=" btn btn-primary">Tambah Acara\Event Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Acara\Event</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($acaras as $acara)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$acara->nama}}</td>
                <td>Rp. {{$acara->harga}}</td>
                <td>{!!$acara->deskripsi!!}</td>
                @empty($acara->gambar)
                    <td><img src="{{asset('img/noimage.png')}}" alt="{{$acara->nama}}" style="width: 125px; height: 100px;"></td>
                @else
                    <td><img src="{{asset('img/event/'.$acara->gambar)}}" alt="{{$acara->nama}}" style="width: 125px; height: 100px;"></td>
                @endempty
                <td>
                    <a href="{{url('/acara/'.$acara->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/acara/'.$acara->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$acaras->links('pagination::bootstrap-5')}}
@endsection
