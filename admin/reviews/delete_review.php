<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
require_once __DIR__ . "/../../helper/helper.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'] ?? NULL;


if (empty($id)) {
    header("location:../index.php");
    exit;
}

$query = "select avatar from stories where id='$id'";
$result = mysqli_query($connect, $query);
$avatar = mysqli_fetch_column($result);
if (empty($avatar)) {
    header("location:../index.php");
    exit;
}
remove_file($avatar);


$query = "delete from stories where id='$id'";
$result = mysqli_query($connect, $query);

if (isset($result)) {
    $_SESSION["msg"] = "Delete review success!";
}

mysqli_close($connect);

header("location:../index.php");
exit;
