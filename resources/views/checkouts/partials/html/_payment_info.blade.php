<div class="w-3/4 mx-auto">

    <p class="text-lg font-medium mt-0">Payment Information</p>

    <div class="form-group">
        <label for="cardholderName">Cardholder Name</label>
        <input  type="text" class="form-control" placeholder="Name on card"
         id="cardholderName">
    </div>

    <div class="form-group">
        <label>Card Details</label>
        <div id="cardElement">
            <!-- A Stripe Element will be inserted here. -->
        </div>
    </div>

    <button type="button" class="btn btn-primary btn-block mt-2"
        id="cardButton">
        Make a secure payment
    </button>

</div>