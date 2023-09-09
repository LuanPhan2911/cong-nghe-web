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

$query = "select * from users where email='$email'and deleted_at is null";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

if (isset($data)) {

    // verify password
    $password_hash = $data['password'];
    if (!password_verify($password, $password_hash)) {
        $_SESSION["err"] = $errorMessage;
        $_SESSION["email"] = $email;
        header("location:login.php");
        exit;
    }


    $role = boolval($data["role"]);
    $_SESSION["role"] = $role;
    $_SESSION["name"] = $data["name"];
    $_SESSION["id"] = $data["id"];

    // 1 is admin
    if ($role === true) {

        $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
        header("location:admin/");
        exit;
    } else {
        $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
        header("location:/");
        exit;
    }
} else {
    $_SESSION["err"] = $errorMessage;
    $_SESSION["email"] = $email;
    header("location:login.php");
    exit;
}





$connect->close();
