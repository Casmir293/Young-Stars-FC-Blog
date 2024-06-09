<?php
require_once './src/models/user.php';

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function view_user_profile()
    {
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $user_details = $this->userModel->get_user_by_id($user_id);
            return $user_details;
        } else {
            header('Location: index.php');
            exit();
        }
    }
}
