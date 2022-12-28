<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="{{asset('css/style_caribus.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>Go-BIS</title>
</head>
<body>
  <div class="navbar">
    <input type="checkbox" name="" value="" id="check">
    <label for="check">
      <i class="material-icons" id="dehaze">dehaze</i>
      <i class="material-icons" id="close">close</i>
    </label>
    <div class="logo">
      <h2>Go-Bis</h2>
    </div>
    <div class="nav">
      <ul>
        <li> <a href="{{ url('home') }}" class="{{ Request::is('home') ? 'active' : 'active' }}">Home</a></li>
                <li> <a href="{{ url('bis') }}" class="{{ Request::is('bis') ? 'active' : '' }}">Bis</a></li>
                <li> <a href="{{ url('kontak') }}">Kontak</a></li>
                <li> <a href="{{ url('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">Tentang Kami</a>
                </li>
                @auth
                    <li>Hai, Rehan</li>
                    {{-- @empty(auth()->user()->picture)
                    <img src="{{asset('img/noprofile.png')}}" alt="{{auth()->user()->name}}" class="d-flex justify-content-center" style="width: 30px; height: 30px;">
                    @else
                    <img src="{{asset('img/profil/'.auth()->user()->picture)}}" alt="{{auth()->user()->name}}" class="d-flex justify-content-center" style="width: 30px; height: 30px;">
                    @endempty --}}
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button>Logout</button>
                    </form>
                @else
                    <li> <a href="{{ url('register') }}" class="{{ Request::is('register') ? 'active' : '' }}">Register</a>
                    </li>
                    <li> <a href="{{ url('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
                @endauth
      </ul>
    </div>
  </div>
  <!-- heading -->
  <div class="heading">
    <p>Silahkan pilih bus sesuai dengan kebutuhan anda.</p>
  </div>
  <!-- cari -->
  <div class="daridanke">
    <!-- dari dan ke -->
    <p>Padang <i class="fa-solid fa-arrow-right"></i> jakarta</p>
    <!-- tanggal -->
    <div class="tanggal">
      <p>Selasa, 15 November 2022</p>
      <p> | </p>
      <p>Jumlah Kursi : 1</p>
    </div>
    <hr>
  </div>
  <div class="ubahpencarian">
    <button type="button" name="button" onclick="ubahpencarian()">Ubah Pencarian</button>
  </div>
  <div class="kotak" id="kotak">
    <div class="label">
      <h3>Cari Tiket Bus</h3>
    </div>
    <div class="form">
      <div class="grid">
        <div class="col-1">
          <p>Dari</p>
          <input type="text" name="" value="" placeholder="Padang">
        </div>
        <div class="col-2">
          <p>ke</p>
          <input type="text" name="" value="" placeholder="Jakarta">
        </div>
        <div class="col-3">
          <p>Tanggal</p>
          <input type="date" name="" value="" placeholder="01/12/2022">
        </div>
        <div class="col-4">
          <p>Jumlah Kursi</p>
          <input type="number" name="" value="">
        </div>
        <div class="col-5">
          <a href="#"><button type="submit" name="button" > Cari</button></a>
        </div>
      </div>
    </div>
  </div>
  <!-- end cari -->
  <!-- jenis bus -->
  <div class="jenisbus">

    <div class="listbus">
      <div class="kotakbus">
        <div class="bus">
          <div class="namabus">
            <p>Bus Eksekutif</p>
          </div>
          <div class="kelasbus">
            <p>Eksekutif</p>
          </div>
        </div>
        <div class="isikotakbus">
          <div class="keberangkatan">
            <h3>keberangkatan :</h3>
            <p>12.05</p>
            <p>Terminal Bypass jaya, Kuranji, Kuranji, Padang, Sumatera Barat</p>
          </div>
          <div class="tujuan">
            <h3>Tujuan :</h3>
            <p>15.05</p>
            <p>Terminal Kampung Melayu, Menteng, Setia Budi, Jakarta Selatan, DKI Jakarta</p>
          </div>
          <div class="harga">
            <h2>Rp. 750.000 </h2><p>/kursi</p>
            <button type="button" name="button">Pesan Sekarang</button>
          </div>
        </div>
        <br>
        <div class="tomboltambahan">
          <button type="button" name="button" onclick="detailbus()">Detail bus</button>
          <button type="button" name="button" onclick="rutebus()">Rute Bus</button>
          <button type="button" name="button" onclick="lamaperjalanan()">Lama Perjalanan</button>
        </div>
      </div>
    </div>
    <!-- detail bus -->
    <div class="bungkus">
      <div class="detailbus" id="detailbus">
        <div class="textdetailbus">
          <p>Detail Bus</p>
        </div>
        <div class="isidetailbus">
          <p>Kelas Bus : Eksekutif</p>
          <p>Kapasitas Kursi :20 kursi</p>
          <p>Format Kursi :1-1</p>
          <p>Fasilitas :AC, Kursi, WiFi, Toilet, Area Merokok</p>
        </div>
      </div>
    </div>
    <!-- end detail bus -->
    <!-- rute bus -->
    <div class="bungkus">
      <div class="rutebus" id="rutebus">
        <div class="textrutebus">
          <p>Rute Bus</p>
        </div>
        <div class="isirutebus">
          <p>Padang, Palembang, Lampung, Jakarta</p>
        </div>
      </div>
    </div>
    <!-- end rute bus -->
    <!-- lama perjalanan -->
    <div class="bungkus">
      <div class="lamaperjalanan" id="lamaperjalanan">
        <div class="textlamaperjalanan">
          <p>Lama Perjalanan</p>
        </div>
        <div class="isilamaperjalanan">
          <p>1 Hari 8 Jam</p>
        </div>
      </div>
    </div>
    <!-- end rute bus -->
  </div>
  <!-- end list bus -->
  <!-- jenis bus -->
  <div class="jenisbus">

    <div class="listbus">
      <div class="kotakbus">
        <div class="bus">
          <div class="namabus">
            <p>Bus Eksekutif</p>
          </div>
          <div class="kelasbus">
            <p>Eksekutif</p>
          </div>
        </div>
        <div class="isikotakbus">
          <div class="keberangkatan">
            <h3>keberangkatan :</h3>
            <p>12.05</p>
            <p>Terminal Bypass jaya, Kuranji, Kuranji, Padang, Sumatera Barat</p>
          </div>
          <div class="tujuan">
            <h3>Tujuan :</h3>
            <p>15.05</p>
            <p>Terminal Kampung Melayu, Menteng, Setia Budi, Jakarta Selatan, DKI Jakarta</p>
          </div>
          <div class="harga">
            <h2>Rp. 750.000 </h2><p>/kursi</p>
            <button type="button" name="button">Pesan Sekarang</button>
          </div>
        </div>
        <br>
        <div class="tomboltambahan">
          <button type="button" name="button" onclick="detailbus()">Detail bus</button>
          <button type="button" name="button" onclick="rutebus()">Rute Bus</button>
          <button type="button" name="button" onclick="lamaperjalanan()">Lama Perjalanan</button>
        </div>
      </div>
    </div>
    <!-- detail bus -->
    <div class="bungkus">
      <div class="detailbus" id="detailbus">
        <div class="textdetailbus">
          <p>Detail Bus</p>
        </div>
        <div class="isidetailbus">
          <p>Kelas Bus : Eksekutif</p>
          <p>Kapasitas Kursi :20 kursi</p>
          <p>Format Kursi :1-1</p>
          <p>Fasilitas :AC, Kursi, WiFi, Toilet, Area Merokok</p>
        </div>
      </div>
    </div>
    <!-- end detail bus -->
    <!-- rute bus -->
    <div class="bungkus">
      <div class="rutebus" id="rutebus">
        <div class="textrutebus">
          <p>Rute Bus</p>
        </div>
        <div class="isirutebus">
          <p>Padang, Palembang, Lampung, Jakarta</p>
        </div>
      </div>
    </div>
    <!-- end rute bus -->
    <!-- lama perjalanan -->
    <div class="bungkus">
      <div class="lamaperjalanan" id="lamaperjalanan">
        <div class="textlamaperjalanan">
          <p>Lama Perjalanan</p>
        </div>
        <div class="isilamaperjalanan">
          <p>1 Hari 8 Jam</p>
        </div>
      </div>
    </div>
    <!-- end rute bus -->
  </div>
  <!-- end list bus -->
  <!-- jenis bus -->
  <div class="jenisbus">

    <div class="listbus">
      <div class="kotakbus">
        <div class="bus">
          <div class="namabus">
            <p>Bus Eksekutif</p>
          </div>
          <div class="kelasbus">
            <p>Eksekutif</p>
          </div>
        </div>
        <div class="isikotakbus">
          <div class="keberangkatan">
            <h3>keberangkatan :</h3>
            <p>12.05</p>
            <p>Terminal Bypass jaya, Kuranji, Kuranji, Padang, Sumatera Barat</p>
          </div>
          <div class="tujuan">
            <h3>Tujuan :</h3>
            <p>15.05</p>
            <p>Terminal Kampung Melayu, Menteng, Setia Budi, Jakarta Selatan, DKI Jakarta</p>
          </div>
          <div class="harga">
            <h2>Rp. 750.000 </h2><p>/kursi</p>
            <button type="button" name="button">Pesan Sekarang</button>
          </div>
        </div>
        <br>
        <div class="tomboltambahan">
          <button type="button" name="button" onclick="detailbus()">Detail bus</button>
          <button type="button" name="button" onclick="rutebus()">Rute Bus</button>
          <button type="button" name="button" onclick="lamaperjalanan()">Lama Perjalanan</button>
        </div>
      </div>
    </div>
    <!-- detail bus -->
    <div class="bungkus">
      <div class="detailbus" id="detailbus">
        <div class="textdetailbus">
          <p>Detail Bus</p>
        </div>
        <div class="isidetailbus">
          <p>Kelas Bus : Eksekutif</p>
          <p>Kapasitas Kursi :20 kursi</p>
          <p>Format Kursi :1-1</p>
          <p>Fasilitas :AC, Kursi, WiFi, Toilet, Area Merokok</p>
        </div>
      </div>
    </div>
    <!-- end detail bus -->
    <!-- rute bus -->
    <div class="bungkus">
      <div class="rutebus" id="rutebus">
        <div class="textrutebus">
          <p>Rute Bus</p>
        </div>
        <div class="isirutebus">
          <p>Padang, Palembang, Lampung, Jakarta</p>
        </div>
      </div>
    </div>
    <!-- end rute bus -->
    <!-- lama perjalanan -->
    <div class="bungkus">
      <div class="lamaperjalanan" id="lamaperjalanan">
        <div class="textlamaperjalanan">
          <p>Lama Perjalanan</p>
        </div>
        <div class="isilamaperjalanan">
          <p>1 Hari 8 Jam</p>
        </div>
      </div>
    </div>
    <!-- end rute bus -->
  </div>
  <!-- end list bus -->
  <!-- footer -->
  <div class="footer">
    <a href="#"><i class="fa-regular fa-copyright"></i> 2022 | GO-BIS</a>
  </div>
</body>

<script type="text/javascript">
function ubahpencarian(){
  var x = document.getElementById("kotak")
  if(x.style.display == "block"){
    x.style.display = "none";
  }else{
    x.style.display = "block";
  }
}
function detailbus(){
  var x = document.getElementById("detailbus")
  var y = document.getElementById("rutebus")
  var z = document.getElementById("lamaperjalanan")
  if(x.style.display == "block"){
    x.style.display = "none";
  }else{
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
  }
}
function rutebus(){
  var x = document.getElementById("rutebus")
  var y = document.getElementById("detailbus")
  var z = document.getElementById("lamaperjalanan")
  if(x.style.display == "block"){
    x.style.display = "none";
  }else{
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
  }
}
function lamaperjalanan(){
  var x = document.getElementById("lamaperjalanan")
  var y = document.getElementById("detailbus")
  var z = document.getElementById("rutebus")
  if(x.style.display == "block"){
    x.style.display = "none";
  }else{
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
  }
}
</script>
</html>
