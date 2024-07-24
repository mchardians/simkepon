<x-vertical-layout title="Pembayaran">
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
                <h1>Pembayaran Iuran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('bendahara.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Home</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row justify-content-center mb-3">
                    <div class="col-sm-12 col-md-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search-santri"
                                        data-full-width="true" placeholder="Cari Santri...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($santris as $santri)
                        <div class="col-sm-12 col-md-4 col-lg-3" id="santri-container">
                            <div class="card">
                                <div class="card-body">
                                    @if ($santri->picture !== null)
                                        <img class="img-fluid mx-auto d-block img-thumbnail mb-3" width="115"
                                            src="{{ asset('storage/santri/' . $santri->picture) }}" alt="Foto Santri">
                                    @else
                                        <img class="img-fluid mx-auto d-block img-thumbnail mb-3"
                                            src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="150"
                                            alt="Foto Santri">
                                    @endif
                                    <div class="d-block mb-3">
                                        <h6 class="text-center" data-name="{{ $santri->name }}">{{ $santri->name }}</h6>
                                        <div class="text-center text-small" data-nis="{{ $santri->nis }}">{{ $santri->nis }}</div>
                                    </div>
                                    <a class="btn btn-primary btn-block" id="btn-detail" href="{{ route('bendahara.santri.pembayaran.create', $santri->nis) }}">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </x-slot>
    <x-slot name="scripts">
        <script type="module">
            import Autocomplete from "{{ asset('assets/js/libs/autocomplete/autocomplete.min.js') }}";

            Autocomplete.init("#search-santri", {
                liveServer: true,
                server: new URL(location).href,
                serverMethod: "GET",
                queryParam: "santri",
                serverDataKey: "data",
                noCache: false,
                labelField: "name",
                valueField: "nis",
                searchFields: ["name", "nis"],
                fuzzy: true,
                fillIn: true,
                highlightTyped: true,
                highlightClass: "bg-warning",
                preventBrowserAutocomplete: true,
                notFoundMessage: "Data tidak ditemukan",
                onRenderItem: function(item, label) {
                    return label + ' ' + '('+ item.nis +')';
                },
                onSelectItem: function(item) {
                    $("#search-santri").val(`${item.name} (${item.nis})`);

                    window.location.href = "{{ route('bendahara.santri.pembayaran.create', ':nis') }}".replace(':nis', item.nis);
                }
            });

            document.querySelector("#search-santri").addEventListener("keyup", function(e) {
                e.preventDefault();

                const santris = document.querySelectorAll("#santri-container");

                santris.forEach((card) => {
                    const name = card.querySelector('[data-name]').dataset.name.toLowerCase();
                    const nis = card.querySelector('[data-nis]').dataset.nis.toLowerCase();

                    if(name.includes(e.target.value.toLowerCase()) || nis.includes(e.target.value.toLowerCase())) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        </script>
    </x-slot>
</x-vertical-layout>