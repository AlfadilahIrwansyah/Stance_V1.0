@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary fw-bolder">{{ __('TAMBAH TRANSAKSI') }}</h1>
        <form action="{{ route('AddTrx') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="user_cashier" class="text text-dark col-form-label">
                        {{ __('Kasir') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="user_cashier" id="user_cashier" class="form-control"
                        value="{{ old('user_cashier', $TransData->user->name) }}" required autocomplete="user_cashier"
                        disabled>
                    <input type="hidden" name="ref_user_id" id="ref_user_id"
                        value="{{ old('ref_user_id', $TransData->user->ref_user_id) }}">

                    <label for="sales_date" class="text text-dark col-form-label">
                        {{ __('Tanggal Transaksi') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="sales_date" id="sales_date" class="form-control"
                        value="{{ old('sales_date', $TransData->saleDate) }}" required autocomplete="sales_date" disabled>
                    <input type="hidden" name="sales_date_hidden" value="{{ old('sales_date', $TransData->saleDate) }}">
                    <label for="customer_name" class="text text-dark col-form-label">
                        {{ __('Kustomer') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <div class="d-flex align-items-center justify-content-end">
                            <input type="text" step="0.01" name="customer_name" id="customer_name"
                                class="form-control" value="{{ old('customer_name') }}" required
                                autocomplete="customer_name" disabled>
                            <input type="hidden" value="{{ old('ref_cust_id') }}" name="ref_cust_id" id="ref_cust_id">
                            <button type="button" class="btn btn-primary align-items-end justify-content-end"
                                style="width: 100px;" data-bs-toggle="modal" data-bs-target="#selectCustModal">
                                {{ __('Pilih Pelanggan') }}
                            </button>
                        </div>
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
            <div id="itemGrid">
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
            </div>
            <div class="d-flex align-items-center justify-content-end">
                <a class="btn btn-danger align-items-end justify-content-end me-2" style="width: 100px;"
                    href="{{ route('TransactionPaging') }}">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="btn btn-success align-items-end justify-content-end me-2"
                    style="width: 100px;">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-s">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="modal-title">
                            <h1 class="text-center text-uppercase fw-bolder">
                                {{ __('Add Item') }}
                            </h1>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form id="addItemForm">
                            <div class="form-group">
                                <label for="itemCode">Pilih Barang</label>
                                <select class="form-control" id="itemCode" style="width: 100%;" required
                                    @error('itemCode') is-invalid @enderror>
                                    <option value="">Pilih Barang</option>
                                    @foreach ($refItem as $item)
                                        <option value="{{ $item->ITEM_CODE }}" data-name="{{ $item->ITEM_NAME }}"
                                            data-price="{{ $item->SELL_PRICE_AMT }}"
                                            data-ref_item_id="{{ $item->REF_ITEM_ID }}">{{ $item->ITEM_NAME }}</option>
                                    @endforeach
                                </select>
                                {{-- <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> --}}
                            </div>
                            <div class="form-group">
                                <label for="itemName">Nama Barang</label>
                                <input type="text" class="form-control" id="itemName" required disabled>
                                <input type="hidden" id="ref_item_id">
                            </div>
                            <div class="form-group">
                                <label for="itemQty">Qty</label>
                                <input type="number" class="form-control @error('itemQty') is-invalid @enderror"
                                    id="itemQty" required min="0" step="1">
                                {{-- <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> --}}
                            </div>
                            <div class="form-group">
                                <label for="itemPrice">Harga</label>
                                <input type="text" class="form-control" id="itemPrice" required disabled>
                            </div>
                            <button type="button" class="btn btn-primary" id="saveItemButton">Save Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="selectCustModal" tabindex="-1" aria-labelledby="selectCustModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-s">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="modal-title">
                            <h1 class="text-center text-uppercase fw-bolder">
                                {{ __('Pilih Pelanggan') }}
                            </h1>
                        </div>
                    </div>
                    <div class="modal-body" id="selectCustModalBody">
                        @include('LookUp.CustomerLookup', ['refCust' => $refCust])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
