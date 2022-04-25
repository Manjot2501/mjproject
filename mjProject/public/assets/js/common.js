// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

//////////////////////////////////////////////////////////////////
// These are functions in global scope hence not defined in .ready
//////////////////////////////////////////////////////////////////
/* wrapper function to make the ajax call
 * if output contains redirect parameter then it will be redirected to the page
 * url : contains the redirect url
 * data : contains the post parameters
 * actionFunction contains the response function
 */
var requestNewUrl;

function __ajax(url, data, actionFunction, loadIcon) {
    requestNewUrl = url;
    $.ajax({
        url: url,
        data: data,
        type: 'post',
        dataType: "json",
        beforeSend: function () {
            if (loadIcon === 1) {
                //to do loading
                $('.mj-loading').show();
            }
        },
        complete: function () {
            $('.mj-loading').hide();
        },
        success: function (output) {

            if (output.redirect) {
                // data.redirect contains the string URL to redirect to
                window.location.href = output.redirect;
            } else {
                //this is the function defined for the action
                actionFunction(output);
            }
        }
    });
}
