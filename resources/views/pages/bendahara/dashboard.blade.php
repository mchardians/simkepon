<x-vertical-layout title="Dashboard">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon" style="background-color: #686D76;">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Masak</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-burn" style="color: black;"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Gas & Minyak</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Kas</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon" style="background-color: #ff74bc;">
                                <i class="fas fa-piggy-bank"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Tabungan</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Bisaroh</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-bus"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Transport</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Iuran Darurat</h4>
                                </div>
                                <div class="card-body">
                                    Rp. 277.000
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="card">
                          <div class="card-header">
                            <h4>Persentase Pelunasan Iuran Santri</h4>
                          </div>
                          <div class="card-body">
                            <div class="d-block">
                                <h6>Lunas</h6>
                                <div class="progress mb-3" data-height="10" data-toggle="tooltip" title="25 Santri">
                                  <div class="progress-bar bg-success" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>
                            </div>
                            <div class="d-block">
                                <h6>Belum Lunas</h6>
                                <div class="progress mb-3" data-height="10" data-toggle="tooltip" title="75 Santri">
                                    <div class="progress-bar bg-danger" role="progressbar" data-width="75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                </div>
                            </div>
                          </div>
                          <div class="card-footer">
                            <div class="row">
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="col-4">
                                          <div class="progress" data-height="5">
                                            <div class="progress-bar bg-success" role="progressbar" data-width="100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </div>
                                        <span class="percent">
                                          <span class="text-small">Lunas</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="col-4">
                                          <div class="progress" data-height="5">
                                            <div class="progress-bar bg-danger" role="progressbar" data-width="100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        </div>
                                        <span class="percent">
                                          <span class="text-small">Belum Lunas</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="card">
                          <div class="card-header">
                            <h4>Daftar Santri Menunggak Iuran</h4>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="santri-menunggak-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Santri</th>
                                            <th>Iuran</th>
                                            <th>Bulan</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('#santri-menunggak-table').DataTable({
                    // processing: true,
                    // serverSide: true,
                    // ajax: "#",
                    // columns: [
                    //     { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    //     { data: 'name', name: 'name' },
                    //     { data: 'iuran', name: 'iuran' },
                    //     { data: 'jatuh_tempo', name: 'jatuh_tempo' },
                    //     { data: 'nominal', name: 'nominal' },
                    //     { data: 'status', name: 'status' },
                    // ]
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>