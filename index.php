<?php
require_once __DIR__ . "/database/connect.php";
//feature review
$query = "select * from stories where deleted_at is NULL and pinned='1' limit 5";
$feature_review = mysqli_query($connect, $query);

//newest review
$query = "select * from stories where deleted_at is NULL order by created_at desc limit 10";
$newest_review = mysqli_query($connect, $query);

//favorite review

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$query = "select * from stories where deleted_at is NULL order by view_count desc limit $limit offset $offset ";
$favorite_reviews = mysqli_query($connect, $query);

$query = "select count(*) from stories";
$count_record = mysqli_query($connect, $query);

$total_record = mysqli_fetch_column($count_record);
$total_page = ceil(intval($total_record) / intval($limit));


$prev = $page - 1;
$next = $page + 1;

?>
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
                    <div class="feature-review p-3 bg-white shadow">
                        <h3 class="text-primary">Đề cử</h3>
                        <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($feature_review as $index => $each) { ?>
                                    <a href="review.php?id=<?= $each['id'] ?>" class="carousel-item <?= $index === 0 ? 'active' : ''  ?>">
                                        <img src="assets/images/<?= $each['avatar'] ?>" class="img-fluid img-thumbnail">
                                        <div class="carousel-caption d-none d-md-block bg-white">
                                            <h2><?= $each['name'] ?></h2>
                                        </div>
                                    </a>
                                <?php } ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>

                            </button>
                            <button class=" carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>

                            </button>
                        </div>
                    </div>

                    <div class="reviews p-3 bg-white my-3">

                        <h3 class="text-primary">Xem nhiều</h3>
                        <?php
                        $reviews = $favorite_reviews
                        ?>
                        <?php require_once __DIR__ . "/pages/reviews.php" ?>
                        <?php require_once __DIR__ . "/pages/paginate.php" ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php $comment_form = false ?>
                    <?php require_once __DIR__ . "/pages/new_review.php" ?>
                    <?php require_once __DIR__ . "/pages/comment_review.php" ?>


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