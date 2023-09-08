<?php
require_once "./database/connect.php";
$email = $_POST["email"];
$password = $_POST["password"];

$errorMessage = "Email hoặc mật khẩu không đúng";
require_once "./middleware/session_start.php";
if (empty($email) || empty($password)) {
    $_SESSION["err"] = $errorMessage;
    header("location:login.php");
    exit;
}
$query = "select * from users where email='$email'and password='$password'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

if (isset($data)) {

    $_SESSION["role"] = $data["role"];
    $_SESSION["name"] = $data["name"];
    $_SESSION["id"] = $data["id"];

    $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
    header("location:index.php");
    exit;
} else {
    $_SESSION["err"] = $errorMessage;
    $_SESSION["email"] = $email;
    header("location:login.php");
    exit;
}





$connect->close();
