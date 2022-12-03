<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])  && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    require_once 'user.php';
    require_once 'user_crud.php';

    $login = $_POST['login'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user = new User($login, $password, $email, $name);
    $error_message = '';

    $error_message = $user->getErrorMessage();
    $error_message .= $user->checkConfirmPassword($confirm_password);

    if(strlen($error_message) == 0) {
        $user->saltPassword();
        $user->addToDatabase();
        setcookie('name', $_POST['name']);
    }
    echo json_encode(array('error' => $error_message));
} else {
    echo 'Access denied';
}
