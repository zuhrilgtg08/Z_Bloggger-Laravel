<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Main</div>
            <a class="nav-link {{ isset($sbActive) && $sbActive === 'admin.dashboard' ? 'active' : '' }}" 
                href="/dashboard"><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Master Menu</div>
            <a class="nav-link {{ isset($sbMaster) && $sbMaster === true ? '' : 'collapsed'}}" href="#" data-bs-toggle="collapse" 
                data-bs-target="#collapseLayouts" aria-expanded="{{ isset($sbMaster) && $sbMaster === true ? 'true' : 'false'}}"
                aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-columns"></i></div>
                Master Data
                <div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-angle-down"></i></div>
            </a>
            <div class="collapse {{ isset($sbMaster) && $sbMaster === true ? 'show' : '' }}" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link {{ isset($sbActive) && $sbActive === 'master.posts' ? 'active' : '' }}" 
                        href="{{ route('dashboard.posts.index') }}"><div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div> Data Posts</a>
                    @can('admin')
                    <a class="nav-link {{ isset($sbActive) && $sbActive === 'master.categories' ? 'active' : '' }}" 
                        href="{{ route('dashboard.categories.index') }}"><div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div> Data Categories</a>
                    @endcan
                </nav>
            </div>
        </div>
    </div>
</nav>