@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary">Daftar Keuntungan</h1>
        <h3 class="text text-dark fw-bolder">Berikut hasil penjualan kamu sesuai dengan periode yang dipilih</h3>
        <div id="infoview" class="" style="margin-top: 60px;">
            <div class="my-1">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="period-start" class="form-label text text-dark fw-bolder">Periode Transaksi</label>
                        <div class="d-flex">
                            <input type="month" class="form-control me-2" id="period-start"
                                placeholder="{{ $datetime }}" value="{{ old('period-start', $datetime) }}">
                            <input type="month" class="form-control" id="period-end"
                                value="{{ old('period-end', $datetime) }}">
                        </div>
                    </div>
                    <div class="custom-summary col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text text-dark fw-bolder">Total Item Terjual: 4</p>
                                <p class="text text-dark fw-bolder">Total Transaksi: 2</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text text-dark fw-bolder">Total Pemasukan: Rp. 400.000</p>
                                <p class="text text-dark fw-bolder">Total Keuntungan: Rp. 30.000</p>
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
                    <table class="table table-striped">
                        <thead class="bg-warning text-white">
                            <tr>
                                <th>Bulan</th>
                                <th>Total Omset</th>
                                <th>Total Transaksi</th>
                                <th>Keuntungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataView->Details as $items)
                            <tr>
                                <td>{{$items->Bulan}}</td>
                                <td>{{$items->Total_omset}}</td>
                                <td>{{$items->Bulan}}</td>
                                <td>{{$items->Bulan}}</td>
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
        </div>
    </div>
    @vite(['resources/css/sales.css'])
@endsection
