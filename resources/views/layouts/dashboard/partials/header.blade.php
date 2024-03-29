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

            @if (auth()->user()->image)
              <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="profile" class="rounded-circle"
                style="height: 40px; width: 40px;"/>
            @else
              <i class="fas fa-fw fa-user fa-fw"></i>
            @endif
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="/"><i class="fas fa-fw fa-home"></i> Home</a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="{{ route('dashboard.account.setting', auth()->user()->id) }}"><i class="fas fa-fw fa-wrench"></i> Settings Account</a></li>
        <li><hr class="dropdown-divider"/></li>
        <li>
          <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-fw fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure to Logout on the Dashboard page ?
      </div>
      <form action="/logout" method="POST">
        @csrf
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
          <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</button>
        </div>
      </form>
    </div>
  </div>
</div>