<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="favicon" href="{{ Vite::asset('public/logo.png') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    {{-- braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('http://localhost:5174/') }}">
                    <div class="logo_laravel">
                        <img src="{{ Vite::asset('public/logo.png') }}" style="width: 70px;" alt="logo">
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('http://localhost:5174/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                        @endif
                        @else

                        {{-- <li>
                            <a class="nav-link" href="{{route('apartments.index')}}">Appartamenti</a>
                        </li> --}}

                        <li class="nav-item dropstart">
                            <button id="navbarDropdown" class="btn nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{-- {{ Auth::user()->name }} --}}
                                <i class="fas fa-user"></i>
                            </button>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                {{-- <a class="dropdown-item" href="{{ url('dashboard') }}">{{__('Dashboard')}}</a> --}}
                                <a class="dropdown-item" href="{{ url('profile/apartments') }}">Appartamenti</a>
                                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Esci') }}
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

        <main class="">
            @yield('content')
        </main>

        <footer>
            <div class="footer-content container-fluid px-5 py-3 shadow">
    
                <div class="row">
    
                    <div class="contact-info d-flex justify-content-center col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div>
                            <h4 class="pb-2">Contattaci</h4>
                            <p><strong>Email:</strong> boolbnb@gmail.com</p>
                            <p><strong>Telefono:</strong> +39 123 456789</p>
                            <p><strong>Orari di contatto:</strong> Lun-Ven 9:00 - 18:00</p>
                        </div>
                    </div>
    
                    <div class="social-links col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                        <div>
                            <h4 class="mb-3">Seguici</h4>
                            <span class="me-2">
                                <i class="fa-brands fa-facebook fa-xl"></i>
                            </span>
                            <span class="me-2">
                                <i class="fa-brands fa-instagram fa-xl"></i>
                            </span>
                            <span>
                                <i class="fa-brands fa-twitter fa-xl"></i>
                            </span>
                        </div>
                    </div>
    
                    <div class="site-links col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
                        <div>
                            <h4 class="mb-3">Naviga</h4>
                            <ul>
                                <li>
                                    <a href="http://localhost:5174/" class="nav-link">Home</a>                                </li>
                                <li>
                                    <a href="http://localhost:5174/apartment" class="nav-link">Ricerca avanzata</a>
                                </li>
                                <li>
                                    <a href="http://127.0.0.1:8000/login">Accedi</a>
                                </li>
                                <li>
                                    <a href="http://127.0.0.1:8000/register">Registrati</a>
                                </li>
                            </ul>
                        </div>
                    </div>
    
                </div>
    
                <div class="footer-signs text-center">
                    <p class="mb-0 mt-2">
                        <i> Made with &hearts; by Francesca Di Domenico, Alessandro Casentini, Lorenzo Megna, Mattia Di
                            Cunto</i>
                    </p>
                </div>
            </div>
        </footer>
    </div>
    @yield('scripts')
</body>

</html>
