@extends('layouts.app')

@section('title')
    {{$apartment->title}}
@endsection

@section('content')
    <div class="container">
        <div class="d-flex">

            {{-- contenitore immagini e dati stanza --}}
            <div>
                    
                <h1>Appartamento: {{$apartment->title}}</h1>


                <img style="height: 300px" src="{{asset('storage/' . $apartment->image)}}" alt="immagine">
                
                
                <p>Stanze: {{$apartment->room}}</p>
                <p>Bagni: {{$apartment->bathroom}}</p>
                <p>Letti:{{$apartment->bed}}</p>
                <p>Metri quadrati: {{$apartment->sq_meters ? $apartment->sq_meters : '-'}}</p>
                <p>Indirizzo: {{$apartment->address}}</p>
                <p>Visibilità: 
                    @if($apartment->visibility) 
                    si
                    @else
                    no
                    @endif  
                </p>

                <p>Servizi:</p>
                @foreach($apartment->amenities as $elem)
                <img class="me-3" src="{{asset('storage/' . $elem->image)}}" alt="{{$elem->name}}" style="height: 20px" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$elem->name}}">
                @endforeach
            

                <div class="mt-3">
                <a class="btn btn-primary" href="{{route('apartments.edit', $apartment)}}">Modifica</a>
                </div>

                <form id="formEliminate" action="{{route('apartments.destroy', $apartment)}}" method="POST" onsubmit="return showConfirmationModal(event)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Elimina</button>
                </form>
                
            </div>

            {{-- tabella messaggi --}}
            <aside class="ms-5 mt-2">
                
                <h2 class="fs-3 fw-bold">Mesaggi per l'Appartamento</h2>
                @if($apartment->messages->count() > 0)
                    <table class="table ms-2">
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
        <div class="d-flex flex-column align-items-center">
            <p>Aggiungi un boost di visibilità al tuo appartamento!</p>
            <a class="btn btn-primary mb-3" href="{{route('token')}}">Sponsor</a>
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

        //funzioen di conferma eliminazione messaggio
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
