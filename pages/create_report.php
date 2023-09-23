<?php
require_once __DIR__ . "/../database/connect.php";
require_once __DIR__ . "/../middleware/session.php";
header('Content-Type: application/json; charset=utf-8');
$redirect_back = "location:" . $_SERVER['HTTP_REFERER'];
$reported_type = $_POST['reported_type'] ?? NULL;
$reported_id = $_POST['reported_id'] ?? NULL;
$report_content = $_POST['content'] ?? NULL;



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

$query = "select * from $reported_type where id= '$reported_id'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) < 0) {
    echo json_encode([
        'message' => "Nội dung báo cáo không hợp lệ!",
        'success' => false
    ]);
    return;
}

$query = "insert into reports(reported_id, reported_type, content)
values('$reported_id','$reported_type', '$report_content')";
$result = mysqli_query($connect, $query);

if ($result) {
    echo json_encode([
        'message' => "Báo cáo thành công!",
        'success' => true
    ]);
    return;
}

echo json_encode([
    'message' => "=Có lỗi xảy ra!",
    'success' => false
]);
return;
