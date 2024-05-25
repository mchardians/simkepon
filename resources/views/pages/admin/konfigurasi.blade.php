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
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Layout</a></div>
                    <div class="breadcrumb-item">Top Navigation</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Konfigurasi</h2>
                <p class="section-lead">
                    We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
                        href="https://datatables.net/">here</a>.
                </p>

                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data User (Wali Santri)</h4>
                                <div class="card-header-action">
                                    <button class="btn btn-primary" style="height: 35px" data-toggle="modal"
                                        data-target="#exampleModal">
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
                                                <h5>Status: <span class="text-success">Connected</span></h5>
                                            </div>
                                            <div class="text-center mt-3">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/43/WhatsApp_click-to-chat_QR_code.png/902px-WhatsApp_click-to-chat_QR_code.png?20200811163128"
                                                    alt="QR Code" class="img-fluid" width="250px">
                                            </div>
                                            <div class="text-center mt-3">
                                                <h6>Panduan:</h6>
                                            </div>
                                            <ul class="border border-secondary" style="border-style: dashed !important;">
                                                <li>Buka Whatsapp <i class="fas fa-chevron-right"></i> Tautkan Perangkat</li>
                                                <li>Scan QR Code di atas</li>
                                                <li>Sistem terhubung dengan WhatsApp</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-whitesmoke br">
                                        <div class="text-center">
                                            <button class="btn btn-success mr-1">Start Server</button>
                                            <button class="btn btn-danger">Logout</button>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modal-tambah-user">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama User</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama User">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jenis-kelamin">Role</label>
                                    <select class="form-control selectric" id="role" name="role">
                                        <option value="walisantri" disabled selected>Wali Santri</option>
                                    </select>
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
    </x-slot>
    <x-slot name="scripts">
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            $("table").on("click", ".btn-edit, .btn-delete, .btn-info", function(e) {
                e.preventDefault();
                console.log(this.id);
            });
        </script>
    </x-slot>
</x-horizontal-layout>
