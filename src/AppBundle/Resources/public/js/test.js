$(function () {
    var form = $('.form-signin');

    var usernameError = $('#username-error');
    usernameError.hide();

    var emailError = $('#email-error');
    emailError.hide();

    var passwordError = $('#password-error');
    passwordError.hide();

    var successBox = $('#signin-success');
    successBox.hide();

    var isUsernameError = false;
    var isEmailError = false;
    var isPasswordError = false;

    form.on('submit', function (event) {
        event.preventDefault();

        var username = form.find('#register_username').val();
        var email = form.find('#register_email').val();
        var password = form.find('#register_password').val();

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
        if (email.length == 0) {
            isEmailError = true;
            emailError.parent().addClass('has-error');
            emailError.text('Podaj email!');
            emailError.show(500);
        }
        else if (!/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9]{2,4}$/.test(email)) {
            isEmailError = true;
            emailError.parent().addClass('has-error');
            emailError.text('Adres email nie jest prawidłowy!');
            emailError.show(500);
        }
        else {
            emailError.parent().removeClass('has-error');
            emailError.hide(500, function () {
                emailError.text('');
            });
        }
        if (password.length == 0) {
            isPasswordError = true;
            passwordError.parent().addClass('has-error');
            passwordError.text('Podaj hasło!');
            passwordError.show(500);
        }
        else if (password.length < 3) {
            isPasswordError = true;
            passwordError.parent().addClass('has-error');
            passwordError.text('Hasło musi zawierać co najmniej 3 znaki!');
            passwordError.show(500);
        }
        else if (password.length > 50) {
            isPasswordError = true;
            passwordError.parent().addClass('has-error');
            passwordError.text('hasło może zawierać tylko 50 znaków!');
            passwordError.show(500);
        }
        else {
            passwordError.parent().removeClass('has-error');
            passwordError.hide(500, function () {
                passwordError.text('');
            });
        }

        if ((!isUsernameError) && (!isEmailError) && (!isPasswordError)) {

            form.find('#register_username').hide(500);
            form.find('#register_email').hide(500);
            form.find('#register_password').hide(500);

            form.find('.form-signin-heading').hide(500);
            form.find(':submit').hide(500);

            successBox.show(500);
            successBox.text('Pomyślnie zarejestrowano ');
            form.find('.username-hide').hide(500);
            form.find('.email-hide').hide(500);
            form.find('.password-hide').hide(500);
            

        }
            form.off('submit');
            form.submit();
    });

});




