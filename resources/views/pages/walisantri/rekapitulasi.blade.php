<x-horizontal-layout title="Rekapitulasi Iuran">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    </x-slot>
    <x-slot name="styles">
        <style>
            input[type='button']#dateFilter:hover {
                background-color: whitesmoke !important;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Rekapitulasi Iuran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Rekapitulasi Iuran</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="rekapitulasi-santri-table" data-url="{{ route('walisantri.rekapitulasi.santri') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Santri</th>
                                                <th>Masak</th>
                                                <th>Gas & Minyak</th>
                                                <th>Kas</th>
                                                <th>Tabungan</th>
                                                <th>Bisaroh</th>
                                                <th>Transport</th>
                                                <th>Darurat</th>
                                                <th>Total Iuran</th>
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
        <script src="{{ asset('assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function () {
                $("#rekapitulasi-santri-table").DataTable({
                    dom: '<"row"<"col-sm-12 col-md-4"l><"#filter.col-sm-12 col-md-4"><"col-sm-12 col-md-4"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    ordering: true,
                    serverSide: true,
                    processing: true,
                    autoWidth: true,
                    responsive: true,
                    ajax: {
                        'url': $("#rekapitulasi-table").data("url"),
                        'data': function(d) {
                            d.date = new URLSearchParams(window.location.search).get('date');
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
                        {data: 'name', name: 'name', orderable: false},
                        {data: 'masak', name: 'masak', orderable: false},
                        {data: 'gas_minyak', name: 'gas_minyak', orderable: false},
                        {data: 'kas', name: 'kas', orderable: false},
                        {data: 'tabungan', name: 'tabungan', orderable: false},
                        {data: 'bisaroh', name: 'bisaroh', orderable: false},
                        {data: 'transport', name: 'transport', orderable: false},
                        {data: 'darurat', name: 'darurat', orderable: false},
                        {data: 'total', name: 'total', orderable: false}
                    ],
                    columnDefs: [

                    ],
                });

                const dateFilter = `
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-light float-left" id="previousMonth">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                        </div>
                        <div class="col-8">
                            <input type="button" class="btn btn-block" id="dateFilter"></input>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-light float-right" id="nextMonth">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                `;

                $("#filter").html(dateFilter);

                $("#dateFilter").datepicker({
                    format: "MM-yyyy",
                    viewMode: "months",
                    minViewMode: "months",
                    autoclose: true,
                }).on('changeDate', function(e) {
                    const url = new URL(location);
                    url.searchParams.set("date", $("#dateFilter").datepicker('getFormattedDate', 'yyyy-mm-dd'));
                    history.pushState({}, "", url);

                    $("#rekapitulasi-santri-table").DataTable().ajax.reload();
                });

                $("#dateFilter").datepicker('setDate', new Date());

                $("#previousMonth").click(function(e) {
                    e.preventDefault();

                    const currentDate = $("#dateFilter").datepicker('getDate');
                    const currentMonth = currentDate.getMonth();
                    const currentYear = currentDate.getFullYear();

                    const newDate = new Date(currentYear, currentMonth - 1, 1);

                    $("#dateFilter").datepicker('update', newDate);
                    $('#dateFilter').datepicker('hide').trigger('changeDate');
                });

                $("#nextMonth").click(function(e) {
                    e.preventDefault();

                    const currentDate = $("#dateFilter").datepicker('getDate');
                    const currentMonth = currentDate.getMonth();
                    const currentYear = currentDate.getFullYear();

                    const newDate = new Date(currentYear, currentMonth + 1, 1);

                    $("#dateFilter").datepicker('update', newDate);
                    $('#dateFilter').datepicker('hide').trigger('changeDate');
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>