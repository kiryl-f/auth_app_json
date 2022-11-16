<?php

class userCrud
{
    public static function create($user) {
        $users = json_decode(file_get_contents('users.json'), true);
        $users[] = $user->toArray();
        file_put_contents('users.json', json_encode($users));
    }

    public static function read($login) {

    }

    public static function update() {

    }

    public static function delete() {

    }
}