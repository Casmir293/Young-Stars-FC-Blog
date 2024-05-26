<?php
require_once './config/db.php';
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
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email, token, privilege) VALUES (?, ?, ?, ?, 'member')");
        if ($stmt->execute([$username, $passwordHash, $email, $token])) {
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

    # FORGOT PASSWORD
    public function forgot_password($email)
    {
        $stmt = $this->pdo->prepare("SELECT username, email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            $username = $user['username'];
            $user_email = $user['email'];
            $token = md5(rand());

            $updated_token = $this->pdo->prepare("UPDATE users SET token = '$token' WHERE email = '$user_email'");
            $updated_token->execute();
            return ['status' => true, 'username' => $username, 'email' => $user_email, 'token' => $token];
        } else {
            return ['status' => false, 'message' => 'Email not registered.'];
        }
    }

    # RESET PASSWORD
    public function reset_password($password, $token)
    {
        $stmt = $this->pdo->prepare("SELECT token FROM users WHERE token='$token'");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $update_password = $this->pdo->prepare("UPDATE users SET password = '$passwordHash' WHERE token = '$token'");
            $update_password->execute();

            if ($update_password) {
                $new_token = md5(rand());
                $upadte_token = $this->pdo->prepare("UPDATE users SET token = '$new_token' WHERE token = '$token'");
                $upadte_token->execute();
                return ['status' => true, 'message' => 'Updated password successfully.'];
            } else {
                return ['status' => false, 'message' => 'Could not update password, something went wrong.'];
            }
        } else {
            return ['status' => false, 'message' => 'Invalid token.'];
        }
    }

    # LOGIN
    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return ['status' => true, 'message' => 'Login successful.', 'authenticated' => true, 'id' => $user['id']];
        } else {
            return ['status' => false, 'message' => 'Incorrect login details.'];
        }
    }
}
