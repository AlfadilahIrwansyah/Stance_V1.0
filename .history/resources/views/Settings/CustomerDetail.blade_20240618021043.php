@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{route('custAdd')}}">
            @csrf
            <div class="row mb-3">
                <label for="name" class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', isset($CustData) ? $CustData->CUST_NAME : '') }}" required autocomplete="name"
                        autofocus>
                    <span id="nameError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone', isset($CustData) ? $CustData->CUST_PHONE_NUMBER : '') }}" required
                        autocomplete="phone">
                    <span id="phoneError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="emailCust"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Alamat emailCust') }}</label>
                <div class="col-md-6">
                    <input id="emailCust" type="emailCust" class="form-control @error('emailCust') is-invalid @enderror"
                        name="emailCust" value="{{ old('emailCust', isset($CustData) ? $CustData->CUST_emailCust : '') }}" required
                        autocomplete="emailCust">
                    <span id="emailCustError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button class="btn btn-danger" onclick="window.history.go(-1); return false;">
                        {{ __('Cancel') }}
                    </button>
                    @isset($CustData)
                        <button type="submit" class="btn btn-primary">
                            {{ __('Edit') }}
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary">
                            {{ __('Tambah Pembeli') }}
                        </button>
                    @endisset
                </div>
            </div>
        </form>
    </div>
@endsection
