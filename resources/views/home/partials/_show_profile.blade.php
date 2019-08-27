<div class="card" style="height: 350px">
    <div class="text-lg p-3 border-b">
        <i class="fa fa-user-circle-o fa-lg  text-gray-600 mr-1"></i> My Profile
    </div>

    <div class="card-body text-lg">
        @include('customers.partials.html._show_details', [
            'customer' => Auth::user()->customer,
        ])
    </div>

    <div class="flex items-center p-3">
        <a href="{{ route('customers.edit', Auth::user()->customer) }}">Edit</a>

        <span class="mx-2">|</span>

        @include('customers.partials.forms._delete')
    </div>
</div>