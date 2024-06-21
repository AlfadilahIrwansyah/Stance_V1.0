@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-primary fw-bolder">Stok Opname</h1>
        <h3 class="text text-dark">Masukan jumlah barang yang tersedia</h3>
        <form action="{{ route('UpdateStock') }}" method="POST">
            @csrf
            <table class="table table-bordered table-striped table-hover border-dark align-middle">
                <thead class="table-warning">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Item</th>
                        <th style="wid">Stock</th>
                    </tr>
                </thead>
                <tbody class="table-info">
                    @foreach ($RefItem as $item)
                        <tr>
                            <td>{{ $item->ITEM_CODE }}</td>
                            <td>{{ $item->ITEM_NAME }}</td>
                            <td>
                                <input type="number" name="item_stock[{{ $item->ITEM_CODE }}]"
                                    value="{{ old('item_stock.' . $item->ITEM_CODE, $item->STOCK) }}" class="form-control"
                                    style="width:auto">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Stock</button>
        </form>
    </div>
@endsection
