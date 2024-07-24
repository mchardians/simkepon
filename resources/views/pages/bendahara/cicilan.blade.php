<x-vertical-layout title="Cicilan">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Pembayaran Cicilan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Pembayaran Cicilan Santri</h2>
                <p class="section-lead">
                    This page is used to manage your iuran income master data.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Cicilan Santri</h4>
                                <div class="card-header-action">
                                    <button class="btn btn-primary" style="height: 35px" data-toggle="modal"
                                        data-target="#createModal">
                                        <i class="fas fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="cicilan-table" data-url="{{ route('bendahara.cicilan.pembayaran') }}">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Santri</th>
                                                <th>Nominal</th>
                                                <th>Iuran</th>
                                                <th>Tempo</th>
                                                <th>Tanggal Bayar</th>
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
                        <h5 class="modal-title text-primary">Tambah Cicilan Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-cicilan" action="{{ route('bendahara.cicilan.pembayaran.store') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="santri_id">Santri</label>
                                    <select class="form-control" id="santri_id"
                                        name="santri_id" data-url="{{ route('bendahara.cicilan.pembayaran.create') }}">
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-santri_id"></span>
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
                                <div class="form-group col-md-6">
                                    <label for="tempo">Tempo</label>
                                    <input type="text" class="form-control" id="tempo" name="tempo" placeholder="MM-YYYY">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="d-block">
                                        <label for="iuran">Iuran</label>
                                        <div class="float-right">
                                            <span class="text-bold" id="saldo-iuran">
                                                Rp 0
                                            </span>
                                        </div>
                                    </div>
                                    <select class="form-control" id="iuran" name="iuran">
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
                        <h5 class="modal-title text-primary">Update Cicilan Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update-cicilan">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="santri_id-update">Santri</label>
                                    <select class="form-control" id="santri_id-update" name="santri_id">
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-santri_id"></span>
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
                                <div class="form-group col-md-6">
                                    <label for="tempo-update">Tempo</label>
                                    <input type="text" class="form-control" id="tempo-update" name="tempo" placeholder="MM-YYYY">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="d-block">
                                        <label for="iuran-update">Iuran</label>
                                        <div class="float-right">
                                            <span class="text-bold" id="saldo-iuran-update">
                                                Rp 0
                                            </span>
                                        </div>
                                    </div>
                                    <select class="form-control" id="iuran-update" name="iuran">
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-iuran"></span>
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
                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/cleave/cleave.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/cicilan-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/actions/cicilan-action.js') }}"></script>
        <script>
            $(document).ready(function () {
                let cleaveAmount = new Cleave('#amount', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand'
                });

                $("#tempo").datepicker( {
                    format: "mm-yyyy",
                    startView: "months",
                    minViewMode: "months",
                    orientation: "bottom",
                }).on("changeDate hide", function(e) {
                    const dateValue = e.date;
                    const formattedDate = dateValue.toLocaleDateString("en-US", {
                        year: "numeric",
                        month: "long",
                    });

                    $(this).val(formattedDate);
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>