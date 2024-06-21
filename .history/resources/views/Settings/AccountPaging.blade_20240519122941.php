@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text fw-bolder text-primary">Daftar Akun</h1>
        <h3 class="text">list akun yang terdaftar pada sistem</h3>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                {{ __('Register') }}
            </button>
        </div>
        <table class="table table-bordered table-striped table-hover border-dark align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Role</th>
                    <th scope="col">Accesiblity</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersData as $ru)
                    <tr scope="row">
                        <td>{{ $ru['user']->name }}</td>
                        <td>{{ $ru['user']->ref_role->role_name }}</td>
                        <td>
                            @foreach ($ru['roleAccesses'] as $access)
                                <span class="badge bg-secondary">{{ $access }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if (
                                $ru['user']->ref_user_id == $refUserId ||
                                    (in_array('ALL', $ru['roleAccesses']) || in_array('ADMIN', $ru['roleAccesses'])))
                                <a class="btn btn-primary act-btn"
                                    href="{{ route('accsetting.edit', $ru['user']->ref_user_id) }} ">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            @endif
                            @if (in_array('ALL', $ru['roleAccesses']) ||
                                    in_array('ADMIN', $ru['roleAccesses']) ||
                                    $ru['user']->ref_user_id == $refUserId)
                                <a class="btn btn-danger act-btn">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- REGISTER MODAL BOX --}}
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                        class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

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
                                        class="col-md-4 col-form-label text-md-end">{{ __('Alamat E-mail') }}</label>
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
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>
                                    <div class="col-md-6">
                                        <input id="phone_number" type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" value="{{ old('phone_number') }}" required
                                            autocomplete="phone_number" placeholder="+62xxxxxxxxxxx" auto>
                                        <span id="phone_numberError" class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="ref_role_id"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                                    <div class="col-md-6">
                                        <select name="ref_role_id" id="ref_role_id" class="form-control">
                                            <option value="">Pilih posisi karyawan</option>
                                            @foreach ($refRole as $role)
                                                <option value="{{ $role->ref_role_id }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ref_role_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password"
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
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                        <button type="reset" class="btn btn-primary">
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
        <script>
            console.log('script run');
            $(document).ready(function() {
                function validateField(field) {
                    let fieldValue = $(field).val();
                    let fieldName = $(field).attr('name');
                    let _token = $('input[name="_token"]').val();
                    let errorDiv = '#' + fieldName + 'Error';

                    $.ajax({
                        url: '{{ route('validateField') }}',
                        method: 'POST',
                        data: {
                            _token: _token,
                            field: fieldName,
                            value: fieldValue
                        },
                        success: function(response) {
                            if (response.errors) {
                                $(field).addClass('is-invalid');
                                $(errorDiv).text(response.errors[0]);
                            } else {
                                $(field).removeClass('is-invalid');
                                $(errorDiv).text(''); // Clear error message when validation succeeds
                            }
                        }
                    });
                }

                $('#name, #username, #email, #password').on('blur', function() {
                    validateField(this);
                });
            });
        </script>
    @endsection
