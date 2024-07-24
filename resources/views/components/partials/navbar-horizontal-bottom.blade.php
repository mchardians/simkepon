<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
      <ul class="navbar-nav">
        @switch(auth()->user()->role->name)
            @case("admin")
                <li class="nav-item {{ (request()->routeIs('admin.dashboard') ? 'active' : '') }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('admin.santri') ? 'active' : '') }}">
                    <a href="{{ route('admin.santri') }}" class="nav-link"><i class="fas fa-user-graduate"></i><span>Santri</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('admin.wali-santri') ? 'active' : '') }}">
                    <a href="{{ route('admin.wali-santri') }}" class="nav-link"><i class="fas fa-user-tie"></i><span>Wali Santri</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('admin.konfigurasi') ? 'active' : '') }}">
                    <a href="{{ route('admin.konfigurasi') }}" class="nav-link"><i class="fas fa-cogs"></i><span>Konfigurasi</span></a>
                    </li>
                <li class="nav-item dropdown {{ (request()->routeIs('admin.laporan.*') ? 'active' : '') }}">
                    <a href="javascript::void(0);" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-print"></i><span>Laporan</span></a>
                    <ul class="dropdown-menu">
                    <li class="nav-item {{ (request()->routeIs('admin.laporan.santri') ? 'active' : '') }}"><a href="{{ route('admin.laporan.santri') }}" class="nav-link">Laporan Data Santri</a></li>
                    <li class="nav-item {{ (request()->routeIs('admin.laporan.wali-santri') ? 'active' : '') }}"><a href="{{ route('admin.laporan.wali-santri') }}" class="nav-link">Laporan Data Wali Santri</a></li>
                    </ul>
                </li>
                @break
            @case("kepalapondok")
                <li class="nav-item {{ (request()->routeIs('kepalapondok.dashboard') ? 'active' : '') }}">
                    <a href="{{ route('kepalapondok.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('kepalapondok.laporan.keuangan-masuk') ? 'active' : '') }}">
                    <a href="{{ route('kepalapondok.laporan.keuangan-masuk') }}" class="nav-link"><i class="fas fa-file-invoice-dollar"></i><span>Keuangan Masuk</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('kepalapondok.laporan.keuangan-keluar') ? 'active' : '') }}">
                    <a href="{{ route('kepalapondok.laporan.keuangan-keluar') }}" class="nav-link"><i class="fas fa-file-contract"></i><span>Keuangan Keluar</span></a>
                </li>
                @break
            @case("walisantri")
                <li class="nav-item {{ (request()->routeIs('walisantri.dashboard') ? 'active' : '') }}">
                    <a href="{{ route('walisantri.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('walisantri.pembayaran.riwayat') ? 'active' : '') }}">
                    <a href="{{ route('walisantri.pembayaran.riwayat') }}" class="nav-link"><i class="fas fa-history"></i><span>Riwayat Pembayaran</span></a>
                </li>
                <li class="nav-item {{ (request()->routeIs('walisantri.rekapitulasi.santri') ? 'active' : '') }}">
                    <a href="{{ route('walisantri.rekapitulasi.santri') }}" class="nav-link"><i class="fas fa-table"></i><span>Rekapitulasi Iuran</span></a>
                </li>
                @break
            @default
                <li class="nav-item {{ (request()->routeIs('login') ? 'active' : '') }}">
                    <form action="{{ route('logout') }}" method="post" id="form-logout"></form>
                    <a href="javascript:$('#form-logout').submit();" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li>
                @break
        @endswitch
      </ul>
    </div>
</nav>