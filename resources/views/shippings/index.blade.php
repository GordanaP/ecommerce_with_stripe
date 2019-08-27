@extends('layouts.app')

@section('title', 'Address Book')

@section('content')

    <h2 class="mb-0">My Address Book</h2>
    <hr>

    @withProfile($user)
        <section id="addressBook">
            @foreach ($user->getAddressBook()->chunk(3) as $chunk)
                <div class="row mb-4">
                    @foreach ($chunk as $address)
                        <div class="col-md-4">
                            @include('shippings.partials.html._show_address', [
                                'customer' => $address,
                            ])
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p>Your address book is empty at present.</p>
        </section>
    @endwithProfile

@endsection