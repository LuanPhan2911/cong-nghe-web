<?php

require_once __DIR__ . "/../../database/Story.php";
require_once __DIR__ . "/../../middleware/session.php";
require_once __DIR__ . "/../../helper/helper.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'] ?? NULL;


if (empty($id)) {
    header("location:../index.php");
    exit;
}

$storyModel = new Story();
$avatar = $storyModel->getAvatar($id);
if (!empty($avatar)) {
    remove_file($avatar);
}
$result = $storyModel->delete($id);
if (isset($result)) {
    $_SESSION["msg"] = "Delete review success!";
}

header("location:../index.php");
exit;
