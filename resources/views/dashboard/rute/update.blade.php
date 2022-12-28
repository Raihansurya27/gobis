@extends('dashboard.layout.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update Data Rute Perjalanan Bus</h1>
</div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{url('/rute/'.$rute->id)}}" method="POST">
                @method('PUT')
                @csrf
                <h3>Terminal Awal</h3>
                <div class="mb-3" id="bag-ter-1">
                    <label for="terminal_id_1" class="form-label">Terminal</label> <br>
                    <select class="form-select" aria-label="Default select example" name="awal_id" id="terminal_id_1"
                        onchange="sama(1) ">
                        <option value="pilih" selected>Pilih Kelurahan</option>
                        @forelse ($terminals as $terminal)
                            @if (old('terminal_id',$rute->awal_id) == $terminal->id)
                                <option value="{{ $terminal->id }}" id="{{ $terminal->kelurahan_id }}" selected>
                                    {{ ucwords($terminal->nama) }}</option>
                            @else
                                <option value="{{ $terminal->id }}" id="{{ $terminal->kelurahan_id }}">
                                    {{ ucwords($terminal->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Terminal</option>
                        @endforelse
                    </select>
                </div>
                <h3>Terminal Tujuan</h3>
                <div class="mb-3" id="bag-ter-1">
                    <label for="terminal_id_1" class="form-label">Terminal</label> <br>
                    <select class="form-select" aria-label="Default select example" name="tujuan_id" id="terminal_id_1"
                        onchange="sama(1) ">
                        <option value="pilih" selected>Pilih Kelurahan</option>
                        @forelse ($terminals as $terminal)
                            @if (old('terminal_id',$rute->tujuan_id) == $terminal->id)
                                <option value="{{ $terminal->id }}" id="{{ $terminal->kelurahan_id }}" selected>
                                    {{ ucwords($terminal->nama) }}</option>
                            @else
                                <option value="{{ $terminal->id }}" id="{{ $terminal->kelurahan_id }}">
                                    {{ ucwords($terminal->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Terminal</option>
                        @endforelse
                    </select>
                </div>

                <h3>Pilihan Bus</h3>

                <div class="mb-3">
                    <label for="bus_id" class="form-label">Bus</label> <br>
                    <select class="form-select" aria-label="Default select example" name="bus_id"
                        id="bus_id">
                        <option value="pilih" selected>Pilih Bus</option>
                        @forelse ($buses as $bus)
                            @if (old('bus_id',$rute->bus_id) == $bus->id)
                                <option value="{{ $bus->id }}" selected>
                                    {{ ucwords($bus->nama) }}</option>
                            @else
                                <option value="{{ $bus->id }}">
                                    {{ ucwords($bus->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data bus</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
