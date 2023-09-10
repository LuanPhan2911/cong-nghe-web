<?php
require_once "middleware/session_start.php";
session_unset();
session_destroy();
header("location:login.php");
