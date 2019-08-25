<script src="{{ asset('js/stripe_helpers.js') }}"></script>
<script src="{{ asset('js/form_helpers.js') }}"></script>
<script src="{{ asset('js/checkout_helpers.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('scripts')
