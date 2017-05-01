<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Alexandru Balan
 * Date: 5/1/2017
 * Time: 2:10 PM
 */
require '../../vendor/autoload.php';

require_once '../../generated-conf/config.php';
require_once '../../server/UserUtils.php';

$utils = new UserUtils();

if(!isset($_POST['id'])) {
    $leaders = $utils->getUsers($_SESSION['user']);
    echo json_encode($leaders);
} else {
    $delete = $utils->deleteUser($_POST['id'], $_SESSION['user']);
    echo json_encode($delete);
}

