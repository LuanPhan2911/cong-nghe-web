<?php

require_once __DIR__ . "/../../database/Report.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
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


$reportModel = new Report();

$result = $reportModel->deleteFinish($type);

$_SESSION["msg"] = "Delete finish reports success!";

header($redirect_back);
exit;
