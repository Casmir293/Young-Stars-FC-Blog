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
                <form method="POST" action="?page=create_post&action=create_post" onsubmit="loadButton()" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image <span class="text-danger">*</span></label>
                        <input type="file" id="imageInput" name="image" class="d-none" accept="image/*" required>
                        <img id="imagePreview" class="mb-3" src="#" alt="" style="width: 100%; height: 150px; object-fit: cover; display: none;">
                        <div role="button" class="upload-img d-flex align-items-center flex-column border rounded border-primary">
                            <div class="py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-upload" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                </svg>
                            </div>
                            <p class="text-primary">Upload Img</p>
                        </div>
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
                            <input type="checkbox" class="btn-check" name="categories[]" value="updates" id="btncheck1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck1">Updates</label>

                            <input type="checkbox" class="btn-check" name="categories[]" value="tournament" id="btncheck2" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck2">Tournament</label>

                            <input type="checkbox" class="btn-check" name="categories[]" value="fun" id="btncheck3" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btncheck3">Fun</label>

                            <input type="checkbox" class="btn-check" name="categories[]" value="others" id="btncheck4" autocomplete="off">
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
    <script src="src/views/posts/posts.js"></script>
</body>

</html>