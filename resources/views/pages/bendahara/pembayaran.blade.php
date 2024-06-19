<x-vertical-layout title="Pembayaran">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    </x-slot>
    <x-slot name="styles">
        <style>
            input[type='button'].year:hover {
                background-color: whitesmoke !important;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <h1>Pembayaran Iuran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row justify-content-center mb-3">
                    <div class="col-10 col-md-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" data-server="{{ route('bendahara.keuangan-masuk.pembayaran') }}"
                                        data-live-server="true" data-value-field="id" data-label-field="name"
                                        placeholder="Cari Santri..."
                                        id="search-santri" data-full-width="true">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="matched-content">
                    @foreach ($santris as $santri)
                        <div class="col-6 col-md-3 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <img class="img-fluid mx-auto d-block img-thumbnail mb-3" width="115"
                                        src="{{ asset("storage/santri/". $santri->picture) }}" alt="Foto Santri">
                                    <div class="d-block mb-3">
                                        <h6 class="text-center">{{ $santri->name }}</h6>
                                        <div class="text-center text-small">{{ $santri->nis }}</div>
                                    </div>
                                    <button class="btn btn-primary btn-block">Detail</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script type="module">
            import Autocomplete from "{{ asset('assets/js/libs/autocomplete/autocomplete.min.js') }}";

            Autocomplete.init("#search-santri", {
                highlightTyped: true,
                preventBrowserAutocomplete: true,
                onSelectItem: fillMatchedContent,
            });
        </script>
        <script>
            function fillMatchedContent(response) {
                $("#matched-content").empty();

                const content = `
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Iuran</h4>
                            </div>
                            <div class="card-body">
                                <div class="col-12 col-sm-12 col-md-12">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="masak-tab" data-toggle="tab" href="#iuran-masak"
                                                role="tab" aria-controls="masak" aria-selected="true">Masak</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="gasminyak-tab" data-toggle="tab" href="#iuran-gasminyak"
                                                role="tab" aria-controls="gasminyak" aria-selected="false">Gas &
                                                Minyak</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="kas-tab" data-toggle="tab" href="#iuran-kas"
                                                role="tab" aria-controls="kas" aria-selected="false">Kas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tabungan-tab" data-toggle="tab" href="#iuran-tabungan"
                                                role="tab" aria-controls="tabungan"
                                                aria-selected="false">Tabungan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="bisaroh-tab" data-toggle="tab" href="#iuran-bisaroh"
                                                role="tab" aria-controls="bisaroh" aria-selected="false">Bisaroh</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="transport-tab" data-toggle="tab" href="#iuran-transport"
                                                role="tab" aria-controls="transport"
                                                aria-selected="false">Transport</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="darurat-tab" data-toggle="tab" href="#iuran-darurat"
                                                role="tab" aria-controls="darurat" aria-selected="false">Darurat</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <button class="btn btn-light float-left" id="previousYear"><i
                                                        class="fas fa-chevron-left"></i></button>
                                            </div>
                                            <div class="col-4">
                                                <input type="button" class="btn btn-block year"
                                                    id="yearpicker"></input>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-light float-right" id="nextYear"><i
                                                        class="fas fa-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="tab-content no-padding" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="iuran-masak" role="tabpanel"
                                        aria-labelledby="masak-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['masak'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Masak</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-gasminyak" role="tabpanel"
                                        aria-labelledby="gasminyak-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['gas_minyak'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Gas & Minyak</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-kas" role="tabpanel" aria-labelledby="kas-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['kas'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Kas</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-tabungan" role="tabpanel" aria-labelledby="tabungan-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['tabungan'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Tabungan</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-bisaroh" role="tabpanel" aria-labelledby="bisaroh-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['bisaroh'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Bisaroh</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-transport" role="tabpanel" aria-labelledby="bisaroh-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['transport'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Transport</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-darurat" role="tabpanel" aria-labelledby="darurat-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center bulan" id="month">{{ $month }} <span class="tahun" id="year"></span></h6>
                                                            <div class="text-center" id="amount">{{ Number::currency($iuran['darurat'], "IDR") }}</div>
                                                            <div class="text-center" id="iuran">Darurat</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Informasi Santri</h4>
                                    </div>
                                    <div class="card-body">
                                        <table cellpadding="3">
                                            <tbody>
                                                <tr>
                                                    <th>NIS</th>
                                                    <td>:</td>
                                                    <td id='nis'></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>:</td>
                                                    <td id='name'></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Detail Pembayaran</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between border-bottom py-3">
                                            <div class="d-block">
                                                <span><strong>Masak</strong></span><br>
                                                <span class="text-small">IDR 120,000.00</span>
                                            </div>
                                            <button class="btn btn-icon btn-danger"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-3">
                                            <div class="d-block">
                                                <span><strong>Masak</strong></span><br>
                                                <span class="text-small">IDR 120,000.00</span>
                                            </div>
                                            <button class="btn btn-icon btn-danger"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="d-block">
                                            <div class="py-3">
                                                <h6>Total Tagihan:</h6>
                                                <h6>Rp.277.000</h6>
                                            </div>

                                            <button class="btn btn-primary btn-block">Konfirmasi Pembayaran</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                $("#matched-content").html(content);

                $("#nis").html(response.nis);
                $("#name").html(response.name);

                $("#yearpicker").val(new Date().getFullYear());
                $(".tahun").text($("#yearpicker").val());

                $("#yearpicker").datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true,
                }).on('changeDate', function(e) {
                    $("#yearpicker").datepicker('hide');

                    $(".tahun").text($("#yearpicker").val());
                });

                $("#previousYear").click(function(e) {
                    e.preventDefault();

                    const currentYear = parseInt($("#yearpicker").val(), 10);

                    if (!isNaN(currentYear)) {
                        $("#yearpicker").datepicker('update', new Date(currentYear - 1, 0, 1));
                        $('#yearpicker').datepicker('hide').trigger('changeDate');
                    }
                });

                $("#nextYear").click(function(e) {
                    e.preventDefault();

                    const currentYear = parseInt($("#yearpicker").val(), 10);

                    if (!isNaN(currentYear)) {
                        $("#yearpicker").datepicker('update', new Date(currentYear + 1, 0, 1));
                        $('#yearpicker').datepicker('hide').trigger('changeDate');
                    }
                });
            }
        </script>
    </x-slot>
</x-vertical-layout>
