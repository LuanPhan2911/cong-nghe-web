<?php
require_once "./middleware/check_login.php";
require_once "./database/connect.php";
if (!check_login()) {
    header("location:login.php");
    exit;
}
if (empty($_GET["id"])) {
    header("location:404.php");
    exit;
}
$user_id = $_GET["id"];
$query = "select * from users where id=$user_id";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_array($result);

if (empty($user)) {
    header("location:404.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Hồ sơ</title>
    <style>
        .user-avatar {
            width: 200px;
            height: 200px;

        }
    </style>
</head>

<body>
    <?php require_once "./layouts/header.php" ?>
    <?php require_once "./helper/asset.php" ?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-primary-subtle">
                            <h3 class="text-center">Hồ sơ</h3>
                        </div>
                        <div class="card-body">
                            <form action="./update_user.php" method="post" enctype="multipart/form-data" id="update_user">
                                <input type="text" hidden name="id" value="<?php echo $_GET['id'] ?>">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="avatar" class="d-flex justify-content-center mb-3 cursor-pointer">
                                                <img src="<?php isset($user['avatar']) ? asset($user['avatar']) : asset('./images/users/default.webp')  ?>" class="rounded-circle img-thumbnail user-avatar">
                                            </label>
                                            <div class="fst-italic fw-light text-center">Nhấn vào ảnh trên để cập nhật ảnh đại diện</div>
                                            <input class="form-control" name="avatar" type="file" id="avatar" accept="image/*" hidden />



                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3 row">
                                            <label for="name" class="col-sm-3 col-form-label">Tên</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="name" type="text" id="name" value="<?php echo $user['name'] ?>" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="birth_year" class="col-sm-3 col-form-label">Năm sinh</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="birth_year" type="number" id="birth_year" value="<?php echo $user['birth_year'] ?>" />
                                            </div>
                                        </div>
                                        <div class=" mb-3 row">
                                            <label for="gender" class="col-sm-3 col-form-label">Giới tính</label>
                                            <div class="col-sm-9">
                                                <select id="gender" name="gender" class="form-select">
                                                    <option value="0" <?php echo $user['gender'] == 0 ? 'selected="selected"' : '' ?>>
                                                        Nam
                                                    </option>
                                                    <option value="1" <?php echo $user['gender'] == 1 ? 'selected="selected"' : '' ?>>Nữ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="description" class="col-sm-3 col-form-label">Giới thiệu ngắn</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="description" id="description" value="<?php echo $user['description'] ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="email" disabled value="<?php echo $user['email'] ?>"></input>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex justify-content-center">
                                            <button class="btn btn-primary px-5 d-block" type="submit">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <?php
        require_once "./notify/toast_success.php";
        require_once "./notify/toast_error.php";
        ?>

    </main>
    <?php require_once "./layouts/footer.php" ?>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script>
        $(function() {

            $("#update_user").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    birth_year: {
                        min: 1900,
                        max: (new Date()).getFullYear(),
                    },
                    description: {
                        maxlength: 255,
                    },
                    avatar: {
                        accept: "image/"
                    }
                },
                messages: {
                    name: {
                        required: "Bạn chưa nhập vào tên tài khoản!"
                    },
                    birth_year: {
                        min: "Năm sinh tối thiểu là 1900!",
                        max: `Năm sinh tối đa là ${(new Date()).getFullYear()}`
                    },
                    avatar: {
                        accept: "Bạn chọn file phải là ảnh!"
                    },
                    description: {
                        maxlength: "Giới thiệu ngắn tối đa 255 kí tự!"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            })
            let avatarUrl = null;
            $("#avatar").change(function(e) {
                let file = e.target.files[0];
                if (avatarUrl) {
                    URL.revokeObjectURL(avatarUrl);
                }
                avatarUrl = URL.createObjectURL(file);
                $(".user-avatar").attr("src", avatarUrl);


            })
        })
    </script>
</body>

</html>