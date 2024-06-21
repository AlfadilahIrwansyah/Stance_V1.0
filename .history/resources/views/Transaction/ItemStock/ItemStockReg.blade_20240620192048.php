@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text fw-bolder text-primary">Daftar Stock Item</h1>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="text text-dark mb-2">Item yang tersedia pada gudang anda</h3>
            <div>
                <a href="{{ route('StockOpname') }}" class="btn btn-warning mb-2">
                    <i class="bi bi-box-fill m-1"></i>
                    Stok Opname
                </a>
                <a href="{{ route('AddItem') }}" class="btn btn-primary mb-2">
                    <i class="bi bi-plus-lg m-1"></i>
                    Tambah Item
                </a>
            </div>
        </div>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari Barang...">
        <table class="table table-bordered table-striped table-hover border-dark align-middle" id="itemsTable">
            <thead class="table-warning text-center">
                <tr>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Siap Jual</th>
                    <th scope="col">Edit Item</th>
                </tr>
            </thead>
            <tbody class="table-info">
                @foreach ($RefItem as $item)
                    <tr scope="row" id="rowBarang">
                        <td>{{ $item->ITEM_CODE }}</td>
                        <td>{{ $item->ITEM_NAME }}</td>
                        <td>{{ $item->STOCK }}</td>
                        <td>{{ $item->REF_CATEGORY->CATEGORY_NAME }}</td>
                        <td>{{ format_currency($item->SELL_PRICE_AMT, true) }}</td>
                        <td>{{ DateFormatter($item->BUY_DATE) }}</td>
                        <td>
                            @if ($item->IS_SELL)
                                <i class="bi bi-check-lg" text-success" style="font-size:24px;"></i>
                            @else
                                <i class="bi bi-x-lg text-danger" style="font-size:24px;"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            <a class="bi bi-pencil-fill" href="{{ route('EditItem', $item->REF_ITEM_ID) }}"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session('error'))
        <div class="alert alert-danger alert-fixed">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-fixed">
            {{ session('success') }}
        </div>
    @endif
@endsection
