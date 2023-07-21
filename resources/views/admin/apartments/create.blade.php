<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
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

    <span class="fs-6 fst-italic">* campi obbligatori</span>
    <form action="{{route('apartments.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(this)">

        @csrf

        <div class="form-group my-2">
            <label class="form-label" for="">TITOLO *</label>
            <input class="form-control" type="text" name="title">
            <span class="text-danger d-none" id="title-error">Inserisci un titolo</span>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">STANZE *</label>
            <input class="form-control" name="room" type="number" min="1" max="20">
            <span class="text-danger d-none" id="room-error">Inserisci un numero di stanze</span>
        </div>
        
        <div class="form-group my-2">
            <label class="form-label" for="">BAGNI *</label>
            <input class="form-control" name="bathroom" type="number" min="1" max="10">
            <span class="text-danger d-none" id="bathroom-error">Inserisci un numero di bagni</span>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">POSTI LETTO *</label>
            <input class="form-control" name="bed" type="number" min="1" max="40">
            <span class="text-danger d-none" id="bed-error">Inserisci un numero di posti letto</span>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">METRI QUADRI</label>
            <input class="form-control" name="sq_meters" type="number" min="20" max="1000">
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="">INDIRIZZO *</label>
            <input id="address" class="form-control" name="address" type="text" value="Scrivi l'indirizzo del tuo appartamento" autocomplete="off">
            <span class="text-danger d-none" id="address-error">Seleziona un indirizzo valido dalla lista suggerita</span>
        </div>

        {{-- campo input file --}}
        <div class="form-group my-2">
            <label class="form-label" for="">CARICA IMMAGINE *</label>
            <input class="form-control" type="file" name="image" aria-describedby="fileHelpId">
            <span class="text-danger d-none" id="image-error">Carica una immagine del tuo appartamento</span>
        </div>

        <div class="my-2 col-md-3">
            <label for="visibility" class="form-label">VISIBILITÀ APPARTAMENTO *</label>
            <select class="form-select" name="visibility" aria-label="Default select example" style="width: 100px" required>
                <option value="1">Si</option>
                <option value="0">No</option>
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
                    id="apartments-checkbox-{{$elem->id}}">
                <img src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 20px">
                <label class="form-check-label" for="">{{$elem->name}}</label>
            </div>
            @endforeach
            <span class="text-danger d-none" id="amenities-error">Seleziona almeno un servizio</span>
        </div>

        <button type="submit" class="btn btn-success my-3">AGGIUNGI APPARTAMENTO</button>
    </form>   
</div>
@endsection

<script>
    
    function validateForm(form) {
        // Nascondi tutti i messaggi di errore
        document.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

        // Verifica che tutti i campi richiesti siano compilati
        if (form.title.value == "" || form.title.value.length < 4) {
        document.querySelector('#title-error').textContent = 'Inserisci un titolo di almeno 4 caratteri';
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

        if (!form.image.value) {
        document.querySelector('#image-error').classList.remove('d-none');
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
