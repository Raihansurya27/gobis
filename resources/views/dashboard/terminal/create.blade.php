@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Terminal Bus Baru</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/terminal') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Terminal Bus</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Makanan Pembuka" name="nama" value="{{ ucwords(old('nama')) }}">
                    @error('nama')
                        {{ $message }}
                    @enderror
                </div>
                <h3>Alamat</h3>
                <div class="mb-3">
                    <label for="provinsi_id" class="form-label">Provinsi</label> <br>
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
                    <label for="kabupaten_id" class="form-label">Kabupaten</label> <br>
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
                    <label for="kecamatan_id" class="form-label">Kecamatan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kecamatan_id" id="kecamatan_id"
                        onchange="kelurahan()">
                        <option value="pilih" selected>Pilih Kecamatan</option>
                        @forelse ($kecamatans as $kecamatan)
                            @if (old('kecamatan_id') == $kecamatan->id)
                                <option value="{{ $kecamatan->id }}" id="{{ $kecamatan->kabupaten_id }}" selected>
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
                    <label for="kelurahan_id" class="form-label">Kelurahan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kelurahan_id" id="kelurahan_id">
                        <option value="pilih" selected>Pilih Kelurahan</option>
                        @forelse ($kelurahans as $kelurahan)
                            @if (old('kelurahan_id') == $kelurahan->id)
                                <option value="{{ $kelurahan->id }}" id="{{ $kelurahan->kecamatan_id }}" selected>
                                    {{ ucwords($kelurahan->nama) }}</option>
                            @else
                                <option value="{{ $kelurahan->id }}" id="{{ $kelurahan->kecamatan_id }}">
                                    {{ ucwords($kelurahan->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Kelurahan</option>
                        @endforelse
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat')is-invalid
                    @enderror" id="alamat" rows="3"
                        name="alamat">{{ Str::ucfirst(old('alamat')) }}</textarea>
                    @error('alamat')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi')is-invalid
                    @enderror" id="deskripsi" rows="3"
                        name="deskripsi">{{ Str::ucfirst(old('deskripsi')) }}</textarea>
                    @error('deskripsi')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

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
        var kelurahan = document.getElementById("kelurahan_id");
        var hasil_kec = kecamatan.value;
        var hasil_kel = kelurahan.options;
        var div_kel = document.getElementById("bag-kel");
        if (hasil_kec !== "pilih") {
            div_kel.hidden = false;
            for (i = 1; i < hasil_kel.length; i++) {
                if (parseInt(hasil_kec) != parseInt(hasil_kel[i].id)) {
                    hasil_kel[i].hidden = true;
                } else {
                    hasil_kel[i].hidden = false;
                    hasil_kel[0].selected = true;
                }
            }
        } else {
            div_kel.hidden = true;
        }
    }
</script>
