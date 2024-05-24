<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young Stars FC</title>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_css.php'); ?>
</head>

<body>
    <?php include_once(ROOT_PATH . '/src/views/templates/auth_header.php'); ?>
    <section class="container outer-wrapper">
        <div class="wrapper p-5 shadow-lg">
            <form>
                <h3 class="mb-4 text-center">Login your account</h3>
                <div class="mb-3">
                    <label class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" name="email" maxlength="50" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" maxlength="15" class="form-control" placeholder="Enter your password" required>
                    <div class="form-text mb-3"><a href="form-text" class="">Forgot password?</a></div>
                </div>
                <div id="emailHelp" class="form-text mb-3">Don't have an account? <a href="">Register</a></div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
</body>

<style>
    .outer-wrapper {
        display: flex;
        justify-content: center;
        height: 94vh;
        align-items: center;
    }

    .wrapper {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        width: 100%;
        max-width: 500px;
    }
</style>

</html>