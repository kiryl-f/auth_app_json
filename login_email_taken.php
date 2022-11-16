<?php

function taken($login, $email) {
    $users = json_decode(file_get_contents('users.json'), true);
    foreach($users as $user) {
        if($user['login'] === $login) {
            return 'login';
        }
    }
    foreach($users as $user) {
        if($user['email'] === $email) {
            return 'email';
        }
    }
    return 'good';
}
