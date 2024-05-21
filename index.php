<?php
require_once './config/db.php';
require_once './src/controllers/auth_controller.php';
require_once './src/controllers/post_controller.php';

$authController = new Auth($pdo);

$action = $_GET['action'] ?? 'default';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $message = $authController->login($email, $password);
            echo $message;
        } else {
            include './src/views/auth/login.php';
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $message = $authController->register($username, $email, $password);
            echo $message;
        } else {
            include './src/views/auth/register.php';
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
