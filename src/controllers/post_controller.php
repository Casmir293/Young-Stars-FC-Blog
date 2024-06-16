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

    # VIEW POST WITH COMMENTS
    public function view()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $post = $this->postModel->get_post_by_id($id);
            $comments = $this->postModel->get_comments($id);

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

    # ADD A COMMENT
    public function add_comment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $post_id = $_POST['post_id'];
            $user_id = $_SESSION['id'];
            $comment = trim($_POST['comment']);

            if ($this->postModel->add_comment($post_id, $user_id, $comment)) {
                $_SESSION['message'] = 'Comment added successfully.';
                $_SESSION['status'] = true;
            } else {
                $_SESSION['message'] = 'Failed to add comment.';
                $_SESSION['status'] = false;
            }

            header("Location: ?page=view_post&id=$post_id");
            exit();
        }
    }

    // View post with comments
    // public function view_post($post_id)
    // {
    //     $post = $this->postModel->get_post_by_id($post_id);
    //     $comments = $this->postModel->get_comments($post_id);

    //     include(ROOT_PATH . '/src/views/posts/view.php');
    // }
}
