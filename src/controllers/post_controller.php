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
            $target = "assets/images/posts/" . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $image_path = $target;
            } else {
                $image_path = "";
            }

            $result = $this->postModel->create_post($user_id, $image_path, $title, $content, $categories);

            return $result;
        }
    }

    public function view_all_posts($category = null, $search_query = null, $page = 1, $limit = 12)
    {
        if ($search_query) {
            return $this->postModel->search_posts($search_query, $page, $limit);
        } else if ($category) {
            return $this->postModel->get_posts_by_category($category, $page, $limit);
        } else {
            return $this->postModel->get_all_posts($page, $limit);
        }
    }

    public function get_total_posts($category = null, $search_query = null)
    {
        if ($search_query) {
            return $this->postModel->get_total_search_posts($search_query);
        } else if ($category) {
            return $this->postModel->get_total_category_posts($category);
        } else {
            return $this->postModel->get_total_posts();
        }
    }

    public function view()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $post = $this->postModel->get_post_by_id($id);

            if ($post) {
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
