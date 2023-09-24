<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
$id = $_GET['id'] ?? NULL;
$comment_id = $_GET['comment_id'] ?? NULL;
$action = $_GET['action'] ?? 'block';
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($id) || empty($action) || empty($comment_id)) {
    header($redirect_back);
    exit;
}
$query = "update reports 
set
finish=1
where 
id='$id'
";
$result = mysqli_query($connect, $query);


$update_value = $action == "block" ? 'CURRENT_TIME()' : 'NULL';
$query = "update comments
set
deleted_at=$update_value
where
id='$comment_id'";

$result = mysqli_query($connect, $query);

$action = ucfirst($action);
if (isset($result)) {
    $_SESSION["msg"] = "$action comment success!";
}

mysqli_close($connect);

header($redirect_back);
exit;
