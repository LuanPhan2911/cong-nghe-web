<?php

use App\Database\User;

require_once __DIR__ . "/../vendor/autoload.php";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = htmlspecialchars($_POST["name"]) ?? NULL;
    $email = htmlspecialchars($_POST["email"]) ?? NULL;
    $password = htmlspecialchars($_POST["password"]) ?? NULL;


    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION["err"] = "Một vài trường dữ liệu bị trống!";

        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        redirect("/register.php");
        exit;
    }

    //check email exist



    $userModel = new User();

    $data = $userModel->exist($email);


    if (!empty($data)) {
        $_SESSION["err"] = "Email đã tồn tại";

        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;

        redirect("/register.php");
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
        redirect("/index.php");
    } else {
        $_SESSION['err'] = "Có lỗi xảy ra!";
        redirect("/register.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once __DIR__ . "/layouts/styles.php" ?>

    <title>Đăng ký</title>
</head>

<body>
    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 my-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="text-center text-primary">Đăng ký</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" id="register_form">
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Tên đăng nhập</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="name" type="text" id="name" value="<?php echo old_value("name") ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="email" type="email" id="email" value="<?php echo old_value("email") ?>" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-sm-3 col-form-label">Mật khẩu</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="password" type="password" id="password" />
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label for="confirm_password" class="col-sm-3 col-form-label">Nhập lại mật khẩu</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="confirm_password" type="password" id="confirm_password" />
                                    </div>

                                </div>
                                <div class="mb-3 d-flex justify-content-center">
                                    <button class="btn btn-primary px-5" type="submit">Đăng ký</button>
                                </div>
                                <div class="mb-3">
                                    <p class="text-center">Bạn đã có tài khoản?
                                        <a href="login.php" class="link-primary text-decoration-none">Đăng nhập</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>


            </div>
            <?php
            require_once __DIR__ . "/layouts/toast_error.php";
            ?>
    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>

    <script>
        $(function() {

            $("#register_form").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    }


                },
                messages: {
                    name: {
                        required: "Bạn chưa nhập vào tên đăng nhập!"
                    },
                    email: {
                        required: "Bạn chưa nhập vào địa chỉ email!",
                        email: "Địa chỉ email không hợp lệ!"
                    },
                    password: {
                        required: "Bạn chưa nhập vào mật khẩu!",
                        minlength: "Mật khẩu ít nhất 5 ký tự!"
                    },
                    confirm_password: {
                        required: "Bạn chưa nhập vào mật khẩu!",
                        minlength: "Tên đăng nhập ít nhất 5 ký tự!",
                        equalTo: "Mật khẩu xác nhận không trùng khớp với mật khẩu đã nhập!"
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
        })
    </script>
</body>

</html>