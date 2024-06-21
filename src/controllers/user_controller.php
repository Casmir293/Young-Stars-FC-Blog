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

    # CHANGE PASSWORD
    public function update_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            $response = $this->userModel->update_password($id, $old_password, $new_password);
            return $response;
        }
    }

    # DELETE ACCOUNT
    public function delete_user()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $password = $_POST['password'];

            $response = $this->userModel->delete_user($id, $password);

            if ($response['status']) {
                header('Location: ?page=login');
                return $response;
            }
            header('Location: ?page=delete_user');
            return $response;
        }
        return ['status' => false, 'message' => 'Invalid request.'];
    }

    # GET ALL USERS
    public function get_all_users()
    {
        return $this->userModel->get_all_users();
    }

    # UPDATE PRIVILEGE
    public function update_privilege()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $privileges = $_POST['privilege'];

            foreach ($privileges as $id => $privilege) {
                $this->userModel->update_privilege($privilege, $id);
            }
            return ['status' => true, 'message' => 'Privileges updated successfully.'];
        } else {
            return ['status' => false, 'message' => 'Unauthorized access.'];
        }
    }
}
