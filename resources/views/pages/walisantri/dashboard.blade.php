<x-horizontal-layout title="Dashboard">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
    </x-slot>
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
                @foreach ($tabungans as $item)
                    <div class="section-title">{{ $item->name }}</div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card card-statistic-1">
                                <div class="card-icon" style="background-color: #ff74bc;">
                                    <i class="fas fa-piggy-bank"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Tabungan</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ Number::currency($item->total_tabungan ?? 0, 'IDR') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Tabungan Bulan Ini</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ Number::currency($item->tabungan_bulan_ini, 'IDR') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-history"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Tabungan Bulan Lalu</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ Number::currency($item->tabungan_bulan_lalu, 'IDR') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Riwayat Tabungan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="riwayat-tabungan-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Santri</th>
                                                <th>Nominal Tabungan</th>
                                                <th>Tempo</th>
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
            $(document).ready(function () {

                $('#riwayat-tabungan-table').DataTable({
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
                    ],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("walisantri.dashboard") }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'name', name: 'name' },
                        { data: 'amount', name: 'amount' },
                        { data: 'tempo', name: 'tempo' },
                    ]
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>