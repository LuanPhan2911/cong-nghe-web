<?php
require_once __DIR__ . "/../../database/Story.php";
require_once __DIR__ . "/../../middleware/session.php";
require_once __DIR__ . "/../../helper/helper.php";
header('Content-Type: application/json; charset=utf-8');

$storyModel = new Story();

$result = $storyModel->getReviewChart();




if (isset($result)) {
    $data = [];
    foreach ($result as $each) {
        $data[] = $each;
    }
    echo json_encode([
        "data" => $data,
        "success" => true
    ]);
    return;
}
echo json_encode([
    "data" => [],
    "success" => false
]);
