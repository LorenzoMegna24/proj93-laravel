@extends('layouts.app')

@section('content')

<div class="container-index">
    <h1 class="text-center py-4">I Tuoi Alloggi</h1>
    <div class="d-flex justify-content-center">
        <a class="btn mt-2 button-create shadow" href="{{route('apartments.create')}}">Inserisci un nuovo b&b</a>
    </div>

    @if (session('error'))
    <div class="d-flex justify-content-center">
        <div class="alert alert-danger">
            <p class="m-0 p-0 text-center">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="container py-4">
        <div class="row">
            @foreach ($apartments as $elem)
                <div class="col-lg-4 col-md-6 col-sm-12 my-3">
                    <div class="card card-index shadow border-0">
                        <img class="card-img-top img-card-index" src="{{asset('storage/' . $elem->image)}}" alt="Title">
                        <div class="card-body">
                            <a  class="card-title fs-4" href="{{route('apartments.show', $elem)}}">{{$elem->title}}</a>
                            <p class="card-text mt-1 mb-0">{{$elem->address}}</p>
                        </div>              
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<footer>
    <div class="footer-content container-fluid px-5 py-3 shadow-lg">

        <div class="row">

            <div class="contact-info d-flex justify-content-center col-lg-4 col-sm-4 col-12 mb-3">
                <div>
                    <h4 class="pb-2">Contattaci</h4>
                    <p><strong>Email:</strong> boolbnb@gmail.com</p>
                    <p><strong>Telefono:</strong> +39 123 456789</p>
                    <p><strong>Orari di contatto:</strong> Lun-Ven 9:00 - 18:00</p>
                </div>
            </div>

            <div class="social-links col-lg-4 col-sm-4 col-12 d-flex justify-content-center">
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

            <div class="site-links col-lg-4 col-sm-4 col-12 d-flex justify-content-center">
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
@endsection
