<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('bendahara.dashboard') }}">SIMKEPON</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('bendahara.dashboard') }}">SKP</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->routeIs('bendahara.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bendahara.dashboard') }}">
                <i class="fas fa-fire"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-header">Debit Asset</li>
        <li class="nav-item dropdown {{ request()->routeIs('bendahara.keuangan-masuk.*') || request()->routeIs('bendahara.keuangan-masuk') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-hand-holding-usd"></i>
                <span>Keuangan Masuk</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('bendahara.keuangan-masuk.pembayaran') ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara.keuangan-masuk.pembayaran') }}">Pembayaran Iuran</a></li>
                <li class="{{ request()->routeIs('bendahara.keuangan-masuk') ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara.keuangan-masuk') }}">Data Keuangan Masuk</a></li>
                <li class="{{ request()->routeIs('bendahara.keuangan-masuk.riwayat') ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara.keuangan-masuk.riwayat') }}">Riwayat Pembayaran</a></li>
            </ul>
        </li>
        <li class="menu-header">Kredit Asset</li>
        <li class="{{ request()->routeIs('bendahara.keuangan-keluar') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bendahara.keuangan-keluar') }}">
                <i class="fas fa-cart-arrow-down"></i> <span>Keuangan Keluar</span>
            </a>
        </li>
        <li class="menu-header">Cicilan</li>
        <li class="{{ request()->routeIs('bendahara.cicilan.pembayaran') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bendahara.cicilan.pembayaran') }}">
                <i class="fas fa-coins"></i> <span>Bayar Cicilan</span>
            </a>
        </li>
        <li class="menu-header">Rekapitulasi</li>
        <li class="{{ request()->routeIs('bendahara.iuran.rekapitulasi') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bendahara.iuran.rekapitulasi') }}">
                <i class="fas fa-table"></i> <span>Rekapitulasi Iuran</span>
            </a>
        </li>
        <li class="menu-header">Laporan</li>
        <li class="nav-item dropdown {{ request()->routeIs('bendahara.laporan.*') ? 'active' : '' }}">
            <a href="javascript:void(0)" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-export"></i>
                <span>Laporan Keuangan</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('bendahara.laporan.keuangan-masuk') ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara.laporan.keuangan-masuk') }}">Laporan Keuangan Masuk</a></li>
                <li class="{{ request()->routeIs('bendahara.laporan.keuangan-keluar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('bendahara.laporan.keuangan-keluar') }}">Laporan Keuangan Keluar</a></li>
            </ul>
        </li>
    </ul>
</aside>
