<?php

use App\Database\Story;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$id = htmlspecialchars($_GET['id']) ?? NULL;
$action = htmlspecialchars($_GET['action']) ?? NULL;
if (empty($id) || empty($action)) {
    redirect("/admin/index.php");
    exit;
}

$storyModel = new Story();
switch ($action) {
    case 'pin':
        $storyModel->pinned($id);
        break;
    case 'unpin':
        $storyModel->unPinned($id);
        break;
    case 'show':
        $storyModel->show($id);
        break;
    case 'hide':
        $storyModel->hide($id);
        break;
    default:
        break;
}
$action = ucfirst($action);
$_SESSION["msg"] = "$action review success!";



redirect("/admin/index.php");
exit;
