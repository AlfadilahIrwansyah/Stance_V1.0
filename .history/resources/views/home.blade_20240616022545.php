@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="text text-align-left text-dark">
            Welcome, {{ ucwords(Auth::user()->name) }}
        </h4>
        <p class="text text-dark">Hope you have a great day!</p>
        <div class="chart p-3 m-2 bg-chart rounded shadow text-primary" id="chart">
            <div>
                {!! $homeChart->container() !!}
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center p-4">
            <a href="{{ route('expenses.index') }}"
                class="btn btn-block btn-custom-dark d-flex flex-column align-items-center justify-content-center rounded-3">
                <i class="bi bi-bar-chart icon-medium text-light"></i>
                <span>FINANCE</span>
            </a>
            <a href=""
                class="btn btn-block btn-custom-dark d-flex flex-column align-items-center justify-content-center rounded-3">
                <i class="bi bi-receipt icon-medium text-light"></i>
                <span>FINANCE</span>
            </a>
            <a href=""
                class="btn btn-block btn-custom-dark d-flex flex-column align-items-center justify-content-center rounded-3">
                <i class="bi bi-archive icon-medium text-light"></i>
                <span>FINANCE</span>
            </a>
            @if (Auth::user()->ref_role_id == $adminRoleId)
                <a href=""
                    class="btn btn-block btn-custom-dark d-flex flex-column align-items-center justify-content-center rounded-3">
                    <i class="bi bi-pencil icon-medium text-light"></i>
                    <span>FINANCE</span>
                </a>
            @endif
        </div>
    </div>
    <script>
        tspan {
            // color: blue;
        }
    </script>
    <script src="{{ $homeChart->cdn() }}"></script>
    {{ $homeChart->script() }}
@endsection
