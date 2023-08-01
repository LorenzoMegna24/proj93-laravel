<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@extends('layouts.app')

@section('content')
<div class="container w-75">

    <h1 class="mb-4">Modifica la tua proprietà</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <span class="fs-6 fst-italic alert alert-danger p-2">* campi obbligatori</span>
    <form action="{{route('apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(this)">

        @csrf
        @method('PUT')

        <div class="form-group my-3">
            <label class="form-label" for="">TITOLO *</label>
            <input class="form-control" type="text" name="title" value="{{old('title') ?? $apartment->title}}">
            <strong class="text-danger d-none" id="title-error">Inserisci un titolo</strong>
        </div>

        <div class="form-group my-3">
            <label class="form-label" for="">STANZE *</label>
            <input class="form-control" name="room" type="number" min="1" max="20" value="{{old('room') ?? $apartment->room}}">
            <strong class="text-danger d-none" id="room-error">Inserisci un numero di stanze</strong>
        </div>
        
        <div class="form-group my-3">
            <label class="form-label" for="">BAGNI *</label>
            <input class="form-control" name="bathroom" type="number" min="1" max="10" value="{{old('bathroom') ?? $apartment->bathroom}}">
            <strong class="text-danger d-none" id="bathroom-error">Inserisci un numero di bagni</strong>
        </div>

        <div class="form-group my-3">
            <label class="form-label" for="">POSTI LETTO *</label>
            <input class="form-control" name="bed" type="number" min="1" max="40" value="{{old('bed') ?? $apartment->bed}}">
            <strong class="text-danger d-none" id="bed-error">Inserisci un numero di posti letto</strong>
        </div>

        <div class="form-group my-3">
            <label class="form-label" for="">METRI QUADRI</label>
            <input class="form-control" name="sq_meters" type="number" min="20" max="1000" value="{{old('sq_meters') ?? $apartment->sq_meters}}">
        </div>

        <div class="form-group my-3">
            <label class="form-label" for="">MODIFICA INDIRIZZO *</label>
            <input id="address" class="form-control" name="address" type="text" value="{{old('address') ?? $apartment->address}}" placeholder="Scrivi l'indirizzo del tuo appartamento" autocomplete="off">
            <ul class="list-group box-list" id="address-list"></ul>
            <strong class="text-danger d-none" id="address-error">Seleziona un indirizzo valido dalla lista suggerita</strong>
        </div>

        {{-- campo input file --}}
        <div class="form-group my-3">
            <label class="form-label" for="">MODIFICA IMMAGINE</label>
            <input class="form-control" type="file" name="image" aria-describedby="fileHelpId" value="{{old('image') ?? $apartment->image}}">
        </div>
        <div class="form-group my-3">
            <label class="form-label" for="">IMMAGINE CARICATA</label>
            <img class="d-flex anteprima" src="{{ asset('storage/' . $apartment->image) }}" alt="Immagine appartamento">
        </div>


        <div class="my-3 col-md-3">
            <label for="visibility" class="form-label">VISIBILITÀ</label>
            <select class="form-select" name="visibility" aria-label="Default select example" style="width: 100px" required>
                <option value="1" @if($apartment->visibility == 1) selected @endif>Si</option>
                <option value="0" @if($apartment->visibility == 0) selected @endif>No</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <div>
                <label class="form-label" for="">SERVIZI *</label>
            </div>
            @foreach ($amenities as $elem)
            <div class="form-check form-check-inline mb-3">
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
            <strong class="text-danger d-none" id="amenities-error">Seleziona almeno un servizio</strong>
        </div>

        <button type="submit" class="btn btn-success my-3">MODIFICA</button>
        <a type="button" href="{{ route('apartment.show', ['apartment' => $apartment->id]) }}" class="btn btn-danger ms-3">ANNULLA</a>
    </form>   
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

    
<script>  

function validateForm(form) {
    // Nascondi tutti i messaggi di errore
    document.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

    let isValid = true;

    // Verifica che tutti i campi richiesti siano compilati
    if (form.title.value == "" || form.title.value.length < 4) {
        document.querySelector('#title-error').textContent = 'Inserisci un titolo di almeno 4 caratteri';
        document.querySelector('#title-error').classList.remove('d-none');
        isValid = false;
    }
    if (form.room.value.trim() === "") {
        document.querySelector('#room-error').classList.remove('d-none');
        isValid = false;
    }
    if (form.bathroom.value.trim() === "") {
        document.querySelector('#bathroom-error').classList.remove('d-none');
        isValid = false;
    }
    if (form.bed.value.trim() === "") {
        document.querySelector('#bed-error').classList.remove('d-none');
        isValid = false;
    }

    const userInput = form.address.value.trim().toLowerCase();
    const suggestedAddresses = Array.from(document.querySelectorAll('#address-list li')).map(li => li.textContent.toLowerCase());

    if (form.address.value.trim() === "" || (suggestedAddresses.length > 0 && !suggestedAddresses.includes(userInput))) {
        document.querySelector('#address-error').classList.remove('d-none');
        isValid = false;
    }

    let amenitiesChecked = false;
    form.querySelectorAll('[name="amenities[]"]').forEach(el => {
        if (el.checked) amenitiesChecked = true;
    });
    if (!amenitiesChecked) {
        document.querySelector('#amenities-error').classList.remove('d-none');
        isValid = false;
    }

    // Se tutti i controlli sono superati, restituisci true per consentire l'invio del modulo
    return isValid;
}


</script>