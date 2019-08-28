<form action="{{ route('users.shippings.update', $user->isBillingAddress($address)
    ? $user : [$user, $address]) }}" method="POST">

    @csrf
    @method('PATCH')

    <button type="submit" class="btn btn-link p-0">Set as default</button>
</form>