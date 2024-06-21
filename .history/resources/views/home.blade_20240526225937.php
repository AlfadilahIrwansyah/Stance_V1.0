@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="text text-align-left text-dark">
            Welcome, {{ ucwords(Auth::user()->name) }}.
        </h4>
        <p class="text text-dark">Hope you have a great day!</p>
        <div class="p-3 m-2 bg-white rounded shadow">
            <div>
                {!! $homeChart->container() !!}
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center p-4">
            <a href="{{ route('expenses.index') }}"
                class="btn btn-block btn-custom d-flex flex-column align-items-center justify-content-center rounded-3">
                <i class="bi bi-bar-chart icon-medium"></i>
                <span>FINANCE</span>
            </a>
            <a href=""
                class="btn btn-block btn-custom d-flex flex-column align-items-center justify-content-center rounded-3">
                <i class="bi bi-receipt icon-medium"></i>
                <span>FINANCE</span>
            </a>
            <a href=""
                class="btn btn-block btn-custom d-flex flex-column align-items-center justify-content-center rounded-3">
                <i class="bi bi-archive-light icon-medium"></i>
                <span>FINANCE</span>
            </a>
            @if (Auth::user()->ref_role_id == $adminRoleId)
                <a href=""
                    class="btn btn-primary btn-block btn-custom d-flex flex-column align-items-center justify-content-center rounded-3 text-decoration-none">
                    <i class="bi bi-pencil icon-medium"></i>
                    <span>FINANCE</span>
                </a>
            @endif
        </div>
    </div>

    <script src="{{ $homeChart->cdn() }}"></script>
    {{ $homeChart->script() }}
@endsection
