@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Terminal Bus</h1>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <p>
        <a href="{{ url('/terminal/create') }}" class=" btn btn-primary">Tambah Terminal Bus Baru</a>
    </p>

    <form action="{{ url('/cari-terminal') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="Pencarian terminal">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('terminal')}}" class="btn btn-outline-primary" style="align-content: center"><span data-feather="refresh-ccw"></span></a>
            </div>
        </div>
    </form>

    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Nama Terminal</th>
                <th>Alamat</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($terminals as $terminal)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($terminal->nama) }}</td>
                <td id="pendek-{{ $loop->iteration }}">
                    {{ ucwords(Str::limit(implode(', ', [$terminal->alamat, $terminal->kelurahan->nama, $terminal->kelurahan->kecamatan->nama, $terminal->kelurahan->kecamatan->kabupaten->nama, $terminal->kelurahan->kecamatan->kabupaten->provinsi->nama]), 40)) }}
                    <button onclick="tampilkan({{ $loop->iteration }})"> <span data-feather="arrow-down-right"></span>
                    </button>
                </td>
                <td id="panjang-{{ $loop->iteration }}" hidden="true">
                    {{ ucwords(implode(', ', [$terminal->alamat, $terminal->kelurahan->nama, $terminal->kelurahan->kecamatan->nama, $terminal->kelurahan->kecamatan->kabupaten->nama, $terminal->kelurahan->kecamatan->kabupaten->provinsi->nama])) }}
                    <button onclick="sembunyikan({{ $loop->iteration }})"> <span data-feather="arrow-up-left"></span>
                    </button>
                </td>
                <td>{{ Str::ucfirst($terminal->deskripsi) }}</td>
                <td>
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ url('/terminal/' . $terminal->id . '/edit') }}"
                                class="btn btn-warning btn-sm">Edit</a>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ url('/terminal/' . $terminal->id) }}" class="d-inline" method="POST">
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
    {{ $terminals->links('pagination::bootstrap-5') }}
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
