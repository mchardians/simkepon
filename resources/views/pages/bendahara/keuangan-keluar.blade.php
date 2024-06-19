<x-vertical-layout title="Keuangan Keluar">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/select2/select2.min.css') }}">
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Keuangan Keluar</h4>
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
                                    <table class="table table-striped" id="keuangan-keluar-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Nominal</th>
                                                <th>Sumber</th>
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
                        <h5 class="modal-title">Tambah Keuangan Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-santri" action="{{ route('admin.santri.store') }}">
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
                                    <label for="source">Sumber Iuran</label>
                                    <select class="form-control" id="source" name="source">
                                        <option value=""></option>
                                        <option value="masak">Masak</option>
                                        <option value="gas_minyak">Gas & Minyak</option>
                                        <option value="kas">Kas</option>
                                        <option value="tabungan">Tabungan</option>
                                        <option value="bisaroh">Bisaroh</option>
                                        <option value="transport">Transport</option>
                                        <option value="darurat">Darurat</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-sumber"></span>
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
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/libs/cleave/cleave.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/select2/select2.full.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/keuangan-keluar-datatable.js') }}"></script>

        <script>
            $(document).ready(function() {
                $("#date").daterangepicker({
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

                $("#source").select2({
                    dropdownParent: $('#createModal'),
                    placeholder: "Pilih Sumber Iuran",
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>
