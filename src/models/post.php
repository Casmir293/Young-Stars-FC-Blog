<?php
require_once './config/db.php';

class Post
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    // POSTS

    # CREATE POST
    public function create_post($user_id, $image_path, $title, $content, $categories)
    {
        if (!is_array($categories)) {
            $categories = [$categories];
        }

        $categories_str = implode(',', $categories);
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, image, title, content, categories) VALUES (?, ?, ?, ?, ?)");
        $post = $stmt->execute([$user_id, $image_path, $title, $content, $categories_str]);

        if ($post) {
            return ['status' => true, 'message' => 'Post created successfully.'];
        } else {
            return ['status' => false, 'message' => 'Failed to create post.'];
        }
    }

    # GET ALL POSTS WITH PAGINATION
    public function get_all_posts($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.deleted = 0 ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # GET POSTS BY CATEGORY WITH PAGINATION
    public function get_posts_by_category($category, $page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.deleted = 0 AND FIND_IN_SET(?, categories) ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->bindParam(1, $category, PDO::PARAM_STR);
        $stmt->bindParam(2, $limit, PDO::PARAM_INT);
        $stmt->bindParam(3, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # GET TOTAL POSTS
    public function get_total_posts()
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM posts WHERE posts.deleted = 0");
        return $stmt->fetchColumn();
    }

    # GET TOTAL POSTS BY CATEGORY
    public function get_total_category_posts($category)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM posts WHERE posts.deleted = 0 AND FIND_IN_SET(?, categories)");
        $stmt->execute([$category]);
        return $stmt->fetchColumn();
    }

    # GET TOTAL SEARCH POSTS
    public function get_total_search_posts($search_query)
    {
        $search_term = '%' . $search_query . '%';
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM posts WHERE posts.deleted = 0 AND title LIKE ? OR content LIKE ?");
        $stmt->execute([$search_term, $search_term]);
        return $stmt->fetchColumn();
    }

    # GET SINGLE POST
    public function get_post_by_id($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE posts.deleted = 0 AND id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    # SEARCH POSTS WITH PAGINATION
    public function search_posts($search_query, $page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $search_term = '%' . $search_query . '%';
        $stmt = $this->pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.deleted = 0 AND posts.title LIKE ? OR posts.content LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?");
        $stmt->bindParam(1, $search_term, PDO::PARAM_STR);
        $stmt->bindParam(2, $search_term, PDO::PARAM_STR);
        $stmt->bindParam(3, $limit, PDO::PARAM_INT);
        $stmt->bindParam(4, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # DELETE POST
    public function delete_post($post_id)
    {
        $stmt = $this->pdo->prepare("UPDATE posts SET deleted = 1 WHERE deleted = 0 AND id = ?");
        return $stmt->execute([$post_id]);
    }

    # GET USER PRIVILAGE
    public function get_privilege($id)
    {
        $stmt = $this->pdo->prepare("SELECT privilege FROM users WHERE id = ? AND deleted = 0");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // COMMENTS

    # ADD COMMENT TO POST
    public function add_comment($post_id, $user_id, $comment)
    {
        $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $commented = $stmt->execute([$post_id, $user_id, $comment]);

        if ($commented) {
            return ['status' => true, 'message' => 'comment added successfully'];
        } else {
            return ['status' => false, 'message' => 'Failed to add comment.'];
        }
    }

    # GET COMMENTS FOR A POST
    public function get_comments($post_id)
    {
        $stmt = $this->pdo->prepare("SELECT comments.*, users.username, users.avatar FROM comments JOIN users ON comments.user_id = users.id WHERE comments.deleted = 0 AND post_id = ? ORDER BY created_at DESC");
        $stmt->execute([$post_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    # DELETE COMMENT
    public function delete_comment($comment_id, $user_id)
    {
        $stmt = $this->pdo->prepare("UPDATE comments SET deleted = 1 WHERE id = ? AND user_id = ?");
        return $stmt->execute([$comment_id, $user_id]);
    }

    // LIKES

    # LIKE POST
    public function like_post($post_id, $user_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
        return $stmt->execute([$post_id, $user_id]);
    }

    # UNLIKE POST
    public function unlike_post($post_id, $user_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
        return $stmt->execute([$post_id, $user_id]);
    }

    # IF POST IS LIKED
    public function is_post_liked($post_id, $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt->execute([$post_id, $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    # POST LIKE COUNT
    public function get_like_count($post_id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as like_count FROM likes WHERE post_id = ?");
        $stmt->execute([$post_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['like_count'];
    }
}
