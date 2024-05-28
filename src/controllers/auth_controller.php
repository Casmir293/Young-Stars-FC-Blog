<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once './src/models/auth.php';
require_once './config/secret.php';
require './vendor/autoload.php';

class AuthController
{
    private $auth;

    public function __construct($pdo)
    {
        $this->auth = new Auth($pdo);
    }

    # PHP Mailer - Send Email Verification
    private function send_email_verification($username, $email, $token)
    {
        global $SMTPPassword;
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = 'casmir293@gmail.com';
            $mail->Password   = $SMTPPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('casmir293@gmail.com', $username);
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verificatition from Young Stars FC';
            $email_template =   "
                                <h2>You have Registered with Young Stars FC</h2>
                                <p>Verify your email address with the below link to enable your login access.</p>
                                <br/><br/>
                                <a href='http://localhost/blog/?page=verify_email&action=verify_email&email=$email&token=$token'>Verify!</a>
                                ";
            $mail->Body = $email_template;
            $mail->send();
            echo 'Message sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    # REGISTRATION
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $token = md5(rand());

            $result = $this->auth->register($username, $email, $password, $token);

            if ($result['status']) {
                $this->send_email_verification($username, $email, $token);
            }
            return $result;
        }
    }

    # EMAIL VERIFICATION
    public function verify_email()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $email = $_GET['email'];
            $token = $_GET['token'];
            $result = $this->auth->verify_email($email, $token);
            return $result;
        }
    }

    # PHP Mailer - New Password Verification
    private function new_password_verification($username, $email, $token)
    {
        global $SMTPPassword;
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = 'casmir293@gmail.com';
            $mail->Password   = $SMTPPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('casmir293@gmail.com', $username);
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Password reset from Young Stars FC';
            $email_template =   "
                                <h2>You have requested a password reset on your Young Stars FC account</h2>
                                <p>Verify your email address with the below link to enable you to set a new password.</p>
                                <br/><br/>
                                <a href='http://localhost/blog/?page=reset_password&action=reset_password&email=$email&token=$token'>Verify!</a>
                                ";
            $mail->Body = $email_template;
            $mail->send();
            echo 'Message sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    # FORGOT PASSWORD
    public function forgot_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);

            $result = $this->auth->forgot_password($email);

            if ($result['status']) {
                $username = $result['username'];
                $email = $result['email'];
                $token = $result['token'];

                $this->new_password_verification($username, $email, $token);
                return ['status' => true, 'message' => 'Password reset link has been sent to your email.'];
            } else {
                return $result;
            }
        }
    }

    # RESET PASSWORD
    public function reset_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'];
            $token = $_POST['token'];

            $result = $this->auth->reset_password($password, $token);
            return $result;
        }
    }

    # LOGIN
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $result = $this->auth->login($email, $password);
            return $result;
        }
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();

        return ['status' => true];
    }
}
