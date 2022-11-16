<?php

require_once 'user.php';

$login = $_POST['login'];
$password = $_POST['password'];
//var_dump($_POST);
$json = file_get_contents('users.json');
$users = json_decode($json, true);
$i = 0;
$user_found = false;
foreach($users as $user) {
    if($user['login'] === $login && $user['password'] === $password) {
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
