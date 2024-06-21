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
                    
                </div>
            </div>
        </div>
    </div>
@endsection
