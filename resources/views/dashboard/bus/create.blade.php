@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Entri Data Bus baru</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('/buses') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Bus</label>
                    <input type="text" class="form-control @error('nama')is-invalid
                    @enderror"
                        id="nama" placeholder="Contoh: Mercedes L-300" name="nama" value="{{ ucwords(old('nama')) }}">
                    @error('nama')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="class_bus_id" class="form-label">Kelas Bus</label> <br>
                    <select class="form-select" aria-label="Default select example" name="class_bus_id" id="class_bus_id">
                        @forelse ($class_buses as $class_bus)
                        @if (old('class_bus_id') == $class_bus->id)
                        <option value="{{ $class_bus->id }}" selected>{{ ucwords($class_bus->nama) }}</option>
                    @else
                        <option value="{{ $class_bus->id }}">{{ ucwords($class_bus->nama) }}</option>
                    @endif
                        @empty
                            <option>Tidak ada data kelas bus</option>
                        @endforelse
                    </select>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Bus</label>
                    <textarea class="form-control @error('deskripsi')is-invalid
                    @enderror" id="deskripsi" rows="3"
                        name="deskripsi">{{ Str::ucfirst(old('deskripsi')) }}</textarea>
                    @error('deskripsi')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Bus</label>
                    <input type="file" class="form-control  @error('foto')is-invalid
                    @enderror"
                        name="foto" id="foto">
                    @error('foto')
                        {{ $message }}
                    @enderror
                </div>
                <div class="mb-3">
                    <img src="" alt="Fotonya" style="width: 200px; height: 200px;" id="gambarCoba">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- <script type="text/javascript">
    // Ambil input file
    var inputFile = document.getElementById('fotoBus');

    // Ambil tag img untuk preview gambar
    var imgPreview = document.getElementById('gambarCoba');

    // function ambilGambar() {
    //     console.log(inputFile);
    //     // // Ambil file yang dipilih
    //     // const file = inputFile.value;

    //     // // Buat object URL dari file
    //     // const objectURL = URL.createObjectURL(file);

    //     // // Tampilkan gambar di tag img
    //     // imgPreview.src = objectURL;

    // }

    // Tambahkan event listener pada input file
    inputFile.addEventListener('change', function() {
        // Ambil file yang dipilih
        const file = this.files[0];

        // Buat object URL dari file
        const objectURL = URL.createObjectURL(file);

        // Tampilkan gambar di tag img
        imgPreview.src = objectURL;
    });
</script> --}}
