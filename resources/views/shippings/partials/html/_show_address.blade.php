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
</div>