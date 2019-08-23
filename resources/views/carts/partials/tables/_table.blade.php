<table class="table bg-white">
    <thead>
        <th width="15%">Item</th>
        <th width="25%"></th>
        <th class="text-center" width="20%">Price</th>
        <th class="text-center" width="15%">Qty</th>
        <th class="text-right" width="15%">Subtotal</th>
        <th class="text-right"><i class="fa-fa-cog"></i></th>
    </thead>

    <tbody>
        @if (! ShoppingCart::fromSession()->isEmpty())
            @foreach ($cartItems as $item)
                @include('carts.partials.tables._row_item')
            @endforeach
        @else
            Your cart is empty at present.
        @endif

        @include('carts.partials.tables._row_price')

    </tbody>
</table>