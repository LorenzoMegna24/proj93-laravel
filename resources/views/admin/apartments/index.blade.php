@extends('layouts.app')

@section('content')

<div class="container-index">
    <h1 class="text-center py-4">I Tuoi Appartamenti</h1>
    <div class="d-flex justify-content-center">
        <a class="btn mt-2 button-create shadow" href="{{route('apartments.create')}}">Inserisci nuovo appartamento</a>
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
@endsection
