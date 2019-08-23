<div class="col-sm-6 col-md-3">
    <div class="card card-body">

        <div class="thumbnail">
             <img class="img-fluid img-thumbnail"
             src="https://source.unsplash.com/aob0ukAYfuI/400x300"
             alt="{{ $product->name }}">
        </div>

        <div class="caption">
            <h4 class="font-light">{{ $product->name }}</h4>

            <p class="font-medium">
                {{ $product->price_in_dollars }}
            </p>

            <p class="text-xs tracking-wide text-gray-600">
                {{ $product->description }}
            </p>

            @include('products.partials.forms._add_to_cart')
        </div>

    </div>
</div>