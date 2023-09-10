<?php
require_once "../database/connect.php";
require_once "../middleware/session_start.php";
$id = $_GET['id'];
if (empty($id)) {
    header("location:users.php");
    exit;
}

$query = "update users 
set
deleted_at=CURRENT_TIME()
where 
id='$id'
";
$result = mysqli_query($connect, $query);
if (isset($result)) {
    $_SESSION["msg"] = "Block User Success!";
}

header("location:users.php");
exit;
