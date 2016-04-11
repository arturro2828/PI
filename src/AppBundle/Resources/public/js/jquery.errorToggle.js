(function ($) {

    $.fn.errorToggle = function (action, message) {

        var error = this;

        if (action == 'show') {
            error.parent().addClass('has-error');

            if (typeof message !== 'undefined') {
                error.text(message);
            }

            error.slideDown('fast', function () {

                error.off('click');
                error.on('click', function () {
                    error.animate({
                        opacity: 0,
                        height: 'toggle',
                        padding: 'toggle'
                    }, 200, 'swing', function () {
                        error.hide();
                        error.css('opacity', 1);
                        error.parent().removeClass('has-error');

                        var ok = true;
                        $('.alert-danger').each(function() {
                            if ($(this).is(':visible')) {
                                ok = false;
                            }
                        });

                        if (ok) {
                            $('#form-signin-heading').css('color', '#000');
                        } else {
                            $('#form-signin-heading').css('color', '#a94442');
                        }
                    });
                });

            });
        } else if (action == 'hide') {
            if (error.is(':visible')) {
                error.slideUp('fast', function () {
                    error.parent().removeClass('has-error');
                    error.text('');

                    $('body').trigger('after-validation');
                });
            }
        }

        return this;
    };

}(jQuery));


