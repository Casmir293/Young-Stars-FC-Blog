<?php
session_start();
define('ROOT_PATH', __DIR__);
require_once './config/db.php';
require_once './src/controllers/auth_controller.php';
require_once './src/controllers/post_controller.php';

$authController = new AuthController($pdo);

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($page) {
        # REGISTRATION
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'register') {
            $message = $authController->register();

            $_SESSION['status'] = $message['status'];
            $_SESSION['message'] = $message['message'];

            if ($message['status']) {
                header('Location: ?page=login');
            } else {
                header('Location: ?page=register');
            }
            exit();
        }
        include './src/views/auth/register.php';
        break;

        # EMAIL VERIFICATION
    case 'verify_email':
        if ($action === 'verify_email') {
            $message = $authController->verify_email();

            $_SESSION['status'] = $message['status'];
            $_SESSION['message'] = $message['message'];

            if ($message['status']) {
                header('Location: ?page=login');
            } else {
                header('Location: ?page=register');
            }
            exit();
        }
        include './src/views/auth/register.php';
        break;

        # FORGOT PASSWORD
    case 'forgot_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'forgot_password') {
            $message = $authController->forgot_password();

            $_SESSION['status'] = $message['status'];
            $_SESSION['message'] = $message['message'];

            if ($message['status']) {
                header('Location: ?page=login');
            } else {
                header('Location: ?page=forgot_password');
            }
            exit();
        }
        include './src/views/auth/forgot_password.php';
        break;

        # RESET PASSWORD
    case 'reset_password':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'reset_password') {
            $message = $authController->reset_password();

            $email = $_GET['email'];
            $token = $_GET['token'];
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;
            $_SESSION['status'] = $message['status'];
            $_SESSION['message'] = $message['message'];

            if ($message['status']) {
                header('Location: ?page=login');
            } else {
                if ($email && $token) {
                    header("Location: ?page=reset_password?email=$email&token=$token");
                } else {
                    header("Location: ?page=reset_password");
                }
            }
            exit();
        }
        include './src/views/auth/reset_password.php';
        break;

        # LOGIN
    case 'login':
        if (isset($_SESSION['authenticated'])) {
            $authController->logout();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'login') {
            $message = $authController->login();

            if ($message['status']) {
                $_SESSION['message'] = $message['message'];
                $_SESSION['authenticated'] = $message['authenticated'];
                $_SESSION['status'] = $message['status'];
                $_SESSION['id'] = $message['id'];
                header('Location: index.php');
            } else {
                header('Location: ?page=login');
            }
            exit();
        }
        include './src/views/auth/login.php';
        break;

    case 'logout':
        $message = $authController->logout();
        $_SESSION['status'] = $message['status'];
        $_SESSION['message'] = 'Logout successful';
        header('Location: ?page=login');
        exit();

    case 'view_post':
        $postId = intval($_GET['id']);
        $post = $postController->getPost($postId);
        include './src/views/posts/view.php'; // Display the single post view
        break;

        // Add more cases for other actions like posting, editing, etc.

    default:
        include './src/views/posts/index.php';
        break;
}
