<?php

require_once '../models/auth.php';

class AuthController
{
    private $auth;

    public function __construct($pdo)
    {
        $this->auth = new Auth($pdo);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->auth->register($username, $email, $password);

            if ($result['status']) {
                return $result['message'];
            } else {
                return $result['message'];
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->auth->login($email, $password);
            if ($result['status']) {
                return $result['message'];
            } else {
                return $result['message'];
            }
        }
    }
}
