<x-horizontal-layout title="Riwayat Pembayaran">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Pembayaran</h1>
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
                                <h4>Riwayat Pembayaran</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="riwayat-iuran-table"
                                        data-url="{{ route('walisantri.pembayaran.riwayat') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Santri</th>
                                                <th>Kode Pembayaran</th>
                                                <th>Total Pembayaran</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Status</th>
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
                function format(d) {
                    let dl = document.createElement('dl');

                    d.forEach(element => {
                        let dt = document.createElement('dt');
                        dt.textContent = 'Iuran:';
                        dl.appendChild(dt);

                        let dd1 = document.createElement('dd');
                        dd1.innerHTML = `
                            ${element.iuran === 'gas_minyak' ? 'Gas & Minyak' : element.iuran.charAt(0).toUpperCase() + element.iuran.slice(1)}
                            (${element.month} ${element.year})
                        `;
                        dl.appendChild(dd1);

                        let dd2 = document.createElement('dd');
                        dd2.textContent = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(element.amount);
                        dl.appendChild(dd2);
                    });

                    return document.body.appendChild(dl);
                }

                const riwyatIuranTable = $("#riwayat-iuran-table").DataTable({
                    ordering: true,
                    serverSide: true,
                    processing: true,
                    autoWidth: true,
                    responsive: true,
                    ajax: {
                        'url': $("#riwayat-iuran-table").data("url"),
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            width: '10px',
                            orderable: false,
                            searchable: false
                        },
                        {
                            className: 'dt-control text-left',
                            data: 'name',
                            name: 'name',
                            render: function(data, type, row) {
                                return `<span data-id="${row.id}">${data}</span>`;
                            },
                            defaultContent: ''
                        },
                        {
                            data: 'payment_code',
                            name: 'payment_code'
                        },
                        {
                            data: 'total_payment',
                            name: 'total_payment'
                        },
                        {
                            data: 'payment_date',
                            name: 'payment_date'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                    ],
                    columnDefs: [

                    ]
                });

                $('#riwayat-iuran-table tbody').on('click', 'td.dt-control.text-left', function(e) {
                    e.preventDefault();
                    const tr = $(this).closest('tr');
                    const row = riwyatIuranTable.row(tr);

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                    } else {
                        // Open this row
                        $.ajax({
                            type: "GET",
                            url: $("#riwayat-iuran-table").data("url"),
                            data: {
                                "pemasukan_id": row.data().id
                            },
                            dataType: "JSON",
                            success: function(response) {
                                row.child(format(response.data)).show();
                            }
                        });
                    }
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>
