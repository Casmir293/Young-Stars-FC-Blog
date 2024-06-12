<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young Stars FC</title>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_css.php'); ?>
    <link rel="stylesheet" href="src/views/auth/auth.css">
</head>

<body>
    <?php include_once(ROOT_PATH . '/src/views/templates/auth_header.php'); ?>

    <?php if (isset($_SESSION['message']) && $_SESSION['status']) {
        echo "<div class='alertContainer alert alert-success' role='alert'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    } else if (isset($_SESSION['message']) && !$_SESSION['status']) {
        echo "<div class='alertContainer alert alert-danger' role='alert'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
        unset($_SESSION['status']);
    } ?>

    <section class="container outer-wrapper">
        <div class="wrapper p-5 shadow-lg">
            <form method="POST" action="?page=delete_user&action=delete_user" onsubmit="loadButton()">
                <h4 class="mb-4 text-center">Are you sure you want to delete your account?</h4>
                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" maxlength="15" placeholder="Enter your password" required>
                </div>
                <div class="form-text mb-3">Go back to <a href="?page=profile">Profile</a></div>
                <button id="submit-form" type="submit" class="btn btn-outline-danger w-100">Delete Account</button>

                <button id="loading" class="btn btn-outline-danger w-100 d-none" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
            </form>
        </div>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <?php
    include_once(ROOT_PATH . '/src/views/templates/footer.php');
    ?>
    <!-- <script src="src/views/auth/auth.js"></script> -->
    <script src="assets/js/app.js"></script>
</body>

</html>