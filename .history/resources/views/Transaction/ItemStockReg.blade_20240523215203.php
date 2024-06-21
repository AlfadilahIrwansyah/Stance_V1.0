@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text fw-bolder text-primary">Daftar Stock Item</h1>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="text mb-2">Item yang tersedia pada gudang anda</h3>
            <div>
                <a href="" class="btn btn-warning mb-2">
                    <i class="bi bi-box-fill m-1"></i>
                    Stock Opname
                </a>
                <a href="" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-lg m-1"></i>
                    Add Item
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Category</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersData as $ru)
                    <tr scope="row">
                        <td>{{ $ru['user']->username }}</td>
                        <td>{{ $ru['user']->name }}</td>
                        <td>{{ $ru['user']->ref_role->role_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
