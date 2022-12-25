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
          <a class="nav-link {{Request::is('bus-dashboard') ? 'active' : ''}}" href="{{url('bus-dashboard')}}">
            <span data-feather="layers"></span>
            Bus
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('rute-dashboard') ? 'active' : ''}}" href="{{url('rute-dashboard')}}">
              <span data-feather="file"></span>
              Rute
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('acara') ? 'active' : ''}}" href="{{url('acara')}}">
            <span data-feather="file"></span>

          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{Request::is('jabatan') ? 'active' : ''}}" href="{{url('jabatan')}}">
            <span data-feather="layers"></span>
            Jabatan
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('karyawan') ? 'active' : ''}}" href="{{url('karyawan')}}">
              <span data-feather="users"></span>
              Karyawan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('user') ? 'active' : ''}}" href="{{url('user')}}">
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
        {{-- <li class="nav-item">
            <a class="nav-link {{Request::is('komentar') ? 'active' : ''}}" href="{{url('komentar')}}">
              <span data-feather="file"></span>
              Komentar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('booking') ? 'active' : ''}}" href="{{url('booking')}}">
              <span data-feather="file"></span>
              Booking
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Request::is('home') ? 'active' : ''}}" href="{{url('home')}}">
              <span data-feather="home"></span>
              Home
            </a>
        </li> --}}
      </ul>
    </div>
  </nav>
