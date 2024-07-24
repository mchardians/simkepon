<x-vertical-layout title="Keuangan Masuk">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/selectric/selectric.css') }}">
    </x-slot>
    <x-slot name="styles">
        <style>
            #daterange-filter:hover {
                background-color: whitesmoke !important;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Data Keuangan Masuk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Keuangan Masuk</h2>
                <p class="section-lead">
                    This page is used to manage your iuran income master data.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Keuangan Masuk</h4>
                                <div class="card-header-action">
                                    <select class="form-control selectric" id="filter-status">
                                        <option value="">All Status</option>
                                        <option value="lunas">Lunas</option>
                                        <option value="belum_lunas">Belum Lunas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="keuangan-masuk-table"
                                        data-url="{{ route('bendahara.keuangan-masuk') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Santri</th>
                                                <th>Kode Pembayaran</th>
                                                <th>Total Pembayaran</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="infoModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Detail Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped" id="detail-pemasukan-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">No.</th>
                                    <th scope="col">Tempo</th>
                                    <th scope="col">Iuran</th>
                                    <th scope="col">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/libs/selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/keuangan-masuk-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/actions/keuangan-masuk-action.js') }}"></script>
        <script>
            $(document).ready(function () {
                const paymentDateFilter = `
                    <div id="daterange-filter" class="py-2 px-3" style="background: #fff; cursor: pointer; border: 1px groove #e4e6fc;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                `;

                $("#filter").html(paymentDateFilter);

                const start = moment().subtract(29, 'days');
                const end = moment();

                function cb(start, end) {
                    $('#daterange-filter span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                    const startDate = $("#daterange-filter").data("daterangepicker").startDate.format("YYYY-MM-DD");
                    const endDate = $("#daterange-filter").data("daterangepicker").endDate.format("YYYY-MM-DD");

                    const url = new URL(location);
                    url.searchParams.set("start_date", startDate);
                    url.searchParams.set("end_date", endDate);
                    history.pushState({}, "", url);

                    $("#keuangan-masuk-table").DataTable().ajax.reload();
                }

                $('#daterange-filter').daterangepicker({
                    "showDropdowns": true,
                    "startDate": start,
                    "endDate": end,
                }, cb);

                cb(start, end);

                $("#filter-status").change(function (e) {
                    e.preventDefault();

                    const url = new URL(location);
                    url.searchParams.set("status", $(this).val());
                    history.pushState({}, "", url);

                    $("#keuangan-masuk-table").DataTable().ajax.reload();
                });

                $(".applyBtn").click(function (e) {
                    e.preventDefault();

                    const startDate = $("#daterange-filter").data("daterangepicker").startDate.format("YYYY-MM-DD");
                    const endDate = $("#daterange-filter").data("daterangepicker").endDate.format("YYYY-MM-DD");

                    const url = new URL(location);
                    url.searchParams.set("start_date", startDate);
                    url.searchParams.set("end_date", endDate);
                    history.pushState({}, "", url);

                    $("#keuangan-masuk-table").DataTable().ajax.reload();
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>