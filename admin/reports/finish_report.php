<?php

require_once __DIR__ . "/../../database/Report.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'] ?? NULL;
$action = $_GET['action'] ?? 'finish';
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($id) || empty($action)) {
    header($redirect_back);
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

header($redirect_back);
exit;
