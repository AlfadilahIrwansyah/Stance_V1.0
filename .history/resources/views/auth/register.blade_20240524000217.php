@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="register-container">
                    <img src="{{ Vite::asset('resources/images/stance_logo.png') }}" class="top-left-image">
                    <h1 class="text-center text-uppercase fw-bolder mb-4">
                        {{ __('Register') }}
                    </h1>
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" placeholder="Nama Lengkap"
                                    autofocus>
                                <span id="nameError" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Alamat E-mail') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Contoh@gmail.com">
                                <span id="emailError" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number"
                                class="col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="text"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="phone_number"
                                    placeholder="+62xxxxxxxxxxx" autofocus>
                                <span id="phone_numberError" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ref_role_id" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role" id="role" class="form-control">
                                    <option value="">Pilih posisi karyawan</option>
                                    @foreach ($refRole as $role)
                                        <option value="{{ $role->REF_ROLE_ID }}">{{ $role->ROLE_NAME }}</option>
                                    @endforeach
                                </select>
                                <span id="roleError" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Kata sandi lebih dari 8 karakter">
                                <span id="passwordError" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi kata sandi">
                            </div>

                            <input type="hidden" id="is_activated" value="0">
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <button type="reset" class="btn btn-primary" onclick="remo">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/registerValidate.js'])
@endsection
