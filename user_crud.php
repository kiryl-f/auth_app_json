<?php

class userCrud
{
    public static function create($user) {
        $users = json_decode(file_get_contents('users.json'), true);
        $users[] = $user->toArray();
        file_put_contents('users.json', json_encode($users));
    }

    public static function read($login) {
        $users = json_decode(file_get_contents('users.json'), true);
        foreach ($users as $user) {
            if($user['login'] === $login) {
                return $user;
            }
        }
    }

    public static function update($login, $new_user) {
        $users = json_decode(file_get_contents('users.json'), true);
        $i = 0;
        foreach ($users as $user) {
            if($user['login'] === $login) {
                $users[$i] = $new_user;
                break;
            }
            $i++;
        }
    }

    public static function delete($login) {
        $users = json_decode(file_get_contents('users.json'), true);
        $i = 0;
        foreach ($users as $user) {
            if($user['login'] === $login) {
                unset($users[$i]);
                break;
            }
            $i++;
        }
    }
}