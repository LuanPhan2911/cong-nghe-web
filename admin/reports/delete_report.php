<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
$type = $_GET['type'] ?? NULL;
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($type)) {
    header($redirect_back);
    exit;
}

if (!in_array($type, ['comments', 'stories'])) {
    header($redirect_back);
    exit;
}

$query = "delete from reports where finish=1 and reported_type='$type'";

$result = mysqli_query($connect, $query);

if (isset($result)) {
    $_SESSION["msg"] = "Delete finish reports success!";
}

mysqli_close($connect);

header($redirect_back);
exit;
