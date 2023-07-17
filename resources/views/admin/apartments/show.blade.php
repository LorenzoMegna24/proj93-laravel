@extends('layouts.app')

@section('title')
    {{$apartment->title}}
@endsection

@section('content')
    <div class="container">
        <h1>Appartamento: {{$apartment->title}}</h1>
        <img style="height: 250px" src="{{asset('storage/' . $apartment->image)}}" alt="immagine">
        <p>stanze: {{$apartment->room}}</p>
        <p>bagni: {{$apartment->bathroom}}</p>
        <p>letti:{{$apartment->bed}}</p>
        <p>metri quadrati: {{$apartment->sq_meters}}</p>
        <p>indirizzo: {{$apartment->address}}</p>
        <p>visibilità: 
            @if($apartment->visibility) 
                si
                @else
                no
            @endif

        </p>
        @foreach($apartment->amenities as $elem)
           <img class="me-3" src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 20px">
        @endforeach
        <a class="btn btn-primary" href="{{route('apartments.edit', $apartment)}}">Modifica</a>

        <form action="{{route('apartments.destroy', $apartment)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Elimina</button>
        </form>
    </div>
@endsection
