<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young Stars FC</title>
    <?php include_once('../templates/bootstrap_css.php'); ?>
</head>

<body>
    <?php include_once('../templates/auth_header.php'); ?>
    <section class="container outer-wrapper">
        <div class="wrapper p-5 shadow-lg">
            <form id="registrationForm" method="post" action="">
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
                <div id="emailHelp" class="form-text mb-3">Already have an account? <a href="">Login</a></div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
            <div id="alertContainer"></div>
        </div>
    </section>
    <?php include_once('../templates/bootstrap_js.php'); ?>
    <script src="./auth.js"></script>
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

    #alertContainer {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .alert {
        animation: slide-in 0.5s forwards, slide-out 0.5s 2.5s forwards;
    }

    @keyframes slide-in {
        from {
            opacity: 0;
            transform: translateX(100%);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slide-out {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>

</html>