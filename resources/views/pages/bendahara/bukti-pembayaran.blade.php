<x-vertical-layout title="Bukti Pembayaran">
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/css/libs/printjs/print.min.css') }}">
    </x-slot>
    <x-slot name="styles">
        <style>
            body h1 {
                font-weight: 300;
                margin-bottom: 0px;
                padding-bottom: 0px;
                color: #000;
            }

            body h3 {
                font-weight: 300;
                margin-top: 10px;
                margin-bottom: 20px;
                font-style: italic;
                color: #555;
            }

            body a {
                color: #06f;
            }

            .invoice-box {
                max-width: 100%;
                margin: auto;
                padding: 30px;
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
                border-collapse: collapse;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(3) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(3) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media print {
                .invoice-box {
                    max-width: unset;
                    box-shadow: none;
                    border: 0px;
                    overflow: visible;
                }
            }

            @media only screen and (max-width: 600px) {
                .invoice-box {
                    overflow: auto;
                }

                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('bendahara.keuangan-masuk') }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Bukti Pembayaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('bendahara.keuangan-masuk') }}">Keuangan Masuk</a>
                    </div>
                    <div class="breadcrumb-item">Bukti Pembayaran</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-box" id="invoice">
                                    <table>
                                        <tr class="top">
                                            <td colspan="3">
                                                <table>
                                                    <tr>
                                                        <td class="title">
                                                            <img src="{{ asset('assets/img/ppmq-jantiko-mantab.svg') }}" alt="Company logo"
                                                                style="width: 100%; max-width: 400px" />
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <b>Invoice #: {{ $pemasukan->payment_code }}</b><br />
                                                            Payment Date: {{ \Carbon\Carbon::parse($pemasukan->payment_date)->format('F d, Y H:i:s') }}<br />
                                                            Created: {{ $pemasukan->created_at->format('F d, Y') }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="information">
                                            <td colspan="3">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Pondok Pesantren<br /> Murottilil Qur-an Jantiko Mantab.<br />
                                                            64181 Sumbercangkring, Kec. Gurah,<br />
                                                            Kabupaten Kediri, Jawa Timur
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            {{ $pemasukan->wali_name }}<br />
                                                            {{ $pemasukan->wali_email }}<br />
                                                            {{ $jalan. ", ".$kecamatan }}<br />
                                                            {{ $kota_kabupaten }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="heading">
                                            <td>Informasi Santri</td>
                                            <td></td>
                                            <td>Identitas</td>
                                        </tr>

                                        <tr class="item">
                                            <td>NIS</td>
                                            <td></td>
                                            <td>{{ $pemasukan->nis }}</td>
                                        </tr>

                                        <tr class="item">
                                            <td>Nama</td>
                                            <td></td>
                                            <td>{{ $pemasukan->name }}</td>
                                        </tr>

                                        <tr class="item last">
                                            <td>Wali Santri</td>
                                            <td></td>
                                            <td>{{ $pemasukan->wali_name }}</td>
                                        </tr>

                                        <tr class="heading">
                                            <td>Status Pembayaran</td>
                                            <td></td>
                                            <td>Total Bayar</td>
                                        </tr>

                                        <tr class="details">
                                            <td>{{ $pemasukan->status === 'lunas' ? 'Lunas' : 'Belum Lunas' }}</td>
                                            <td></td>
                                            <td>{{ Number::currency($pemasukan->total_payment, 'IDR') }}</td>
                                        </tr>

                                        <tr class="heading">
                                            <td>Iuran</td>
                                            <td class="text-center">Tempo</td>
                                            <td>Biaya Iuran</td>
                                        </tr>

                                        @foreach ($detail_pemasukan as $item)

                                            @if ($loop->index === $loop->count - 1)
                                                <tr class="item last">
                                                    @if ($item->iuran === 'gas_minyak')
                                                        <td>Gas & Minyak</td>
                                                        <td class="text-center">{{ $item->month ." ". $item->year }}</td>
                                                        <td>{{ Number::currency($item->amount, 'IDR') }}</td>
                                                    @else
                                                        <td>{{ ucfirst($item->iuran) }}</td>
                                                        <td class="text-center">{{ $item->month ." ". $item->year }}</td>
                                                        <td>{{ Number::currency($item->amount, 'IDR') }}</td>
                                                    @endif
                                                </tr>
                                            @else
                                                <tr class="item">
                                                    @if ($item->iuran === 'gas_minyak')
                                                        <td>Gas & Minyak</td>
                                                        <td class="text-center">{{ $item->month ." ". $item->year }}</td>
                                                    @else
                                                        <td>{{ ucfirst($item->iuran) }}</td>
                                                        <td class="text-center">{{ $item->month ." ". $item->year }}</td>
                                                    @endif

                                                    <td>{{ Number::currency($item->amount, 'IDR') }}</td>
                                                </tr>
                                            @endif

                                        @endforeach

                                        <tr class="total">
                                            <td></td>
                                            <td></td>
                                            <td>Total: {{ Number::currency($pemasukan->total_payment, 'IDR') }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="text-md-right">
                                    <div class="float-lg-left mb-lg-0">
                                        <button class="btn btn-success btn-icon icon-left" data-toggle="modal" data-target="#sendModal">
                                            <i class="fab fa-whatsapp"></i> Send to Whatsapp
                                        </button>
                                        <a class="btn btn-danger btn-icon icon-left" href="{{ route('bendahara.keuangan-masuk') }}">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <div class="d-md-inline-block d-lg-none">
                                            <button class="btn btn-warning btn-icon icon-left" id="btn-print">
                                                <i class="fas fa-print"></i> Print
                                            </button>
                                        </div>
                                    </div>
                                    <button class="btn btn-warning btn-icon icon-left d-md-none d-lg-inline-block" id="btn-print">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="sendModal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Konfirmasi Pengiriman Whatsapp</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bendahara.keuangan-masuk.invoice.send') }}" method="POST" id="send-whatsapp-form" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Nama Wali Santri</label>
                                <input type="text" class="form-control" id="name"
                                    name="name" value="{{ $pemasukan->wali_name }}" placeholder="Wali Santri Name" disabled>
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="phone">Nomor Telepon (Whatsapp)</label>
                                <input type="text" class="form-control" id="phone"
                                    name="phone" value="{{ $pemasukan->wali_phone }}" placeholder="Phone Number" readonly>
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="d-block">
                                    <label for="media">Media</label>
                                    <div class="float-right">
                                        <span class="text-danger text-small">(*) Only accept .pdf</span>
                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="media" id="media">
                                    <label class="custom-file-label" for="media">Choose file</label>
                                    <span class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-icon icon-left btn-success" id="btn-send">
                        <i class="fas fa-paper-plane"></i> Send
                    </button>
                </div>
              </div>
            </div>
        </div>
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('assets/js/libs/printjs/print.min.js') }}"></script>
        <script src="{{ asset('assets/js/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function () {
                $(document).on("click", "#btn-print", function (e) {
                    e.preventDefault();

                    printJS({
                        printable: 'invoice',
                        type: 'html',
                        targetStyles: ['*'],
                        documentTitle: 'Bukti Pembayaran - ' + '{{ $pemasukan->nis }}',
                    });
                });

                $("#send-whatsapp-form").submit(function (e) {
                    e.preventDefault();

                    const data = new FormData(this);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ route('bendahara.keuangan-masuk.invoice.send') }}",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            const result = JSON.parse(response.message);
                            if(result.status === 200 && result.data.success === true) {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Bukti pembayaran berhasil dikirim!",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    icon: "success"
                                }).then(function(result) {
                                    if(result.isConfirmed) {
                                        $("#send-whatsapp-form")[0].reset();
                                    }
                                });
                            }
                        },
                        error: function (xhr) {
                            $("#media").addClass('is-invalid').next().next().text(xhr.responseJSON.message);
                        }
                    });
                });

                $("#btn-send").click(function (e) {
                    e.preventDefault();

                    $("#send-whatsapp-form").submit();
                });

                document.querySelector('.custom-file-input').addEventListener('change',function(e){
                    const fileName = document.getElementById("media").files[0].name;
                    const nextSibling = e.target.nextElementSibling
                    nextSibling.innerText = fileName
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>