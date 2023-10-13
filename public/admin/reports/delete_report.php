<?php

use App\Database\Report;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    header("/index.php");
    exit;
}
$type = htmlspecialchars($_GET['type']) ?? NULL;
$redirect_back = $_SERVER['HTTP_REFERER'];
if (empty($type)) {
    redirect($redirect_back);
    exit;
}

if (!in_array($type, ['comments', 'stories'])) {
    redirect($redirect_back);
    exit;
}


$reportModel = new Report();

$result = $reportModel->deleteFinish($type);

$_SESSION["msg"] = "Delete finish reports success!";

redirect($redirect_back);
exit;
