<?php foreach ($reviews as $each) { ?>
    <div class="shadow review-content p-2 mb-3 position-relative border-bottom">
        <div class="row">
            <div class="col-4 mt-2">
                <img src="/assets/images/<?= $each['avatar'] ?>" alt="" class="img-fluid img-thumbnail">
            </div>
            <div class="col-8">
                <i class="bi bi-clock position-absolute top-0 end-0 badge bg-secondary">
                    <span class="date-from-now"><?= $each['created_at'] ?></span>
                </i>
                <a href="/review/<?= $each['id'] ?>" style="font-size: 1.5rem;" class="link-primary text-decoration-none">
                    <span class="story_name"><?= $each['name'] ?></span>
                </a>
                <div class="line-clamp-3 my-2" style="font-size: 14px;"><?= $each['description'] ?></div>
                <i class="bi bi-pen text-primary"> <span class="author_name"><?= $each['author_name'] ?></span></i>
                <i class="bi bi-eye position-absolute top-0 start-0 badge rounded-pill bg-primary"> <span><?= $each['view_count'] ?> lượt đọc</span></i>
            </div>
        </div>
    </div>
<?php } ?>