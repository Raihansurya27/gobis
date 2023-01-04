@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Fasilitas Bus</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/facilities/create')}}" class=" btn btn-primary">Tambah Fasilitas Bus Baru</a>
    </p>

    <form action="{{ url('/cari-facilities') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="WiFi">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('facilities')}}" class="btn btn-outline-primary" style="align-content: center"><span data-feather="refresh-ccw"></span></a>
            </div>
        </div>
    </form>


    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Fasilitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($facilities as $facility)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ucwords($facility->nama)}}</td>
                <td>
                    <a href="{{url('/facilities/'.$facility->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/facilities/'.$facility->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$facilities->links('pagination::bootstrap-5')}}
@endsection
