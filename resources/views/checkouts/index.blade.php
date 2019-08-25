@extends('layouts.app')

@section('title', '| Checkout')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
@endsection

@section('content')

    <h4>Checkout</h4>

    <hr>

    <section id="cartInfo" class="flex justify-center mb-4">
        @include('checkouts.partials.html._cart_info')
    </section>

    <section id="paymentInfo" class="w-2/5 mx-auto py-3 py-4 bg-gray-200 border border-gray-300">
        @include('checkouts.partials.html._payment_info')
    </section>

@endsection

@section('scripts')
    <script>

        @include('checkouts.partials.js._stripe_payment')

    </script>
@endsection