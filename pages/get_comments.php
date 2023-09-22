<?php
require_once __DIR__ . "/../database/connect.php";
require_once __DIR__ . "/../middleware/session.php";
header('Content-Type: application/json; charset=utf-8');
$story_id = $_GET['id'] ?? NULL;

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$query = "select 
comments.id, comments.content, comments.created_at, 
users.name as user_name, users.avatar as user_avatar,
stories.name as story_name, stories.id as story_id
from comments 
join users on users.id= comments.user_id
join stories on stories.id = comments.story_id ";
if (empty($story_id)) {
    $query .= "where comments.deleted_at is NULL ";
} else {
    $query .= "where comments.story_id='$story_id' and comments.deleted_at is NULL ";
}

$query .= "order by comments.created_at desc
limit $limit offset $offset";

$result = mysqli_query($connect, $query);


// count comment
$query = "select count(*) from comments ";
if (empty($story_id)) {
    $query .= "where comments.deleted_at is NULL ";
} else {
    $query .= "where comments.story_id='$story_id' and comments.deleted_at is NULL ";
}
$count_record = mysqli_query($connect, $query);

$total_record = mysqli_fetch_column($count_record);
$total_page = ceil(intval($total_record) / intval($limit));
//end count comment

$next_page = $page + 1;
if ($next_page > $total_page) {
    $next_page = NULL;
}

$comments = [];
foreach ($result as $each) {
    $comments[] = $each;
}


echo json_encode([
    "data" => [
        'data' => $comments,
        'next_page' => $next_page,
    ],
    "success" => true,

]);
