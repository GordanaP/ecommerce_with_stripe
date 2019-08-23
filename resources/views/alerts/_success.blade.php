@if (Session::has('success'))
    <div class="alert alert-success text-center text-lg text-teal-900 tracking-wide" role="alert">
        {{ Session::get('success') }}
    </div>
@endif