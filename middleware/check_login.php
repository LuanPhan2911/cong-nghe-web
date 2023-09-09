<?php
require_once "./middleware/session_start.php";
function check_login()
{
    return isset($_SESSION["id"]) && isset($_SESSION["role"]);
}
