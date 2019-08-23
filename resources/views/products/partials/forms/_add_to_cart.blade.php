<form action="{{ route('carts.store', $product) }}" method="POST">

    @csrf

    <button type="submit" class="btn btn-sm btn-block btn-primary uppercase tracking-wider">
        <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
    </button>

</form>