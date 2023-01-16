@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Bus</h1>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <p>
        <a href="{{ url('/buses/create') }}" class=" btn btn-primary">Tambah Data Bus Baru</a>
    </p>

    <form action="{{ url('/cari-buses') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="Mercedes L-300">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('buses')}}" class="btn btn-success" style="align-content: center"><span class="material-symbols-sharp">
                    restart_alt
                </span></a>
            </div>
        </div>
    </form>

    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Bus</th>
                <th>Kelas</th>
                <th>Jumlah Bangku</th>
                <th>Deskripsi</th>
                <th>Fasilitas</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($buses as $bus)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($bus->nama) }}</td>
                <td>{{ ucwords($bus->class_bus->nama) }}</td>
                <td>{{ $bus->bangku }} bangku</td>
                <td>{{ Str::ucfirst($bus->deskripsi) }}</td>
                <td>
                    @forelse ($bus_facilities->where('bus_id',$bus->id) as $bus_facility)
                        {{$bus_facility->facility->nama}}<br>
                    @empty
                        Tidak ada data
                    @endforelse
                </td>
            @empty($bus->foto)
                <td><img src="{{ asset('img/noimage.png') }}" alt="{{ $bus->nama }}" style="width: 125px; height: 100px;">
                </td>
            @else
                <td><img src="{{ asset('img/bus/' . $bus->foto) }}" alt="{{ $bus->nama }}"
                        style="width: 125px; height: 100px;"></td>
            @endempty
            <td>
                <a href="{{ url('/buses/' . $bus->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ url('/buses/' . $bus->id) }}" class="d-inline" method="POST">
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
{{ $buses->links('pagination::bootstrap-5') }}
@endsection
