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

        @media only screen and (min-width: 600px) {
            .wrap {
                padding: 48px !important;
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
                <div>
                    <svg role="button" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                    </svg>
                    <svg role="button" xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                    </svg>
                    <span>2</span>
                </div>

                <h5 class="my-4"><?= htmlspecialchars($post['title']) ?></h5>

                <p>
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </p>
                <hr class="mb-5">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px"></textarea>
                    <label for="floatingTextarea2">Comment here...</label>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-primary my-3 ">Add Comment</button>
                    </div>
                </div>
            </div>

        </section>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <?php
    include_once(ROOT_PATH . '/src/views/templates/footer.php');
    ?>
</body>

</html>