<div class="input-group mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
    </div>
</div>

<table class="table table-bordered table-striped table-hover border-dark align-middle">
    <thead class="table-primary text-center">
        <tr>
            <th scope="col">Nama Pembeli</th>
            <th scope="col">Nomor Telepon</th>
            <th scope="col">Pilih</th>
        </tr>
    </thead>
    <tbody class="text-center" id="customerTableBody">
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

    function loadCustomerData(url) {
        if (ajaxInProgress) {
            return;
        }

        ajaxInProgress = true;

        $.ajax({
            url: url,
            success: function(data) {
                $('#customerTableBody').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error loading customer data:', error);
            },
            complete: function() {
                ajaxInProgress = false;
            }
        });
    }

    $('#searchButton').click(function() {
        var searchQuery = $('#searchInput').val().trim();
        var url = '{{ route("searchCustomers") }}?search=' + encodeURIComponent(searchQuery);
        loadCustomerData(url);
    });

    $(document).on('click', '.pagination-nav .page-link', function(event) {
        event.preventDefault();

        var url = $(this).attr('href');
        loadCustomerData(url);
    });

    // Function to select a customer and close the modal
    function selectCustomer(name, cust_id) {
        $('#customer_name').val(name);
        $('#ref_cust_id').val(cust_id);
        $('#selectCustModal').modal('hide');
    }
</script>
