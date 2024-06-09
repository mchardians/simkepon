<x-horizontal-layout title="Laporan">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.css" rel="stylesheet">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Data Wali Santri</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Reports</div>
                    <div class="breadcrumb-item">Wali Santri</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Santri</h4>
                                <div class="card-header-action">
                                    <button class="btn btn-danger" style="height: 35px" id="btn-pdf">
                                        <i class="fas fa-file-pdf mr-1"></i>
                                        PDF
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="walisantri-table"
                                        data-url="{{ route('admin.wali-santri') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>NIK</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Pendidikan</th>
                                                <th>Pekerjaan</th>
                                                <th>Telepon</th>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script
            src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js">
        </script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            const walisantriTable = $('#walisantri-table').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                autoWidth: true,
                responsive: true,
                ajax: {
                    'url': $("#walisantri-table").data("url"),
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '10px',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        width: '100px'
                    },
                    {
                        data: 'education',
                        name: 'education'
                    },
                    {
                        data: 'job',
                        name: 'job'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                ],
                columnDefs: [

                ],
                buttons: [{
                    extend: 'pdf',
                    class: 'buttons-pdf',
                    text: 'PDF',
                    title: 'Laporan Data Wali Santri',
                    filename: 'Laporan Data Wali Santri',
                }]
            });

            $("#btn-pdf").click(function(e) {
                e.preventDefault();
                walisantriTable.button('.buttons-pdf').trigger();
            });
        </script>
    </x-slot>
</x-horizontal-layout>
