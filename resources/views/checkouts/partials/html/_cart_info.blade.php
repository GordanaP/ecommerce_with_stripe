<div class="bg-white border border-gray-100 flex justify-center items-center p-4">
    <i class="fa fa-5x fa-shopping-basket text-gray-600 mr-3" aria-hidden="true"></i>
    <span class="text-2xl font-semibold">{{ ShoppingCart::fromSession()->presentTotal() }}</span>
</div>