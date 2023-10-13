<?php

use App\Database\Story;

$storyModel = new Story();

$feature_review = $storyModel->getFeatureReview();
?>

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