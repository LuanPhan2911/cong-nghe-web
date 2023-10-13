<?php

use App\Database\Story;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$id = htmlspecialchars($_GET['id']) ?? NULL;


if (empty($id)) {
    redirect("/admin/index.php");
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

redirect("/admin/index.php");
exit;
