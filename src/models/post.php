<?php
require_once './config/db.php';

class Post
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    # CREATE POST
    public function create_post($user_id, $image_path, $title, $content, $categories)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, image, title, content, categories) VALUES ('$user_id', '$image_path', '$title', '$content', '$categories')");
        $post = $stmt->execute();

        if ($post) {
            return ['status' => true, 'message' => 'Post created successfully.'];
        } else {
            return ['status' => false, 'message' => 'Failed to create post.'];
        }
    }
}
