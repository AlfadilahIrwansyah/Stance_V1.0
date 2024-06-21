<table class="table table-bordered table-striped table-hover border-dark align-middle">
    <thead class="table-primary text-center">
        <tr>
            <th scope="col">Nama Pembeli</th>
            <th scope="col">Nomor Telepon</th>
            <th scope="col">Pilih</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($refCust as $cd)
            <tr scope="row">
                <td>{{ $cd->CUST_NAME }}</td>
                <td>{{ $cd->CUST_PHONE_NUMBER }}</td>
                <td class="text-center">
                    <button class="btn btn-primary act-btn"
                        onclick="selectCustomer('{{ $cd->CUST_NAME }}', '{{ $cd-> }}')">
                        Pilih <span><i class="bi bi-check2"></i></span>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $refCust->links('vendor.pagination.pagination') }}
</div>
