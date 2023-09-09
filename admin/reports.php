<?php
require_once "../middleware/session_start.php";
$brand = "Reports";
$check_admin = isset($_SESSION["id"]) &&  isset($_SESSION["role"]) && $_SESSION['role'] === true;
if (!$check_admin) {
    header("location:../");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "./layouts/styles.php" ?>
    <title>Admin - Reports</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once "./layouts/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once "./layouts/navbar.php" ?>
                </header>
                <main>

                </main>
            </div>
        </div>
    </div>





    <?php require_once "./layouts/script.php" ?>
</body>

</html>