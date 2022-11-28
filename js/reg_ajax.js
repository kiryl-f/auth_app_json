$(function () {
    $("#next").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'create_user.php',
            dataType: 'json',
            data: $(e.target).serialize(),
            success: function (response) {
                if(response['error'].length === 0) {
                    location.href = 'index.php';
                } else {
                    alert(response['error']);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("error: " + errorThrown);
            }
        });
    });
});