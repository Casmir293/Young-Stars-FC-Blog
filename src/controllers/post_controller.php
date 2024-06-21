<?php
require_once './src/models/post.php';

class PostController
{
    public $postModel;

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

    # DELETE A POST
    public function delete_post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $post_id = $_POST['post_id'];

            if ($this->postModel->delete_post($post_id)) {
                $_SESSION['message'] = 'Post deleted successfully.';
                $_SESSION['status'] = true;
            } else {
                $_SESSION['message'] = 'Failed to delete post.';
                $_SESSION['status'] = false;
            }

            header("Location: index.php");
            exit();
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
        }
    }

    # ADD A COMMENT
    public function add_comment()
    {
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['id'];
        $comment = trim($_POST['comment']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            if ($this->postModel->add_comment($post_id, $user_id, $comment)) {
                $_SESSION['message'] = 'Comment added successfully.';
                $_SESSION['status'] = true;
            } else {
                $_SESSION['message'] = 'Failed to add comment.';
                $_SESSION['status'] = false;
            }
            header("Location: ?page=view_post&id=$post_id");
            exit();
        } else {
            $_SESSION['message'] = 'Login to add comment.';
            $_SESSION['status'] = false;
            header("Location: ?page=view_post&id=$post_id");
            exit();
        }
    }

    # DELETE A COMMENT
    public function delete_comment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $comment_id = $_POST['comment_id'];
            $user_id = $_SESSION['id'];
            $post_id = $_POST['post_id'];

            if ($this->postModel->delete_comment($comment_id, $user_id)) {
                $_SESSION['message'] = 'Comment deleted successfully.';
                $_SESSION['status'] = true;
            } else {
                $_SESSION['message'] = 'Failed to delete comment.';
                $_SESSION['status'] = false;
            }

            header("Location: ?page=view_post&id=$post_id");
            exit();
        }
    }

    # LIKE AND UNLIKE POST
    public function like_post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id'])) {
            $post_id = $_POST['post_id'];
            $user_id = $_SESSION['id'];

            if ($this->postModel->is_post_liked($post_id, $user_id)) {
                $this->postModel->unlike_post($post_id, $user_id);
            } else {
                $this->postModel->like_post($post_id, $user_id);
            }
            header("Location: ?page=view_post&id=$post_id");
            exit();
        }
    }
}
