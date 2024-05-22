<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Young</title>
    <?php include_once('../templates/bootstrap_css.php'); ?>
</head>

<body>
    <?php include_once('../templates/auth_header.php'); ?>
    <section class="container outer-wrapper">
        <div class="wrapper p-5 shadow-lg">
            <form>
                <h3 class="mb-4 text-center">Register your account</h3>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm your password" required>
                </div>
                <div id="emailHelp" class="form-text mb-3">Already have an account? <a href="">Login</a></div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </section>

    <?php include_once('../templates/bootstrap_js.php'); ?>
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