@extends('layouts.app')

@section('title', '| Checkout')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('content')

    <h4>Checkout</h4>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <section id="customerInfo"">
                @include('checkouts.partials.html._customer_info')
            </section>
        </div>

        <div class="col-md-6">
            <section id="cartInfo" class="mb-2">
                @include('checkouts.partials.html._cart_info')
            </section>

            <section id="paymentInfo" class="mx-auto py-3 py-4 bg-gray-200 border border-gray-300">
                @include('checkouts.partials.html._payment_info')
            </section>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        @include('checkouts.partials.js._stripe_payment')

    </script>
@endsection