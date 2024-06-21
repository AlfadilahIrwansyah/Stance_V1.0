@extends('layouts.app')

@section('content')
    <div class="container">
        @isset($refCategory)
            <h1 class="text text-dark fw-bolder">Edit Kategori: {{ $refCategory->CATEGORY_NAME }}</h1>
            <form method="POST" action="@isset($refCategory) ? {{ route('CategoryU', $refCategory->REF_CATEGORY_ID) }}">
            @else
                <h1 class="text text-dark fw-bolder">Tambah Kategori</h1>
                <form method="POST" action="{{ route('CategoryN') }}">
                @endisset
                @csrf
                <div class="col-md-4">
                    <label for="category_name" class="text text-dark col-form-label">
                        {{ __('NAMA KATEGORI') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="category_name" id="category_name"
                        class="form-control @error('category_name') is-invalid @enderror"
                        value="{{ old('category_name', isset($refCategory->CATEGORY_NAME)) }}" required
                        autocomplete="category_name">
                    <span id="category_nameError" class="invalid-feedback" role="alert"></span>
                </div>
                <button type="submit" class="btn btn-danger" style="margin-top: 10px"
                    onclick="window.history.go(-1); return false;">Cancel</button>
                @isset($refCategory)
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Update Kategori</button>
                @else
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px">Tambah Kategori</button>
                @endisset
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
