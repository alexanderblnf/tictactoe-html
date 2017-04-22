<?php

/**
 * Created by IntelliJ IDEA.
 * User: Alexandru Balan
 * Date: 4/17/2017
 * Time: 12:03 PM
 */
class TableUtils{
    public function initiateGame($email1, $email2) {
        $query1 = new \Entities\UsersQuery();
        $query2 = new \Entities\UsersQuery();

        $user1 = $query1->findOneByEmail($email1);
        $user2 = $query2->findOneByEmail($email2);

        $table = new \Entities\Table();
        $initial = "";
        for($i = 0; $i < 25; $i++) {
            $initial .= "-";
        }

        $table->setTable($initial);
        $table->setLastMove($user2->getId());
        $table->setUser1($user1->getId());
        $table->setUser2($user2->getId());
        $table->save();
    }
}