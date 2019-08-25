@guest
    @if ($address == 'billing')
        <div class="form-group">
            <input type="text" id="{{ $address }}_email" placeholder="example@domain.com"
            class="form-control address_{{ $address }}_email">

            @error('address.'.$address.'.email')
                <span class="invalid-feedback" role="alert"></span>
            @enderror
        </div>
    @endif
@endguest

<div class="form-group">
    <input type="text" id="{{ $address }}_first_name" placeholder="First Name"
    class="form-control address_{{ $address }}_first_name">

    @error('address.'.$address.'.first_name')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>

<div class="form-group">
    <input type="text" id="{{ $address }}_last_name" placeholder="Last Name"
    class="form-control address_{{ $address }}_last_name">

    @error('address.'.$address.'.last_name')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>

<div class="form-group">
    <input type="text" id="{{ $address }}_street_address" placeholder="Street Address"
    class="form-control address_{{ $address }}_street_address">

    @error('address.'.$address.'.street_address')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>

<div class="form-group">
    <input type="text" id="{{ $address }}_postal_code" placeholder="Postal Code"
    class="form-control address_{{ $address }}_postal_code">

    @error('address.'.$address.'.postal_code')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>

<div class="form-group">
    <input type="text" id="{{ $address }}_city" placeholder="City"
    class="form-control address_{{ $address }}_city">

    @error('address.'.$address.'.city')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>

<div class="form-group">
    <select id="{{ $address }}_country" class="form-control address_{{ $address }}_country">
        <option>Select a country</option>
        @foreach (Country::all() as $country => $code)
            <option value="{{ $code }}">{{ $country }}</option>
        @endforeach
    </select>

    @error('address.'.$address.'.country')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>

<div class="form-group mb-0">
    <input type="text" id="{{ $address }}_phone" placeholder="Phone Number"
    class="form-control address_{{ $address }}_phone">

    @error('address.'.  $address.'.phone')
        <span class="invalid-feedback" role="alert"></span>
    @enderror
</div>