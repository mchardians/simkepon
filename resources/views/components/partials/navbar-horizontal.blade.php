<nav class="navbar navbar-expand-lg main-navbar bg-primary position-fixed">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand sidebar-gone-hide">SIMKEPON</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <div class="nav-collapse">
        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
        </a>
        <ul class="navbar-nav">
            <li class="nav-item active"><a href="#" class="nav-link">Application</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Credits</a></li>
        </ul>
    </div>
    <div class="ml-auto"></div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @switch(auth()->user()->role->name)
                    @case("admin")
                        <a href="features-activities.html" class="dropdown-item has-icon">
                            <i class="fas fa-fire"></i> Dashboard
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Konfigurasi
                        </a>
                        @break
                    @case("kepalapondok")
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-fire"></i> Dashboard
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-file-invoice-dollar"></i> Laporan Pemasukan
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-file-contract"></i> Laporan Pengeluaran
                        </a>
                        @break
                    @case("walisantri")
                        <a href="features-activities.html" class="dropdown-item has-icon">
                            <i class="fas fa-fire"></i> Dashboard
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-history"></i> Riwayat Pembayaran
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-table"></i> Rekapitulasi Iuran
                        </a>
                        @break
                    @default
                        <div class="dropdown-divider"></div>
                        @break
                @endswitch

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
