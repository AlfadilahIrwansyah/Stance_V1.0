@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="register-container">
                    <img src="{{ Vite::asset('resources/images/stance_logo.png') }}" class="top-left-image">
                    <h1 class="text-center text-uppercase fw-bolder mb-4">
                        {{ __('Register') }}
                    </h1>
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" placeholder="Nama Lengkap"
                                    autofocus>
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
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="phone_number"
                                    placeholder="+62xxxxxxxxxxx" autofocus>
                                <span id="phone_numberError" class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ref_role_id" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                {{-- <select name="role" id="role" class="form-control">
                                    <option value="">Pilih posisi karyawan</option>
                                    @foreach ($refRole as $role)
                                        <option value="{{ $role->REF_ROLE_ID }}">{{ $role->ROLE_NAME }}</option>
                                    @endforeach
                                </select> --}}
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="roleDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih posisi karyawan
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="roleDropdown">
                                    <input type="text" class="form-control" id="searchRole" placeholder="Search...">
                                    <div id="roleList">
                                        @foreach ($refRole as $role)
                                            <li>
                                                <a class="dropdown-item" href="#"
                                                    data-value="{{ $role->REF_ROLE_ID }}">{{ $role->ROLE_NAME }}</a>
                                            </li>
                                        @endforeach
                                    </div>
                                </ul>
                                <input type="hidden" name="role" id="role">
                                <span id="roleError" class="invalid-feedback" role="alert"></span>
                            </div>
                            <input type="hidden" id="is_activated" value="0">
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <button type="reset" class="btn btn-primary" id="resetButton">
                                    {{ __('Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchRole');
        const roleList = document.getElementById('roleList');
        const dropdownItems = roleList.getElementsByClassName('dropdown-item');
        const hiddenInput = document.getElementById('role');
        const dropdownButton = document.getElementById('roleDropdown');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            for (let i = 0; i < dropdownItems.length; i++) {
                const item = dropdownItems[i];
                const text = item.textContent || item.innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            }
        });

        for (let i = 0; i < dropdownItems.length; i++) {
            dropdownItems[i].addEventListener('click', function(event) {
                event.preventDefault();
                const value = this.getAttribute('data-value');
                const text = this.textContent || this.innerText;
                hiddenInput.value = value;
                dropdownButton.textContent = text;
                const dropdown = bootstrap.Dropdown.getInstance(dropdownButton);
                dropdown.hide();
            });
        }
    });
</script>
@endsection
