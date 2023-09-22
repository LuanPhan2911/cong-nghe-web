<?php
// require_once __DIR__ . "/../database/connect.php";
// require_once __DIR__ . "/../middleware/session.php";
// $story_id = $_GET['id'];

// $query = "select 
// comments.id, comments.content, comments.created_at, 
// users.name as user_name, users.avatar as user_avatar
// from comments 
// join users on users.id= comments.user_id
// where comments.story_id='$story_id' and comments.deleted_at is NULL
// order by comments.created_at desc";

// $comments = mysqli_query($connect, $query);
?>

<!-- <?php if (mysqli_num_rows($comments) > 0) : ?>
    <?php foreach ($comments as $each) { ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-3 d-flex flex-column align-items-center my-3">
                    <img src="./assets/images/<?= $each['user_avatar'] ?? 'users/default.webp' ?>" class="img-fluid user-avatar">
                </div>
                <div class="col-9">
                    <div class="card-body">
                        <div class="badge bg-secondary date-from-now position-absolute top-0 end-0 m-1"><?= $each['created_at'] ?></div>
                        <div class="text-primary" style="font-size: 14px;"><?= $each['user_name'] ?></div>

                        <div><?= $each['content'] ?></div>
                        <i class="bi bi-flag-fill position-absolute bottom-0 end-0 p-2 cursor-pointer" id="report-btn" data-bs-toggle="modal" data-bs-target="#report-modal"></i>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php else : ?>
    <div class="text-primary">
        Review chưa có bình luận nào
    </div>
<?php endif;  ?> -->