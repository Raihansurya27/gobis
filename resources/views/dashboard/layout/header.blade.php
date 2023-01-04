<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{url('/home')}}">Go-Bis</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        {{-- @empty(auth()->user()->picture)
        <img src="{{asset('img/noprofile.png')}}" alt="{{auth()->user()->name}}" style="width: 30px; height: 30px;" class="">
        @else
        <img src="{{asset('img/profil/'.auth()->user()->picture)}}" alt="{{auth()->user()->name}}" style="width: 30px; height: 30px;" class="img-fluid">
        @endempty
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-dark">Logout</button>
        </form> --}}
      </div>
    </div>
  </header>
