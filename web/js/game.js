var conn;
var username, playmate, side;
var available = [];

function getSession(callback) {
    var request = $.ajax({
        url: 'session.php',
        type: 'get'
    });

    request.done(function (response, textStatus) {
        var data = JSON.parse(response);
        username = data.username;
        callback();
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus + ' ' + errorThrown);
        callback();
    })
}

function showResult(value) {
    $('#available-div').empty();
    var available = document.getElementById('available-div');
    var div = document.createElement('div');
    var span = document.createElement('span');
    span.innerHTML = value;
    span.id = 'result-span';
    div.className = 'result-div animated fadeIn';
    var image = document.createElement('img');
    if(value == 'win') {
        image.src = "../img/winner.png";
    } else if(value == 'lose') {
        image.src = "../img/loser.png";
    } else {
        console.log(value);
    }
    image.className = 'result-image';
    div.appendChild(image);

    var br = document.createElement('br');
    div.appendChild(br);
    br = document.createElement('br');
    div.appendChild(span);
    div.appendChild(br);

    var home = document.createElement('button');
    home.innerHTML = 'Home';
    home.id = 'home-btn';
    home.className = 'btn btn-success';
    div.appendChild(home);

    available.appendChild(div);

    $('#available-div').css('display', 'inline-flex');

}

function createSocket() {
    conn = new WebSocket('ws://192.168.0.101:8081');
    conn.onopen = function (e) {
        console.log("Connection established!");
        var data = {
            type: 'subscribe',
            username: username
        };
        conn.send(JSON.stringify(data));
    };

    conn.onmessage = function (e) {
        var data = JSON.parse(e.data);
        if (data.type == 'list') {
            var availableUsers = data.array;
            if (availableUsers.length < 2) {
                setTimeout(function () {
                    var data = {
                        type: 'available'
                    };
                    conn.send(JSON.stringify(data));
                }, 10000);
                $('#available-div').hide();
            } else {
                showAvailable(availableUsers);
                $("#available-div").css("display", "inline-flex");
            }

        } else if (data.type == 'self-move') {
            var id = 'div' + data.message;
            var div = document.getElementById(id);
            var img = document.createElement('img');
            if(side == 'x') {
                img.src = 'http://vignette4.wikia.nocookie.net/wikichannel/images/a/a5/X.png/revision/latest?cb=20140406171754';
            } else {
                img.src = 'http://www.freeiconspng.com/uploads/circle-png-8.png';
            }

            img.className = "img-overbutton";
            div.appendChild(img);

        } else if (data.type == 'move') {
            var id = 'div' + data.message;
            var div = document.getElementById(id);
            var img = document.createElement('img');
            if (side == 'o') {
                img.src = 'http://vignette4.wikia.nocookie.net/wikichannel/images/a/a5/X.png/revision/latest?cb=20140406171754';
            } else {
                img.src = 'http://www.freeiconspng.com/uploads/circle-png-8.png';
            }

            img.className = "img-overbutton";
            div.appendChild(img);
        }
        else if(data.type == 'ready'){
            side = data.side;
            $('#available-div').hide();
        } else if(data.type == 'end') {
            showResult(data.value);
        } else if(data.type == 'turn') {
            console.log(data.username);
            if(username == data.username) {
                $('#turn-span').text("Your turn!")
            } else {
                $('#turn-span').text("Your opponent's turn!")
            }
        } else if(data.type == 'retrieve-chat'){
            var array = data.array;
            array.forEach(function (val) {
                var span = '<p class="text-message">' + val["user"] + ": " + val["message"] + '</p>';
                console.log(span);
                $('#chat-content').append(span);
            });
        } else if(data.type == 'chat-message') {
            console.log('Chat message');
            var span = '<p class="text-message">' + data["user"] + ": " + data["message"] + '</p>';
            $('#chat-content').append(span);
        } else {
            console.log('Something went wrong');
        }

    };
}
$(document).ready(function () {
    getSession(function () {
        createSocket();
    });
});

$(document).on('click', '.game-square', function () {
    var id = $(this).get(0).id;
    var square = id.substr(6, id.length - 1);

    if(playmate) {
        var data = {
            type: 'move',
            message: square,
            username: playmate
        };
        conn.send(JSON.stringify(data));
    }
});

$(document).on('click', '.request-play', function () {
    var id = $(this)[0].id;
    id = 'player' + id.substr(4, id.length);
    var player = $('#' + id).text();
    playmate = player;
    var data = {
        type: 'connect',
        username: player
    };
    conn.send(JSON.stringify(data));

    $('#loading-div').empty().load('loading-animation.html');
});

$(document).on('click', '#home-btn', function () {
   location.reload();
});

function getAvailable() {
    var data = {
        type: 'available'
    };
    conn.send(JSON.stringify(data));
}

function showAvailable(availableUsers) {
    var ul = document.getElementById('available-list');
    var it = 0;
    availableUsers.forEach(function (user) {
        if (username != user) {
            var li = document.createElement('li');
            var span = document.createElement('span');
            span.innerHTML = user;
            span.id = 'player' + it;
            var play = document.createElement('button');
            play.innerHTML = 'play';
            play.id = 'play' + it;
            play.className = 'btn btn-success request-play';
            li.appendChild(span);
            li.appendChild(play);
            ul.appendChild(li);
            it++;
        }
    });
}