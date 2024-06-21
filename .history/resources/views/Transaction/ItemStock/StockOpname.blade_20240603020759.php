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
                        <th>Stock</th>
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
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-danger" onclick="window.history.go(-1); return false;">
                        {{ __('Cancel') }}
                    </button>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" style="width: auto;">
                        {{ __('Update Stock') }}

                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
