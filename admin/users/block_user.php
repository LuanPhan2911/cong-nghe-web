<?php
require_once __DIR__ . "/../../database/connect.php";
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
$update_value = $action == "block" ? 'CURRENT_TIME()' : 'NULL';
$query = "update users 
set
deleted_at=$update_value
where 
id='$id'
";

$result = mysqli_query($connect, $query);
$action = ucfirst($action);
if (isset($result)) {
    $_SESSION["msg"] = "$action user success!";
}

mysqli_close($connect);

header("location:../users.php");
exit;
