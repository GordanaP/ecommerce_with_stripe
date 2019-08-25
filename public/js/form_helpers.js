/**
 * Display server side errors.
 *
 * @param  array errors
 * @return none
 */
function displayServerSideErrors(errors)
{
    for (error in errors)
    {
        var formattedError = error.replace(/\./g , "_");

        var invalidField = $("."+formattedError).addClass('is-invalid');
        var invalidFeedback = '<span class="invalid-feedback">'+errors[error][0]+'</span>';

        invalidField.after(invalidFeedback)
    }
}

/**
 * Remove a server side error on new input.
 *
 * @return void
 */
function clearServerSideErrorOnNewInput()
{
    $("input, textarea").on('keypress', function() {
        clearServerSideError($(this))
    });

    $("select").on('change', function () {
        clearServerSideError($(this))
    });
}

/**
 * Clear server side errors.
 *
 * @return void
 */
function clearServerSideErrors()
{
    $(".is-invalid").removeClass('is-invalid');
    $(".invalid-feedback").remove();
}

/**
 * Clear the form fields.
 *
 * @return void
 */
function clearFormFields()
{
    $('form').trigger('reset');
}

/**
 * Show the SweetAlert2 confirmation dialogue.
 *
 * @param  string deleteRecordUrl
 * @param  string afterDeleteUrl
 * @return void
 */
function swalConfirmDelete(deleteRecordUrl, afterDeleteUrl)
{
    Swal.fire({
        title: 'Are you sure you want to delete the record?',
        text: 'You will not be able to recover the record!',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: '#718096',
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e53e3e',
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url: deleteRecordUrl,
                type: 'DELETE',
            })
            .done(function(response) {
                swalAlertBox(response.message)
                redirectTo(afterDeleteUrl)
            })
            .fail(function(xhr) {
                if(xhr.status == 403)
                {
                    var warningMessage = 'You are not authorized to perform this action.';

                    swalAlertBox(warningMessage, type="warning", title="Error!");
                }
            });
        }
    });
}

/**
 * Show the SweetAlert2 success dialogue box.
 *
 * @param  string message
 * @return void
 */
function swalAlertBox(message, type="success", title="Success!")
{
    Swal.fire(
        title,
        message,
        type,
    );
}

/**
 * The url to redirect to.
 *
 * @param  string redirectToUrl
 * @return void
 */
function redirectTo(url)
{
    window.location.replace(url)
}

/**
 * Remove a server side error.
 *
 * @param  JQ object field
 * @return void
 */
function clearServerSideError(field)
{
    field.removeClass('is-invalid');
    field.siblings(".invalid-feedback").remove();
}

/**
 * Clear hidden server side errors using pure JS.
 *
 * @param  JS Element object hiddenField
 * @return void
 */
function clearHiddenServerSideErrorsPureJS(hiddenField) {
    var invalidFeedbackFields = hiddenField.querySelectorAll('.invalid-feedback');
    var isInvalidFields = hiddenField.querySelectorAll('.is-invalid');
    var formFields = hiddenField.querySelectorAll('input');

    removeFields(invalidFeedbackFields)

    removeFieldsClass(isInvalidFields)

    removeFieldsValue(formFields)
}

/**
 * Clear hidden server side errors using JQuery
 *
 * @param  JQ object hiddenField
 * @return void
 */
function clearHiddenServerSideErrorsJQ(hiddenField) {
   hiddenField.find('.invalid-feedback').remove();
   hiddenField.find('.is-invalid').removeClass('is-invalid');
   hiddenField.find('input').val('')
}

/**
 * Remove the fields from the DOM.
 *
 * @param  array fields
 * @return void
 */
function removeFields(fields)
{
    for (i = 0; i < fields.length; i++) {
        var field = fields[i];
        field.parentNode.removeChild(field);
    }
}

/**
 * Remove the fields class.
 *
 * @param  array fields
 * @param  string fieldClass
 * @return void
 */
function removeFieldsClass(fields, fieldClass = 'is-invalid')
{
    for (i = 0; i < fields.length; i++) {
        var field = fields[i];
        field.classList.remove(fieldClass)
    }
}

/**
 * Remove the fields value.
 *
 * @param  array fields
 * @return void
 */
function removeFieldsValue(fields)
{
    for (i = 0; i < fields.length; i++) {
        var field = fields[i];
        field.value = ''
    }
}