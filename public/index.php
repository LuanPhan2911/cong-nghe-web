<?php require_once __DIR__ . "/../vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <link rel="stylesheet" href="assets/css/home.css">

    <title>Trang chủ</title>
</head>

<body>
    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php require_once __DIR__ . "/pages/review/feature_review.php" ?>

                    <?php require_once __DIR__ . "/pages/review/favorite_review.php" ?>
                </div>
                <div class="col-lg-4">
                    <?php $comment_form = false ?>
                    <?php require_once __DIR__ . "/pages/review/new_review.php" ?>
                    <?php
                    require_once __DIR__ . "/pages/comment/comment_review.php"
                    ?>


                </div>

            </div>
        </div>

        <?php require_once __DIR__ .  "/layouts/toast_success.php" ?>
        <?php require_once __DIR__ .  "/layouts/toast_error.php" ?>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>


</body>

</html>