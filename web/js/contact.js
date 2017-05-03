var stars;
$(document).on('click', '.span-a', function () {
    var id = $(this)[0].id;
    stars = id.substr(4, id.length - 1);
    for(var i = 1; i <= 5; i++) {
        var idd = "#star" + i;
        if(i > stars) {
            $(idd).removeClass('star-shape');
        } else {
            $(idd).addClass('star-shape')
        }
    }

});


$(document).on('click', '#contact-send-btn', function () {
    if (stars != null) {
        var message = "Rating: " + stars + "\n" + $('#contact-text').val();
        var user = $('#user-text').val();
        var data = {
            message: message,
            user: user
        };

        var request = $.ajax({
            url: 'mail.php',
            type: 'post',
            data: data
        });

        request.done(function (response, textStatus) {
            if(data.error) {
                console.log(data.error);
            } else {
                $('#container-div').empty().load('contact.html');
            }
        });

        request.fail(function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ' ' + errorThrown);
        });
    }


});
