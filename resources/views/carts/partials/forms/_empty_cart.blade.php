<form action="{{ route('carts.empty') }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">Empty cart</button>

</form>