@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text fw-bolder text-primary">Stok Opname</h1>
            <h3 class="text text-dark mb-2">Update Jumlah Stok Barang</h3>

        </div>
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
                            <input type="text" name="item_stock" id="item_stock"
                                class="form-control"
                                value="{{ $item->STOCK }}" required autocomplete="item_stock">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
