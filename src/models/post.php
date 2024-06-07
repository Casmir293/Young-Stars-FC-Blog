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
        $categories_str = implode(',', $categories);
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, image, title, content, categories) VALUES ('$user_id', '$image_path', '$title', '$content', '$categories_str')");
        $post = $stmt->execute();

        if ($post) {
            return ['status' => true, 'message' => 'Post created successfully.'];
        } else {
            return ['status' => false, 'message' => 'Failed to create post.'];
        }
    }

    # GET ALL POSTS
    public function get_all_posts()
    {
        $stmt = $this->pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # GET ALL POSTS BY CATEGORY
    public function get_posts_by_category($category)
    {
        $stmt = $this->pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE FIND_IN_SET(?, categories) ORDER BY created_at DESC");
        $stmt->execute([$category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # GET SINGLE POST
    public function get_post_by_id($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = '$id'");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    # SEARCH POSTS 
    public function search_posts($search_query)
    {
        $stmt = $this->pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.title LIKE ? OR posts.content LIKE ? ORDER BY created_at DESC");
        $search_term = '%' . $search_query . '%';
        $stmt->execute([$search_term, $search_term]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
