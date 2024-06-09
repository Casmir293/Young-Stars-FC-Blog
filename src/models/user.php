<?php
require_once './config/db.php';

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function get_user_by_id($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT email, username, privilege, avatar, created_at FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
