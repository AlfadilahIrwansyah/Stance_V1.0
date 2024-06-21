@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text fw-bolder text-primary">Daftar Transaksi</h1>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="text text-dark mb-2">Berikut list transaksi yang telah terjadi</h3>
            <div>
                <a href="{{ route('AddTransItem') }}" class="btn btn-warning mb-2">
                    <i class="bi bi-box-fill m-1"></i>
                    Tambah Transaksi
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover border-dark align-middle" id="itemsTable">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Kode Transaksi</th>
                    <th scope="col">Pembeli</th>
                    <th scope="col">Nilai Transaksi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Sales</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-info">
                @foreach ($salesData as $item)
                    <tr scope="row" id="rowBarang">
                        <td>{{ $item->SALES_TRX_NO }}</td>
                        <td>{{ $item->NAMA_PEMBELI }}</td>
                        <td>{{ format_currency($item->TOTAL_TRX_AMT, true) }}</td>
                        <td>{{ $item->TRX_DATE }}</td>
                        <td>{{ $item->REF_USER_ID }}</td>
                        <td>
                            <a type="button" href="" class="btn btn-lg btn-primary mb-2 rounded-2">
                                <i class="bi bi-box-fill m-1"></i>
                                {{ __('Detail') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-fixed">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-fixed">
            {{ session('success') }}
        </div>
    @endif
    </div>
@endsection
