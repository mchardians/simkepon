<x-vertical-layout title="Pembayaran">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    </x-slot>
    <x-slot name="styles">
        <style>
            input[type='button'].year:hover {
                background-color: whitesmoke !important;
            }

            .btn-circle {
                width: 30px;
                height: 30px;
                padding: 6px 0px;
                border-radius: 15px;
                text-align: center;
                font-size: 12px;
                line-height: 1.42857;
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('bendahara.santri.pembayaran') }}" class="btn btn-icon">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <h1>Pembayaran Iuran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
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
                    <div class="col-sm-12 col-md-6 col-lg-6">
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
                                                <div class="col-sm-12 col-md-6 col-lg-4" id="iuran-container">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['masak'] }}">{{ Number::currency($iuran['masak'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="masak">Masak</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
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
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['gas_minyak'] }}">{{ Number::currency($iuran['gas_minyak'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="gas_minyak">Gas & Minyak</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-kas" role="tabpanel" aria-labelledby="kas-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['kas'] }}">{{ Number::currency($iuran['kas'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="kas">Kas</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-tabungan" role="tabpanel" aria-labelledby="tabungan-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['tabungan'] }}">{{ Number::currency($iuran['tabungan'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="tabungan">Tabungan</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-bisaroh" role="tabpanel" aria-labelledby="bisaroh-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['bisaroh'] }}">{{ Number::currency($iuran['bisaroh'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="bisaroh">Bisaroh</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-transport" role="tabpanel" aria-labelledby="transport-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['transport'] }}">{{ Number::currency($iuran['transport'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="transport">Transport</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="iuran-darurat" role="tabpanel" aria-labelledby="darurat-tab">
                                        <div class="row">
                                            @foreach ($months as $month)
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="text-center" data-month="{{ $month }}">{{ $month }} <span class="year"></span></h6>
                                                            <div class="text-center" data-amount="{{ $iuran['darurat'] }}">{{ Number::currency($iuran['darurat'], 'IDR') }}</div>
                                                            <div class="text-center" data-iuran="darurat">Darurat</div>
                                                        </div>
                                                        <div class="card-footer border-top p-2">
                                                            <button class="btn btn-primary btn-block btn-pay" data-index="{{ $loop->index }}">Bayar</button>
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
                    <div class="col-sm-12 col-md-3 col-lg-3">
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
                                                    <td><span data-nis="{{ $santris->nis }}">{{ $santris->nis }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>:</td>
                                                    <td>{{ $santris->name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Rincian Pembayaran</h4>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%" id="iuran-table">
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="text-right" colspan="2">Total Tagihan</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" id="total" colspan="2">{{ Number::currency(0, 'IDR') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><button class="btn btn-primary btn-block" id="btn-confirm">Konfirmasi Pembayaran</button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script src="{{ asset('assets/js/actions/pembayaran-action.js') }}"></script>
    </x-slot>
</x-vertical-layout>