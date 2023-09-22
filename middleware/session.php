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
