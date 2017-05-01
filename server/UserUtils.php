<?php

/**
 * Created by IntelliJ IDEA.
 * User: Alexandru Balan
 * Date: 4/16/2017
 * Time: 8:49 PM
 */

class UserUtils{

    public function verifyLogin($email, $password) {
        $query = new \Entities\UsersQuery();
        $user = $query->findOneByEmail($email);
        if($user) {
            if (md5($password) == $user->getPassword()) {
               return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function signup($email, $password, $firstname, $lastname) {
        $query = new Entities\UsersQuery();
        $aux = $query->findOneByEmail($email);
        if(!$aux) {
            $user = new \Entities\Users();
            $user->setEmail($email);
            $user->setPassword(md5($password));
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setPermission(2);
            $user->save();

            $aux2 = $query->findOneByEmail($email);
            if($aux2) {
                $points = new \Entities\Leaderboard();
                $points->setPoints(0);
                $points->setWin(0);
                $points->setDraw(0);
                $points->setLose(0);
                $points->setUserid($aux2->getId());
                $points->save();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function winner($email) {
        $userQuery = new Entities\UsersQuery();
        $leaderboardQuery = new Entities\LeaderboardQuery();

        $user = $userQuery->findOneByEmail($email);
        $leaderEntry = $leaderboardQuery->findOneByUserid($user->getId());
        $leaderEntry->setPoints($leaderEntry->getPoints() + 1);
        $leaderEntry->setWin($leaderEntry->getWin() + 1);
        $leaderEntry->save();
    }

    public function loser($email) {
        $userQuery = new Entities\UsersQuery();
        $leaderboardQuery = new Entities\LeaderboardQuery();

        $user = $userQuery->findOneByEmail($email);
        $leaderEntry = $leaderboardQuery->findOneByUserid($user->getId());
        $leaderEntry->setLose($leaderEntry->getLose() + 1);
        $leaderEntry->save();
    }

    public function draw($email) {
        $userQuery = new Entities\UsersQuery();
        $leaderboardQuery = new Entities\LeaderboardQuery();

        $user = $userQuery->findOneByEmail($email);
        $leaderEntry = $leaderboardQuery->findOneByUserid($user->getId());
        $leaderEntry->setDraw($leaderEntry->getDraw() + 1);
        $leaderEntry->save();
    }

    public function getLeaderboard($email) {
        $leaders = \Entities\LeaderboardQuery::create()
            ->orderByPoints('DESC')
            ->find();
        $userQuery = new Entities\UsersQuery();

        $response = array();
        $pos = 0;
        foreach ($leaders as $leader) {
            $user = $userQuery->findPk($leader->getUserid());
            $aux = array();
            $pos++;
            if($user->getEmail() == $email) {
                $aux['this'] = true;
            }
            $aux['position'] = $pos;
            $aux['name'] = $user->getFirstname() . " " . $user->getLastname();
            $aux['points'] = $leader->getPoints();
            $aux['win'] = $leader->getWin();
            $aux['draw'] = $leader->getDraw();
            $aux['lose'] = $leader->getLose();
            array_push($response, $aux);
        }
        return $response;
    }

    public function getUsers($email) {
        $userQuery = new Entities\UsersQuery();
        $user = $userQuery->findOneByEmail($email);

        if($user->getPermission() == 1){
            $users = \Entities\UsersQuery::create()->find();
            $response = array();
            foreach ($users as $user) {
                $aux = array();
                $aux['id'] = $user->getId();
                $aux['name'] = $user->getFirstname() . " " . $user->getLastname();
                $aux['email'] = $user->getEmail();
                if($user->getPermission() == 1) {
                    $aux['permission'] = 'yes';
                } else {
                    $aux['permission'] = 'no';
                }

                array_push($response, $aux);
            }
        } else {
            $response = array(
                "error" => "You do not have permission"
            );
        }


        return $response;
    }

    public function deleteUser($id, $email) {
        $userQuery = new Entities\UsersQuery();
        $leaderQuery = new \Entities\LeaderboardQuery();
        $user = $userQuery->findOneById($id);
        $userQuery = new Entities\UsersQuery();
        $admin = $userQuery->findOneByEmail($email);

        if($admin) {
            if($admin->getPermission() == 1) {
                if($user){
                    $leader = $leaderQuery->findOneByUserid($user->getId());
                    $user->delete();
                    $leader->delete();
                    return array("success" => "Delete successful");
                } else {
                    return array("error" => "No user found");
                }
            } else {
                return array("error" => "You do not have permission");
            }
        } else {
            return array("error" => "Admin error");
        }
    }

}