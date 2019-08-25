/**
 * Get the checked address.
 *
 * @param  array billingAddress
 * @param  array shippingAddress
 * @return array
 */
function getCheckedAddress(checkbox, billingAddress, shippingAddress)
{
    if (isChecked(checkbox)) {
        var address = {
            billing: billingAddress,
            shipping: shippingAddress
        }
    } else {
        var address = {
            billing: billingAddress,
        }
    }

    return address;
}

/**
 * Get the checkout addresses.
 *
 * @param  string addressType
 * @param  array adressFields
 * @return array
 */
function getAddress(addressType, addressFields)
{
    var address = { };

    $.each(addressFields, function(index, fieldName) {

        var fieldId = addressType+'_'+fieldName;

        if(getById(fieldId))
        {
            address[fieldName] = getById(fieldId).value;
        }
    });

    return address;
}

/**
 * Get the address field.
 *
 * @param  string fieldId
 * @return JS Elements Object
 */
function getById(fieldId)
{
    return document.getElementById(fieldId);
}

/**
 * Toggle hidden field visibility.
 *
 * @param  {string} fieldId
 * @return void
 */
function toggleVisibility(fieldId)
{
    return $(fieldId).toggle();
}

/**
 * Determine if a checkobox is checked.
 *
 * @param  string  checkboxId
 * @return boolean
 */
function isChecked(checkboxId)
{
    return $(checkboxId).prop('checked') == true;
}