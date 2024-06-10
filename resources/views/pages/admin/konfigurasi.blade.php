<x-horizontal-layout title="Konfigurasi">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/selectric/selectric.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Konfigurasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Konfigurasi</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Konfigurasi</h2>
                <p class="section-lead">
                    This page is used to manage your user master data and whatsapp configurations.
                </p>

                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data User (Wali Santri)</h4>
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
                                    <table class="table table-striped" id="user-table" data-url="{{ route('admin.konfigurasi.users') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h4>Whatsapp Gateway</h4>
                                        <div class="card-header-action">
                                            <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary"
                                                href="#"><i class="fas fa-minus"></i></a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="mycard-collapse">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h5 id="state">Status:</h5>
                                            </div>
                                            <div class="text-center mt-3">
                                                <img alt="QR Code" class="img-fluid m-auto" width="250px" id="loaders">
                                                    <div id="qrCode"></div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <h6 class="text-info">Panduan:</h6>
                                            </div>
                                            <ul class="border border-secondary" style="border-style: dashed !important;">
                                                <li>Klik Start Server</li>
                                                <li>Buka Whatsapp <i class="fas fa-chevron-right"></i> Tautkan Perangkat</li>
                                                <li>Scan QR Code di atas</li>
                                                <li>Sistem terhubung dengan WhatsApp</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-whitesmoke br">
                                        <div class="text-center">
                                            <button class="btn btn-success mr-1" id="btn-start" value="start">Start Server</button>
                                            <button class="btn btn-danger" id="btn-logout">Logout</button>
                                        </div>
                                    </div>
                                </div>
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
                        <h5 class="modal-title">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-create-user" action="{{ route('admin.konfigurasi.users.store') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama User</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nama User">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="role">Role</label>
                                    <select class="form-control selectric" id="role" name="role_id">
                                        <option value="3" selected>Wali Santri</option>
                                    </select>
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
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-update-user" data-url="{{ route('admin.konfigurasi.users') }}">
                            <div class="form-group">
                                <label for="name-update">Nama User</label>
                                <input type="text" class="form-control" id="name-update" name="name"
                                    placeholder="Nama User">
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                            <div class="form-group">
                                <label for="email-update">Email</label>
                                <input type="email" class="form-control" id="email-update" name="email"
                                    placeholder="Email">
                                <span class="invalid-feedback" role="alert"></span>
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
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
        <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
        <script src="{{ asset('assets/js/libs/qrcodeJS/qrcode.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/user-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/actions/user-action.js') }}"></script>
        <script>
            const unpaired = "{{ asset('assets/loaders/loading.svg') }}";
            const paired = "{{ asset('assets/loaders/connected.png') }}";
        </script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </x-slot>
</x-horizontal-layout>
