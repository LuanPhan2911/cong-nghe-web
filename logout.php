<?php
require_once __DIR__ . "/middleware/session.php";
session_unset();
session_destroy();
header("location:login.php");
