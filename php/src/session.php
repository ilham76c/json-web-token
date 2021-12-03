<?php
use Firebase\JWT\JWT;

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
    private static $SECRET_KEY = "contohkey123";

    public static function login(string $username, string $password) : bool
    {
        if ($username == "ilham" && $password == "ilham") {
            $payload = [
                "username" => $username,
                "role" => "customer"
            ];

            $jwt = JWT::encode($payload, SessionManager::$SECRET_KEY, "HS256");
            setcookie("X-76c-Session", $jwt);

            return true;
        } else {
            return false;
        }
    }

    public static function getCurrentSession(): Session
    {
        try {
            if ($_COOKIE['X-76c-Session']) {
                $jwt = $_COOKIE['X-76c-Session'];
                $payload = JWT::decode($jwt, SessionManager::$SECRET_KEY, ['HS256']);

                // library JWT akan mengecek JWT valid atau tidak
                // jika tidak valid maka akan throw Exception
                return new Session($payload->username, $payload->role);
            } else {
                throw new Exception("User is not login");
            }
        } catch (Exception $e) {
            throw new Exception("User is notlogin");
        }
    }
}