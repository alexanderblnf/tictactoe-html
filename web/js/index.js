$('#play-btn').on('click', function () {
   $('#container-div').empty().load('game.php');
   addPage('game');
});

$('#leader-btn').on('click', function () {
   $('#container-div').empty().load('leaderboard.html');
    addPage('leaderboard');
});

$('#admin-btn').on('click', function () {
    $('#container-div').empty().load('admin.html');
    addPage('admin');
});

$('#chat-btn').on('click', function () {
    $('#container-div').empty().load('chat.html');
    addPage('chat');
});

$('#contact-btn').on('click', function () {
    $('#container-div').empty().load('contact.html');
    addPage('contact');
});

$('#rules-btn').on('click', function () {
    $('#container-div').empty().load('rules.html');
    addPage('rules');
});

$('#get-pages').on('click', function () {
    var request = $.ajax({
        url: 'getPages.php',
        type: 'get'
    });

    request.done(function (response, textStatus) {
        var data = JSON.parse(response);
        $('#aux-div').css("display", "inline-flex");
        $('#list-div').empty();
        var div = document.getElementById("list-div");
        var ul = document.createElement('ul');
        ul.id = 'pages-ul';
        data.forEach(function (res) {
            var li = document.createElement('li');
            li.innerHTML = res;
            ul.appendChild(li);
        });
        div.appendChild(ul);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ' ' + errorThrown);
    });
});

$('#logout-btn').on('click', function () {
    var request = $.ajax({
        url: 'logout.php',
        type: 'get'
    });

    request.done(function (response, textStatus) {
        window.location.href = "login.html"
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
    });
});

$('#menu-button').on('click', function (e) {
   var width = $('#menuBar-div').width();
    e.stopPropagation();
   if(width != 0) {
      closeBar();
   } else {
      openBar();
   }
});

$('body').on('click', function (e) {
    closeBar();
});

$('#close-aux').on('click', function () {
   $('#aux-div').hide();
});


$(document).ready(function () {
   closeBar();
});

function openBar() {
   var width = window.screen.width;
   if(width <= 1223) {
       $('#menuBar-div').width('20vw');
       $('#menuButton-div').css('left','20vw');
   } else {
       $('#menuBar-div').width('14vw');
       $('#menuButton-div').css('left','14vw');
   }
}

/* Set the width of the side navigation to 0 */
function closeBar() {
    $('#menuBar-div').width(0);
    $('#menuButton-div').css('left', 0);
}

function addPage(name) {
    var data = {
        page: name
    };

    var request = $.ajax({
        url: 'addPage.php',
        type: 'post',
        data: data
    });

    request.done(function (response, textStatus) {
        var data = JSON.parse(response);
        if(data.code == 400) {
            console.log("Error");
        }
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ' ' + errorThrown);
    });
}
