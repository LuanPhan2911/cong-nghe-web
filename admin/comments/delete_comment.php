<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
$comment_id = $_GET['comment_id'] ?? NULL;
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($comment_id)) {
    header($redirect_back);
    exit;
}
$query = "delete from reports where reported_id='$comment_id' and reported_type='comments'";
$result = mysqli_query($connect, $query);


$query = "delete from comments where id='$comment_id'";

$result = mysqli_query($connect, $query);

$action = ucfirst($action);
if (isset($result)) {
    $_SESSION["msg"] = "Delete comment success!";
}

mysqli_close($connect);

header($redirect_back);
exit;
