<?php

require_once 'user.php';
require_once 'user_crud.php';
require_once 'login_email_taken.php';

$login = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['email'];
$name = $_POST['name'];


$error_message = '';

$user = new User($_POST['login'], md5($_POST['password']) . 'salt', $_POST['email'], $_POST['name']);
$users = json_decode(file_get_contents('users.json'), true);
foreach($users as $u) {
    if($u['login'] === $login) {
        $error_message .= "This login is already taken \n";
        break;
    }
}

foreach ($users as $u) {
    if($u['email'] === $email) {
        $error_message .= "This email is already taken\n";
        break;
    }
}

if(strlen($login) < 6) {
    $error_message .= "Login must be at least 6 characters long";
}

if($password !== $confirm_password) {
    $error_message .= "Passwords do not match\n";
}

if (!(preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))) {
    $error_message .= "Password should contain numbers and letters\n";
}

if($password !== $confirm_password) {
    $error_message .= "Passwords do not match\n";
}

if(!preg_match('/[A-Za-z]/', $name)) {
    $error_message .= "Name should consist of letters\n";
}

if(strlen($error_message) == 0) {
    userCrud::create($user);
    setcookie('name', $_POST['name']);
}
echo json_encode(array('error' => $error_message));