<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: login.html");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/index.css" media="screen,projection"/>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto+Slab">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/game.css">
    <link rel="stylesheet" type="text/css" href="../css/leaderboard.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<div id="available-div">
    <ul id="available-list">
    </ul>
</div>
<header>
    <div id="logo-div">
        <a href="index.php"><img id="logo" src="../img/logo.png"></a>
    </div>
</header>
<div id="menuBar-div">

    <div class="bar-divs" id="text-div">
        <span id="logo-text">Tic</span>
    </div>
    <div class="bar-divs" id="menu-div">
        <div class="btn-divs" id="play-div">
            <button class="btn whole-button" id="play-btn">Play</button>
        </div>
        <div class="btn-divs" id="leaderboard-div">
            <button class="btn whole-button" id="leader-btn">Leaderboard</button>
        </div>
        <div class="btn-divs" id="admin-div">
            <button class="btn whole-button" id="admin-btn">Manage users</button>
        </div>
    </div>
</div>
<div id="menuButton-div">
    <button class="btn" id="menu-button"><i class="material-icons" id="menu-label">menu</i></button>
</div>
<div id="container-div">
    <div class="description-strip">
        <div id="desc-title">
            <span class="desc-span">Welcome to Tic!<br> A multiplayer Tic-Tac-Toe</span>
        </div>
        <div id="desc-content">
            <div class="content-div">
                <i class="material-icons inline">close</i>
                <p class="inline">
                    This is a project made by a student at University Politehnica of Bucharest
                <p>
            </div>
            <div class="content-div">
                <i class="material-icons inline">panorama_fish_eye</i>
                <p class="inline">
                    It's a standard multiplayer Tic-Tac-Toe, with the option to fight against an
                    AI.
                <p>
            </div>
            <div class="content-div">
                <i class="material-icons inline">close</i>
                <p class="inline">
                    It's made using only HTML, CSS, jQuery and PHP
                <p>
            </div>
            <div class="content-div">
                <i class="material-icons inline">panorama_fish_eye</i>
                <p class="inline">
                    Please bear in mind this is still a work in progress
                </p>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../js/jquery-3.2.0.js"></script>
<script src="../js/index.js"></script>
<script src="../js/render-table.js"></script>
<script src="../js/game.js"></script>
</html>