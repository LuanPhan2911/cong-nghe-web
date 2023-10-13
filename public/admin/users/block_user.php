<?php

use App\Database\User;

require_once __DIR__ . "/../../../vendor/autoload.php";
if (!check_admin()) {
    redirect("/index.php");
    exit;
}
$id = htmlspecialchars($_GET['id']);
$action = htmlspecialchars($_GET['action']);
if (empty($id) || empty($action)) {
    redirect("/admin/user.php");
    exit;
}

$userModel = new User();
if ($action == "block") {
    $userModel->block($id);
} else {
    $userModel->unblock($id);
}


$action = ucfirst($action);

$_SESSION["msg"] = "$action user success!";

$redirect_back = $_SERVER['HTTP_REFERER'];

redirect($redirect_back);

exit;
