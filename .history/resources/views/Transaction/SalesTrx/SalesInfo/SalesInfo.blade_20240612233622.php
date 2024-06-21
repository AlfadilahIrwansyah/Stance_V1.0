@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark">Daftar Keuntungan</h1>
        <p class="text text-dark">Berikut hasil penjualan kamu sesuai dengan periode yang dipilih</p>
        <div class="my-1">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="period" class="form-label">Periode Transaksi</label>
                    <input type="text" class="form-control" id="period" value="April 2023 - Maret 2024">
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-md-3">
                            <p>Total Item Terjual: 4</p>
                            <p>Total Transaksi: 2</p>
                        </div>
                        <div class="col-md-3">
                            <p>Total Pemasukan: Rp. 400.000</p>
                            <p>Total Keuntungan: Rp. 30.000</p>
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
                <h2 class="bg-warning text-white p-2 rounded">Bulanan</h2>
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

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="bg-secondary p-5 text-center text-white rounded">grafik data</div>
            </div>
            <div class="col-md-6">
                <h2 class="bg-warning text-white p-2 rounded">Kategori</h2>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#period').datepicker({
                format: "MM yyyy",
                minViewMode: 1,
                autoclose: true
            });
        });
    </script>
@endsection
