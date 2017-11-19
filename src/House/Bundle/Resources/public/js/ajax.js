$(document).ready(function($) {
    $('body').on('submit', '.ajaxForm', function (e) {
        e.preventDefault();
        $('form button').attr("disabled", "disabled");
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize()
        }).done(function (data, status) {
            $('form').trigger('reset');
            if ((data['success'] = 'success') && ((status = 'success'))) {
                $('form button[type="submit"]').after(
                    '<div class="alert alert-success" role="alert">' +
                        '<strong>Thank you!</strong> You will be contacted soon.' +
                    '</div>'
                );
            } else {
                $('form button[type="submit"]').after(
                    '<div class="alert alert-error" role="alert">' +
                        '<strong>There were problems.</strong> Try again later.' +
                    '</div>'
                );
            }
            $('form button').removeAttr("disabled", "disabled");
            setTimeout(function () {
                $('.alert').fadeOut('fast')
            }, 3000);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
                }
                $('.form_error').html(jqXHR.responseJSON.message);
            } else {
                alert(errorThrown);
            }
            $('form button').removeAttr("disabled", "disabled");
        });
    });
});