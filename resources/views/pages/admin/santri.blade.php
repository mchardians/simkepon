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
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Santri</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Santri</h2>
                <p class="section-lead">
                    This page is used to manage your santri master data.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Santri</h4>
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
                                    <table class="table table-striped" id="santri-table"
                                        data-url="{{ route('admin.santri') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th class="text-center">Action</th>
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
                        <h5 class="modal-title">Tambah Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-santri" action="{{ route('admin.santri.store') }}"
                            enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-lg-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nis">Nomor Induk Santri</label>
                                            <input type="text" class="form-control" id="nis" name="nis"
                                                placeholder="NIS">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Nama Lengkap">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select class="form-control selectric" id="gender" name="gender">
                                                <option value="" selected>Jenis Kelamin</option>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert" id="error-gender"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="birth_place">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="birth_place"
                                                name="birth_place">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="birth_date">Tanggal Lahir</label>
                                            <input type="text" class="form-control birth-day" id="birth_date"
                                                name="birth_date">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="wali_santri_id">Wali Santri</label>
                                            <select class="form-control" id="wali_santri_id" name="wali_santri_id"
                                                data-url="{{ route('admin.santri.create') }}">
                                            </select>
                                            <span class="invalid-feedback" role="alert"
                                                id="error-wali_santri_id"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group col-md-12">
                                        <div class="d-block">
                                            <label class="control-label">Foto</label>
                                            <div class="float-right">
                                                <p class="text-danger text-small">* Accept .jpg, .jpeg, .png (3 x 4)
                                                </p>
                                            </div>
                                        </div>
                                        <div id="image-preview" class="image-preview w-100">
                                            <label id="image-label" for="picture">Choose File</label>
                                            <input type="file" id="picture" name="picture">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group col-md-12">
                                        <label for="address">Alamat</label>
                                        <textarea class="form-control" id="address" name="address" style="height: 65px!important;"></textarea>
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
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
                        <h5 class="modal-title">Update Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update-santri" data-url="{{ route('admin.santri') }}"
                            enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="col-lg-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nis-update">Nomor Induk Santri</label>
                                            <input type="text" class="form-control" id="nis-update"
                                                name="nis" placeholder="NIS">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name-update">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name-update"
                                                name="name" placeholder="Nama Lengkap">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="gender-update">Jenis Kelamin</label>
                                            <select class="form-control selectric" id="gender-update" name="gender">
                                                <option value="" selected>Jenis Kelamin</option>
                                                <option value="laki-laki">Laki-Laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                            <span class="invalid-feedback" role="alert"
                                                id="error-gender-update"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="birth_place-update">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="birth_place-update"
                                                name="birth_place">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="birth_date-update">Tanggal Lahir</label>
                                            <input type="text" class="form-control birth-day"
                                                id="birth_date-update" name="birth_date">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label for="wali_santri_id-update">Wali Santri</label>
                                            <select class="form-control" id="wali_santri_id-update"
                                                name="wali_santri_id" data-url="{{ route('admin.santri.create') }}">
                                            </select>
                                            <span class="invalid-feedback" role="alert"
                                                id="error-wali_santri_id-update"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group col-md-12">
                                        <div class="d-block">
                                            <label class="control-label">Foto</label>
                                            <div class="float-right">
                                                <p class="text-danger text-small">* Accept .jpg, .jpeg, .png (3 x 4)
                                                </p>
                                            </div>
                                        </div>
                                        <div id="image-preview-update" class="image-preview w-100">
                                            <label id="image-label-update" for="picture-update">Choose File</label>
                                            <input type="file" id="picture-update" name="picture">
                                            <span class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-lg-12">
                                    <div class="form-group col-md-12">
                                        <label for="address-update">Alamat</label>
                                        <textarea class="form-control" id="address-update" name="address" style="height: 65px!important;"></textarea>
                                        <span class="invalid-feedback" role="alert"></span>
                                    </div>
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
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/libs/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/uploadPreview/jquery.uploadPreview.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/santri-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/actions/santri-action.js') }}"></script>
        <script>
            $(document).ready(function() {
                const genderFilter = `
                    <ul class="nav nav-pills" id="filterWrapper">
                        <li class="nav-item">
                            <a class="nav-link filter" data-filter="">All <span class="badge">{{ $totalSantri }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link filter" data-filter="laki-laki">Laki-Laki <span class="badge">{{ $totalSantriwan }}</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link filter" data-filter="perempuan">Perempuan <span class="badge">{{ $totalSantriwati }}</span></a>
                        </li>
                    </ul>
                `;

                $("#filter").html(genderFilter);

                $(".filter").css("cursor", "pointer");

                if(new URLSearchParams(location.search).toString()) {
                    const activeFilter = getActiveFilter();

                    if(activeFilter) {
                        $(".filter").removeClass("active").children().removeClass("badge-white").addClass("badge-primary");
                        $(`.filter[data-filter="${activeFilter}"]`).addClass("active").children().addClass("badge-white");
                    }else {
                        $(".filter").removeClass("active").children().removeClass("badge-white").addClass("badge-primary");
                        $(".filter:first").addClass("active").children().addClass("badge-white");
                    }
                }else {
                    $(".filter").removeClass("active").children().removeClass("badge-white").addClass("badge-primary");
                    $(".filter:first").addClass("active").children().addClass("badge-white");
                }

                function setActiveFilter(filter) {
                    localStorage.setItem("active", filter);
                }

                function getActiveFilter() {
                    return localStorage.getItem("active");
                }

                $(".filter").click(function (e) {
                    e.preventDefault();

                    const url = new URL(location);
                    url.searchParams.set("gender", $(this).data("filter"));
                    history.pushState({}, "", url);

                    switch(url.searchParams.get("gender")) {
                        case "laki-laki":
                            $(".filter").removeClass("active").children().removeClass("badge-white").addClass("badge-primary");
                            $(this).addClass("active").children().addClass("badge-white");
                            break;
                        case "perempuan":
                            $(".filter").removeClass("active").children().removeClass("badge-white").addClass("badge-primary");
                            $(this).addClass("active").children().addClass("badge-white");
                            break;
                        default:
                            $(".filter").removeClass("active").children().removeClass("badge-white").addClass("badge-primary");
                            $(".filter:first").addClass("active").children().addClass("badge-white");
                    }

                    setActiveFilter($(this).data("filter"));

                    $("#santri-table").DataTable().ajax.reload();
                });

                document.querySelectorAll('.birth-day').forEach(item => {
                    $(item).daterangepicker({
                        "singleDatePicker": true,
                        "autoApply": true,
                        "showDropdowns": true,
                        "locale": {
                            "format": "DD-MM-YYYY"
                        }
                    });
                });

                $("#wali_santri_id").select2({
                    dropdownParent: $("#createModal"),
                    placeholder: "Pilih Wali Santri",
                });

                $("#wali_santri_id-update").select2({
                    dropdownParent: $("#editModal"),
                    placeholder: "Pilih Wali Santri",
                });

                $.uploadPreview({
                    input_field: "#picture", // Default: .image-upload
                    preview_box: "#image-preview", // Default: .image-preview
                    label_field: "#image-label", // Default: .image-label
                    label_default: "Choose File", // Default: Choose File
                    label_selected: "Change File", // Default: Change File
                    no_label: false, // Default: false
                    success_callback: null // Default: null
                });

                $.uploadPreview({
                    input_field: "#picture-update", // Default: .image-upload
                    preview_box: "#image-preview-update", // Default: .image-preview
                    label_field: "#image-label-update", // Default: .image-label
                    label_default: "Choose File", // Default: Choose File
                    label_selected: "Change File", // Default: Change File
                    no_label: false, // Default: false
                    success_callback: null // Default: null
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>
