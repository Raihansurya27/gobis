@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Rute Kecamatan Baru</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/kecamatan') }}" method="POST" enctype="multipart/form-data">
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
                                <option value="{{ $kabupaten->id }}" selected id="{{$kabupaten->provinsi_id}}">{{ ucwords($kabupaten->nama) }}</option>
                            @else
                                <option value="{{ $kabupaten->id }}" id="{{$kabupaten->provinsi_id}}">{{ ucwords($kabupaten->nama) }}</option>
                            @endif
                        @empty
                            <option>Tidak ada data Kabupaten</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3" id="bag-kec" hidden="true">
                    <label for="nama" class="form-label">Nama Kecamatan</label>
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
            var div_kec = document.getElementById("bag-kec");
            if (hasil_kab !== "pilih") {
                div_kec.hidden = false;
            } else {
                div_kec.hidden = true;
            }
        }
    </script>
@endsection
