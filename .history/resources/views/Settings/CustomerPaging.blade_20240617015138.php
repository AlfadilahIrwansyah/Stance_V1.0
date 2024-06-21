@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div><>
            <h1 class="text text-primary fw-bolder">Daftar Pelanggan</h1>
            <h3 class="text text-dark fw-bolder">List pembeli yang telah didaftarkan</h3>
            <div>
                <a href="{{ route('CategoryA') }}" class="btn btn-warning mb-2">
                    <i class="bi bi-box-fill m-1"></i>
                    Tambah Kategori
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Total Transaksi</th>
                    <th scope="col">Aksi</th>
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
                            @if (Auth::user()->REF_ROLE->ROLE_ACCESS == 'ALL' || Auth::user()->REF_ROLE->ROLE_NAME == 'admin')
                                <a class="btn btn-primary act-btn" href="{{ route('custDetail', $cd->REF_CUST_ID) }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a class="btn btn-danger act-btn" {{-- href="{{ route('role.delete') }}" --}}>
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            @endif
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
