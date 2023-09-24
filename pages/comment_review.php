<div class="scrollbar comments-main bg-white my-3 p-3" style="max-height: 195vh; overflow-y: scroll;">
    <h3 class="text-primary">Bình luận</h3>
    <?php
    if ($comment_form) {
        require_once __DIR__ . "/comment_form.php";
    }
    ?>
    <?php require_once __DIR__ . "/comments.php" ?>
</div>