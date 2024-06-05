<?php
require_once './src/models/post.php';

class PostController
{
    private $postModel;

    public function __construct($pdo)
    {
        $this->postModel = new Post($pdo);
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

    public function view_all_posts()
    {
        $posts = $this->postModel->get_all_posts();
        return $posts;
    }

    public function view()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $post = $this->postModel->get_post_by_id($id);

            if ($post) {
                [$_SESSION['status'] => true];
                require(ROOT_PATH . '/src/views/posts/view.php');
            } else {
                header('Location: index.php');
                return [$_SESSION['status'] = false, $_SESSION['message'] = 'Post not found.'];
            }
        } else {
            header('Location: index.php');
            return [$_SESSION['status'] = false, $_SESSION['message'] = 'Invalid request.'];
        }
    }
}
