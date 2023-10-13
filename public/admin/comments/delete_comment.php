<?php

use App\Database\Comment;
use App\Database\Report;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$comment_id = htmlspecialchars($_GET['comment_id']) ?? NULL;
$redirect_back =  $_SERVER['HTTP_REFERER'];
if (empty($comment_id)) {
    redirect($redirect_back);
    exit;
}

$reportModel = new Report();
$commentModel = new Comment();


$reportModel->delete(reported_type: 'comments', reported_id: $comment_id);


$commentModel->delete($comment_id);
$action = ucfirst($action);

$_SESSION["msg"] = "Delete comment success!";



redirect($redirect_back);
exit;
