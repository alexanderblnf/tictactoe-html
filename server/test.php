<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

require dirname(__DIR__) . '/vendor/autoload.php';

require_once dirname(__DIR__) . '/generated-conf/config.php';
require_once dirname(__DIR__) . '/server/UserUtils.php';

$utils = new UserUtils();

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat($utils)
        )
    ),
    8081
);

$server->run();