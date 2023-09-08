<?php
require_once "./middleware/session_start.php";
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
