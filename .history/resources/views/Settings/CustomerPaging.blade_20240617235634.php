@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary fw-bolder">Daftar Pelanggan</h1>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="text text-dark fw-bolder">List pembeli yang telah didaftarkan</h3>
            </div>
            <div>
                <a href="{{ route('custNew') }}" class="btn btn-warning mb-2">
                    <i class="bi bi-person-add"></i>
                    Tambah Pembeli
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Total Transaksi</th>
                    <th scope="col">Pilih</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($CustData as $cd)
                    <tr scope="row">
                        <td>
                            {{ $cd->CUST_NAME }}
                        </td>
                        <td>
                            {{ $cd->TOTAL_TRX }}
                        </td>
                        <td class="text-center">
                            <button>Pilih
                                <span>
                                    <i class="bi bi-check2">
                                    </i>
                                </span>
                            </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $CustData->links('vendor.pagination.pagination') }}
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
    </div>
@endsection
