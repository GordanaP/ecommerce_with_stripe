@extends('layouts.app')

@section('title', '| Checkout')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('content')

    <h4>Checkout</h4>

    <hr>

    <section id="cartInfo" class="flex justify-center mb-4">
        @include('checkouts.partials._cart_info')
    </section>

    <section id="paymentInfo" class="w-2/5 mx-auto py-3 py-4 bg-gray-200 border border-gray-300">
        <div class="w-3/4 mx-auto">
            <p class="text-lg font-medium mt-0">Payment Information</p>

            <div class="form-group">
                <label for="cardholderName">Cardholder Name</label>
                <input  type="text" class="form-control" placeholder="Name on card"
                 id="cardholderName">
            </div>

            <div class="form-group">
                <label>Card Details</label>
                <div id="cardElement">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
            </div>

            <button type="button" class="btn btn-primary btn-block mt-2"
                id="cardButton">
                Make a secure payment
            </button>
        </div>
    </section>

@endsection

@section('scripts')
    <script>

        // Stripe public key
        var stripe = Stripe("{{ config('services.stripe.key') }}");

        // Stripe Element
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#cardElement');

    </script>
@endsection