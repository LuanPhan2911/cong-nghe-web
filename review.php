<?php
require_once __DIR__ . "/database/connect.php";
require_once __DIR__ . "/middleware/session.php";
$id = $_GET['id'];
if (empty($id)) {
    header("location:404.php");
    exit;
}

//newest review
$query = "select * from stories where deleted_at is NULL order by created_at desc limit 10";
$newest_review = mysqli_query($connect, $query);

$query = "select * from stories where deleted_at is NULL and id='$id'";
$result = mysqli_query($connect, $query);
$story = mysqli_fetch_array($result);



if (empty($story)) {
    header("location:./404.php");
    exit;
}
// update view count

$query = "update stories set
    view_count=view_count +1
    where 
    id= '$id'";
mysqli_query($connect, $query);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>

    <title><?= $story['name'] ?></title>

</head>

<body>
    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="p-3 mb-3 bg-white shadow position-relative">
                        <button class="report-review btn bg-transparent position-absolute top-0 end-0" data-type="stories" data-id="<?= $story['id'] ?>">
                            <i class="bi bi-flag-fill text-primary" data-bs-toggle="tooltip" data-bs-title="Báo cáo review" data-bs-custom-class="custom-tooltip"></i>
                        </button>
                        <h3 class="text-primary"><?= $story['name'] ?></h3>
                        <div class="p-2">
                            <img src="assets/images/<?= $story['avatar'] ?>" style="height: 400px; width: 100%;" />
                        </div>
                        <div class="review-content">
                            <div class="name">
                                <span class="text-primary fst-italic">Tên truyện: </span><?= $story['name'] ?>
                            </div>
                            <div class="author">
                                <span class="text-primary fst-italic">Tác giả: </span><?= $story['author_name'] ?>
                            </div>
                            <div class="all-tags">
                                <span class="text-primary fst-italic">Thể loại: </span><?= $story['genres'] ?>
                            </div>
                            <div class="description line-break">
                                <?= $story['description'] ?>

                            </div>
                            <div class="review">
                                <?= $story['review_content'] ?>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-lg-4">
                    <?php $comment_form = true ?>
                    <?php require_once __DIR__ . "/pages/new_review.php" ?>
                    <?php require_once __DIR__ . "/pages/comment_review.php" ?>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
    <?php require_once __DIR__ . "/layouts/toast_error.php" ?>
    <?php require_once __DIR__ . "/layouts/toast_success.php" ?>
    <script>
        $('.report-review').click(function() {

            reported_type = $(this).data('type');
            reported_id = $(this).data('id');

            $('#reported_type').val(reported_type);
            $('#reported_id').val(reported_id);

            $('#report-modal').modal('show');
            $('#report-content').val('');


        })
    </script>

</body>

</html>