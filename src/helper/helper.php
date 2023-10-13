<?php
session_start();
function flash($key)
{
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
}
function old_value($key)
{
    return flash($key);
}

function check_login(): bool
{
    return isset($_SESSION["user_id"]) && isset($_SESSION["user_role"]);
}
function check_admin()
{
    return check_login() && $_SESSION['user_role'] == 1;
}

function upload_file($file, $target)
{

    $dir = str_replace("\\", "/", __DIR__);

    $time = time();
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $file_name = $time . basename($file['name']);

    $path = $target . hash_hmac("sha256", $file_name, "291103") . ".$ext";
    $dir = "$dir/../../public/assets/images/" . $path;
    move_uploaded_file($file['tmp_name'], $dir);
    return $path;
}
function remove_file($target)
{
    $dir = str_replace("\\", "/", __DIR__);

    return unlink("$dir/../public/assets/images/" . $target);
}
function redirect(string $location)
{
    header("location:" . $location);
}
