@extends('layouts.app')

@section('content')

    <h1>Welcome to Integrate Stripe Payment Intent</h1>

    <hr>

    <p class="mt-2 text-lg">Pay With Stripe using Stripe JS, Elements & PaymentIntent Api</p>

    <a href="{{ route('products.index') }}" class="text-lg">
        Visit the online store
    </a>

@endsection