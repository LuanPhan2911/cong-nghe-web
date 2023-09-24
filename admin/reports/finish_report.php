<?php
require_once __DIR__ . "/../../database/connect.php";
require_once __DIR__ . "/../../middleware/session.php";
if (!check_admin()) {
    header("location:../../index.php");
    exit;
}
$id = $_GET['id'] ?? NULL;
$action = $_GET['action'] ?? 'finish';
$redirect_back = "location: " . $_SERVER['HTTP_REFERER'];
if (empty($id) || empty($action)) {
    header($redirect_back);
    exit;
}
$update_value = $action === "finish" ? '1' : '0';
$query = "update reports 
set
finish=$update_value
where 
id='$id'
";

$result = mysqli_query($connect, $query);
$action = ucfirst($action);
if (isset($result)) {
    $_SESSION["msg"] = "$action reports success!";
}

mysqli_close($connect);

header($redirect_back);
exit;
