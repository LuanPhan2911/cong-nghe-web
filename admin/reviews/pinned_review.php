<?php
require_once __DIR__ . "/../../database/Story.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'] ?? NULL;
$action = $_GET['action'] ?? 'pin';
if (empty($id) || empty($action)) {
    header("location:../index.php");
    exit;
}

$storyModel = new Story();
if ($action == "pin") {
    $storyModel->pinned($id);
} else {
    $storyModel->unPinned($id);
}
$action = ucfirst($action);
$_SESSION["msg"] = "$action review success!";



header("location:../index.php");
exit;
