<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body class=" @if (Route::currentRouteName() === 'login' || Route::currentRouteName() === 'register') body-login @else body-home @endif">
    <div id="app">
        <div class="sidebar collapsed" id="sidebar">
            <button class="toggle-btn text-light nav-link" id="toggle-btn">☰</button>
            <a href="{{ route('home') }}" class="nav-link"><i class="bi bi-house"></i><span>Beranda</span></a>
            <div class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#stokManajemenCollapse" role="button"
                    aria-expanded="false" aria-controls="stokManajemenCollapse">
                    <i class="bi bi-box"></i><span>Stok Manajemen</span>
                </a>
                <div class="collapse" id="stokManajemenCollapse">
                    <a class="dropdown-item" href="{{ route('viewItem') }}"><i class="bi bi-layers-fill"></i>Daftar
                        Stok</a>
                    <a class="dropdown-item" href="{{ route('CategoryP') }}"><i class="bi bi-tags-fill"></i>Kategori
                        Barang</a>
                </div>
            </div>
            <a href="{{ route('TransactionPaging') }}" class="nav-link"><i
                    class="bi bi-receipt"></i><span>Transaksi</span></a>
            <div class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#laporanKeuanganCollapse" role="button"
                    aria-expanded="false" aria-controls="laporanKeuanganCollapse">
                    <i class="bi bi-graph-up"></i><span>Laporan Keuangan</span>
                </a>
                <div class="collapse" id="laporanKeuanganCollapse">
                    <a class="dropdown-item" href="{{ route('SalesInfo') }}"> <i class="bi bi-graph-up"></i>Keuntungan
                        Penjualan</a>
                    <a class="dropdown-item" href="{{ route('SalesPersonal') }}"> <i class="bi bi-graph-up"></i>Sales
                        Perorang</a>
                </div>
            </div>

            <div class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#referensiCollapse" role="button"
                    aria-expanded="false" aria-controls="referensiCollapse">
                    <i class="bi bi-book"></i><span>Referensi</span>
                </a>
                <div class="collapse" id="referensiCollapse">
                    <a class="dropdown-item" href="{{ route('accsetting') }}"> <i
                            class="bi bi-people-fill"></i></i>Akun</a>
                    <a class="dropdown-item" href="{{ route('custPaging') }}"> <i
                            class="bi bi-person-badge-fill"></i></i>Pelanggan</a>
                    <a class="dropdown-item" href="{{ route('rolePaging') }}"><i class="bi bi-universal-access"></i>
                        {{ __('Role Setting') }}
                    </a>
                </div>
            </div>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                class="nav-link">
                <i class="bi bi-receipt"></i>
                <span>{{ __('LogOut') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a href="#" class="nav-link" onclick=""><i class="bi bi-moon"></i><span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkMode" name="darkMode">
                    </div>
                </span></a>
        </div>
        @if (Route::currentRouteName() === 'login' || Route::currentRouteName() === 'register')
            <nav class="navbar navbar-expand-md navbar-light d-none">
            @else
                <nav class="navbar navbar-expand-md navbar-light">
        @endif
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <ul class="navbar-nav me-auto">
                        <li>
                            <a class="sidebar-logo" href="{{ route('home') }}">
                                <img src="{{ Vite::asset('resources/images/stance_logo_small_orange.png') }}"
                                    alt="Stance Logo">
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a id="navbarDropdown" class="text nav-link text-light" href="{{route('accsetting.edit', $ru['user']->ref_user_id) }}" role="button">
                                {{ ucwords(Auth::user()->name) }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
        </nav>
        <main class="main-content collapsed py-4" id="main-content">
            <div class="container mt-4">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
