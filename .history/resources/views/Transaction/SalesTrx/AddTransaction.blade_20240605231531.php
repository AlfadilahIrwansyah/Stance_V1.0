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
                <tbody class="table-info">
                    @foreach ($itemData as $item)
                        <tr scope="row" id="rowBarang">
                            <td>{{ $item->ItemCode }}</td>
                            <td>{{ $item->ItemName }}</td>
                            <td>{{ $item->Qty }}</td>
                            <td>{{ format_currency($item->Price, true) }}</td>
                            <td>{{ format_currency($item->Price * $item->Qty, true) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="TotalHarga" class="d-flex flex-column align-items-end justify-content-end">
                <div class="d-flex justify-content-center">
                    <p class="text text-dark fw-bolder text-right">
                        {{ __('Subtotal : ' . format_currency($totalAmount, true)) }}
                    </p>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="text text-dark fw-bolder text-right">
                        {{ __('Tax : ' . format_currency(($totalAmount * 10) / 100, true)) }}
                    </p>
                </div>
                <div class="d-flex justify-content-center">
                    <p class="text text-dark fw-bolder text-right">
                        {{ __('Total : ' . format_currency($totalAmount - ($totalAmount * 10) / 100, true)) }}
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
                                {{ __('Register') }}
                            </h1>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <form id="registerForm" method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Name') }}
                                            <span class="text-danger">*</span></label>

                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name"
                                                placeholder="Nama Lengkap" autofocus>
                                            <span id="nameError" class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Alamat E-mail') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Contoh@gmail.com">
                                            <span id="emailError" class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone_number"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}
                                            <span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input id="phone_number" type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" value="{{ old('phone_number') }}" required
                                                autocomplete="phone_number" placeholder="+62xxxxxxxxxxx" autofocus>
                                            <span id="phone_numberError" class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="ref_role_id"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Role') }} <span
                                                class="text-danger">*</span></label>

                                        <div class="col-md-6">
                                            <select name="role" id="role"
                                                class="form-control @error('role') is-invalid @enderror">
                                                <option value="">Pilih posisi karyawan</option>
                                                @foreach ($refRole as $role)
                                                    <option value="{{ $role->REF_ROLE_ID }}">{{ $role->ROLE_NAME }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span id="roleError" class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                placeholder="Kata sandi lebih dari 8 karakter">
                                            <span id="passwordError" class="invalid-feedback" role="alert"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Konfirmasi kata sandi">
                                        </div>

                                        <input type="hidden" id="is_activated" value="0">
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Register') }}
                                            </button>
                                            <button type="reset" class="btn btn-primary" id="resetButton">
                                                {{ __('Reset') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
