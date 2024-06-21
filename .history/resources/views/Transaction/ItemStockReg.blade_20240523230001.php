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
            @foreach ($itemData as $item)
                <tbody>
                    <tr scope="row">
                        <td>{{ $item['refItem']->ITEM_CODE }}</td>
                        <td>{{ $item['refItem']->ITEM_NAME }}</td>
                        <td>{{ $item['refItem']->STOCK }}</td>
                        <td>{{ $item['categoryName']->CATEGORY_NAME }}</td>
                        <td>{{ $item['refItem']->SELLING_PRICE_AMT }}</td>
                    </tr>
                </tbody>
            @endforeach
            @foreach ($refItem as $item)
                <tbody>
                    <tr scope="row">
                        <td>{{ $item->ITEM_CODE }}</td>
                        <td>{{ $item->ITEM_NAME }}</td>
                        <td>{{ $item->STOCK }}</td>
                        <td>{{ $item->CATEGORY_NAME }}</td>
                        <td>{{ $item['refItem']->SELLING_PRICE_AMT }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
