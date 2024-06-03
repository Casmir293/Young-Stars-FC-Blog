<?php
require_once './src/models/post.php';

class PostController
{
    private $postModel;

    public function __construct($postModel)
    {
        $this->postModel = $postModel;
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $categories = implode(',', $_POST['categories']);
            $user_id = $_SESSION['id'];

            // Handle file upload
            $image = $_FILES['image']['name'];
            $target = "uploads/" . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $image_path = $target;
            } else {
                $image_path = ""; // Or handle the error
            }

            $result = $this->postModel->create_post($user_id, $image_path, $title, $content, $categories);

            return $result;
        }
    }
}
