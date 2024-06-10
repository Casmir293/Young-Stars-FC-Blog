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
}
