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
    header("location:404.php");
    exit;
}

// $query = "select 
// comments.id, comments.content, comments.created_at, 
// users.name as user_name, users.avatar as user_avatar
// from comments 
// join users on users.id= comments.user_id
// where comments.story_id='$id' and comments.deleted_at is NULL
// order by comments.created_at desc";

// $comments = mysqli_query($connect, $query);


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
                <div class="col-lg-8 bg-white p-3">
                    <h3><?= $story['name'] ?></h3>
                    <div class="p-2">
                        <img src="assets/images/<?= $story['avatar'] ?>" style="height: 400px; width: 100%;" />
                    </div>
                    <div class="review-content line-break">
                        <div class="name"><?= $story['name'] ?></div>
                        <div class="author"> Tác giả: <?= $story['author_name'] ?></div>
                        <div class="all-tags">Thể loại: <?= $story['genres'] ?></div>
                        <div class="description">
                            <?= $story['description'] ?>

                        </div>
                        <div class="review">
                            <?= $story['review_content'] ?>
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
        $(function() {
            $("#comment-form").validate({
                rules: {

                    comment_content: {
                        required: true
                    }

                },
                messages: {

                    comment_content: {
                        required: "Nội dung bình luận không được để trống!"
                    }

                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            })

        })
    </script>
</body>

</html>