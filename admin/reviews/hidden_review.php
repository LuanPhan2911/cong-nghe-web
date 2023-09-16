<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
$id = $_GET['id'];
$action = $_GET['action'];

if (empty($id) || empty($action)) {
    header("location:../index.php");
    exit;
}

$update_value = $action == "hide" ? 'CURRENT_TIME()' : 'NULL';
$query = "update stories 
set
deleted_at=$update_value
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
