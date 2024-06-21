@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary">Daftar Sales</h1>
        <h3 class="text text-dark fw-bolder">Berikut hasil penjualan sales sesuai dengan periode yang dipilih</h3>
        <div id="infoView" style="margin-top: 65px;">
            <div class="row">
                <div class="col-md-6">
                    <label for="period-start" class="form-label text text-dark fw-bolder">Periode Transaksi</label>
                    <div class="d-flex">
                        <input type="date" class="form-control me-2" id="period-start" placeholder="{{ $datetime }}"
                            value="{{ old('period-end', $datetime) }}">
                        <input type="date" class="form-control" id="period-end"
                            value="{{ old('period-start', $datetime) }}">
                    </div>
                    <div class="bg-secondary p-5 text-center text-white rounded">grafik data</div>
                </div>
                <div class="col-md-6">
                    <h2 class="bg-primary text-white p-2 rounded text-center">Bulanan</h2>
                    <table class="table table-striped">
                        <thead class="bg-warning text-white">
                            <tr>
                                <th>Sales</th>
                                <th>Nilai Penjualan</th>
                                {{-- <th>Item Terjual</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSaleUser as $data)
                                <tr>
                                    <td>{{ $data[]->Nama }}</td>
                                    <td>{{ $data->TotalTrx }}</td>
                                    {{-- <td>{{ format_currency($items->JUMMLAH_NOMINAL_TERJUAL, true) }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/css/sales.css'])
@endsection
