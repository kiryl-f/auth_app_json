<?php

require_once 'user.php';
require_once 'user_crud.php';
require_once 'login_email_taken.php';

$login = $_POST['login'];
$email = $_POST['mail'];
$user = new User($_POST['login'], md5($_POST['password']) . 'salt', $_POST['mail'], $_POST['name']);
$users = json_decode(file_get_contents('users.json'), true);
$taken = false;
foreach($users as $u) {
    if($u['login'] === $login) {
        echo json_encode(array('taken' =>  'login'));
        $taken = true;
        break;
    }
}

foreach ($users as $u) {
    if($u['email'] === $email) {
        echo json_encode(array('taken' => 'email'));
        $taken = true;
        break;
    }
}

if(!$taken) {
    userCrud::create($user);
    setcookie('name', $_POST['name']);
}