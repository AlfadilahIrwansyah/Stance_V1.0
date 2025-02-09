@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        @include('sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('finance') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
@endsection
