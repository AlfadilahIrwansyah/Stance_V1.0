@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary fw-bolder">{{ __('TAMBAH TRANSAKSI') }}</h1>
        <form action="{{ route('NewItem') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="user_cashier" class="text text-dark col-form-label">
                        {{ __('Kasir') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="user_cashier" id="user_cashier" class="form-control"
                        value="{{ old('user_cashier', $TransData->user) }}" required autocomplete="user_cashier" disabled>

                    <label for="sales_date" class="text text-dark col-form-label">
                        {{ __('Tanggal Transaksi') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" step="0.01" name="sales_date" id="sales_date" class="form-control"
                            value="{{ old('sales_date', $TransData->saleDate) }}" required autocomplete="sales_date"
                            disabled>
                    </div>
                    <label for="customer_name" class="text text-dark col-form-label">
                        {{ __('Kustomer') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" step="0.01" name="customer_name" id="customer_name" class="form-control"
                            value="{{ old('customer_name') }}" required autocomplete="customer_name">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="item_desc" class="text text-dark col-form-label">
                        {{ __('DESKRIPSI') }} <span class="text-danger">*</span>
                    </label>
                    <textarea name="item_desc" id="item_code" class="form-control @error('item_desc') is-invalid @enderror"
                        value="{{ old('item_desc') }}" required autocomplete="item_desc"></textarea>
                    <span id="item_descError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-danger" style="width: 100px;" onclick="window.history.go(-1); return false;">
                        {{ __('Cancel') }}
                    </button>


                </div>
            </div> --}}
        </form>
        <div id="itemGrid">
            <div class="d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-primary align-items-end justify-content-end" style="width: 100px;">
                    {{ __('Add Item') }}
                </button>
            </div>
            <table class="table table-bordered table-striped table-hover border-dark align-middle" id="itemsTable"
                style="margin-top: 10px">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="table-info">
                    @foreach ($itemData as $item)
                        <tr scope="row" id="rowBarang">
                            <td>{{ $item->ItemCode }}</td>
                            <td>{{ $item->ItemName }}</td>
                            <td>{{ $item->Qty }}</td>
                            <td>{{ format_currency($item->Price, true) }}</td>
                            <td>{{ format_currency($item->Price * $item->Qty, true) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="TotalHarga" class="d-flex align-items-center justify-content-end">
                <p class="text-dark fw-bolder ">
                    {{ __('Subtotal : ' . format_currency($totalAmount, true)) }}
                </p>
                <p class="text-dark fw-bolder ">
                    {{ __('Subtotal : ' . format_currency($totalAmount, true)) }}
                </p>
            </div>
        </div>
    </div>
@endsection
