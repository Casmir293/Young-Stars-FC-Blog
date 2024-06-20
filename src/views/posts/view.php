<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
}
require_once 'db.php';
require_once './src/controllers/post_controller.php';
$postController = new PostController($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young Stars FC</title>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_css.php'); ?>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .outer-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrap {
            background: #f8f9fa;
            margin-top: 50px;
            margin-bottom: 20px;
            border-radius: 8px;
            width: 1000px;
        }

        .date {
            font-size: 8px;
            color: gray;
        }

        @media only screen and (min-width: 600px) {
            .wrap {
                padding: 48px !important;
            }

            .comment-container {
                margin: 0px 150px;
                border: 1px solid gray;
                border-radius: 15px;
                padding: 32px;
            }
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['id'])) {
        include_once(ROOT_PATH . '/src/views/templates/header.php');
    } else {
        include_once(ROOT_PATH . '/src/views/templates/unauthorized_header.php');
    } ?>

    <?php if (isset($_SESSION['message']) && $_SESSION['status']) {
        echo "<div class='alertContainer alert alert-success' role='alert'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    } else if (isset($_SESSION['message']) && !$_SESSION['status']) {
        echo "<div class='alertContainer alert alert-danger' role='alert'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    } ?>
    <!--  -->

    <section class="container">
        <section class=" outer-wrap my-5">
            <div class="wrap p-3 shadow-lg">
                <p class="text-secondary fw-lighter">Posted by Admin <?= htmlspecialchars($post['created_at']) ?></p>
                <div class="d-flex justify-content-center ">
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="" class="rounded-3" style="width: 100%; height: 400px; object-fit: cover;">
                </div>
                <div id="like-section" class="d-flex align-items-center gap-2">
                    <div>
                        <form action="?page=view_post&action=react_post" method="POST">
                            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id']) ?>">
                            <?php if ($postController->postModel->is_post_liked($post['id'], $_SESSION['id'])) : ?>
                                <button type="submit" class="btn btn-link p-0">
                                    <svg id="unlike-btn" role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                    </svg>
                                </button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-link p-0">
                                    <svg id="like-btn" role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gold" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            <?php endif; ?>


                        </form>
                    </div>
                    <p id="like-count" class="fw-bold m-0"><?= htmlspecialchars($postController->postModel->get_like_count($post['id'])) ?></p>
                </div>

                <h5 class="my-4"><?= htmlspecialchars($post['title']) ?></h5>

                <p>
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </p>

                <div>
                    <button type="submit" class="btn btn-outline-danger my-3" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $post['id'] ?>">Delete Post</button>
                </div>
                <!-- modal -->
                <div class="modal fade" id="exampleModal<?= $post['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete post</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this post?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form method="POST" action="?page=view_post&action=delete_post">
                                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger my-3">Delete Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-5">

                <form action="?page=view_post&action=add_comment" method="POST">
                    <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['id']) ?>">
                    <div class="form-floating">
                        <textarea class="form-control" maxlength="600" placeholder="Leave a comment here" name="comment" id="floatingTextarea2" style="height: 150px" required></textarea>
                        <label for="floatingTextarea2">Comment here...</label>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-warning my-3">Add Comment</button>
                        </div>
                    </div>
                </form>

                <!-- All Comments -->
                <?php if ($comments) : ?>
                    <div class="comment-container">
                        <h5>Comments</h5>
                        <div class="mt-4">
                            <?php foreach ($comments as $comment) : ?>
                                <div class="mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= htmlspecialchars($comment['avatar']) ?>" alt="avatar" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%">
                                            <p class="fw-semibold m-0 ps-2"><?= htmlspecialchars(ucfirst($comment['username'])) ?>
                                        </div>
                                        <p class="date m-0"> <?= htmlspecialchars($comment['created_at']) ?></p>
                                    </div>
                                    <p class="mb-0 text-secondary">
                                        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                                    </p>
                                    <div class="d-flex justify-content-end">
                                        <!-- Only show delete button if the comment belongs to the logged-in user -->
                                        <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $comment['user_id']) : ?>
                                            <svg role="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $comment['id'] ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg>
                                            <!-- modal -->
                                            <div class="modal fade" id="exampleModal<?= $comment['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete comment</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this comment?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="?page=view_post&action=delete_comment" method="POST">
                                                                <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </section>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <?php
    include_once(ROOT_PATH . '/src/views/templates/footer.php');
    ?>
</body>

</html>