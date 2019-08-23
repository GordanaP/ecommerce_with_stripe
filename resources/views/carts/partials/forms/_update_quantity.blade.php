<form action="{{ route('carts.update', $item->id) }}" method="POST">

    @csrf
    @method('PATCH')

    <div class="mx-auto flex">
        <div class="form-group">
            <input type="text" name="quantity" id="quantity"
                class="form-control text-center"
                value="{{ $item->quantity }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn">
                <i class="fa fa-refresh"></i>
            </button>
        </div>
    </div>

</form>