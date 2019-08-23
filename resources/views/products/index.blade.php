@extends('layouts.app')

@section('title', ' | Online Store')

@section('content')

    <h4>Our Products</h4>

    <hr>

    @include('alerts._success')

    @forelse ($products->chunk(4) as $chunk)
        <div class="row mb-8">
            @foreach ($chunk as $product)
                @include('products.partials._product')
            @endforeach
        </div>
    @empty
        <p>There are no products at present.</p>
    @endforelse

@endsection