<?php

require_once 'user.php';
require_once 'user_crud.php';
require_once 'login_email_taken.php';

$login = $_POST['login'];
$email = $_POST['mail'];
$user = new User($_POST['login'], $_POST['password'], $_POST['mail'], $_POST['name']);
$users = json_decode(file_get_contents('users.json'), true);
foreach($users as $user) {
    if($user['email'] === $email) {
        echo json_encode(array('taken' =>  'email'));
        $taken = true;
        break;
    }
}
setcookie('name', $_POST['name']);