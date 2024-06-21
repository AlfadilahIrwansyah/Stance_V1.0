@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark">Daftar Kategori</h1>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Total Barang</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($RefCategory as $rc)
                <tr>
                    <td>{{ $rc->CATEGORY_NAME }}</td>
                     <td>{{ $rc->CATEGORY_NAME }}</td>
                </tr>
                <tr></tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $RefCategory->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection
