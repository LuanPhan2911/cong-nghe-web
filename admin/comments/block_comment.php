<?php
require_once __DIR__ . "/../../database/Comment.php";
require_once __DIR__ . "/../../database/Report.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$report_id = $_GET['id'] ?? NULL;
$comment_id = $_GET['comment_id'] ?? NULL;
$action = $_GET['action'] ?? 'block';
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($report_id) || empty($action) || empty($comment_id)) {
    header($redirect_back);
    exit;
}

$reportModel = new Report();
$commentModel = new Comment();
$reportModel->finish($report_id);


if ($action == 'block') {
    $commentModel->block($comment_id);
} else {
    $commentModel->unBlock($comment_id);
}


$action = ucfirst($action);
$_SESSION["msg"] = "$action comment success!";


header($redirect_back);
exit;
