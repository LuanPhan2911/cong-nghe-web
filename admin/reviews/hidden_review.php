<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../database/Story.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'] ?? NULL;
$action = $_GET['action'] ?? NULL;

if (empty($id) || empty($action)) {
    header("location:../index.php");
    exit;
}
$storyModel = new Story();

if ($action == 'hide') {
    $storyModel->hide($id);
} else {
    $storyModel->show($id);
}
$action = ucfirst($action);
$_SESSION["msg"] = "$action review success!";




header("location:../index.php");
exit;
