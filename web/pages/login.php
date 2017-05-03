<?php
session_start();
if(isset($_POST['email']) && isset($_POST['password'])) {
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once '../../vendor/autoload.php';
    require_once '../../generated-conf/config.php';
    require_once '../../server/UserUtils.php';

    $utils = new UserUtils();

    $login = $utils->verifyLogin($_POST['email'], $_POST['password']);
    if($login == 1) {
        $response = array('msg' => 'true');
        $_SESSION['user'] = $_POST['email'];
    } else if($login == 0){
        $response = array('msg' => 'Bad Login');
    } else if($login == -1) {
        $response = array('msg' => 'DB Error');
    }
} else {
    $response = array('msg' => 'Parameters not sent');
}

echo json_encode($response);