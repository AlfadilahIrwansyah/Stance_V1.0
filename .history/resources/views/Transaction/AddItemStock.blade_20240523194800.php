@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark fw-bolder">TAMBAH BARANG</h1>
        <form action="POST" href="">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_code" class="col-md-4 col-form-label">
                        {{ __('KODE BARANG') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="item_code" id="item_code"
                        class="form-control @error('item_code') is-invalid @enderror" name="item_code"
                        value="{{ old('item_code') }}" required autocomplete="item_code" autofocus>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_name" class="col-md-4 col-form-label">
                        {{ __('NAMA BARANG') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="item_name" id="item_name"
                        class="form-control @error('item_name') is-invalid @enderror" name="item_name"
                        value="{{ old('item_name') }}" required autocomplete="item_name" autofocus>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="item_stock" class="col-md-4 col-form-label">
                        {{ __('STOK BARANG  ') }} <span class="text-danger">*</span>
                    </label>
                    <input type="number" name="item_stock" id="item_stock"
                        class="form-control @error('item_stock') is-invalid @enderror" name="item_stock"
                        value="{{ old('item_stock') }}" required autocomplete="item_stock" autofocus>
                </div>
            </div>
        </form>
    </div>
@endsection
