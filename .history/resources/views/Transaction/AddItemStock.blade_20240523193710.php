@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark fw-bolder">TAMBAH BARANG</h1>
        <form action="POST" href="">
            <div class="row">
                <label for="item_code" class="col-md-4 col-form-label text-md-end">
                    {{ __('KODE BARANG') }}
                </label>
                <div class="col-md-4">
                    <input type="text" name="item_code" id="item_code"
                        class="form-control @error('item_code') is-invalid @enderror" name="item_code" value="{{ old('email') }}"
                        required autocomplete="email" autofocus>>
                </div>

            </div>
        </form>
    </div>
@endsection
