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
    <link rel="stylesheet" href="src/views/posts/posts.css">
    <style>
        .outer-wrapper {
            margin-top: 270px;
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

    <?php if (isset($_SESSION['message'])) {
        echo "<div class='alertContainer alert alert-success' role='alert' id='success-toast' onload='successAlert()'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
    } ?>

    <section class="container outer-wrapper">
        <section class="wrapper p-5 shadow-lg">
            <section>
                <div class="d-flex justify-content-between align-items-center">
                    <h3>All Users</h3>
                    <button type="submit" class="btn btn-outline-success my-3">Update Privilege</button>
                </div>

                <form action="update_privilege.php" method="POST">
                    <div>
                        <ol>
                            <?php foreach ($users as $user) : ?>
                                <li class="mb-3">
                                    <b><?= htmlspecialchars($user['username']) ?></b>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privilege[<?= $user['id'] ?>]" value="member" id="member_<?= $user['id'] ?>" <?= $user['privilege'] == 'member' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="member_<?= $user['id'] ?>">
                                                member
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privilege[<?= $user['id'] ?>]" value="editor" id="editor_<?= $user['id'] ?>" <?= $user['privilege'] == 'editor' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="editor_<?= $user['id'] ?>">
                                                editor
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="privilege[<?= $user['id'] ?>]" value="admin" id="admin_<?= $user['id'] ?>" <?= $user['privilege'] == 'admin' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="admin_<?= $user['id'] ?>">
                                                admin
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-success my-3">Update Privilege</button>
                        </div>
                    </div>
                </form>

            </section>
        </section>
    </section>
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <?php include_once(ROOT_PATH . '/src/views/templates/footer.php'); ?>
    <script src="src/views/posts/posts.js"></script>
</body>

</html>