<x-vertical-layout title="Keuangan Masuk">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Data Keuangan Masuk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Keuangan Masuk</h2>
                <p class="section-lead">
                    This page is used to manage your iuran income master data.
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Keuangan Masuk</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="keuangan-masuk-table"
                                        data-url="{{ route('admin.santri') }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Tgl. Bayar</th>
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
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/datatable/dataTables.bootstrap4.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/datatables/keuangan-masuk-datatable.js') }}"></script>
    </x-slot>
</x-vertical-layout>