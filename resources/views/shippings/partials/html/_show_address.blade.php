<div class="card shadow" style="height: 350px">
    <div class="card-body text-lg">
        <div id="addressFeature" class="flex mb-3">
            @if ($user->isBillingAddress($address))
                <span class="mr-2 rounded-full text-xs tracking-wider uppercase bg-indigo-500 text-white py-1 px-2 font-semibold">Billing</span>
            @endif

            @if ($address->is_default)
                <span  class="rounded-full text-xs tracking-wider uppercase bg-orange-500 text-white py-1 px-2 font-semibold">Default</span>
            @endif
        </div>

        <div class="address-details">
            @include('customers.partials.html._show_details', [
                'customer' => $address
            ])
        </div>
    </div>

    <div id="addressActionLinks" class="flex items-center p-3">
        @if ($user->isNotBillingAddress($address))
            <a href="#" class="text-blue-600">Edit</a>

            <span class="mx-2">|</span>

            @include('shippings.partials.forms._delete')
        @endif

        @if (! $address->is_default && $user->isNotBillingAddress($address))
            <span class="mx-2">|</span>
        @endif

        @if (! $address->is_default)
            @include('shippings.partials.forms._set_as_default')
        @endif
    </div>
</div>

@if (request()->route()->named('users.select.shipping'))
    <div id="selectDeliveryAddress" class="shadow">
        <a href="{{ route('checkout.users.shippings.index', [$user, $user->isNotBillingAddress($address) ? $address->id : '']) }}" style="text-decoration: none !important">
            <div class="border hover:bg-gray-300 text-center text-lg text-blue-800 py-2 w-full">
                Deliver to this address
            </div>
        </a>
    </div>
@endif