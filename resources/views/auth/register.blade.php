@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm(this)">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                {{-- @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}"  autocomplete="surname" autofocus>

                                {{-- @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="birth_date" class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                            <div class="col-md-6">
                                <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}"  autocomplete="birth_date" autofocus>

                                {{-- @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
                            </div>
                        </div>  


                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-Mail*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                <span class="text-danger d-none" id="email-error">Inserire indirizzo email</span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                            
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                <span class="text-danger d-none" id="password-error">Inserire Password</span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                            </div>
                            
                        </div>
                        
                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password*') }}</label>
                            <div class="col-md-6">
                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                
                                <div id="password-confirm-error" class="invalid-feedback" style="display: none;">
                                    <strong>{{ __('Le password non coincidono') }}</strong>
                                </div>
                            </div>
                        </div>     
                        
                        
                        <span class="fs-6 fst-italic">* campi obbligatori</span>
                        
                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function validateForm(form) {
    // Seleziona i campi email, password e password_confirmation dal modulo
    const email = form.email.value;
    const password = form.password.value;
    const passwordConfirm = form.password_confirmation.value;

    // Verifica se il campo email è vuoto
    if (email === "") {
        // Mostra un messaggio di errore se il campo email è vuoto
        document.querySelector('#email-error').classList.remove('d-none');
        return false;
    } else {
        // Nascondi il messaggio di errore se il campo email non è vuoto
        document.querySelector('#email-error').classList.add('d-none');
    }

    // Verifica se il campo password è vuoto
    if (password === "") {
        // Mostra un messaggio di errore se il campo password è vuoto
        document.querySelector('#password-error').classList.remove('d-none');
        return false;
    } else {
        // Nascondi il messaggio di errore se il campo password non è vuoto
        document.querySelector('#password-error').classList.add('d-none');
    }

    // Confronta i valori dei campi password e password_confirmation
    if (password !== passwordConfirm) {
        // Mostra un messaggio di errore se i valori non sono uguali
        document.querySelector('#password-confirm-error').style.display = 'block';
        return false;
    } else {
        // Nascondi il messaggio di errore se i valori sono uguali
        document.querySelector('#password-confirm-error').style.display = 'none';
        return true;
    }
}

    $(document).ready(function() {
        $('#password-confirm').on('input', function() {
            
            if ($(this).val() !== $('#password').val()) {
                
                $('#password-confirm-error').show();
            } else {
                
                $('#password-confirm-error').hide();
            }
        });
    });

</script>

