<div class="mb-2">
    <span class="font-semibold mr-1">{{ $title }}</span>
    <a href="{{ $route ?? '' }}">Change</a>
</div>

<div class="customer-details bg-white p-4 border border-gray-100">
    @if ($default_delivery)
        <p class="mb-2">
            <span class="rounded-full text-xs tracking-wider uppercase
            bg-orange-500 text-white py-1 px-2 font-semibold">Default</span>
        </p>
    @endif

    <div class="text-gray-600">
        @include('customers.partials.html._show_details', [
            'customer' => $customer
        ])
    </div>
</div>