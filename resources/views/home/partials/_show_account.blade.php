<div class="card" style="height: 350px;">
    <div class="text-lg p-3 border-b">
        <i class="fa fa-lock fa-lg text-gray-600 mr-1"></i> My Account
    </div>

    <div class="card-body text-lg">
        <p class="mb-1"><span class="font-medium">Name:</span> {{ Auth::user()->name }}</p>
        <p><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
    </div>

    <div class="flex items-center p-3">
        <a href="{{ route('users.edit', Auth::user()) }}">Edit</a>

        <span class="mx-2">|</span>

        @include('users.partials.forms._delete')
    </div>
</div>