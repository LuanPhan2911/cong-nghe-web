<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/../layouts/styles.php" ?>
    <title>Admin - Create Review</title>

</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php require_once __DIR__ . "/../layouts/admin/sidebar.php" ?>
            <div class="col">
                <header>
                    <?php require_once __DIR__ . "/../layouts/admin/navbar.php" ?>
                </header>
                <main>
                    <div class="container">
                        <div class="card shadow">
                            <div class="card-header bg-primary-subtle">
                                <h3 class="text-center">Create Review Form</h3>
                            </div>
                            <div class="card-body">
                                <form action="/admin/stories/create" method="post" enctype="multipart/form-data" id="create_review">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="avatar" class="d-flex justify-content-center mb-3 cursor-pointer">
                                                    <img src="/assets/images/reviews/default.png" class="img-thumbnail img-fluid story-avatar">
                                                </label>
                                                <div class="fst-italic fw-light text-center">Nhấn vào ảnh trên để thêm ảnh đại diện</div>
                                                <input class="form-control" name="avatar" type="file" id="avatar" accept="image/*" hidden />
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="bi bi-alt"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Story Name" name="name" id="name" value="<?php echo old_value('story_name') ?>">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="bi bi-pen"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Author Name" name="author_name" id="author_name" <?php echo old_value("author_name") ?>>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="bi bi-archive"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Genres" name="genres" id="genres" value="<?php echo old_value("genres") ?>">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="5" name="description"><?php echo old_value('description') ?></textarea>

                                        </div>
                                        <div class="mb-3">
                                            <label for="review-content">Review Content</label>
                                            <textarea class="form-control" id="review-content" rows="5" name="review_content"><?php echo old_value('review_content') ?></textarea>

                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn btn-primary px-5 d-block" type="submit">Create</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>



    <?php require_once __DIR__ . "/../layouts/toast_error.php" ?>

    <?php require_once __DIR__ . "/../layouts/script.php" ?>
    <script>
        $(function() {
            $("#create_review").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    author_name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    review_content: {
                        required: true,
                    },
                    genres: {
                        required: true,
                    },
                    avatar: {
                        required: true,
                        accept: "image/",

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
            let avatarUrl = null;
            $("#avatar").change(function(e) {

                let file = e.target.files[0];
                if (avatarUrl) {
                    URL.revokeObjectURL(avatarUrl);
                }
                avatarUrl = URL.createObjectURL(file);
                $(".story-avatar").attr("src", avatarUrl);


            })
        })
    </script>
</body>

</html>