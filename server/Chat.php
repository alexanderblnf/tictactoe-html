<?php

namespace MyApp;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface
{
    protected $clients, $users, $lookup;
    protected $connections, $pairs, $table;
    protected $side, $last;
    private $leftLimit = [0, 5, 10, 15, 20];
    private $rightLimit = [4, 9, 14, 19, 24];
    private $leftCase = [5, 10];
    private $rightCase = [9, 14];

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = array();
        $this->lookup = array();
        $this->connections = array();
        $this->pairs = array();
        $this->table = array();
        $this->side = array();
        $this->last = array();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    private function decideWin($from)
    {
        $message = array(
            'type' => 'end',
            'value' => 'win'
        );
        $from->send(json_encode($message));
        $username = $this->lookup[$from->resourceId];
        $opponent = $this->pairs[$username];

        $message['value'] = 'lose';
        $this->users[$opponent]->send(json_encode($message));
        $this->onClose($from);
        $this->onClose($this->users[$opponent]);
    }

    private function assessLateral($i, $limit, $username, $side, $increment) {
        $sum = 0;
        for ($j = $i; $j < $limit; $j += $increment) {
            if ($this->table[$username][$j] == $side) {
                $sum++;
            } else {
                $sum = 0;
            }
            if ($sum == 3) {
                return 1;
            }
        }

        return 0;
    }

    private function assessDiagonalRight($i, $username, $side) {
        $sum = 0;
        if(!in_array($i, $this->rightLimit)) {
            for($j = $i; $j < 25; $j += 6) {
                if ($this->table[$username][$j] == $side) {
                    $sum++;
                } else {
                    $sum = 0;
                }
                if ($sum == 3) {
                    return 1;
                }
                if(in_array($j, $this->rightLimit)) {
                    return 0;
                }
            }
        }

        return 0;
    }

    private function assessDiagonalLeft($i, $username, $side) {
        $sum = 0;
        if(!in_array($i, $this->leftLimit)) {
            for($j = $i; $j <= 20; $j += 4) {
                if ($this->table[$username][$j] == $side) {
                    $sum++;
                } else {
                    $sum = 0;
                }
                if ($sum == 3) {
                    return 1;
                }
                if(in_array($j, $this->leftLimit)) {
                    return 0;
                }
            }
        }
        return 0;
    }


    private function verifyWin($from)
    {
        $side = $this->side[$from->resourceId];
        $username = "";
        if($side == 'x') {
            $username = $this->lookup[$from->resourceId];
        } else if($side == 'o') {
            $username = $this->pairs[$this->lookup[$from->resourceId]];
        }


        for ($i = 0; $i < 5; $i++) {

            $index = 5 * $i;
            $limit = 5 * ($i + 1);

            if($this->assessLateral($index, $limit, $username, $side, 1)) {
                $this->decideWin($from);
                return -1;
            }

            $limit = 20 + $i;

            if($this->assessLateral($i, $limit, $username, $side, 5)) {
                $this->decideWin($from);
                return -1;
            }

            if($this->assessDiagonalLeft($i, $username, $side)) {
                $this->decideWin($from);
                return -1;
            }

            if($this->assessDiagonalRight($i, $username, $side)) {
                $this->decideWin($from);
                return -1;
            }
        }

        foreach ($this->leftCase as $i) {
            if($this->assessDiagonalRight($i, $username, $side)) {
                $this->decideWin($from);
                return -1;
            }
        }

        foreach ($this->rightCase as $i) {
            if($this->assessDiagonalLeft($i, $username, $side)) {
                $this->decideWin($from);
                return -1;
            }
        }

        return 0;
    }

    private function sendMessage($from, $data)
    {
        foreach ($this->clients as $client) {
            if ($client == $this->users[$data->username]) {
                // The sender is not the receiver, send to each client connected
                $message = array('type' => 'self-move',
                    'message' => $data->message);
                $from->send(json_encode($message));
                $message['type'] = 'move';
                $client->send(json_encode($message));
                break;
            }
        }
    }

    private function sendTurn($from, $username) {
        $message = array(
            'type' => 'turn',
            'username' => $username);
        $from->send(json_encode($message));
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);

        switch ($data->type) {
            case "subscribe":
                echo "Subscribe message received" . "\n";
                $this->users[$data->username] = $from;
                $this->lookup[$from->resourceId] = $data->username;
                break;
            case "available":
                echo "Available message received" . "\n";
                $message = array('type' => 'list',
                    'array' => (array_keys($this->users)));

                $from->send(json_encode($message));
                break;
            case "connect":
                echo "Connection message received";
                $myUsername = $this->lookup[$from->resourceId];
                $this->connections[$myUsername] = $data->username;
                $keys = array_keys($this->connections);

                foreach ($keys as $key) {
                    if ($this->connections[$key] == $myUsername) {
                        echo "Handshake successful";
                        $init = "";
                        for ($i = 0; $i < 25; $i++) {
                            $init .= "-";
                        }
                        $this->table[$myUsername] = $init;

                        $message = array(
                            'type' => 'ready',
                            'username' => $myUsername,
                            'side' => 'x'
                        );
                        $from->send(json_encode($message));
                        $message['username'] = $key;
                        $message['side'] = 'o';
                        $opponent = $this->users[$key];
                        $opponent->send(json_encode($message));
                        $this->sendTurn($from, $myUsername);
                        $this->sendTurn($opponent, $myUsername);
                        $this->pairs[$myUsername] = $key;
                        $this->pairs[$key] = $myUsername;
                        $this->side[$from->resourceId] = 'x';
                        $this->side[$opponent->resourceId] = 'o';
                        $this->last[$myUsername] = 'x';
                        unset($this->connections[$myUsername]);
                        unset($this->connections[$key]);
                        break;
                    }
                }
                break;
            case "move":

                $side = $this->side[$from->resourceId];
                $user = $this->lookup[$from->resourceId];
                $opponent = $this->pairs[$user];
                if ($side == 'x') {
                    $aux = $user;
                    $otherSide = 'o';
                } else {
                    $aux = $opponent;
                    $otherSide = 'x';
                }

                if($this->last[$aux] == $side){
                    $index = $data->message;
                    if($index >= 0 && $index < 25){
                        if ($this->table[$aux][$index] == '-') {
                            $this->sendMessage($from, $data);
                            $this->table[$aux][$index] = $this->side[$from->resourceId];
                            $done = $this->verifyWin($from);
                            if($done == 0){
                                $this->last[$aux] = $otherSide;
                                $this->sendTurn($this->users[$opponent], $opponent);
                                $this->sendTurn($this->users[$user], $opponent);
                            }

                        }
                    }
                }

        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        $username = $this->lookup[$conn->resourceId];
        unset($this->connections[$username]);
        unset($this->users[$username]);
        unset($this->lookup[$conn->resourceId]);
        unset($this->pairs[$username]);
        unset($this->side[$conn->resourceId]);
        unset($this->table[$username]);
        unset($this->last[$username]);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}