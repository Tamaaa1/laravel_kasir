<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            /* Light gray background */
            font-family: 'Nunito', sans-serif;
        }

        .navbar-dark {
            background-color: #343a40;
            /* Dark theme for navbar */
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
        }

        .btn-outline-primary.active {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Navigation Menu -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('home') }}" class="nav-btn {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>
                    @if(Auth::user()->peran == 'admin')
                        <a href="{{ route('user') }}" class="nav-btn {{ request()->routeIs('user') ? 'active' : '' }}">
                            Pengguna
                        </a>
                    @endif
                        <a href="{{ route('produk') }}" class="nav-btn {{ request()->routeIs('produk') ? 'active' : '' }}">
                            Produk
                        </a>
                    <a href="{{ route('transaksi') }}"
                        class="nav-btn {{ request()->routeIs('transaksi') ? 'active' : '' }}">
                        Transaksi
                    </a>
                    @if(Auth::user()->peran == 'admin')
                    <a href="{{ route('laporan') }}"
                        class="nav-btn {{ request()->routeIs('laporan') ? 'active' : '' }}">
                        Laporan
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <style>
            /* Styling Navigation Buttons */
            .nav-btn {
                display: inline-block;
                padding: 10px 20px;
                margin: 5px;
                border: 2px solid #343a40;
                /* Dark Gray */
                color: #343a40;
                background-color: transparent;
                text-decoration: none;
                font-weight: bold;
                font-size: 1rem;
                border-radius: 5px;
                transition: all 0.3s ease-in-out;
            }

            .nav-btn:hover {
                background-color: #343a40;
                color: #fff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .nav-btn.active {
                background-color: #343a40;
                color: white;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const buttons = document.querySelectorAll('.nav-btn');

                buttons.forEach((button) => {
                    button.addEventListener('mouseover', function () {
                        button.style.transform = 'scale(1.05)';
                        button.style.boxShadow = '0 6px 10px rgba(0, 0, 0, 0.15)';
                    });

                    button.addEventListener('mouseout', function () {
                        button.style.transform = 'scale(1)';
                        button.style.boxShadow = 'none';
                    });
                });
            });
        </script>


        <!-- Main Content -->
        <main class="py-4">
            {{ $slot }}
        </main>
    </div>
</body>

</html>