<x-horizontal-layout title="Laporan">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/daterangepicker/daterangepicker.css') }}">
        <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.css" rel="stylesheet">
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
                <h1>Keuangan Keluar</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Keuangan Keluar</h4>
                                <div class="card-header-action">
                                    <button class="btn btn-icon icon-left btn-danger" id="btn-pdf" style="height: 35px;">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </button>
                                    <button class="btn btn-icon icon-left btn-success" id="btn-excel" style="height: 35px;">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="keuangan-keluar-table" data-url="{{ route('kepalapondok.laporan.keuangan-keluar') }}">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Nominal</th>
                                                <th>Sumber Iuran</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center" colspan="2">Total Pengeluaran</th>
                                                <th class="text-left" colspan="4"></th>
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
        <script src="{{ asset('assets/js/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script
            src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.0.8/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js">
        </script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function () {
                const keuanganKeluarTable = $("#keuangan-keluar-table").DataTable({
                    dom: '<"row justify-content-between"<"col-md-auto mr-auto"l><"#filter.col-md-auto m-auto"><"col-md-auto ml-auto"f>><"row justify-content-md-center"<"col-12"rt>><"row justify-content-between"<"col-md-auto mr-auto"i><"col-md-auto ml-auto"p>>',
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
                        'url': $("#keuangan-keluar-table").data("url"),
                        'data': function(d) {
                            d.startDate = new URLSearchParams(window.location.search).get('start_date');
                            d.endDate = new URLSearchParams(window.location.search).get('end_date');
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
                        {data: 'date', name: 'date'},
                        {data: 'amount', name: 'amount'},
                        {data: 'iuran', name: 'iuran'},
                        {data: 'description', name: 'description'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    columnDefs: [

                    ],
                    footerCallback: function (row, data, start, end, display) {
                        let api = this.api();

                        let intVal = function(i) {
                            if(typeof i === "string") {
                                let match = i.match(/[\d,]+(?:\.\d+)?/);

                                if(match) {
                                    return parseFloat(match[0].replace(/,/g, ''));
                                }
                            }else if(typeof i === "number") {
                                return i;
                            }

                            return 0;
                        };

                        const totalPengeluaran = api.column(2).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                        const pageTotalPengeluaran = api.column(2, {page: 'current'}).data().reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                        api.column(2).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalPengeluaran);
                    },
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            orientation: 'portrait',
                            pageSize: 'A4',
                            customize: function(doc) {
                                doc.content.splice(0, 0, {
                                    stack: [
                                        {
                                            columns: [
                                                {
                                                    image: "data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/img/jantikomantab.png'))) }}",
                                                    width: 75
                                                },
                                                {
                                                    stack: [
                                                        {
                                                            text: 'PONDOK PESANTREN MUROTTILIL QUR-AN',
                                                            alignment: 'center',
                                                            bold: true,
                                                            fontSize: 15,
                                                            margin: [-50, 17, 0, 3],
                                                        },
                                                        {
                                                            text: '"JANTIKO MANTAB"',
                                                            alignment: 'center',
                                                            bold: true,
                                                            fontSize: 15,
                                                            margin: [-50, 0, 0, 3]
                                                        },
                                                        {
                                                            text: "64181 Sumbercangkring, Kecamatan Gurah, Kabupaten Kediri, Jawa Timur ",
                                                            alignment: 'center',
                                                            italics: true,
                                                            fontSize: 10,
                                                            margin: [-50, 0, 0, 0]
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
                                            text: 'LAPORAN DATA KEUANGAN KELUAR',
                                            alignment: 'center',
                                            bold: true,
                                            fontSize: 15,
                                            margin: [30, 15, 0, 10]
                                        },
                                        {
                                            text: 'Tanggal Cetak: ' + moment().locale('id').format("DD MMMM YYYY"),
                                            alignment: 'right',
                                            fontSize: 10,
                                            margin: [0, 0, 0, 10]
                                        }
                                    ]
                                });

                                doc['footer'] = function(currentPage, pageCount) {
                                    if(currentPage === pageCount) {
                                        return {
                                            columns: [
                                                {
                                                    stack: [
                                                        {
                                                            text: 'Halaman ' + currentPage.toString() + ' dari ' + pageCount,
                                                            alignment: 'center'
                                                        }
                                                    ],
                                                    margin: [0, 0, 0, 0]
                                                }
                                            ]
                                        };
                                    } else {
                                        return {
                                            text: 'Halaman ' + currentPage.toString() + ' dari ' + pageCount,
                                            alignment: 'center',
                                            margin: [0, 0, 0, 0]
                                        };
                                    }
                                }

                                doc.defaultStyle.fontSize = 12;
                                doc.styles = {
                                    footerStyle: {
                                        alignment: 'left'
                                    }
                                }

                                doc.content[1].table.body[0].forEach(element => {
                                    element.color = 'white';
                                    element.fillColor = '#08502b';
                                });

                                doc.content[1].table.widths = ['auto', '*', '*', '*', 'auto'];
                                doc.content[1].table.dontBreakRows = true;
                            },
                            class: 'buttons-pdf',
                            text: 'PDF',
                            title: '',
                            filename: 'Laporan Data Keuangan Keluar',
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4]
                            },
                            class: 'buttons-excel',
                            text: 'Excel',
                            title: 'Laporan Data Keuangan Keluar',
                            filename: 'Laporan Data Keuangan Keluar',
                        }
                    ],
                });

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

                    $("#keuangan-keluar-table").DataTable().ajax.reload();
                }

                $('#daterange-filter').daterangepicker({
                    "showDropdowns": true,
                    "startDate": start,
                    "endDate": end,
                }, cb);

                cb(start, end);

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

                $("#btn-pdf").click(function(e) {
                    e.preventDefault();
                    keuanganKeluarTable.button('.buttons-pdf').trigger();
                });

                $("#btn-excel").click(function (e) {
                    e.preventDefault();
                    keuanganKeluarTable.button('.buttons-excel').trigger();
                });

                $("table").on("click", ".btn-delete", function (e) {
                    e.preventDefault();

                    id = this.id;

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            const url = "{{ route('kepalapondok.keuangan-keluar.destroy', ':id') }}"

                            $.ajax({
                                type: "DELETE",
                                url: url.replace(':id', this.id),
                                dataType: "JSON",
                                success: function (response) {
                                    Swal.fire({
                                        title: "Success!",
                                        text: response.message,
                                        allowOutsideClick: false,
                                        allowEscapeKey: false,
                                        icon: "success"
                                    }).then((result) => {
                                        if(result.isConfirmed) {
                                            $("#keuangan-keluar-table").DataTable().ajax.reload();
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>