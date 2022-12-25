@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Booking</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/booking/create')}}" class=" btn btn-primary">Tambah Booking Baru</a>
    </p>
    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Pemesan/Booking</th>
                <th>Email</th>
                <th>No. Telp</th>
                <th>Tanggal Booking</th>
                <th>Jumlah (Orang)</th>
                <th>Deskripsi</th>
                <th>status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($bookings as $booking)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$booking->user->name}}</td>
                <td>{{$booking->user->email}}</td>
                <td>{{$booking->notelp}}</td>
                <td>{{$booking->tanggal_booking}}</td>
                <td>{{$booking->jumlah}}</td>
                <td>{!!$booking->deskripsi!!}</td>
                <td>{{$booking->status}}</td>
                <td>
                    <a href="{{url('/booking/'.$booking->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/booking/'.$booking->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$bookings->links('pagination::bootstrap-5')}}
@endsection
