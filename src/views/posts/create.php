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
                hi
            </section>
        </section>
    </section>





    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
</body>

</html>