<?php
    session_start();
?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Game</title>-->
<!--</head>-->
<body>
<div id="table-div">
    <table id="game-table">
    </table>
</div>

<!--</body>-->
<script>
    $(document).ready(function () {
        render_table();
        getAvailable();
    });
</script>
<!--</html>-->