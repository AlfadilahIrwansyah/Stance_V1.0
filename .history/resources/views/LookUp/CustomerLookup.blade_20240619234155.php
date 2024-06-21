
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#form1">Pilih Pelanggan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#form2">Tambah Pelanggan</a>
    </li>
</ul>
<div class="tab-content">
    <div id="form1" class="container tab-pane active"><br>

    </div>
    <div id="form2" class="container tab-pane fade"><br>
        <form method="POST" action="{{ route('custAdd') }}">
            @csrf
            <div class="row mb-3">
                <label for="name" class="text-dark col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name', isset($CustData) ? $CustData->CUST_NAME : '') }}" required
                        autocomplete="name" autofocus>
                    <span id="nameError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="phone"
                    class="text-dark col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror"
                        name="phone" value="{{ old('phone', isset($CustData) ? $CustData->CUST_PHONE_NUMBER : '') }}"
                        required autocomplete="phone">
                    <span id="phoneError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-3">
                <label for="emailCust"
                    class="text-dark col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>
                <div class="col-md-6">
                    <input id="emailCust" type="emailCust" class="form-control @error('emailCust') is-invalid @enderror"
                        name="emailCust"
                        value="{{ old('emailCust', isset($CustData) ? $CustData->CUST_emailCust : '') }}" required
                        autocomplete="emailCust">
                    <span id="emailCustError" class="invalid-feedback" role="alert"></span>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Tambah Pelanggan') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="d-flex justify-content-end">
    {{ $refCust->links('vendor.pagination.pagination') }}
</div>
<script>
    var ajaxInProgress = false;

    $(document).on('click', '.pagination-nav .page-link', function(event) {
        event.preventDefault();

        if (ajaxInProgress) {
            return;
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
