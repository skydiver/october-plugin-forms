$(document).on('ajaxError', function(event, context) {
    if(context.responseJSON !== undefined) {
        var fields = context.responseJSON.error_fields;
        $.each(fields, function(index, value) {
            $("div[data-validate-for='" + index + "']").
                text(value).show().
                closest('.form-group').addClass('has-error');
        });
    }
});

$(document).on('ajaxPromise', '[data-request]', function() {
    $(this).closest('form').find('.form-group.has-error').removeClass('has-error');
});