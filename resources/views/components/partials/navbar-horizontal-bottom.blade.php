<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
      <ul class="navbar-nav">
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
        <li class="nav-item dropdown {{ (request()->routeIs('admin.*.laporan') ? 'active' : '') }}">
          <a href="javascript::void(0);" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-print"></i><span>Laporan</span></a>
          <ul class="dropdown-menu">
            <li class="nav-item {{ (request()->routeIs('admin.santri.laporan') ? 'active' : '') }}"><a href="{{ route('admin.santri.laporan') }}" class="nav-link">Laporan Data Santri</a></li>
            <li class="nav-item {{ (request()->routeIs('admin.wali-santri.laporan') ? 'active' : '') }}"><a href="{{ route('admin.wali-santri.laporan') }}" class="nav-link">Laporan Data Wali Santri</a></li>
          </ul>
        </li>
      </ul>
    </div>
</nav>