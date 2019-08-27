@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <h2 class="mb-0">
        Hi, {{ optional(Auth::user()->customer)->full_name ?: Auth::user()->name }}
    </h2>

    <hr>

    <div class="row">
        <div class="col-md-4">
            @include('home.partials._view_address_book')
        </div>
    </div>
@endsection

