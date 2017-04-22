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
            $user->save();
            return true;
        } else {
            return false;
        }
    }
}