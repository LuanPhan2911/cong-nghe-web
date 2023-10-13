<?php

use App\Database\Report;

require_once __DIR__ . "/../../../vendor/autoload.php";

header('Content-Type: application/json; charset=utf-8');
$redirect_back = $_SERVER['HTTP_REFERER'];

$reported_type = htmlspecialchars($_POST['reported_type']) ?? NULL;
$reported_id = htmlspecialchars($_POST['reported_id']) ?? NULL;
$report_content = htmlspecialchars($_POST['content']) ?? NULL;



if (empty($reported_id) || empty($reported_type) || empty($report_content)) {
    echo json_encode([
        'message' => "Một vài trường dữ liệu bỏ bỏ trống!",
        'success' => false
    ]);
    return;
}

if (!in_array($reported_type, ['stories', 'comments'])) {
    echo json_encode([
        'message' => "Bạn chỉ có thể báo cáo reviews hoặc comments",
        'success' => false
    ]);
    return;
}

$reportModel = new Report();

$validReport = $reportModel->valid($reported_type, $reported_id);

if (empty($validReport)) {
    echo json_encode([
        'message' => "Nội dung báo cáo không hợp lệ!",
        'success' => false
    ]);
    return;
}


$result = $reportModel->insert(compact(['reported_id', 'reported_type', 'report_content']));

if (empty($result)) {
    echo json_encode([
        'message' => "=Có lỗi xảy ra!",
        'success' => false
    ]);
    return;
}


echo json_encode([
    'message' => "Báo cáo thành công!",
    'success' => true
]);
