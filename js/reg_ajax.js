var error_message = '';

function checkLogin(login) {
    if(login.length < 6) {
        error_message += 'Login must be at least 6 characters long\n';
        return false;
    }
    return true;
}

function checkPassword(password, confirm_password) {
    if(password !== confirm_password) {
        error_message += 'Passwords do not match\n';
        return false;
    }
    if(password.length < 6) {
        error_message += 'Password must be at least 6 characters long\n';
        return false;
    }
    if(!/^[A-Za-z0-9]*$/.test(password)) {
        error_message += 'Password should contain both letters and numbers\n';
        return false;
    }
    return true;
}

function checkEmail(email) {
    if(!String(email).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
        error_message += 'Please enter the correct email\n';
        return false;
    }
    return true;
}

function checkName(name) {
    if(name.length < 2) {
        error_message += 'Name must be at least 2 characters long\n';
        return false;
    }
    if(!/^[a-z]+$/i.test(name)) {
        error_message += 'Name should contain only letters\n';
        return false;
    }
    return true;
}

$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();

        error_message = '';

        var login = $('#login').val().trim();
        var password = $('#password').val().trim();
        var confirm_password = $('#confirm_password').val().trim();
        var email = $('#mail').val().trim();
        var name = $('#name').val().trim();

        checkLogin(login);
        checkPassword(password, confirm_password);
        checkEmail(email);
        checkName(name);

        if(error_message.length === 0) {
            $.ajax({
                type: 'post',
                url: 'create_user.php',
                data: $('form').serialize(),
                success: function (response) {
                    if(response['taken'] === 'login') {
                        alert('This login is already taken');
                    } else if(response['taken'] === 'email') {
                        alert('This email is already taken');
                    } else {
                        location.href = 'index.php';
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        } else {
            location.href = 'index.php';
        }

    });
});