<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
}
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
        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1 0 auto;
        }

        .footer {
            flex-shrink: 0;
        }

        .card-title {
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card-text {
            height: 60px;
            font-size: 0.75rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
</head>

<body>
    <div class="content">
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

        <section>
            <div class="container">
                <div class="row" style="margin-top: 70px;">
                    <?php if (isset($posts) && !empty($posts)) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center p-2">
                                <div class="card" style="width: 20rem; height: 27rem;">
                                    <img src="<?= htmlspecialchars($post['image']) ?>" style="height: 235px; object-fit:cover" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                                        <p class="card-text"><?= htmlspecialchars($post['content']) ?></p>
                                        <a href="?page=view_post&id=<?= htmlspecialchars($post['id']) ?>" class="btn btn-primary">Read more</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No posts available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>


    <div class="footer">
        <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
        <?php include_once(ROOT_PATH . '/src/views/templates/footer.php'); ?>
    </div>
</body>

</html>