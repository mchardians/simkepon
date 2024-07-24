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
                                                <th>Santri</th>
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
        <script src="{{ asset('assets/js/libs/moment/moment-with-locales.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            const walisantriTable = $('#walisantri-table').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                ordering: true,
                serverSide: true,
                processing: true,
                autoWidth: true,
                responsive: true,
                ajax: {
                    'url': $("#walisantri-table").data("url"),
                    'data': function(d) {
                        d.mode = "print";
                    }
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
                    {
                        data: 'santri_name',
                        name: 'santri_name',
                    }
                ],
                columnDefs: [

                ],
                buttons: [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize: function(doc) {
                        doc.content.splice(0, 0, {
                            stack: [
                                {
                                    columns: [
                                        {
                                            image: "data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/jantikomantab.png'))) }}",
                                            width: 100
                                        },
                                        {
                                            stack: [
                                                {
                                                    text: 'PONDOK PESANTREN MUROTTILIL QUR-AN',
                                                    alignment: 'center',
                                                    bold: true,
                                                    fontSize: 20,
                                                    margin: [-75, 17, 0, 3],
                                                },
                                                {
                                                    text: '"JANTIKO MANTAB"',
                                                    alignment: 'center',
                                                    bold: true,
                                                    fontSize: 20,
                                                    margin: [-75, 0, 0, 3]
                                                },
                                                {
                                                    text: "64181 Sumbercangkring, Kecamatan Gurah, Kabupaten Kediri, Jawa Timur ",
                                                    alignment: 'center',
                                                    italics: true,
                                                    fontSize: 15,
                                                    margin: [-75, 0, 0, 0]
                                                }
                                            ]
                                        },
                                    ],
                                },
                                {
                                    canvas: [{
                                        type: 'line',
                                        x1: 0,
                                        y1: 0,
                                        x2: 761,
                                        y2: 0,
                                        lineWidth: 2
                                    }],
                                    margin: [0, 15, 0, 0]
                                },
                                {
                                    text: 'LAPORAN DATA WALI SANTRI',
                                    alignment: 'center',
                                    bold: true,
                                    fontSize: 16,
                                    margin: [20, 15, 0, 10]
                                },
                                {
                                    text: 'Tanggal Cetak: ' + moment().locale('id').format("DD MMMM YYYY"),
                                    alignment: 'right',
                                    fontSize: 12,
                                    margin: [0, 0, 0, 10]
                                }
                            ]
                        });

                        doc['footer'] = function(currentPage, pageCount) {
                            return {
                                text: 'Halaman ' + currentPage.toString() + ' dari ' + pageCount,
                                alignment: 'center',
                                margin: [0, 0, 0, 0]
                            }
                        }

                        doc.content[1].table.body[0].forEach(element => {
                            element.color = 'white';
                            element.fillColor = '#08502b';
                        });
                        doc.content[1].table.dontBreakRows = true;
                    },
                    class: 'buttons-pdf',
                    text: 'PDF',
                    title: '',
                    filename: `Laporan Wali Santri ${new Date().getDate() < 10 ? `0${new Date().getDate()}` : new Date().getDate()}-${new Date().getMonth() + 1 < 10 ? `0${new Date().getMonth() + 1}` : new Date().getMonth() + 1}-${new Date().getFullYear()}`,
                }]
            });

            $("#btn-pdf").click(function(e) {
                e.preventDefault();
                walisantriTable.button('.buttons-pdf').trigger();
            });
        </script>
    </x-slot>
</x-horizontal-layout>
