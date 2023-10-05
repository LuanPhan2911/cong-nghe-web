<?php


require_once __DIR__ . "/../../database/User.php";

require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'];
$action = $_GET['action'];
if (empty($id) || empty($action)) {
    header("location:../user.php");
    exit;
}

$userModel = new User();
if ($action == "block") {
    $userModel->block($id);
} else {
    $userModel->unblock($id);
}


$action = ucfirst($action);
if (isset($result)) {
    $_SESSION["msg"] = "$action user success!";
}



header("location:../users.php");
exit;
