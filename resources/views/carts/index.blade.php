@extends('layouts.app')

@section('title', '| Shopping Cart')

@section('content')

    <h4>Shoppping cart</h4>

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