<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="{{url('dashboard')}}">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('bus') ? 'active' : ''}}" href="{{url('bus')}}">
            <span data-feather="layers"></span>
            Bus
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('rute') ? 'active' : ''}}" href="{{url('rute')}}">
              <span data-feather="file"></span>
              Rute
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('provinsi') ? 'active' : ''}}" href="{{url('provinsi')}}">
            <span data-feather="file"></span>
            Provinsi
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('kabupaten') ? 'active' : ''}}" href="{{url('kabupaten')}}">
            <span data-feather="layers"></span>
            Kabupaten
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('kecamatan') ? 'active' : ''}}" href="{{url('kecamatan')}}">
              <span data-feather="users"></span>
              Kecamatan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('user/index') ? 'active' : ''}}" href="{{url('user')}}">
              <span data-feather="user"></span>
              User
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('role') ? 'active' : ''}}" href="{{url('role')}}">
              <span data-feather="layers"></span>
              Peran
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('kelurahan') ? 'active' : ''}}" href="{{url('kelurahan')}}">
              <span data-feather="file"></span>
              Kelurahan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('jadwal') ? 'active' : ''}}" href="{{url('booking')}}">
              <span data-feather="file"></span>
              Jadwal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('terminal') ? 'active' : ''}}" href="{{url('terminal')}}">
              <span data-feather="home"></span>
              Terminal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('pesanan') ? 'active' : ''}}" href="{{url('pesanan')}}">
              <span data-feather="home"></span>
              Pesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('tiket') ? 'active' : ''}}" href="{{url('tiket')}}">
              <span data-feather="home"></span>
              Tiket
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('fasilitas') ? 'active' : ''}}" href="{{url('fasilitas')}}">
              <span data-feather="home"></span>
              Fasilitas Bus
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('kelas') ? 'active' : ''}}" href="{{url('kelas')}}">
              <span data-feather="home"></span>
              Kelas Bus
            </a>
        </li>
      </ul>
    </div>
  </nav>
