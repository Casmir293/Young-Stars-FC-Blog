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

            // Handle file upload
            $image = $_FILES['image']['name'];
            $target = ROOT_PATH . "/assets/images/users/" . basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $image_path = "assets/images/users/" . basename($image);
                $result = $this->userModel->update_user_avatar($image_path, $id);

                return $result;
            } else {
                return ['status' => false, 'message' => 'Failed to upload image.'];
            }
        }
        return ['status' => false, 'message' => 'Invalid request.'];
    }
}
