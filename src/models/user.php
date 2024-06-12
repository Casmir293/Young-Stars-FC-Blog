<?php
require_once './config/db.php';

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    # GET SINGLE USER
    public function get_user_by_id($id)
    {
        $stmt = $this->pdo->prepare("SELECT email, username, privilege, avatar, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    # UPDATE USER AVATAR
    public function update_user_avatar($image, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->execute([$image, $id]);
        if ($stmt) {
            return ['status' => true, 'message' => 'Avatar updated successfully.'];
        } else {
            return ['status' => false, 'message' => 'Could not update avatar, something went wrong.'];
        }
    }

    # DELETE ACCOUNT
    public function delete_user($id, $password)
    {
        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE id = ? AND deleted = 0");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $disable_stmt = $this->pdo->prepare("UPDATE users SET deleted = 1 WHERE id = ?");
                $disable_stmt->execute([$id]);
                return ['status' => true, 'message' => 'Account deleted successfully.'];
            } else {
                return ['status' => false, 'message' => 'Incorrect password'];
            }
        } else {
            return ['status' => false, 'message' => 'Invalid profile, something went wrong.'];
        }
    }
}
