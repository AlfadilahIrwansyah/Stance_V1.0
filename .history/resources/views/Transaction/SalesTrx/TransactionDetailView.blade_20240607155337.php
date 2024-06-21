@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-dark"></h1>
        <div id="gridDetail">
            <div class="row mb-3">
                <div class="col-md-4 d-flex align-items-center">
                    <label for="user_cashier" class="text text-dark mb-0 mr-2 me-2">
                        {{ __('Kasir :') }}
                    </label>
                    <p name="user_cashier" id="user_cashier" class="text text-dark mb-0">
                        {{ $salesTrxH->REF_USER->name }}
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 d-flex align-items-center">
                    <label for="sales_date" class="text text-dark mb-0 mr-2 me-2">
                        {{ __('Tanggal Transaksi : ') }}
                    </label>
                    <p name="sales_date" id="sales_date" class="text text-dark mb-0">
                        {{ __($salesTrxH->TRX_DATE) }}
                    </p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 d-flex align-items-center">
                    <label for="customer_name" class="text text-dark mb-0 mr-2 me-2">
                        {{ __('Kustomer : ') }}
                    </label>
                    <p name="sales_date" id="sales_date" class="text text-dark mb-0">
                        {{ __($salesTrxH->NAMA_PEMBELI) }}
                    </p>
                </div>

                {{-- <div class="col-md-4">
                    <label for="item_desc" class="text text-dark mb-0 mr-2 me-2">
                        {{ __('DESKRIPSI') }}
                    </label>
                    <textarea name="item_desc" id="item_code" class="form-control @error('item_desc') is-invalid @enderror"
                        value="{{ old('item_desc') }}" required autocomplete="item_desc"></textarea>
                    <span id="item_descError" class="invalid-feedback" role="alert"></span>
                </div> --}}
            </div>
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
                        @foreach ($salesTrxD as $item)
                        <tr>
                            <td>{{$item->REF_ITEM->ITEM_CODE}}</td>
                            <td>{{$item->REF_ITEM->ITEM_NAME}}</td>
                            <td>{{$item->ITEM_AMT}}</td>
                            <td>{{$item->}}</td>
                            <td>{{$item->REF_ITEM->ITEM_CODE}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="TotalHarga" class="d-flex flex-column align-items-end justify-content-end">
                    <div class="d-flex justify-content-center">
                        <p class="text text-dark fw-bolder text-right">
                            {{ __('Total : ') }}<span id="total">Rp 0.00</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
