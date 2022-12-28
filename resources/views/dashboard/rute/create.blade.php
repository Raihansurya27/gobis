@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Rute Perjalanan Bus</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/rute') }}" method="POST">
                @csrf

                <h3>Terminal Awal</h3>

                <div class="mb-3">
                    <label for="provinsi_id_1" class="form-label">Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id_1"
                        onchange="kabupaten(1)">
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

                <div class="mb-3" id="bag-kab-1" hidden="true">
                    <label for="kabupaten_id_1" class="form-label">Kabupaten</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kabupaten_id" id="kabupaten_id_1"
                        onchange="kecamatan(1)">
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

                <div class="mb-3" id="bag-kec-1" hidden="true">
                    <label for="kecamatan_id_1" class="form-label">Kecamatan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kecamatan_id" id="kecamatan_id_1"
                        onchange="kelurahan(1)">
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

                <div class="mb-3" id="bag-kel-1" hidden="true">
                    <label for="kelurahan_id_1" class="form-label">Kelurahan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kelurahan_id" id="kelurahan_id_1"
                        onchange="terminal(1)">
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

                <div class="mb-3" id="bag-ter-1" hidden="true">
                    <label for="terminal_id_1" class="form-label">Terminal</label> <br>
                    <select class="form-select" aria-label="Default select example" name="awal_id" id="terminal_id_1"
                        onchange="sama(1) ">
                        <option value="pilih" selected>Pilih Kelurahan</option>
                        @forelse ($terminals as $terminal)
                            @if (old('terminal_id') == $terminal->id)
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

                <div class="mb-3">
                    <label for="provinsi_id_2" class="form-label">Provinsi</label> <br>
                    <select class="form-select" aria-label="Default select example" name="provinsi_id" id="provinsi_id_2"
                        onchange="kabupaten(2)">
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

                <div class="mb-3" id="bag-kab-2" hidden="true">
                    <label for="kabupaten_id_2" class="form-label">Kabupaten</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kabupaten_id" id="kabupaten_id_2"
                        onchange="kecamatan(2)">
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

                <div class="mb-3" id="bag-kec-2" hidden="true">
                    <label for="kecamatan_id_2" class="form-label">Kecamatan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kecamatan_id"
                        id="kecamatan_id_2" onchange="kelurahan(2)">
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

                <div class="mb-3" id="bag-kel-2" hidden="true">
                    <label for="kelurahan_id_2" class="form-label">Kelurahan</label> <br>
                    <select class="form-select" aria-label="Default select example" name="kelurahan_id"
                        id="kelurahan_id_2" onchange="terminal(2)">
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

                <div class="mb-3" id="bag-ter-2" hidden="true">
                    <label for="terminal_id_2" class="form-label">Terminal</label> <br>
                    <select class="form-select" aria-label="Default select example" name="tujuan_id"
                        id="terminal_id_2">
                        <option value="pilih" selected>Pilih Terminal</option>
                        @forelse ($terminals as $terminal)
                            @if (old('terminal_id') == $terminal->id)
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

                <h3>Nama Bus</h3>

                <div class="mb-3">
                    <label for="bus_id" class="form-label">Bus</label> <br>
                    <select class="form-select" aria-label="Default select example" name="bus_id"
                        id="bus_id">
                        <option value="pilih" selected>Pilih Bus</option>
                        @forelse ($buses as $bus)
                            @if (old('bus_id') == $bus->id)
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function kabupaten(id) {
        var provinsi = document.getElementById("provinsi_id_" + id);
        var kabupaten = document.getElementById("kabupaten_id_" + id);
        var hasil_prov = provinsi.value;
        var hasil_kab = kabupaten.options;
        var div_kab = document.getElementById("bag-kab-" + id);
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

    function kecamatan(id) {
        var kabupaten = document.getElementById("kabupaten_id_" + id);
        var kecamatan = document.getElementById("kecamatan_id_" + id);
        var hasil_kab = kabupaten.value;
        var hasil_kec = kecamatan.options;
        var div_kec = document.getElementById("bag-kec-" + id);
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

    function kelurahan(id) {
        var kecamatan = document.getElementById("kecamatan_id_" + id);
        var kelurahan = document.getElementById("kelurahan_id_" + id);
        var hasil_kec = kecamatan.value;
        var hasil_kel = kelurahan.options;
        var div_kel = document.getElementById("bag-kel-" + id);
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

    function terminal(id) {
        var kelurahan = document.getElementById("kelurahan_id_" + id);
        var terminal = document.getElementById("terminal_id_" + id);
        var hasil_kel = kelurahan.value;
        var hasil_ter = terminal.options;
        var div_ter = document.getElementById("bag-ter-" + id);
        if (hasil_kel !== "pilih") {
            div_ter.hidden = false;
            for (i = 1; i < hasil_ter.length; i++) {
                if (parseInt(hasil_kel) != parseInt(hasil_ter[i].id)) {
                    hasil_ter[i].hidden = true;
                } else {
                    hasil_ter[i].hidden = false;
                    hasil_ter[0].selected = true;
                }
            }
        } else {
            div_ter.hidden = true;
        }
    }

    function sama() {
        var terminal1 = document.getElementById('terminal_id_1'); //1
        var terminal2 = document.getElementById('terminal_id_2'); //2

        var hasil1 = terminal1.value; //1
        var hasil2 = terminal2.options; //2

        if (hasil1 !== "pilih") { //jika tidak pilih
            var selectHasil1 = terminal1.options[hasil1].textContent.trim();
            for (i = 1; i < hasil2.length; i++) {
                var selectHasil2 = hasil2[i].textContent.trim()
                if (selectHasil1 == selectHasil2) {
                    console.log("dihapus");
                    hasil2[i].remove = true;
                    hasil2[0].selected = true;
                    console.log("sama");
                } else {
                    if (hasil2[i].hidden) {
                        hasil2[i].hidden = false;
                        terminal2.add(hasil2[i]);
                        console.log("berhasil ditambahkan" + i);
                    }
                    console.log("dibiarkan" + i);
                }
            }
        } else {
            for (const option of hasil2) {
                if (option.hidden) {
                    option.hidden = false;
                    terminal2.add(option);
                    console.log("berhasil ditambahkan");
                }
            }
        }
    }
</script>
