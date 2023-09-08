<?php
require_once "./middleware/check_login.php";

if (!check_login()) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/404.css">
    <title>404</title>
</head>

<body>
    <?php require_once "./layouts/header.php" ?>
    <main>

        <div class="container">
            <div class="row">
                <div class="col-12 ">
                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>
                    <div class="box_404 d-flex flex-column justify-content-center align-items-center">
                        <h3 class="h2">
                            Look like you're lost
                        </h3>

                        <p>the page you are looking for not avaible!</p>

                        <a href="./index.php" class="btn btn-success">Go to Home</a>
                    </div>

                </div>
            </div>
        </div>

        <?php
        require_once "./notify/toast_success.php"
        ?>

    </main>
    <?php require_once "./layouts/footer.php" ?>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>