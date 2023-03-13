{{-- <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Z-Blog</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <form action="/logout" method="post">
          @csrf                               
        <button type="submit" class="nav-link px-3 bg-dark border-0">
            Logout <span data-feather="log-out"></span>
        </button>
      </form>
    </div>
  </div>
</header> --}}


<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand ps-3" href="/dashboard">
    <img src="{{ asset('images/blogging.png') }}" alt="logo" width="30" height="24" 
      class="d-inline-block align-text-top" />
    Blog Dashboard
  </a>
  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" 
    id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

  <!-- Navbar-->
  <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" 
        data-bs-toggle="dropdown" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-white-600 small"> Welcomeback,
            {{ auth()->user()->name }}</span>

          <i class="fas fa-fw fa-user fa-fw"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href=""><i class="fas fa-fw fa-wrench"></i> Settings Account</a></li>
        <li><hr class="dropdown-divider"/></li>
        <li><a class="dropdown-item" href=""><i class="fas fa-fw fa-bookmark"></i> Favorite Posts</a></li>
        <li><hr class="dropdown-divider"/></li>
        {{-- <li><a class="dropdown-item" href=""><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a></li> --}}
        <form action="/logout" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="dropdown-item">
            <i class="fas fa-fw fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </ul>
    </li>
  </ul>
</nav>