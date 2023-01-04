@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Rute Perjalanan Bus</h1>
</div>
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{session('pesan')}}
        </div>
    @endif

    <p>
        <a href="{{url('/rute/create')}}" class=" btn btn-primary">Tambah Rute Perjalanan Bus Baru</a>
    </p>

    <form action="{{ url('/cari-rute') }}" method="GET">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <input type="text" class="form-control" name="cari" placeholder="Pencarian rute">
            </div>
            <div class="col-1">
                <button class=" btn btn-primary" type="submit">Cari</button>
            </div>
            <div class="col-1" style="margin-left: -40px">
                <a href="{{url('rute')}}" class="btn btn-outline-primary" style="align-content: center"><span data-feather="refresh-ccw"></span></a>
            </div>
        </div>
    </form>

    <table class=" table table-borderless">
        <thead class=" table-dark">
            <tr>
                <th>No.</th>
                <th>Awal</th>
                <th>Tujuan</th>
                <th>Bus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($rutes as $rute)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td id="pendekawal-{{ $loop->iteration }}">
                    {{ ucwords(Str::limit(implode(', ', [$rute->awal->alamat, $rute->awal->kelurahan->nama, $rute->awal->kelurahan->kecamatan->nama, $rute->awal->kelurahan->kecamatan->kabupaten->nama, $rute->awal->kelurahan->kecamatan->kabupaten->provinsi->nama]), 10)) }} <button
                        onclick="tampilkanawal({{ $loop->iteration }})"><span data-feather="arrow-down-right"></span>
                    </button>
                </td>
                <td id="panjangawal-{{ $loop->iteration }}" hidden="true">{{ucwords(implode(', ', [$rute->awal->alamat, $rute->awal->kelurahan->nama, $rute->awal->kelurahan->kecamatan->nama, $rute->awal->kelurahan->kecamatan->kabupaten->nama, $rute->awal->kelurahan->kecamatan->kabupaten->provinsi->nama]))}} <button
                        onclick="sembunyikanawal({{ $loop->iteration }})"><span data-feather="arrow-up-left"></span></button>
                </td>
                <td id="pendektujuan-{{ $loop->iteration }}">
                    {{ ucwords(Str::limit(implode(', ', [$rute->tujuan->alamat, $rute->tujuan->kelurahan->nama, $rute->tujuan->kelurahan->kecamatan->nama, $rute->tujuan->kelurahan->kecamatan->kabupaten->nama, $rute->tujuan->kelurahan->kecamatan->kabupaten->provinsi->nama]), 10)) }} <button
                        onclick="tampilkantujuan({{ $loop->iteration }})"><span data-feather="arrow-down-right"></span>
                    </button>
                </td>
                <td id="panjangtujuan-{{ $loop->iteration }}" hidden="true">{{ucwords(implode(', ', [$rute->tujuan->alamat, $rute->tujuan->kelurahan->nama, $rute->tujuan->kelurahan->kecamatan->nama, $rute->tujuan->kelurahan->kecamatan->kabupaten->nama, $rute->tujuan->kelurahan->kecamatan->kabupaten->provinsi->nama]))}} <button
                        onclick="sembunyikantujuan({{ $loop->iteration }})"><span data-feather="arrow-up-left"></span></button>
                </td>
                <td>{{ucwords($rute->bus->nama)}}</td>
                <td>
                    <a href="{{url('/rute/'.$rute->id.'/edit')}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('/rute/'.$rute->id)}}" class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty

        @endforelse
    </table>
    {{$rutes->links('pagination::bootstrap-5')}}
@endsection

<script type="text/javascript">
    function tampilkanawal(id) {
        var pendek = document.getElementById('pendekawal-' + id);
        var panjang = document.getElementById('panjangawal-' + id);
        pendek.hidden = true;
        panjang.hidden = false;
    }

    function sembunyikanawal(id) {
        var pendek = document.getElementById('pendekawal-' + id);
        var panjang = document.getElementById('panjangawal-' + id);
        panjang.hidden = true;
        pendek.hidden = false;
    }

    function tampilkantujuan(id) {
        var pendek = document.getElementById('pendektujuan-' + id);
        var panjang = document.getElementById('panjangtujuan-' + id);
        pendek.hidden = true;
        panjang.hidden = false;
    }

    function sembunyikantujuan(id) {
        var pendek = document.getElementById('pendektujuan-' + id);
        var panjang = document.getElementById('panjangtujuan-' + id);
        panjang.hidden = true;
        pendek.hidden = false;
    }
</script>
