<nav class="navbar navbar-expand-lg main-navbar position-fixed bg-primary">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="javascript:void(0)" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="javascript:void(0)" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->check())
                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('bendahara.dashboard') }}" class="dropdown-item has-icon">
                    <i class="fas fa-fire"></i> Dashboard
                </a>
                {{-- <a href="{{ route('bendahara.cicilan.pembayaran') }}" class="dropdown-item has-icon">
                    <i class="fas fa-coins"></i> Cicilan
                </a> --}}
                <a href="{{ route('bendahara.iuran.rekapitulasi') }}" class="dropdown-item has-icon">
                    <i class="fas fa-table"></i> Rekapitulasi
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post" id="form-logout">
                    @csrf
                    <a href="javascript:$('#form-logout').submit();" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
