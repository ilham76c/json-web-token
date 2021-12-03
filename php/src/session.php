<?php

class Session {
    public $username;
    public $role;
    
    public function __construct(string $username, string $role)
    {
        $this->username = $username;
        $this->role = $role;
    }
}

class SessionManager {
    public static function login(string $username, string $password) : bool
    {
        if ($username == "ilham" && $password == "ilham") {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'customer';
            return true;
        } else {
            return false;
        }
    }

    public static function getCurrentSession(): Session
    {
        if ($_SESSION['username']) {
            return new Session($_SESSION['username'], $_SESSION['role']);
        } else {
            throw new Exception("User is not login");
        }
    }
}