$(function () {
    var body = $('body');
    var form = $('.form-signin');
    var header = $('#form-signin-heading');

    var usernameInput = form.find('#username');
    var passwordInput = form.find('#password');
    var emailInput = form.find('#email');

    var usernameError = form.find('#username-error');
    var passwordError = form.find('#password-error');
    var emailError = form.find('#email-error');

    var ok = true;
    if (usernameError.is(':visible')) {
        usernameError.is(':visible').errorToggle('show');
        ok = false;
    }
    if (passwordError.is(':visible')) {
        passwordError.is(':visible').errorToggle('show');
        ok = false;
    }
   
    if (emailError.is(':visible')) {
        emailError.is(':visible').errorToggle('show');
        ok = false;
    }

    if (ok) {
        header.css('color', '#000');
    } else {
        header.css('color', '#a94442');
    }

    form.on('submit', function (event) {
        event.preventDefault();

        var username = usernameInput.val();
        var password = passwordInput.val();
        var email = emailInput.val();

        if (username.length == 0) {
            usernameError.errorToggle('show', 'Podaj nazwę użytkownika!');
        } else if (username.length < 3) {
            usernameError.errorToggle('show', 'Nazwa użytkownika musi zawierać conajmniej 3 znaki!');
        } else if (username.length > 50) {
            usernameError.errorToggle('show', 'Nazwa użytkownika może zawierać tylko 50 znaków!');
        } else {
            usernameError.errorToggle('hide');
        }

        if (password.length == 0) {
            passwordError.errorToggle('show', 'Podaj hasło!');
        } else if (password.length < 3) {
            passwordError.errorToggle('show', 'Hasło musi zawierać conajmniej 3 znaki!');
        } else if (password.length > 50) {
            passwordError.errorToggle('show', 'hasło może zawierać tylko 50 znaków!');
        } else {
            passwordError.errorToggle('hide');
        }

        if (email.length == 0) {
            emailError.errorToggle('show', 'Podaj email!');
        } else if (!/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9]{2,4}$/.test(email)) {
            emailError.errorToggle('show', 'Adres email nie jest prawidłowy!');
        } else {
            emailError.errorToggle('hide');
        }

        body.trigger('after-validation');
    });

    body.on('after-validation', function () {
        if (!usernameError.is(':visible') && !passwordError.is(':visible') && !emailError.is(':visible')) {
            header.css('color', '#000');
            form.off('submit');
            form.submit();
        } else {
            header.css('color', '#a94442');
        }
    });
});



