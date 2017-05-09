<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Alexandru Balan
 * Date: 5/9/2017
 * Time: 1:41 PM
 */
if(isset($_POST['page']) && $_POST['page'] != "") {
    array_push($_SESSION['pages'], $_POST['page']);
    echo json_encode(array(
       'code' => 200,
        'message' => 'OK'
    ));
} else {
    echo json_encode(array(
        'code' => 400,
        'message' => 'Not enough parameters'
    ));
}