// Stripe public key
var stripe = Stripe("{{ config('services.stripe.key') }}");

// Stripe Element
var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#cardElement');

// Stripe Payment Details
var cardholderName = document.querySelector('#cardholderName');
var cardButton = document.querySelector('#cardButton');
var checkoutStoreUrl = "{{ route('checkouts.store', $user) }}";

// Customer details
var hiddenAddress = document.querySelector('#shippingAddress');
var toggleHiddenAddressCheckbox = document.querySelector('#toggleShippingAddress');
var billingType = 'billing';
var shippingType = 'shipping';
var addressFields = [
    'email', 'first_name', 'last_name', 'street_address', 'postal_code',
    'city', 'country', 'phone'
];

clearServerSideErrorOnNewInput()

if(toggleHiddenAddressCheckbox)
{
    toggleHiddenAddressCheckbox.addEventListener('change', function(event) {
        if ( ! event.target.checked) {
            clearHiddenServerSideErrorsPureJS(hiddenAddress)
        }
    });
}

cardButton.addEventListener('click', function() {

    clearServerSideErrors()

    // Create paymentMethod id
    stripe.createPaymentMethod('card', cardElement, {
        billing_details: {name: cardholderName.value}
    })
    .then(function(result) {
        if(result.error) {
            console.log(result.error)
        } else {
            // Send paymentMethod id & customer details to the server
            var billingAddress = getAddress(billingType, addressFields);
            var shippingAddress = getAddress(shippingType, addressFields);
            var checkedAddress = getCheckedAddress(toggleHiddenAddressCheckbox, billingAddress, shippingAddress)

            $.ajax({
                url: checkoutStoreUrl,
                type: 'POST',
                data: {
                    payment_method_id: result.paymentMethod.id,
                    address: checkedAddress
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    displayServerSideErrors(errors)
                }
            })
            .then(function(response) {
                // Handle server response
                handleServerResponse(response)
            });
        }
    });
});

/**
 * Handle server response
 */
function handleServerResponse(response) {
    if (response.error) {
        console.log(response.error)
    } else if (response.requires_action) {
        // Create paymentIntent id
        stripe.handleCardAction(
            response.payment_intent_client_secret
        )
        .then(function(result) {
            if (result.error) {
                console.log(result.error)
            } else {
                // Send paymentIntent id back to server
                $.ajax({
                    url: checkoutStoreUrl,
                    type: 'POST',
                    data: {
                        payment_intent_id: result.paymentIntent.id
                    }
                })
                .then(function(confirmResult) {
                    return confirmResult;
                });
            }
        });
    } else {
        $('form').trigger('reset');
        window.location.replace(response.success)
    }
}