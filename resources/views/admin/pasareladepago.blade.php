@extends('layouts.maintemplate')

@section('content')



@php
$stripe_key = 'pk_test_51MtFDXHX7PLXGa17B3zJkbU1CSfjbRSx52wgvWLJIcTTGttbHnp1W0HG25YoVBIfMn8G7v5hMJgRLmCNu1PkJiDp007ph3NLd1';
@endphp

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="">
                <p>Se le cobrará la cantidad de {{$amount_tmp}}</p>
            </div>
            <div class="card">
                <form action="{{route('checkout.credit-card')}}"  method="post" id="payment-form">
                    @csrf                    
                    <input type="hidden" name="amount" value="{{$amount_tmp}}">
                    <div class="form-group">
                        <div class="card-header">
                            <label for="card-element">
                                Ingrese la información de su tarjeta de crédito                            
                            </label>
                        </div>
                        <div class="card-body">
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                            <input type="hidden" name="plan" value="" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button
                            id="card-button"
                            class="btn btn-dark"
                            type="submit"
                            data-secret="{{ $intent }}"
                            > Pagar 
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  @endsection



@section('modal')

@endsection


@section('scripts')


    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
    
        const stripe = Stripe('{{ $stripe_key }}', { locale: 'es' }); // Create a Stripe client.
        const elements = stripe.elements(); // Create an instance of Elements.
        const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
    
        cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
    
        // Handle real-time validation errors from the card Element.
        cardElement.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    
        // Handle form submission.
        var form = document.getElementById('payment-form');
    
        form.addEventListener('submit', function(event) {
            event.preventDefault();
    
        stripe.handleCardPayment(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    form.submit();
                }
            });
        });
    </script>


@endsection