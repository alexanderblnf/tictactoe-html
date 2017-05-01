<?php
session_start();
/**
 * Created by IntelliJ IDEA.
 * User: Alexandru Balan
 * Date: 4/30/2017
 * Time: 8:38 PM
 */

require '../../vendor/autoload.php';

require_once '../../generated-conf/config.php';
require_once '../../server/UserUtils.php';

$utils = new UserUtils();

$leaders = $utils->getLeaderboard($_SESSION['user']);

echo json_encode($leaders);