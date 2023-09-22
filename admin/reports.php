<?php
require_once __DIR__ . "/../middleware/session.php";
$breadcrumb = [
    [
        "url" => "./index.php",
        "name" => "Home"
    ],
    [
        "url" => "",
        "name" => "Reports"
    ],
];
if (!check_admin()) {
    header("location:../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Admin - Reports</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once __DIR__ . "/layouts/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/layouts/navbar.php" ?>
                </header>
                <main>

                </main>
            </div>
        </div>
    </div>





    <?php require_once __DIR__ . "/layouts/script.php" ?>
</body>

</html>