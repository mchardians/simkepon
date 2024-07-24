<x-vertical-layout title="Keuangan Keluar">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/selectric/selectric.css') }}">
    </x-slot>
    <x-slot name="styles">
        <style>
            select[readonly].select2-hidden-accessible + .select2-container {
                pointer-events: none;
                touch-action: none;
                opacity:0.6;
                cursor:no-drop;
            }

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
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Keuangan Keluar</h2>
                <p class="section-lead">
                    This page is used to manage your iuran income master data.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Keuangan Keluar</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('bendahara.riwayat.mutasi') }}" class="btn btn-icon icon-left btn-warning py-1">
                                        <i class="fas fa-history"></i> Riwayat Transfer
                                    </a>
                                    <button class="btn btn-icon icon-left btn-primary" style="height: 35px;" data-toggle="modal"
                                        data-target="#createModal">
                                        <i class="fas fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="keuangan-keluar-table" data-url="{{ route('bendahara.keuangan-keluar') }}">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="createModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Tambah Keuangan Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-keuangan-keluar" action="{{ route('bendahara.keuangan-keluar.store') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="date">Tanggal</label>
                                    <input type="text" class="form-control" id="date" name="date"
                                        placeholder="Tanggal">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="amount">Nominal (Rupiah)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                IDR
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            placeholder="xxx.xxx.xxx">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="d-block">
                                        <label for="iuran">Sumber Iuran</label>
                                        <div class="float-right">
                                            <span class="text-bold" id="saldo-iuran">
                                                Rp 0
                                            </span>
                                        </div>
                                    </div>

                                    <select class="form-control" id="iuran" name="iuran">
                                        <option value=""></option>
                                        <option value="masak">Masak</option>
                                        <option value="gas_minyak">Gas & Minyak</option>
                                        <option value="kas">Kas</option>
                                        <option value="tabungan">Tabungan</option>
                                        <option value="bisaroh">Bisaroh</option>
                                        <option value="transport">Transport</option>
                                        <option value="darurat">Darurat</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-iuran"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="description">Keterangan</label>
                                    <textarea class="form-control" id="description" name="description" style="height: 65px!important;"></textarea>
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Keuangan Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update-keuangan-keluar" data-url="{{ route('bendahara.keuangan-keluar') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="date-update">Tanggal</label>
                                    <input type="text" class="form-control" id="date-update" name="date"
                                        placeholder="Tanggal">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="amount-update">Nominal (Rupiah)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                IDR
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="amount-update" name="amount"
                                            placeholder="xxx.xxx.xxx">
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="d-block">
                                        <label for="iuran-update">Sumber Iuran</label>
                                        <div class="float-right">
                                            <span class="text-bold" id="saldo-iuran">
                                                Rp 0
                                            </span>
                                        </div>
                                    </div>

                                    <select class="form-control" id="iuran-update" name="iuran">
                                        <option value=""></option>
                                        <option value="masak">Masak</option>
                                        <option value="gas_minyak">Gas & Minyak</option>
                                        <option value="kas">Kas</option>
                                        <option value="tabungan">Tabungan</option>
                                        <option value="bisaroh">Bisaroh</option>
                                        <option value="transport">Transport</option>
                                        <option value="darurat">Darurat</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-iuran-update"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="description-update">Keterangan</label>
                                    <textarea class="form-control" id="description-update" name="description" style="height: 65px!important;"></textarea>
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-update">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="mutasiModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mutasi Arus Keuangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-mutasi">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('bendahara.mutasi.transfer') }}" id="form-mutasi">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="d-block">
                                        <label for="iuran-mutasi">Iuran</label>
                                        <div class="float-right">
                                            <span class="text-small" id="saldo-iuran-mutasi">
                                                Rp 0
                                            </span>
                                        </div>
                                    </div>

                                    <select class="form-control" id="iuran-mutasi" name="iuran">
                                        <option value=""></option>
                                        <option value="masak">Masak</option>
                                        <option value="gas_minyak">Gas & Minyak</option>
                                        <option value="kas">Kas</option>
                                        <option value="tabungan">Tabungan</option>
                                        <option value="bisaroh">Bisaroh</option>
                                        <option value="transport">Transport</option>
                                        <option value="darurat">Darurat</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-iuran"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="d-block">
                                        <label for="source_iuran">Sumber Iuran</label>
                                        <div class="float-right">
                                            <span class="text-small" id="saldo-source-iuran">
                                                Rp 0
                                            </span>
                                        </div>
                                    </div>

                                    <select class="form-control selectric" id="source_iuran" name="source_iuran" data-url="{{ route('bendahara.mutasi') }}">
                                        <option value="" selected>Pilih Sumber Iuran</option>
                                        <option value="kas">Kas</option>
                                        <option value="darurat">Darurat</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert"
                                        id="error-source-iuran"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btn-transfer">Transfer</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/libs/cleave/cleave.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/keuangan-keluar-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/actions/keuangan-keluar-action.js') }}"></script>
        <script>
            $(document).ready(function() {

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

                $("#date, #date-update").daterangepicker({
                    "singleDatePicker": true,
                    "autoApply": true,
                    "showDropdowns": true,
                    "locale": {
                        "format": "DD-MM-YYYY"
                    }
                });

                let cleaveAmount = new Cleave('#amount', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });

                $("#iuran").select2({
                    dropdownParent: $('#createModal'),
                    placeholder: "Pilih Sumber Iuran",
                }).on("change.select2", function (e) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('bendahara.keuangan-keluar') }}",
                        data: {
                            iuran: $(this).val(),
                        },
                        dataType: "JSON",
                        success: function (response) {
                            const IDR = new Intl.NumberFormat('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            });

                            $("#saldo-iuran").text(IDR.format(response.amount));
                            $("#saldo-iuran-mutasi").text(IDR.format(response.amount));
                        }
                    });
                });

                $("#iuran-update").select2({
                    dropdownParent: $('#editModal'),
                    placeholder: "Pilih Sumber Iuran",
                });

                $("#iuran-update").attr("readonly", "readonly");

                $("#iuran-mutasi").select2({
                    dropdownParent: $('#mutasiModal'),
                    placeholder: "Pilih Sumber Iuran",
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>
