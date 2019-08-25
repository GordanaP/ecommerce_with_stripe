<!-- Billing Address -->
<div id="billingAddress">
    <p class="flex justify-between">
        <span class="font-semibold">Billing address</span>
        <span>
            <input id="toggleShippingAddress" type="checkbox" class="form-check-input"
                onclick="toggleVisibility('#shippingAddress')" />
            <label class="form-check-label font-normal" for="toggleShippingAddress">
                Different shipping address
            </label>
        </span>
    </p>

    <div class="bg-white p-4 border border-gray-100">
        @withProfile($user)
            <p class="mb-1 uppercase font-semibold">{{ $user->customer->full_name }}</p>
            <p class="mb-0 text-gray-600">{{ $user->customer->street_address }}</p>
            <p class="mb-0 text-gray-600">{{ $user->customer->zip_and_city }}</p>
            <p class="mb-0 text-gray-600">{{ $user->customer->country }}</p>
            <p class="mb-0 text-gray-600">tel: {{ $user->customer->phone }}</p>
        @else
            @include('checkouts.partials.forms._add_address', [
                'address' => 'billing'
            ])
        @endwithProfile
    </div>
</div>

<!-- Shipping Address -->
<div id="shippingAddress" class="mt-8 hidden">
    <p class="font-semibold">Shipping Address</p>
    <div class="bg-white p-4 border border-gray-100">
        @include('checkouts.partials.forms._add_address',
            ['address' => 'shipping'])
    </div>
</div>