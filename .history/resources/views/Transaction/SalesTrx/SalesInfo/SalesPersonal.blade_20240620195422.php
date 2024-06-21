@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary fw-bolder">Hasil Penjualan</h1>
        <h3 class="text text-dark fw-bolder">Berikut hasil per orang sesuai dengan periode yang dipilih</h3>
        <div id="infoView" style="margin-top: 65px;">
            <form action="{{ route('SalesPersonalFilter') }}" method="GET">
                <label for="period-start" class="form-label text text-dark fw-bolder">Periode Transaksi</label>
                <div class="d-flex text-center">
                    <div class="form-control me-2 bg-primary" id="periodStart">
                        <label for="periodStart" class="text-light">Bulan Awal</label>
                        <input type="month" class="form-control" id="periodStart" name="periodStart"
                            value="{{ isset($periodStart) ? $periodStart : $datetime }}" onchange="this.form.submit()">
                    </div>
                    <div class="form-control me-2 bg-primary" id="periodEnd">
                        <label for="periodEnd" class="text-light">Bulan Akhir</label>
                        <input type="month" class="form-control" id="periodEnd" name="periodEnd"
                            value="{{ isset($periodEnd) ? $periodEnd : $datetime }}" onchange="this.form.submit()">
                    </div>
                </div>
                <div class="chart bg-chart-light rounded shadow text-primary" id="chart" style="margin-top : 30px">
                    {!! $userChart->container() !!}
                </div>
                <div class="m-3">
                    <h2 class="bg-primary text-white p-2 rounded text-center">Kasir</h2>
                    <table class="table table-striped">
                        <thead class="bg-warning text-white">
                            <tr>
                                <th>Sales</th>
                                <th>Nilai Penjualan</th>
                                <th>Item Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataSaleUser as $data)
                                <tr>
                                    <td>{{ $data['Nama'] }}</td>
                                    <td>{{ format_currency($data['TotalTrx'], true) }}</td>
                                    <td>{{ $data['TotalItem'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-fixed">
            {{ session('error') }}
        </div>
    @endif
    </div>
    @vite(['resources/css/sales.css'])
    <script src="{{ $userChart->cdn() }}"></script>
    {{ $userChart->script() }}
@endsection
