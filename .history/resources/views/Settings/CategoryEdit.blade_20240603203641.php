@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Kategori: {{ $refCategory->CATEGORY_NAME }}</h1>
        <form method="POST" action="{{ route('category.update', $refCategory->REF_CATEGORY_ID) }}">
            @csrf
            @method('PUT')
            @foreach ($possibleAccesses as $access)

            @endforeach
            <button type="submit" class="btn btn-primary">Update Role Access</button>
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
