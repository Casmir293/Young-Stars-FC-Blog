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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include_once(ROOT_PATH . '/src/views/templates/header.php'); ?>
    <!-- <?php include_once(ROOT_PATH . '/src/views/templates/unauthorized_header.php'); ?> -->
    <?php include_once(ROOT_PATH . '/src/views/templates/bootstrap_js.php'); ?>
    <?php if (isset($_SESSION['message'])) {
        echo "<div class='alertContainer alert alert-success' role='alert' id='success-toast' onload='successAlert()'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']);
    } ?>
    <!--  -->

    <section>
        <div class="container">
            <div class="row ">
                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center p-2">
                    <div class="card" style="width: 20rem; height: 27rem;">
                        <img src="https://www.heart.org/-/media/Images/News/SFTH/Archive/1019SFTHCixGreene_SC.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center p-2">
                    <div class="card" style="width: 20rem; height: 27rem;">
                        <img src="https://www.warnermusic.de/uploads/media/image-1002-704/07/17647-burna_4.jpg?v=2-0" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center p-2">
                    <div class="card" style="width: 20rem; height: 27rem;">
                        <img src="https://www.heart.org/-/media/Images/News/SFTH/Archive/1019SFTHCixGreene_SC.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center p-2">
                    <div class="card" style="width: 20rem; height: 27rem;">
                        <img src="https://www.warnermusic.de/uploads/media/image-1002-704/07/17647-burna_4.jpg?v=2-0" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center p-2">
                    <div class="card" style="width: 20rem; height: 27rem;">
                        <img src="https://www.warnermusic.de/uploads/media/image-1002-704/07/17647-burna_4.jpg?v=2-0" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>