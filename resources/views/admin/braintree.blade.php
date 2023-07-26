<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@extends('layouts.app')

@section('content')

<div class="py-12 boh">
    <div class="container d-flex justify-content-center">
        <form action="{{ route('token') }}" method="post">
            @csrf

            <select id="price">
                @foreach ($sponsors as $elem)
                    <option value="{{ $elem['price'] }}">{{ $elem['price'] }} € - {{ $elem['name'] }}</option>
                @endforeach
            </select>

            <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
        </form>
    </div>
    <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
    <div style="display: flex;justify-content: center;align-items: center; color: white">
        <a id="submit-button" class="btn btn-sm btn-success" data-braintree-nonce>
            <span class="ml-3">Submit payment</span>
        </a>
    </div>
    <script>
let button = document.querySelector('#submit-button');
let priceInput = document.getElementById('price');
let token = '{{$token}}';
braintree.dropin.create({
    authorization: token,
    container: '#dropin-container'
}, function (createErr, instance) {
    button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
            if (!err) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('token') }}",
                    data: {
                        nonce: payload.nonce,
                        price: priceInput.value,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        console.log('success', payload.nonce);
                    },
                    error: function (data) {
                        console.log('error', payload.nonce);
                    }
                });
            }
        });
    });
});
</script>

</div>
    
@endsection