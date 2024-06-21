@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text fw-bolder text-primary">Stok Opname</h1>
        <h3 class="text text-dark mb-2">Update Jumlah Stok Barang</h3>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-warning">
                <tr>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                </tr>
            </thead>
            <tbody class="table-info">
                @foreach ($RefItem as $item)
                    <tr scope="row">
                        <td>{{ $item->ITEM_CODE }}</td>
                        <td>{{ $item->ITEM_NAME }}</td>
                        <td>
                            <input type="number" name="stocks[{{ $item->ITEM_CODE }}]"
                                value="{{ old('stocks.' . $item->ITEM_CODE, $item->STOCK) }}" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
