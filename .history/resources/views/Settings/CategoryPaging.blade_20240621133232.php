@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="text text-dark">Daftar Kategori</h1>
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
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Total Barang</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center table-info">
                @foreach ($RefCategory as $rc)
                    <tr>
                        <td>{{ $rc->CATEGORY_NAME }}</td>
                        <td>{{ $rc->ref_item_count }}</td>
                        <td>
                            <a class="btn btn-primary act-btn" href="{{ route('CategoryE', $rc->REF_CATEGORY_ID) }}">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('CategoryD', $rc->REF_CATEGORY_ID) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger act-btn"
                                    onclick="return confirm('Apakah Kamu yakin akan menghapus kategori ini?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {{ $RefCategory->links('vendor.pagination.pagination') }}
        </div>
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
@endsection
