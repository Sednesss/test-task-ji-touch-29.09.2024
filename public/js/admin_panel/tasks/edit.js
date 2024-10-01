$(document).ready(function () {
    let pageAlerts = $('#notifications_section');

    pageAlerts.on('click', '.alert-error .close', closeAlertHandler);

    function closeAlertHandler() {
        $(this).closest('.alert-error').fadeOut('slow', function () {
            $(this).remove();
        });
    }
});