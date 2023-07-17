@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Inserisci un nuovo appartamento</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{route('apartments.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group my-2">
            <label class="form-label" for="">TITOLO</label>
            <input class="form-control" type="text" name="title">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">STANZE</label>
            <input class="form-control" name="room" type="number" min="1" max="20">
        </div>
        
        <div class="form-group my-2">
            <label class="form-label" for="">BAGNI</label>
            <input class="form-control" name="bathroom" type="number" min="1" max="10">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">POSTI LETTO</label>
            <input class="form-control" name="bed" type="number" min="1" max="40">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">METRI QUADRI</label>
            <input class="form-control" name="sq_meters" type="number" min="20" max="1000">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">INDIRIZZO</label>
            <input id="address" class="form-control" name="address" type="text">
            <ul id="address-list" class="list-group"></ul>
        </div>

        {{-- campo input file --}}
        <div class="form-group my-2">
            <label class="form-label" for="">CARICA IMMAGINE</label>
            <input class="form-control" type="file" name="image" aria-describedby="fileHelpId">
        </div>

        <div class="my-2 col-md-3">
            <label for="visibility" class="form-label">Visibile</label>
            <select class="form-select" name="visibility" aria-label="Default select example" style="width: 100px" required>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="form-group mb-3">
            @foreach ($amenities as $elem)
            <div class="form-check">
                <input class="form-check-input" 
                    type="checkbox" 
                    name="amenities[]"
                    value="{{$elem->id}}" 
                    id="apartments-checkbox-{{$elem->id}}">
                <img src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 20px">
                <label class="form-check-label" for="">{{$elem->name}}</label>
            </div>
            @endforeach
        </div>

        
        {{-- <div class="mb-3">
            <label for="" class="form-label">TYPE</label>
            <select class="form-select form-select-lg @error ('type_id') is-invalid @enderror" name="type_id" id="project-type">
                <option selected>Select one</option>

                @foreach ($types as $elem)

                <option value="{{$elem->id}}">{{$elem->name_type}}</option>
                    
                @endforeach

            </select>
            <div>
                @error('type_id')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>

        </div>

        <div class="form-groups d-flex justify-content-between">
            @foreach ($technologies as $elem)
                <div class="form-check">
                    <input class="form-check-input" 
                    type="checkbox" 
                    name="technologies[]"
                    value="{{ $elem->id }}" 
                    id="technology-{{ $elem->id }}">
                    <label class="form-check-label" for="technology-{{ $elem->id }}">
                        {{ $elem->name_technology }}
                    </label>
                </div>
            @endforeach
        </div> --}}

        {{-- <div class="form-group my-2">
            <label class="form-label" for="">SLUG</label>
            <input class="form-control" type="text" name="slug">
        </div> --}}

        <button type="submit" class="btn btn-success my-3">AGGIUNGI APPARTAMENTO</button>
    </form>   
</div>
@endsection
