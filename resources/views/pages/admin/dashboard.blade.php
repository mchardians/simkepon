<x-horizontal-layout title="Dashboard">
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
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
                                    {{ $santriwan }}
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
                                    {{ $santriwati }}
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
                                    {{ $totalSantri }}
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
                                <div class="card-body" id="whatsapp-state"></div>
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
                                        <h4>Konfigurasi</h4>
                                        <p>Redirect to the configuration page to manage user master data and whatsapp
                                            configurations.
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
        <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            const socket = io('http://localhost:3000');

            switch (localStorage.getItem('state')) {
                case "UNPAIRED_IDLE":
                    $("#whatsapp-state").html("Unpaired");
                    break;
                case "PAIRED":
                    $("#whatsapp-state").html("Paired");
                    break;
                default:
                    $("#whatsapp-state").html("Pending");
            }

            socket.on('change_state', function(state) {

                $("#whatsapp-state").html(state);

                localStorage.setItem('state', state);
            });
        </script>
        <script>
            const ctx = document.getElementById("myChart4").getContext('2d');

            Chart.plugins.register({
                afterDraw: function(chart) {
                    if (JSON.stringify(chart.data.datasets[0].data) === JSON.stringify([0, 0])) {
                        chart.options.tooltips.enabled = false;

                        const ctx = chart.ctx;
                        const width = chart.width;
                        const height = chart.height;
                        chart.clear();

                        ctx.save();
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.font = "16px normal 'Sans-Serif'";
                        ctx.fillText('No data to display', width / 2, height / 2);
                        ctx.restore();
                    }
                }
            });

            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [
                            {{ $santriwan }},
                            {{ $santriwati }},
                        ],
                        backgroundColor: [
                            '#6777ef',
                            '#fc544b',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'Laki-Laki',
                        'Perempuan'
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
