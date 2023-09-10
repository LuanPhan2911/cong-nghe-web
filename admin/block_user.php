<?php
require_once "../database/connect.php";
require_once "../middleware/session_start.php";
$id = $_GET['id'];
$action = $_GET['action'];
if (empty($id) || empty($action)) {
    header("location:users.php");
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
if (isset($result)) {
    $_SESSION["msg"] = "$action User Success!";
}

mysqli_close($connect);

header("location:users.php");
exit;
