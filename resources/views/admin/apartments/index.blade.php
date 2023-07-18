@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">I Tuoi Appartamenti</h1>
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary my-3" href="{{route('apartments.create')}}">Inserisci nuovo appartamento</a>
    </div>
    @if (session('error'))
        <div class="alert alert-danger d-flex justify-content-center w-100">
            <p class="w-50 m-0 p-0">{{ session('error') }}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($apartments as $elem)
                <div class="col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('storage/' . $elem->image)}}" alt="Title">
                        <div class="card-body">
                            <a  class="card-title fs-4" href="{{route('apartments.show', $elem)}}">{{$elem->title}}</a>
                            <p class="card-text">{{$elem->address}}</p>
                        </div>              
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
