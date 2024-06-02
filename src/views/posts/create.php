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
    <link rel="stylesheet" href="src/views/posts/posts.css">

    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_css.php'); ?>
</head>

<body>
    <?php if (isset($_SESSION['id'])) {
        include_once(ROOT_PATH . '/src/views/templates/header.php');
    } else {
        include_once(ROOT_PATH . '/src/views/templates/unauthorized_header.php');
    } ?>

    <?php if (isset($_SESSION['message'])) {
        echo "<div class='alertContainer alert alert-success' role='alert' id='success-toast' onload='successAlert()'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
    } ?>

    <section class="container outer-wrapper">
        <section class="wrapper p-5 shadow-lg">
            <section>

                <form method="POST" action="?page=create_post&action=create_post" onsubmit="loadButton()">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image <span class="text-danger">*</span></label>
                        <img role="button" src="https://jacquipaterson.com/wp-content/uploads/2018/05/shutterstock_385167373.jpg" alt="" style="width: 100%; height:150px; object-fit:cover;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                        <input name="title" maxlength="150" class="form-control" placeholder="Enter post title" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" placeholder="Enter post content" style="height: 100px" required></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck1">Updates</label>

                            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck2">Tournament</label>

                            <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck3">Fun</label>

                            <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck4">Others</label>
                        </div>
                    </div>

                    <button id="submit-form" type="submit" class="btn btn-primary w-100">Post</button>

                    <button id="loading" class="btn btn-primary w-100 d-none" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </form>
            </section>
        </section>
    </section>





    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
</body>

</html>