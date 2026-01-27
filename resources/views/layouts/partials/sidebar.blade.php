<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>

            {{-- Menu Inventori - Hanya untuk Admin --}}
            @if (Auth::user()->role === 'admin')
                <div class="sb-sidenav-menu-heading">Inventori</div>
                <a class="nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Produk
                </a>
                <a class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}"
                    href="{{ route('supplier.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                    Supplier
                </a>
            @endif

            {{-- Menu Transaksi - Untuk Admin dan User --}}
            <div class="sb-sidenav-menu-heading">Transaksi</div>
            <a class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}"
                href="{{ route('pelanggan.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                Pelanggan
            </a>
            <a class="nav-link {{ request()->routeIs('pembeli.*') ? 'active' : '' }}"
                href="{{ route('pembeli.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                Transaksi Pembelian
            </a>

            {{-- Menu User Management - Hanya untuk Admin --}}
            @if (Auth::user()->role === 'admin')
                <div class="sb-sidenav-menu-heading">Pengaturan</div>
                <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
                    Kelola User
                </a>
            @endif
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{ Auth::user()->name }}
        <span class="badge {{ Auth::user()->role === 'admin' ? 'bg-danger' : 'bg-primary' }} ms-1">
            {{ ucfirst(Auth::user()->role) }}
        </span>
    </div>
</nav>