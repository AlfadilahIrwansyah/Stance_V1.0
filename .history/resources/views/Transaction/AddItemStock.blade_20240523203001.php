@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark fw-bolder">TAMBAH BARANG</h1>
        <form action="POST" href="">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_code" class="col-form-label">
                        {{ __('KODE BARANG') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="item_code" id="item_code"
                        class="form-control @error('item_code') is-invalid @enderror" value="{{ old('item_code') }}"
                        required autocomplete="item_code" autofocus>
                </div>
                <div class="col-md-4">
                    <label for="item_buy_price" class="col-form-label">
                        {{ __('HARGA BELI') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                        <input type="text" name="item_buy_price" id="item_buy_price"
                            class="form-control @error('item_code') is-invalid @enderror"
                            value="{{ old('item_buy_price') }}" required autocomplete="item_buy_price" autofocus>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_name" class="col-form-label">
                        {{ __('NAMA BARANG') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="item_name" id="item_name"
                        class="form-control @error('item_name') is-invalid @enderror" value="{{ old('item_name') }}"
                        required autocomplete="item_name" autofocus>
                </div>
                <div class="col-md-4">
                    <label for="item_sell_price" class="col-form-label">
                        {{ __('HARGA JUAL') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                        <input type="text" name="item_sell_price" id="item_sell_price"
                            class="form-control @error('item_code') is-invalid @enderror"
                            value="{{ old('item_sell_price') }}" required autocomplete="item_sell_price" autofocus>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_stock" class="col-form-label">
                        {{ __('STOK BARANG  ') }} <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="item_stock" id="item_stock"
                        class="form-control @error('item_stock') is-invalid @enderror" value="{{ old('item_stock') }}"
                        required autocomplete="item_stock" autofocus>
                </div>
                <div class="col-md-4">
                    <label for="item_active" class="col-form-label">
                        {{ __('SIAP DI JUAL') }} <span class="text-danger">*</span>
                    </label>
                    <input type="checkbox" name="item_active" id="item_active"
                        class="form-check-input @error('item_active') is-invalid @enderror"
                        value="{{ old('item_active') }}" required autocomplete="item_active" autofocus>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_desc" class="col-form-label">
                        {{ __('DESKRIPSI') }} <span class="text-danger">*</span>
                    </label>
                    <textarea name="item_desc" id="item_code" class="form-control @error('item_desc') is-invalid @enderror"
                        value="{{ old('item_desc') }}" required autocomplete="item_desc" autofocus></textarea>
                </div>
            </div>
            <button>

            </button>
        </form>
    </div>
    <style>
        label.col-form-label {
            display: flex;
            align-items: center;
        }
    </style>
@endsection
