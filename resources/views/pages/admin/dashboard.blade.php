<x-horizontal-layout title="Dashboard">
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Layout</a></div>
                    <div class="breadcrumb-item">Top Navigation</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="hero bg-primary text-white">
                            <div class="hero-inner">
                                <h2>Welcome Back, {{ Auth::user()->name }}!</h2>
                                <p class="lead">This page is a place to manage posts, categories and more.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Santriwan</h4>
                                </div>
                                <div class="card-body">
                                    10
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Santriwati</h4>
                                </div>
                                <div class="card-body">
                                    42
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Santri</h4>
                                </div>
                                <div class="card-body">
                                    1,201
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Whatsapp State</h4>
                                </div>
                                <div class="card-body">
                                    Connected
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Santri Berdasarkan Jenis Kelamin</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-large-icons">
                                    <div class="card-icon bg-primary text-white">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <div class="card-body">
                                        <h4>General</h4>
                                        <p>General settings such as, site title, site description, address and so on.
                                        </p>
                                        <a href="{{ route('admin.konfigurasi') }}" class="card-cta">Change Setting <i
                                                class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="js">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
        <script src="{{ asset('assets/js/libs/chartjs-labels/chartjs-plugin-labels.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            const ctx = document.getElementById("myChart4").getContext('2d');

            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            50,
                            50,
                        ],
                        backgroundColor: [
                            '#fc544b',
                            '#6777ef',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'Red',
                        'Blue'
                    ],
                },
                options: {
                    responsive: true,
                    maintainAscpectRatio: false,
                    plugins: {
                        labels: {
                            render: 'percentage',
                            fontColor: '#fff',
                            fontStyle: 'bold',
                        }
                    },
                    legend: {
                        position: 'top',
                    },
                }
            });
        </script>
    </x-slot>
</x-horizontal-layout>
