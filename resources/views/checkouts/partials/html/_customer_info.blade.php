<div id="billingAddress">
    @withProfile($user)
        @include('checkouts.partials.html._customer_addresses',[
            'title' => 'Billing address',
            'default_delivery' => '',
            'customer' => $user->customer
        ])
    @else
        @include('checkouts.partials.html._guest_addresses',[
            'title' => 'Billing address',
            'address' => 'billing'
        ])
    @endwithProfile
</div>

<div id="shippingAddress" class="@withProfile($user) '' @else hidden @endwithProfile mt-4">
    @withProfile($user)
        @include('checkouts.partials.html._customer_addresses',[
            'title' => 'Shipping address',
            'route' => route('users.select.shipping', $user),
            'default_delivery' => $default_delivery,
            'customer' => $shipping ?: ($default_delivery ?: $user->customer),
        ])
    @else
        @include('checkouts.partials.html._guest_addresses',[
            'title' => 'Shipping address',
            'address' => 'shipping'
        ])
    @endwithProfile
</div>