<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
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

    <span class="fs-6 fst-italic">* campi obbligatori</span>
    <form action="{{route('apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(this)">

        @csrf
        @method('PUT')

        <div class="form-group my-2">
            <label class="form-label" for="">TITOLO *</label>
            <input class="form-control" type="text" name="title" value="{{old('title') ?? $apartment->title}}">
            <span class="text-danger d-none" id="title-error">Inserisci un titolo</span>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">STANZE *</label>
            <input class="form-control" name="room" type="number" min="1" max="20" value="{{old('room') ?? $apartment->room}}">
            <span class="text-danger d-none" id="room-error">Inserisci un numero di stanze</span>
        </div>
        
        <div class="form-group my-2">
            <label class="form-label" for="">BAGNI *</label>
            <input class="form-control" name="bathroom" type="number" min="1" max="10" value="{{old('bathroom') ?? $apartment->bathroom}}">
            <span class="text-danger d-none" id="bathroom-error">Inserisci un numero di bagni</span>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">POSTI LETTO *</label>
            <input class="form-control" name="bed" type="number" min="1" max="40" value="{{old('bed') ?? $apartment->bed}}">
            <span class="text-danger d-none" id="bed-error">Inserisci un numero di posti letto</span>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">METRI QUADRI</label>
            <input class="form-control" name="sq_meters" type="number" min="20" max="1000" value="{{old('sq_meters') ?? $apartment->sq_meters}}">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">MODIFICA INDIRIZZO *</label>
            <input id="address" class="form-control" name="address" type="text" value="{{old('address') ?? $apartment->address}}" placeholder="Scrivi l'indirizzo del tuo appartamento" autocomplete="off">
            <span class="text-danger d-none" id="address-error">Seleziona un indirizzo valido dalla lista suggerita</span>
        </div>

        {{-- campo input file --}}
        <div class="form-group my-2">
            <label class="form-label" for="">MODIFICA IMMAGINE</label>
            <input class="form-control" type="file" name="image" aria-describedby="fileHelpId" value="{{old('image') ?? $apartment->image}}">
        </div>
        <div class="form-group my-2">
            <label class="form-label" for="">IMMAGINE CARICATA</label>
            <img class="d-flex" style="height: 250px" src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine appartamento">
        </div>


        <div class="my-2 col-md-3">
            <label for="visibility" class="form-label">VISIBILITÀ APPARTAMENTO</label>
            <select class="form-select" name="visibility" aria-label="Default select example" style="width: 100px" required>
                <option value="1" @if($apartment->visibility == 1) selected @endif>Si</option>
                <option value="0" @if($apartment->visibility == 0) selected @endif>No</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-label" for="">SERVIZI *</label>
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
            <span class="text-danger d-none" id="amenities-error">Seleziona almeno un servizio</span>
        </div>

        <button type="submit" class="btn btn-success my-3">MODIFICA APPARTAMENTO</button>
    </form>   
</div>
@endsection

    
<script>  

    function validateForm(form) {
        // Nascondi tutti i messaggi di errore
        document.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

        // Verifica che tutti i campi richiesti siano compilati
        if (form.title.value == "") {
            document.querySelector('#title-error').classList.remove('d-none');
            return false;
        }
        if (form.room.value == "") {
            document.querySelector('#room-error').classList.remove('d-none');
            return false;
        }
        if (form.bathroom.value == "") {
            document.querySelector('#bathroom-error').classList.remove('d-none');
            return false;
        }
        if (form.bed.value == "") {
            document.querySelector('#bed-error').classList.remove('d-none');
            return false;
        }

        const userInput = form.address.value.trim().toLowerCase();
        const suggestedAddresses = $("#address").autocomplete("option", "source").map(address => address.toLowerCase());
        if (form.address.value === "" || !suggestedAddresses.includes(userInput)) {
            document.querySelector('#address-error').classList.remove('d-none');
            return false;
        }

        let amenitiesChecked = false;
        form.querySelectorAll('[name="amenities[]"]').forEach(el => {
            if (el.checked) amenitiesChecked = true;
        });
        if (!amenitiesChecked) {
            document.querySelector('#amenities-error').classList.remove('d-none');
            return false;
        }

        // Se tutti i controlli sono superati, restituisci true per consentire l'invio del modulo
        return true;
    }


</script>