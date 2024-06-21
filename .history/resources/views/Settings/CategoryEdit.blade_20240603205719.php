@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Kategori: {{ $refCategory->CATEGORY_NAME }}</h1>
        <form method="POST" action="{{ route('CategoryU', $refCategory->REF_CATEGORY_ID) }}">
            @csrf
            <div class="col-md-4">
                <label for="category_name" class="text text-dark col-form-label">
                    {{ __('NAMA KATEGORI') }} <span class="text-danger">*</span>
                </label>
                <input type="text" name="category_name" id="category_name"
                    class="form-control @error('category_name') is-invalid @enderror"
                    value="{{ old('category_name', $refCategory->CATEGORY_NAME) }}" required autocomplete="category_name">
                <span id="category_nameError" class="invalid-feedback" role="alert"></span>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 10px">Update Kategori</button>
            <button type="submit" class="btn btn-danger" style="margin-top: 10px" on>Update Kategori</button>
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
