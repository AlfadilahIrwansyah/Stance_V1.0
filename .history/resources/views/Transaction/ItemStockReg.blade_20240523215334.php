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
                    <th scope="col">Item Code</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Category</th>
                    <th scope="col">Selling Price</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($RefItem as $item)
                    <tr scope="row">
                        <td>{{ $RefItem->ITEM_CODE }}</td>
                        <td>{{ $RefItem->ITEM_NAME }}</td>
                        <td>{{ $RefItem->STOCK }}</td>
                        <td>{{ $RefItem->REF_CATEGORY->CATEGORY_NAME }}</td>
                        <td>{{ $RefItem->SELLING_PRICE_AMT }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
