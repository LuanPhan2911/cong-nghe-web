<?php

use App\Database\Comment;
use App\Database\Report;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$report_id = htmlspecialchars($_GET['id']) ?? NULL;
$comment_id = htmlspecialchars($_GET['comment_id']) ?? NULL;
$action = htmlspecialchars($_GET['action']) ?? 'block';
$redirect_back =  $_SERVER['HTTP_REFERER'];
if (empty($report_id) || empty($action) || empty($comment_id)) {
    redirect($redirect_back);
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


redirect($redirect_back);
exit;
