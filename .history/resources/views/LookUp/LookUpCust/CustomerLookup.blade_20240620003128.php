<div class="modal fade" id="selectCustModal" tabindex="-1" aria-labelledby="selectCustModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-title">
                    <h1 class="text-center text-uppercase fw-bolder">
                        {{ __('Pilih Pelanggan') }}
                    </h1>
                </div>
            </div>
            <div class="modal-body" id="selectCustModalBody">
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
                {{-- <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#form1">Pilih Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#form2">Tambah Pelanggan</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="form1" class="container tab-pane active"><br>
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
                    </div>
                    <div id="form2" class="container tab-pane fade"><br>
                        <form method="POST" action="{{ route('custAdd') }}">
                            @csrf
                            <input type="hidden" value="Modal" id="ModalCust" name="ModalCust">
                            <div class="row mb-3">
                                <label for="name"
                                    class="text-dark col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', isset($CustData) ? $CustData->CUST_NAME : '') }}" required
                                        autocomplete="name" autofocus>
                                    <span id="nameError" class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone"
                                    class="text-dark col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                                <div class="col-md-6">
                                    <input id="phone" type="phone"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone', isset($CustData) ? $CustData->CUST_PHONE_NUMBER : '') }}"
                                        autocomplete="phone">
                                    <span id="phoneError" class="invalid-feedback" role="alert"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="emailCust"
                                    class="text-dark col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>
                                <div class="col-md-6">
                                    <input id="emailCust" type="emailCust"
                                        class="form-control @error('emailCust') is-invalid @enderror" name="emailCust"
                                        value="{{ old('emailCust', isset($CustData) ? $CustData->CUST_emailCust : '') }}"
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
                </div> --}}
            </div>
        </div>
    </div>
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
