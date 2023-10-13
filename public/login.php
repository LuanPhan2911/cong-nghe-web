<?php

use App\Database\User;

require_once __DIR__ . "/../vendor/autoload.php";
if (check_login()) {
    redirect("/index.php");
}
$_SESSION['redirect_back'] = $_SERVER['HTTP_REFERER'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = htmlspecialchars($_POST["email"]) ?? NULL;
    $password = htmlspecialchars($_POST["password"]) ?? NULL;

    $errorMessage = "Email hoặc mật khẩu không đúng";

    if (empty($email) || empty($password)) {
        $_SESSION["err"] = $errorMessage;
        redirect("/login.php");
        exit;
    }

    $userModel = new User();

    $data = $userModel->exist($email);


    if (!empty($data)) {

        // verify password
        $password_hash = $data['password'];
        if (!password_verify($password, $password_hash)) {
            $_SESSION["err"] = $errorMessage;
            $_SESSION["email"] = $email;
            redirect("/login.php");
            exit;
        }



        $_SESSION["user_role"] = $data['role'];
        $_SESSION["user_name"] = $data["name"];
        $_SESSION["user_id"] = $data["id"];
        $_SESSION['user_avatar'] = $data['avatar'] ?? "users/default.webp";

        // 1 is admin
        if ($data['role'] == 1) {

            $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
            redirect("/admin/index.php");
            exit;
        } else {
            $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
            $redirect_back = flash('redirect_back');
            redirect($redirect_back);
            exit;
        }
    } else {
        $_SESSION["err"] = $errorMessage;
        $_SESSION["email"] = $email;
        redirect("/login.php");
        exit;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once  __DIR__ . "/layouts/styles.php" ?>

    <title>Đăng nhập</title>
</head>

<body>

    <?php require_once __DIR__ . "/layouts/header.php" ?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 my-3">
                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="text-center text-primary">Đăng nhập</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" id="login_form">
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
                                <div class="mb-3 d-flex justify-content-center">
                                    <button class="btn btn-primary px-5 d-block" type="submit">Đăng nhập</button>
                                </div>
                                <div class="mb-3">
                                    <p class="text-center">Bạn chưa có tài khoản?
                                        <a href="register.php" class="link-primary text-decoration-none">Đăng ký</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>


        </div>
        <?php require_once __DIR__ . "/layouts/toast_error.php" ?>

    </main>
    <?php require_once __DIR__ . "/layouts/footer.php" ?>
    <?php require_once __DIR__ . "/layouts/script.php" ?>
    <script>
        $(function() {

            $("#login_form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },


                },
                messages: {
                    email: {
                        required: "Bạn chưa nhập vào địa chỉ email!",
                        email: "Địa chỉ email không hợp lệ!"
                    },
                    password: {
                        required: "Bạn chưa nhập vào mật khẩu!",
                        minlength: "Mật khẩu ít nhất 5 ký tự!"
                    },


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