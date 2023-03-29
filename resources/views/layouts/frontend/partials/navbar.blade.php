<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/blogging.png') }}" alt="logo" width="30" height="24" 
                class="d-inline-block align-text-top" />
            Z-Blogger
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('/')) ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('about')) ? 'active' : '' }}" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('popular')) ? 'active' : '' }}" href="/popular">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (Request::is('categories')) ? 'active' : '' }}" href="/categories">Categories</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome Back, {{ auth()->user()->name }}

                            @if (auth()->user()->image)
                                <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="profile" class="rounded-circle"
                                    style="height: 40px; width: 40px;" />
                            @else
                                <i class="fas fa-fw fa-user fa-fw"></i>
                            @endif
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard"><i class="fa-brands fa-fw fa-slack"></i> My Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-fw fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link {{ (Request::is('login')) ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>