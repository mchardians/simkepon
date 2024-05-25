<x-horizontal-layout title="Santri">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/selectric/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/select2/select2.min.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Santri</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Layout</a></div>
                    <div class="breadcrumb-item">Top Navigation</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Santri</h2>
                <p class="section-lead">
                    We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
                        href="https://datatables.net/">here</a>.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Santri</h4>
                                <div class="card-header-action">
                                    <button class="btn btn-primary" style="height: 35px" data-toggle="modal"
                                        data-target="#modal-tambah-santri">
                                        <i class="fas fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{ $dataTable->table(['class' => 'table table-striped']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="modal-tambah-santri">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah-santri">
                            <div class="form-row">
                                <div class="col-lg-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nis">Nomor Induk Santri</label>
                                            <input type="text" class="form-control" id="nis" name="nis" placeholder="NIS">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="jenis-kelamin">Jenis Kelamin</label>
                                            <select class="form-control selectric" id="jenis-kelamin" name="jenis-kelamin">
                                                <option value="" disabled selected>Jenis Kelamin</option>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="tgl-lahir">Tanggal Lahir</label>
                                            <input type="text" class="form-control" id="tgl-lahir" name="tgl-lahir">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="wali-santri">Wali Santri</label>
                                            <select class="form-control" id="wali-santri" name="wali-santri">
                                                <option value=""></option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group col-md-12">
                                        <label>Foto</label>
                                        <div id="image-preview" class="image-preview w-100">
                                            <label id="image-label" for="image-upload">Choose File</label>
                                            <input type="file" id="image-upload" name="foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group col-md-12">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" style="height: 65px!important;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/libs/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/uploadPreview/jquery.uploadPreview.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            $(document).ready(function() {
                $("table").on("click", ".btn-edit, .btn-delete, .btn-info", function(e) {
                    e.preventDefault();
                    console.log(this.id);
                });

                $("#tgl-lahir").daterangepicker({
                    "singleDatePicker": true,
                    "autoApply": true,
                    "showDropdowns": true,
                    "locale": {
                        "format": "DD/MM/YYYY"
                    }
                });

                $("#wali-santri").select2({
                    dropdownParent: $("#modal-tambah-santri"),
                    placeholder: "Pilih Wali Santri",
                });

                $.uploadPreview({
                    input_field: "#image-upload", // Default: .image-upload
                    preview_box: "#image-preview", // Default: .image-preview
                    label_field: "#image-label", // Default: .image-label
                    label_default: "Choose File", // Default: Choose File
                    label_selected: "Change File", // Default: Change File
                    no_label: false, // Default: false
                    success_callback: null // Default: null
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>
