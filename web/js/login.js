/**
 * Created by Alexandru Balan on 4/16/2017.
 */

$('#login-btn').on('click', function () {
    var email = $('#email-login').val();
    var password = $('#password-login').val();

    var data = {};
    data.email = email;
    data.password = password;

    if (email && password) {
        var request = $.ajax({
            url: 'login.php',
            type: 'post',
            data: data
        });

        request.done(function (response, textStatus) {
            var data = JSON.parse(response);
            console.log(data);
            if(data.msg == 'true') {
                window.location.href = 'index.php';
            }
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ' ' + errorThrown);
        });
    }
});