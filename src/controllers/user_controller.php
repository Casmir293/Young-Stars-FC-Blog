<?php
require_once './src/models/user.php';

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    # VIEW PROFILE
    public function view_user_profile()
    {
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $user_details = $this->userModel->get_user_by_id($id);
            return $user_details;
        } else {
            header('Location: index.php');
            exit();
        }
    }

    # CHANGE AVATAR
    public function update_avatar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $avatar = $_POST['avatar'];
            $result = $this->userModel->update_user_avatar($avatar, $id);
            return $result;
        }
    }
}
