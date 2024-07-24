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
                                    {{ Number::currency($saldos[0]['amount'], 'IDR') }}
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
                                    {{ Number::currency($saldos[1]['amount'], 'IDR') }}
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
                                    {{ Number::currency($saldos[2]['amount'], 'IDR') }}
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
                                    {{ Number::currency($saldos[3]['amount'], 'IDR') }}
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
                                    {{ Number::currency($saldos[4]['amount'], 'IDR') }}
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
                                    {{ Number::currency($saldos[5]['amount'], 'IDR') }}
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
                                    {{ Number::currency($saldos[6]['amount'], 'IDR') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                <h4>Persentase Pelunasan Iuran Santri (Bulan Ini)</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-block">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-success">{{ $santriLunas }} Santri</div>
                                    </div>
                                    <div class="media-title font-weight-bold">Lunas</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-success" data-width="{{ $lunas }}%"></div>
                                            <div class="budget-price-label">{{ $lunas }}%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block">
                                    <div class="float-right">
                                        <div class="font-weight-600 text-danger">{{ $santriBelumLunas }} Santri</div>
                                    </div>
                                    <div class="media-title font-weight-bold">Belum Lunas</div>
                                    <div class="mt-1">
                                        <div class="budget-price">
                                            <div class="budget-price-square bg-danger"
                                                data-width="{{ $belumLunas }}%"></div>
                                            <div class="budget-price-label">{{ $belumLunas }}%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer pt-3 d-flex justify-content-center">
                                <div class="budget-price justify-content-center">
                                    <div class="budget-price-square bg-success" data-width="40"></div>
                                    <div class="budget-price-label">Lunas</div>
                                </div>
                                <div class="budget-price justify-content-center">
                                    <div class="budget-price-square bg-danger" data-width="40"></div>
                                    <div class="budget-price-label">Belum Lunas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Santri Belum Lunas Iuran (Bulan Ini)</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="santri-menunggak-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Total Tanggungan</th>
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
                    let dt = document.createElement('dt');
                    dt.textContent = 'Tanggungan Iuran:';
                    dl.appendChild(dt);

                    d.forEach((element, index) => {

                        let dd1 = document.createElement('dd');
                        dd1.innerHTML = `
                            ${index + 1}. ${element.iuran === 'gas_minyak' ? 'Gas & Minyak' : element.iuran.charAt(0).toUpperCase() + element.iuran.slice(1)}
                            (${new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            }).format(element.nominal)})
                        `;
                        dl.appendChild(dd1);
                    });

                    return document.body.appendChild(dl);
                }

                const santriMenunggakTable = $('#santri-menunggak-table').DataTable({
                    lengthMenu: [
                        [5, 10, 25, 50, 100],
                        [5, 10, 25, 50, 100]
                    ],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('bendahara.dashboard') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            className: 'dt-control text-left',
                            data: 'nis',
                            name: 'nis',
                            render: function(data, type, row) {
                                return `<span data-id="${row.id}">${data}</span>`;
                            },
                            defaultContent: ''
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        }
                    ]
                });

                $('#santri-menunggak-table tbody').on('click', 'td.dt-control.text-left', function(e) {
                    e.preventDefault();
                    const tr = $(this).closest('tr');
                    const row = santriMenunggakTable.row(tr);

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                    } else {
                        // Open this row
                        $.ajax({
                            type: "GET",
                            url: $("#santri-menunggak-table").data("url"),
                            data: {
                                "santri_id": row.data().id
                            },
                            dataType: "JSON",
                            success: function(response) {
                                row.child(format(response.iurans)).show();
                            }
                        });
                    }
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>
