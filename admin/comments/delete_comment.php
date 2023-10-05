<?php

require_once __DIR__ . "/../../database/Report.php";
require_once __DIR__ . "/../../database/Comment.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$comment_id = $_GET['comment_id'] ?? NULL;
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($comment_id)) {
    header($redirect_back);
    exit;
}

$reportModel = new Report();
$commentModel = new Comment();


$reportModel->delete(reported_type: 'comments', reported_id: $comment_id);


$commentModel->delete($comment_id);
$action = ucfirst($action);

$_SESSION["msg"] = "Delete comment success!";



header($redirect_back);
exit;
