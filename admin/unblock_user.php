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
deleted_at=null
where 
id='$id'
";
mysqli_query($connect, $query);
header("location:users.php");
