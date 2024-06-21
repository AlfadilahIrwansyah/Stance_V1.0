@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-primary fw-bolder">Stok Opname</h1>
        <p>Masukan jumlah barang yang tersedia</p>
        <form action="{{ route('UpdateStock') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead class="bg-orange">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Item</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($RefItem as $item)
                        <tr>
                            <td>{{ $item->ITEM_CODE }}</td>
                            <td>{{ $item->ITEM_NAME }}</td>
                            <td>
                                <input type="number" name="item_stock[{{ $item->ITEM_CODE }}]"
                                    value="{{ old('stocks.' . $item->ITEM_CODE, $item->STOCK) }}" class="form-control">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Stock</button>
        </form>
    </div>
@endsection
