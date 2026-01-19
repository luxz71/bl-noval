<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Menu</div>
            <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                Produk
            </a>
            <a class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}"
                href="{{ route('supplier.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                Supplier
            </a>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        Administrator
    </div>
</nav>