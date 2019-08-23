<form action="{{ route('carts.destroy', $item->id) }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn pt-0">
        <i class="fa fa-lg fa-trash"></i>
    </button>

</form>