<x-horizontal-layout title="Wali Santri">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/selectric/selectric.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Wali Santri</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Wali Santri</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Wali Santri</h2>
                <p class="section-lead">
                    This page is used to manage your wali santri master data.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Wali Santri</h4>
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
                                    <table class="table table-striped" id="walisantri-table" data-url="{{ route('admin.wali-santri') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>NIK</th>
                                                <th>Name</th>
                                                <th>Pekerjaan</th>
                                                <th>Telepon</th>
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
                        <h5 class="modal-title text-primary">Tambah Wali Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-walisantri" action="{{ route('admin.wali-santri.store') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Nomor Induk Kependudukan">
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
                                    <label for="education">Pendidikan Terakhir</label>
                                    <select class="form-control selectric" id="education"
                                        name="education">
                                        <option value="" selected>Pilih Jenjang Pendidikan</option>
                                        <option value="belum sekolah">Tidak /Belum Sekolah</option>
                                        <option value="sd">SD /Sederajat</option>
                                        <option value="smp">SMP /Sederajat</option>
                                        <option value="sma">SMA /Sederajat</option>
                                        <option value="diploma">Diploma I-III</option>
                                        <option value="sarjana">Diploma IV /Strata I</option>
                                        <option value="magister">Strata II</option>
                                        <option value="doktor">Strata III</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-education"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="job">Pekerjaan</label>
                                    <input type="text" class="form-control" id="job" name="job"
                                        placeholder="Pekerjaan">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="d-block">
                                        <label for="phone" class="control-label">Telepon</label>
                                        <div class="float-right">
                                            <span class="text-danger text-small">(*) Phone number must be registered in Whatsapp</span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="phone"
                                        name="phone" placeholder="08XX XXXX XXXXX">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="d-block">
                                        <label for="address" class="control-label">Alamat</label>
                                        <span class="text-danger text-small">* Nama Jalan, Kecamatan, Kelurahan, Kota/Kabupaten</span>
                                    </div>
                                    <textarea class="form-control" id="address" name="address" style="height: 65px!important;"></textarea>
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Update Wali Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update-walisantri" data-url="{{ route('admin.wali-santri') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nik-update">NIK</label>
                                    <input type="text" class="form-control" id="nik-update" name="nik"
                                        placeholder="Nomor Induk Kependudukan">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name-update">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name-update" name="name"
                                        placeholder="Nama Lengkap">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="education-update">Pendidikan Terakhir</label>
                                    <select class="form-control selectric" id="education-update"
                                        name="education">
                                        <option value="" selected>Pilih Jenjang Pendidikan</option>
                                        <option value="belum sekolah">Tidak /Belum Sekolah</option>
                                        <option value="sd">SD /Sederajat</option>
                                        <option value="smp">SMP /Sederajat</option>
                                        <option value="sma">SMA /Sederajat</option>
                                        <option value="diploma">Diploma I-III</option>
                                        <option value="sarjana">Diploma IV /Strata I</option>
                                        <option value="magister">Strata II</option>
                                        <option value="doktor">Strata III</option>
                                    </select>
                                    <span class="invalid-feedback" role="alert" id="error-education-update"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="job-update">Pekerjaan</label>
                                    <input type="text" class="form-control" id="job-update" name="job"
                                        placeholder="Pekerjaan">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email-update">Email</label>
                                    <input type="text" class="form-control" id="email-update" name="email"
                                        placeholder="Email">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="d-block">
                                        <label for="phone-update" class="control-label">Telepon</label>
                                        <div class="float-right">
                                            <span class="text-danger text-small">(*) Phone number must be registered in Whatsapp</span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="phone-update"
                                        name="phone" placeholder="08XX XXXX XXXXX">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="address-update">Alamat</label>
                                    <textarea class="form-control" id="address-update" name="address" style="height: 65px!important;"></textarea>
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-update">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="infoModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Detail Wali Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table cellpadding="5" id="info-table">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/selectric/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/cleave/cleave.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/cleave/addons/cleave-phone.id.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/walisantri-datatable.js') }}"></script>
        <script>
            const phoneInput = new Cleave('#phone', {
                phone: true,
                phoneRegionCode: 'ID'
            });
        </script>
        <script src="{{ asset('assets/js/actions/walisantri-action.js') }}"></script>
    </x-slot>
</x-horizontal-layout>
