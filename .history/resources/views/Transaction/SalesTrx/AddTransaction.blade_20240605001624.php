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
                    <input type="text" name="user_cashier" id="user_cashier"
                        class="form-control"
                        value="{{ old('user_cashier', $TransData->user) }}" required autocomplete="user_cashier" disabled>
                </div>
                <div class="col-md-4">
                    <label for="sales_date" class="text text-dark col-form-label">
                        {{ __('Tanggal Transaksi') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" step="0.01" name="sales_date" id="sales_date"
                            class="form-control"
                            value="{{ old('sales_date', '0.00') }}" required autocomplete="sales_date">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_name" class="text text-dark col-form-label">
                        {{ __('NAMA BARANG') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="item_name" id="item_name"
                        class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}"
                        required autocomplete="item_name">
                    <span id="item_nameError" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="col-md-4">
                    <label for="item_sell_price" class="text text-dark col-form-label">
                        {{ __('HARGA JUAL') }}
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                        <input type="text" step="0.01" name="item_sell_price" id="item_sell_price"
                            class="form-control @error('item_sell_price') is-invalid @enderror"
                            value="{{ old('item_sell_price', '0.00') }}" autocomplete="item_sell_price">
                        <span id="item_sell_priceError" class="invalid-feedback" role="alert"></span>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_stock" class="text text-dark col-form-label">
                        {{ __('STOK BARANG  ') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="item_stock" id="item_stock"
                        class="form-control @error('item_stock') is-invalid @enderror" value="{{ old('item_stock') }}"
                        required autocomplete="item_stock">
                    <span id="item_stockError" class="invalid-feedback" role="alert"></span>
                </div>
                {{-- <div class="col-md-4">
                    <label for="item_category" class="text text-dark col-form-label">
                        {{ __('KATEGORI BARANG') }} <span class="text-danger">*</span>
                    </label>
                    <select name="item_category" id="item_category" class="form-control">
                        <option value="">Pilih Kategori Barang</option>
                        @foreach ($refCategory as $category)
                            <option value="{{ $category->REF_CATEGORY_ID }}">{{ $category->CATEGORY_NAME }}</option>
                        @endforeach
                    </select>
                    <span id="item_categoryError" class="invalid-feedback" role="alert"></span>
                </div> --}}
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_desc" class="text text-dark col-form-label">
                        {{ __('DESKRIPSI') }} <span class="text-danger">*</span>
                    </label>
                    <textarea name="item_desc" id="item_code" class="form-control @error('item_desc') is-invalid @enderror"
                        value="{{ old('item_desc') }}" required autocomplete="item_desc"></textarea>
                    <span id="item_descError" class="invalid-feedback" role="alert"></span>
                </div>
                <div class="col-md-4">
                    <label for="item_active" class="text text-dark col-form-label">
                        {{ __('SIAP DI JUAL') }}
                    </label>
                    <input type="checkbox" name="item_active" id="item_active"
                        class="form-check-input @error('item_active') is-invalid @enderror"
                        value="{{ old('item_active') }}" autocomplete="item_active" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-danger" style="width: 100px; margin-right:115px"
                        onclick="window.history.go(-1); return false;">
                        {{ __('Cancel') }}
                    </button>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" style="width: 100px;">
                        {{ __('Add Item') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
