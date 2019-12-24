/**
 * POST the email to the API (will be saved in the database) and redirect to the sign-up page
 * we don't have to check (GET request) the email as it will have to be validated in the POST request anyway
 */
function submitEmail() {

    let errorMessage = '';

    const email = $('#email').val();

    // email cannot be empty
    if (!email) {
        errorMessage = 'Please enter your Email';
    } else if (! isValidEmailAddress(email)) { // regex validation
        errorMessage = 'Please enter a valid Email';
    }

    // display error message and interrupt POST
    if (errorMessage.length > 0) {
        errorMsg(errorMessage);
        $('#email').focus();
        return false;
    }

    //
    let formData = new Object();
    formData.email = email;

    // json payload
    const payload = JSON.stringify(formData);

    // the email will be validated against the database: if there's no conflict (409), go ahead
    $.ajax({
        url: '/api/emails',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json;charset=UTF-8;',
        processData: false,
        data: payload,
        success: function(data, textStatus, request){

            successMsg("Valid Email. Redirecting...");

            window.location.href = request.getResponseHeader('toUrl');

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {

            // Conflict (the email is already registered)
            if (XMLHttpRequest.status == 409) {

                displayCard2();
                return;

            }

            errorMsg('Internal Error');
            // this wouldn't be done at a production environment
            consoleLog('API Error (' + errorThrown + ') ' + XMLHttpRequest.responseText);
        }
    });

}

/**
 * Validate a given emailAddress
 * @param emailAddress
 * @returns {boolean}
 */
function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

/**
 * Hide one card and display the other
 * @param from
 * @param to
 */
function transitionCard(from, to) {
    $(`#card-${from}`).fadeOut('fast', function(){
        $(`#card-${to}`).fadeIn('fast');
    });
}

/**
 * Hide card 2 and display card 1
 */
function displayCard1() {
    transitionCard(2, 1);
}

/**
 * Hide card 1 and display card 2
 */
function displayCard2() {
    transitionCard(1, 2);
}


/**
 * display central notification
 * @param msg
 * @param classname
 */
function showMessage(msg, classname) {
    $('#email').notify(msg, { position:"top center", className:classname});
}

/**
 * central success notification
 * @param txt
 */
function successMsg(txt) {
    showMessage(txt, 'success');
}

/**
 * central error notification
 * @param txt
 */
function errorMsg(txt) {
    showMessage(txt, 'error');
}
