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
            $password = $_POST['password'];
            $email = $_POST['email'];

            $result = $this->auth->register($username, $password, $email);

            if ($result['status']) {
                return $result['message']; // Registration successful.
            } else {
                return $result['message']; // Specific error message.
            }
        }
    }
}
