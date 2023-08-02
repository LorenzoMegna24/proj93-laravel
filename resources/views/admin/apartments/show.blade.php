@extends('layouts.app')

@section('title')
    {{$apartment->title}}
@endsection

@section('content')
    <div class="container">
        <div class="row">

            {{-- contenitore immagini e dati stanza --}}
            <div class="col-lg-5">
                @php
                    use Carbon\Carbon;
                    $now = now()->setTimezone('Europe/Rome');
                    $sponsor = $apartment->sponsors->sortByDesc('pivot.end_date')->first();
                    if ($sponsor) {
                        $end_date = Carbon::parse($sponsor->pivot->end_date, 'Europe/Rome');
                        $hours_left = $end_date->diffInHours($now);
                    }
                @endphp

                <h1 class="py-3">{{$apartment->title}}</h1>
                @if($sponsor)
                    <div class="alert alert-success" role="alert">
                        <h3>Sponsorizzazione attiva</h3>
                        <p><i>Il boost sarà attivo ancora per</i> {{ $hours_left }}h</p>
                    </div>
                @endif
                    


                <img style="width:100%;" class="rounded-3 shadow" src="{{asset('storage/' . $apartment->image)}}" alt="immagine">
                <div class="mt-3">
                    <span class="me-3"><i>{{$apartment->address}}</i></span>
                </div>

                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-6 mb-2"><strong>Stanze:</strong> {{$apartment->room}}</div>
                        <div class="col-6 mb-2"><strong>Bagni:</strong> {{$apartment->bathroom}}</div>
                        <div class="col-6 mb-2"><strong>Letti:</strong>{{$apartment->bed}}</div>
                        <div class="col-6 mb-2"><strong>Metri quadrati:</strong> {{$apartment->sq_meters ? $apartment->sq_meters : '-'}}</div>
                    </div>
                </div>

                <div class="my-3 ms-2"s>
                    <span>
                        <strong>Visibilità: </strong>
                        @if($apartment->visibility) 
                        si
                        @else
                        no
                        @endif  
                    </span>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="me-2 my-2 fw-bolder">Servizi:</div>
                        @foreach($apartment->amenities as $elem)
                        <div class="col-4 my-1 d-flex align-items-start">
                            <img class="me-3" src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 25px">
                            <p>{{$elem->name}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            

                <div class="d-flex mt-5">
                    <a class="btn btn-success" href="{{ url('profile/apartments') }}"><i class="fa-solid fa-arrow-left"></i> Le tue proprietà</a>
                    <a class="btn btn-primary mx-4" href="{{route('apartments.edit', $apartment)}}">Modifica</a>
                    <form id="formEliminate" action="{{route('apartments.destroy', $apartment)}}" method="POST" onsubmit="return showConfirmationModal(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>

            </div>
            <div class="col-lg-7">

                {{-- tabella messaggi --}}
                <aside class="mt-2">
                    
                    <h2 class="fs-3 py-3 ps-2">Messaggi</h2>
                    @if($apartment->messages->count() > 0)

                    <div class="">
                        <table class="table ms-2 table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" class="d-none d-md-table-cell">Nome</th>
                                    <th scope="col" class="d-none d-md-table-cell">Cognome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contenuto</th>
                                    <th scope="col" class="col-2 d-none d-sm-table-cell">data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apartment->messages as $elem)
                                <tr>
                                    <td  class="d-none d-md-table-cell">{{$elem->name}}</td>
                                    <td  class="d-none d-md-table-cell">{{$elem->surname}}</td>
                                    <td>{{$elem->mail}}</td>
                                    <td>{{$elem->content}}</td>
                                    <td class=" d-none d-sm-table-cell">{{$elem->date}}</td>
                                    <td>
                                        <form id="formEliminateMessage-{{ $elem->id }}" action="{{ route('message.destroy', $elem->id) }}" method="POST" onsubmit="return showConfirmationModalMessage(event, {{ $elem->id }})">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-3">Elimina</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h4>nessun messaggio per questo alloggio</h4>
                    @endif
                </aside>
    
            </div>
    
            {{-- modale di conferma eliminazione --}}
            <div class="modal" id="confirmationModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Conferma Eliminazione Proprietà</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di volerlo eliminare questa proprietà?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <button type="button" class="btn btn-danger" onclick="deleteApartment()">Elimina</button>
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- modale di conferma eliminazione per i messaggi --}}
            <div class="modal" id="confirmationModalMessage" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Conferma eliminazione del messaggio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di voler eliminare questo messaggio?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <button type="button" class="btn btn-danger" onclick="deleteMessage(window.messageId)">Elimina</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-column align-items-center alert alert-primary mt-5 w-75" role="alert">
                <h3 class="mt-3">Aggiungi un boost di visibilità al tuo b&b!</h3>    
                <a id="sponsor-button" class="btn btn-primary my-3" href="{{ route('token', ['apartment_id' => $apartment->id]) }}">Boost</a>    
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

@section('scripts')


    <script>
    const sponsorButton = document.querySelector('#sponsor-button');

    const errorMessage = document.querySelector('#error-message');


    // sponsorButton.addEventListener('click', function(event) {
    //     console.log('Click sul pulsante Sponsor');

    //     @if($apartment->sponsors->where('pivot.start_date', '<=', now()->setTimezone('Europe/Rome'))->where('pivot.end_date', '>=', now()->setTimezone('Europe/Rome'))->count() > 0)
    //         console.log('L\'appartamento è già sponsorizzato');

    //         event.preventDefault();

    //         errorMessage.style.display = 'block';
    //     @else
    //         console.log('L\'appartamento non è sponsorizzato');
    //     @endif
    // });

        // Funzione per mostrare il modal di conferma
        function showConfirmationModal(event) {
            event.preventDefault(); // Blocca l'invio del form

            const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'), {
                keyboard: false
            });

            confirmationModal.show();
        }

        // Funzione chiamata quando l'utente fa clic su "Elimina" nel modal
        function deleteApartment() {

            // Ora puoi eseguire l'invio del form
            const formElement = document.getElementById('formEliminate');
            formElement.submit();
        }

        //funzione di conferma eliminazione messaggio
        function showConfirmationModalMessage(event, messageId) {
        event.preventDefault(); // Blocca l'invio del form
            
        const confirmationModalMessage = new bootstrap.Modal(document.getElementById('confirmationModalMessage'), {
            keyboard: false
        });
    
        confirmationModalMessage.show();
    
        // Salva l'ID del messaggio da eliminare in una variabile globale
        window.messageId = messageId;
        }

        //funzione chiamata per eliminare il messaggio
        function deleteMessage(messageId) {
        // Ora puoi eseguire l'invio del form
        const formElementMessage = document.getElementById('formEliminateMessage-' + messageId);
        formElementMessage.submit();
        }

    </script>
@endsection
