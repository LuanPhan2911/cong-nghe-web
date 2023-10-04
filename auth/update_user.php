<?php
// require_once __DIR__ . "/../database/connect.php";

require_once __DIR__ . '/../database/User.php';

require_once __DIR__ . "/../middleware/session.php";
require_once __DIR__ . "/../helper/helper.php";


$id = $_POST['id'] ?? NULL;
$name = $_POST['name'] ?? NULL;
$birth_year = $_POST['birth_year'] ?? NULL;
$gender = $_POST['gender'] ?? NULL;
$description = $_POST['description'] ?? NULL;
$avatar = $_FILES['avatar'] ?? NULL;


//validate

if (empty($name)) {
    $_SESSION["err"] = "Tên tài khoản không được để trống!";
    header("location:../user.php?id=$id");
    exit;
}

if (isset($gender) && !in_array($gender, [0, 1])) {
    $_SESSION["err"] = "Giới tính chỉ có thể là Nam hoặc Nữ!";
    header("location:../user.php?id=$id");
    exit;
}
// if (!is_uploaded_file($avatar['tmp_name'])) {
//     $_SESSION["err"] = "Chưa cập nhật ảnh đại diện!";
//     header("location:../user.php?id=$id");
//     exit;
// }

// update avatar


// $query = "select avatar from users where id='$id'";
// $result = mysqli_query($connect, $query);
// $old_avatar = mysqli_fetch_column($result);
$userModel = new User();

$data = $userModel->findOne($id);
$old_avatar = $data['avatar'] ?? NULL;

$path_avatar = NULL;

if (isset($old_avatar)) {
    $path_avatar = $old_avatar;
}
if (isset($avatar) && is_uploaded_file($avatar['tmp_name'])) {

    if (isset($old_avatar)) {
        remove_file($old_avatar);
    }

    $path_avatar = upload_file($avatar, "users/");
}







// $birth_year = empty($birth_year) ? NULL : (int)$birth_year;


// update user

// $query = "update users set
//     name='$name',
//     avatar='$path_avatar',
//     birth_year=$birth_year,
//     description='$description',
//     gender='$gender'
//     where
//     id='$id'
// ";

// $result = mysqli_query($connect, $query);



// mysqli_close($connect);

$result = $userModel->update([
    'name' => $name,
    'avatar' => $path_avatar,
    'birth_year' => $birth_year,
    'description' => $description,
    'gender' => $gender,
    'id' => $id
]);
if ($result) {
    $_SESSION['msg'] = "Cập nhật thông tin tài khoản thành công!";
    $_SESSION['user_name'] = $name;
    $_SESSION['user_avatar'] = $path_avatar;
}

header("location:../user.php?id=$id");
exit;
