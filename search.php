<?php
require_once __DIR__ . "/database/Story.php";
$q = $_GET['q'] ?? NULL;
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($q)) {
    header($redirect_back);
    exit;
}
$storyModel = new Story();

$reviews = $storyModel->findAll($q);


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
                        <?php if (!empty($reviews)) : ?>
                            <?php require_once __DIR__ . "/pages/review/review_content.php" ?>
                        <?php else : ?>
                            <h4 class="text-secondary">Không tìm thấy kết quả phù hợp</h4>
                        <?php endif;  ?>


                    </div>

                </div>
                <div class="col-lg-4">
                    <?php require_once __DIR__ . "/pages/review/new_review.php" ?>

                </div>
            </div>
        </div>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
    <script>
        $(function() {
            const urlParams = new URLSearchParams(window.location.search);

            $('.story_name').mark(urlParams.get('q'));
            $('.author_name').mark(urlParams.get('q'));
        })
    </script>
</body>

</html>