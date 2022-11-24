<?php

function checkLogin($login):string {
    if(strlen($login) < 6) {
        return "Login must be at least 6 characters long\n";
    }
    if(strpos($login, ' ') !== false) {
        return "Login must not contain spaces\n";
    }
    return '';
}

function checkPassword($password, $confirm_password): string {
    if($password !== $confirm_password) {
        return "Passwords do not match\n";
    }

    if(strlen($password) < 6) {
        return "Password must be at least 6 characters long\n";
    }

    if (!(preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))) {
        return "Password should contain numbers and letters\n";
    }

    if(strpos($password, ' ') !== false) {
        return "Password must not contain spaces\n";
    }
    return '';
}

function checkEmail($email):string {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       return "Invalid email format\n";
    }

    if(strpos($email, ' ') !== false || $email !== trim($email)) {
        return "Email must not contain spaces\n";
    }
    return '';
}

function checkName($name):string {
    if(!preg_match('/[A-Za-z]/', $name)) {
        return "Name should consist of letters\n";
    }

    if(strpos($name, ' ') !== false) {
        return "Name must not contain spaces\n";
    }
    return '';
}


if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])  && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    require_once 'user.php';
    require_once 'user_crud.php';

    $login = $_POST['login'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    $error_message = '';

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

    $error_message .= checkLogin($login);
    $error_message .= checkPassword($password, $confirm_password);
    $error_message .= checkName($name);
    $error_message .= checkEmail($email);

    if(strlen($error_message) == 0) {
        $user = new User($login, md5($password) . 'salt', $email, $name);
        userCrud::create($user);
        setcookie('name', $_POST['name']);
    }
    echo json_encode(array('error' => $error_message));
} else {
    echo 'Access denied';
}
