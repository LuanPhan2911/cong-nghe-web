<?php
//newest review
$query = "select * from stories where deleted_at is NULL order by created_at desc limit 10";
$newest_review = mysqli_query($connect, $query);

?>

<div class="new-review p-2 bg-white shadow">
    <h3 class="text-primary">Mới đăng</h3>
    <ul class="list-unstyled p-2">
        <?php foreach ($newest_review as $each) { ?>
            <li>
                <a href="./review.php?id=<?= $each['id'] ?>" class="link-success text-decoration-none"><?= $each['name'] ?></a>
                <span class="badge bg-secondary date-from-now"><?= $each['created_at'] ?></span>
            </li>
        <?php } ?>
    </ul>
</div>

<?php require_once __DIR__ . "/../layouts/script.php" ?>