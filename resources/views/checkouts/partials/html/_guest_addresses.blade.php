<p class="flex justify-between mb-1">
    <span class="font-semibold">{{ $title }}</span>

    @if ($address == 'billing')
        <span>
            <input id="toggleShippingAddress" type="checkbox" class="form-check-input"
                onclick="toggleVisibility('#shippingAddress')" />
            <label class="form-check-label font-normal" for="toggleShippingAddress">
                Different shipping address
            </label>
        </span>
    @endif
</p>

<div class="add_address_form bg-white p-4 border border-gray-100">
    @include('checkouts.partials.forms._add_address',[
        'address' => $address
    ])
</div>