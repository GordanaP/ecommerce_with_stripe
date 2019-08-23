@extends('layouts.app')

@section('title', '| Shopping Cart')

@section('content')

    <div class="flex justify-between items-center">
        <h4>Shoppping cart</h4>
        <a href="{{ route('checkouts.index', $user) }}" class="btn btn-primary">
            Checkout
        </a>
    </div>

    <hr>

    @include('alerts._success')

    @if (! ShoppingCart::fromSession()->isEmpty())

        @include('carts.partials.tables._table')

        <div class="flex justify-between items-center">
            <span>
                <a href="{{ route('products.index') }}">Continue shopping</a>
            </span>
            <span>
                @include('carts.partials.forms._empty_cart')
            </span>
        </div>
    @else
        <p>The shopping cart is empty.</p>
    @endif

@endsection