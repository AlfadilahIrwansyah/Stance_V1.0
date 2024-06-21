@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary">Daftar Sales</h1>
        <h3 class="text text-dark fw-bolder">Berikut hasil penjualan sales sesuai dengan periode yang dipilih</h3>
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
                        <tr>
                            <td>Maret</td>
                            <td>Rp. 100.000</td>
                            <td>213</td>
                            <td>Rp. 10.000</td>
                        </tr>
                        <tr>
                            <td>April</td>
                            <td>Rp. 300.000</td>
                            <td>432</td>
                            <td>Rp. 20.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
