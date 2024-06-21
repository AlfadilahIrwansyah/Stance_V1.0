@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Kategori: {{ $refCategory->CATEGORY_NAME }}</h1>
        <form method="POST" action="{{ route('category.update', $refCategory->REF_CATEGORY_ID) }}">
            @csrf
            @method('PUT')
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="role_access_{{ $access }}" name="role_access[]"
                    value="{{ $access }}"
                <label class="form-check-label" for="role_access_{{ $access }}">{{ ucfirst($access) }}</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Kategori</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
