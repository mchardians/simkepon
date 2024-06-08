<x-horizontal-layout title="Santri">
    <x-slot name="content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.santri') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Santri</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.santri') }}">Santri</a></div>
                    <div class="breadcrumb-item">Details</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Santri</h4>
                            </div>
                            <div class="card-body">
                                <table cellpadding="5">
                                    <tbody>
                                        <tr>
                                            <th>NIS</th>
                                            <td>:</td>
                                            <td>{{ $details->nis }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $details->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>:</td>
                                            <td>{{ $details->gender === "laki-laki"? "Laki-Laki" : "Perempuan" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Lahir</th>
                                            <td>:</td>
                                            <td>{{ ucwords($details->birth_place) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>:</td>
                                            <td>{{ date("j F Y", strtotime($details->birth_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>:</td>
                                            <td>{{ $details->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    @if ($details->picture)
                                        <img src="{{ asset("storage/santri/".$details->picture) }}" alt="Foto Santri" width="170" style="border: 2px groove gray">
                                    @else
                                        <img src="{{ asset('assets/img/avatar/avatar-3.png') }}" alt="Foto Santri" class="rounded" width="170" style="border: 1px groove gray">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Wali Santri</h4>
                            </div>
                            <div class="card-body">
                                <table cellpadding="5">
                                    <tbody>
                                        <tr>
                                            <th>NIK</th>
                                            <td>:</td>
                                            <td>{{ $details->walisantri->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $details->walisantri->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td>{{ $details->walisantri->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telepon</th>
                                            <td>:</td>
                                            <td>{{ $details->walisantri->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pendidikan</th>
                                            <td>:</td>
                                            @switch($details->walisantri->education)
                                                @case("sd")
                                                    <td>SD/ Sederajat</td>
                                                    @break
                                                @case("smp")
                                                    <td>SMP/ Sederajat</td>
                                                    @break
                                                @case("sma")
                                                    <td>SMA/ Sederajat</td>
                                                    @break
                                                @case("diploma")
                                                    <td>Diploma I-III</td>
                                                    @break
                                                @case("sarjana")
                                                    <td>Diploma IV/ Strata I</td>
                                                    @break
                                                @case("magister")
                                                    <td>Strata II</td>
                                                    @break
                                                @case("doktor")
                                                    <td>Strata III</td>
                                                    @break
                                                @default
                                                    <td>{{ ucwords($details->walisantri->education) }}</td>
                                                    @break
                                            @endswitch
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>:</td>
                                            <td>{{ $details->walisantri->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
</x-horizontal-layout>