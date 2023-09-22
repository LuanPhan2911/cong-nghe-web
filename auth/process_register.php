<?php
require_once __DIR__ . "/../database/connect.php";
require_once __DIR__ . "/../middleware/session.php";
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];


if (empty($name) || empty($email) || empty($password)) {
    $_SESSION["err"] = "Một vài trường dữ liệu bị trống!";

    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    header("location:../register.php");
    exit;
}

//check email exist
$query_check_email = "select * from users where email='$email'";
$result_email = mysqli_query($connect, $query_check_email);
$data_email = mysqli_fetch_array($result_email);
$errMessage = "Email đã tồn tại";
if (isset($data_email)) {
    $_SESSION["err"] = $errMessage;

    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;

    header("location:../register.php");
    exit;
}

$password_hash = password_hash($password, PASSWORD_BCRYPT);

$query = "insert into users(name, email, password)
    values('$name', '$email', '$password_hash')";
$result = mysqli_query($connect, $query);

if (isset($result)) {

    $_SESSION["user_name"] = $name;
    $_SESSION["user_role"] = 0;
    $_SESSION['user_id'] = mysqli_insert_id($connect);
    $_SESSION['user_avatar'] = 'users/default.webp';
    $_SESSION["msg"] = "Bạn đã đăng ký thành công!";
    header("location:../index.php");
}




$connect->close();
