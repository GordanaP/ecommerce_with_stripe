<div class="bg-white w-2/5 p-4 border border-gray-100 flex justify-center items-center">
    <i class="fa fa-5x fa-shopping-basket text-gray-600 mr-3" aria-hidden="true"></i>
    <span class="text-2xl font-semibold">{{ ShoppingCart::fromSession()->presentTotal() }}</span>
</div>

<div class="bg-white w-2/5 p-4 border border-gray-100">
    <p class="mb-1 uppercase font-semibold">{{ $user->customer->full_name }}</p>
    <p class="mb-0 text-gray-600">{{ $user->customer->street_address }}</p>
    <p class="mb-0 text-gray-600">{{ $user->customer->postal_code_city }}</p>
    <p class="mb-0 text-gray-600">{{ $user->customer->country }}</p>
    <p class="mb-0 text-gray-600">tel: {{ $user->customer->phone }}</p>
</div>