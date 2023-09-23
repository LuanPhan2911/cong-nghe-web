<?php
require_once __DIR__ . "/database/connect.php";
$q = $_GET['q'] ?? NULL;
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($q)) {
    header($redirect_back);
    exit;
}
$query = "select * from stories where 
name like '%$q%' or author_name like '%$q%' or genres like'%$q%'";

$reviews = mysqli_query($connect, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>
    <title>Tìm kiếm</title>
</head>

<body>
    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class=" bg-white shadow p-3">
                        <h3 class="text-primary">Tìm kiếm kết quả cho "<span class="text-black"><?= $q ?></span>"</h3>
                        <?php if (mysqli_num_rows($reviews) > 0) : ?>
                            <?php require_once __DIR__ . "/pages/reviews.php" ?>
                        <?php else : ?>
                            <h4 class="text-secondary">Không tìm thấy kết quả phù hợp</h4>
                        <?php endif;  ?>


                    </div>

                </div>
                <div class="col-lg-4">
                    <?php require_once __DIR__ . "/pages/new_review.php" ?>

                </div>
            </div>
        </div>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
</body>

</html>