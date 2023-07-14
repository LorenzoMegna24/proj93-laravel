@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">I Tuoi Appartamenti</h1>
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary my-3" href="{{route('apartments.create')}}">Inserisci nuovo appartamento</a>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($apartments as $elem)
                <div class="col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="{{$elem->image}}" alt="Title">
                        <div class="card-body">
                            <h4 class="card-title">{{$elem->title}}</h4>
                            <p class="card-text">{{$elem->address}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
