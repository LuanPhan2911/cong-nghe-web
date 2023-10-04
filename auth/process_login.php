<?php
// require_once __DIR__ . "/../database/connect.php";
require_once __DIR__ . '/../database/User.php';
require_once __DIR__ . "/../middleware/session.php";
$email = $_POST["email"] ?? NULL;
$password = $_POST["password"] ?? NULL;

$errorMessage = "Email hoặc mật khẩu không đúng";

if (empty($email) || empty($password)) {
    $_SESSION["err"] = $errorMessage;
    header("location:../login.php");
    exit;
}

//mysqli

// $query = "select * from users where email='$email'and deleted_at is null";
// $result = mysqli_query($connect, $query);
// $data = mysqli_fetch_array($result);

// pdo
$userModel = new User();

$data = $userModel->exist($email);


if (!empty($data)) {

    // verify password
    $password_hash = $data['password'];
    if (!password_verify($password, $password_hash)) {
        $_SESSION["err"] = $errorMessage;
        $_SESSION["email"] = $email;
        header("location:../login.php");
        exit;
    }



    $_SESSION["user_role"] = $data['role'];
    $_SESSION["user_name"] = $data["name"];
    $_SESSION["user_id"] = $data["id"];
    $_SESSION['user_avatar'] = $data['avatar'] ?? "users/default.webp";

    // 1 is admin
    if ($data['role'] == 1) {

        $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
        header("location:../admin/index.php");
        exit;
    } else {
        $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
        $redirect_back = flash('redirect_back');
        header("location:" . $redirect_back);
        exit;
    }
} else {
    $_SESSION["err"] = $errorMessage;
    $_SESSION["email"] = $email;
    header("location:../login.php");
    exit;
}





// $connect->close();
