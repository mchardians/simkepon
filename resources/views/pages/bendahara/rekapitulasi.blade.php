<x-vertical-layout title="Rekapitulasi">
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
                <h1>Rekapitulasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Rekapitulasi Iuran</h2>
                <p class="section-lead">
                    This page is used to monitoring your iuran.
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Rekapitulasi Iuran Santri</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="rekapitulasi-table"
                                        data-url="{{ route('bendahara.iuran.rekapitulasi') }}">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Santri</th>
                                                <th>Masak</th>
                                                <th>Gas&Minyak</th>
                                                <th>Kas</th>
                                                <th>Tabungan</th>
                                                <th>Bisaroh</th>
                                                <th>Transport</th>
                                                <th>Darurat</th>
                                                <th>Total Iuran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" colspan="2">Jumlah Total</th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </tfoot>
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
        <script src="{{ asset('assets/js/datatables/rekapitulasi-iuran-datatable.js') }}"></script>
        <script>
            $(document).ready(function() {
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

                    $("#rekapitulasi-table").DataTable().ajax.reload();
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
</x-vertical-layout>
