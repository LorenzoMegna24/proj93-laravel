@extends('layouts.app')

@section('title')
    {{$apartment->title}}
@endsection

@section('content')
    <div class="container">
        <div class="row">

            {{-- contenitore immagini e dati stanza --}}
            <div class="col-lg-4">
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
                <div class="alert alert-success" role="alert">
                    @if($sponsor)
                        <h3>Appartamento sponsorizzato</h3>
                        <p><i>Ore rimanenti alla scadenza della sponsorizzazione:</i> {{ $hours_left }}h</p>
                    @endif
                </div>



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
                        <div class="col-4 my-1">
                            <img class="me-3" src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 25px" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$elem->name}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            

                <div class="d-flex mt-5">
                    <a class="btn btn-primary me-4" href="{{route('apartments.edit', $apartment)}}">Modifica</a>
                    <form id="formEliminate" action="{{route('apartments.destroy', $apartment)}}" method="POST" onsubmit="return showConfirmationModal(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>

            </div>
            <div class="col-lg-8">

                {{-- tabella messaggi --}}
                <aside class="ms-5 mt-2">
                    
                    <h2 class="fs-3 py-3 ps-2">Messaggi</h2>
                    @if($apartment->messages->count() > 0)

                    <div class="table-responsive">
                        <table class="table ms-2 table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cognome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contenuto</th>
                                    <th scope="col" class="col-2">data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($apartment->messages as $elem)
                                <tr>
                                    <td>{{$elem->name}}</td>
                                    <td>{{$elem->surname}}</td>
                                    <td>{{$elem->mail}}</td>
                                    <td>{{$elem->content}}</td>
                                    <td>{{$elem->date}}</td>
                                    <td>
                                        <form id="formEliminateMessage" action="{{route('message.destroy', $elem->id)}}" method="POST" onsubmit="return showConfirmationModalMessage(event)">
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
                        <h4>nessun messaggio per questo appartamento</h4>
                    @endif
                </aside>
    
            </div>
    
            {{-- modale di conferma eliminazione --}}
            <div class="modal" id="confirmationModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Conferma Eliminazione</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Sei sicuro di voler eliminare questo appartamento?
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
                            <button type="button" class="btn btn-danger" onclick="deleteMessage()">Elimina</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-column align-items-center alert alert-primary mt-5 w-75" role="alert">
                <h3 class="mt-3">Aggiungi un boost di visibilità al tuo appartamento!</h3>    
                <a id="sponsor-button" class="btn btn-primary my-3" href="{{ route('token', ['apartment_id' => $apartment->id]) }}">Boost</a>    
            </div> 
        </div>
        
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

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
        function showConfirmationModalMessage(event) {
            event.preventDefault(); // Blocca l'invio del form

            const confirmationModalMessage = new bootstrap.Modal(document.getElementById('confirmationModalMessage'), {
                keyboard: false
            });

            confirmationModalMessage.show();
        }

        //funzione chiamata per eliminare il messaggio
        function deleteMessage(){
            // Ora puoi eseguire l'invio del form
            const formElementMessage = document.getElementById('formEliminateMessage');
            formElementMessage.submit();
        }

    </script>
@endsection
