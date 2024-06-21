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
                <a href="{{ route('AddItem') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-lg m-1"></i>
                    Add Item
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Siap Jual</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($RefItem as $item)
                    <tr scope="row">
                        <td>{{ $item->ITEM_CODE }}</td>
                        <td>{{ $item->ITEM_NAME }}</td>
                        <td>{{ $item->STOCK }}</td>
                        <td>{{ $item->REF_CATEGORY->CATEGORY_NAME }}</td>
                        <td>{{ format_currency($item->SELL_PRICE_AMT) }}</td>
                        <td>
                            @</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
