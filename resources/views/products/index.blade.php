@extends('layouts.app')

@section('title', ' | Online Store')

@section('content')

    <header>
        <h4>Our Products</h4>
        <hr>
    </header>

    <main>
        @forelse ($products->chunk(4) as $chunk)
            <div class="row mb-8">
                @foreach ($chunk as $product)
                    @include('products.partials._product')
                @endforeach
            </div>
        @empty
            <p>There are no products at present.</p>
        @endforelse
    </main>

@endsection