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
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Layout</a></div>
                    <div class="breadcrumb-item">Top Navigation</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Wali Santri</h2>
                <p class="section-lead">
                    We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
                        href="https://datatables.net/">here</a>.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Wali Santri</h4>
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
                </div>
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Wali Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah-wali-santri">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pendidikan-terakhir">Pendidikan Terakhir</label>
                                    <select class="form-control selectric" id="pendidikan-terakhir"
                                        name="pendidikan-terakhir">
                                        <option value="" disabled selected>Pilih Jenjang Pendidikan</option>
                                        <option value="Belum">Tidak /Belum Sekolah</option>
                                        <option value="SD">SD /Sederajat</option>
                                        <option value="SMP">SMP /Sederajat</option>
                                        <option value="SMA">SMA</option>
                                        <option value="Diploma">Diploma I-III</option>
                                        <option value="Sarjana">Diploma IV /Strata I</option>
                                        <option value="Magister">Strata II</option>
                                        <option value="Doktor">Strata III</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pekerjaan">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                        placeholder="Pekerjaan">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" class="form-control phone-number" id="telepon"
                                        name="telepon" placeholder="08XX XXXX XXXXX">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" style="height: 65px!important;"></textarea>
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
        <script src="{{ asset('assets/js/libs/cleave/cleave.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/cleave/addons/cleave-phone.id.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            $(document).ready(function() {
                $("table").on("click", ".btn-edit, .btn-delete, .btn-info", function(e) {
                    e.preventDefault();
                    console.log(this.id);
                });

                const cleaveId = new Cleave('.phone-number', {
                    phone: true,
                    phoneRegionCode: 'id'
                });
            });
        </script>
    </x-slot>
</x-horizontal-layout>
