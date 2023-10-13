<?php

use App\Database\Report;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$id = htmlspecialchars($_GET['id']) ?? NULL;
$action = htmlspecialchars($_GET['action']) ?? 'finish';
$redirect_back =  $_SERVER['HTTP_REFERER'];
if (empty($id) || empty($action)) {
    redirect($redirect_back);
    exit;
}

$reportModel = new Report();

if ($action == 'finish') {
    $reportModel->finish($id);
} else {
    $reportModel->unFinish($id);
}

$action = ucfirst($action);
$_SESSION["msg"] = "$action reports success!";

redirect($redirect_back);
exit;
