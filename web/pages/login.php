<?php
session_start();
if(isset($_POST['email']) && isset($_POST['password'])) {
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once '../../vendor/autoload.php';
    require_once '../../generated-conf/config.php';
    require_once '../../server/UserUtils.php';

    $utils = new UserUtils();

    if($utils->verifyLogin($_POST['email'], $_POST['password'])) {
        $response = array('msg' => 'true');
        $_SESSION['user'] = $_POST['email'];
    } else {
        $response = array('msg' => 'fail');
    }
} else {
    $response = array('msg' => 'fail');
}

echo json_encode($response);