<?php

use App\Database\Story;

$storyModel = new Story();

[
    'data' => $reviews,
    'total_record' => $total_record,
    'total_page' => $total_page,
    'current_page' => $page,
] = $storyModel->paginate();

$prev = $page - 1;
$next = $page + 1;

?>
<div class="reviews p-3 bg-white my-3">
    <h3 class="text-primary">Xem nhiều</h3>
    <?php require_once __DIR__ . "/review_content.php" ?>
    <?php require_once __DIR__ . "/../paginate.php" ?>
</div>