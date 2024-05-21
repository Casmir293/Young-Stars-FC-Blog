<?php
require_once './config/db.php';
require_once './src/controllers/auth_controller.php';

$authController = new AuthController($pdo);
$message = $authController->register();

if ($message) {
    echo "<p>" . $message . "</p>";
}
