@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark"></h1>
        <div id="gridDetail">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="user_cashier" class="text text-dark col-form-label">
                        {{ __('Kasir : ') }} <span class="text-danger">*</span>
                    </label>
                    <p name="user_cashier" id="user_cashier" class="text tex-dark">
                        {{ __('Kasir : ') }}
                    </p>

                    {{-- <label for="sales_date" class="text text-dark col-form-label">
                        {{ __('Tanggal Transaksi') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="sales_date" id="sales_date" class="form-control"
                        value="{{ old('sales_date', $TransData->saleDate) }}" required autocomplete="sales_date" disabled>
                    <input type="hidden" name="sales_date_hidden" value="{{ old('sales_date', $TransData->saleDate) }}">
                    <label for="customer_name" class="text text-dark col-form-label">
                        {{ __('Kustomer') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" step="0.01" name="customer_name" id="customer_name" class="form-control"
                            value="{{ old('customer_name') }}" required autocomplete="customer_name">
                    </div> --}}
                </div>

                {{-- <div class="col-md-4">
                    <label for="item_desc" class="text text-dark col-form-label">
                        {{ __('DESKRIPSI') }} <span class="text-danger">*</span>
                    </label>
                    <textarea name="item_desc" id="item_code" class="form-control @error('item_desc') is-invalid @enderror"
                        value="{{ old('item_desc') }}" required autocomplete="item_desc"></textarea>
                    <span id="item_descError" class="invalid-feedback" role="alert"></span>
                </div> --}}
            </div>
            {{-- <div id="itemGrid">
                <div class="d-flex align-items-center justify-content-end">
                    <button type="button" class="btn btn-primary align-items-end justify-content-end" style="width: 100px;"
                        data-bs-toggle="modal" data-bs-target="#addItemModal">
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
                    <tbody class="table-info" id="itemsTable">
                    </tbody>
                </table>
                <div id="TotalHarga" class="d-flex flex-column align-items-end justify-content-end">
                    <div class="d-flex justify-content-center">
                        <p class="text text-dark fw-bolder text-right">
                            {{ __('Subtotal : ') }}<span id="subtotal">Rp 0.00</span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="text text-dark fw-bolder text-right">
                            {{ __('Tax : ') }}<span id="tax">Rp 0.00</span>
                        </p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="text text-dark fw-bolder text-right">
                            {{ __('Total : ') }}<span id="total">Rp 0.00</span>
                        </p>
                        <input type="hidden" id="totalInput" name="total">
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
