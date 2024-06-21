
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
                        onclick="selectCustomer('{{ $cd->CUST_NAME }}', '{{ $cd->REF_CUST_ID }}')">
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
<script>
    var ajaxInProgress = false;

    $(document).on('click', '.pagination-nav .page-link', function(event) {
        event.preventDefault();

        if (ajaxInProgress) {
            return; // Exit if an AJAX request is already in progress
        }

        ajaxInProgress = true;

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            success: function(data) {
                $('#selectCustModalBody').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error loading page:', error);
            },
            complete: function() {
                ajaxInProgress = false; // Reset flag after AJAX request completes
            }
        });
    });

    function selectCustomer(name, cust_id) {
        $('#customer_name').val(name);
        $('#ref_cust_id').val(cust_id);
        $('#selectCustModal').modal('hide');
    }
</script>
