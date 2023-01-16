{{-- <style>
    .active {
        color: #2470dc;
    }

    .reverse {
        transform: scaleY(-1);
    }
</style> --}}

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item nav-select">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="{{ url('dashboard') }}">
                    <span class="material-symbols-sharp">
                        dashboard
                    </span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-select" id="bus" style="cursor: pointer;" target="_blank"
                    rel="noopener noreferrer" onclick="bukaBus()"><span class="material-symbols-sharp">
                        directions_bus</span> Bus<img id="down-bus"
                        src="{{ asset('img/button/icons8-double-down-48.png') }}" class="button-image"></a>
                <ul class="nav flex-column sub-items" id="sub-items-bus" hidden="true">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('buses') ? 'active' : '' }}" href="{{ url('buses') }}">
                            Bus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('facilities') ? 'active' : '' }}"
                            href="{{ url('facilities') }}">
                            <span data-feather="home"></span>
                            Fasilitas Bus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('class-buses') ? 'active' : '' }}"
                            href="{{ url('class-buses') }}">
                            <span data-feather="home"></span>
                            Kelas Bus
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-select" id="rute" style="cursor: pointer;" target="_blank"
                    rel="noopener noreferrer" onclick="bukaRute()"><span class="material-symbols-sharp">
                        map
                    </span> Rute Perjalanan<img id="down-rute" src="{{ asset('img/button/icons8-double-down-48.png') }}"
                        class="button-image"></a>
                <ul class="nav flex-column sub-items" id="sub-items-rute" hidden="true">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('rute') ? 'active' : '' }}" href="{{ url('rute') }}">
                            <span data-feather="file"></span>
                            Rute
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('terminal') ? 'active' : '' }}"
                            href="{{ url('terminal') }}">
                            Terminal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('provinsi') ? 'active' : '' }}"
                            href="{{ url('provinsi') }}">
                            Provinsi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kabupaten') ? 'active' : '' }}"
                            href="{{ url('kabupaten') }}">
                            Kabupaten
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kecamatan') ? 'active' : '' }}"
                            href="{{ url('kecamatan') }}">
                            <span data-feather="users"></span>
                            Kecamatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('kelurahan') ? 'active' : '' }}"
                            href="{{ url('kelurahan') }}">
                            Kelurahan
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-select">
                <a class="nav-link {{ Request::is('jadwal') ? 'active' : '' }}" href="{{ url('jadwal') }}">
                    <span class="material-symbols-sharp">
                        departure_board
                    </span>
                    Jadwal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-select" id="pesanan" style="cursor: pointer;" target="_blank"
                    rel="noopener noreferrer" onclick="bukaOrder()"><span class="material-symbols-sharp">
                        book_online
                    </span> Pesanan Tiket<img id="down-pesanan"
                        src="{{ asset('img/button/icons8-double-down-48.png') }}" class="button-image"></a>
                <ul class="nav flex-column sub-items" id="sub-items-pesanan" hidden="true">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('pesanan') ? 'active' : '' }}" href="{{ url('pesanan') }}">
                            <span data-feather="home"></span>
                            Pesanan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tiket') ? 'active' : '' }}" href="{{ url('tiket') }}">
                            <span data-feather="home"></span>
                            Tiket
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-select" id="akun" style="cursor: pointer;" target="_blank"
                    rel="noopener noreferrer" onclick="bukaAkun()"><span class="material-symbols-sharp">
                        manage_accounts
                    </span> Pengaturan Akun<img id="down-akun"
                        src="{{ asset('img/button/icons8-double-down-48.png') }}" class="button-image"></a>
                <ul class="nav flex-column sub-items" id="sub-items-akun" hidden="true">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="{{ url('user') }}">
                            Akun
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('role') ? 'active' : '' }}" href="{{ url('role') }}">
                            <span data-feather="layers"></span>
                            Peran
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-select">
                <a class="nav-link {{ Request::is('') ? 'active' : '' }}" href="{{ url('') }}">
                    <span class="material-symbols-outlined">
                        home
                    </span>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-dark" style="margin-left: 20px; margin-top: 10px">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<script type="text/javascript">
    var forRute = 0;
    var forOrder = 0;
    var forAkun = 0;
    var forBus = 0;

    function bukaRute() {
        var rute = document.getElementById('rute');
        var down = document.getElementById('down-rute');
        var sub = document.getElementById('sub-items-rute');
        if (forRute == 0) {
            rute.classList.add('active');
            down.classList.add('reverse');
            sub.hidden = false;
            forRute++;
        } else {
            rute.classList.remove('active');
            down.classList.remove('reverse');
            sub.hidden = true;
            forRute--;
        }
    }

    function bukaOrder() {
        var order = document.getElementById('pesanan');
        var down = document.getElementById('down-pesanan');
        var sub = document.getElementById('sub-items-pesanan');
        if (forOrder == 0) {
            order.classList.add('active');
            down.classList.add('reverse');
            sub.hidden = false;
            forOrder++;
        } else {
            order.classList.remove('active');
            down.classList.remove('reverse');
            sub.hidden = true;
            forOrder--;
        }
    }

    function bukaAkun() {
        var akun = document.getElementById('akun');
        var down = document.getElementById('down-akun');
        var sub = document.getElementById('sub-items-akun');
        if (forAkun == 0) {
            akun.classList.add('active');
            down.classList.add('reverse');
            sub.hidden = false;
            forAkun++;
        } else {
            akun.classList.remove('active');
            down.classList.remove('reverse');
            sub.hidden = true;
            forAkun--;
        }
    }

    function bukaBus() {
        var bus = document.getElementById('bus');
        var down = document.getElementById('down-bus');
        var sub = document.getElementById('sub-items-bus');
        if (forBus == 0) {
            bus.classList.add('active');
            down.classList.add('reverse');
            sub.hidden = false;
            forBus++;
        } else {
            bus.classList.remove('active');
            down.classList.remove('reverse');
            sub.hidden = true;
            forBus--;
        }
    }
</script>
