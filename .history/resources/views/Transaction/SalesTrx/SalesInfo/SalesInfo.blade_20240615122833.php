@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary">Daftar Keuntungan</h1>
        <h3 class="text text-dark fw-bolder">Berikut hasil penjualan kamu sesuai dengan periode yang dipilih</h3>
        <div id="infoview" class="" style="margin-top: 60px;">
            <form action="{{ route('SalesInfoFiltered') }}" method="GET">
                <div class="my-1">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="period-start" class="form-label text text-dark fw-bolder">Periode Transaksi</label>
                            <div class="d-flex">
                                <input type="month" class="form-control me-2" id="periodStart" name="periodStart"
                                    value="{{ isset($periodStart) ? $periodStart : $datetime }}"
                                    onchange="this.form.submit()">
                                <input type="month" class="form-control" id="periodEnd" name="periodEnd"
                                    value="{{ isset($periodEnd) ? $periodEnd : $datetime }}" onchange="this.form.submit()">
                            </div>
                        </div>
                        <div class="custom-summary col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text text-dark fw-bolder">Total Item Terjual:
                                        <span>{{ $dataView['Summary']['TotalSoldItem'] }}</span>
                                    </p>
                                    <p class="text text-dark fw-bolder">Total Transaksi:
                                        <span>{{ $dataView['Summary']['TotalTrx'] }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text text-dark fw-bolder">Total Pemasukan:
                                        <span>{{ format_currency($dataView['Summary']['Income'], true) }}</span>
                                    </p>
                                    <p class="text text-dark fw-bolder">Total Keuntungan:
                                        <span>{{ format_currency($dataView['Summary']['Outcome'], true) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-secondary p-5 text-center text-white rounded">grafik data</div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="bg-primary text-white p-2 rounded text-center">Bulanan</h2>
                        <table class="table table-striped" id="monthTableDetails">
                            <thead class="bg-warning text-white">
                                <tr>
                                    <th>Bulan</th>
                                    <th>Total Omset</th>
                                    <th>Total Transaksi</th>
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataView['Details'] as $items)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::createFromFormat('!m', $items->BULAN)->translatedFormat('F') }}
                                        </td>
                                        <td>{{ format_currency($items->TOTAL_OMSET, true) }}</td>
                                        <td>{{ $items->TOTAL_TRANSAKSI }}</td>
                                        <td>{{ format_currency($items->TOTAL_KEUNTUNGAN, true) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="bg-secondary p-5 text-center text-white rounded">grafik data</div>
                    </div>
                    <div class="col-md-6">
                        <h2 class="bg-primary text-white p-2 rounded text-center">Kategori</h2>
                        <table class="table table-striped">
                            <thead class="bg-warning text-white">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Total Item Terjual</th>
                                    <th>Jumlah Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Elektronik</td>
                                    <td>2</td>
                                    <td>Rp. 100.000</td>
                                </tr>
                                <tr>
                                    <td>Makanan</td>
                                    <td>3</td>
                                    <td>Rp. 300.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @vite(['resources/css/sales.css'])

@endsection
