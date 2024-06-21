@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row mb-3">
                <label for="name"
                    class="text text-dark text text-dark col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ $refUser->name }}" required autocomplete="name" autofocus>
                    <span id="roleError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="ref_role_id"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                <div class="col-md-6">
                    <select name="ref_role_id" id="ref_role_id" class="form-control">
                        <option value="{{ $refUser->REF_ROLE->REF_ROLE_ID }}">{{ $refUser->REF_ROLE->ROLE_NAME }}</option>
                        @foreach ($refRole as $role)
                            <option value="{{ $role->REF_ROLE_ID }}">{{ $role->ROLE_NAME }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $refUser->email }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="password"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="password-confirm"
                    class="text text-dark col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                        autocomplete="new-password">
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
