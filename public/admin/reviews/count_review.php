<?php

use App\Database\Story;

require_once __DIR__ . "/../../../vendor/autoload.php";
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
