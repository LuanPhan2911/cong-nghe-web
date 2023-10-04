<?php
require_once __DIR__ . "/../middleware/session.php";
?>


<?php if (check_login()) : ?>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-3 d-flex flex-column align-items-center justify-content-center my-3">
                <img src="./assets/images/<?= $_SESSION['user_avatar'] ?>" class="img-fluid" style="width: 50px; height: 50px; border-radius: 50%;">
                <div class="text-primary text-center" style="font-size: 14px;"><?= $_SESSION['user_name'] ?></div>


            </div>
            <div class="col-9">
                <div class="card-body">
                    <form action="pages/create_comment.php" method="post" id="comment-form">
                        <input type="hidden" name="story_id" value="<?= $story['id'] ?>">
                        <textarea name="comment_content" rows="5" class="form-control" id="comment_content"><?= old_value('comment_content') ?></textarea>

                        <button class="btn btn-primary position-absolute bottom-0 end-0" type="submit">
                            <i class="bi bi-send"></i>
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="text-warning mb-2">Cần đăng nhập để bình luận
        <a href="./login.php" class="link-primary text-decoration-none"> Đăng nhập</a>
    </div>
<?php endif;  ?>
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