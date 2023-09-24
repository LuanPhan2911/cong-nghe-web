<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
require_once __DIR__ . "/../../helper/helper.php";
header('Content-Type: application/json; charset=utf-8');
// if (!check_admin()) {
//     header("location:../../index.php");
//     exit;
// }
$query = "select 
name, view_count
from stories
order by view_count desc
limit 10
";
$result = mysqli_query($connect, $query);


if (mysqli_num_rows($result) > 0) {
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
