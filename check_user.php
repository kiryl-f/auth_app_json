<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])  && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    require_once 'user.php';

    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $json = file_get_contents('users.json');
    $users = json_decode($json, true);
    $i = 0;
    $user_found = false;
    foreach($users as $user) {
        if($user['login'] === $login && $user['password'] === md5($password) . 'salt') {
            setcookie('name', $user['name']);
            echo json_encode(array('found' =>  'true'));
            $user_found = true;
            break;
        }
        $i++;
    }

    if(!$user_found) {
        echo json_encode(array('found' => 'false'));
    }

}
