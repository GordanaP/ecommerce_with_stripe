/**
 * Get the checked address.
 *
 * @param  string billing
 * @param  array addressFields
 * @return array
 */
function getCheckedAddress(checkbox, billing, shipping, addressFields)
{
    var address = {
        'billing': getAddress(billing, addressFields)
    };

    if (isChecked(checkbox)) {
        address['check_delivery'] = 'on';
        address['shipping'] = getAddress(shipping, addressFields);
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
function toggleHiddenFieldVisibility(fieldId)
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