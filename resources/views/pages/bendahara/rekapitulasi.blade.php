<x-vertical-layout title="Rekapitulasi">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/datatable/dataTables.bootstrap4.min.css') }}">
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Rekapitulasi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Rekapitulasi Iuran</h2>
                <p class="section-lead">
                    This page is used to monitoring your iuran.
                </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Rekapitulasi Iuran Santri</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="rekapitulasi-table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Santri</th>
                                                <th>Masak</th>
                                                <th>Gas&Minyak</th>
                                                <th>Kas</th>
                                                <th>Tabungan</th>
                                                <th>Bisaroh</th>
                                                <th>Transport</th>
                                                <th>Darurat</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mochammad Ardiansyah</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 200.000</td>
                                                <td>Rp. 1.600.000</td>
                                            </tr>
                                        </tbody>
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
        <script src="{{ asset('assets/js/datatables/rekapitulasi-iuran-datatable.js') }}"></script>
    </x-slot>
</x-vertical-layout>