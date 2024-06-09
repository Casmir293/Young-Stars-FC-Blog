<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young Stars FC</title>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_css.php'); ?>
    <link rel="stylesheet" href="src/views/user/user.css">
    <style>
        .outer-wrapper {
            margin-top: 230px;
            margin-bottom: 250px;
        }

        @media only screen and (min-width: 600px) {
            .outer-wrapper {
                margin-top: 90px;
                margin-bottom: 110px;
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

    <section class="container outer-wrapper">
        <div class="wrapper p-5 shadow-lg">
            <p class="text-center fw-bold">Admin | Editor | Member</p>
            <div class="d-flex flex-column align-items-center">
                <img class="rounded" src="https://www.parentmap.com/images/article/7877/BOY_feature_credit_will_austin_848x1200.jpg" style="width: 100px; height:150px;" alt="">
                <div role="button" class="rounded-pill  bg-secondary py-1 px-3 mt-2 text-light">upload</div>
            </div>
            <div class="mt-3">
                <p><b>Email</b>: casmir293@gmail.com</p>
                <p><b>Username</b>: casmir293</p>
                <p><b>Member since</b>: 2024-05-23</p>

                <button id="submit-form" type="submit" class="btn btn-primary w-50">Save Photo</button>

                <button id="loading" class="btn btn-primary w-100 d-none" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
                <hr>
                <h6 class="text-center"><b>Update Password</b></h6>
                <form action="">
                    <div class="mb-3">
                        <label class="form-label">Old Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" name="password" maxlength="15" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">New password <span class="text-danger">*</span></label>
                        <input type="password" id="newPassword" maxlength="15" class="form-control" placeholder="Confirm your password" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm password <span class="text-danger">*</span></label>
                        <input type="password" id="confirmPassword" maxlength="15" class="form-control" placeholder="Confirm your password" required>
                    </div>

                    <button id="submit-form" type="submit" class="btn btn-primary w-100">Update Password</button>

                    <button id="loading" class="btn btn-primary w-100 d-none" type="button" disabled>
                        <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                        <span role="status">Loading...</span>
                    </button>
                </form>

            </div>
        </div>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <div class="fixed-bottom">
        <?php
        include_once(ROOT_PATH . '/src/views/templates/footer.php');
        ?>
    </div>

    <script src="src/views/auth/auth.js"></script>
</body>

</html>