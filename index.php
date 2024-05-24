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

        # LOGIN
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'login') {
            $message = $authController->login();

            if ($message['status']) {
                header('Location: ');
            } else {
                header('Location: ?page=login');
            }
            exit();
        } else {
            include './src/views/auth/login.php';
        }
        break;

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
