$(function () {
    var form = $('.form-deleting-account');

    var usernameError = $('#username-error');
    var deleteSuccess = $('#delete-success');
    deleteSuccess.hide();

    var deleteSuccess = $('#delete-success');
    deleteSuccess.hide();

    form.on('submit', function (event) {
        event.preventDefault();

        var isUsernameError = false;
        var username = form.find('#delete_account_username').val();


        if (username.length == 0) {
            isUsernameError = true;
            usernameError.parent().addClass('has-error');
            usernameError.text('Podaj nazwę użytkownika!');
            usernameError.show(500);
        }
        else if (username.length < 3) {
            isUsernameError = true;
            usernameError.parent().addClass('has-error');
            usernameError.text('Nazwa użytkownika musi zawierać co najmniej 3 znaki!');
            usernameError.show(500);
        }
        else if (username.length > 50) {
            isUsernameError = true;
            usernameError.parent().addClass('has-error');
            usernameError.text('Nazwa użytkownika może zawierać tylko 50 znaków!');
            usernameError.show(500);
        }
        else {
            usernameError.parent().removeClass('has-error');
            usernameError.hide(500, function () {
                usernameError.text('');
            });
        }

        if (!isUsernameError) {

            form.find('#delete_account_username').hide(500);
            form.find('.form-signin-heading').hide(500);
            form.find(':submit').hide(500);

            deleteSuccess.show(500);
            deleteSuccess.text('Pomyślnie wprowadzono dane');
            form.find('.username-hide').hide(500);

            form.off('submit');
            form.find('form').submit();
        }
    });

});

