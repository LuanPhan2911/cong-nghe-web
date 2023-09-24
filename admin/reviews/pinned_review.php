<?php
require_once __DIR__ . "/../../database/connect.php";
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
$update_value = $action == "pin" ? '1' : '0';
$query = "update stories 
set
pinned=$update_value
where 
id='$id'
";

$result = mysqli_query($connect, $query);
$action = ucfirst($action);
if (isset($result)) {
    $_SESSION["msg"] = "$action review success!";
}

mysqli_close($connect);

header("location:../index.php");
exit;
