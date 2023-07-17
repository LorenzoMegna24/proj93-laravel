@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Modifica l'appartamento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{route('apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group my-2">
            <label class="form-label" for="">TITOLO</label>
            <input class="form-control" type="text" name="title" value="{{old('title') ?? $apartment->title}}">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">STANZE</label>
            <input class="form-control" name="room" type="number" min="1" max="20" value="{{old('room') ?? $apartment->room}}">
        </div>
        
        <div class="form-group my-2">
            <label class="form-label" for="">BAGNI</label>
            <input class="form-control" name="bathroom" type="number" min="1" max="10" value="{{old('bathroom') ?? $apartment->bathroom}}">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">POSTI LETTO</label>
            <input class="form-control" name="bed" type="number" min="1" max="40" value="{{old('bed') ?? $apartment->bed}}">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">METRI QUADRI</label>
            <input class="form-control" name="sq_meters" type="number" min="20" max="1000" value="{{old('sq_meters') ?? $apartment->sq_meters}}">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">INDIRIZZO</label>
            <input class="form-control" name="address" type="text" value="{{old('address') ?? $apartment->address}}">
        </div>

        {{-- campo input file --}}
        <div class="form-group my-2">
            <label class="form-label" for="">CARICA IMMAGINE</label>
            <input class="form-control" type="file" name="image" aria-describedby="fileHelpId" value="{{old('image') ?? $apartment->image}}">
        </div>

        <div class="form-check form-switch">
            <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
            <input class="form-check-input" name="visibility" value="1" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
        </div>

        <div class="form-group mb-3">
            @foreach ($amenities as $elem)
            <div class="form-check">
                <input class="form-check-input" 
                    type="checkbox" 
                    name="amenities[]"
                    value="{{$elem->id}}" 
                    id="apartments-checkbox-{{$elem->id}}"
                    @if(in_array($elem->id, $apartment->amenities->pluck('id')->toArray())) checked @endif>
                <img src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 20px">
                <label class="form-check-label" for="">{{$elem->name}}</label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success my-3">MODIFICA APPARTAMENTO</button>
    </form>   
</div>
@endsection