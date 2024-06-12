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
        $stmt = $this->pdo->prepare("SELECT username FROM users WHERE username = ? AND deleted = 0");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => 'Username already exists.'];
        }

        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = ? AND deleted = 0");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            return ['status' => false, 'message' => 'Email already exists.'];
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password, email, token, privilege) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$username, $passwordHash, $email, $token, 'member'])) {
            return ['status' => true, 'message' => 'Registration successful! Verification link sent to your email.'];
        } else {
            return ['status' => false, 'message' => 'Registration failed. Please try again.'];
        }
    }

    # VERIFY EMAIL
    public function verify_email($email, $token)
    {
        $stmt = $this->pdo->prepare("SELECT token, status FROM users WHERE email = ? AND deleted = 0");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            if ($user['status'] == '0') {
                $update_stmt = $this->pdo->prepare("UPDATE users SET status = '1' WHERE token = ?");
                $update_stmt->execute([$token]);
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
        $stmt = $this->pdo->prepare("SELECT username, email FROM users WHERE email = ? AND deleted = 0");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            $username = $user['username'];
            $user_email = $user['email'];
            $token = md5(rand());

            $updated_token = $this->pdo->prepare("UPDATE users SET token = ? WHERE email = ?");
            $updated_token->execute([$token, $user_email]);
            return ['status' => true, 'username' => $username, 'email' => $user_email, 'token' => $token];
        } else {
            return ['status' => false, 'message' => 'Email not registered.'];
        }
    }

    # RESET PASSWORD
    public function reset_password($password, $token)
    {
        $stmt = $this->pdo->prepare("SELECT token FROM users WHERE token = ? AND deleted = 0");
        $stmt->execute([$token]);

        if ($stmt->rowCount() > 0) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $update_password = $this->pdo->prepare("UPDATE users SET password = ? WHERE token = ?");
            $update_password->execute([$passwordHash, $token]);

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

    # RESEND EMAIL VERIFICATION
    public function resend_verification($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ? AND deleted = 0");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($stmt->rowCount() > 0) {
            if ($user['status'] == "0") {
                $username = $user['username'];
                $email = $user['email'];
                $token = $user['token'];

                return ['status' => true, 'location' => 'login', 'username' => $username, 'email' => $email, 'token' => $token];
            } else {
                return ['status' => false, 'location' => 'login', 'message' => 'Email already verified, please login.'];
            }
        } else {
            return ['status' => false, 'location' => 'register', 'message' => 'You are not a registered user, kindly register your account.'];
        }
    }

    # LOGIN
    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT id, password, status FROM users WHERE email = ? AND deleted = 0");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] == "1") {
                return ['status' => true, 'message' => 'Login successful.', 'authenticated' => true, 'id' => $user['id']];
            } else {
                return ['status' => false, 'message' => 'You have not verified your email'];
            }
        } else {
            return ['status' => false, 'message' => 'Incorrect login details.'];
        }
    }
}
