$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'check_user.php',
            dataType: 'json',
            data: $('form').serialize(),
            success: function (response) {
                if(response['found'] === 'true') {
                    location.href = 'index.php';
                } else {
                    alert('Incorrect username or password');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
});