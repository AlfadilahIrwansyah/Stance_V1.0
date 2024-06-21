@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="">
            @csrf
            <div class="row mb-3">
                <label for="name" class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', isset($CustData->CUST_NAME)) }}" required autocomplete="name" autofocus>
                    <span id="nameError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone', isset($CustData->CUST_PHONE_NUMBER)) }}" required autocomplete="phone">
                    <span id="phoneError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('phone'$CustData->CUST_EMAIL }}" required autocomplete="email" disabled>
                    <span id="emailError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button class="btn btn-danger" onclick="window.history.go(-1); return false;">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Edit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
