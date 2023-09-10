<?php
session_start();
function session_flash($key)
{
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
}
function old_value($key)
{
    return session_flash($key);
}
function check_login()
{
    return isset($_SESSION["id"]) && isset($_SESSION["role"]);
}
function check_admin()
{
    return isset($_SESSION["id"]) &&  isset($_SESSION["role"]) && $_SESSION['role'] === true;
}
