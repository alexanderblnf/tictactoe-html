<?php
    session_start();
    $response = array('username' => $_SESSION['user']);

    echo json_encode($response);