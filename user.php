<?php

require_once 'user_crud.php';

class User {
    private ?string $login;
    private ?string $password;
    private ?string $email;
    private ?string $name;

    public function __construct(?string $login, ?string $password, ?string $email, ?string $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function toArray(): array {
        return
            array('login' => $this->login, 'password' => $this->password, 'email' => $this->email, 'name' => $this->name);
    }

    private function checkLogin($login):string {
        if(strlen($login) < 6) {
            return "Login must be at least 6 characters long\n";
        }
        if(strpos($login, ' ') !== false) {
            return "Login must not contain spaces\n";
        }
        return '';
    }

    private function checkPassword($password): string {

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

    function checkConfirmPassword($confirm_password): string {
        if($this->getPassword() !== $confirm_password) {
            return "Passwords do not match\n";
        }
        return '';
    }

    private function checkEmail($email):string {
        if(strpos($email, ' ') !== false || $email !== trim($email)) {
            return "Email must not contain spaces\n";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format\n";
        }

        return '';
    }

    private function checkName($name):string {
        if(!preg_match('/[A-Za-z]/', $name)) {
            return "Name should consist of letters\n";
        }

        if(strpos($name, ' ') !== false) {
            return "Name must not contain spaces\n";
        }

        if(strlen($name) < 2) {
            return "Name must be at least 2 characters long\n";
        }
        return '';
    }

    private function checkIfLoginIsTaken(): string {
        $users = userCrud::getUsers();
        foreach($users as $u) {
            if($u['login'] === $this->getLogin()) {
                return "This login is already taken \n";
            }
        }
        return '';
    }

    private function checkIfEmailIsTaken(): string {
        $users = userCrud::getUsers();
        foreach($users as $u) {
            if($u['email'] === $this->getEmail()) {
                return "This email is already taken \n";
            }
        }
        return '';
    }

    function getErrorMessage():string {
        $error_message = $this->checkIfLoginIsTaken();
        $error_message .= $this->checkIfEmailIsTaken();
        $error_message .= $this->checkLogin($this->getLogin());
        $error_message .= $this->checkPassword($this->getPassword());
        $error_message .= $this->checkName($this->getName());
        $error_message .= $this->checkEmail($this->getEmail());

        return $error_message;
    }

    public function saltPassword() {
        $this->setPassword(md5($this->getPassword()) . 'salt');
    }

    public function addToDatabase() {
        userCrud::create($this);
    }

}