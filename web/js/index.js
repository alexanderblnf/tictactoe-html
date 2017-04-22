$('#play-btn').on('click', function () {
   $('#container-div').empty().load('game.php');
});

$('#leader-btn').on('click', function () {
   $('#container-div').empty().load('leaderboard.html');
});

$('#admin-btn').on('click', function () {
    $('#container-div').empty().load('admin.html');
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


$(document).ready(function () {
   closeBar();
});

function openBar() {
   var width = window.screen.width;
   if(width <= 1223) {
       $('#menuBar-div').width('20vw');
       $('#menuButton-div').css('left','20vw');
   } else {
       $('#menuBar-div').width('12vw');
       $('#menuButton-div').css('left','12vw');
   }
}

/* Set the width of the side navigation to 0 */
function closeBar() {
    $('#menuBar-div').width(0);
    $('#menuButton-div').css('left', 0);
}