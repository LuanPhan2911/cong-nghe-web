<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function loginForm()
    {
        return view('login');
    }
    public function registerForm()
    {
        return view("register");
    }
    public function login()
    {

        $email = htmlspecialchars($_POST["email"]) ?? NULL;
        $password = htmlspecialchars($_POST["password"]) ?? NULL;

        $errorMessage = "Email hoặc mật khẩu không đúng";

        if (empty($email) || empty($password)) {
            $_SESSION["err"] = $errorMessage;
            redirect("/login");
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
                redirect("/login");
                exit;
            }



            $_SESSION["user_role"] = $data['role'];
            $_SESSION["user_name"] = $data["name"];
            $_SESSION["user_id"] = $data["id"];
            $_SESSION['user_avatar'] = $data['avatar'] ?? "users/default.webp";

            // 1 is admin
            if ($data['role'] == 1) {

                $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
                redirect("/admin/");
                exit;
            } else {
                $_SESSION["msg"] = "Bạn đã đăng nhập thành công!";
                redirect("/");
                exit;
            }
        } else {
            $_SESSION["err"] = $errorMessage;
            $_SESSION["email"] = $email;
            redirect("/login");
            exit;
        }
    }

    public function register()
    {
        $name = htmlspecialchars($_POST["name"]) ?? NULL;
        $email = htmlspecialchars($_POST["email"]) ?? NULL;
        $password = htmlspecialchars($_POST["password"]) ?? NULL;


        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION["err"] = "Một vài trường dữ liệu bị trống!";

            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            redirect("/register");
            exit;
        }

        //check email exist



        $userModel = new User();

        $data = $userModel->exist($email);


        if (!empty($data)) {
            $_SESSION["err"] = "Email đã tồn tại";

            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;

            redirect("/register");
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
            redirect("/");
            exit;
        } else {
            $_SESSION['err'] = "Có lỗi xảy ra!";
            redirect("/register");
            exit;
        }
    }

    public function edit(int $user_id)
    {
        if (empty($user_id) || !is_numeric($user_id)) {
            redirect("/404");
            exit;
        }
        if ($user_id != user_id()) {
            redirect("/404");
            exit;
        }

        $userModel = new User();
        $user = $userModel->findOne($user_id);

        if (empty($user)) {
            redirect("/404");
            exit;
        }
        return view("user", [
            'user' => $user
        ]);
    }
    public function update($user_id)
    {

        if (empty($user_id) || !is_numeric($user_id)) {
            redirect("/404");
            exit;
        }
        if ($user_id != user_id()) {
            redirect("/404");
            exit;
        }

        $id = htmlspecialchars($user_id);
        $name = htmlspecialchars($_POST['name']) ?? NULL;
        $birth_year = htmlspecialchars($_POST['birth_year']) ?? NULL;
        $gender = htmlspecialchars($_POST['gender']) ?? NULL;
        $description = htmlspecialchars($_POST['description']) ?? NULL;
        $avatar = $_FILES['avatar'] ?? NULL;


        //validate

        if (empty($name)) {
            $_SESSION["err"] = "Tên tài khoản không được để trống!";
            redirect("/user/$id");
            exit;
        }

        if (isset($gender) && !in_array($gender, [0, 1])) {
            $_SESSION["err"] = "Giới tính chỉ có thể là Nam hoặc Nữ!";
            redirect("/user/$id");
            exit;
        }


        // update avatar



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
            $_SESSION['user_avatar'] = $path_avatar ?? 'users/default.webp';
        }

        redirect("/user/$id");
        exit;
    }
    public function logout()
    {
        session_unset();
        redirect("/");
        exit;
    }
}
