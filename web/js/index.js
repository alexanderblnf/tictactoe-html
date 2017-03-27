$('#play-btn').on('click', function () {
   $('#container-div').empty();
   $('#container-div').load('game.html');
});

$('#leader-btn').on('click', function () {
   $('#container-div').empty();
   $('#container-div').load('leaderboard.html');
});