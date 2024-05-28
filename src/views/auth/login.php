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
            <form method="POST" action="?page=login&action=login" onsubmit="loadButton()">
                <h3 class="mb-4 text-center">Login your account</h3>
                <div class="mb-3">
                    <label class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" name="email" maxlength="50" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" maxlength="15" class="form-control" placeholder="Enter your password" required>
                    <div class="form-text mb-3"><a href="?page=forgot_password" class="">Forgot password?</a></div>
                </div>
                <div id="emailHelp" class="form-text mb-1">Don't have an account? <a href="?page=register">Register</a></div>
                <div id="emailHelp" class="form-text mb-3">Resend <a href="?page=verification">Email Verification</a></div>

                <button id="submit-form" type="submit" class="btn btn-primary w-100">Login</button>

                <button id="loading" class="btn btn-primary w-100 d-none" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
            </form>
        </div>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <script src="src/views/auth/auth.js"></script>
</body>

</html>