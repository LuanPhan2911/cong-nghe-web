<?php

require_once __DIR__ . '/../database/User.php';
require_once __DIR__ . "/../middleware/session.php";
$name = $_POST["name"] ?? NULL;
$email = $_POST["email"] ?? NULL;
$password = $_POST["password"] ?? NULL;


if (empty($name) || empty($email) || empty($password)) {
    $_SESSION["err"] = "Một vài trường dữ liệu bị trống!";

    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    header("location:../register.php");
    exit;
}

//check email exist



$userModel = new User();

$data = $userModel->exist($email);


if (!empty($data)) {
    $_SESSION["err"] = "Email đã tồn tại";

    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;

    header("location:../register.php");
    exit;
}

$password_hash = password_hash($password, PASSWORD_BCRYPT);

$user_id = $userModel->insert($name, $email, $password_hash);

if (isset($user_id)) {

    $_SESSION["user_name"] = $name;
    $_SESSION["user_role"] = 0;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_avatar'] = 'users/default.webp';
    $_SESSION["msg"] = "Bạn đã đăng ký thành công!";
    header("location:../index.php");
}
