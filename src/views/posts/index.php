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
</head>

<body>
    <?php include_once(ROOT_PATH . '/src/views/templates/header.php'); ?>
    <!-- <?php include_once(ROOT_PATH . '/src/views/templates/unauthorized_header.php'); ?> -->
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <h1>Welcome to Youngstar FC Blog</h1>
    <?php if (isset($_SESSION['message'])) {
        echo "<div class='alertContainer alert alert-success' role='alert' id='success-toast' onload='successAlert()'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
    } ?>
    <?php var_dump($_SESSION['id']); ?>

</body>

</html>