@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text text-primary fw-bolder">Daftar Pelanggan</h1>
        <h3 class="text text-dark fw-bolder">List pembeli yang telah didaftarkan</h3>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Nama Pembeli</th>
                    <th scope="col">Total Transaksi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($RoleData as $rd)
                    <tr scope="row">
                        <td>{{ $rd['role']->ROLE_NAME }}</td>
                        <td>
                            @foreach ($rd['roleAccesses'] as $access)
                                <span class="badge bg-secondary">{{ $access }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if (Auth::user()->REF_ROLE->ROLE_ACCESS == 'ALL' || Auth::user()->REF_ROLE->ROLE_NAME == 'admin')
                                <a class="btn btn-primary act-btn"
                                    href="{{ route('role.detail', $rd['role']->REF_ROLE_ID) }}">
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
            {{ $Refrole->links('vendor.pagination.pagination') }}
        </div>
    </div>
@endsection
