<?php
require_once('../../config/db.php');

class Auth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    # REGISTER
    public function register($username, $email, $password, $token)
    {
        $stmt = $this->pdo->prepare("SELECT username FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => 'Username already exists.'];
        }

        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => 'Email already exists.'];
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email, token, privilege) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$username, $passwordHash, $email, $token, 'member'])) {
            return ['status' => true, 'message' => 'Registration successful! Verification link sent to your email.'];
        } else {
            return ['status' => false, 'message' => 'Registration failed. Please try again.'];
        }
    }

    # VERIFY EMAIL
    public function verify_email($email, $token)
    {
        $stmt = $this->pdo->prepare("SELECT token, status FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            if ($user['status'] == '0') {
                $update_stmt = $this->pdo->prepare("UPDATE users SET status = '1' WHERE token = '$token'");
                $update_stmt->execute();
                return ['status' => true, 'message' => 'Email account verified successfully.'];
            } else {
                return ['status' => true, 'message' => 'Email already verified, login.'];
            }
        } else {
            return ['status' => false, 'message' => 'This token does not exist.'];
        }
    }

    # LOGIN
    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            ['status' => true, 'message' => 'Login successful.'];
            return $user;
        }
        ['status' => false, 'message' => 'Login failed.'];
        return false;
    }
}
