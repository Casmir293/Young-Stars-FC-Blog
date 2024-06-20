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
            <form id="registrationForm" method="POST" action="?page=register&action=register">
                <h3 class="mb-4 text-center">Register your account</h3>

                <div class="mb-3">
                    <label class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" name="email" maxlength="50" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" maxlength="50" class="form-control" aria-describedby="emailHelp" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" id="password" name="password" maxlength="15" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm password <span class="text-danger">*</span></label>
                    <input type="password" id="confirmPassword" maxlength="15" class="form-control" placeholder="Confirm your password" required>
                </div>
                <div class="form-text mb-3">Already have an account? <a href="?page=login">Login</a></div>

                <button id="submit-form" type="submit" class="btn btn-warning w-100">Submit</button>

                <button id="loading" class="btn btn-warning w-100 d-none" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
            </form>
            <div id="alertContainer" class="alertContainer"></div>
        </div>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <?php
    include_once(ROOT_PATH . '/src/views/templates/footer.php');
    ?>
    <script src="src/views/auth/auth.js"></script>
    <!-- <script src="assets/js/app.js"></script> -->
</body>

</html>