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

    # PHP Mailer
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
                                <button class='btn btn-primary'><a href='http://localhost/blog/?page=verify_email&action=verify_email&email=$email&token=$token'>Verify!</a></button>
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

    # LOGIN
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
