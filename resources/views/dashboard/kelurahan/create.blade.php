@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Acara\Event</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/kelurahan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Nama Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id"
                        onchange="kabupaten()">
                        <option value="pilih" selected>Pilih Provinsi</option>
                        @forelse ($provinsis as $provinsi)
                            @if (old('provinsi_id') == $provinsi->id)
                                <option value="{{ $provinsi->id }}" selected>{{ ucwords($provinsi->nama) }}</option>
                            @else
                                <option value="{{ $provinsi->id }}">{{ ucwords($provinsi->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Provinsi</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3" id="bag-kab" hidden="true">
                    <label for="kabupaten_id" class="form-label">Nama Kabupaten</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kabupaten_id" id="kabupaten_id"
                        onchange="kecamatan()">
                        <option value="pilih" selected>Pilih Kabupaten</option>
                        @forelse ($kabupatens as $kabupaten)
                            @if (old('kabupaten_id') == $kabupaten->id)
                                <option value="{{ $kabupaten->id }}" id="{{ $kabupaten->provinsi_id }}" selected>
                                    {{ ucwords($kabupaten->nama) }}</option>
                            @else
                                <option value="{{ $kabupaten->id }}" id="{{ $kabupaten->provinsi_id }}">
                                    {{ ucwords($kabupaten->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Kabupaten</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3" id="bag-kec" hidden="true">
                    <label for="kecamatan_id" class="form-label">Nama Kecamatan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kecamatan_id" id="kecamatan_id"
                        onchange="kelurahan()">
                        <option value="pilih" selected>Pilih Kecamatan</option>
                        @forelse ($kecamatans as $kecamatan)
                            @if (old('kecamatan_id') == $kecamatan->id)
                                <option value="{{ $kecamatan->id }}"  id="{{ $kecamatan->kabupaten_id }}" selected>
                                    {{ ucwords($kecamatan->nama) }}</option>
                            @else
                                <option value="{{ $kecamatan->id }}" id="{{ $kecamatan->kabupaten_id }}">
                                    {{ ucwords($kecamatan->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Kecamatan</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3" id="bag-kel" hidden="true">
                    <label for="nama" class="form-label">Nama Kelurahan</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Pauh" name="nama" value="{{ ucwords(old('nama')) }}">
                    @error('nama')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function kabupaten() {
            var provinsi = document.getElementById("provinsi_id");
            var kabupaten = document.getElementById("kabupaten_id");
            var hasil_prov = provinsi.value;
            var hasil_kab = kabupaten.options;
            var div_kab = document.getElementById("bag-kab");
            if (hasil_prov !== "pilih") {
                div_kab.hidden = false;
                for (i = 1; i < hasil_kab.length; i++) {
                    if (parseInt(hasil_prov) != parseInt(hasil_kab[i].id)) {
                        hasil_kab[i].hidden = true;
                    } else {
                        hasil_kab[i].hidden = false;
                        hasil_kab[0].selected = true;
                    }
                }
            } else {
                div_kab.hidden = true;
            }
        }

        function kecamatan() {
            var kabupaten = document.getElementById("kabupaten_id");
            var kecamatan = document.getElementById("kecamatan_id");
            var hasil_kab = kabupaten.value;
            var hasil_kec = kecamatan.options;
            var div_kec = document.getElementById("bag-kec");
            if (hasil_kab !== "pilih") {
                div_kec.hidden = false;
                for (i = 1; i < hasil_kec.length; i++) {
                    if (parseInt(hasil_kab) != parseInt(hasil_kec[i].id)) {
                        hasil_kec[i].hidden = true;
                    } else {
                        hasil_kec[i].hidden = false;
                        hasil_kec[0].selected = true;
                    }
                }
            } else {
                div_kec.hidden = true;
            }
        }

        function kelurahan() {
            var kecamatan = document.getElementById("kecamatan_id");
            var kelurahan = document.getElementById("nama");
            var hasil_kec = kecamatan.value;
            var hasil_kel = kelurahan.options;
            var div_kel = document.getElementById("bag-kel");
            if (hasil_kec !== "pilih") {
                div_kel.hidden = false;
            } else {
                div_kel.hidden = true;
            }
        }
    </script>
    @endsection
