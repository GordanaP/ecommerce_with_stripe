@if (Session::has('success'))
    <div class="alert alert-success text-center text-lg text-teal-900 tracking-wide" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-center text-lg text-teal-900 tracking-wide" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif