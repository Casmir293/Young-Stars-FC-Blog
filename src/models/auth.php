<?php
class Auth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($username, $password, $email)
    {
        // Check if username already exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => 'Username already exists.'];
        }

        // Check if email already exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => 'Email already exists.'];
        }

        // If they don't exist, proceed with registration
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $passwordHash, $email])) {
            return ['status' => true, 'message' => 'Registration successful.'];
        } else {
            return ['status' => false, 'message' => 'Registration failed. Please try again.'];
        }
    }

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
