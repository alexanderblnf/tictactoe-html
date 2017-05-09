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
    <title>Tic</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/index.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto+Slab">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/game.css">
    <link rel="stylesheet" type="text/css" href="../css/leaderboard.css">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/loading-animation.css">
    <link rel="stylesheet" type="text/css" href="../css/chat.css">
    <link rel="stylesheet" type="text/css" href="../css/contact.css">
</head>
<body>
<div id="aux-div">
    <button id="close-aux"><i class="material-icons close-icon">close</i></button>
    <div id="container-aux">
        <span id="span-visited">Visited pages:</span>
        <div id="list-div">

        </div>
    </div>
</div>
<div id="available-div">
    <div id="available-span-div">
        <span>Available users</span>
    </div>
    <div id="list-div">
        <ul id="available-list">
        </ul>
    </div>
    <div id="loading-div">

    </div>
</div>
<header>
    <div id="logo-div">
        <a href="index.php"><img id="logo" src="../img/logo.png" alt="Logo image"></a>
    </div>
    <div id="logout-div">
        <button id="get-pages"><span id="user-span"><?php echo $_SESSION['fullName']?></span></button>
        <button id="logout-btn" class="btn">
            <i class="material-icons" style="font-size: 2.5em;">power_settings_new</i>
        </button>

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
        <div class="btn-divs" id="chat-div">
            <button class="btn whole-button" id="chat-btn">Chat Room</button>
        </div>
        <div class="btn-divs" id="rules-div">
            <button class="btn whole-button" id="rules-btn">Rules</button>
        </div>
        <div class="btn-divs" id="contact-div">
            <button class="btn whole-button" id="contact-btn">Contact Us</button>
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
<script src="../js/jquery-3.2.0.js"></script>
<script src="../js/index.js"></script>
<script src="../js/render-table.js"></script>
<script src="../js/game.js"></script>
<script src="../js/chat.js"></script>
<script src="../js/contact.js"></script>
</body>
</html>