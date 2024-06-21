@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary fw-bolder">{{ __('TAMBAH TRANSAKSI') }}</h1>
        <form action="{{ route('NewItem') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="user_cashier" class="text text-dark col-form-label">
                        {{ __('Kasir') }} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="user_cashier" id="user_cashier" class="form-control"
                        value="{{ old('user_cashier', $TransData->user) }}" required autocomplete="user_cashier" disabled>

                    <label for="sales_date" class="text text-dark col-form-label">
                        {{ __('Tanggal Transaksi') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" step="0.01" name="sales_date" id="sales_date" class="form-control"
                            value="{{ old('sales_date', $TransData->saleDate) }}" required autocomplete="sales_date"
                            disabled>
                    </div>
                    <label for="customer_name" class="text text-dark col-form-label">
                        {{ __('Kustomer') }} <span class="text-danger">*</span>
                    </label>
                    <div class="input-group mb-3">
                        <input type="text" step="0.01" name="customer_name" id="customer_name" class="form-control"
                            value="{{ old('customer_name') }}" required autocomplete="customer_name">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="item_desc" class="text text-dark col-form-label">
                        {{ __('DESKRIPSI') }} <span class="text-danger">*</span>
                    </label>
                    <textarea name="item_desc" id="item_code" class="form-control @error('item_desc') is-invalid @enderror"
                        value="{{ old('item_desc') }}" required autocomplete="item_desc"></textarea>
                    <span id="item_descError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
        </form>
        <div id="itemGrid">
            <div class="d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-primary align-items-end justify-content-end" style="width: 100px;"
                    data-bs-toggle="modal" data-bs-target="#addItemModal">
                    {{ __('Add Item') }}
                </button>
            </div>
            <table class="table table-bordered table-striped table-hover border-dark align-middle" id="itemsTable"
                style="margin-top: 10px">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="table-info" id="itemsTable">
                    {{-- @foreach ($itemData as $item)
                        <tr scope="row" id="rowBarang">
                            <td>{{ $item->ItemCode }}</td>
                            <td>{{ $item->ItemName }}</td>
                            <td>{{ $item->Qty }}</td>
                            <td>{{ format_currency($item->Price, true) }}</td>
                            <td>{{ format_currency($item->Price * $item->Qty, true) }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
            <div id="TotalHarga" class="d-flex flex-column align-items-end justify-content-end">
                <div class="d-flex justify-content-center">
                    <p class="text text-dark fw-bolder text-right">
                        {{ __('Subtotal : ') }}<span id="subtotal">Rp 0.00</span>
                    </p>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="text text-dark fw-bolder text-right">
                        {{ __('Tax : ') }}<span id="tax">Rp 0.00</span>
                    </p>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="text text-dark fw-bolder text-right">
                        {{ __('Total : ') }}<span id="total">Rp 0.00</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-danger align-items-end justify-content-end me-2" style="width: 100px;">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="btn btn-primary align-items-end justify-content-end me-2" style="width: 100px;">
                {{ __('Print') }}
            </button>
            <button type="submit" class="btn btn-success align-items-end justify-content-end me-2" style="width: 100px;">
                {{ __('Save') }}
            </button>
        </div>
        <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="modal-title">
                            <h1 class="text-center text-uppercase fw-bolder">
                                {{ __('Add Item') }}
                            </h1>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form id="addItemForm">
                            <div class="form-group">
                                <label for="itemCode">Kode Barang</label>
                                <input type="text" class="form-control" id="itemCode" required>
                            </div>
                            <div class="form-group">
                                <label for="itemName">Nama Barang</label>
                                <input type="text" class="form-control" id="itemName" required>
                            </div>
                            <div class="form-group">
                                <label for="itemQty">Qty</label>
                                <input type="number" class="form-control" id="itemQty" required>
                            </div>
                            <div class="form-group">
                                <label for="itemPrice">Harga</label>
                                <input type="text" class="form-control" id="itemPrice" required>
                            </div>
                            <button type="button" class="btn btn-primary " id="saveItemButton">Save Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        $(document).ready(function() {
            $('#saveItemButton').click(function() {
                var itemCode = $('#itemCode').val();
                var itemName = $('#itemName').val();
                var itemQty = $('#itemQty').val();
                var itemPrice = $('#itemPrice').val();
                var itemTotal = itemQty * itemPrice.replace(/[^0-9.-]+/g, "");

                var newRow = '<tr>' +
                    '<td>' + itemCode + '</td>' +
                    '<td>' + itemName + '</td>' +
                    '<td>' + itemQty + '</td>' +
                    '<td>Rp ' + parseFloat(itemPrice).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                    '</td>' +
                    '<td>Rp ' + parseFloat(itemTotal).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') +
                    '</td>' +
                    '</tr>';

                $('#itemsTable tbody').append(newRow);
                $('#addItemModal').modal('hide');
                $('#addItemForm')[0].reset();
                calculateTotal();
            });

            function calculateTotal() {
                var subtotal = 0;
                $('#itemsTable tbody tr').each(function() {
                    var total = parseFloat($(this).find('td').eq(4).text().replace(/[^0-9.-]+/g, ""));
                    subtotal += total;
                });

                var tax = subtotal * 0.1; // Assuming tax is 10%
                var grandTotal = subtotal + tax;

                $('#subtotal').text('Rp ' + subtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $('#tax').text('Rp ' + tax.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                $('#total').text('Rp ' + grandTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            }
        });
    </script> --}}
@endsection
