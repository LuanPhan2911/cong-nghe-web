<?php
require_once "./database/connect.php";
$id = $_POST['id'];
$name = $_POST['name'];
$birth_year = $_POST['birth_year'];
$gender = $_POST['gender'];
$description = $_POST['description'];
$avatar = $_FILES['avatar'];


//validate
require_once "./middleware/session_start.php";
if (empty($name)) {
    $_SESSION["err"] = "Tên tài khoản không được để trống!";
    header("location:user.php?id=$id");
    exit;
}

if (isset($gender) && !in_array($gender, [0, 1])) {
    $_SESSION["err"] = "Giới tính chỉ có thể là Nam hoặc Nữ!";
    header("location:user.php?id=$id");
    exit;
}
// update avatar
require_once "./helper/file_upload.php";

$query = "select avatar from users where id='$id'";
$result = mysqli_query($connect, $query);
$old_avatar = mysqli_fetch_column($result);

$pathAvatar = $old_avatar;
if (isset($old_avatar) && isset($avatar)) {
    remove_file($old_avatar);
    $pathAvatar = upload_file($avatar, "users/");
}



// update user

$query = "update users set
    name='$name',
    avatar='$pathAvatar',
    birth_year='$birth_year',
    description='$description',
    gender='$gender'
    where
    id='$id'
";
$result = mysqli_query($connect, $query);


$_SESSION['msg'] = "Cập nhật thông tin tài khoản thành công!";
header("location:user.php?id=$id");
exit;
