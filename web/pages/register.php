<?php
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once '../../vendor/autoload.php';
    require_once '../../generated-conf/config.php';
    require_once '../../server/UserUtils.php';

    $utils = new UserUtils();

    if($utils->signup($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'])) {
        $response = array('msg' => 'success');
    } else {
        $response = array('msg' => 'fail');
    }
} else {
    $response = array('msg' => 'fail');
}

echo json_encode($response);